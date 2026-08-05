
<?php $__env->startSection('title', __('invoice_design.edit_design')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('invoice_design.edit_design'); ?> — <?php echo e($design->name, false); ?></h1>
</section>

<section class="content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\InvoiceDesignController::class, 'update'], [$design->id]), 'method' => 'put']); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('name', __('invoice_design.design_name') . ':*'); ?>

                    <?php echo Form::text('name', $design->name, ['class' => 'form-control', 'required']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('paper_type', __('invoice_design.paper_type') . ':*'); ?>

                    <?php echo Form::select('paper_type', [
                        'a4' => 'A4 – 210 × 297 mm',
                        'a5' => 'A5 – 148 × 210 mm',
                        'thermal_80' => 'Thermal 80mm',
                        'thermal_58' => 'Thermal 58mm',
                        'custom' => 'Custom Size',
                    ], $design->paper_type, ['class' => 'form-select', 'id' => 'paper_type']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <br/>
                    <div class="form-check">
                        <?php echo Form::checkbox('is_default', 1, $design->is_default, ['class' => 'form-check-input', 'id' => 'is_default']); ?>

                        <?php echo Form::label('is_default', __('barcode.set_as_default'), ['class' => 'form-check-label']); ?>

                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo Form::label('description', __('barcode.setting_description') . ':'); ?>

                    <?php echo Form::textarea('description', $design->description, ['class' => 'form-control', 'rows' => 2]); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <h4><?php echo app('translator')->get('invoice_design.section_heights'); ?></h4>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('header_height', __('invoice_design.header_height_mm') . ':'); ?>

                    <?php echo Form::number('header_height', $design->header_height, ['class' => 'form-control', 'step' => '0.1', 'min' => '10']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('detail_row_height', __('invoice_design.detail_row_height_mm') . ':'); ?>

                    <?php echo Form::number('detail_row_height', $design->detail_row_height, ['class' => 'form-control', 'step' => '0.1', 'min' => '3']); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('footer_height', __('invoice_design.footer_height_mm') . ':'); ?>

                    <?php echo Form::number('footer_height', $design->footer_height, ['class' => 'form-control', 'step' => '0.1', 'min' => '10']); ?>

                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>
                </button>
                <a href="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'designer'], [$design->id]), false); ?>" class="btn btn-info">
                    <i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('invoice_design.open_designer'); ?>
                </a>
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
    }).trigger('change');
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>