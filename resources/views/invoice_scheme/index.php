
<?php $__env->startSection('title', __('invoice.invoice_settings')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'invoice.invoice_settings' ); ?>
        <small><?php echo app('translator')->get( 'invoice.manage_your_invoices' ); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="nav-item p-2"><a class="nav-link active" href="#tab_1" data-bs-toggle="tab" role="tab" aria-expanded="true"><?php echo app('translator')->get('invoice.invoice_schemes'); ?></a></li>
              <li class="nav-item p-2"><a class="nav-link" href="#tab_2" data-bs-toggle="tab" role="tab" aria-expanded="false"><?php echo app('translator')->get('invoice.invoice_layouts'); ?></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="tab_1" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="float-start">
                            <?php echo app('translator')->get( 'invoice.all_your_invoice_schemes' ); ?> 
                        </h4>
                        <button type="button" class="btn btn-primary btn-modal float-end" 
                            data-href="<?php echo e(action([\App\Http\Controllers\InvoiceSchemeController::class, 'create']), false); ?>" 
                            data-container=".invoice_modal">
                            <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-th-skin" id="invoice_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get( 'invoice.name' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme_name') . '"></i>';
                }
            ?></th>
                                    <th><?php echo app('translator')->get( 'invoice.prefix' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme_prefix') . '"></i>';
                }
            ?></th>
                                    <th><?php echo app('translator')->get( 'invoice.start_number' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme_start_number') . '"></i>';
                }
            ?></th>
                                    <th><?php echo app('translator')->get( 'invoice.invoice_count' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme_count') . '"></i>';
                }
            ?></th>
                                    <th><?php echo app('translator')->get( 'invoice.total_digits' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme_total_digits') . '"></i>';
                }
            ?></th>
                                    <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                </tr>
                            </thead>
                        </table>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane fade" id="tab_2" role="tabpanel">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <h4 class="float-start"><?php echo app('translator')->get( 'invoice.all_your_invoice_layouts' ); ?></h4> 
                        <a class="btn btn-primary float-end" href="<?php echo e(action([\App\Http\Controllers\InvoiceLayoutController::class, 'create']), false); ?>">
                                <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?>
                        </a>
                        
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $invoice_layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 mb-2">
                            <div class="icon-link">
                                <a href="<?php echo e(action([\App\Http\Controllers\InvoiceLayoutController::class, 'edit'], [$layout->id]), false); ?>" class="text-decoration-none text-secondary">
                                    <i class="fa fa-file-alt fa-4x"></i> 
                                    <?php echo e($layout->name, false); ?>

                                </a>
                                <?php if( $layout->is_default ): ?>
                                    <span class="badge bg-green"><?php echo app('translator')->get("barcode.default"); ?></span>
                                <?php endif; ?>
                                <?php if($layout->locations->count()): ?>
                                    <span class="link-des">
                                    <b><?php echo app('translator')->get('invoice.used_in_locations'); ?>: </b><br>
                                    <?php $__currentLoopData = $layout->locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($location->name, false); ?>

                                        <?php if(!$loop->last): ?>
                                            ,
                                        <?php endif; ?>
                                        &nbsp;
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if( $loop->iteration % 4 == 0 ): ?>
                                    <div class="clearfix"></div>
                                <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <br>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </div>
	
    <div class="modal fade invoice_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>