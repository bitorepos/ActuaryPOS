const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8').replace(/\r\n/g, '\n');
const functionStart = source.indexOf('async function __print_via_windows_hardware_service(');
const functionEnd = source.indexOf('\n}\n', functionStart) + 2;
const printFunction = source.slice(functionStart, functionEnd);
const workstationFunctionStart = source.indexOf('function __findPreloadedWorkstation(');
const workstationFunctionEnd = source.indexOf('\n}\n', workstationFunctionStart) + 2;
const workstationFunction = source.slice(workstationFunctionStart, workstationFunctionEnd);
const drawerFunctionStart = source.indexOf('async function __openWindowsHardwareServiceDrawer(');
const drawerFunctionEnd = source.indexOf('\n}\n', drawerFunctionStart) + 2;
const drawerFunction = source.slice(drawerFunctionStart, drawerFunctionEnd);

function harness(settings, authorized = true, workstationOverride) {
    const requests = [];
    const discoveredPorts = [];
    const workstation = workstationOverride === undefined
        ? { pos_printer_name: 'Receipt Printer', settings }
        : workstationOverride;
    const warnings = [];
    const context = {
        console,
        window: { __workstationSettings: {} },
        __hardwareServiceDeviceNames: {},
        toastr: { warning: message => warnings.push(message) },
        __loadHardwareServiceWorkstation: async () => workstation,
        parse_workstation_settings_bag: value => value && value.settings || {},
        __hardwareServicePrinterFor: () => 'Receipt Printer',
        __discoverWindowsHardwareServicePort: async () => {
            discoveredPorts.push(true);
            return 18212;
        },
        __hardwareServiceHandshake: async () => {},
        __hardwareServiceFetchJson: async (port, url, request) => {
            requests.push({ port, url, request });
        },
        current_user_can_open_cash_drawer: () => authorized,
    };

    vm.createContext(context);
    vm.runInContext('this.printHardwareReceipt = (' + printFunction + ');', context);
    return { context, requests, discoveredPorts, warnings };
}

function drawerHarness(settings, authorized = true) {
    const requests = [];
    const workstation = {
        pos_printer_name: 'Receipt Printer',
        settings,
    };
    const context = {
        __loadHardwareServiceWorkstation: async () => workstation,
        parse_workstation_settings_bag: value => value && value.settings || {},
        current_user_can_open_cash_drawer: () => authorized,
        __discoverWindowsHardwareServicePort: async () => 18211,
        __hardwareServiceHandshake: async () => {},
        __hardwareServiceFetchJson: async (port, url, request) => {
            requests.push({ port, url, request });
            return { success: true };
        },
    };

    vm.createContext(context);
    vm.runInContext('this.openHardwareDrawer = (' + drawerFunction + ');', context);
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

test('POS finalization opens the configured Hardware Service drawer without manual-open permission', async () => {
    const h = drawerHarness(configuredSettings());

    assert.equal(await h.context.openHardwareDrawer(true), true);
    assert.equal(h.requests[0].port, 18211);
    assert.equal(h.requests[0].url, '/api/drawer/open');
    const request = JSON.parse(h.requests[0].request.body);
    assert.match(request.jobId, /^pos_drawer_\d+$/);
    assert.deepEqual(request, {
        jobId: request.jobId,
        targetPrinter: 'Receipt Printer',
        pin: 5,
        reason: 'POS sale finalized',
    });
});

test('POS finalization does not pulse a disabled or unauthorized drawer', async () => {
    const disabled = drawerHarness(configuredSettings({ hardware_service_cash_drawer_enabled: 0 }));
    await assert.rejects(
        disabled.context.openHardwareDrawer(true),
        /Cash drawer is disabled/
    );
    assert.equal(disabled.requests.length, 0);

    const unauthorized = drawerHarness(configuredSettings(), false);
    assert.equal(await unauthorized.context.openHardwareDrawer(false), false);
    assert.equal(unauthorized.requests.length, 0);
});

test('preloaded workstation lookup uses the only configured workstation at this location when machine names differ', () => {
    const context = {
        parse_workstation_settings_bag: workstation => workstation && workstation.settings || {},
        window: {
            __workstationSettings: {
                'SAVED-PC': {
                    machine_name: 'SAVED-PC',
                    location_id: 12,
                    settings: { hardware_service_enabled: 1 },
                },
            },
        },
    };
    vm.createContext(context);
    vm.runInContext('this.findWorkstation = (' + workstationFunction + ');', context);

    assert.equal(context.findWorkstation('SERVICE-PC', 12).machine_name, 'SAVED-PC');
    assert.equal(context.findWorkstation('SERVICE-PC', 13), null);
});

test('preloaded workstation lookup does not guess when multiple workstations share a location', () => {
    const context = {
        parse_workstation_settings_bag: workstation => workstation && workstation.settings || {},
        window: {
            __workstationSettings: {
                'SAVED-PC-1': {
                    machine_name: 'SAVED-PC-1',
                    location_id: 12,
                    settings: { hardware_service_enabled: 1 },
                },
                'SAVED-PC-2': {
                    machine_name: 'SAVED-PC-2',
                    location_id: 12,
                    settings: { hardware_service_enabled: 1 },
                },
            },
        },
    };
    vm.createContext(context);
    vm.runInContext('this.findWorkstation = (' + workstationFunction + ');', context);

    assert.equal(context.findWorkstation('SERVICE-PC', 12), null);
});

test('preloaded workstation lookup ignores non-Hardware-Service workstations at the location', () => {
    const context = {
        parse_workstation_settings_bag: workstation => workstation && workstation.settings || {},
        window: {
            __workstationSettings: {
                'LEGACY-PC': {
                    machine_name: 'LEGACY-PC',
                    location_id: 12,
                    settings: { hardware_service_enabled: 0 },
                },
                'DRAWER-PC': {
                    machine_name: 'DRAWER-PC',
                    location_id: 12,
                    settings: { hardware_service_enabled: 1, hardware_service_cash_drawer_enabled: 1 },
                },
            },
        },
    };
    vm.createContext(context);
    vm.runInContext('this.findWorkstation = (' + workstationFunction + ');', context);

    assert.equal(context.findWorkstation('SERVICE-PC', 12).machine_name, 'DRAWER-PC');
});

test('automatic POS receipt print can pulse the drawer without manual-open permission', async () => {
    const h = harness(configuredSettings(), false);

    await h.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>', {
        automaticDrawer: true,
    });

    const job = JSON.parse(h.requests[0].request.body);
    assert.equal(job.openDrawer, true);
    assert.equal(job.pin, 5);
});

test('receipt print skips its drawer pulse after POS finalization already opened it', async () => {
    const h = harness(configuredSettings());

    await h.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>', {
        skipHardwareServiceDrawer: true,
    });

    const job = JSON.parse(h.requests[0].request.body);
    assert.equal(job.openDrawer, false);
    assert.equal(Object.hasOwn(job, 'pin'), false);
});

test('receipt print discovers the Hardware Service when no port is saved', async () => {
    const h = harness(configuredSettings({ hardware_service_port: 0 }));

    assert.equal(
        await h.context.printHardwareReceipt({ print_title: 'Receipt' }, false, '<p>Receipt</p>'),
        true
    );
    assert.deepEqual(h.discoveredPorts, [true]);
    assert.equal(h.requests[0].port, 18212);
    assert.equal(h.requests[0].url, '/api/print/receipt');
});

test('automatic POS browser fallback suppresses the drawer and service warning', async () => {
    const h = harness({}, true, null);
    h.context.__hardwareServiceDeviceNames = { 18211: 'RETAILMANERP' };
    h.context.window.__workstationSettings = {
        RETAILMANERP: { machine_name: 'RETAILMANERP' },
    };

    assert.equal(
        await h.context.printHardwareReceipt(
            { print_title: 'Receipt' },
            false,
            '<p>Receipt</p>',
            {
                automaticDrawer: true,
                drawerNotOpened: true,
                suppressFallbackWarning: true,
            }
        ),
        false
    );
    assert.equal(h.warnings.length, 0);
});
