
<?php $__env->startSection('title', __('sale.discount')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'sale.discounts' ); ?>
    </h1>
    
</section>

<!-- Main content -->
<section class="content">

    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
    
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_location_id', __('purchase.business_location') . ':'); ?>

            <?php echo Form::select('discount_filter_location_id', $locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_location_id']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_date_range', __('report.date_range') . ':'); ?>

            <?php echo Form::text('discount_filter_date_range', '', ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly', 'id' => 'discount_filter_date_range']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_status', __('lang_v1.status') . ':'); ?>

            <?php echo Form::select('discount_filter_status', ['' => __('lang_v1.all'), 'active' => __('lang_v1.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'discount_filter_status']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_base_type', __('lang_v1.type') . ':'); ?>

            <?php echo Form::select('discount_filter_base_type', ['' => __('lang_v1.all'), 'product' => 'Product Based', 'invoice' => 'Invoice Based'], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'discount_filter_base_type']); ?>

        </div>
    </div>

    
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_discount_type', __('sale.discount_type') . ':'); ?>

            <?php echo Form::select('discount_filter_discount_type', [
                '' => __('lang_v1.all'),
                'fixed' => __('lang_v1.fixed'),
                'percentage' => __('lang_v1.percentage'),
                'buy_for' => __('lang_v1.buy_for'),
                'buy_for_unit_price' => __('lang_v1.buy_for_unit_price'),
                'buy_get_free' => __('lang_v1.buy_get_free'),
            ], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'discount_filter_discount_type']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_brand_id', __('product.brand') . ':'); ?>

            <?php echo Form::select('discount_filter_brand_id', $brands, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_brand_id']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_category_id', __('product.category') . ':'); ?>

            <?php echo Form::select('discount_filter_category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_category_id']); ?>

        </div>
    </div>
    <?php if(!empty($price_groups)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_spg', __('lang_v1.selling_price_group') . ':'); ?>

            <?php echo Form::select('discount_filter_spg', $price_groups, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_spg']); ?>

        </div>
    </div>
    <?php endif; ?>

    
    <?php if(session('business.enable_gender')): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_gender_id', __('product.gender') . ':'); ?>

            <?php echo Form::select('discount_filter_gender_id', $genders, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_gender_id']); ?>

        </div>
    </div>
    <?php endif; ?>
    <?php if(session('business.enable_procurement_source')): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_procurement_source_id', __('product.procurement_source') . ':'); ?>

            <?php echo Form::select('discount_filter_procurement_source_id', $procurement_sources, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all'), 'id' => 'discount_filter_procurement_source_id']); ?>

        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_filter_day', __('lang_v1.discount_days') . ':'); ?>

            <?php echo Form::select('discount_filter_day', [
                '' => __('lang_v1.all'),
                'Monday' => __('lang_v1.monday'),
                'Tuesday' => __('lang_v1.tuesday'),
                'Wednesday' => __('lang_v1.wednesday'),
                'Thursday' => __('lang_v1.thursday'),
                'Friday' => __('lang_v1.friday'),
                'Saturday' => __('lang_v1.saturday'),
                'Sunday' => __('lang_v1.sunday'),
            ], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'discount_filter_day']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('discount_search_product', __('lang_v1.search_product') . ':'); ?>

            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input type="hidden" value="" id="discount_filter_variation_id">
                <?php echo Form::text('discount_search_product', null, ['class' => 'form-control', 'id' => 'discount_search_product', 'placeholder' => __('lang_v1.search_product_placeholder')]); ?>

                <span class="input-group-text" id="discount_search_product_clear" style="cursor:pointer;" title="<?php echo app('translator')->get('messages.reset'); ?>"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <br>
            <label class="form-check-label">
                <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
            </label>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>

	<div class="box box-primary">
        <div class="box-header">
        	<h3 class="box-title"><?php echo app('translator')->get('lang_v1.all_your_discounts'); ?></h3>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand.create')): ?>
            	<div class="box-tools">
                    <a href="<?php echo e(action([\App\Http\Controllers\DiscountController::class, 'create'], ['full_page' => 1]), false); ?>" class="btn btn-block btn-primary">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <div class="box-body">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand.view')): ?>
                <div class="table-responsive">
            	<table class="table table-bordered table-striped table-th-skin" id="discounts_table">
            		<thead>
            			<tr>
                            <th><input type="checkbox" id="select-all-row" data-table-id="discounts_table"></th>
            				<th><?php echo app('translator')->get( 'unit.name' ); ?></th>
            				<th><?php echo app('translator')->get( 'lang_v1.starts_at' ); ?></th>
            				<th><?php echo app('translator')->get( 'lang_v1.ends_at' ); ?></th>
                            <th><?php echo app('translator')->get( 'sale.discount_amount' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.priority' ); ?></th>
                            <th><?php echo app('translator')->get( 'product.brand' ); ?></th>
                            <th><?php echo app('translator')->get( 'product.category' ); ?></th>
                            <th><?php echo app('translator')->get( 'product.gender' ); ?></th>
                            <th><?php echo app('translator')->get( 'product.procurement_source' ); ?></th>
                            <th><?php echo app('translator')->get( 'report.products' ); ?></th>
                            <th><?php echo app('translator')->get( 'sale.location' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
            			</tr>
            		</thead>
                    <tfoot>
                    <tr>
                        <td colspan="13">
                        <div style="display: flex; width: 100%;">
                            <?php echo Form::open(['url' => action([\App\Http\Controllers\DiscountController::class, 'massDeactivate']), 'method' => 'post', 'id' => 'mass_deactivate_form' ]); ?>

                            <?php echo Form::hidden('selected_discounts', null, ['id' => 'selected_discounts']); ?>

                            <?php echo Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-sm btn-warning', 'id' => 'deactivate-selected')); ?>

                            <?php echo Form::close(); ?>

                            </div>
                        </td>
                    </tr>
                </tfoot>
            	</table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal fade discount_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    // Date range picker for discount filter
    $('#discount_filter_date_range').daterangepicker(
        dateRangeSettings,
        function(start, end) {
            $('#discount_filter_date_range').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            discounts_table.ajax.reload();
        }
    );
    $('#discount_filter_date_range').on('cancel.daterangepicker', function() {
        $(this).val('');
        discounts_table.ajax.reload();
    });

    // Reload table on filter change
    $('#discount_filter_location_id, #discount_filter_status, #discount_filter_brand_id, #discount_filter_base_type, #discount_filter_discount_type, #discount_filter_category_id, #discount_filter_spg, #discount_filter_gender_id, #discount_filter_procurement_source_id, #discount_filter_day').on('change', function() {
        discounts_table.ajax.reload();
    });

    // Product search autocomplete
    $('#discount_search_product').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/purchases/get_products?check_enable_stock=false&hide_combo=false',
                dataType: 'json',
                data: { term: request.term },
                success: function(data) {
                    response($.map(data, function(v) {
                        if (v.variation_id) {
                            // Replace literal <br> markup with " - " so the
                            // autocomplete dropdown and selected text don't
                            // show raw HTML tags.
                            var plainLabel = String(v.text || '').replace(/<br\s*\/?>/gi, ' - ');
                            return { label: plainLabel, value: v.variation_id };
                        }
                        return false;
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $('#discount_filter_variation_id').val(ui.item.value);
            event.preventDefault();
            $(this).val(ui.item.label);
            discounts_table.ajax.reload();
        },
        focus: function(event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
        }
    });

    // Clear product search
    $('#discount_search_product_clear').on('click', function() {
        $('#discount_search_product').val('');
        $('#discount_filter_variation_id').val('');
        discounts_table.ajax.reload();
    });

    // Also clear variation_id if text is manually cleared
    $('#discount_search_product').on('keyup', function() {
        if ($(this).val().trim() === '') {
            $('#discount_filter_variation_id').val('');
            discounts_table.ajax.reload();
        }
    });

    $(document).on('click', '#deactivate-selected', function(e){
        e.preventDefault();
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        }); 
        
        if(selected_rows.length > 0){
            $('input#selected_discounts').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('form#mass_deactivate_form').submit();
                }
            });
        } else{
            $('input#selected_discounts').val('');
            swal('<?php echo app('translator')->get("lang_v1.no_row_selected"); ?>');
        }    
    });

    $(document).on('click', '.activate-discount', function(e){
        e.preventDefault();
        var href = $(this).data('href');
        $.ajax({
            method: "get",
            url: href,
            dataType: "json",
            success: function(result){
                if(result.success == true){
                    toastr.success(result.msg);
                    discounts_table.ajax.reload();
                } else {
                    toastr.error(result.msg);
                }
            }
        });
    });

    $(document).on('change', 'input#show_deleted', function(e) {
        discounts_table.ajax.reload();
    });
</script>
<?php echo $__env->make('discount.partials.form_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>