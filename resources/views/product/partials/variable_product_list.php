<style>
    .variable-showcase-shell {
        position: relative;
        border-radius: 24px;
        padding: 24px;
        background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
        border: 1px solid rgba(24, 66, 117, 0.08);
        box-shadow: 0 18px 45px rgba(19, 57, 98, 0.08);
        overflow: visible;
    }
    .variable-showcase-shell::before,
    .variable-showcase-shell::after {
        content: '';
        position: absolute;
        border-radius: 999px;
        pointer-events: none;
        opacity: .5;
    }
    .variable-showcase-shell::before {
        width: 280px;
        height: 280px;
        top: -120px;
        right: -80px;
        background: radial-gradient(circle, rgba(80, 140, 255, 0.18) 0%, rgba(80, 140, 255, 0) 72%);
    }
    .variable-showcase-shell::after {
        width: 220px;
        height: 220px;
        bottom: -90px;
        left: -70px;
        background: radial-gradient(circle, rgba(37, 187, 135, 0.12) 0%, rgba(37, 187, 135, 0) 75%);
    }
    .variable-showcase-header {
        position: relative;
        z-index: 1;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 18px;
    }
    .variable-showcase-title-block {
        max-width: 560px;
    }
    .variable-showcase-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #0e5fd8;
        background: rgba(14, 95, 216, 0.1);
    }
    .variable-showcase-heading {
        margin: 10px 0 6px;
        font-size: 28px;
        font-weight: 700;
        color: #17324d;
    }
    .variable-showcase-description {
        margin: 0;
        color: #61748a;
        font-size: 14px;
        line-height: 1.6;
    }
    .variable-showcase-toolbar {
        position: relative;
        z-index: 1;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 14px;
        margin-bottom: 18px;
    }
    .variable-showcase-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }
    .variable-showcase-search {
        min-width: 260px;
        max-width: 320px;
    }
    .variable-showcase-search .form-control {
        height: 44px;
        border-radius: 14px;
        border: 1px solid rgba(24, 66, 117, 0.14);
        background: rgba(255, 255, 255, 0.92);
        box-shadow: none;
    }
    .variable-showcase-metrics {
        position: relative;
        z-index: 1;
        margin-bottom: 18px;
    }
    .variable-showcase-metric {
        border: 1px solid rgba(24, 66, 117, 0.08);
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.86);
        box-shadow: 0 10px 24px rgba(19, 57, 98, 0.06);
        height: 100%;
    }
    .variable-showcase-metric .card-body {
        padding: 18px;
    }
    .variable-showcase-metric-label {
        color: #708399;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 8px;
    }
    .variable-showcase-metric-value {
        color: #17324d;
        font-size: 28px;
        font-weight: 700;
        line-height: 1;
    }
    .variable-showcase-metric-note {
        margin-top: 10px;
        color: #5a6b7d;
        font-size: 13px;
    }
    .variable-showcase-grid-item {
        position: relative;
    }
    .variable-showcase-card {
        position: relative;
        z-index: 1;
        height: 100%;
        border: 1px solid rgba(24, 66, 117, 0.1);
        border-radius: 24px;
        overflow: visible;
        background: linear-gradient(180deg, #ffffff 0%, #fcfdff 100%);
        box-shadow: 0 16px 36px rgba(19, 57, 98, 0.08);
        transition: transform .22s ease, box-shadow .22s ease, border-color .22s ease;
    }
    .variable-showcase-card:hover,
    .variable-showcase-card:focus-within {
        transform: translateY(-6px);
        border-color: rgba(14, 95, 216, 0.18);
        box-shadow: 0 20px 44px rgba(19, 57, 98, 0.14);
        z-index: 30;
    }
    .variable-showcase-image-wrap {
        position: relative;
        height: 220px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 24px 24px 0 0;
        background:
            radial-gradient(circle at top left, rgba(119, 179, 255, 0.35), rgba(119, 179, 255, 0) 42%),
            linear-gradient(150deg, #edf4ff 0%, #f9fbff 46%, #fff4eb 100%);
    }
    .variable-showcase-image-wrap::after {
        content: '';
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.55);
        filter: blur(14px);
        bottom: -70px;
        right: -40px;
    }
    .variable-showcase-image-wrap img {
        position: relative;
        z-index: 1;
        max-height: 180px;
        max-width: 86%;
        object-fit: contain;
        filter: drop-shadow(0 16px 22px rgba(15, 47, 82, 0.18));
    }
    .variable-showcase-card-body {
        padding: 18px 18px 20px;
    }
    .variable-showcase-card-top {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }
    .variable-showcase-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(37, 187, 135, 0.12);
        color: #10875a;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
    }
    .variable-showcase-badge::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: currentColor;
    }
    .variable-showcase-var-count {
        display: inline-flex;
        align-items: center;
        padding: 4px 10px;
        border-radius: 999px;
        background: rgba(47, 128, 237, 0.12);
        color: #1a5fb4;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .04em;
    }
    .variable-showcase-card .btn-group,
    .variable-showcase-card .dropdown,
    .variable-showcase-action-wrap {
        position: relative;
    }
    .variable-showcase-action-wrap .btn {
        border-radius: 12px;
        border: 0;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 10px 18px rgba(31, 139, 95, 0.18);
    }
    .variable-showcase-action-wrap .btn-info {
        background: linear-gradient(135deg, #58c1dd 0%, #2ea3cd 100%);
        color: #fff;
    }
    .variable-showcase-action-wrap .dropdown-menu {
        border: 1px solid rgba(24, 66, 117, 0.1);
        border-radius: 16px;
        box-shadow: 0 22px 36px rgba(19, 57, 98, 0.18);
        padding: 8px 0;
        z-index: 1085;
    }
    .variable-showcase-action-wrap .dropdown-item {
        padding-top: 9px;
        padding-bottom: 9px;
    }
    .variable-showcase-sku {
        margin-bottom: 10px;
        color: #6f8092;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .03em;
    }
    .variable-showcase-title {
        margin: 0;
        color: #172f49;
        font-size: 22px;
        line-height: 1.25;
        font-weight: 700;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
        overflow: hidden;
        min-height: 54px;
    }
    .variable-showcase-subtitle {
        margin: 8px 0 0;
        color: #73879d;
        font-size: 13px;
        line-height: 1.5;
        min-height: 38px;
    }
    .variable-showcase-swatch-section,
    .variable-showcase-token-section {
        margin-top: 16px;
    }
    .variable-showcase-section-label {
        margin-bottom: 8px;
        color: #6f8092;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }
    .variable-showcase-swatches,
    .variable-showcase-tokens {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .variable-showcase-swatch {
        position: relative;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.95);
        box-shadow: 0 0 0 1px rgba(24, 66, 117, 0.18), 0 6px 12px rgba(19, 57, 98, 0.12);
    }
    .variable-showcase-swatch::after {
        content: attr(data-label);
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: calc(100% + 8px);
        padding: 4px 8px;
        border-radius: 8px;
        background: #17324d;
        color: #fff;
        font-size: 11px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity .16s ease;
        pointer-events: none;
    }
    .variable-showcase-swatch:hover::after {
        opacity: 1;
        visibility: visible;
    }
    .variable-showcase-token {
        display: inline-flex;
        align-items: center;
        min-height: 30px;
        padding: 6px 12px;
        border-radius: 999px;
        background: #eef5ff;
        color: #1556bd;
        border: 1px solid #d7e6ff;
        font-size: 12px;
        font-weight: 700;
    }
    .variable-showcase-meta-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 14px;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid rgba(24, 66, 117, 0.08);
    }
    .variable-showcase-meta-card {
        min-width: 0;
    }
    .variable-showcase-meta-label {
        color: #7b8b9b;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .06em;
        margin-bottom: 4px;
    }
    .variable-showcase-meta-value {
        color: #20364e;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .variable-showcase-footer {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 12px;
        margin-top: 18px;
    }
    .variable-showcase-price {
        color: #0f8b5f;
        font-weight: 800;
        font-size: 28px;
        line-height: 1;
    }
    .variable-showcase-price-note {
        margin-top: 4px;
        color: #708399;
        font-size: 12px;
    }
    .variable-showcase-stock {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 999px;
        background: #f7fafc;
        border: 1px solid rgba(24, 66, 117, 0.08);
        color: #17324d;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }
    .variable-showcase-stock::before {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #21b77a;
        box-shadow: 0 0 0 4px rgba(33, 183, 122, 0.12);
    }
    .variable-showcase-empty {
        position: relative;
        z-index: 1;
        border-radius: 18px;
        padding: 18px 20px;
        border: 1px dashed rgba(24, 66, 117, 0.18);
        background: rgba(255, 255, 255, 0.85);
        color: #63768c;
    }
    @media (max-width: 767.98px) {
        .variable-showcase-shell {
            padding: 18px;
            border-radius: 18px;
        }
        .variable-showcase-heading {
            font-size: 24px;
        }
        .variable-showcase-toolbar,
        .variable-showcase-header {
            flex-direction: column;
            align-items: stretch;
        }
        .variable-showcase-search {
            min-width: 100%;
            max-width: 100%;
        }
        .variable-showcase-image-wrap {
            height: 200px;
        }
        .variable-showcase-title {
            font-size: 18px;
            min-height: auto;
        }
        .variable-showcase-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="variable-showcase-shell">
    <div class="variable-showcase-header">
        <div class="variable-showcase-title-block">
            <span class="variable-showcase-kicker">Variable catalog cards</span>
            <h3 class="variable-showcase-heading">Products Card</h3>
            <p class="variable-showcase-description">A storefront-style view for variable products with bigger imagery, color swatches, size options, quick actions, and the same filters from the products list.</p>
        </div>
        <div class="variable-showcase-search">
            <label class="text-muted small mb-1" for="variable_showcase_search">Search SKU or Name</label>
            <input type="text" class="form-control" id="variable_showcase_search" placeholder="Search by product, variation, or SKU...">
        </div>
    </div>

    <div class="row variable-showcase-metrics">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card variable-showcase-metric">
                <div class="card-body">
                    <div class="variable-showcase-metric-label">Filtered variations</div>
                    <div class="variable-showcase-metric-value" id="variable_total_variations">0</div>
                    <div class="variable-showcase-metric-note">Total variable entries matching the current filter set.</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card variable-showcase-metric">
                <div class="card-body">
                    <div class="variable-showcase-metric-label">Visible cards</div>
                    <div class="variable-showcase-metric-value" id="variable_visible_rows">0</div>
                    <div class="variable-showcase-metric-note">Cards loaded on the current page of the showcase.</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-3">
            <div class="card variable-showcase-metric">
                <div class="card-body">
                    <div class="variable-showcase-metric-label">Display mode</div>
                    <div class="variable-showcase-metric-value">Variable only</div>
                    <div class="variable-showcase-metric-note">Uses the same product index filters while keeping the dataset restricted to variable products.</div>
                </div>
            </div>
        </div>
    </div>

    <div class="variable-showcase-toolbar">
        <div class="variable-showcase-actions">
            <a class="btn btn-info" href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadVariableExcel']), false); ?>">
                <i class="fa fa-download"></i> Download Variable Products
            </a>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-outline-secondary btn-sm" id="variable_showcase_prev">Prev</button>
            <span class="small text-muted" id="variable_showcase_page_info">Page 1</span>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="variable_showcase_next">Next</button>
        </div>
    </div>

    <div id="variable_showcase_loading" class="text-center py-4 d-none">
        <i class="fa fa-spinner fa-spin"></i> Loading variable products...
    </div>

    <div class="row" id="variable_showcase_grid"></div>

    <div id="variable_showcase_empty" class="variable-showcase-empty d-none mt-3">
        No variable products found for current filters.
    </div>
</div>
