
<?php $__env->startSection('title', __('product.import_products')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('product.import_products'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    <?php if(session('notification') || !empty($notification)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                <?php if(!empty($notification['msg'])): ?>
                <?php echo e($notification['msg'], false); ?>

                <?php elseif(session('notification.msg')): ?>
                <?php echo e(session('notification.msg'), false); ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('status')): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible">
                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                <?php echo e(session('status.msg'), false); ?>

            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <form id="import_products_form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-sm-6 row">
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <?php echo Form::label('name', __( 'product.file_to_import' ) . ':'); ?>

                            <?php echo Form::file('products_csv', ['accept'=> '.xls, .xlsx, .csv', 'required' => 'required', 'id' => 'products_csv']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <br>
                        <button type="submit" class="btn btn-primary" id="import_submit_btn"><?php echo app('translator')->get('messages.submit'); ?></button>
                    </div>
                </div>
                <div class="col-sm-6 row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <br>
                            <label class="form-check-label">
<?php echo Form::checkbox('add_new_products', 1, true, ['class' => 'form-check-input', 'id' =>
                                'add_new_products']); ?> Add New Products
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <br>
                            <label class="form-check-label">
<?php echo Form::checkbox('update_exisiting_products', 1, true, ['class' => 'form-check-input',
                                'id' => 'update_exisiting_products']); ?> Update Existing Products
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            </form>

            <!-- Progress Section -->
            <div id="import_progress_section" style="display:none;" class="mt-3">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 id="import_status_text">Validating file...</h4>
                        <div class="progress" style="height: 25px;">
                            <div id="import_progress_bar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                 role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                0%
                            </div>
                        </div>
                        <p id="import_details_text" class="text-muted mt-2"></p>
                        <div id="import_errors_section" style="display:none;" class="mt-2">
                            <div class="alert alert-warning">
                                <strong>Warnings:</strong>
                                <ul id="import_errors_list"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <br><br>
            <div class="row">
                <div class="col-sm-4">
                    <a href="<?php echo e(asset('files/import_products_csv_template.xls'), false); ?>" class="btn btn-success" download><i
                            class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?></a>
                </div>
                <div class="col-sm-4">
                    <a href="<?php echo e(asset('files/import_variable_products_template.csv'), false); ?>" class="btn btn-info" download><i
                            class="fa fa-download"></i> Download Variable Products Template</a>
                </div>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.instructions')]); ?>
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#general_import_instructions" role="tab">
                        <i class="fa fa-file-excel"></i> General / Single Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#variable_import_instructions" role="tab">
                        <i class="fa fa-th-list"></i> Variable Products
                    </a>
                </li>
            </ul>

            <div class="tab-content pt-3">
                
                <div class="tab-pane active" id="general_import_instructions" role="tabpanel">

            <strong><?php echo app('translator')->get('lang_v1.instruction_line1'); ?></strong><br>
            <?php echo app('translator')->get('lang_v1.instruction_line2'); ?>
            <br><br>
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td><?php echo app('translator')->get('product.product_name'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.name_ins'); ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><?php echo app('translator')->get('product.other_product_name'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Other <?php echo app('translator')->get('lang_v1.name_ins'); ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><?php echo app('translator')->get('product.brand'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.brand_ins'); ?> <br><small class="text-muted">(<?php echo app('translator')->get('lang_v1.brand_ins2'); ?>)</small>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><?php echo app('translator')->get('product.unit'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.unit_ins'); ?></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><?php echo app('translator')->get('product.sub_units'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.sub_unit_ins'); ?></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><?php echo app('translator')->get('product.category'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.category_ins'); ?> <br><small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.category_ins2'); ?>)</small></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><?php echo app('translator')->get('product.sub_category'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.sub_category_ins'); ?> <br><small class="text-muted">(<?php echo __('lang_v1.sub_category_ins2'); ?>)</small></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><?php echo app('translator')->get('product.sub2_category'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.sub2_category_ins'); ?> <br><small class="text-muted">(<?php echo __('lang_v1.sub2_category_ins2'); ?>)</small></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td><?php echo app('translator')->get('product.sku'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.sku_ins'); ?></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td><?php echo app('translator')->get('product.barcode_type'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>,
                            <?php echo app('translator')->get('lang_v1.default'); ?>: C128)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.barcode_type_ins'); ?> <br>
                        <strong><?php echo app('translator')->get('lang_v1.barcode_type_ins2'); ?>: C128, C39, EAN-13, EAN-8, UPC-A, UPC-E,
                            ITF-14</strong>
                    </td>
                </tr>
                <tr>
                    <td>11</td>
                    <td><?php echo app('translator')->get('product.manage_stock'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.manage_stock_ins'); ?><br>
                        <strong>1 = <?php echo app('translator')->get('messages.yes'); ?><br>
                            0 = <?php echo app('translator')->get('messages.no'); ?></strong>
                    </td>
                </tr>
                <tr>
                    <td>12</td>
                    <td><?php echo app('translator')->get('product.alert_quantity_low'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('product.alert_quantity_low'); ?></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td><?php echo app('translator')->get('product.alert_quantity_medium'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('product.alert_quantity_medium'); ?></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td><?php echo app('translator')->get('product.alert_quantity_high'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('product.alert_quantity_high'); ?></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td><?php echo app('translator')->get('product.alert_quantity_max'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('product.alert_quantity_max'); ?></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td><?php echo app('translator')->get('product.expires_in'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.expires_in_ins'); ?></td>
                </tr>
                <tr>
                    <td>17</td>
                    <td><?php echo app('translator')->get('lang_v1.expire_period_unit'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.expire_period_unit_ins'); ?><br>
                        <strong><?php echo app('translator')->get('lang_v1.available_options'); ?>: days, months</strong>
                    </td>
                </tr>
                <tr>
                    <td>18</td>
                    <td><?php echo app('translator')->get('product.applicable_tax'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.applicable_tax_ins'); ?> <?php echo __('lang_v1.applicable_tax_help'); ?></td>
                </tr>
                <tr>
                    <td>19</td>
                    <td><?php echo app('translator')->get('product.selling_price_tax_type'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td><?php echo app('translator')->get('product.selling_price_tax_type'); ?> <br>
                        <strong><?php echo app('translator')->get('lang_v1.available_options'); ?>: inclusive, exclusive</strong>
                    </td>
                </tr>
                <tr>
                    <td>20</td>
                    <td><?php echo app('translator')->get('product.product_type'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
                    <td><?php echo app('translator')->get('product.product_type'); ?> <br>
                        <strong><?php echo app('translator')->get('lang_v1.available_options'); ?>: single, combo, variable</strong>
                    </td>
                </tr>
                <tr>
                    <td>21</td>
                    <td><?php echo app('translator')->get('product.variation_name'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.variation_name_ins'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.variation_name_ins2'); ?></td>
                </tr>
                <tr>
                    <td>22</td>
                    <td><?php echo app('translator')->get('product.variation_values'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.variation_values_ins'); ?>)</small></td>
                    <td><?php echo __('lang_v1.variation_values_ins2'); ?></td>
                </tr>
                <tr>
                    <td>23</td>
                    <td><?php echo app('translator')->get('lang_v1.variation_sku'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo __('lang_v1.variation_sku_ins'); ?></td>
                </tr>
                <tr>
                    <td>24</td>
                    <td> <?php echo app('translator')->get('lang_v1.purchase_price_inc_tax'); ?><br><small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.purchase_price_inc_tax_ins1'); ?>)</small></td>
                    <td><?php echo __('lang_v1.purchase_price_inc_tax_ins2'); ?></td>
                </tr>
                <tr>
                    <td>25</td>
                    <td><?php echo app('translator')->get('lang_v1.purchase_price_exc_tax'); ?> <br><small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.purchase_price_exc_tax_ins1'); ?>)</small></td>
                    <td><?php echo __('lang_v1.purchase_price_exc_tax_ins2'); ?></td>
                </tr>
                <tr>
                    <td>26</td>
                    <td><?php echo app('translator')->get('lang_v1.profit_margin'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.profit_margin_ins'); ?><br>
                        <small class="text-muted"><?php echo __('lang_v1.profit_margin_ins1'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>27</td>
                    <td><?php echo app('translator')->get('lang_v1.selling_price'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.selling_price_ins'); ?><br>
                        <small class="text-muted"><?php echo __('lang_v1.selling_price_ins1'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>28</td>
                    <td><?php echo app('translator')->get('lang_v1.kot_printer_name'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.kot_printer_name_ins'); ?><br>
                        <small class="text-muted"><?php echo __('lang_v1.kot_printer_name_ins1'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>29</td>
                    <td><?php echo app('translator')->get('lang_v1.opening_stock'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.opening_stock_ins'); ?> <?php echo __('lang_v1.opening_stock_help_text'); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>30</td>
                    <td><?php echo app('translator')->get('lang_v1.opening_stock_location'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)
                            <br><?php echo app('translator')->get('lang_v1.location_ins'); ?></small></td>
                    <td><?php echo app('translator')->get('lang_v1.location_ins1'); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>31</td>
                    <td>Contact ID <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Supplier Contact ID. Leave blank to auto generate Contact ID when creating new supplier.<br>
                    </td>
                </tr>
                <tr>
                    <td>32</td>
                    <td>Default Supplier <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Name of the supplier. If supplier does not exist, it will be automatically created.<br>
                    </td>
                </tr>
                <tr>
                    <td>33</td>
                    <td><?php echo app('translator')->get('lang_v1.expiry_date'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.expiry_date_ins'); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>34</td>
                    <td><?php echo app('translator')->get('lang_v1.enable_sr_no'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>,
                            <?php echo app('translator')->get('lang_v1.default'); ?>: 0)</small></td>
                    <td><strong>1 = <?php echo app('translator')->get('messages.yes'); ?><br>
                            0 = <?php echo app('translator')->get('messages.no'); ?></strong><br>
                    </td>
                </tr>
                <tr>
                    <td>35</td>
                    <td><?php echo app('translator')->get('lang_v1.weight'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo app('translator')->get('lang_v1.optional'); ?><br>
                    </td>
                </tr>
                <tr>
                    <td>36</td>
                    <td><?php echo app('translator')->get('lang_v1.rack'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.rack_help_text'); ?></td>
                </tr>
                <tr>
                    <td>37</td>
                    <td><?php echo app('translator')->get('lang_v1.row'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.row_help_text'); ?></td>
                </tr>
                <tr>
                    <td>38</td>
                    <td><?php echo app('translator')->get('lang_v1.position'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.position_help_text'); ?></td>
                </tr>
                <tr>
                    <td>39</td>
                    <td><?php echo app('translator')->get('lang_v1.image'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td><?php echo __('lang_v1.image_help_text', ['path' =>
                        'public/uploads/'.config('constants.product_img_path')]); ?> <br><br>
                        <?php echo e(__('lang_v1.img_url_help_text'), false); ?>

                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>40</td>
                    <td><?php echo app('translator')->get('lang_v1.product_description'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>41</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field1'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>42</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field2'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>43</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field3'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td></td>
                </tr>
                <tr>
                    <td>44</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field4'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>45</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field5'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>46</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field6'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>47</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field7'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>48</td>
                    <td><?php echo app('translator')->get('lang_v1.product_custom_field8'); ?> <small
                            class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                </tr>
                <tr>
                    <td>49</td>
                    <td><?php echo app('translator')->get('lang_v1.not_for_selling'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><strong>1 = <?php echo app('translator')->get('messages.yes'); ?><br>
                            0 = <?php echo app('translator')->get('messages.no'); ?></strong><br>
                    </td>
                </tr>
                <tr>
                    <td>50</td>
                    <td><?php echo app('translator')->get('lang_v1.product_locations'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small>
                    </td>
                    <td><?php echo app('translator')->get('lang_v1.product_locations_ins'); ?>
                    </td>
                </tr>
                <tr>
                    <td>51</td>
                    <td><?php echo app('translator')->get('lang_v1.pct_code'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Product PCT/HSN Code without Dot separator. <b>Example: 1111.2222 will become 11112222</b> </td>
                </tr>
                <tr>
                    <td>52</td>
                    <td>Preparation Time in Minutes <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Preparation Time in Minutes (Only Numbers) <br>Example: 10 </td>
                </tr>
                <tr>
                    <td>53</td>
                    <td>Gender <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Gender name (e.g. Men, Women, Unisex). Auto-created if it doesn't exist.<br>
                        <small class="text-muted">Requires "Enable Gender" to be turned on in Business Settings > Product tab.</small>
                    </td>
                </tr>
                <tr>
                    <td>54</td>
                    <td>Procurement Source <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>Procurement source name (e.g. Local, Imported, Domestic). Auto-created if it doesn't exist.<br>
                        <small class="text-muted">Requires "Enable Procurement Source" to be turned on in Business Settings > Product tab.</small>
                    </td>
                </tr>
                <tr>
                    <td>55</td>
                    <td>Combo Ingredients <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
                    <td>
                        <b>Only for combo products</b> (Product Type = combo). Leave blank for single/variable products.<br>
                        Format: <code>SKU:Qty:Unit</code> separated by pipe (<code>|</code>)<br>
                        <b>Example:</b> <code>BREAD-001:2:Pcs|EGG-001:3:Pcs|CHEESE-001:1:Pcs</code><br>
                        <ul class="mb-0 mt-1">
                            <li><b>SKU</b> — The ingredient product's SKU (must already exist in the system)</li>
                            <li><b>Qty</b> — Quantity of the ingredient per combo unit</li>
                            <li><b>Unit</b> — Unit name (e.g. Pcs, Kg). If omitted, uses the ingredient product's default unit</li>
                        </ul>
                        <small class="text-muted">Ingredient products must be imported/created before importing combo products.</small>
                    </td>
                </tr>

            </table>

                </div>

                
                <div class="tab-pane" id="variable_import_instructions" role="tabpanel">

            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i>
                <strong>Simplified Variable Product Import</strong> — Use the <b>Variable Products Template</b> to import variable products with an easy one-row-per-variation format. No pipe separators needed!
            </div>

            <h4>How It Works</h4>
            <ul>
                <li>Each <b>variation</b> gets its own row in the Excel sheet.</li>
                <li>The <b>first row</b> of a product contains all product details (Name, Brand, Unit, etc.) plus the first variation.</li>
                <li><b>Subsequent rows</b> only need the variation-specific columns (Variation Value, Variation SKU, Prices, Opening Stock). Leave product-level columns blank — they inherit from the first row.</li>
                <li>A blank <b>Product Name</b> column means "this row is a continuation of the previous product".</li>
            </ul>

            <hr>
            <h4>Single Variation Example <small class="text-muted">(e.g. Size: S, M, L)</small></h4>
            <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Gender</th>
                        <th>Proc. Source</th>
                        <th>Unit</th>
                        <th>Category</th>
                        <th>SKU</th>
                        <th>Manage Stock</th>
                        <th>Tax Type</th>
                        <th>Variation Template</th>
                        <th>Variation Value</th>
                        <th>Purchase Price (Exc.)</th>
                        <th>Selling Price</th>
                        <th>Opening Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>T-Shirt</b></td>
                        <td>Nike</td>
                        <td>Unisex</td>
                        <td>Local</td>
                        <td>Pcs</td>
                        <td>Clothing</td>
                        <td>TS-001</td>
                        <td>1</td>
                        <td>exclusive</td>
                        <td><b>Size</b></td>
                        <td>Small</td>
                        <td>90</td>
                        <td>112.5</td>
                        <td>10</td>
                    </tr>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Medium</td>
                        <td>108</td>
                        <td>135</td>
                        <td>20</td>
                    </tr>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Large</td>
                        <td>126</td>
                        <td>157.5</td>
                        <td>30</td>
                    </tr>
                </tbody>
            </table>
            </div>

            <hr>
            <h4>Group Variation Example <small class="text-muted">(e.g. Size + Color combined)</small></h4>
            <p>For <b>group variations</b>, the Variation Template name is the group template name (e.g. <code>Size-Color</code>). 
            Each Variation Value uses a dash (<code>-</code>) to separate the values from each sub-template.</p>
            <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Gender</th>
                        <th>Proc. Source</th>
                        <th>Unit</th>
                        <th>Category</th>
                        <th>SKU</th>
                        <th>Manage Stock</th>
                        <th>Tax Type</th>
                        <th>Variation Template</th>
                        <th>Variation Value</th>
                        <th>Purchase Price (Exc.)</th>
                        <th>Selling Price</th>
                        <th>Opening Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><b>Polo Shirt</b></td>
                        <td>Adidas</td>
                        <td>Men</td>
                        <td>Imported</td>
                        <td>Pcs</td>
                        <td>Clothing</td>
                        <td>PS-001</td>
                        <td>1</td>
                        <td>exclusive</td>
                        <td><b>Size-Color</b></td>
                        <td>Small-Red</td>
                        <td>200</td>
                        <td>275</td>
                        <td>5</td>
                    </tr>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Small-Blue</td>
                        <td>200</td>
                        <td>275</td>
                        <td>5</td>
                    </tr>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Medium-Red</td>
                        <td>220</td>
                        <td>302.5</td>
                        <td>10</td>
                    </tr>
                    <tr class="table-light">
                        <td><i class="text-muted">(blank)</i></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Medium-Blue</td>
                        <td>220</td>
                        <td>302.5</td>
                        <td>10</td>
                    </tr>
                </tbody>
            </table>
            </div>

            <hr>
            <h4>Column Descriptions</h4>
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Product Name <small class="text-muted">(Required for first row)</small></td>
                    <td>Name of the product. <b>Leave blank</b> for continuation rows (additional variations of the same product).</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Other Name <small class="text-muted">(Optional)</small></td>
                    <td>Alternative product name. Only needed in first row.</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Brand <small class="text-muted">(Optional)</small></td>
                    <td>Brand name. Auto-created if it doesn't exist. Only needed in first row.</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Gender <small class="text-muted">(Optional)</small></td>
                    <td>Gender name (e.g. Men, Women, Unisex). Auto-created if it doesn't exist. Only needed in first row.<br>
                        <small class="text-muted">Requires "Enable Gender" in Business Settings > Product tab.</small>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Procurement Source <small class="text-muted">(Optional)</small></td>
                    <td>Procurement source name (e.g. Local, Imported). Auto-created if it doesn't exist. Only needed in first row.<br>
                        <small class="text-muted">Requires "Enable Procurement Source" in Business Settings > Product tab.</small>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Unit <small class="text-muted">(Required for first row)</small></td>
                    <td>Unit name (e.g. Pcs, Kg). Must already exist in system.</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Category <small class="text-muted">(Optional)</small></td>
                    <td>Category name. Auto-created if it doesn't exist.</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Sub Category <small class="text-muted">(Optional)</small></td>
                    <td>Sub-category name. Requires Category to be set.</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>SKU <small class="text-muted">(Optional)</small></td>
                    <td>Product SKU. Auto-generated if left blank.</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Barcode Type <small class="text-muted">(Optional, Default: C128)</small></td>
                    <td>Options: C128, C39, EAN-13, EAN-8, UPC-A, UPC-E, ITF-14</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Manage Stock <small class="text-muted">(Required for first row)</small></td>
                    <td><b>1</b> = Yes, <b>0</b> = No</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Applicable Tax <small class="text-muted">(Optional)</small></td>
                    <td>Tax name as defined in Settings > Tax Rates.</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Selling Price Tax Type <small class="text-muted">(Required for first row)</small></td>
                    <td>Options: <b>inclusive</b>, <b>exclusive</b>, <b>none</b></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Variation Template <small class="text-muted">(Required)</small></td>
                    <td>
                        Name of the variation template. Only needed in first row.<br>
                        <b>Single variation:</b> e.g. <code>Size</code>, <code>Color</code><br>
                        <b>Group variation:</b> Use the group template name, e.g. <code>Size-Color</code>. The group template must already exist in the system.
                    </td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Variation Value <small class="text-muted">(Required)</small></td>
                    <td>
                        The variation value for this row.<br>
                        <b>Single variation:</b> e.g. <code>Small</code>, <code>Medium</code>, <code>Large</code><br>
                        <b>Group variation:</b> Dash-separated values matching sub-templates, e.g. <code>Small-Red</code>, <code>Medium-Blue</code>
                    </td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Variation SKU <small class="text-muted">(Optional)</small></td>
                    <td>SKU for this variation. Auto-generated if blank (uses the <b>Variation SKU Suffix Length</b> setting from Business Settings > Product tab).</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>Purchase Price Exc. Tax <small class="text-muted">(Required)</small></td>
                    <td>Purchase price excluding tax for this variation.</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>Purchase Price Inc. Tax <small class="text-muted">(Optional)</small></td>
                    <td>Purchase price including tax. Auto-calculated if blank.</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>Profit Margin % <small class="text-muted">(Optional)</small></td>
                    <td>Profit margin percentage. Uses default from business settings if blank.</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>Selling Price <small class="text-muted">(Optional)</small></td>
                    <td>Selling price. Auto-calculated from purchase price + profit margin if blank.</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>Opening Stock <small class="text-muted">(Optional)</small></td>
                    <td>Opening stock quantity for this variation. Only works if Manage Stock = 1.</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>Opening Stock Location <small class="text-muted">(Optional)</small></td>
                    <td>Business location name. Uses default location if blank. Only needed in first row.</td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>Image <small class="text-muted">(Optional)</small></td>
                    <td>Image filename or URL. Only needed in first row.</td>
                </tr>
            </table>

            <hr>
            <h4><i class="fa fa-lightbulb text-warning"></i> Important Notes</h4>
            <ul>
                <li>The system auto-detects whether you are using the <b>General template</b> (55 columns) or the <b>Variable Products template</b> (23 columns) based on the number of columns in the file.</li>
                <li><b>Variation SKU</b> auto-generation respects the <b>Variation SKU Suffix Length</b> setting in Business Settings > Product tab.</li>
                <li>For <b>group variations</b>, the group variation template must already exist in the system (Products > Variation Groups). Single variation templates are auto-created.</li>
                <li><b>Brands</b>, <b>Categories</b>, <b>Genders</b>, and <b>Procurement Sources</b> are auto-created if they don't exist.</li>
                <li><b>Units</b> must already exist in the system.</li>
                <li>You can mix multiple products in one file — each new Product Name starts a new product.</li>
                <li>All variable products in this template are automatically set to <b>product type = variable</b>.</li>
            </ul>

                </div>
            </div>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
$(document).ready(function() {
    var chunkSize = 10;

    $('#import_products_form').on('submit', function(e) {
        e.preventDefault();
        
        var fileInput = document.getElementById('products_csv');
        if (!fileInput.files.length) {
            toastr.error('Please select a file to import.');
            return;
        }

        // Client-side file size check (warn if > 5MB)
        var fileSize = fileInput.files[0].size;
        var maxSize = 10 * 1024 * 1024; // 10MB
        if (fileSize > maxSize) {
            if (!confirm('The file is larger than 10MB which may cause issues on some servers. Do you want to continue?')) {
                return;
            }
        }

        var formData = new FormData(this);
        
        // Disable form and show progress
        $('#import_submit_btn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
        $('#import_progress_section').show();
        $('#import_status_text').text('Uploading and validating file...');
        $('#import_progress_bar').css('width', '0%').text('0%');
        $('#import_details_text').text('');
        $('#import_errors_section').hide();
        $('#import_errors_list').empty();

        // Step 1: Upload and validate
        $.ajax({
            url: "<?php echo e(action([\App\Http\Controllers\ImportProductsController::class, 'store']), false); ?>",
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            timeout: 300000, // 5 minute timeout for large files
            success: function(response) {
                if (response.success == 1) {
                    $('#import_status_text').text('File validated. Importing ' + response.total + ' products...');
                    processChunks(response.import_id, 0, response.total, []);
                } else {
                    showError(response.msg || 'Unknown error occurred');
                }
            },
            error: function(xhr, status, error) {
                var msg = 'Upload failed. ';
                
                // Handle timeout
                if (status === 'timeout') {
                    msg = 'Request timed out. The file may be too large or server is slow. Please try with a smaller file or contact administrator.';
                    showError(msg);
                    return;
                }
                
                // Handle parseerror (response is not JSON - likely HTML error page)
                if (status === 'parseerror') {
                    console.error('Server returned non-JSON response:', xhr.responseText);
                    msg = 'Server error occurred. ';
                    
                    // Try to extract error from HTML response
                    var htmlResponse = xhr.responseText || '';
                    if (htmlResponse.indexOf('419') !== -1 || htmlResponse.indexOf('CSRF') !== -1) {
                        msg = 'Session expired. Please refresh the page and try again.';
                    } else if (htmlResponse.indexOf('413') !== -1 || htmlResponse.indexOf('Request Entity Too Large') !== -1) {
                        msg = 'File is too large for the server. Please reduce file size or contact administrator.';
                    } else if (htmlResponse.indexOf('500') !== -1 || htmlResponse.indexOf('Server Error') !== -1) {
                        msg = 'Internal server error. Please check server logs or contact administrator.';
                    } else if (htmlResponse.indexOf('memory') !== -1) {
                        msg = 'Server ran out of memory. Please try with fewer products per file.';
                    } else {
                        msg = 'Server returned an unexpected response. Check browser console for details.';
                    }
                    showError(msg);
                    return;
                }
                
                // Handle JSON error responses
                if (xhr.responseJSON) {
                    if (xhr.responseJSON.msg) {
                        msg += xhr.responseJSON.msg;
                    } else if (xhr.responseJSON.message) {
                        msg += xhr.responseJSON.message;
                    } else if (xhr.responseJSON.errors) {
                        msg += Object.values(xhr.responseJSON.errors).flat().join(', ');
                    }
                } else {
                    msg += error || 'Please check your connection and try again.';
                }
                showError(msg);
            }
        });
    });

    function processChunks(importId, offset, total, allErrors) {
        $.ajax({
            url: "<?php echo e(action([\App\Http\Controllers\ImportProductsController::class, 'processChunk']), false); ?>",
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token(), false); ?>',
                import_id: importId,
                offset: offset,
                chunk_size: chunkSize
            },
            dataType: 'json',
            timeout: 120000, // 2 minute timeout per chunk
            success: function(response) {
                if (response.success == 1) {
                    var percent = Math.round((response.processed / response.total) * 100);
                    $('#import_progress_bar').css('width', percent + '%').text(percent + '%');
                    $('#import_details_text').text('Processed ' + response.processed + ' of ' + response.total + ' products');

                    // Collect errors
                    if (response.errors && response.errors.length > 0) {
                        allErrors = allErrors.concat(response.errors);
                    }

                    if (response.is_complete) {
                        // Done!
                        $('#import_progress_bar')
                            .removeClass('progress-bar-animated progress-bar-striped')
                            .addClass('bg-success')
                            .css('width', '100%').text('100%');
                        
                        if (allErrors.length > 0) {
                            $('#import_status_text').html('<span class="text-warning"><i class="fa fa-check-circle"></i> Import completed with some warnings</span>');
                            showWarnings(allErrors);
                        } else {
                            $('#import_status_text').html('<span class="text-success"><i class="fa fa-check-circle"></i> ' + response.msg + '</span>');
                        }
                        
                        resetForm();
                    } else {
                        // Process next chunk
                        processChunks(importId, response.processed, response.total, allErrors);
                    }
                } else {
                    showError(response.msg || 'Unknown error during processing');
                }
            },
            error: function(xhr, status, error) {
                var msg = 'Processing failed at item ' + (offset + 1) + '. ';
                
                // Handle timeout
                if (status === 'timeout') {
                    msg = 'Processing timed out. The server may be overloaded. Please try again later.';
                    showError(msg);
                    return;
                }
                
                // Handle non-JSON response
                if (status === 'parseerror') {
                    console.error('Server returned non-JSON response during chunk processing:', xhr.responseText);
                    var htmlResponse = xhr.responseText || '';
                    if (htmlResponse.indexOf('419') !== -1 || htmlResponse.indexOf('CSRF') !== -1) {
                        msg = 'Session expired during import. Please refresh the page and re-upload the file.';
                    } else if (htmlResponse.indexOf('memory') !== -1) {
                        msg = 'Server ran out of memory during processing. Try importing fewer products at once.';
                    } else {
                        msg = 'Server error during processing. Check server logs for details.';
                    }
                    showError(msg);
                    return;
                }
                
                if (xhr.responseJSON && xhr.responseJSON.msg) {
                    msg += xhr.responseJSON.msg;
                } else {
                    msg += error || 'Please try again.';
                }
                showError(msg);
            }
        });
    }

    function showError(msg) {
        $('#import_status_text').html('<span class="text-danger"><i class="fa fa-times-circle"></i> ' + msg + '</span>');
        $('#import_progress_bar')
            .removeClass('progress-bar-animated progress-bar-striped')
            .addClass('bg-danger');
        resetForm();
    }

    function showWarnings(errors) {
        var list = $('#import_errors_list');
        list.empty();
        errors.forEach(function(err) {
            list.append('<li>' + $('<span>').text(err).html() + '</li>');
        });
        $('#import_errors_section').show();
    }

    function resetForm() {
        $('#import_submit_btn').prop('disabled', false).html("<?php echo app('translator')->get('messages.submit'); ?>");
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>