
<?php $__env->startSection('title', __('sale.pos_second_display')); ?>
<?php if(!empty($theme_color)): ?>
<?php $__env->startSection('body_class', 'theme-' . $theme_color); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
<style>
    html, body {
        margin: 0;
        padding: 0;
        height: 100vh;
        overflow: hidden;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f2f5;
    }
    .cd-wrapper {
        display: flex;
        flex-direction: column;
        height: 100vh;
    }
    /* Header strip */
    .cd-header {
        background: linear-gradient(135deg, var(--bs-primary, #1a73e8), var(--theme-primary-dark, #0d47a1));
        color: #fff;
        padding: 10px 24px;
        font-size: 16px;
        font-weight: 600;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }
    .cd-header i { font-size: 18px; }
    /* Product table area */
    .cd-products {
        flex: 1;
        overflow-y: auto;
        padding: 12px 16px 0;
        background: #fff;
    }
    .cd-products table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }
    .cd-products thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 700;
        font-size: 15px;
        padding: 10px 12px;
        border-bottom: 2px solid #dee2e6;
        position: sticky;
        top: 0;
        z-index: 1;
    }
    .cd-products tbody td {
        padding: 10px 12px;
        font-size: 15px;
        color: #212529;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }
    .cd-products tbody tr:last-child td {
        border-bottom: none;
    }
    .cd-products tbody tr.cd-highlight {
        animation: cd-row-flash 0.6s ease;
    }
    @keyframes cd-row-flash {
        0% { background: var(--theme-primary-light, #e3f2fd); }
        100% { background: transparent; }
    }
    /* Totals panel */
    .cd-totals {
        flex-shrink: 0;
        background: #fff;
        border-top: 1px solid #dee2e6;
        padding: 0;
    }
    .cd-totals-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0;
    }
    .cd-total-item {
        padding: 12px 16px;
        border-right: 1px solid #eee;
        text-align: center;
    }
    .cd-total-item:last-child { border-right: none; }
    .cd-total-label {
        font-size: 12px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 2px;
    }
    .cd-total-value {
        font-size: 22px;
        font-weight: 700;
        color: #212529;
        font-variant-numeric: tabular-nums;
    }
    /* Payable bar */
    .cd-payable-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(135deg, var(--bs-primary, #1a73e8), var(--theme-primary-dark, #0d47a1));
        color: #fff;
        padding: 14px 24px;
        flex-shrink: 0;
    }
    .cd-payable-label {
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .cd-payable-amount {
        font-size: 32px;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }
    /* Change return bar */
    .cd-change-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #198754;
        color: #fff;
        padding: 10px 24px;
        flex-shrink: 0;
    }
    .cd-change-label {
        font-size: 16px;
        font-weight: 600;
    }
    .cd-change-amount {
        font-size: 24px;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }
    /* Footer */
    .cd-footer {
        background: #f8f9fa;
        text-align: center;
        padding: 8px 16px;
        font-size: 13px;
        color: #6c757d;
        border-top: 1px solid #dee2e6;
        flex-shrink: 0;
    }
    /* Empty state */
    .cd-empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #adb5bd;
    }
    .cd-empty-state i { font-size: 48px; margin-bottom: 12px; }
    .cd-empty-state span { font-size: 16px; }
    /* Scrollbar */
    .cd-products::-webkit-scrollbar { width: 6px; }
    .cd-products::-webkit-scrollbar-track { background: transparent; }
    .cd-products::-webkit-scrollbar-thumb { background: #ced4da; border-radius: 3px; }
</style>

<div class="cd-wrapper">
    
    <div class="cd-header">
        <i class="fas fa-tv"></i>
        <span><?php echo app('translator')->get('sale.pos_second_display'); ?></span>
    </div>

    
    <div class="cd-products" id="cd_product_div">
        <table id="cd_pos_table">
            <thead>
                <tr>
                    <th style="width:8%">#</th>
                    <th style="width:47%"><?php echo app('translator')->get('sale.product'); ?></th>
                    <th style="width:15%; text-align:right"><?php echo app('translator')->get('sale.qty'); ?></th>
                    <th style="width:30%; text-align:right"><?php echo app('translator')->get('sale.subtotal'); ?></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        <div class="cd-empty-state" id="cd_empty_state">
            <i class="fas fa-shopping-cart"></i>
            <span><?php echo app('translator')->get('sale.no_products_added'); ?></span>
        </div>
    </div>

    
    <div class="cd-totals">
        <div class="cd-totals-grid">
            <div class="cd-total-item">
                <div class="cd-total-label"><?php echo app('translator')->get('sale.tax'); ?></div>
                <div class="cd-total-value" id="cd_tax_total"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
            </div>
            <div class="cd-total-item">
                <div class="cd-total-label"><?php echo app('translator')->get('sale.amount'); ?></div>
                <div class="cd-total-value" id="cd_paid"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
            </div>
            <div class="cd-total-item">
                <div class="cd-total-label"><?php echo app('translator')->get('lang_v1.change_return'); ?></div>
                <div class="cd-total-value text-success" id="cd_change_return"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
            </div>
        </div>
    </div>

    
    <div class="cd-payable-bar">
        <span class="cd-payable-label"><?php echo app('translator')->get('sale.total_payable'); ?></span>
        <span class="cd-payable-amount" id="cd_total_due"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
    </div>

    
    <div class="cd-change-bar d-none" id="cd_change_bar">
        <span class="cd-change-label"><i class="fas fa-coins me-2"></i><?php echo app('translator')->get('lang_v1.change_return'); ?></span>
        <span class="cd-change-amount" id="cd_change_return_bar"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></span>
    </div>

    
    <?php if(!empty($footer_text)): ?>
    <div class="cd-footer">
        <?php echo e($footer_text, false); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    function updateCustomerDisplay(data) {
        let products = data.products;
        let totals = data.totals;
        let tableBody = $("#cd_pos_table tbody");
        let emptyState = $("#cd_empty_state");

        // Update products
        products.forEach((product) => {
            let existingRow = tableBody.find(`tr[data-variation_id='${product.variation_id}']`);
            
            if (existingRow.length > 0) {
                existingRow.find(".qty").text(parseFloat(product.qty).toFixed(2));
                existingRow.find(".qty").data("qty", product.qty);
                existingRow.find(".price").text(parseFloat(product.price).toFixed(2));
                existingRow.find(".price").data("price", product.price);
                existingRow.addClass('cd-highlight');
                setTimeout(() => existingRow.removeClass('cd-highlight'), 600);
            } else {
                let newRow = `
                    <tr data-variation_id="${product.variation_id}" class="cd-highlight">
                        <td class="row_number" data-row_no=""></td>
                        <td class="name">${product.name}</td>
                        <td class="qty" data-qty="${product.qty}" style="text-align:right">${parseFloat(product.qty).toFixed(2)}</td>
                        <td class="price" data-price="${product.price}" style="text-align:right">${parseFloat(product.price).toFixed(2)}</td>
                    </tr>`;
                tableBody.append(newRow);
                setTimeout(() => tableBody.find('tr:last').removeClass('cd-highlight'), 600);
            }

            $("#cd_product_div").animate({ scrollTop: $('#cd_product_div').prop("scrollHeight") }, 500);
        });

        // Remove products not in updated data
        tableBody.find("tr").each(function () {
            let rowVariationId = $(this).data("variation_id");
            if (!products.some((p) => p.variation_id == rowVariationId)) {
                $(this).fadeOut(300, function() { $(this).remove(); updateEmptyState(); });
            }
        });

        // Update row numbers
        var sr_number = 1;
        tableBody.find(".row_number").each(function () {
            $(this).text(sr_number);
            sr_number++;
        });

        // Update totals
        $("#cd_tax_total").text(totals.tax.toFixed(2));
        $("#cd_total_due").text(totals.total_payable.toFixed(2));
        $("#cd_paid").text(totals.paid.toFixed(2));
        $("#cd_change_return").text(totals.change_return.toFixed(2));
        $("#cd_change_return_bar").text(totals.change_return.toFixed(2));

        // Show/hide change return bar
        if (totals.change_return > 0) {
            $("#cd_change_bar").removeClass('d-none');
        } else {
            $("#cd_change_bar").addClass('d-none');
        }

        updateEmptyState();
    }

    function updateEmptyState() {
        let rows = $("#cd_pos_table tbody tr:visible").length;
        if (rows > 0) {
            $("#cd_empty_state").hide();
        } else {
            $("#cd_empty_state").show();
        }
    }

    // Expose function to parent window
    window.updateCustomerDisplay = updateCustomerDisplay;
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>