
<?php $__env->startSection('title', __('business.business_locations')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'business.business_locations' ); ?>
        <small><?php echo app('translator')->get( 'business.manage_your_business_locations' ); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'business.all_your_business_locations' )]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                
                <a class="btn btn-block btn-primary" href="<?php echo e(action([\App\Http\Controllers\BusinessLocationController::class, 'create']), false); ?>">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                </a>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="business_location_table">
                <thead>
                    <tr>
                        <th style="min-width: 150px;"><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        <th><?php echo app('translator')->get( 'lang_v1.created_at' ); ?></th>
                        <th><?php echo app('translator')->get( 'invoice.name' ); ?></th>
                        <th><?php echo app('translator')->get( 'lang_v1.location_id' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.landmark' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.city' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.zip_code' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.state' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.country' ); ?></th>
                        <th><?php echo app('translator')->get( 'lang_v1.price_group' ); ?></th>
                        <th><?php echo app('translator')->get( 'invoice.invoice_scheme' ); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.invoice_layout_for_pos'); ?></th>
                        <th><?php echo app('translator')->get('lang_v1.invoice_layout_for_sale'); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade location_add_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script>
        $(document).on('shown.bs.modal', '.modal', function(){
            $(this).find('select.accounts-dropdown').select2({
                dropdownParent: $(this).find('div.payment-options'),
                ajax: {
                    url: '/accounts-dropdown',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        }
                    },
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: function(data) {
                    return data.html;
                },
                templateSelection: function(data) {
                    return data.text;
                }
            });
        });
        </script> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>