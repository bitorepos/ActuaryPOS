<?php
    $sa_shortcuts = !empty($shortcuts['stock_adjustment']) ? $shortcuts['stock_adjustment'] : [];
?>
<!-- Stock Adjustment Keyboard Shortcuts Help Modal -->
<div class="modal fade" id="stockAdjustmentKeyboardShortcutsModal" tabindex="-1" role="dialog" aria-labelledby="saKeyboardShortcutsLabel" style="z-index: 1090 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="saKeyboardShortcutsLabel">
                    <i class="fas fa-keyboard"></i> <?php echo app('translator')->get('business.keyboard_shortcut'); ?>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('business.operations'); ?></th>
                            <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($sa_shortcuts['save'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_save'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['save']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['focus_location'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_location'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['focus_location']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['focus_ref_no'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_ref_no'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['focus_ref_no']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['focus_date'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_date'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['focus_date']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['product_search'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_product_search'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['product_search']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['focus_last_qty'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_last_qty'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['focus_last_qty']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['remove_last_product'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_remove_last_product'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['remove_last_product']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['focus_recovery_amount'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_focus_recovery_amount'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['focus_recovery_amount']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sa_shortcuts['show_shortcuts_help'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_adjustment_show_shortcuts_help'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sa_shortcuts['show_shortcuts_help']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#stockAdjustmentKeyboardShortcutsModal').appendTo('body');
    });
</script>
