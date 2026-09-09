const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const source = fs.readFileSync(require('node:path').join(__dirname, '../../public/js/pos.js'), 'utf8');

function harness() {
    let payload = 'products[0][variation_id]=10&products[0][quantity]=1';
    const requests = [], deferred = [];
    const form = { length: 1 };
    const context = {
        URLSearchParams, console, window: { console },
        pos_draft_auto_save_timer: null, pos_draft_auto_save_request: null,
        pos_draft_last_saved_fingerprint: null, pos_draft_submit_waiting: false,
        pos_manual_draft_save_in_progress: false, pos_form_actions_processing: false,
        auto_save_in_progress: false,
        clearTimeout() {}, setTimeout(fn) { deferred.push(fn); },
        toastr: { error() {} }, enable_pos_form_actions() {},
        has_submittable_pos_product_rows: () => true,
        has_pending_pos_product_rows: () => false,
        sync_sell_line_submit_guard() {},
        serialize_pos_draft_form: () => payload,
        get_pos_is_inclusive_param: () => '&is_inclusive=0',
        get_draft_auto_save_url: () => '/draft',
        set_auto_saved_draft_form_state() {}, sync_auto_saved_sell_lines() {},
        $: () => ({ first: () => form, val: () => '1' }),
    };
    context.$.ajax = options => {
        const done = [], fail = [];
        const request = {
            readyState: 1,
            done(fn) { done.push(fn); return request; },
            fail(fn) { fail.push(fn); return request; },
            resolve(result = { success: 1, sell: { id: 1 } }) {
                request.readyState = 4;
                options.success(result);
                done.forEach(fn => fn(result));
                options.complete();
            },
            reject() {
                request.readyState = 4;
                options.error({ statusText: 'error' });
                fail.forEach(fn => fn());
                options.complete();
            },
        };
        options.beforeSend();
        requests.push(request);
        return request;
    };
    vm.createContext(context);
    for (const name of ['pos_draft_fingerprint', 'wait_for_pos_draft_before_submit', 'auto_save_pos_draft']) {
        const start = source.indexOf('function ' + name + '(');
        vm.runInContext(source.slice(start, source.indexOf('\n}', start) + 2), context);
    }
    return { context, requests, setPayload(value) { payload = value; }, flush() { deferred.splice(0).forEach(fn => fn()); } };
}

test('unchanged draft is saved once; a second product triggers another save', () => {
    const h = harness();
    h.context.auto_save_pos_draft();
    h.requests[0].resolve();
    for (let i = 0; i < 60; i++) h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 1);
    h.setPayload('products[0][variation_id]=10&products[0][quantity]=1&products[1][variation_id]=20');
    h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 2);
});

test('edits during a request are not marked saved, and requests cannot overlap', () => {
    const h = harness();
    h.context.auto_save_pos_draft();
    h.setPayload('products[0][variation_id]=10&products[0][quantity]=2');
    h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 1);
    h.requests[0].resolve();
    h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 2);
});

test('server-generated IDs do not dirty a draft; quantity changes do', () => {
    const h = harness(), fingerprint = h.context.pos_draft_fingerprint;
    assert.equal(fingerprint('products[0][quantity]=1'), fingerprint('invoice_no=SI1&sell_id=5&products[0][quantity]=1&products[0][transaction_sell_lines_id]=9'));
    assert.notEqual(fingerprint('products[0][quantity]=1'), fingerprint('products[0][quantity]=2'));
});

test('failed save remains eligible for retry', () => {
    const h = harness();
    h.context.auto_save_pos_draft();
    h.requests[0].reject();
    h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 2);
});

test('checkout resumes once, after autosave completion and ID synchronization', () => {
    const h = harness();
    let resumed = 0, synced = false;
    h.context.sync_auto_saved_sell_lines = () => { synced = true; };
    h.context.auto_save_pos_draft();
    const resume = () => { assert.equal(synced, true); assert.equal(h.context.auto_save_in_progress, false); resumed++; };
    assert.equal(h.context.wait_for_pos_draft_before_submit(resume), true);
    assert.equal(h.context.wait_for_pos_draft_before_submit(resume), true);
    assert.equal(resumed, 0);
    h.requests[0].resolve();
    assert.equal(resumed, 0);
    h.flush();
    assert.equal(resumed, 1);
});

test('failed autosave blocks waiting checkout and checkout processing blocks autosave', () => {
    const h = harness();
    let resumed = false;
    h.context.auto_save_pos_draft();
    h.context.wait_for_pos_draft_before_submit(() => { resumed = true; });
    h.requests[0].reject();
    h.flush();
    assert.equal(resumed, false);
    h.context.pos_form_actions_processing = true;
    h.context.auto_save_pos_draft();
    assert.equal(h.requests.length, 1);
});
