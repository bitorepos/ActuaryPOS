
<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<style>
    @media print {
        @page {
            size: auto;
            margin: 12mm;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }

        #invoice_content {
            margin: 0 !important;
            padding: 0 !important;
        }
    }
</style>
<div class="container">
    <div class="spacer"></div>
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-12 mb-12" >
            <?php if(!empty($payment_link)): ?>
                <a href="<?php echo e($payment_link, false); ?>" class="btn btn-info no-print float-end" style="margin-right: 20px;"><i class="fas fa-money-check-alt" title="<?php echo app('translator')->get('lang_v1.pay'); ?>"></i> <?php echo app('translator')->get('lang_v1.pay'); ?>
                </a>
            <?php endif; ?>
            <?php if(request()->get('for_pdf') == 'true'): ?>
            <button type="button" class="btn btn-primary no-print btn-sm" id="print_invoice" 
                 aria-label="Print"><i class="fas fa-print"></i> Save as PDF
            </button>
            <?php else: ?>
            <button type="button" class="btn btn-primary no-print btn-sm" id="print_invoice" 
                 aria-label="Print"><i class="fas fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
            </button>
            <?php if(auth()->guard()->check()): ?>
                <?php if($transaction->type == 'gym_subscription'): ?>
                <a href="<?php echo e(action([\Modules\Gym\Http\Controllers\SubscriptionController::class, 'create']), false); ?>" class="btn btn-success no-print btn-sm" ><i class="fas fa-sign-out-alt"> New Invoice</i></a>
                <?php else: ?>
                <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'create']), false); ?>" class="btn btn-success no-print btn-sm" ><i class="fas fa-sign-out-alt"> New Invoice</i></a>
                <?php endif; ?>
                <a href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'index']), false); ?>" class="btn btn-info no-print btn-sm">
                    <i class="fas fa-arrow-left"></i> <?php echo app('translator')->get('messages.go_back'); ?>
                </a>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2 col-sm-12" style="border: 1px solid #ccc;">
            <div class="spacer"></div>
            <div id="invoice_content">
                <?php if(!empty(session()->get('business.common_settings')['enable_urdu_typing'] ?? false)): ?>
                <style type="text/css">
                    @font-face {
                        font-family: 'NooriNastaleeq';
                        src: url('/fonts/noori-nastaleeq-regular.ttf') format('truetype');
                        font-weight: normal;
                        font-style: normal;
                    }
                    input, b, p, i, th, td, .product_box_menu_item {
                        font-family: 'NooriNastaleeq';
                    }
                </style>
                <?php endif; ?>
                <?php echo $receipt['html_content']; ?>

            </div>
            <div class="spacer"></div>
        </div>
    </div>
    <div class="spacer"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#print_invoice', function(){
            $('#invoice_content').printThis();
        });
    });
    <?php if(!empty(request()->input('print_on_load'))): ?>
        $(window).on('load', function(){
            $('#invoice_content').printThis();
        });
    <?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>