const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8');
const handlerSource = source.slice(source.indexOf('    function getSellSubmitButtons()'),
    source.indexOf('    //REPAIR MODULE:check if repair module field'));

function setup(options = {}) {
    const messages = [], requests = [], document = {}, data = {};
    const buttons = [{ disabled: false, data: {} }, { disabled: false, data: {} }];
    let handler;
    function collection(selector, items = []) {
        return {
            length: items.length,
            each(fn) { items.forEach(item => fn.call(item)); return this; },
            find(s) { return collection(s, s === '.product_row' ? [{}] : []); },
            val() { return selector === 'select#status' ? 'final' : 1; },
            attr(key) { return key === 'id' ? 'submit-sell' : '/pos/123'; },
            prop(key, value) {
                if (value === undefined) return items[0]?.[key];
                items.forEach(item => item[key] = value); return this;
            },
            data(key, value) {
                if (value === undefined) return items[0]?.data[key];
                items[0].data[key] = value; return this;
            },
            removeData(key) { delete items[0].data[key]; return this; },
            on(event, selector, fn) { if (event === 'click') handler = fn; return this; },
            removeAttr() { return this; }, hide() { return this; },
        };
    }
    function $(selector) {
        if (typeof selector === 'object' && selector !== document) return collection('', [selector]);
        if (selector === '.sell_submit_action, button#submit-sell, button#save-and-print') return collection('', buttons);
        return collection(selector, ['select#status', 'form#edit_sell_form'].includes(selector) ? [{}] : []);
    }
    $.each = (object, fn) => Object.entries(object).forEach(([key, value]) => fn(key, value));
    $.isArray = Array.isArray;
    $.ajax = async config => {
        requests.push(config);
        if (config.method === 'GET') {
            if (options.creditError) throw options.creditError;
            config.success({ msg: options.creditMessage || null });
        } else if (options.saveError) {
            config.error(options.saveError, 'timeout');
        } else {
            config.success({ success: 1, msg: 'Saved' });
        }
    };
    const form = collection('', [{ data }]);
    form.valid = () => options.valid !== false;
    vm.runInNewContext(handlerSource, {
        $, document, sell_form: form, sell_form_validator: { focusInvalid() {} },
        base_path: 'http://localhost/workstation',
        get_out_of_stock_positive_qty_skus() {
            if (options.pageError) throw new Error('Broken row');
            return [];
        },
        __read_number: () => 100, sync_sell_line_submit_guard() {},
        serialize_form_to_nested_object: () => ({ _method: 'PUT' }),
        window: {}, setTimeout() {}, console: { error() {} },
        toastr: Object.fromEntries(['error', 'warning', 'success'].map(key => [key, message => messages.push(message)])),
    });
    return { buttons, messages, requests, data,
        click: () => handler.call(buttons[0], { preventDefault() {} }) };
}

for (const [name, error, message] of [
    ['network failure', { status: 0 }, /not submitted/],
    ['expired session', { status: 419 }, /session has expired/],
    ['server failure', { status: 500 }, /not submitted/],
]) {
    test(name + ' restores Update buttons without saving', async () => {
        const state = setup({ creditError: error });
        await state.click();
        assert.equal(state.requests.length, 1);
        assert.match(state.messages[0], message);
        assert.ok(state.buttons.every(button => !button.disabled));
        assert.equal(state.data.sell_submit_locked, undefined);
    });
}

test('page exception restores Update buttons and reports the failure', async () => {
    const state = setup({ pageError: true });
    await state.click();
    assert.equal(state.requests.length, 0);
    assert.match(state.messages[0], /page error/);
    assert.ok(state.buttons.every(button => !button.disabled));
});

test('credit limit rejection remains enforced', async () => {
    const state = setup({ creditMessage: 'Credit limit exceeded' });
    await state.click();
    assert.equal(state.requests.length, 1);
    assert.equal(state.messages[0], 'Credit limit exceeded');
    assert.ok(state.buttons.every(button => !button.disabled));
});

test('successful update uses application URL and prevents a duplicate click', async () => {
    const state = setup();
    await state.click();
    await state.click();
    assert.equal(state.requests.length, 2);
    assert.equal(state.requests[0].url, 'http://localhost/workstation/contacts/check-credit-limit');
    assert.equal(state.requests[0].timeout, 30000);
    assert.equal(state.requests[1].url, '/pos/123');
    assert.ok(state.buttons.every(button => button.disabled));
});

test('save timeout reports uncertain outcome and restores buttons', async () => {
    const state = setup({ saveError: { status: 0 } });
    await state.click();
    assert.match(state.messages[0], /Check the Sales List before trying again/);
    assert.ok(state.buttons.every(button => !button.disabled));
});
