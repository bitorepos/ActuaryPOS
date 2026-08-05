
<?php $__env->startSection('title', __( 'restaurant.kitchen' )); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content min-height-90hv no-print">

<div class="row mb-2">
    <div class="col-md-12 text-center">
        <h3><?php echo app('translator')->get( 'restaurant.all_orders' ); ?> - <?php echo app('translator')->get( 'restaurant.kitchen' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_kitchen') . '"></i>';
                }
            ?></h3>
    </div>
    <div class="col-md-12 text-center row">
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php
                    $pos_settings = json_decode(session()->get('business.pos_settings'), true);
                ?>
                <?php echo Form::label('printer_id', __('printer.printers') . ':'); ?>

                <?php echo Form::select('printer_id', $printers, $printer_id,
                ['placeholder' => __('lang_v1.all'), 'class' => 'form-control select2'],
                ); ?>

            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <?php
                    $printer_id = null;
                ?>
                <?php echo Form::label('order_type', __('lang_v1.order_type') . ':'); ?>

                <?php echo Form::select('order_type', [''=>'All Orders', 'takeaway'=> !empty($pos_settings['enable_takeaway_label']) ? $pos_settings['enable_takeaway_label'] :  'Takeaway', 'table' => 'Table Orders' ], '',
                ['class' => 'form-control select2'],
                ); ?>

            </div>
        </div>

        <input type="hidden" id="current_orders_count" value="<?php echo e(count($orders), false); ?>">
        <?php if(!empty($pos_settings['show_order_details_kitchen']) && !empty($pos_settings['warn_prep_time_out'])): ?>
            <input type="hidden" id="warn_prep_time_out">
        <?php endif; ?>
    </div>
</div>

	<div class="box box-primary">
        <div class="box-header">
            <button type="button" class="btn btn-lg btn-primary float-end" id="refresh_orders"><i class="fas fa-sync"></i> <?php echo app('translator')->get( 'restaurant.refresh' ); ?></button>
        </div>
        <div class="box-body">
            <input type="hidden" id="orders_for" value="kitchen">
        	<div class="row" id="orders_div">
             <?php echo $__env->make('restaurant.partials.show_orders', array('orders_for' => 'kitchen'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
            </div>
        </div>
        <div class="overlay hide">
          <i class="fas fa-sync fa-spin"></i>
        </div>
    </div>

</section>
<style>
    @keyframes flash {
        0%   { background-color: inherit; }
        50%  { background-color: #ec5656; } /* light red */
        100% { background-color: inherit; }
    }

    .flash-row {
    animation: flash 1s infinite;
    }
</style>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            if($('#warn_prep_time_out').length > 0){
                setInterval(() => {
                    console.log('delayed run');
                    $('input.prep_time_passed[value="1"]').each(function () {
                        $(this).closest('tr').addClass('flash-row');
                    }); 
                }, 1000);  
            }


            $(document).on('click', 'a.mark_as_cooked_btn', function(e){
                e.preventDefault();
                let printer_id = $('select#printer_id').val();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href + '?printer_id='+printer_id,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.restaurant', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>