<?php
    $sell_shortcuts = !empty($shortcuts['sell']) ? $shortcuts['sell'] : [];
    $is_sell_return = !empty($is_sell_return_page);
?>
<!-- Keyboard Shortcuts Help Modal -->
<div class="modal fade" id="sell_keyboard_shortcuts_modal" tabindex="-1" role="dialog" aria-labelledby="sellKeyboardShortcutsLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sellKeyboardShortcutsLabel">
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
                        <?php if(!$is_sell_return): ?>
                            <?php if(!empty($sell_shortcuts['save_sell'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_save'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['save_sell']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['save_and_print'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_save_and_print'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['save_and_print']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['cancel_sell'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_cancel'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['cancel_sell']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['product_search'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_product_search'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['product_search']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_customer'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_customer'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_customer']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['add_new_customer'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_add_new_customer'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['add_new_customer']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_sale_date'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_sale_date']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_ref_no'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_ref_no']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_last_qty'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_last_qty'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_last_qty']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_last_price'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_last_price'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_last_price']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_last_discount'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_last_discount'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_last_discount']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['remove_last_product'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_remove_last_product'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['remove_last_product']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if(!empty($sell_shortcuts['save_sell_return'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_return_save'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['save_sell_return']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['save_and_print_return'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_return_save_and_print'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['save_and_print_return']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_sale_date'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_sale_date']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                            <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.sell_focus_ref_no'); ?></td>
                                <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_ref_no']), false); ?></kbd></td>
                            </tr>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(!empty($sell_shortcuts['focus_payment'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.sell_focus_payment'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sell_shortcuts['focus_payment']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sell_shortcuts['add_payment_row']) && !$is_sell_return): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.sell_add_payment_row'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sell_shortcuts['add_payment_row']), false); ?></kbd></td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($sell_shortcuts['show_shortcuts_help'])): ?>
                        <tr>
                            <td><?php echo app('translator')->get('lang_v1.sell_show_shortcuts_help'); ?></td>
                            <td><kbd><?php echo e(strtoupper($sell_shortcuts['show_shortcuts_help']), false); ?></kbd></td>
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
