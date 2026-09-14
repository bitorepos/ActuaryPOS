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
    const button = {
        disabled: false,
        classList: { add() {}, remove() {} },
        querySelector: () => icon,
        getAttribute: key => key === 'data-href' ? '/software/sync' : 'fab fa-github',
        addEventListener: (_, handler) => { click = handler; },
    };
    vm.runInNewContext(script, {
        document: {
            addEventListener: (_, handler) => handler(),
            getElementById: id => id === 'software_git_sync_btn' ? button : {
                classList: { remove: () => { updateVisible = true; } },
            },
            querySelector: () => ({ getAttribute: () => 'csrf-token' }),
        },
        fetch: async (url, options) => {
            assert.equal(url, '/software/sync');
            assert.equal(options.headers['X-CSRF-TOKEN'], 'csrf-token');
            assert.equal(options.method, 'POST');
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
    return { errors, successes, updateVisible };
}

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
