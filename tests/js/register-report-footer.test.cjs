const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const path = require('node:path');
const vm = require('node:vm');

const source = fs.readFileSync(path.join(__dirname, '../../public/js/report.js'), 'utf8').replace(/\r\n/g, '\n');
const helperStart = source.indexOf('    function getRegisterReportFooterValue(value) {');
const helperEnd = source.indexOf('\n    //Register report', helperStart);
const helper = source.slice(helperStart, helperEnd);

function getFooterValue(value) {
    const $ = input => ({
        attr: name => {
            const match = String(input).match(new RegExp(name + '="([^"]*)"'));
            return match ? match[1] : undefined;
        },
    });
    const context = { $, Number };
    vm.createContext(context);
    vm.runInContext(helper, context);
    context.input = value;
    return vm.runInContext('getRegisterReportFooterValue(input);', context);
}

test('register report footer totals accept numeric values and data-orig-value markup', () => {
    assert.equal(getFooterValue(125.5), 125.5);
    assert.equal(getFooterValue('125.50'), 125.5);
    assert.equal(getFooterValue('<span data-orig-value="125.50">125.50</span>'), 125.5);
    assert.equal(getFooterValue(''), 0);
    assert.equal(getFooterValue(null), 0);
});
