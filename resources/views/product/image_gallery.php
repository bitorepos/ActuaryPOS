
<?php $__env->startSection('title', 'Product Image Gallery'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Product Image Gallery
        <small><?php echo e($stats['total'], false); ?> images</small>
    </h1>
</section>

<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(!empty(session('status')['success']) ? 'success' : 'danger', false); ?>">
            <?php echo e(session('status')['msg'] ?? '', false); ?>

        </div>
    <?php endif; ?>

    <div class="box box-solid">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo e($stats['total'], false); ?></h3>
                            <p>Total Images</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?php echo e($stats['linked'], false); ?></h3>
                            <p>Linked To Products</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?php echo e($stats['unlinked'], false); ?></h3>
                            <p>Unlinked Files</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'imageGallery']), 'method' => 'get', 'id' => 'image_gallery_search_form']); ?>

                        <div class="input-group">
                            <input type="text" name="search" id="image_gallery_search" class="form-control" value="<?php echo e($search, false); ?>" placeholder="Search filename" autocomplete="off">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'uploadImageGallery']), 'method' => 'post', 'files' => true, 'class' => 'image-gallery-upload']); ?>

                    <div class="row">
                        <div class="col-sm-8">
                            <input type="file" name="images[]" class="form-control" multiple accept="image/*">
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-upload"></i> Upload Images
                            </button>
                        </div>
                    </div>
                <?php echo Form::close(); ?>

            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.update')): ?>
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'linkImageGalleryBySku']), 'method' => 'post', 'id' => 'image_gallery_link_by_sku_form', 'class' => 'image-gallery-link-by-sku']); ?>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-link"></i> Link Images By SKU
                    </button>
                <?php echo Form::close(); ?>

            <?php endif; ?>
        </div>
    </div>

    <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'deleteImageGallery']), 'method' => 'post', 'id' => 'image_gallery_delete_form']); ?>

        <div class="box box-solid">
            <div class="box-header with-border">
                <div class="pull-left">
                    <label class="gallery-select-all">
                        <input type="checkbox" id="select_all_gallery_images"> Select all visible
                    </label>
                </div>
                <div class="pull-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.update')): ?>
                        <div class="input-group input-group-sm gallery-link-sku-control">
                            <input type="text" name="link_sku" id="image_gallery_link_sku" class="form-control" placeholder="SKU">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-success" id="link_selected_images_to_sku" formaction="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'linkSelectedImageGalleryToSku']), false); ?>">
                                    <i class="fa fa-link"></i> Link To SKU
                                </button>
                            </span>
                        </div>
                        <button type="submit" class="btn btn-danger btn-sm" id="delete_selected_images">
                            <i class="fa fa-trash"></i> Delete Selected
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-body">
                <?php if($images->count() > 0): ?>
                    <div class="product-image-gallery-grid">
                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="product-image-gallery-item">
                                <input type="checkbox" name="selected_images[]" value="<?php echo e($image['key'], false); ?>" class="gallery-image-checkbox">
                                <span class="product-image-thumb">
                                    <img src="<?php echo e($image['url'], false); ?>" alt="<?php echo e($image['name'], false); ?>" loading="lazy">
                                </span>
                                <span class="product-image-name" title="<?php echo e($image['name'], false); ?>"><?php echo e($image['name'], false); ?></span>
                                <span class="product-image-meta">
                                    <?php echo e(number_format($image['size'] / 1024, 1), false); ?> KB
                                    <?php if(!empty($image['width']) && !empty($image['height'])): ?>
                                        - <?php echo e($image['width'], false); ?>x<?php echo e($image['height'], false); ?>

                                    <?php endif; ?>
                                </span>
                                <?php if($image['product_count'] > 0): ?>
                                    <span class="label label-success"><?php echo e($image['product_count'], false); ?> <?php echo e(strtolower($image['source_label']), false); ?></span>
                                <?php else: ?>
                                    <span class="label label-default">unlinked</span>
                                <?php endif; ?>
                                <span class="label label-info"><?php echo e($image['source_label'], false); ?></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="text-muted">No product images found.</div>
                <?php endif; ?>
            </div>
            <div class="box-footer clearfix">
                <div class="pull-right">
                    <?php echo e($images->links(), false); ?>

                </div>
            </div>
        </div>
    <?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    var imageGallerySearchTimer = null;
    var imageGalleryLastSearch = $('#image_gallery_search').val() || '';

    $(document).on('input', '#image_gallery_search', function() {
        var searchValue = $(this).val() || '';

        clearTimeout(imageGallerySearchTimer);
        imageGallerySearchTimer = setTimeout(function() {
            if (searchValue !== imageGalleryLastSearch) {
                imageGalleryLastSearch = searchValue;
                $('#image_gallery_search_form').submit();
            }
        }, 450);
    });

    $(document).on('change', '#select_all_gallery_images', function() {
        $('.gallery-image-checkbox').prop('checked', $(this).is(':checked'));
    });

    var imageGallerySelectedAction = 'delete';

    $(document).on('click', '#delete_selected_images', function() {
        imageGallerySelectedAction = 'delete';
    });

    $(document).on('click', '#link_selected_images_to_sku', function() {
        imageGallerySelectedAction = 'link';
    });

    $(document).on('submit', '#image_gallery_delete_form', function() {
        if ($('.gallery-image-checkbox:checked').length === 0) {
            toastr.error('Select at least one image.');
            return false;
        }

        if (imageGallerySelectedAction === 'link') {
            if (! $.trim($('#image_gallery_link_sku').val())) {
                toastr.error('Enter SKU.');
                return false;
            }

            return confirm('Link selected images to this SKU?');
        }

        return confirm('Delete selected images? Product image references will be set to default.');
    });

    $(document).on('submit', '#image_gallery_link_by_sku_form', function() {
        return confirm('Link unlinked images to products with matching SKU names?');
    });
</script>
<style>
    .image-gallery-upload {
        margin-top: 12px;
    }

    .image-gallery-link-by-sku {
        margin-top: 12px;
    }

    .gallery-select-all {
        margin-top: 5px;
        font-weight: 400;
    }

    .gallery-link-sku-control {
        display: inline-table;
        width: 260px;
        margin-right: 8px;
        vertical-align: middle;
    }

    .product-image-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(132px, 1fr));
        gap: 16px;
    }

    .product-image-gallery-item {
        position: relative;
        display: block;
        min-width: 0;
        margin: 0;
        padding: 8px;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        background: #fff;
        cursor: pointer;
        font-weight: 400;
    }

    .product-image-gallery-item input {
        position: absolute;
        top: 8px;
        left: 8px;
        z-index: 2;
    }

    .product-image-thumb {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 118px;
        margin-bottom: 8px;
        background: #f7f7f7;
        overflow: hidden;
    }

    .product-image-thumb img {
        max-width: 100%;
        max-height: 118px;
        object-fit: contain;
    }

    .product-image-name,
    .product-image-meta {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-image-name {
        color: #111827;
        font-size: 12px;
    }

    .product-image-meta {
        color: #6b7280;
        font-size: 11px;
        margin-bottom: 4px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>