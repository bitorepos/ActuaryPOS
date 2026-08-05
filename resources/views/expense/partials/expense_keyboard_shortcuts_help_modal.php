<?php
    $exp_shortcuts = !empty($shortcuts['expense']) ? $shortcuts['expense'] : [];
?>
<!-- Expense Keyboard Shortcuts Help Modal -->
<div class="modal fade" id="expenseKeyboardShortcutsModal" tabindex="-1" role="dialog" aria-labelledby="expKeyboardShortcutsLabel" style="z-index: 1090 !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="expKeyboardShortcutsLabel">
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
                        <?php if(!empty($exp_shortcuts['save'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_save'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['save']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_location'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_location'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_location']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_ref_no'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_ref_no'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_ref_no']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_date'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_date'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_date']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_category'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_category'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_category']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_amount'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_amount'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_amount']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_payment'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_payment'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_payment']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['focus_tax'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_focus_tax'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['focus_tax']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($exp_shortcuts['show_shortcuts_help'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.expense_show_shortcuts_help'); ?></td>
                            <td><kbd><?php echo e(strtoupper($exp_shortcuts['show_shortcuts_help']), false); ?></kbd></td>
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
        $('#expenseKeyboardShortcutsModal').appendTo('body');
    });
</script>
