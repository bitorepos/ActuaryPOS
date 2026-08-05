<?php $is_excel = true; ?>

<table>
    <thead>
        <tr>
            <th colspan="27" style="font-size:14px; font-weight:bold;">Stock Value Report - Location Details</th>
        </tr>
        <tr><td colspan="27"></td></tr>
    </thead>
</table>

<?php echo $__env->make('report.partials.stock_value_location_details_data', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
