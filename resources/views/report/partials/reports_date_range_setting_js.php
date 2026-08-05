<script type="text/javascript">
    if (typeof window.getAdminReportDateRangeSettings !== 'function') {
        window.getAdminReportDateRangeSettings = function(defaultSelector) {
            var reportDateRangeSettings = $.extend({}, dateRangeSettings);
            var dateRangeDefault = $(defaultSelector || '#reports_filter_date_range').val();

            if (dateRangeDefault == 'today') {
                reportDateRangeSettings.startDate = moment();
                reportDateRangeSettings.endDate = moment();
            } else if (dateRangeDefault == 'yesterday') {
                reportDateRangeSettings.startDate = moment().subtract(1, 'days');
                reportDateRangeSettings.endDate = moment().subtract(1, 'days');
            } else if (dateRangeDefault == 'last_seven_days') {
                reportDateRangeSettings.startDate = moment().subtract(6, 'day');
                reportDateRangeSettings.endDate = moment();
            } else if (dateRangeDefault == 'last_thirty_days') {
                reportDateRangeSettings.startDate = moment().subtract(29, 'day');
                reportDateRangeSettings.endDate = moment();
            } else if (dateRangeDefault == 'this_month') {
                reportDateRangeSettings.startDate = moment().startOf('month');
                reportDateRangeSettings.endDate = moment();
            } else if (dateRangeDefault == 'last_month') {
                reportDateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
                reportDateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
            } else if (dateRangeDefault == 'this_year') {
                reportDateRangeSettings.startDate = moment().startOf('year');
                reportDateRangeSettings.endDate = moment();
            } else if (dateRangeDefault == 'last_year') {
                reportDateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
                reportDateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
            } else if (dateRangeDefault == 'current_financial_year' && typeof financial_year !== 'undefined') {
                reportDateRangeSettings.startDate = moment(financial_year.start);
                reportDateRangeSettings.endDate = moment(financial_year.end);
            } else if (dateRangeDefault == 'all_time') {
                reportDateRangeSettings.startDate = moment(business_start_date);
                reportDateRangeSettings.endDate = moment();
            }

            return reportDateRangeSettings;
        };
    }
</script>
