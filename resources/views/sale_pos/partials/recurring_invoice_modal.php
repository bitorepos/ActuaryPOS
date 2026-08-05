<!-- Edit discount Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="recurringInvoiceModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('lang_v1.subscribe'); ?> <?php echo e($form, false); ?> <?php if(!empty($transaction->subscription_no)): ?> - <?php echo e($transaction->subscription_no, false); ?> <?php endif; ?></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
				        <div class="mb-3">
				        	<?php echo Form::label('recur_interval', __('lang_v1.subscription_interval') . ':*' ); ?>

				        	<div class="input-group">
				               <?php echo Form::number('recur_interval', !empty($transaction->recur_interval) ? $transaction->recur_interval : null, array_merge(['class' => 'form-control', 'required', 'style' => 'width: 50%;'], !empty($form) ? ['form' => $form] : [])); ?>

				               
				                <?php echo Form::select('recur_interval_type', ['days' => __('lang_v1.days'), 'months' => __('lang_v1.months'), 'years' => __('lang_v1.years')], !empty($transaction->recur_interval_type) ? $transaction->recur_interval_type : 'days', array_merge(['class' => 'form-control', 'required', 'style' => 'width: 50%;', 'id' => 'recur_interval_type'], !empty($form) ? ['form' => $form] : [])); ?>

				                
				            </div>
				        </div>
				    </div>

				    <div class="col-md-6">
				        <div class="mb-3">
				        	<?php echo Form::label('recur_repetitions', __('lang_v1.no_of_repetitions') . ':' ); ?>

				        	<?php echo Form::number('recur_repetitions', !empty($transaction->recur_repetitions) ? $transaction->recur_repetitions : null, array_merge(['class' => 'form-control'], !empty($form) ? ['form' => $form] : [])); ?>

					        <p class="help-block"><?php echo app('translator')->get('lang_v1.recur_repetition_help'); ?></p>
				        </div>
				    </div>
				    <?php
				    	$repetitions = [];
				    	for ($i=1; $i <= 30; $i++) { 
				    		$repetitions[$i] = str_ordinal($i);
				        }
				    ?>
				    <div class="subscription_repeat_on_div col-md-6 <?php if(empty($transaction->recur_interval_type)): ?> hide <?php elseif(!empty($transaction->recur_interval_type) && $transaction->recur_interval_type != 'months'): ?> hide <?php endif; ?>">
				        <div class="mb-3">
				        	<?php echo Form::label('subscription_repeat_on', __('lang_v1.repeat_on') . ':' ); ?>

				        	<?php echo Form::select('subscription_repeat_on', $repetitions, !empty($transaction->subscription_repeat_on) ? $transaction->subscription_repeat_on : null, array_merge(['class' => 'form-control', 'placeholder' => __('messages.please_select')], !empty($form) ? ['form' => $form] : [])); ?>

				        </div>
				    </div>

				</div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
