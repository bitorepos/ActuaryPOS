
<?php $__env->startSection('title', __('lang_v1.offline_sync')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.offline_sync'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php
        $is_superadmin = auth()->user()->can('subscription');
    ?>
    <div class="row">
        <?php if(!$is_offline): ?>
        <div class="col-md-12">
            <div class="alert alert-info ">
                <strong>Note: Sync Options are Available on Offline Deployement</strong>
            </div>
        </div>
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'Generate User Access Token']); ?>
                <div class="col-md-12">
                    <?php if(empty(session('access_token'))): ?>
                    <?php echo Form::open(['url' => action([\App\Http\Controllers\OfflineSyncController::class, 'generateAccessToken']), 'method' => 'post', 'id' => 'gnerate_access_token' ]); ?>

                    <p>Enter Secret <small>(Obtained from Superadmin)</small></p>
                    <input class="form-control" type="text" name="secret" value=""><br>
                    <p>Enter Username</p>
                    <input class="form-control" type="username" name="username" value=""><br>
                    <p>Enter your Password</p>
                    <input class="form-control" type="password" name="password" value=""><br>
                    <button href="#" type="submit" class="btn btn-success btn-flat">Generate</button>
                    
                    <?php echo Form::close(); ?>

                    <?php else: ?> 
                        <p>Current Access Token</p>
                        <p>
                            <?php echo e(session('access_token'), false); ?>

                        </p>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <br>
                    <b>Note:</b>
                    <p>
                        Enter the Secret Key provided by superamdin.
                        <br>
                        Enter username and password of user for which you want to generate access token.
                        <br>
                        If access token already exists for user it will be revoked only after a new token is issued successfully.
                        <br>
                        Do not generate a new token for a cloud status timeout message; use the latest generated token in the offline .env file.
                    </p>
                    
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'Downloads']); ?>
                <div class="col-md-6">
                    <h4>Export Database for Offline Deployement</h4>
                    <p>Please only use this for First Time Install, or Restoring as Backup.</p>
                    <a href="<?php echo e(route('export.database'), false); ?>" class="btn btn-info download_db">Download</a>
                </div>
                <div class="col-md-6">
                    <h4>Offline Deployement Package</h4>
                    <a href="#" class="btn btn-info">Download</a>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <?php elseif($is_offline): ?>
            <?php
                $connection_class = $connection['success'] === true ? 'alert-success' : ($connection['success'] === false ? 'alert-warning' : 'alert-info');
            ?>
            <div class="col-md-12">
                <div class="alert <?php echo e($connection_class, false); ?>">
                    <strong><?php echo e($connection['msg'], false); ?></strong>
                </div>
            </div>

            
            <div class="col-md-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#upload_sync" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-arrow-up" aria-hidden="true"></i> Upload Syncronization
                            </a>
                        </li>
                        <li>
                            <a href="#download_sync" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-arrow-down" aria-hidden="true"></i> Download Syncronization
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="upload_sync">
                            <div class="col-md-12 text-center h3 text-danger">Last Sync: <?php echo format_datetime_br($up_latest_updated_at); ?></div>    
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Lasy Synced</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Sales</td>
                                        <td class="sync_date"><?php echo format_datetime_br($upload_sync_data['sales_sync']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_sales">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sale Returns</td>
                                        <td class="sync_date"><?php echo format_datetime_br($upload_sync_data['sales_sync']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_sale_returns">Sync</button>
                                        </td>
                                    </tr>
                                    <?php if(!empty($pos_settings['enable_sales_order'])): ?>
                                    <tr>
                                        <td>Import Sale Orders</td>
                                        <td class="sync_date"><?php echo format_datetime_br($upload_sync_data['sales_sync']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_sale_orders">Sync</button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                
                                </tbody>
                            </table>
                            <p>Note: If any Type doesn't have anything created on live, it shows the business start date as last sync date</p>
                        </div>
                        
                        <div class="tab-pane" id="download_sync">
                            <div class="col-md-12 text-center h3 text-danger">Last Sync: <?php echo format_datetime_br($down_latest_updated_at); ?></div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Lasy Synced</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Business Settings</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['business_settings']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_business_settings">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Transaction Backup Settings</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['transaction_backup_settings'] ?? $down_sync_data['business_settings']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_transaction_backup_settings">Sync</button>
                                        </td>
                                    </tr>
                                    <?php if(in_array('account', $enabled_modules)): ?>
                                    <tr>
                                        <td>Payment Accounts</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['payment_accounts']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_payment_accounts">Sync</button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td>Location Settings</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['location_settings']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_business_locations">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Invoice Settings</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['invoice_settings']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_invoice_settings">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Security Role</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['security_role']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_security_roles">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>User List</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['user_list']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_users">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Drug Classes</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['drug_classes'] ?? $down_sync_data['business_settings']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_drug_classes">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tables</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['tables']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_tables">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Quick Menu</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['quick_menu']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_quick_menu">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['tax']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_taxes">Sync</button>
                                        </td>
                                    </tr>
                                    <?php if(in_array('types_of_service', $enabled_modules)): ?>
                                    <tr>
                                        <td>Types of Service</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['types_of_service']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_types_of_service">Sync</button>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <tr>
                                        <td>Products</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['product']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_products">Sync</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contacts</td>
                                        <td class="sync_date"> <?php echo format_datetime_br($down_sync_data['contact']); ?></td>
                                        <td>
                                            <button class="btn btn-info sync_buttons" id="sync_contacts">Sync</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>    
                            <p>Note: If any Type doesn't have anything created on live, it shows the business start date as last sync date</p>
                        </div>
                        
                    </div>
                </div>
            </div>
    
        <?php endif; ?>
    </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready( function() {
        var loader = __fa_awesome();
        
        $('#sync_all').click( function(){
            var btn_html = $(this).text(); 
            $('.sync_buttons').html('Syncing '+loader);
            $(this).html(btn_html+' '+loader);
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncAll']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('.sync_buttons').html('Sync');
                    $('#sync_all').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_business_settings').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader);
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncBusinessSettings']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_business_settings').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_business_settings').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });
        });

        $('#sync_transaction_backup_settings').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader);
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncTransactionBackupSettings']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_transaction_backup_settings').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_transaction_backup_settings').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });
        });

        $('#sync_sales').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncSales']), false); ?>",
                dataType: "json",
                timeout: 600000,
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_sales').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_sales').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                },
                error: function(xhr, status, error){
                    if(status === 'timeout'){
                        toastr.error('Sales sync timed out. Please try again.');
                    } else {
                        toastr.error('Sales sync failed: ' + error);
                    }
                    $('#sync_sales').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_sale_returns').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncSaleReturns']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_sale_returns').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_sale_returns').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_sale_orders').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncSaleOrders']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_sale_orders').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_sale_orders').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });
        
        $('#sync_payment_accounts').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncPaymentAccounts']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_payment_accounts').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_payment_accounts').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_business_locations').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncBusinessLocations']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_business_locations').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_business_locations').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_invoice_settings').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncInvoiceSettings']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_invoice_settings').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_invoice_settings').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_users').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader);
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncUsers']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_users').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_users').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });
        });

        $('#sync_drug_classes').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader);
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncDrugClasses']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_drug_classes').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_drug_classes').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });
        });

        $('#sync_security_roles').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncSecurityRoles']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_security_roles').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_security_roles').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_tables').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncTables']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_tables').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_tables').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_quick_menu').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncQuickMenus']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_quick_menu').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_quick_menu').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_taxes').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncTaxRates']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_taxes').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_taxes').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_types_of_service').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncTypesOfService']), false); ?>",
                dataType: "json",
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_types_of_service').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_types_of_service').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_contacts').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncContacts']), false); ?>",
                dataType: "json",
                timeout: 600000,
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_contacts').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_contacts').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                },
                error: function(xhr, status, error){
                    if(status === 'timeout'){
                        toastr.error('Contacts sync timed out. Please try again.');
                    } else {
                        toastr.error('Contacts sync failed: ' + error);
                    }
                    $('#sync_contacts').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

        $('#sync_products').click( function(){
            var btn_html = $(this).text();
            $(this).html(btn_html+' '+loader); 
            $('.sync_buttons').attr('disabled', true);
            $.ajax({
                url: "<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncProducts']), false); ?>",
                dataType: "json",
                timeout: 600000,
                success: function(result){
                    if(result.success){
                        toastr.success(result.msg);
                        $('#sync_products').closest('tr').find('.sync_date').html(result.sync_date);
                    } else {
                        toastr.error(result.msg);
                    }
                    $('#sync_products').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                },
                error: function(xhr, status, error){
                    if(status === 'timeout'){
                        toastr.error('Products sync timed out. Please try again.');
                    } else {
                        toastr.error('Products sync failed: ' + error);
                    }
                    $('#sync_products').html(btn_html);
                    $('.sync_buttons').removeAttr('disabled');
                }
            });          
        });

    });


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>