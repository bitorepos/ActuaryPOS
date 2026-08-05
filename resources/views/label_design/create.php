
<?php $__env->startSection('title', __('label_design.add_new_design')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('label_design.add_new_design'); ?></h1>
</section>

<section class="content">
<?php echo Form::open(['url' => action([\App\Http\Controllers\LabelDesignController::class, 'store']), 'method' => 'post', 'id' => 'add_label_design_form']); ?>

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('name', __('label_design.design_name') . ':*'); ?>

                        <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('label_design.design_name')]); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('description', __('barcode.setting_description')); ?>

                        <?php echo Form::text('description', null, ['class' => 'form-control', 'placeholder' => __('barcode.setting_description')]); ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('width', __('label_design.label_width') . ' (mm):*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-arrows-h"></i></span>
                            <?php echo Form::number('width', 66.7, ['class' => 'form-control', 'required', 'step' => '0.1', 'min' => '10', 'max' => '305']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('height', __('label_design.label_height') . ' (mm):*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-arrows-v"></i></span>
                            <?php echo Form::number('height', 25.4, ['class' => 'form-control', 'required', 'step' => '0.1', 'min' => '5', 'max' => '305']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sticker_columns', __('label_design.sticker_columns') . ':*'); ?>

                        <?php echo Form::select('sticker_columns', ['1' => '1 ' . __('label_design.column'), '2' => '2 ' . __('label_design.columns_plural'), '3' => '3 ' . __('label_design.columns_plural')], '1', ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2 mt-4">
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('is_default', 1, false, ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('barcode.set_as_default'); ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('label_design.create_and_design'); ?>
            </button>
        </div>
    </div>
<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>