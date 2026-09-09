const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const source = fs.readFileSync(require('node:path').join(__dirname, '../../public/js/pos.js'), 'utf8');
function harness() {
    const requests = [];
    const context = { pos_product_search_request: null, pos_search_box_speed: 300 };
    context.$ = () => ({ length: 1, val: () => '1', each() {} });
    context.$.getJSON = (url, data, response) => {
        let failed;
        const xhr = {
            url, data, aborted: false,
            abort() { this.aborted = true; failed(); },
            fail(fn) { failed = fn; return this; },
            reject() { failed(); },
            resolve: response,
        };
        requests.push(xhr);
        return xhr;
    };
    const start = source.indexOf('source: function (request, response)', source.indexOf('var pos_product_search_request'));
    const end = source.indexOf('minLength: 2', start);
    const fn = source.slice(start + 'source: '.length, end).trim().replace(/,$/, '');
    vm.createContext(context);
    vm.runInContext('var search = ' + fn, context);
    return { context, requests };
}
test('new product search cancels the preceding request and settles its callback', () => {
    const h = harness();
    let settled = 0;
    h.context.search({ term: 'sw' }, rows => { assert.equal(rows.length, 0); settled++; });
    let result;
    h.context.search({ term: 'sweet' }, rows => { result = rows; });
    assert.equal(h.requests[0].aborted, true);
    assert.equal(settled, 1);
    assert.equal(h.requests[1].data.term, 'sweet');
    h.requests[1].resolve([{ variation_id: 5 }]);
    assert.equal(result[0].variation_id, 5);
});
test('failed product search settles autocomplete instead of leaving it pending', () => {
    const h = harness();
    let settled = 0;
    h.context.search({ term: 'sweet' }, rows => { assert.equal(rows.length, 0); settled++; });
    h.requests[0].reject();
    assert.equal(settled, 1);
});
