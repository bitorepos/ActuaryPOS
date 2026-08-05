<?php
    $purchase_shortcuts = !empty($shortcuts['purchase']) ? $shortcuts['purchase'] : [];
?>

<div class="modal fade" id="purchase_keyboard_shortcuts_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.purchase_page_shortcuts'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang_v1.action'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.shortcut_key'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($purchase_shortcuts['save_purchase'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_save'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['save_purchase']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['save_and_print'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_save_and_print'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['save_and_print']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['cancel_purchase'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.cancel'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['cancel_purchase']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['product_search'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_product_search'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['product_search']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_payment'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_payment'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_payment']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_supplier'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_supplier'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_supplier']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['add_new_supplier'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_add_new_supplier'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['add_new_supplier']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['add_payment_row'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_add_payment_row'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['add_payment_row']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang_v1.action'); ?></th>
                                    <th><?php echo app('translator')->get('lang_v1.shortcut_key'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($purchase_shortcuts['focus_purchase_date'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_date'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_purchase_date']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_ref_no'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_ref_no'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_ref_no']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_last_qty'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_qty'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_last_qty']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_last_price'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_price'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_last_price']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['focus_last_discount'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_focus_last_discount'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['focus_last_discount']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['remove_last_product'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_remove_last_product'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['remove_last_product']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['save_purchase_return'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_return_save'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['save_purchase_return']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                                <?php if(!empty($purchase_shortcuts['show_shortcuts_help'])): ?>
                                <tr>
                                    <td><?php echo app('translator')->get('lang_v1.purchase_show_shortcuts_help'); ?></td>
                                    <td><kbd><?php echo e(strtoupper($purchase_shortcuts['show_shortcuts_help']), false); ?></kbd></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>
