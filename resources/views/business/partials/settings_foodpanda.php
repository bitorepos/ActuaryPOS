<div class="tab-content">
    <form method="POST" action="<?php echo e(route('update_business'), false); ?>" id="foodpanda-settings-form">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="tab" value="foodpanda_integration">

        <div class="row">
            <div class="col-md-8">
                <!-- Enable Integration -->
                <div class="form-group">
                    <label>
                        <input type="hidden" name="enable_foodpanda_integration" value="0">
                        <input type="checkbox" name="enable_foodpanda_integration" value="1"
                               <?php echo e($business_details->enable_foodpanda_integration ? 'checked' : '', false); ?>>
                        <?php echo app('translator')->get('foodpanda.enable_integration'); ?>
                    </label>
                    <p class="text-muted small">
                        <?php echo app('translator')->get('foodpanda.enable_integration_help'); ?>
                    </p>
                </div>

                <hr>

                <div id="foodpanda-credentials" style="display: <?php echo e($business_details->enable_foodpanda_integration ? 'block' : 'none', false); ?>">
                    <!-- API Configuration -->
                    <h5><?php echo app('translator')->get('foodpanda.api_configuration'); ?></h5>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.environment'); ?> <span class="text-danger">*</span></label>
                        <select name="foodpanda_environment" class="form-control">
                            <option value="staging" <?php echo e($business_details->foodpanda_environment === 'staging' ? 'selected' : '', false); ?>>
                                <?php echo app('translator')->get('foodpanda.staging'); ?>
                            </option>
                            <option value="production" <?php echo e($business_details->foodpanda_environment === 'production' ? 'selected' : '', false); ?>>
                                <?php echo app('translator')->get('foodpanda.production'); ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.api_username'); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="foodpanda_api_username" class="form-control"
                               value="<?php echo e($business_details->foodpanda_api_username, false); ?>"
                               placeholder="e.g., integration-username">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.api_username_help'); ?></small>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.api_password'); ?> <span class="text-danger">*</span></label>
                        <input type="password" name="foodpanda_api_password" class="form-control"
                               placeholder="Leave empty to keep current password">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.api_password_help'); ?></small>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.plugin_base_url'); ?> <span class="text-danger">*</span></label>
                        <input type="url" name="foodpanda_plugin_base_url" class="form-control"
                               value="<?php echo e($business_details->foodpanda_plugin_base_url, false); ?>"
                               placeholder="https://api.yourpos.com/foodpanda/">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.plugin_base_url_help'); ?></small>
                    </div>

                    <hr>

                    <!-- Integration Setup -->
                    <h5><?php echo app('translator')->get('foodpanda.integration_setup'); ?></h5>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.integration_code'); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="foodpanda_integration_code" class="form-control"
                               value="<?php echo e($business_details->foodpanda_integration_code, false); ?>"
                               placeholder="e.g., company-name-countrycode">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.integration_code_help'); ?></small>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.chain_code'); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="foodpanda_chain_code" class="form-control"
                               value="<?php echo e($business_details->foodpanda_chain_code, false); ?>"
                               placeholder="e.g., restaurant-name-countrycode">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.chain_code_help'); ?></small>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.default_currency'); ?></label>
                        <select name="foodpanda_default_currency" class="form-control">
                            <option value="">-- <?php echo app('translator')->get('messages.select'); ?> --</option>
                            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($currency->code, false); ?>"
                                        <?php echo e($business_details->foodpanda_default_currency === $currency->code ? 'selected' : '', false); ?>>
                                    <?php echo e($currency->code, false); ?> - <?php echo e($currency->name, false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <hr>

                    <!-- Vendor Mappings -->
                    <h5><?php echo app('translator')->get('foodpanda.vendor_mappings'); ?></h5>
                    <p class="text-muted small"><?php echo app('translator')->get('foodpanda.vendor_mappings_help'); ?></p>

                    <div id="vendor-mappings-container">
                        <?php if($business_details->foodpanda_vendor_mappings && count($business_details->foodpanda_vendor_mappings) > 0): ?>
                            <?php $__currentLoopData = $business_details->foodpanda_vendor_mappings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendorCode => $remoteId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group row vendor-mapping-row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control vendor-code"
                                               value="<?php echo e($vendorCode, false); ?>"
                                               placeholder="<?php echo app('translator')->get('foodpanda.vendor_code'); ?>" readonly>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control remote-id"
                                               name="vendor_mappings[<?php echo e($vendorCode, false); ?>]"
                                               value="<?php echo e($remoteId, false); ?>"
                                               placeholder="<?php echo app('translator')->get('foodpanda.remote_id'); ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-sm btn-danger remove-mapping">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <button type="button" class="btn btn-sm btn-primary" id="add-vendor-mapping">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('foodpanda.add_vendor_mapping'); ?>
                    </button>

                    <hr>

                    <!-- Order Processing -->
                    <h5><?php echo app('translator')->get('foodpanda.order_processing'); ?></h5>

                    <div class="form-group">
                        <label>
                            <input type="hidden" name="foodpanda_auto_accept_orders" value="0">
                            <input type="checkbox" name="foodpanda_auto_accept_orders" value="1"
                                   <?php echo e($business_details->foodpanda_auto_accept_orders ? 'checked' : '', false); ?>>
                            <?php echo app('translator')->get('foodpanda.auto_accept_orders'); ?>
                        </label>
                        <p class="text-muted small">
                            <?php echo app('translator')->get('foodpanda.auto_accept_orders_help'); ?>
                        </p>
                    </div>

                    <div class="form-group">
                        <label><?php echo app('translator')->get('foodpanda.order_sync_interval'); ?> (minutes)</label>
                        <input type="number" name="foodpanda_order_sync_interval" class="form-control"
                               value="<?php echo e($business_details->foodpanda_order_sync_interval ?? 60, false); ?>"
                               min="5" max="1440">
                        <small class="text-muted"><?php echo app('translator')->get('foodpanda.order_sync_interval_help'); ?></small>
                    </div>

                    <hr>

                    <!-- Connection Test -->
                    <div class="form-group">
                        <button type="button" class="btn btn-info" id="test-foodpanda-connection">
                            <i class="fa fa-plug"></i> <?php echo app('translator')->get('foodpanda.test_connection'); ?>
                        </button>
                        <span id="connection-status" class="ml-3"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5><?php echo app('translator')->get('foodpanda.integration_info'); ?></h5>
                    </div>
                    <div class="card-body">
                        <p><strong><?php echo app('translator')->get('foodpanda.webhook_url'); ?>:</strong></p>
                        <code style="word-break: break-all;"><?php echo e(route('webhook.foodpanda.order-dispatch', [], false), false); ?></code>

                        <hr>

                        <p><strong><?php echo app('translator')->get('foodpanda.ip_whitelist'); ?>:</strong></p>
                        <ul class="small">
                            <li><strong>Asia Pacific:</strong> 3.0.217.166, 3.1.134.42, 3.1.56.76</li>
                            <li><strong>Staging:</strong> 34.246.34.27, 18.202.142.208, 54.72.10.41</li>
                        </ul>

                        <hr>

                        <p class="text-muted text-sm">
                            <?php echo app('translator')->get('foodpanda.integration_info_help'); ?>
                        </p>

                        <a href="https://integration.foodpanda.com/en/documentation/" target="_blank" class="btn btn-sm btn-secondary">
                            <i class="fa fa-external-link"></i> <?php echo app('translator')->get('foodpanda.view_documentation'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle credentials visibility
    const enableCheckbox = document.querySelector('input[name="enable_foodpanda_integration"]');
    const credentialsDiv = document.getElementById('foodpanda-credentials');
    
    if (enableCheckbox) {
        enableCheckbox.addEventListener('change', function() {
            credentialsDiv.style.display = this.checked ? 'block' : 'none';
        });
    }

    // Add vendor mapping
    const addMappingBtn = document.getElementById('add-vendor-mapping');
    if (addMappingBtn) {
        addMappingBtn.addEventListener('click', function() {
            const container = document.getElementById('vendor-mappings-container');
            const row = document.createElement('div');
            row.className = 'form-group row vendor-mapping-row';
            row.innerHTML = `
                <div class="col-md-5">
                    <input type="text" class="form-control vendor-code"
                           placeholder="<?php echo app('translator')->get('foodpanda.vendor_code'); ?>">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control remote-id"
                           placeholder="<?php echo app('translator')->get('foodpanda.remote_id'); ?>">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-sm btn-danger remove-mapping">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(row);
            attachRemoveBtnListener(row.querySelector('.remove-mapping'));
        });
    }

    // Remove vendor mapping
    function attachRemoveBtnListener(btn) {
        btn.addEventListener('click', function() {
            this.closest('.vendor-mapping-row').remove();
        });
    }

    document.querySelectorAll('.remove-mapping').forEach(btn => {
        attachRemoveBtnListener(btn);
    });

    // Test connection
    const testBtn = document.getElementById('test-foodpanda-connection');
    if (testBtn) {
        testBtn.addEventListener('click', function() {
            const statusSpan = document.getElementById('connection-status');
            statusSpan.innerHTML = '<span class="text-info"><i class="fa fa-spinner fa-spin"></i> Testing...</span>';

            fetch('<?php echo e(route("foodpanda.api.test-connection"), false); ?>')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusSpan.innerHTML = '<span class="text-success"><i class="fa fa-check"></i> ' + data.message + '</span>';
                    } else {
                        statusSpan.innerHTML = '<span class="text-danger"><i class="fa fa-times"></i> ' + data.message + '</span>';
                    }
                })
                .catch(error => {
                    statusSpan.innerHTML = '<span class="text-danger"><i class="fa fa-times"></i> Error: ' + error.message + '</span>';
                });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
