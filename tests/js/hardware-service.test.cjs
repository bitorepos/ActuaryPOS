const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/hardware_service.js'), 'utf8');

function harness(settings, drawerResult = { success: true }) {
    const requests = [];
    const timeouts = [];
    const workstation = {
        pos_printer_name: 'POS Receipt Printer',
        settings,
    };
    const context = {
        window: {APP: {BUSINESS_ID: 99}},
        URLSearchParams,
        AbortController,
        setTimeout: (callback, timeoutMs) => {
            timeouts.push(timeoutMs);
            return timeouts.length;
        },
        clearTimeout: () => {},
        fetch: async (url, options = {}) => {
            requests.push({url, options});
            let result = {};
            if (url.endsWith('/health')) {
                result = {service: 'AlUrooj.HardwareService'};
            } else if (url.endsWith('/api/auth/handshake')) {
                result = {token: 'test-token', deviceName: 'POS-PC'};
            } else if (url.startsWith('/workstation-settings/for-machine?')) {
                result = {success: true, data: workstation};
            } else if (url.endsWith('/api/drawer/open')) {
                result = drawerResult;
            }
            return {
                ok: true,
                statusText: 'OK',
                json: async () => result,
            };
        },
    };

    vm.runInNewContext(source, context);
    return {context, requests, timeouts};
}

function configuredSettings(overrides = {}) {
    return {
        hardware_service_enabled: 1,
        hardware_service_cash_drawer_enabled: 1,
        hardware_service_cash_drawer_pin: 5,
        hardware_service_receipt_printer: 'POS Receipt Printer',
        ...overrides,
    };
}

test('direct sale return drawer request uses saved POS printer, pin, location, and business', async () => {
    const h = harness(configuredSettings());

    await h.context.window.openCashDrawerViaHardwareService(
        12,
        '/workstation-settings/for-machine',
        'Direct sale return saved',
        99
    );

    const handshake = h.requests.find(request => request.url.endsWith('/api/auth/handshake'));
    assert.equal(JSON.parse(handshake.options.body).storeId, '99');
    const workstation = h.requests.find(request => request.url.startsWith('/workstation-settings/for-machine?'));
    assert.match(workstation.url, /location_id=12/);
    assert.match(workstation.url, /machine_name=POS-PC/);
    const drawer = h.requests.find(request => request.url.endsWith('/api/drawer/open'));
    const drawerPayload = JSON.parse(drawer.options.body);
    assert.match(drawerPayload.jobId, /^sell_return_drawer_\d+$/);
    assert.deepEqual(drawerPayload, {
        jobId: drawerPayload.jobId,
        targetPrinter: 'POS Receipt Printer',
        pin: 5,
        reason: 'Direct sale return saved',
    });
    assert.equal(drawer.options.headers['X-AlUrooj-Hardware-Token'], 'test-token');
    assert.deepEqual(h.timeouts, [1500, 10000, 10000, 20000]);
});

test('does not send a drawer pulse when disabled in Hardware Setup', async () => {
    const h = harness(configuredSettings({hardware_service_cash_drawer_enabled: 0}));

    await assert.rejects(
        h.context.window.openCashDrawerViaHardwareService(12, '/workstation-settings/for-machine'),
        /Cash drawer is not enabled/
    );
    assert.equal(h.requests.some(request => request.url.endsWith('/api/drawer/open')), false);
});

test('reports a failed drawer pulse instead of resolving as success', async () => {
    const h = harness(configuredSettings(), {success: false, message: 'Drawer unavailable'});

    await assert.rejects(
        h.context.window.openCashDrawerViaHardwareService(12, '/workstation-settings/for-machine'),
        /Drawer unavailable/
    );
});
