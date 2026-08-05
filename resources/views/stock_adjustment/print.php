
<style>
    /* === Stock Adjustment Print Styles (sa- prefix) === */
    .sa-page *, .sa-page *::before, .sa-page *::after { box-sizing: border-box; }

    /* === Document Header === */
    .sa-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 2.5px solid #000;
        padding-bottom: 10px;
        margin-bottom: 14px;
    }
    .sa-header-biz-name {
        font-size: 15pt;
        font-weight: 700;
        line-height: 1.2;
    }
    .sa-header-biz-addr { font-size: 9.5pt; color: #444; margin-top: 3px; }
    .sa-header-right { text-align: right; }
    .sa-header-title {
        font-size: 17pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        line-height: 1.1;
    }
    .sa-header-sub { font-size: 10pt; margin-top: 4px; }

    /* === Meta Row === */
    .sa-summary {
        display: flex;
        gap: 20px;
        margin: 12px 0 14px;
        border-top: 1px solid #bbb;
        border-bottom: 1px solid #bbb;
        padding: 8px 0;
    }
    .sa-summary-item { flex: 1; font-size: 10.5pt; }
    .sa-summary-label {
        font-weight: 700;
        display: block;
        font-size: 9pt;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #444;
        margin-bottom: 2px;
    }

    /* === Section Title === */
    .sa-section-title {
        font-size: 9.5pt;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .07em;
        border-bottom: 1.5px solid #000;
        padding-bottom: 4px;
        margin: 16px 0 8px;
    }

    /* === Products Table === */
    .sa-table {
        width: 100%;
        border-collapse: collapse;
    }
    .sa-table thead tr th {
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
    .sa-table thead tr th.r { text-align: right; }
    .sa-table tbody tr td {
        font-size: 10pt;
        padding: 5px 6px;
        border: 1px solid #ccc;
        vertical-align: top;
    }
    .sa-table tbody tr:nth-child(even) td {
        background: #f2f2f2 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .sa-table td.r { text-align: right; }
    .sa-table tfoot tr td {
        font-size: 10.5pt;
        font-weight: 700;
        padding: 6px 6px;
        border-top: 2px solid #000;
        border-left: 0;
        border-right: 0;
        border-bottom: 0;
        background: #fff;
    }
    .sa-table tfoot tr td.r { text-align: right; }

    /* === Signatures === */
    .sa-sig-wrap {
        display: flex;
        gap: 0;
        margin-top: 36px;
    }
    .sa-sig-col {
        flex: 1;
        text-align: center;
        padding: 0 16px;
    }
    .sa-sig-line {
        border-top: 1px solid #000;
        padding-top: 6px;
        margin-top: 44px;
        font-size: 10pt;
        font-weight: 700;
    }

    /* === Footer === */
    .sa-footer {
        border-top: 1px solid #ccc;
        margin-top: 20px;
        padding-top: 6px;
        font-size: 9pt;
        color: #444;
        display: flex;
        justify-content: space-between;
    }

    /* === Print === */
    @media print {
        .sa-table thead tr th,
        .sa-table tbody tr:nth-child(even) td {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    }
</style>

<?php
    $business_name = $stock_adjustment->business->name ?? session('business.name', config('app.name'));
    $loc = $stock_adjustment->location;
    $is_stock_take = $stock_adjustment->adjustment_type == 'stock_take';
    $lot_n_exp_enabled = (session('business.enable_lot_number') == 1 || session('business.enable_product_expiry') == 1);
?>


<div class="sa-header">
    <div>
        <div class="sa-header-biz-name"><?php echo e($business_name, false); ?></div>
        <?php if(!empty($loc->name)): ?>
            <div class="sa-header-biz-addr"><?php echo e($loc->name, false); ?></div>
        <?php endif; ?>
        <?php if(!empty($loc->landmark)): ?>
            <div class="sa-header-biz-addr"><?php echo e($loc->landmark, false); ?></div>
        <?php endif; ?>
    </div>
    <div class="sa-header-right">
        <div class="sa-header-title"><?php echo app('translator')->get('stock_adjustment.stock_adjustment'); ?></div>
        <div class="sa-header-sub"><?php echo e(\Carbon\Carbon::parse($stock_adjustment->transaction_date)->format(session('business.date_format', 'd/m/Y') . ' H:i'), false); ?></div>
    </div>
</div>


<div class="sa-summary">
    <div class="sa-summary-item">
        <span class="sa-summary-label"><?php echo app('translator')->get('purchase.ref_no'); ?></span>
        <?php echo e($stock_adjustment->ref_no, false); ?>

    </div>
    <div class="sa-summary-item">
        <span class="sa-summary-label"><?php echo app('translator')->get('stock_adjustment.adjustment_type'); ?></span>
        <?php echo e(__('stock_adjustment.' . $stock_adjustment->adjustment_type), false); ?>

    </div>
    <div class="sa-summary-item">
        <span class="sa-summary-label"><?php echo app('translator')->get('business.location'); ?></span>
        <?php echo e($loc->name ?? '--', false); ?>

        <?php if(!empty($loc->city)): ?>
            <br><small><?php echo e(implode(', ', array_filter([$loc->city, $loc->state, $loc->country])), false); ?></small>
        <?php endif; ?>
    </div>
    <?php if(!empty($stock_adjustment->additional_notes)): ?>
    <div class="sa-summary-item">
        <span class="sa-summary-label"><?php echo app('translator')->get('stock_adjustment.reason_for_stock_adjustment'); ?></span>
        <?php echo e($stock_adjustment->additional_notes, false); ?>

    </div>
    <?php endif; ?>
</div>


<div class="sa-section-title"><?php echo app('translator')->get('sale.products'); ?></div>
<table class="sa-table">
    <thead>
        <tr>
            <th>#</th>
            <th><?php echo app('translator')->get('sale.product'); ?></th>
            <?php if($lot_n_exp_enabled): ?>
                <th><?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?></th>
            <?php endif; ?>
            <?php if($is_stock_take): ?>
                <th class="r"><?php echo app('translator')->get('stock_adjustment.on_hand'); ?></th>
                <th class="r"><?php echo app('translator')->get('stock_adjustment.counted'); ?></th>
            <?php endif; ?>
            <th class="r"><?php echo app('translator')->get('sale.qty'); ?></th>
            <th class="r"><?php echo app('translator')->get('sale.unit_price'); ?></th>
            <th class="r"><?php echo app('translator')->get('sale.subtotal'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $stock_adjustment->stock_adjustment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $qty = -1 * $line->quantity; ?>
        <tr>
            <td><?php echo e($loop->iteration, false); ?></td>
            <td><?php echo e($line->variation->full_name, false); ?></td>
            <?php if($lot_n_exp_enabled): ?>
                <td>
                    <?php echo e($line->lot_details->lot_number ?? '--', false); ?>

                    <?php if(session('business.enable_product_expiry') == 1 && !empty($line->lot_details->exp_date)): ?>
                        (<?php echo e(\Carbon\Carbon::parse($line->lot_details->exp_date)->format(session('business.date_format', 'd/m/Y')), false); ?>)
                    <?php endif; ?>
                </td>
            <?php endif; ?>
            <?php if($is_stock_take): ?>
                <td class="r"><?php echo e(number_format($line->on_hand_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                <td class="r"><?php echo e(number_format($line->counted_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <?php endif; ?>
            <td class="r"><?php echo e(number_format($qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td class="r"><?php echo e(number_format($line->unit_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
            <td class="r"><?php echo e(number_format($line->unit_price * $qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="<?php echo e(2 + ($lot_n_exp_enabled ? 1 : 0) + ($is_stock_take ? 2 : 0) + 2, false); ?>" class="r"><?php echo app('translator')->get('stock_adjustment.total_amount'); ?>:</td>
            <td class="r"><span class="display_currency" data-currency_symbol="true"><?php echo e($stock_adjustment->final_total, false); ?></span></td>
        </tr>
        <?php if(!empty($stock_adjustment->total_amount_recovered)): ?>
        <tr>
            <td colspan="<?php echo e(2 + ($lot_n_exp_enabled ? 1 : 0) + ($is_stock_take ? 2 : 0) + 2, false); ?>" class="r"><?php echo app('translator')->get('stock_adjustment.total_amount_recovered'); ?>:</td>
            <td class="r"><span class="display_currency" data-currency_symbol="true"><?php echo e($stock_adjustment->total_amount_recovered, false); ?></span></td>
        </tr>
        <?php endif; ?>
    </tfoot>
</table>


<div class="sa-sig-wrap">
    <div class="sa-sig-col">
        <div class="sa-sig-line"><?php echo e(__('manufacturing::lang.prepared_by'), false); ?></div>
    </div>
    <div class="sa-sig-col">
        <div class="sa-sig-line"><?php echo e(__('manufacturing::lang.received_by'), false); ?></div>
    </div>
    <div class="sa-sig-col">
        <div class="sa-sig-line"><?php echo e(__('manufacturing::lang.approved_by'), false); ?></div>
    </div>
</div>


<div class="sa-footer">
    <span><?php echo e($stock_adjustment->ref_no, false); ?> &mdash; <?php echo e($business_name, false); ?></span>
    <span><?php echo app('translator')->get('manufacturing::lang.printed_on'); ?>: <?php echo e(now()->format('d/m/Y H:i'), false); ?></span>
</div>


<div style="margin-top:18px; text-align:center; background:#fff; padding:8px 0;">
    <img src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($stock_adjustment->ref_no, 'C128', 2, 30, [39, 48, 54], true), false); ?>">
</div>
