const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');

const header = fs.readFileSync('resources/views/layouts/partials/header.blade.php', 'utf8');
const script = header.slice(header.lastIndexOf('<script>') + 8, header.lastIndexOf('</script>'));

async function clickSync(response) {
    const errors = [];
    const successes = [];
    const icon = { className: 'fab fa-github' };
    let click;
    let updateVisible = false;
    let modalShown = false;
    let modalHidden = false;
    let buttonDisabledDuringFetch = false;
    const elements = {};

    function getOrCreateEl(id) {
        if (elements[id]) return elements[id];
        const classes = new Set();
        const el = {
            id,
            style: {},
            textContent: '',
            innerText: '',
            setAttribute(k, v) { this[k] = v; },
            getAttribute(k) { return this[k] || ''; },
            classList: {
                add: (...cls) => {
                    cls.forEach(c => classes.add(c));
                    if (id === 'software_sync_progress_modal' && cls.includes('show')) modalShown = true;
                },
                remove: (...cls) => {
                    cls.forEach(c => classes.delete(c));
                    if (id === 'software_update_nav_item' && cls.includes('d-none')) updateVisible = true;
                    if (id === 'software_sync_progress_modal' && cls.includes('show')) modalHidden = true;
                },
                contains: c => classes.has(c),
            },
            addEventListener: () => {},
        };
        elements[id] = el;
        return el;
    }

    const button = {
        disabled: false,
        classList: { add() {}, remove() {} },
        querySelector: () => icon,
        getAttribute: key => key === 'data-href' ? '/software/sync' : 'fab fa-github',
        addEventListener: (_, handler) => { click = handler; },
    };
    elements['software_git_sync_btn'] = button;

    const mockWindow = {
        addEventListener: () => {},
        removeEventListener: () => {},
        setTimeout: (fn, ms) => setTimeout(fn, ms),
        clearTimeout: id => clearTimeout(id),
        setInterval: (fn, ms) => setInterval(fn, ms),
        clearInterval: id => clearInterval(id),
    };

    vm.runInNewContext(script, {
        window: mockWindow,
        setTimeout: (fn, ms) => setTimeout(fn, ms),
        clearTimeout: id => clearTimeout(id),
        setInterval: (fn, ms) => setInterval(fn, ms),
        clearInterval: id => clearInterval(id),
        document: {
            addEventListener: (_, handler) => handler(),
            getElementById: id => getOrCreateEl(id),
            querySelector: sel => {
                if (sel === 'meta[name="csrf-token"]') return { getAttribute: () => 'csrf-token' };
                return null;
            },
        },
        fetch: async (url, options) => {
            assert.equal(url, '/software/sync');
            assert.equal(options.headers['X-CSRF-TOKEN'], 'csrf-token');
            assert.equal(options.method, 'POST');
            buttonDisabledDuringFetch = button.disabled;
            if (response instanceof Error) throw response;
            return { ok: response.status === 200, redirected: false, ...response,
                text: async () => response.body };
        },
        toastr: { error: message => errors.push(message), success: message => successes.push(message) },
    });
    click();
    await new Promise(resolve => setImmediate(resolve));
    assert.equal(button.disabled, false);
    assert.equal(icon.className, 'fab fa-github');
    return {
        errors,
        successes,
        updateVisible,
        modalShown,
        modalHidden,
        buttonDisabledDuringFetch,
        progressBar: elements['software_sync_progress_bar'],
        modalTitle: elements['softwareSyncModalTitle'],
    };
}

test('header contains progress modal with requested message, progress bar, and static backdrop', () => {
    assert.ok(header.includes('Please wait until Update is Downloading.'));
    assert.ok(header.includes('id="software_sync_progress_modal"'));
    assert.ok(header.includes('data-bs-backdrop="static"'));
    assert.ok(header.includes('data-bs-keyboard="false"'));
    assert.ok(header.includes('id="software_sync_progress_bar"'));
    assert.ok(header.includes('role="progressbar"'));
    assert.ok(header.includes('config(\'constants.software_sync_enabled\')'));
    assert.ok(header.includes('data-href="{{ route(\'software.sync\') }}"'));
    assert.ok(!header.includes("route('software.sync', [], false)"));
});

test('expired CSRF token provides a recovery action', async () => {
    const result = await clickSync({ status: 419, body: '{"message":"CSRF token mismatch."}' });
    assert.match(result.errors[0], /Refresh this page/);
});

test('Laravel authorization errors explain the Admin requirement', async () => {
    const result = await clickSync({ status: 403, body: '{"message":"Forbidden"}' });
    assert.match(result.errors[0], /Only Admin/);
});

test('sync failure details are preserved', async () => {
    const result = await clickSync({ status: 409, body: '{"success":false,"msg":"Local files have changes"}' });
    assert.equal(result.errors[0], 'Local files have changes');
});

test('HTML and login redirects are not rendered in error toasts', async () => {
    const result = await clickSync({ status: 200, redirected: true, body: '<html>Login</html>' });
    assert.match(result.errors[0], /Sign in again/);
    assert.ok(!result.errors[0].includes('<html>'));
});

test('network failures explain that the application server is unreachable', async () => {
    const result = await clickSync(new TypeError('Failed to fetch'));
    assert.match(result.errors[0], /Cannot reach the application server/);
});

test('successful sync reveals the update action', async () => {
    const result = await clickSync({ status: 200, body: '{"success":true,"update_available":true,"msg":"Synced"}' });
    assert.equal(result.successes[0], 'Synced');
    assert.equal(result.updateVisible, true);
    assert.deepEqual(result.errors, []);
});

test('sync displays download progress modal, disables user actions during download, and advances progress bar', async () => {
    const result = await clickSync({ status: 200, body: '{"success":true,"update_available":true,"msg":"Update downloaded"}' });
    assert.equal(result.modalShown, true);
    assert.equal(result.buttonDisabledDuringFetch, true);
    assert.equal(result.progressBar.style.width, '100%');
    assert.equal(result.progressBar['aria-valuenow'], 100);
});
