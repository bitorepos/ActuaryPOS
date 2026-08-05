

<?php $__env->startSection('title', __('lang_v1.customer_display_screen')); ?>

<?php $__env->startSection('content'); ?>
    <section class="content no-print">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12 bg-white shadow-sm rounded mb-3 p-3">
                    <?php echo $pos_settings['display_screen_heading'] ?? ''; ?>

                </div>

                <div class="row">

                    <div class="col-lg-7 col-md-12">

                        <div class="bg-white shadow-sm rounded mb-3 p-3" style="height: 80vh;">
                            <div class="box-body pb-0">
                                <div class="row">
                                    <div class="col-md-7 customer_details">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" title="<?php echo e(__('lang_v1.full_screen'), false); ?>"
                                            class="btn btn-outline-primary btn-sm float-end"
                                            id="full_screen">
                                            <i class="fa fa-window-maximize"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-12 pos_product_div" style="height: 50vh !important; overflow-y: auto;">
                                        <table class="table table-condensed table-bordered table-striped table-responsive"
                                            id="pos_table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        <?php echo app('translator')->get('sale.product'); ?>
                                                    </th>
                                                    <th class="text-center">
                                                        <?php echo app('translator')->get('sale.qty'); ?>
                                                    </th>
                                                    <th class="text-center">
                                                        <?php echo app('translator')->get('sale.price_inc_tax'); ?>
                                                    </th>
                                                    <th class="text-center">
                                                        <?php echo app('translator')->get('sale.subtotal'); ?>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-condensed">
                                            <tr>
                                                <td>
                                                    <b><?php echo app('translator')->get('sale.item'); ?>:</b>&nbsp;
                                                    <span class="total_quantity">0</span>
                                                </td>
                                                <td>
                                                    <b><?php echo app('translator')->get('sale.total'); ?>:</b>&nbsp;
                                                    <span class="price_total display_currency" data-currency_symbol="true">0</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b><?php echo app('translator')->get('sale.discount'); ?> (-):</b>
                                                    <span class="display_currency" data-currency_symbol="true" id="total_discount">0</span>
                                                </td>
                                                <td>
                                                    <b><?php echo app('translator')->get('sale.order_tax'); ?> (+):</b>
                                                    <span class="display_currency" data-currency_symbol="true" id="order_tax">0</span>
                                                </td>
                                                <td>
                                                    <b><?php echo app('translator')->get('sale.shipping'); ?> (+):</b>
                                                    <span class="display_currency" data-currency_symbol="true" id="shipping_charges_amount">0</span>
                                                </td>
                                                <td>
                                                    <b class="text-success fs-5"><?php echo app('translator')->get('sale.total_payable'); ?>:</b>
                                                    <span class="text-success fs-5 display_currency" data-currency_symbol="true" id="total_payable">0</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="bg-warning rounded p-3">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong><?php echo app('translator')->get('lang_v1.total_paying'); ?>:</strong>
                                                    <br />
                                                    <span class="lead text-bold total_paying display_currency" data-currency_symbol="true">0</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong><?php echo app('translator')->get('lang_v1.change_return'); ?>:</strong>
                                                    <br />
                                                    <span class="lead text-bold change_return_span display_currency" data-currency_symbol="true">0</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong><?php echo app('translator')->get('lang_v1.balance'); ?>:</strong>
                                                    <br />
                                                    <span class="lead text-bold balance_due display_currency text-danger" data-currency_symbol="true">0</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-lg-5 col-md-12">
                        <div class="shadow-sm border rounded d-flex align-items-center justify-content-center" style="height: 80vh;">
                            <div id="myCarousel" class="carousel slide w-100 h-100" data-bs-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <?php $__currentLoopData = range(1, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($pos_settings['carousel_image_' . $i])): ?>
                                            <li data-bs-target="#myCarousel" data-bs-slide-to="<?php echo e($i - 1, false); ?>"
                                                class="<?php echo e($i == 1 ? 'active' : '', false); ?>">
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner h-100 rounded">
                                    <?php $__currentLoopData = range(1, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($pos_settings['carousel_image_' . $i])): ?>
                                            <?php
                                                $__carousel_file = $pos_settings['carousel_image_' . $i];
                                                $__carousel_business_path = ! empty($business_id)
                                                    ? 'uploads/' . config('constants.data_path') . $business_id . '/carousel_images/' . $__carousel_file
                                                    : null;
                                                $__carousel_legacy_path = 'uploads/carousel_images/' . $__carousel_file;
                                                $__carousel_src = ! empty($__carousel_business_path) && file_exists(public_path($__carousel_business_path))
                                                    ? url($__carousel_business_path)
                                                    : url($__carousel_legacy_path);
                                            ?>
                                            <div class="carousel-item <?php echo e($i == 1 ? 'active' : '', false); ?> h-100 d-flex align-items-center justify-content-center">
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                    <img src="<?php echo e($__carousel_src, false); ?>"
                                                        class="d-block img-fluid h-100 w-100"
                                                        style="object-fit: contain;"
                                                        alt="Carousel Image <?php echo e($i, false); ?>">
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <div class="modal fade view_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script>
        $(document).ready(function() {
            let storageUpdateTimer = null;

            // Function to fetch customer data
            async function fetchCustomers(id) {
                try {
                    let response = await $.ajax({
                        url: "/contacts/customers",
                        method: "GET",
                        dataType: "json",
                        delay: 250,
                    });
                    let filteredCustomers = response.filter((customer) => customer.id == id);
                    return filteredCustomers;
                } catch (error) {
                    return [];
                }
            }

            // Function to fetch product details
            async function fetchProduct(variation_id, location_id) {
                try {
                    let response = await $.ajax({
                        url: `/pos/variation/${variation_id}/${location_id}`,
                        method: "GET",
                        dataType: "json",
                        delay: 250,
                    });
                    return response;
                } catch (error) {
                    console.error("Error fetching product data:", error);
                    return null;
                }
            }

            let isLoadingTableData = false;

            async function loadTableData() {
                if (isLoadingTableData) return;
                isLoadingTableData = true;

                var storedArrayData = JSON.parse(localStorage.getItem("pos_form_data_array"));
                var open_modal = localStorage.getItem("open_modal");

                if (open_modal == 1) {
                    var open_modal_html = localStorage.getItem("open_modal_html");
                    $('.view_modal').html(open_modal_html);
                    $('.view_modal').modal('show');
                } else {
                    $('.view_modal').html('');
                    $('.view_modal').modal('hide');
                }

                if (!storedArrayData) {
                    isLoadingTableData = false;
                    return;
                }

                var contactIdObj = storedArrayData.find((item) => item.name === "contact_id");
                var contactId = contactIdObj ? contactIdObj.value : null;

                var locationIdObj = storedArrayData.find((item) => item.name === "location_id");
                var location_id = locationIdObj ? locationIdObj.value : null;

                var final_total = storedArrayData.find((item) => item.name === "final_total");
                var final_total = final_total ? final_total.value : null;

                $("#total_payable").text(__currency_trans_from_en(final_total, false));

                // Extract discount
                var discount_amount_obj = storedArrayData.find((item) => item.name === "discount_amount");
                var discount_amount = discount_amount_obj ? discount_amount_obj.value : 0;
                $("#total_discount").text(__currency_trans_from_en(discount_amount, false));

                // Extract Invocie Tax
                var tax_calculation_amount_obj = storedArrayData.find((item) => item.name === "tax_calculation_amount");
                var tax_amount = tax_calculation_amount_obj ? tax_calculation_amount_obj.value : 0;
                $("#order_tax").text(__currency_trans_from_en(tax_amount, false));

                // Extract shipping
                var shipping_charges_obj = storedArrayData.find((item) => item.name === "shipping_charges");
                var shipping_charges = shipping_charges_obj ? shipping_charges_obj.value : 0;
                $("#shipping_charges_amount").text(__currency_trans_from_en(shipping_charges, false));

                // Extract payment info
                var total_paying_obj = storedArrayData.find((item) => item.name === "total_paying_input");
                var in_total_paying = total_paying_obj ? total_paying_obj.value : 0;
                $(".total_paying").text(__currency_trans_from_en(in_total_paying, false));

                var change_return_obj = storedArrayData.find((item) => item.name === "change_return");
                var in_change_return = change_return_obj ? change_return_obj.value : 0;
                $(".change_return_span").text(__currency_trans_from_en(in_change_return, false));

                var balance_due_obj = storedArrayData.find((item) => item.name === "in_balance_due");
                var in_balance_due = balance_due_obj ? balance_due_obj.value : 0;
                $(".balance_due").text(in_balance_due);

                // Fetch customer details
                if (contactId) {
                    let customers = await fetchCustomers(contactId);
                    if (customers.length > 0) {
                        $(".customer_details").html(`<h3>${customers[0].text}</h3>`);
                    }
                }

                let formattedData = {};

                storedArrayData.forEach(({
                    name,
                    value
                }) => {
                    let match = name.match(/products\[(\d+)\]\[(.*?)\]/);
                    if (match) {
                        let index = match[1];
                        let key = match[2];

                        if (!formattedData[index]) {
                            formattedData[index] = {};
                        }

                        formattedData[index][key] = value;
                    }
                });

                let resultArray = Object.values(formattedData).reverse();

                let tableBody = $("#pos_table tbody");
                tableBody.empty();

                let totalQuantity = 0;

                for (let product of resultArray) {
                    let single_product = await fetchProduct(product.variation_id, location_id);
                    let imageUrl = `${base_path}/img/default.png`;
                    if (single_product && single_product.media && single_product.media.length > 0) {
                        imageUrl = single_product.media[0].display_url;
                    } else if (single_product && single_product.product_image) {
                        imageUrl = `${base_path}/uploads/img/${encodeURIComponent(single_product.product_image)}`;
                    }

                    let quantity = parseFloat(product.quantity) || 0;
                    totalQuantity = totalQuantity + quantity;

                    let unitPrice = parseFloat((product.unit_price_inc_tax || "0").replace(/,/g, "")) || 0;

                    let rowHtml = `
                        <tr>
                            <td class="text-start d-flex align-items-center">
                                <img loading="lazy" style="height:50px;width:50px;object-fit:cover;border-radius:5px;margin-right:8px;" src="${imageUrl}" alt="Product Image">
                                <span>${single_product ? single_product.product_name : "-"}</span>
                            </td>
                            <td class="text-center">${product.quantity || "0"}</td>
                            <td class="text-center display_currency" data-currency_symbol="true">${product.unit_price_inc_tax || "0.00"}</td>
                            <td class="text-center display_currency" data-currency_symbol="true">${__currency_trans_from_en((quantity * unitPrice).toFixed(2), false)}</td>
                        </tr>
                    `;

                    tableBody.append(rowHtml);
                }

                $(".total_quantity").text(totalQuantity);
                $(".price_total").text(__currency_trans_from_en(final_total, false));

                __currency_convert_recursively(tableBody);

                isLoadingTableData = false;
            }

            // Listen for localStorage changes from POS screen
            window.addEventListener("storage", function(event) {
                if (event.key === "pos_form_data_array") {
                    if (storageUpdateTimer) clearTimeout(storageUpdateTimer);
                    storageUpdateTimer = setTimeout(loadTableData, 300);
                }
            });

            // Initial load
            loadTableData();

            // Full screen button
            $('#full_screen').click(function() {
                if (document.fullscreenElement) {
                    document.exitFullscreen();
                } else {
                    document.documentElement.requestFullscreen();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>