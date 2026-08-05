
<?php $__env->startSection('title', __('lang_v1.add_purchase_requisition')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.add_purchase_requisition'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\PurchaseRequisitionController::class, 'store']), 'method' => 'post', 'id' => 'add_purchase_requisition_form' ]); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<div class="row">
			<?php if(count($business_locations) == 1): ?>
            	<?php
				$default_location = current(array_keys($business_locations->toArray()));
				$search_disable = false;
				?>
			<?php else: ?>
				<?php
				$default_location = null;
				$user_settings = json_decode(auth()->user()->user_settings,true);
				if(isset($user_settings['default_location']) && !empty($user_settings['default_location'])){
					$default_location = $user_settings['default_location'];
				}else{
					$default_location = current(array_keys($business_locations->toArray()));
				}
				$search_disable = true;
				?>
			<?php endif; ?>
			<div class="col-sm-4">
				<div class="form-group mb-2">
					<?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

					<?php echo Form::select('location_id', $business_locations, $default_location, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select')]); ?>

				</div>
			</div>
			<div class="col-sm-4">
          		<div class="mb-3">
            		<?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

              		<?php echo Form::select('brand_id[]', $brands, null, ['class' => 'form-control select2', 'multiple', 'id' => 'brand_id']); ?>

           
          		</div>
        	</div>
        	<div class="col-sm-4 <?php if(!session('business.enable_category')): ?> hide <?php endif; ?>">
          		<div class="mb-3">
            		<?php echo Form::label('category_id', __('product.category') . ':'); ?>

              		<?php echo Form::select('category_id[]', $categories, null, ['class' => 'form-control select2', 'multiple', 'id' => 'category_id']); ?>

          		</div>
        	</div>
		</div>
		<div class="row">
			<div class="col-sm-12 text-right">
				<br>
				<button type="button" class="btn bg-yellow" id="show_pr_products"><i class="fas fa-search"></i> <?php echo app('translator')->get('lang_v1.show_products'); ?></button>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<div class="row">
			<div class="col-sm-4">
				<div class="form-group mb-2">
					<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

					<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.leave_empty_to_autogenerate') . '"></i>';
                }
            ?>
					<?php echo Form::text('ref_no', null, ['class' => 'form-control']); ?>

				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group mb-2">
					<?php echo Form::label('delivery_date', __('lang_v1.required_by_date') . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-calendar"></i>
						</span>
						<?php echo Form::text('delivery_date', null, ['class' => 'form-control', 'readonly']); ?>

					</div>
				</div>
			</div>
		</div>	
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
<table class="table table-th-skin" id="products_list">
					<thead>
						<tr>
							<th width="40%"><?php echo app('translator')->get('sale.product'); ?></th>
							<th width="20%"><?php echo app('translator')->get('product.alert_quantity_low'); ?></th>
							<th width="35%"><?php echo app('translator')->get('lang_v1.required_quantity'); ?></th>
							<th width="5%"><i class="text-danger fas fa-trash"></i></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<div class="row">
		<div class="col-sm-12 text-center">
			<button type="button" class="btn btn-primary btn-flat btn-lg" id="submit_pr_form"><?php echo app('translator')->get('messages.save'); ?></button>
		</div>
	</div>

<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script type="text/javascript">
		$(document).ready( function(){
      		__page_leave_confirmation('#add_purchase_requisition_form');
      		$('#delivery_date').datetimepicker({
                format: moment_date_format + ' ' + moment_time_format,
                ignoreReadonly: true,
            });

            var data = {
            	location_id: $('#location_id').val(),
            	brand_id: $('#brand_id').val(),
            	category_id: $('#category_id').val()
            }

            $('#show_pr_products').click( function(){
            	if ($('#location_id').val() == '') {
            		alert('<?php echo e(__("lang_v1.select_location"), false); ?>');
            		return false;
            	}
            	var data = {
	            	location_id: $('#location_id').val(),
	            	brand_id: $('#brand_id').val(),
	            	category_id: $('#category_id').val()
	            }

            	$.ajax({
                    method: 'post',
                    url: "<?php echo e(route('get-requisition-products'), false); ?>",
                    dataType: 'html',
                    data: data,
                    success: function(result) {
                    	var rows = $(result);
                    	rows.find('tr').each(function(){
                    		var row_variation_id = $(this).attr('data-variation_id');
                    		if ($('tr[data-variation_id="' + row_variation_id + '"]').length == 0) {
                    			$('#products_list tbody').append($(this));
                    		}
                    	})
                        
                    },
                });
            });
    	});

		var prev_location;

		$('#location_id').on('select2:selecting', function(){
		    prev_location = $(this).val();
		})

		$('#location_id').on('select2:select', function(){
			if ($('#products_list tbody').find('tr').length > 0){
        		swal({
		            title: LANG.sure,
		            text: '<?php echo e(__("lang_v1.all_added_products_will_be_removed"), false); ?>',
		            icon: 'warning',
		            buttons: true,
		            dangerMode: true,
		        }).then(willDelete => {
		            if (willDelete) {
		                $('#products_list tbody').html('');
		            } else {
		        		$('#location_id').val(prev_location);
		        		$('#location_id').change();
		        		return false;
		        	}
		        });
        	}
		});

    	$(document).on('click', 'button.remove_product_line', function(){
    		$(this).closest('tr').remove();
    	})

    	$(document).on('click', 'button#submit_pr_form', function(e){
    		e.preventDefault();
		var submit_buttons = $('button#submit_pr_form');

		if ($('form#add_purchase_requisition_form').data('purchase_requisition_submit_locked')) {
			return false;
		}

		$('form#add_purchase_requisition_form').data('purchase_requisition_submit_locked', true);
		submit_buttons.prop('disabled', true);

    		if ($('#products_list tbody').find('tr').length == 0){
    			toastr.warning(LANG.no_products_added);
			$('form#add_purchase_requisition_form').removeData('purchase_requisition_submit_locked');
			submit_buttons.prop('disabled', false);
    			return false;
    		}
    		if ($('form#add_purchase_requisition_form').valid()) {
    			$('form#add_purchase_requisition_form').submit();
		} else {
			$('form#add_purchase_requisition_form').removeData('purchase_requisition_submit_locked');
			submit_buttons.prop('disabled', false);
    		}
    		
    	})
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>