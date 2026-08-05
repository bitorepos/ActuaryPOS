<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
        <div class="modal-header no-print">
            <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.delivery_note'); ?> - <?php echo e($delivery_note->delivery_note_no, false); ?></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="delivery-note-a4">
                <style type="text/css">
                    .delivery-note-a4 {
                        padding: 25px;
                        background: #fff;
                        color: #222;
                        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                    }

                    .dn-header {
                        border-bottom: 2px solid #222;
                        padding-bottom: 15px;
                        margin-bottom: 20px;
                    }

                    .dn-title {
                        font-size: 26px;
                        font-weight: 700;
                        text-transform: uppercase;
                        letter-spacing: 1px;
                        color: #111;
                    }

                    .dn-table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 15px;
                    }

                    .dn-table th {
                        background-color: #f8f9fa;
                        border: 1px solid #333;
                        padding: 10px 12px;
                        font-size: 13px;
                        text-transform: uppercase;
                    }

                    .dn-table td {
                        border: 1px solid #333;
                        padding: 10px 12px;
                        font-size: 13px;
                    }

                    .dn-box {
                        border: 1px solid #ddd;
                        border-radius: 4px;
                        padding: 12px;
                        background-color: #fafafa;
                        min-height: 100%;
                    }

                    .signature-line {
                        border-top: 1px solid #444;
                        margin-top: 60px;
                        padding-top: 5px;
                        text-align: center;
                        font-weight: bold;
                        font-size: 13px;
                    }

                    @media print {
                        .no-print {
                            display: none !important;
                        }
                    }
                </style>

                <!-- Header Section -->
                <div class="row dn-header">
                    <div class="col-xs-7 col-7">
                        <h3 class="mt-0" style="font-weight: bold;"><?php echo e($business->name ?? '', false); ?></h3>
                        <?php if(!empty($transaction->location)): ?>
                            <p class="mb-0">
                                <strong><?php echo e($transaction->location->name, false); ?></strong><br>
                                <?php echo $transaction->location->location_address; ?>

                                <?php if(!empty($transaction->location->mobile)): ?>
                                    <br>Mobile: <?php echo e($transaction->location->mobile, false); ?>

                                <?php endif; ?>
                                <?php if(!empty($transaction->location->email)): ?>
                                    <br>Email: <?php echo e($transaction->location->email, false); ?>

                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="col-xs-5 col-5 text-end text-right">
                        <div class="dn-title">Delivery Note</div>
                        <table class="table table-bordered table-sm mt-2"
                            style="font-size: 12px; margin-left: auto; width: 100%;">
                            <tr>
                                <th class="bg-light" style="width: 45%;">DN No:</th>
                                <td><strong><?php echo e($delivery_note->delivery_note_no, false); ?></strong></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Invoice No:</th>
                                <td><?php echo e($transaction->invoice_no, false); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Date:</th>
                                <td><?php echo e(\Carbon::createFromTimestamp(strtotime($delivery_note->created_at))->format(session('business.date_format')), false); ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Status:</th>
                                <td><span class="badge bg-info"
                                        style="text-transform: capitalize;"><?php echo e($delivery_note->status, false); ?></span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Customer & Delivery Info Section -->
                <div class="row mb-4">
                    <div class="col-xs-6 col-6">
                        <div class="dn-box">
                            <h5
                                style="font-weight: bold; margin-top: 0; border-bottom: 1px solid #ccc; padding-bottom: 5px;">
                                Customer Info</h5>
                            <strong><?php echo e($transaction->contact->name, false); ?></strong>
                            <?php if(!empty($transaction->contact->supplier_business_name)): ?>
                                <br><?php echo e($transaction->contact->supplier_business_name, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->contact->address_line_1)): ?>
                                <br><?php echo e($transaction->contact->address_line_1, false); ?>

                            <?php endif; ?>
                            <?php if(!empty($transaction->contact->mobile)): ?>
                                <br>Phone: <?php echo e($transaction->contact->mobile, false); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-6">
                        <div class="dn-box">
                            <h5
                                style="font-weight: bold; margin-top: 0; border-bottom: 1px solid #ccc; padding-bottom: 5px;">
                                Shipping & Delivery Details</h5>
                            <?php if(!empty($delivery_note->delivered_to)): ?>
                                <strong>Delivered To:</strong> <?php echo e($delivery_note->delivered_to, false); ?><br>
                            <?php endif; ?>
                            <strong>Shipping Address:</strong><br>
                            <?php echo nl2br(e($delivery_note->shipping_address ?: ($transaction->shipping_address ?: 'N/A'))); ?>

                        </div>
                    </div>
                </div>

                <!-- Products Table -->
                <div class="row">
                    <div class="col-xs-12 col-12">
                        <table class="dn-table">
                            <thead>
                                <tr>
                                    <th style="width: 8%; text-align: center;">#</th>
                                    <th>Product Name</th>
                                    <th style="width: 25%; text-align: center;">Delivered Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $delivery_note->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo e($loop->iteration, false); ?></td>
                                        <td>
                                            <strong><?php echo e($line->product->name, false); ?></strong>
                                            <?php if($line->product->type == 'variable' && !empty($line->variation)): ?>
                                                - <?php echo e($line->variation->name, false); ?>

                                            <?php endif; ?>
                                            <?php if(!empty($line->variation->sub_sku)): ?>
                                                <small class="text-muted">(<?php echo e($line->variation->sub_sku, false); ?>)</small>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center; font-weight: bold;">
                                            <?php echo e(number_format($line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Signatures -->
                <div class="row" style="margin-top: 60px;">
                    <div class="col-xs-4 col-4">
                        <div class="signature-line">
                            Prepared By
                        </div>
                    </div>
                    <div class="col-xs-4 col-4">
                        <div class="signature-line">
                            Received By (Customer)
                        </div>
                    </div>
                    <div class="col-xs-4 col-4">
                        <div class="signature-line">
                            Authorized Signatory
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer no-print">
            <button type="button" class="btn btn-primary no-print"
                onclick="$(this).closest('div.modal-content').find('.delivery-note-a4').printThis();">
                <i class="fas fa-print" aria-hidden="true"></i> <?php echo app('translator')->get('messages.print'); ?>
            </button>
            <button type="button" class="btn btn-secondary no-print"
                data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>