<div class="table-responsive">
	<table class="table table-bordered table-striped table-th-skin" id="subscriptions_table">
		<thead>
			<tr>
				<th><?php echo app('translator')->get('messages.date'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.subscription_no'); ?></th>
				<th><?php echo app('translator')->get('sale.customer_name'); ?></th>
                <th><?php echo app('translator')->get('sale.location'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.subscription_interval'); ?></th>
				<th><?php echo app('translator')->get('lang_v1.no_of_repetitions'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.generated_invoices'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.last_generated'); ?></th>
                <th><?php echo app('translator')->get('lang_v1.upcoming_invoice'); ?></th>
				<th><?php echo app('translator')->get('messages.action'); ?></th>
			</tr>
		</thead>
	</table>
</div>
