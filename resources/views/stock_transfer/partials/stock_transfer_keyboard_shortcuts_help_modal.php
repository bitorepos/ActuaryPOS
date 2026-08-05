<?php
    $st_shortcuts = !empty($shortcuts['stock_transfer']) ? $shortcuts['stock_transfer'] : [];
?>
<!-- Stock Transfer Keyboard Shortcuts Help Modal -->
<div class="modal fade" id="stockTransferKeyboardShortcutsModal" tabindex="-1" role="dialog" aria-labelledby="stKeyboardShortcutsLabel" style="z-index: 1090 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="stKeyboardShortcutsLabel">
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
                        <?php if(!empty($st_shortcuts['save'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_save'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['save']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['focus_location_from'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_location_from'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['focus_location_from']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['focus_location_to'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_location_to'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['focus_location_to']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['focus_ref_no'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_ref_no'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['focus_ref_no']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['focus_date'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_date'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['focus_date']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['product_search'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_product_search'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['product_search']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['focus_last_qty'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_focus_last_qty'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['focus_last_qty']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['remove_last_product'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_remove_last_product'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['remove_last_product']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($st_shortcuts['show_shortcuts_help'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.stock_transfer_show_shortcuts_help'); ?></td>
                            <td><kbd><?php echo e(strtoupper($st_shortcuts['show_shortcuts_help']), false); ?></kbd></td>
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
        $('#stockTransferKeyboardShortcutsModal').appendTo('body');
    });
</script>
