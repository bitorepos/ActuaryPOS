
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php if(!empty($common_settings['ledger_discount3_label'])): ?> <?php echo app('translator')->get('lang_v1.view'); ?> <?php echo app('translator')->get('lang_v1.all'); ?> <?php echo e($common_settings['ledger_discount3_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.view_ledger_discounts3'); ?> <?php endif; ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="clearfix"></div>
                      <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped table-th-skin" id="all_ledger_discounts2">
                          <thead class="bg-success">
                            <tr>
                              <th>#</th>
                              <th>Ref No.</th>
                              <th>Location</th>
                              <th>Date</th>
                              <th>Total</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $ledger_discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ld): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                              <td><?php echo e($loop->index+1, false); ?></td>
                              <td><?php echo e($ld->ref_no, false); ?></td>
                              <td><?php echo e($ld->location, false); ?></td>
                              <td><?php echo e(\Carbon::createFromTimestamp(strtotime($ld->transaction_date))->format(session('business.date_format')), false); ?></td>
                              <td>
                                <?php
                                $final_total = 0;
                                if($contact->type == 'supplier'){
                                  if($ld->sub_type == 'purchase_discount'){
                                    $final_total = -1*$ld->final_total;
                                  }else{
                                    $final_total = $ld->final_total;
                                  }
                                }else{
                                  if($ld->sub_type == 'sell_discount'){
                                    $final_total = -1*$ld->final_total;
                                  }else{
                                    $final_total = $ld->final_total;
                                  }
                                }
                                ?>
                                <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
                              </td>
                              <td>
                                <?php if(empty($ld->deleted_at)): ?>
                                <button type="button" class="btn btn-sm btn-danger delete_ledger_discount" data-href="<?php echo e(action([\App\Http\Controllers\LedgerDiscountController::class, 'destroy3'], $ld->id), false); ?>"><i class="fas fa-trash"></i></button>
                                <button type="button" class="btn btn-sm btn-primary btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\LedgerDiscountController::class, 'edit3'], $ld->id), false); ?>" data-container="#edit_ledger_discount3_modal"><i class="fas fa-edit"></i></button>
                                <?php else: ?>
                                <button type="button" class="btn btn-sm btn-warning restore_ledger_discount" data-href="<?php echo e(action([\App\Http\Controllers\LedgerDiscountController::class, 'restore3'], $ld->id), false); ?>"><i class="fas fa-redo"></i></button>
                                <?php endif; ?>
                              </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <td class="text-center" colspan="6">
                              No records found
                            </td>
                            <?php endif; ?>
                          </tbody>
                        </table>
                        </div>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->   

