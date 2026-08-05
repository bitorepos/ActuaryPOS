<style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body {
        font-family: Arial, Helvetica, sans-serif;
        color: #1a1a1a;
        background: #525659;
    }

    /* ===== Toolbar ===== */
    .cr-toolbar {
        position: fixed;
        top: 0; left: 0; right: 0;
        height: 48px;
        background: #323639;
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 0 14px;
        z-index: 1000;
        box-shadow: 0 1px 6px rgba(0,0,0,.4);
        color: #fff;
        flex-wrap: nowrap;
        overflow-x: auto;
    }
    .cr-toolbar .cr-title {
        font-size: 13px;
        font-weight: 700;
        margin-right: auto;
        white-space: nowrap;
        letter-spacing: .02em;
    }
    .cr-group {
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 0 8px;
        border-left: 1px solid #50545a;
        height: 30px;
    }
    .cr-group:first-of-type { border-left: 0; }
    .cr-btn {
        background: #4a4f54;
        color: #fff;
        border: 0;
        border-radius: 4px;
        padding: 6px 10px;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        white-space: nowrap;
        transition: background .15s;
        text-decoration: none;
    }
    .cr-btn:hover { background: #5d636a; color: #fff; }
    .cr-btn.primary { background: #1a73e8; }
    .cr-btn.primary:hover { background: #2b7de9; }
    .cr-btn.success { background: #188038; }
    .cr-btn.success:hover { background: #1e9e45; }
    .cr-btn.danger { background: #b3261e; }
    .cr-btn.danger:hover { background: #c5362d; }
    .cr-iconbtn {
        width: 30px;
        height: 30px;
        justify-content: center;
        padding: 0;
        font-size: 15px;
        font-weight: 700;
    }
    .cr-zoom-label, .cr-page-label {
        font-size: 12px;
        min-width: 54px;
        text-align: center;
        font-variant-numeric: tabular-nums;
    }
    .cr-page-input {
        width: 42px;
        text-align: center;
        border: 0;
        border-radius: 3px;
        padding: 4px 2px;
        font-size: 12px;
    }

    /* ===== Stage ===== */
    .cr-stage {
        margin-top: 48px;
        padding: 24px 0 60px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 22px;
    }

    /* ===== A4 Sheet ===== */
    .cr-sheet {
        background: #fff;
        width: <?php echo e($sheet_width, false); ?>;
        min-height: <?php echo e($sheet_min_height, false); ?>;
        padding: 12mm 10mm;
        box-shadow: 0 2px 10px rgba(0,0,0,.45);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    /* ===== Brand Header ===== */
    .cr-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 2.5px solid #1a1a1a;
        padding-bottom: 8px;
        margin-bottom: 8px;
    }
    .cr-head-left { display: flex; align-items: center; gap: 12px; }
    .cr-logo { max-height: 56px; max-width: 150px; object-fit: contain; }
    .cr-biz-name { font-size: 17pt; font-weight: 800; line-height: 1.1; }
    .cr-biz-loc { font-size: 9.5pt; color: #444; margin-top: 2px; }
    .cr-head-right { text-align: right; }
    .cr-report-title {
        font-size: 15pt;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .05em;
    }
    .cr-report-sub { font-size: 9pt; color: #444; margin-top: 3px; }

    /* ===== Filters strip ===== */
    .cr-filters {
        font-size: 8.5pt;
        color: #333;
        margin-bottom: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 4px 16px;
    }
    .cr-filters .f-item b { color: #000; }

    /* ===== Section title (category / group) ===== */
    .cr-group-title {
        font-size: 11pt;
        font-weight: 800;
        background: #1a1a1a;
        color: #fff;
        padding: 5px 8px;
        margin: 10px 0 0;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .cr-subgroup-title {
        font-size: 9.5pt;
        font-weight: 700;
        color: #333;
        padding: 6px 2px 3px;
    }

    /* ===== Table ===== */
    .cr-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 8.3pt;
    }
    .cr-table thead th {
        background: #1a1a1a;
        color: #fff;
        font-size: 7.6pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .02em;
        padding: 5px 5px;
        border: 1px solid #1a1a1a;
        text-align: left;
        white-space: nowrap;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .cr-table thead th.r { text-align: right; }
    .cr-table thead th.c { text-align: center; }
    .cr-table tbody td {
        padding: 4px 5px;
        border: 1px solid #d2d2d2;
        vertical-align: top;
    }
    .cr-table tbody td.r { text-align: right; white-space: nowrap; }
    .cr-table tbody td.c { text-align: center; }
    .cr-table tbody tr:nth-child(even) td {
        background: #f4f4f4;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .cr-prod-name { font-weight: 600; }
    .cr-sub { color: #666; font-size: 7.4pt; }
    .cr-table tfoot td {
        padding: 6px 5px;
        border-top: 2px solid #1a1a1a;
        font-weight: 800;
        font-size: 8.5pt;
        background: #eaeaea;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .cr-table tfoot td.r { text-align: right; white-space: nowrap; }
    .cr-qty-chip {
        display: inline-block;
        margin: 1px 4px 1px 0;
        white-space: nowrap;
    }

    /* ===== Grand total sheet ===== */
    .cr-grand {
        margin-top: 8px;
        border: 2px solid #1a1a1a;
        padding: 10px 12px;
        background: #f4f8ff;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .cr-grand h3 {
        font-size: 12pt;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .cr-grand-row {
        display: flex;
        justify-content: space-between;
        font-size: 10pt;
        padding: 3px 0;
        border-bottom: 1px dashed #bbb;
    }
    .cr-grand-row:last-child { border-bottom: 0; }
    .cr-grand-row b { font-weight: 800; }

    /* ===== Sheet footer ===== */
    .cr-foot {
        margin-top: auto;
        padding-top: 8px;
        border-top: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
        font-size: 8pt;
        color: #555;
    }
    .cr-empty {
        text-align: center;
        padding: 40px 0;
        font-size: 12pt;
        color: #888;
    }

    /* ===== DomPDF export ===== */
    <?php if(! empty($is_pdf)): ?>
    @page { size: <?php echo e($page_size, false); ?>; margin: 0; }
    html,
    body {
        background: #fff !important;
        margin: 0;
    }
    .cr-stage {
        display: block;
        gap: 0;
        margin: 0;
        padding: 0;
    }
    .cr-sheet {
        box-shadow: none;
        display: block;
        margin: 0;
        min-height: auto;
        padding: 9mm 10mm;
        page-break-after: always;
        width: auto;
    }
    .cr-sheet:last-child {
        page-break-after: auto;
    }
    .cr-head {
        display: table;
        table-layout: fixed;
        width: 100%;
    }
    .cr-head-left {
        display: table-cell;
        vertical-align: top;
        width: 42%;
    }
    .cr-head-left > div {
        display: inline-block;
        vertical-align: middle;
    }
    .cr-logo {
        margin-right: 8px;
        vertical-align: middle;
    }
    .cr-head-right {
        display: table-cell;
        overflow-wrap: break-word;
        text-align: right;
        vertical-align: top;
        width: 58%;
    }
    .cr-report-title {
        font-size: 13pt;
        letter-spacing: .02em;
    }
    .cr-report-sub {
        font-size: 8pt;
    }
    .cr-foot {
        display: block;
        margin-top: 8px;
        width: 100%;
    }
    .cr-foot span:first-child {
        display: inline-block;
        width: 60%;
    }
    .cr-foot span:last-child {
        display: inline-block;
        text-align: right;
        width: 38%;
    }
    <?php endif; ?>

    /* ===== Print ===== */
    @media print {
        @page { size: <?php echo e($page_size, false); ?>; margin: 8mm; }
        html, body { background: #fff !important; }
        .cr-toolbar { display: none !important; }
        .cr-stage { margin: 0; padding: 0; gap: 0; }
        .cr-sheet {
            width: auto;
            min-height: auto;
            box-shadow: none;
            padding: 0;
            page-break-after: always;
        }
        .cr-sheet:last-child { page-break-after: auto; }
    }
</style>
