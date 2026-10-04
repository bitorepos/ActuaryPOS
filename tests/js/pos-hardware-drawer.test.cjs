const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8').replace(/\r\n/g, '\n');
const functionStart = source.indexOf('async function __print_via_windows_hardware_service(');
const functionEnd = source.indexOf('\n}\n', functionStart) + 2;
const printFunction = source.slice(functionStart, functionEnd);

function harness(settings, authorized = true) {
    const requests = [];
    const workstation = {
        pos_printer_name: 'Receipt Printer',
        settings,
    };
    const context = {
        console,
        __loadHardwareServiceWorkstation: async () => workstation,
        parse_workstation_settings_bag: value => value.settings,
        __hardwareServicePrinterFor: () => 'Receipt Printer',
        __hardwareServiceHandshake: async () => {},
        __hardwareServiceFetchJson: async (port, url, request) => {
            requests.push({ port, url, request });
        },
        current_user_can_open_cash_drawer: () => authorized,
    };

    vm.createContext(context);
    vm.runInContext('this.printHardwareReceipt = (' + printFunction + ');', context);
    return { context, requests };
}

function configuredSettings(overrides = {}) {
    return {
        hardware_service_enabled: 1,
        hardware_service_port: 18211,
        hardware_service_auto_print_receipts: 1,
        hardware_service_cash_drawer_enabled: 1,
        hardware_service_cash_drawer_pin: 5,
        ...overrides,
    };
}

test('receipt print opens an enabled drawer with its configured pin for an authorized user', async () => {
    const h = harness(configuredSettings());

    await h.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>');

    const job = JSON.parse(h.requests[0].request.body);
    assert.equal(h.requests[0].url, '/api/print/receipt');
    assert.equal(job.openDrawer, true);
    assert.equal(job.pin, 5);
});

test('receipt print does not open a disabled drawer or bypass drawer permission', async () => {
    const disabled = harness(configuredSettings({ hardware_service_cash_drawer_enabled: 0 }));
    await disabled.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>');
    assert.equal(JSON.parse(disabled.requests[0].request.body).openDrawer, false);

    const unauthorized = harness(configuredSettings(), false);
    await unauthorized.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>');
    const job = JSON.parse(unauthorized.requests[0].request.body);
    assert.equal(job.openDrawer, false);
    assert.equal(Object.hasOwn(job, 'pin'), false);
});

test('KOT print never opens the cash drawer', async () => {
    const h = harness(configuredSettings());

    await h.context.printHardwareReceipt({ print_title: 'Kitchen ticket' }, true, '<p>KOT</p>');

    const job = JSON.parse(h.requests[0].request.body);
    assert.equal(h.requests[0].url, '/api/print/kot');
    assert.equal(job.openDrawer, false);
    assert.equal(Object.hasOwn(job, 'pin'), false);
});
