
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

<div class="container">
    <div class="spacer"></div>
    <div class="row">
        <div class="col-12 col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-body">
                    <table class="table no-border">
                        <tr>
                            <?php if(!empty($transaction->business->logo)): ?>
                                <td class="width-50 text-center">
                                    <img src="<?php echo e(asset( 'uploads/business_logos/' . $transaction->business->logo ), false); ?>" alt="Logo" style="max-width: 80%;">
                                </td>
                            <?php endif; ?>
                            <td class="text-center">
                                <address>
                                <strong><?php echo e($transaction->business->name, false); ?></strong><br>
                                <?php echo e($transaction->location->name ?? '', false); ?>

                                <?php if(!empty($transaction->location->landmark)): ?>
                                    <br><?php echo e($transaction->location->landmark, false); ?>

                                <?php endif; ?>
                                <?php if(!empty($transaction->location->city) || !empty($transaction->location->state) || !empty($transaction->location->country)): ?>
                                    <br><?php echo e(implode(',', array_filter([$transaction->location->city, $transaction->location->state, $transaction->location->country])), false); ?>

                                <?php endif; ?>
                              
                                <?php if(!empty($transaction->business->tax_number_1)): ?>
                                    <br><?php echo e($transaction->business->tax_label_1, false); ?>: <?php echo e($transaction->business->tax_number_1, false); ?>

                                <?php endif; ?>

                                <?php if(!empty($transaction->business->tax_number_2)): ?>
                                    <br><?php echo e($transaction->business->tax_label_2, false); ?>: <?php echo e($transaction->business->tax_number_2, false); ?>

                                <?php endif; ?>

                                <?php if(!empty($transaction->location->mobile)): ?>
                                    <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($transaction->location->mobile, false); ?>

                                <?php endif; ?>
                                <?php if(!empty($transaction->location->email)): ?>
                                    <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($transaction->location->email, false); ?>

                                <?php endif; ?>
                            </address>
                            </td>
                        </tr>
                    </table>
                    <h4 class="box-title"><?php echo app('translator')->get('lang_v1.payment_for_invoice_no'); ?>: <?php echo e($transaction->invoice_no, false); ?></h4>
                    <table class="table no-border">
                        <tr>
                            <td>
                                <strong><?php echo app('translator')->get('contact.customer'); ?>:</strong><br>
                                <?php echo $transaction->contact->contact_address; ?>

                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php echo app('translator')->get('sale.sale_date'); ?>:</strong> <?php echo e($date_formatted, false); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <h4><?php echo app('translator')->get('sale.total_amount'); ?>: <span><?php echo e($total_amount, false); ?></span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4><?php echo app('translator')->get('sale.total_paid'); ?>: <span><?php echo e($total_paid, false); ?></span></h4>
                            </td>
                        </tr>
                    </table>

                    <?php if($transaction->payment_status != 'paid'): ?>
                    <table class="table no-border">
                        <tr>
                            <td><h4><?php echo app('translator')->get('sale.total_payable'); ?>: <span><?php echo e($total_payable_formatted, false); ?></span></h4></td>
                        </tr>
                    </table>
                    <div class="spacer"></div>
                    <div class="spacer"></div>
                    <div class="width-50 text-center f-left">
                        <form action="<?php echo e(route('confirm_payment', ['id' => $transaction->id]), false); ?>" method="POST">
                            <input type="hidden" name="gateway" value="razorpay">
                                <!-- Note that the amount is in paise -->
                            <script
                                src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="<?php echo e($pos_settings['razor_pay_key_id'], false); ?>"
                                data-amount="<?php echo e($total_payable*100, false); ?>"
                                data-buttontext="Pay with Razorpay"
                                data-name="<?php echo e($transaction->business->name, false); ?>"
                                data-theme.color="#3c8dbc"
                            ></script>
                            <?php echo e(csrf_field(), false); ?>

                        </form>
                    </div>
                        <?php if(!empty($pos_settings['stripe_public_key']) && !empty($pos_settings['stripe_secret_key'])): ?>
                            <?php
                                $code = strtolower($business_details->currency_code);
                            ?>

                            <div class="width-50 text-center f-left">
                                <form action="<?php echo e(route('confirm_payment', ['id' => $transaction->id]), false); ?>" method="POST">
                                    <?php echo e(csrf_field(), false); ?>

                                    <input type="hidden" name="gateway" value="stripe">
                                    <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="<?php echo e($pos_settings['stripe_public_key'], false); ?>"
                                            data-amount="<?php if(in_array($code, ['bif','clp','djf','gnf','jpy','kmf','krw','mga','pyg','rwf','ugx','vnd','vuv','xaf','xof','xpf'])): ?> <?php echo e($total_payable, false); ?> <?php else: ?> <?php echo e($total_payable*100, false); ?> <?php endif; ?>"
                                            data-name="<?php echo e($transaction->business->name, false); ?>"
                                            data-description="Pay with stripe"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto"
                                            data-currency="<?php echo e($code, false); ?>">
                                    </script>
                                </form>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <table class="table no-border">
                            <tr>
                                <td><h4><?php echo app('translator')->get('sale.payment_status'); ?>: <span class="text-success"><?php echo app('translator')->get('lang_v1.paid'); ?></span></h4></td>
                            </tr>
                        </table>
                    <?php endif; ?>
                    <div class="spacer"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>