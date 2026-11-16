const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/common.js'), 'utf8');
const serviceStart = source.indexOf('async function __cash_register_service_print(');
const serviceEnd = source.indexOf('\nasync function __cash_register_browser_print(', serviceStart);
assert.notEqual(serviceStart, -1, 'cash register service print function should exist');
assert.notEqual(serviceEnd, -1, 'cash register browser print function should follow it');
const serviceFunction = source.slice(serviceStart, serviceEnd);
const browserPrintStart = serviceEnd + 1;
const browserPrintEnd = source.indexOf('\nfunction __cash_register_clean_text(', browserPrintStart);
assert.notEqual(browserPrintEnd, -1, 'cash register print helper should follow the browser print function');
const browserPrintFunction = source.slice(browserPrintStart, browserPrintEnd);

function harness({ workstation = null, configured = true, printResponse = { success: true } } = {}) {
    const requests = [];
    const app = {BUSINESS_ID: 99};
    const context = {
        window: {APP: app},
        APP: app,
        base_path: '/pos',
        fetch: async (url, options = {}) => {
            requests.push({url, options});
            if (url.endsWith('/health')) {
                return {ok: true, json: async () => ({service: 'AlUrooj.HardwareService'})};
            }
            if (url.endsWith('/api/auth/handshake')) {
                return {
                    ok: true,
                    json: async () => ({token: 'test-token', deviceName: 'POS-PC', configured}),
                };
            }
            if (url.endsWith('/api/print/receipt')) {
                return {
                    ok: !!printResponse.success,
                    json: async () => printResponse,
                };
            }
            throw new Error('Unexpected request: ' + url);
        },
        $: {
            ajax: async () => ({success: true, data: workstation}),
        },
        __cash_register_print_settings: () => ({location_id: 12, title: 'Cash Register Closing'}),
        __cash_register_html_document: () => '<html>register report</html>',
    };

    vm.runInNewContext(serviceFunction, context);
    return {print: context.__cash_register_service_print, requests};
}

test('uses the service default receipt printer when no workstation entry exists', async () => {
    const h = harness();

    assert.equal(await h.print({}), true);

    const printRequest = h.requests.find(request => request.url.endsWith('/api/print/receipt'));
    const payload = JSON.parse(printRequest.options.body);
    assert.equal('targetPrinter' in payload, false);
    assert.equal(payload.documentTitle, 'Cash Register Closing');
});

test('uses the workstation printer when hardware service is enabled for it', async () => {
    const h = harness({
        workstation: {
            settings: {
                hardware_service_enabled: 1,
                hardware_service_receipt_printer: 'Workstation Receipt Printer',
            },
            pos_printer_name: 'POS Printer',
        },
    });

    assert.equal(await h.print({}), true);

    const printRequest = h.requests.find(request => request.url.endsWith('/api/print/receipt'));
    assert.equal(JSON.parse(printRequest.options.body).targetPrinter, 'Workstation Receipt Printer');
});

test('reports printer-service queue failures instead of falling back silently', async () => {
    const h = harness({printResponse: {success: false, message: 'Printer is offline'}});

    await assert.rejects(h.print({}), /Printer is offline/);
});

test('does not open browser print after a discovered service reports a failure', async () => {
    let browserPrintCount = 0;
    let notifiedError = '';
    const context = {
        window: {
            focus: () => { browserPrintCount++; },
            print: () => { browserPrintCount++; },
        },
        console: {error: () => {}},
        toastr: {error: message => { notifiedError = message; }},
        $: {fn: {}},
        __cash_register_service_print: async () => {
            throw new Error('Printer is offline');
        },
    };

    vm.runInNewContext(browserPrintFunction, context);
    await context.__cash_register_browser_print({});

    assert.equal(notifiedError, 'Printer is offline');
    assert.equal(browserPrintCount, 0);
});
