const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const path = require('node:path');
const source = fs.readFileSync(path.join(__dirname, '../../resources/views/report/partials/crystal_report_scripts.blade.php'), 'utf8')
    .split('<script>')[1].split('</script>')[0];

test('font controls send the current offset to PDF and preserve export filters', () => {
    const elements = {};
    const element = id => elements[id] ||= { style: {}, addEventListener(name, fn) { this[name] = fn; } };
    element('crPdfExport').href = 'http://localhost/contacts/4560/print?output=pdf&format=format_2&show_paid=false&orientation=portrait';
    vm.runInNewContext(source, {
        URL, Event: class {},
        document: { getElementById: element, querySelectorAll: () => [], addEventListener() {}, dispatchEvent() {},
            documentElement: { style: { setProperty() {} } } },
        window: { location: { href: 'http://localhost/contacts/4560/print?font_offset=2' }, addEventListener() {} },
    });
    const offset = () => new URL(element('crPdfExport').href).searchParams.get('font_offset');
    assert.equal(offset(), '2');
    element('fontSizeInc').click();
    assert.equal(offset(), '3');
    element('fontSizeDec').click();
    assert.equal(offset(), '2');
    for (let i = 0; i < 30; i++) element('fontSizeInc').click();
    assert.equal(offset(), '12');
    for (let i = 0; i < 30; i++) element('fontSizeDec').click();
    assert.equal(offset(), '-6');
    element('fontSizeReset').click();
    assert.equal(offset(), '0');
    const params = new URL(element('crPdfExport').href).searchParams;
    assert.equal(params.get('output'), 'pdf');
    assert.equal(params.get('format'), 'format_2');
    assert.equal(params.get('show_paid'), 'false');
    assert.equal(params.get('orientation'), 'portrait');
    assert.equal(params.getAll('font_offset').length, 1);
});
