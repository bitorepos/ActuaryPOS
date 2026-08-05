
<?php $__env->startSection('title', __('invoice_design.add_new_design')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('invoice_design.add_new_design'); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\InvoiceDesignController::class, 'store']), 'method' => 'post']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('name', __('invoice_design.design_name') . ':*'); ?>

                    <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('invoice_design.design_name')]); ?>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <?php echo Form::label('paper_type', __('invoice_design.paper_type') . ':*'); ?>

                    <?php echo Form::select('paper_type', [
                        'a4' => 'A4 – 210 × 297 mm (Standard Invoice)',
                        'a5' => 'A5 – 148 × 210 mm (Half Page)',
                        'thermal_80' => 'Thermal 80mm (Receipt Printer)',
                        'thermal_58' => 'Thermal 58mm (Receipt Printer)',
                        'custom' => 'Custom Size',
                    ], 'a4', ['class' => 'form-select', 'id' => 'paper_type']); ?>

                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo Form::label('description', __('barcode.setting_description') . ':'); ?>

                    <?php echo Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => __('invoice_design.description_placeholder')]); ?>

                </div>
            </div>
            <div class="col-sm-3 custom_paper_fields" style="display: none;">
                <div class="form-group">
                    <?php echo Form::label('paper_width', __('invoice_design.paper_width_mm') . ':'); ?>

                    <?php echo Form::number('paper_width', 210, ['class' => 'form-control', 'step' => '0.1', 'min' => '20']); ?>

                </div>
            </div>
            <div class="col-sm-3 custom_paper_fields" style="display: none;">
                <div class="form-group">
                    <?php echo Form::label('paper_height', __('invoice_design.paper_height_mm') . ':'); ?>

                    <?php echo Form::number('paper_height', 297, ['class' => 'form-control', 'step' => '0.1', 'min' => '20']); ?>

                </div>
            </div>
            <div class="col-sm-3 custom_paper_fields" style="display: none;">
                <div class="form-group">
                    <?php echo Form::label('is_continuous', __('invoice_design.continuous_roll') . ':'); ?>

                    <?php echo Form::select('is_continuous', [0 => __('messages.no'), 1 => __('messages.yes')], 0, ['class' => 'form-select']); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <br/>
                    <div class="form-check">
                        <?php echo Form::checkbox('is_default', 1, false, ['class' => 'form-check-input', 'id' => 'is_default']); ?>

                        <?php echo Form::label('is_default', __('barcode.set_as_default'), ['class' => 'form-check-label']); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('invoice_design.create_and_design'); ?>
                </button>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    $('#paper_type').on('change', function() {
        if ($(this).val() === 'custom') {
            $('.custom_paper_fields').show();
        } else {
            $('.custom_paper_fields').hide();
        }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>