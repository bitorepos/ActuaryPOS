<div class="table-responsive mt-2">
    <table class="table table-bordered table-striped table-text-center table-th-skin" id="profit_by_day_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.days'); ?></th>
                <th class="text-right"><?php echo app('translator')->get('lang_v1.gross_profit'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.' . $day); ?></td>
                    <td class="text-right"><span class="gross-profit" data-orig-value="<?php echo e($profits[$day] ?? 0, false); ?>"><?php if(isset($profits[$day])): ?><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $profits[$day], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php else: ?> 0 <?php endif; ?></span></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr class="bg-gray font-17 footer-total">
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                <td class="footer_total text-right"></td>
            </tr>
        </tfoot>
    </table>
</div>
