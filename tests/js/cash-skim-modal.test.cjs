const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8').replace(/\r\n/g, '\n');
const handlerStart = source.indexOf("$(document).on('click', '#open_cash_pull_modal', function () {");
const handlerEnd = source.indexOf('\n});\n\nfunction load_quick_menu', handlerStart) + 3;
const handler = source.slice(handlerStart, handlerEnd);

function openCashSkimModal(warningInterval) {
    let clickHandler;
    let modalOptions;
    const document = 'document';
    const $ = selector => {
        if (selector === document) {
            return {
                on: (event, delegatedSelector, callback) => {
                    if (event === 'click') {
                        clickHandler = callback;
                    }
                },
            };
        }

        return {
            val: () => selector === 'input#cash_pull_warn_interval' ? warningInterval : undefined,
        };
    };
    $.ajax = () => {};

    const context = {
        document,
        $,
        swal: options => {
            modalOptions = options;
            return { then: () => {} };
        },
        cash_skim_swal_open: false,
        toastr: { error: () => {} },
        console,
    };
    vm.createContext(context);
    vm.runInContext(handler, context);
    clickHandler();

    return modalOptions;
}

test('manually opened cash skim modal shows Cancel when the warning interval is zero', () => {
    const modal = openCashSkimModal('0');

    assert.equal(modal.buttons.close.text, 'Cancel');
    assert.equal(modal.buttons.close.value, 'close');
    assert.equal(modal.buttons.close.closeModal, true);
    assert.equal(modal.closeOnClickOutside, false);
    assert.equal(modal.closeOnEsc, false);
});

test('manually opened cash skim modal keeps its existing dismiss behavior with a warning interval', () => {
    const modal = openCashSkimModal('5');

    assert.equal(modal.buttons.close.text, 'Cancel');
    assert.equal(modal.closeOnClickOutside, true);
    assert.equal(modal.closeOnEsc, true);
});
