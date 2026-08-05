
<?php $__env->startSection('title', __('label_design.edit_design')); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><?php echo app('translator')->get('label_design.edit_design'); ?>: <?php echo e($design->name, false); ?></h1>
</section>

<section class="content">
<?php echo Form::open(['url' => action([\App\Http\Controllers\LabelDesignController::class, 'update'], [$design->id]), 'method' => 'PUT', 'id' => 'edit_label_design_form']); ?>

    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('name', __('label_design.design_name') . ':*'); ?>

                        <?php echo Form::text('name', $design->name, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('description', __('barcode.setting_description')); ?>

                        <?php echo Form::text('description', $design->description, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('width', __('label_design.label_width') . ' (mm):*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-arrows-h"></i></span>
                            <?php echo Form::number('width', $design->width, ['class' => 'form-control', 'required', 'step' => '0.1', 'min' => '10', 'max' => '305']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('height', __('label_design.label_height') . ' (mm):*'); ?>

                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-arrows-v"></i></span>
                            <?php echo Form::number('height', $design->height, ['class' => 'form-control', 'required', 'step' => '0.1', 'min' => '5', 'max' => '305']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sticker_columns', __('label_design.sticker_columns') . ':*'); ?>

                        <?php echo Form::select('sticker_columns', ['1' => '1 ' . __('label_design.column'), '2' => '2 ' . __('label_design.columns_plural'), '3' => '3 ' . __('label_design.columns_plural')], $design->sticker_columns, ['class' => 'form-control', 'required']); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo app('translator')->get('messages.update'); ?></button>
            <a href="<?php echo e(action([\App\Http\Controllers\LabelDesignController::class, 'designer'], [$design->id]), false); ?>" class="btn btn-info"><i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('label_design.open_designer'); ?></a>
        </div>
    </div>
<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>