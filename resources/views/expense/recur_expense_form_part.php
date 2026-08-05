<div class="box box-primary <?php if(!empty($expense->type) && $expense->type == 'expense_refund'): ?> hide <?php endif; ?>" id="recur_expense_div">
	<div class="box-body box box-primary">
		<div class="row">
			<div class="col-md-4 col-sm-6">
				<br>
				<label class="form-check-label">
<?php echo Form::checkbox('is_recurring', 1, !empty($expense->is_recurring) == 1, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.is_recurring'); ?>?
	            </label><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.recurring_expense_help') . '"></i>';
                }
            ?>
			</div>
			<div class="col-md-4 col-sm-6">
		        <div class="mb-3">
		        	<?php echo Form::label('recur_interval', __('lang_v1.recur_interval') . ':*' ); ?>

		        	<div class="input-group">
		               <?php echo Form::number('recur_interval', !empty($expense->recur_interval) ? $expense->recur_interval : null, ['class' => 'form-control', 'style' => 'width: 50%;']); ?>

		               
		                <?php echo Form::select('recur_interval_type', ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')], !empty($expense->recur_interval_type) ? $expense->recur_interval_type : 'days', ['class' => 'form-select', 'style' => 'width: 50%;', 'id' => 'recur_interval_type']); ?>

		                
		            </div>
		        </div>
		    </div>

		    <div class="col-md-4 col-sm-6">
		        <div class="mb-3">
		        	<?php echo Form::label('recur_repetitions', __('lang_v1.no_of_repetitions') . ':' ); ?>

		        	<?php echo Form::number('recur_repetitions', !empty($expense->recur_repetitions) ? $expense->recur_repetitions : null, ['class' => 'form-control']); ?>

			        <p class="help-block"><?php echo app('translator')->get('lang_v1.recur_expense_repetition_help'); ?></p>
		        </div>
		    </div>
		    <?php
		    	$repetitions = [];
		    	for ($i=1; $i <= 30; $i++) { 
		    		$repetitions[$i] = str_ordinal($i);
		        }
		    ?>
		    <div class="recur_repeat_on_div col-md-4 <?php if(empty($expense->recur_interval_type)): ?> hide <?php elseif(!empty($expense->recur_interval_type) && $expense->recur_interval_type != 'months'): ?> hide <?php endif; ?>">
		        <div class="mb-3">
		        	<?php echo Form::label('subscription_repeat_on', __('lang_v1.repeat_on') . ':' ); ?>

		        	<?php echo Form::select('subscription_repeat_on', $repetitions, !empty($expense->subscription_repeat_on) ? $expense->subscription_repeat_on : null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

		        </div>
		    </div>
		</div>
	</div>
</div>
