
<style>
    /* === Stock Transfer Print Styles (st- prefix) === */
    .st-page *, .st-page *::before, .st-page *::after { box-sizing: border-box; }

    /* === Document Header === */
    .st-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 2.5px solid #000;
        padding-bottom: 10px;
        margin-bottom: 14px;
    }
    .st-header-biz-name {
        font-size: 15pt;
        font-weight: 700;
        line-height: 1.2;
    }
    .st-header-biz-addr {
        font-size: 9.5pt;
        color: #444;
        margin-top: 3px;
    }
    .st-header-right { text-align: right; }
    .st-header-title {
        font-size: 17pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        line-height: 1.1;
    }
    .st-header-sub { font-size: 10pt; margin-top: 4px; }

    /* === Location Summary Row === */
    .st-summary {
        display: flex;
        gap: 20px;
        margin: 12px 0 14px;
        border-top: 1px solid #bbb;
        border-bottom: 1px solid #bbb;
        padding: 8px 0;
    }
    .st-summary-item { flex: 1; font-size: 10.5pt; }
    .st-summary-label {
        font-weight: 700;
        display: block;
        font-size: 9pt;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #444;
        margin-bottom: 2px;
    }

    /* === Section Title === */
    .st-section-title {
        font-size: 9.5pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        border-bottom: 1.5px solid #000;
        padding-bottom: 4px;
        margin: 16px 0 8px;
    }

    /* === Products Table === */
    .st-table {
        width: 100%;
        border-collapse: collapse;
    }
    .st-table thead tr th {
        font-size: 9pt !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: .03em;
        background: #000 !important;
        color: #fff !important;
        padding: 5px 6px !important;
        border: 1px solid #000 !important;
        text-align: left;
        white-space: nowrap;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .st-table thead tr th.r { text-align: right; }
    .st-table tbody tr td {
        font-size: 10pt;
        padding: 5px 6px;
        border: 1px solid #ccc;
        vertical-align: top;
    }
    .st-table tbody tr:nth-child(even) td {
        background: #f2f2f2 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .st-table td.r { text-align: right; }
    .st-table .hide { display: none !important; }
    .st-table tfoot tr td {
        font-size: 10.5pt;
        font-weight: 700;
        padding: 6px 6px;
        border-top: 2px solid #000;
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        background: #fff;
    }
    .st-table tfoot tr td.r { text-align: right; }

    /* === Notes === */
    .st-notes {
        font-size: 10.5pt;
        line-height: 1.6;
        margin-top: 6px;
    }

    /* === Signatures === */
    .st-sig-wrap {
        display: flex;
        gap: 0;
        margin-top: 36px;
    }
    .st-sig-col {
        flex: 1;
        text-align: center;
        padding: 0 16px;
    }
    .st-sig-line {
        border-top: 1px solid #000;
        padding-top: 6px;
        margin-top: 44px;
        font-size: 10pt;
        font-weight: 700;
    }

    /* === Footer === */
    .st-footer {
        border-top: 1px solid #ccc;
        margin-top: 20px;
        padding-top: 6px;
        font-size: 9pt;
        color: #444;
        display: flex;
        justify-content: space-between;
    }

    /* === Print Media === */
    @media print {
        .st-table thead tr th,
        .st-table tbody tr:nth-child(even) td,
        .st-table .rp-group-row td {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<?php
    $is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
    $hide_brand = (empty($user_settings['stock_transfer_show_brand_column']) || empty(session('business.enable_brand'))) ? true : false;
    $hide_category = (empty($user_settings['stock_transfer_show_category_column']) || empty(session('business.enable_category'))) ? true : false;
    $hide_price = (empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) ? true : false;
    $total = 0.00;
    $business_name = session('business.name', config('app.name'));
    $loc_sell = $location_details['sell'];
    $loc_buy  = $location_details['purchase'];
?>


<div class="st-header">
    <div>
        <div class="st-header-biz-name"><?php echo e($business_name, false); ?></div>
        <?php if(!empty($loc_sell->landmark)): ?>
            <div class="st-header-biz-addr"><?php echo e($loc_sell->landmark, false); ?></div>
        <?php endif; ?>
    </div>
    <div class="st-header-right">
        <div class="st-header-title"><?php echo app('translator')->get('lang_v1.stock_transfers'); ?></div>
        <div class="st-header-sub"><?php echo e(\Carbon\Carbon::parse($sell_transfer->transaction_date)->format('d/m/Y H:i'), false); ?></div>
    </div>
</div>


<div class="st-summary">
    <div class="st-summary-item">
        <span class="st-summary-label"><?php echo app('translator')->get('lang_v1.location_from'); ?></span>
        <strong><?php echo e($loc_sell->name, false); ?></strong>
        <?php if(!empty($loc_sell->city)): ?>
            <br><small><?php echo e(implode(', ', array_filter([$loc_sell->city, $loc_sell->state, $loc_sell->country])), false); ?></small>
        <?php endif; ?>
        <?php if(!empty($loc_sell->mobile)): ?>
            <br><small><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($loc_sell->mobile, false); ?></small>
        <?php endif; ?>
    </div>
    <div class="st-summary-item">
        <span class="st-summary-label"><?php echo app('translator')->get('lang_v1.location_to'); ?></span>
        <strong><?php echo e($loc_buy->name, false); ?></strong>
        <?php if(!empty($loc_buy->city)): ?>
            <br><small><?php echo e(implode(', ', array_filter([$loc_buy->city, $loc_buy->state, $loc_buy->country])), false); ?></small>
        <?php endif; ?>
        <?php if(!empty($loc_buy->mobile)): ?>
            <br><small><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($loc_buy->mobile, false); ?></small>
        <?php endif; ?>
    </div>
    <div class="st-summary-item">
        <span class="st-summary-label"><?php echo app('translator')->get('purchase.ref_no'); ?></span>
        <?php echo e($sell_transfer->ref_no, false); ?><br>
        <?php if(!empty($common_settings['enable_stock_issue_receive'])): ?>
            <small><?php echo e(($sell_transfer->sub_type == 'stock_issue') ? 'Stock Issue Note' : 'Stock Receive Note', false); ?></small><br>
            <?php if(!empty($sell_transfer->stock_category)): ?>
                <small><?php echo app('translator')->get('product.category'); ?>: <?php echo e($sell_transfer->stock_category->name, false); ?></small>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>


<div class="st-section-title"><?php echo app('translator')->get('sale.products'); ?></div>
<table class="st-table">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo app('translator')->get('sale.product'); ?></th>
            <?php if(!$hide_brand): ?><th><?php echo app('translator')->get('product.brand'); ?></th><?php endif; ?>
            <?php if(!$hide_category): ?><th><?php echo app('translator')->get('product.category'); ?></th><?php endif; ?>
            <th class="r"><?php echo app('translator')->get('sale.qty'); ?></th>
            <?php if(!$hide_price): ?><th class="r"><?php echo app('translator')->get('sale.subtotal'); ?></th><?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $sell_transfer->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $line_total = $sell_line->unit_price_inc_tax * $sell_line->quantity;
            $total += $line_total;
        ?>
        <tr>
            <td><?php echo e($loop->iteration, false); ?></td>
            <td>
                <?php echo e($sell_line->product->name, false); ?>

                <?php if($sell_line->product->type == 'variable'): ?>
                    &mdash; <?php echo e($sell_line->variations->product_variation->name, false); ?> &mdash; <?php echo e($sell_line->variations->name, false); ?>

                <?php endif; ?>
                &mdash; <?php echo e($sell_line->variations->sub_sku, false); ?>

                <?php if($lot_n_exp_enabled && !empty($sell_line->lot_details)): ?>
                    <br><small><strong><?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?>:</strong>
                    <?php if(!empty($sell_line->lot_details->lot_number)): ?> <?php echo e($sell_line->lot_details->lot_number, false); ?> <?php endif; ?>
                    <?php if(!empty($sell_line->lot_details->exp_date)): ?> &mdash; <?php echo e(\Carbon\Carbon::parse($sell_line->lot_details->exp_date)->format('d/m/Y'), false); ?> <?php endif; ?>
                    </small>
                <?php endif; ?>
                <?php
                    $rackDetails = !empty($sell_line->product->rack_details) ? json_decode($sell_line->product->rack_details, true) : [];
                    $locationId = $loc_sell->id;
                    $filtered = collect($rackDetails)->firstWhere('location_id', $locationId);
                ?>
                <?php if(!empty($filtered)): ?>
                    <br><small>
                    <?php if(session('business.enable_racks') == 1 && !empty($filtered['rack'])): ?> <?php echo e($filtered['rack'], false); ?> <?php endif; ?>
                    <?php if(session('business.enable_row') == 1 && !empty($filtered['row'])): ?> &mdash; <?php echo e($filtered['row'], false); ?> <?php endif; ?>
                    <?php if(session('business.enable_position') == 1 && !empty($filtered['position'])): ?> &mdash; <?php echo e($filtered['position'], false); ?> <?php endif; ?>
                    </small>
                <?php endif; ?>
            </td>
            <?php if(!$hide_brand): ?><td><?php echo e($sell_line->product->brand->name ?? '', false); ?></td><?php endif; ?>
            <?php if(!$hide_category): ?><td><?php echo e($sell_line->product->category->name ?? '', false); ?></td><?php endif; ?>
            <td class="r"><?php echo e(number_format($sell_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($sell_line->product->unit->short_name ?? '', false); ?></td>
            <?php if(!$hide_price): ?>
            <td class="r"><span class="display_currency" data-currency_symbol="true"><?php echo e($line_total, false); ?></span></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <?php if(!$hide_price): ?>
    <tfoot>
        <tr>
            <td colspan="<?php echo e(2 + (!$hide_brand ? 1 : 0) + (!$hide_category ? 1 : 0) + 1, false); ?>" class="r"><?php echo app('translator')->get('purchase.net_total_amount'); ?>:</td>
            <td class="r"><span class="display_currency" data-currency_symbol="true"><?php echo e($total, false); ?></span></td>
        </tr>
        <?php if(!empty($sell_transfer->shipping_charges)): ?>
        <tr>
            <td colspan="<?php echo e(2 + (!$hide_brand ? 1 : 0) + (!$hide_category ? 1 : 0) + 1, false); ?>" class="r"><?php echo app('translator')->get('purchase.additional_shipping_charges'); ?> (+):</td>
            <td class="r"><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_transfer->shipping_charges, false); ?></span></td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="<?php echo e(2 + (!$hide_brand ? 1 : 0) + (!$hide_category ? 1 : 0) + 1, false); ?>" class="r"><strong><?php echo app('translator')->get('purchase.purchase_total'); ?>:</strong></td>
            <td class="r"><strong><span class="display_currency" data-currency_symbol="true"><?php echo e($sell_transfer->final_total, false); ?></span></strong></td>
        </tr>
    </tfoot>
    <?php endif; ?>
</table>


<?php if(!empty($sell_transfer->additional_notes)): ?>
<div class="st-section-title"><?php echo app('translator')->get('purchase.additional_notes'); ?></div>
<div class="st-notes"><?php echo e($sell_transfer->additional_notes, false); ?></div>
<?php endif; ?>


<div class="st-sig-wrap">
    <div class="st-sig-col">
        <div class="st-sig-line"><?php echo e(__('manufacturing::lang.prepared_by'), false); ?></div>
    </div>
    <div class="st-sig-col">
        <div class="st-sig-line"><?php echo e(__('manufacturing::lang.received_by'), false); ?></div>
    </div>
    <div class="st-sig-col">
        <div class="st-sig-line"><?php echo e(__('manufacturing::lang.approved_by'), false); ?></div>
    </div>
</div>


<div class="st-footer">
    <span><?php echo e($sell_transfer->ref_no, false); ?> &mdash; <?php echo e($business_name, false); ?></span>
    <span><?php echo app('translator')->get('manufacturing::lang.printed_on'); ?>: <?php echo e(now()->format('d/m/Y H:i'), false); ?></span>
</div>


<div style="margin-top:18px; text-align:center; background:#fff; padding:8px 0;">
    <img src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($sell_transfer->ref_no, 'C128', 2, 30, [39, 48, 54], true), false); ?>">
</div>
