const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/pos.js'), 'utf8');
const handlerStart = source.indexOf("$(document).on('submit', '#close_register_form'");
const handlerEnd = source.indexOf("\n$(document).on('click', '#offline_sync_customers'", handlerStart);
assert.notEqual(handlerStart, -1, 'cash register close submit handler should exist');
assert.notEqual(handlerEnd, -1, 'offline sync handler should follow the close submit handler');
const handlerSource = source.slice(handlerStart, handlerEnd);

test('prevents a repeated cash-register close submission', () => {
    const formData = {};
    let submitHandler;
    let buttonsDisabled = false;
    const form = {};
    const document = {};
    const window = {};

    function $(element) {
        if (element === document) {
            return {
                on: (event, selector, handler) => {
                    assert.equal(event, 'submit');
                    assert.equal(selector, '#close_register_form');
                    submitHandler = handler;
                },
            };
        }
        if (element === form) {
            return {
                data: function (key, value) {
                    if (arguments.length === 2) {
                        formData[key] = value;
                        return this;
                    }
                    return formData[key];
                },
                find: selector => {
                    assert.equal(selector, 'button[type="submit"], input[type="submit"]');
                    return {
                        prop: (name, value) => {
                            assert.equal(name, 'disabled');
                            buttonsDisabled = value;
                        },
                    };
                },
            };
        }
        throw new Error('Unexpected jQuery selection');
    }

    vm.runInNewContext(handlerSource, { $, document, window });

    const firstEvent = { preventDefault: () => assert.fail('first submit should proceed') };
    submitHandler.call(form, firstEvent);
    assert.equal(formData['cash-register-submitting'], true);
    assert.equal(buttonsDisabled, true);
    assert.equal(window.__cashRegisterCloseInProgress, true);

    let secondSubmitPrevented = false;
    submitHandler.call(form, { preventDefault: () => { secondSubmitPrevented = true; } });
    assert.equal(secondSubmitPrevented, true);
});
