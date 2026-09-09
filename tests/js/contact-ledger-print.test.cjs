const { test } = require('node:test');
const assert = require('node:assert/strict');
const fs = require('node:fs');
const vm = require('node:vm');
const source = fs.readFileSync(require('node:path').join(__dirname, '../../public/js/contact_ledger_print.js'), 'utf8');

// Model page geometry so pagination can be exercised without a browser session.
function harness(entries, format = 4) {
    let scale = 1;
    const listeners = {};
    class Element {
        constructor(kind, height = 0, id = '') {
            this.kind = kind; this.height = height; this.id = id;
            this.children = []; this.style = {}; this.textContent = '';
            this.classList = { contains: () => false };
        }
        appendChild(child) {
            child.remove(); child.parent = this; this.children.push(child); return child;
        }
        remove() {
            if (this.parent) this.parent.children.splice(this.parent.children.indexOf(this), 1);
            this.parent = null;
        }
        set innerHTML(value) { this.children.forEach(c => { c.parent = null; }); this.children = []; }
        cloneNode() {
            const copy = new Element(this.kind, this.height, this.id);
            copy.textContent = this.textContent;
            this.children.forEach(c => copy.appendChild(c.cloneNode()));
            return copy;
        }
        querySelector(selector) {
            const kind = { '.cr-sheet': 'sheet', '#ledger_table': 'table', '#ledger_table tbody': 'body',
                '.ledger-product-details': 'detail', '.cr-foot span:last-child': 'label',
                '.ledger-format-2-intro': 'intro2', '.ledger-format-2-footer': 'footer2',
                '.ledger-format-4-intro': 'intro', '.ledger-format-4-footer': 'footer',
                '.ledger-format-5-intro': 'intro5', '.ledger-format-5-footer': 'footer5',
                '.ledger-format-6-intro': 'intro6', '.ledger-format-6-footer': 'footer6',
                '#total_footer': 'totals', '#ageing_div': 'ageing', '#cheque_clearance_div': 'clearing',
                '.contact-ledger-html': 'content', '.cr-foot': 'foot' }[selector];
            function find(el) {
                for (const c of el.children) {
                    if (c.kind === kind) return c;
                    const found = find(c); if (found) return found;
                }
                return null;
            }
            return find(this);
        }
        get offsetHeight() { return this.height; }
        getBoundingClientRect() {
            function height(el) {
                return el.height * (el.kind === 'row' ? scale : 1) + el.children.reduce((sum, c) => sum + height(c), 0);
            }
            return { top: 0, bottom: 20 + height(this) };
        }
    }
    const stage = new Element('stage');
    const sheet = stage.appendChild(new Element('sheet'));
    const content = sheet.appendChild(new Element('content'));
    content.appendChild(new Element(format === 4 ? 'intro' : 'intro' + format, 25));
    const body = content.appendChild(new Element('table', 10)).appendChild(new Element('body'));
    entries.forEach((heights, i) => heights.forEach((height, j) => {
        const row = body.appendChild(new Element('row', height, `${i}-${j}`));
        if (j) row.appendChild(new Element('detail'));
    }));
    content.appendChild(new Element(format === 4 ? 'footer' : 'footer' + format, 8));
    if (format === 5 || format === 6) {
        body.parent.appendChild(new Element('totals', 15));
        content.appendChild(new Element('clearing', 20));
        content.appendChild(new Element('ageing', 20));
    }
    sheet.appendChild(new Element('foot', 10)).appendChild(new Element('label')).textContent = 'Page 1 / 1';
    const on = (name, fn) => { (listeners[name] ||= []).push(fn); };
    const dispatch = event => (listeners[event.type] || []).forEach(fn => fn());
    vm.runInNewContext(source, {
        document: { getElementById: () => stage, addEventListener: on, dispatchEvent: dispatch },
        window: { addEventListener: on, getComputedStyle: () => ({ paddingBottom: '10', minHeight: '140' }) },
        Event: class { constructor(type) { this.type = type; } },
    });
    dispatch({ type: 'load' });
    return { stage, resize(value) { scale = value; dispatch({ type: 'cr:font-changed' }); } };
}

test('pagination retains all entries, keeps details with their transaction, and numbers pages', () => {
    const { stage } = harness([[15], [25, 20], [25, 20], [25, 20]]);
    assert.ok(stage.children.length > 1);
    const ids = [];
    stage.children.forEach((sheet, i) => {
        const rows = sheet.querySelector('#ledger_table tbody').children;
        ids.push(...rows.map(r => r.id));
        rows.forEach((row, j) => {
            if (row.querySelector('.ledger-product-details')) assert.equal(rows[j - 1].id.split('-')[0], row.id.split('-')[0]);
        });
        assert.equal(sheet.querySelector('.cr-foot span:last-child').textContent, `Page ${i + 1} / ${stage.children.length}`);
        if (i) assert.equal(sheet.querySelector('.ledger-format-4-intro'), null);
    });
    assert.deepEqual(ids, ['0-0', '1-0', '1-1', '2-0', '2-1', '3-0', '3-1']);
    assert.ok(stage.children.at(-1).querySelector('.ledger-format-4-footer'));
});

test('font changes rebuild from original rows without duplication', () => {
    const h = harness([[15, 10], [15, 10], [15, 10], [15, 10]]);
    const initial = h.stage.children.length;
    h.resize(2);
    assert.ok(h.stage.children.length > initial);
    h.resize(1);
    assert.equal(h.stage.children.length, initial);
    assert.equal(h.stage.children.reduce((n, sheet) => n + sheet.querySelector('#ledger_table tbody').children.length, 0), 8);
});

test('Format 2 paginates invoice rows and keeps the ageing summary/footer once at the end', () => {
    const h = harness([[30], [50], [40], [55]], 2);
    function verify() {
        const pages = h.stage.children;
        assert.ok(pages.length > 1);
        assert.deepEqual(pages.flatMap(page => page.querySelector('#ledger_table tbody').children.map(row => row.id)),
            ['0-0', '1-0', '2-0', '3-0']);
        assert.equal(pages.filter(page => page.querySelector('.ledger-format-2-intro')).length, 1);
        assert.equal(pages.filter(page => page.querySelector('.ledger-format-2-footer')).length, 1);
        assert.ok(pages.at(-1).querySelector('.ledger-format-2-footer'));
        pages.forEach((page, i) => assert.equal(page.querySelector('.cr-foot span:last-child').textContent,
            `Page ${i + 1} / ${pages.length}`));
    }
    verify();
    h.resize(1.5);
    verify();
    h.resize(1);
    verify();
});

test('empty ledgers and oversized entries terminate without losing content', () => {
    assert.equal(harness([]).stage.children.length, 1);
    const { stage } = harness([[200, 50]]);
    const rows = stage.children.flatMap(sheet => sheet.querySelector('#ledger_table tbody').children);
    assert.deepEqual(rows.map(r => r.id), ['0-0', '0-1']);
});

[5, 6].forEach(format => test(`Format ${format} keeps totals and supplementary reports once after the ledger, including after resizing`, () => {
    const h = harness([[30], [50], [40], [55]], format);
    function verify() {
        const pages = h.stage.children;
        const rows = pages.flatMap(page => page.querySelector('#ledger_table tbody')?.children || []);
        assert.deepEqual(rows.map(row => row.id), ['0-0', '1-0', '2-0', '3-0']);
        for (const selector of ['#total_footer', `.ledger-format-${format}-footer`, '#ageing_div', '#cheque_clearance_div']) {
            assert.equal(pages.filter(page => page.querySelector(selector)).length, 1);
        }
        assert.ok(pages.at(-2).querySelector('#cheque_clearance_div'));
        assert.ok(pages.at(-1).querySelector('#ageing_div'));
        const ledgerPages = pages.filter(page => page.querySelector('#ledger_table'));
        assert.ok(ledgerPages.at(-1).querySelector('#total_footer'));
        pages.slice(1).forEach(page => assert.equal(page.querySelector(`.ledger-format-${format}-intro`), null));
    }
    verify();
    h.resize(1.5);
    verify();
}));
