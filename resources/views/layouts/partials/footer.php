<footer class="main-footer no-print">
    <style>
        #sell-footer-actions.d-flex {
            gap: 8px;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: center;
        }
        #sell-footer-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            height: 38px;
            min-width: 90px;
            border-radius: 4px;
            transition: all 0.2s ease;
            white-space: nowrap;
            border: 1px solid transparent;
        }
        #sell-footer-actions .btn i {
            margin-right: 6px;
            display: inline-block;
            font-size: 14px;
        }
        #sell-footer-actions .btn .shortcut-hint {
            display: none;
        }
        #sell-footer-actions .btn-primary {
            background-color: #3461ff;
            color: #fff;
            border-color: #3461ff;
        }
        #sell-footer-actions .btn-primary:hover {
            background-color: #2850e0;
            border-color: #2850e0;
        }
        #sell-footer-actions .btn-success {
            background-color: #28a745;
            color: #fff;
            border-color: #28a745;
        }
        #sell-footer-actions .btn-success:hover {
            background-color: #218838;
            border-color: #218838;
        }
        #sell-footer-actions .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border-color: #dc3545;
        }
        #sell-footer-actions .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }
        #sell-footer-actions .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
            @media (max-width: 576px) {
                #footer-font-size-controls,
                #footer-default-text {
                    display: none !important;
                }
            }
    </style>
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <small id="footer-default-text">
            <?php echo e(config('app.name', 'BitorePOS'), false); ?> - V<?php echo e(config('author.app_version'), false); ?> | <?php echo e(\App\System::getProperty('invoice_business_name') ? \App\System::getProperty('invoice_business_name') : config('author.vendor'), false); ?> &copy; <?php echo e(date('Y'), false); ?> All rights reserved. 
            <?php
                $trialDays = \App\Utils\TransactionUtil::getTrialDaysRemaining();
            ?>
            <?php if($trialDays !== null): ?>
                <span class="text-danger ml-2 font-weight-bold">| Trial: <?php echo e($trialDays, false); ?> days remaining</span>
            <?php endif; ?>
        </small>
        <div id="sell-footer-actions" class="d-none d-flex align-items-center"></div>
        <div class="btn-group" id="footer-font-size-controls">
            <button type="button" class="btn btn-sm btn-outline-secondary toggle-font-size" data-size="s"><i class="fa fa-font"></i> <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-sm btn-outline-secondary toggle-font-size" data-size="m"> <i class="fa fa-font"></i> </button>
            <button type="button" class="btn btn-sm btn-outline-secondary toggle-font-size" data-size="l"><i class="fa fa-font"></i> <i class="fa fa-plus"></i></button>
            <button type="button" class="btn btn-sm btn-outline-secondary toggle-font-size" data-size="xl"><i class="fa fa-font"></i> <i class="fa fa-plus"></i><i class="fa fa-plus"></i></button>
        </div>
    </div>
</footer>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var isReverseProductionPage = document.getElementById('production_form') !== null && document.querySelector('form#production_form[action*="reverse-production"], form#production_form[action*="reverse_production"]') !== null;
        var isProductionPage = document.getElementById('production_form') !== null && !isReverseProductionPage;
        var isRecipePage = document.getElementById('recipe_form') !== null;
        var isRolePage = document.getElementById('role_add_form') !== null || document.getElementById('role_form') !== null;
        var isUserPage = document.getElementById('user_add_form') !== null || document.getElementById('user_edit_form') !== null;
        var isProfilePage = document.getElementById('edit_user_profile_form') !== null;
        var isInvoiceLayoutPage = document.getElementById('add_invoice_layout_form') !== null;
        var isBusinessLocationPage = document.getElementById('business_location_add_form') !== null;
        var isLocationSettingsPage = document.getElementById('bl_receipt_setting_form') !== null;
        var isBusinessSettingsPage = document.getElementById('bussiness_edit_form') !== null;
        var isStockAdjustmentPage = document.getElementById('stock_adjustment_form') !== null;
        var isExpensePage = document.getElementById('add_expense_form') !== null;
        var isProductPage = document.getElementById('product_add_form') !== null;
        var isTankPage = document.getElementById('tank_form') !== null;
        var isDispenserPage = document.getElementById('dispenser_form') !== null;
        var isNozzlePage = document.getElementById('nozzle_form') !== null;
        var isShiftPage = document.getElementById('shift_form') !== null;
        var isCloseShiftPage = document.getElementById('close_shift_form') !== null;
        var isTankAdjustmentPage = document.getElementById('tank_adjustment_form') !== null;
        var isCreateSellPage = document.getElementById('add_sell_form') !== null;
        var isEditSellPage = document.getElementById('edit_sell_form') !== null;
        var isSellReturnPage = document.getElementById('sell_return_form') !== null;
        var isPurchaseReturnPage = document.getElementById('purchase_return_form') !== null;
        var isPurchasePage = document.getElementById('add_purchase_form') !== null;
        var isJobSheetPage = document.getElementById('job_sheet_form') !== null || document.getElementById('edit_job_sheet_form') !== null;
        var isDriverInvoicePage = document.getElementById('add_driver_invoice') !== null;
        var isOpeningStockPage = document.getElementById('add_opening_stock_form') !== null;
        var isLabelPrintPage = document.getElementById('preview_setting_form') !== null;
        var isPackageAddPage = document.getElementById('add_package_form') !== null;
        var isPackageEditPage = document.getElementById('edit_package_form') !== null;
        var isPackagePage = isPackageAddPage || isPackageEditPage;
        var isBusinessRegisterPage = document.getElementById('business_register_form') !== null;
        var isCouponCreatePage = document.getElementById('create_coupon') !== null;
        var isCouponEditPage = document.getElementById('edit_coupon') !== null;
        var isCouponPage = isCouponCreatePage || isCouponEditPage;
        var isSuperadminSettingsPage = document.getElementById('superadmin_settings_form') !== null;
        var isBulkEditPage = document.getElementById('bulk_edit_products_form') !== null;
        var isContactLedgerPage = document.getElementById('view_contact_page') !== null;
        var isJournalEntryPage = document.getElementById('journal_add_form') !== null;
        var isPayrollPage = document.getElementById('add_payroll_form') !== null;
        var isClinicSettingsPage = document.getElementById('clinic_settings_form') !== null;
        var isPatientPage = document.getElementById('patient_form') !== null;
        var isDoctorPage = document.getElementById('doctor_form') !== null;
        var isConsultationPage = document.getElementById('consultation_form') !== null;
        var isLabOrderPage = document.getElementById('lab_order_form') !== null;
        var isPrescriptionPage = document.getElementById('prescription_form') !== null;
        var isAppointmentPage = document.getElementById('appointment_form') !== null;
        var isHmsBookingCreatePage = document.getElementById('create_booking') !== null;
        var isCmsSiteDetailsPage = document.getElementById('site_details_form') !== null;
        var isNotificationTemplatePage = document.getElementById('notification_template_form') !== null;
        var isCatalogueSettingsPage = document.getElementById('catalogue_settings_form') !== null;
        var isTruckmateInvoicePage = document.getElementById('add_truckmate_invoice_form') !== null;
        var isTruckmateSettingsPage = document.getElementById('truckmate_settings_page') !== null;
        var isTailorProSettingsPage = document.getElementById('tailorpro_settings_form') !== null;
        var isTailorProOrderPage = document.getElementById('tailorpro_order_form') !== null;
        var isTailorProOrderEdit = isTailorProOrderPage && document.querySelector('#tailorpro_order_form input[name="_method"][value="PUT"]') !== null;
        var isTailorProStatusPage = document.getElementById('tailorpro_status_form') !== null;
        var isTailorProStatusEdit = isTailorProStatusPage && document.querySelector('#tailorpro_status_form input[name="_method"][value="PUT"]') !== null;
        var isTailorProMeasurementPage = document.getElementById('tailorpro_measurement_form') !== null;
        var isTailorProMeasurementEdit = isTailorProMeasurementPage && document.querySelector('#tailorpro_measurement_form input[name="_method"][value="PUT"]') !== null;
        var isTailorProCatalogPage = document.getElementById('tailorpro_catalog_form') !== null;
        var isTailorProCatalogEdit = isTailorProCatalogPage && document.querySelector('#tailorpro_catalog_form input[name="_method"][value="PUT"]') !== null;
        var isTailorProCustomFieldPage = document.getElementById('tailorpro_custom_field_form') !== null;
        var isTailorProCustomFieldEdit = isTailorProCustomFieldPage && document.querySelector('#tailorpro_custom_field_form input[name="_method"][value="PUT"]') !== null;
        var isTailorProTemplatePage = document.getElementById('tailorpro_template_form') !== null;
        var isTailorProTemplateEdit = isTailorProTemplatePage && document.querySelector('#tailorpro_template_form input[name="_method"][value="PUT"]') !== null;
        var isVehicleCreatePage = document.getElementById('vehicle_form') !== null;
        var isWarehousePage = document.getElementById('warehouse_form') !== null;
        var isWarehouseEdit = isWarehousePage && document.querySelector('#warehouse_form input[name="_method"][value="PUT"]') !== null;
        var isWarehouseTransferPage = document.getElementById('warehouse_transfer_form') !== null;
        var isWarehouseTransferEdit = isWarehouseTransferPage && document.querySelector('#warehouse_transfer_form input[name="_method"][value="PUT"]') !== null;
        var isStockTransferCreatePage = document.getElementById('stock_transfer_form') !== null;
        var isTruckmateInvoiceEdit = isTruckmateInvoicePage && document.querySelector('#add_truckmate_invoice_form input[name="_method"][value="PUT"]') !== null;
        var isImportPage = document.getElementById('import_add_form') !== null;
        var isImportEditPage = isImportPage && document.querySelector('#import_add_form input[name="_method"][value="PUT"]') !== null;
        var isAccountingSettingsPage = document.getElementById('accounting_settings_form') !== null;
        var isRentalSettingsPage = document.getElementById('rental_settings_form') !== null;
        var isRentalItemPage = document.querySelector('#rental-item-footer-actions-template > *') !== null;
        var isRentalAgreementPage = document.querySelector('#rental-agreement-footer-actions-template > *') !== null;
        var isRentalMaintenancePage = document.querySelector('#rental-maintenance-footer-actions-template > *') !== null;
        var isContactPage = document.getElementById('contact-footer-actions-template') !== null;
        var isDiscountPage = document.getElementById('discount-footer-actions-template') !== null;
        var isBarcodePage = document.getElementById('add_barcode_settings_form') !== null;
        var isBarcodeEditPage = isBarcodePage && document.querySelector('#add_barcode_settings_form input[name="_method"][value="PUT"]') !== null;
        var isUserSettingsPage = document.getElementById('edit_user_settings_form') !== null;
        var isEssentialsSettingsPage = document.getElementById('essentials_settings_form') !== null;
        var isManufacturingSettingsPage = document.getElementById('manufacturing_settings_form') !== null;
        var isDemandOrderPage = document.getElementById('demand_order_form') !== null;
        var isDemandOrderEditPage = isDemandOrderPage && document.querySelector('#demand_order_form input[name="_method"][value="PUT"]') !== null;
        var footerActions = document.getElementById('sell-footer-actions');
        var footerText = document.getElementById('footer-default-text');
        var fontSizeControls = document.getElementById('footer-font-size-controls');
        var isSellPage = isCreateSellPage || isEditSellPage;

        var getFooterShortcutKey = function(button) {
            if (!button) {
                return null;
            }

            var buttonText = (button.textContent || '').toLowerCase().trim();
            var buttonId = (button.id || '').toLowerCase();
            var buttonClasses = (button.className || '').toLowerCase();

            if (buttonId.indexOf('cancel') !== -1 || buttonText.indexOf('cancel') !== -1) {
                return 'C';
            }

            if (buttonText.indexOf('print') !== -1 || buttonClasses.indexOf('save_and_print') !== -1) {
                return 'P';
            }

            if (buttonText.indexOf('update') !== -1) {
                return 'U';
            }

            if (buttonText.indexOf('save') !== -1 || buttonText.indexOf('submit') !== -1) {
                return 'S';
            }

            return null;
        };

        var applyFooterShortcutHints = function() {
            if (!footerActions) {
                return;
            }

            var footerButtons = footerActions.querySelectorAll('button');
            footerButtons.forEach(function(button) {
                var shortcutKey = getFooterShortcutKey(button);
                if (!shortcutKey) {
                    return;
                }

                if (button.dataset.shortcutIconApplied !== '1') {
                    var hasIcon = button.querySelector('i') !== null;
                    if (!hasIcon) {
                        var iconClass = 'fas fa-save';

                        if (shortcutKey === 'P') {
                            iconClass = 'fas fa-print';
                        } else if (shortcutKey === 'U') {
                            iconClass = 'fas fa-sync';
                        } else if (shortcutKey === 'C') {
                            iconClass = 'fas fa-times';
                        } else if ((button.textContent || '').toLowerCase().indexOf('submit') !== -1) {
                            iconClass = 'fas fa-check';
                        }

                        var iconElement = document.createElement('i');
                        iconElement.className = iconClass;
                        button.prepend(document.createTextNode(' '));
                        button.prepend(iconElement);
                    }
                    button.dataset.shortcutIconApplied = '1';
                }

                if (!button.title || button.title.indexOf('Shift+') === -1) {
                    button.title = 'Shift+' + shortcutKey;
                }

                // Remove any previously appended shortcut-hint spans
                var existingHint = button.querySelector('.shortcut-hint');
                if (existingHint) {
                    existingHint.remove();
                }
                button.dataset.shortcutHintApplied = '1';
            });
        };

        var isElementUsableForShortcut = function(element) {
            if (!element || element.disabled) {
                return false;
            }

            if (element.offsetParent === null) {
                return false;
            }

            return true;
        };

        var triggerFooterShortcut = function(shortcutKey) {
            if (!footerActions) {
                return;
            }

            var footerButtons = footerActions.querySelectorAll('button');
            for (var index = 0; index < footerButtons.length; index++) {
                var button = footerButtons[index];
                if (!isElementUsableForShortcut(button)) {
                    continue;
                }

                if (getFooterShortcutKey(button) === shortcutKey) {
                    button.click();
                    break;
                }
            }
        };

        if (isReverseProductionPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var reverseProductionTemplate = document.getElementById('reverse-production-footer-actions-template');
            if (footerActions && reverseProductionTemplate && reverseProductionTemplate.firstElementChild) {
                footerActions.appendChild(reverseProductionTemplate.firstElementChild);
            }
        } else if (isProductionPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var productionTemplate = document.getElementById('production-footer-actions-template');
            if (footerActions && productionTemplate && productionTemplate.firstElementChild) {
                footerActions.appendChild(productionTemplate.firstElementChild);
            }
        } else if (isRecipePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var recipeTemplate = document.getElementById('recipe-footer-actions-template');
            if (footerActions && recipeTemplate && recipeTemplate.firstElementChild) {
                footerActions.appendChild(recipeTemplate.firstElementChild);
            }
        } else if (isProfilePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var profileTemplate = document.getElementById('user-profile-footer-actions-template');
            if (footerActions && profileTemplate && profileTemplate.firstElementChild) {
                footerActions.appendChild(profileTemplate.firstElementChild);
            }
        } else if (isUserPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var userTemplate = document.getElementById('user-footer-actions-template');
            if (footerActions && userTemplate && userTemplate.firstElementChild) {
                footerActions.appendChild(userTemplate.firstElementChild);
            }
        } else if (isRolePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var roleTemplate = document.getElementById('role-footer-actions-template');
            if (footerActions && roleTemplate && roleTemplate.firstElementChild) {
                footerActions.appendChild(roleTemplate.firstElementChild);
            }
        } else if (isInvoiceLayoutPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var invoiceLayoutTemplate = document.getElementById('invoice-layout-footer-actions-template');
            if (footerActions && invoiceLayoutTemplate && invoiceLayoutTemplate.firstElementChild) {
                footerActions.appendChild(invoiceLayoutTemplate.firstElementChild);
            }
        } else if (isBusinessLocationPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var businessLocationTemplate = document.getElementById('business-location-footer-actions-template');
            if (footerActions && businessLocationTemplate && businessLocationTemplate.firstElementChild) {
                footerActions.appendChild(businessLocationTemplate.firstElementChild);
            }
        } else if (isLocationSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var locationSettingsTemplate = document.getElementById('location-settings-footer-actions-template');
            if (footerActions && locationSettingsTemplate && locationSettingsTemplate.firstElementChild) {
                footerActions.appendChild(locationSettingsTemplate.firstElementChild);
            }
        } else if (isBusinessSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var businessSettingsTemplate = document.getElementById('business-settings-footer-actions-template');
            if (footerActions && businessSettingsTemplate && businessSettingsTemplate.firstElementChild) {
                footerActions.appendChild(businessSettingsTemplate.firstElementChild);
            }
        } else if (isRentalSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var rentalSettingsTemplate = document.getElementById('rental-settings-footer-actions-template');
            if (footerActions && rentalSettingsTemplate && rentalSettingsTemplate.firstElementChild) {
                footerActions.appendChild(rentalSettingsTemplate.firstElementChild);
            }
        } else if (isRentalItemPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var rentalItemTemplate = document.getElementById('rental-item-footer-actions-template');
            if (footerActions && rentalItemTemplate) {
                while (rentalItemTemplate.firstElementChild) {
                    footerActions.appendChild(rentalItemTemplate.firstElementChild);
                }
            }
        } else if (isRentalAgreementPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var rentalAgreementTemplate = document.getElementById('rental-agreement-footer-actions-template');
            if (footerActions && rentalAgreementTemplate) {
                while (rentalAgreementTemplate.firstElementChild) {
                    footerActions.appendChild(rentalAgreementTemplate.firstElementChild);
                }
            }
        } else if (isRentalMaintenancePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var rentalMaintenanceTemplate = document.getElementById('rental-maintenance-footer-actions-template');
            if (footerActions && rentalMaintenanceTemplate) {
                while (rentalMaintenanceTemplate.firstElementChild) {
                    footerActions.appendChild(rentalMaintenanceTemplate.firstElementChild);
                }
            }
        } else if (isStockAdjustmentPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var stockAdjustmentTemplate = document.getElementById('stock-adjustment-footer-actions-template');
            if (footerActions && stockAdjustmentTemplate && stockAdjustmentTemplate.firstElementChild) {
                footerActions.appendChild(stockAdjustmentTemplate.firstElementChild);
            }
        } else if (isExpensePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var expenseTemplate = document.getElementById('expense-footer-actions-template');
            if (footerActions && expenseTemplate && expenseTemplate.firstElementChild) {
                footerActions.appendChild(expenseTemplate.firstElementChild);
            }
        } else if (isProductPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var productTemplate = document.getElementById('product-footer-actions-template');
            if (footerActions && productTemplate && productTemplate.firstElementChild) {
                footerActions.appendChild(productTemplate.firstElementChild);
            }
        } else if (isTankPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var tankTemplate = document.getElementById('tank-footer-actions-template');
            if (footerActions && tankTemplate && tankTemplate.firstElementChild) {
                footerActions.appendChild(tankTemplate.firstElementChild);
            }
        } else if (isDispenserPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var dispenserTemplate = document.getElementById('dispenser-footer-actions-template');
            if (footerActions && dispenserTemplate && dispenserTemplate.firstElementChild) {
                footerActions.appendChild(dispenserTemplate.firstElementChild);
            }
        } else if (isNozzlePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var nozzleTemplate = document.getElementById('nozzle-footer-actions-template');
            if (footerActions && nozzleTemplate && nozzleTemplate.firstElementChild) {
                footerActions.appendChild(nozzleTemplate.firstElementChild);
            }
        } else if (isShiftPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var shiftTemplate = document.getElementById('shift-footer-actions-template');
            if (footerActions && shiftTemplate && shiftTemplate.firstElementChild) {
                footerActions.appendChild(shiftTemplate.firstElementChild);
            }
        } else if (isCloseShiftPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var closeShiftTemplate = document.getElementById('close-shift-footer-actions-template');
            if (footerActions && closeShiftTemplate && closeShiftTemplate.firstElementChild) {
                footerActions.appendChild(closeShiftTemplate.firstElementChild);
            }
        } else if (isTankAdjustmentPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var tankAdjustmentTemplate = document.getElementById('tank-adjustment-footer-actions-template');
            if (footerActions && tankAdjustmentTemplate && tankAdjustmentTemplate.firstElementChild) {
                footerActions.appendChild(tankAdjustmentTemplate.firstElementChild);
            }
        } else if (isSellPage || isSellReturnPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var savePrintButton = document.createElement('button');
                savePrintButton.type = 'button';
                savePrintButton.id = 'save-and-print';
                savePrintButton.className = 'btn btn-success sell_submit_action';

                var submitButton = document.createElement('button');
                submitButton.type = 'button';
                submitButton.className = 'btn btn-primary sell_submit_action';

                if (isSellPage) {
                    submitButton.id = 'submit-sell';
                    if (isEditSellPage) {
                        submitButton.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                        savePrintButton.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.update_and_print'); ?>';
                    } else {
                        submitButton.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                        savePrintButton.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>';
                    }

                    var cancelButton = document.createElement('button');
                    cancelButton.type = 'button';
                    cancelButton.id = 'sale-cancel';
                    cancelButton.className = 'btn btn-danger';
                    cancelButton.innerHTML = '<i class="fas fa-times"></i> <?php echo app('translator')->get('messages.cancel'); ?>';

                    footerActions.appendChild(submitButton);
                    footerActions.appendChild(savePrintButton);
                    footerActions.appendChild(cancelButton);
                } else {
                    submitButton.id = 'submit_sell_return_form';
                    submitButton.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                    savePrintButton.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>';

                    if (document.getElementById('select_location_id') || document.getElementById('customer_id')) {
                        submitButton.disabled = true;
                        savePrintButton.disabled = true;
                    }

                    footerActions.appendChild(savePrintButton);
                    footerActions.appendChild(submitButton);


                }
            }
        } else if (isPurchaseReturnPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var returnSubmitButton = document.createElement('button');
                returnSubmitButton.type = 'button';
                returnSubmitButton.id = 'submit_purchase_return_form';
                returnSubmitButton.className = 'btn btn-primary submit_purchase_return_form_btn';

                var hasReturnLocationId = document.getElementById('location_id') !== null;
                var hasReturnTransactionId = document.querySelector('input[name="transaction_id"]') !== null;

                if (hasReturnLocationId) {
                    returnSubmitButton.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else if (hasReturnTransactionId) {
                    returnSubmitButton.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                } else {
                    returnSubmitButton.innerHTML = '<i class="fas fa-check"></i> <?php echo app('translator')->get('messages.submit'); ?>';
                }

                footerActions.appendChild(returnSubmitButton);
            }
        } else if (isPurchasePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var purchaseIdInput = document.getElementById('purchase_id');
                var isPurchaseEdit = purchaseIdInput && purchaseIdInput.value && purchaseIdInput.value.trim() !== '';

                var purchaseSavePrintButton = document.createElement('button');
                purchaseSavePrintButton.type = 'button';
                purchaseSavePrintButton.id = 'submit_purchase_form';
                purchaseSavePrintButton.className = 'btn btn-success save_and_print submit_purchase_form_btn';
                purchaseSavePrintButton.innerHTML = isPurchaseEdit ? '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.update_and_print'); ?>' : '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>';

                var purchaseSubmitButton = document.createElement('button');
                purchaseSubmitButton.type = 'button';
                purchaseSubmitButton.id = 'submit_purchase_form';
                purchaseSubmitButton.className = 'btn btn-primary submit_purchase_form_btn';
                purchaseSubmitButton.innerHTML = isPurchaseEdit ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                footerActions.appendChild(purchaseSavePrintButton);
                footerActions.appendChild(purchaseSubmitButton);
            }
        } else if (isJobSheetPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var jobSheetTemplate = document.getElementById('job-sheet-footer-actions-template');
            if (footerActions && jobSheetTemplate && jobSheetTemplate.firstElementChild) {
                footerActions.appendChild(jobSheetTemplate.firstElementChild);
            }
        } else if (isDriverInvoicePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var driverInvoiceTemplate = document.getElementById('driver-invoice-footer-actions-template');
            if (footerActions && driverInvoiceTemplate && driverInvoiceTemplate.firstElementChild) {
                footerActions.appendChild(driverInvoiceTemplate.firstElementChild);
            }
        } else if (isOpeningStockPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var openingStockTemplate = document.getElementById('opening-stock-footer-actions-template');
            if (footerActions && openingStockTemplate && openingStockTemplate.firstElementChild) {
                footerActions.appendChild(openingStockTemplate.firstElementChild);
            }
        } else if (isLabelPrintPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var labelPrintTemplate = document.getElementById('label-print-footer-actions-template');
            if (footerActions && labelPrintTemplate && labelPrintTemplate.firstElementChild) {
                footerActions.appendChild(labelPrintTemplate.firstElementChild);
            }
        } else if (isPackagePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var packageSubmitButton = document.createElement('button');
                packageSubmitButton.type = 'submit';
                packageSubmitButton.className = 'btn btn-primary';
                packageSubmitButton.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                var packageForm = document.getElementById('add_package_form') || document.getElementById('edit_package_form');
                packageSubmitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (packageForm) {
                        packageForm.submit();
                    }
                });

                footerActions.appendChild(packageSubmitButton);
            }
        } else if (isBusinessRegisterPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var bizSubmitButton = document.createElement('button');
                bizSubmitButton.type = 'submit';
                bizSubmitButton.className = 'btn btn-success';
                bizSubmitButton.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.submit'); ?>';

                var bizForm = document.getElementById('business_register_form');
                bizSubmitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (bizForm) {
                        bizForm.submit();
                    }
                });

                footerActions.appendChild(bizSubmitButton);
            }
        } else if (isCouponPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var couponSubmitButton = document.createElement('button');
                couponSubmitButton.type = 'submit';
                couponSubmitButton.className = 'btn btn-success';
                couponSubmitButton.innerHTML = isCouponEditPage ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.submit'); ?>';

                var couponForm = document.getElementById('create_coupon') || document.getElementById('edit_coupon');
                couponSubmitButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (couponForm) {
                        couponForm.submit();
                    }
                });

                footerActions.appendChild(couponSubmitButton);
            }
        } else if (isBulkEditPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var bulkEditUpdateButton = document.createElement('button');
                bulkEditUpdateButton.type = 'submit';
                bulkEditUpdateButton.className = 'btn btn-primary';
                bulkEditUpdateButton.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                var bulkEditForm = document.getElementById('bulk_edit_products_form');
                bulkEditUpdateButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (bulkEditForm) {
                        bulkEditForm.submit();
                    }
                });

                footerActions.appendChild(bulkEditUpdateButton);
            }
        } else if (isSuperadminSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var settingsUpdateButton = document.createElement('button');
                settingsUpdateButton.type = 'submit';
                settingsUpdateButton.className = 'btn btn-danger';
                settingsUpdateButton.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                var settingsForm = document.getElementById('superadmin_settings_form');
                settingsUpdateButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (settingsForm) {
                        settingsForm.submit();
                    }
                });

                footerActions.appendChild(settingsUpdateButton);
            }
        } else if (isPayrollPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var payrollTemplate = document.getElementById('payroll-footer-actions-template');
            if (footerActions && payrollTemplate && payrollTemplate.firstElementChild) {
                footerActions.appendChild(payrollTemplate.firstElementChild);
            }

            var footerPayrollSubmit = document.getElementById('footer_submit_payroll');
            if (footerPayrollSubmit) {
                footerPayrollSubmit.addEventListener('click', function(e) {
                    e.preventDefault();
                    var payrollForm = document.getElementById('add_payroll_form');
                    var statusSelect = document.querySelector('[name="payroll_group_status"]');
                    if (statusSelect && !statusSelect.value) {
                        toastr.error('Please select a status before saving.');
                        statusSelect.focus();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        return;
                    }
                    var footerCheckbox = document.getElementById('footer_notify_employee');
                    var hiddenInput = document.getElementById('hidden_notify_employee');
                    if (hiddenInput && footerCheckbox) {
                        hiddenInput.value = footerCheckbox.checked ? '1' : '0';
                    }
                    if (payrollForm) {
                        payrollForm.submit();
                    }
                });
            }
        } else if (isJournalEntryPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var isJournalEdit = document.querySelector('#journal_add_form input[name="_method"][value="PUT"]') !== null;
                var hasSaveAndPrint = document.getElementById('save_and_print') !== null;

                if (hasSaveAndPrint) {
                    var journalSavePrintBtn = document.createElement('button');
                    journalSavePrintBtn.type = 'button';
                    journalSavePrintBtn.className = 'btn btn-success journal_add_btn';
                    journalSavePrintBtn.id = 'save_and_print_btn';
                    journalSavePrintBtn.disabled = true;
                    journalSavePrintBtn.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>';
                    footerActions.appendChild(journalSavePrintBtn);
                }

                var journalSaveBtn = document.createElement('button');
                journalSaveBtn.type = 'button';
                journalSaveBtn.className = 'btn btn-primary journal_add_btn';
                journalSaveBtn.id = 'save_btn';
                if (!isJournalEdit) {
                    journalSaveBtn.disabled = true;
                }
                journalSaveBtn.innerHTML = isJournalEdit ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                footerActions.appendChild(journalSaveBtn);
            }
        } else if (isContactLedgerPage) {
            // Contact view page - footer managed by tab switch in show.blade.php
            // Set up initial state based on active tab
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            window.contactViewFooterSetTab = function(tabId) {
                if (!footerActions) return;
                footerActions.innerHTML = '';

                var printPreviewBtn = document.createElement('button');
                printPreviewBtn.type = 'button';
                printPreviewBtn.className = 'btn btn-primary btn-sm';
                printPreviewBtn.id = 'print_contact_active_tab_footer';
                printPreviewBtn.setAttribute('data-contact-tab', tabId);
                printPreviewBtn.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>';
                footerActions.appendChild(printPreviewBtn);

                if (tabId === 'ledger_tab') {
                    var excelBtn = document.createElement('button');
                    excelBtn.type = 'button';
                    excelBtn.className = 'btn btn-success btn-sm';
                    excelBtn.id = 'export_ledger_excel';
                    excelBtn.innerHTML = '<i class="fas fa-file-excel"></i> Export to excel';
                    footerActions.appendChild(excelBtn);

                    var pdfBtn = document.createElement('button');
                    pdfBtn.type = 'button';
                    pdfBtn.className = 'btn btn-danger btn-sm';
                    pdfBtn.id = 'print_ledger_pdf';
                    pdfBtn.innerHTML = '<i class="fas fa-file-pdf"></i> Export to pdf';
                    var pdfHref = document.getElementById('ledger_pdf_href') ? document.getElementById('ledger_pdf_href').value : '';
                    pdfBtn.setAttribute('data-href', pdfHref);
                    footerActions.appendChild(pdfBtn);

                    var emailBtn = document.createElement('button');
                    emailBtn.type = 'button';
                    emailBtn.className = 'btn btn-default btn-sm';
                    emailBtn.id = 'send_ledger';
                    emailBtn.innerHTML = '<i class="fas fa-envelope"></i> Send Email';
                    footerActions.appendChild(emailBtn);
                } else if (tabId === 'documents_and_notes_tab') {
                    var docAddBtn = document.querySelector('.document_note_body .docs_and_notes_btn');
                    if (docAddBtn) {
                        var addNoteBtn = document.createElement('button');
                        addNoteBtn.type = 'button';
                        addNoteBtn.className = 'btn btn-primary btn-sm docs_and_notes_btn';
                        addNoteBtn.setAttribute('data-href', docAddBtn.getAttribute('data-href'));
                        addNoteBtn.innerHTML = '<i class="fa fa-plus"></i> ' + docAddBtn.textContent.trim();
                        footerActions.appendChild(addNoteBtn);
                    }
                }
            };

            // Set initial tab
            var activeTab = document.querySelector('.nav-tabs .nav-link.active');
            if (activeTab) {
                var href = activeTab.getAttribute('href');
                if (href) {
                    window.contactViewFooterSetTab(href.replace('#', ''));
                }
            }
        }

        if (isCmsSiteDetailsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var cmsSiteDetailsBtn = document.createElement('button');
                cmsSiteDetailsBtn.type = 'button';
                cmsSiteDetailsBtn.className = 'btn btn-primary submit-btn';
                cmsSiteDetailsBtn.innerHTML = '<i class="fas fa-check"></i> <?php echo app('translator')->get('messages.submit'); ?>';

                cmsSiteDetailsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var cmsForm = document.getElementById('site_details_form');
                    if (cmsForm && typeof $ !== 'undefined') {
                        $('form#site_details_form').submit();
                    }
                });

                footerActions.appendChild(cmsSiteDetailsBtn);
            }
        }

        if (isPatientPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var patientTemplate = document.getElementById('patient-footer-actions-template');
            if (footerActions && patientTemplate && patientTemplate.firstElementChild) {
                footerActions.appendChild(patientTemplate.firstElementChild);
            }

            var patientSaveBtn = document.getElementById('patient_save_btn');
            if (patientSaveBtn) {
                patientSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var patientForm = document.getElementById('patient_form');
                    if (patientForm) {
                        patientForm.submit();
                    }
                });
            }
        }

        if (isDoctorPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var doctorTemplate = document.getElementById('doctor-footer-actions-template');
            if (footerActions && doctorTemplate && doctorTemplate.firstElementChild) {
                footerActions.appendChild(doctorTemplate.firstElementChild);
            }

            var doctorSaveBtn = document.getElementById('doctor_save_btn');
            if (doctorSaveBtn) {
                doctorSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var doctorForm = document.getElementById('doctor_form');
                    if (doctorForm) {
                        doctorForm.submit();
                    }
                });
            }
        }

        if (isConsultationPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var consultationTemplate = document.getElementById('consultation-footer-actions-template');
            if (footerActions && consultationTemplate && consultationTemplate.firstElementChild) {
                footerActions.appendChild(consultationTemplate.firstElementChild);
            }

            var consultationSaveBtn = document.getElementById('consultation_save_btn');
            if (consultationSaveBtn) {
                consultationSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var consultationForm = document.getElementById('consultation_form');
                    if (consultationForm) {
                        consultationForm.submit();
                    }
                });
            }
        }

        if (isLabOrderPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var labOrderTemplate = document.getElementById('lab-order-footer-actions-template');
            if (footerActions && labOrderTemplate && labOrderTemplate.firstElementChild) {
                footerActions.appendChild(labOrderTemplate.firstElementChild);
            }

            var labOrderSaveBtn = document.getElementById('lab_order_save_btn');
            if (labOrderSaveBtn) {
                labOrderSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var labOrderForm = document.getElementById('lab_order_form');
                    if (labOrderForm) {
                        labOrderForm.submit();
                    }
                });
            }
        }

        if (isPrescriptionPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var prescriptionTemplate = document.getElementById('prescription-footer-actions-template');
            if (footerActions && prescriptionTemplate && prescriptionTemplate.firstElementChild) {
                footerActions.appendChild(prescriptionTemplate.firstElementChild);
            }

            var prescriptionSaveBtn = document.getElementById('prescription_save_btn');
            if (prescriptionSaveBtn) {
                prescriptionSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var prescriptionForm = document.getElementById('prescription_form');
                    if (prescriptionForm) {
                        prescriptionForm.submit();
                    }
                });
            }
        }

        if (isAppointmentPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var appointmentTemplate = document.getElementById('appointment-footer-actions-template');
            if (footerActions && appointmentTemplate && appointmentTemplate.firstElementChild) {
                footerActions.appendChild(appointmentTemplate.firstElementChild);
            }

            var appointmentSaveBtn = document.getElementById('appointment_save_btn');
            if (appointmentSaveBtn) {
                appointmentSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var appointmentForm = document.getElementById('appointment_form');
                    if (appointmentForm) {
                        appointmentForm.submit();
                    }
                });
            }
        }

        if (isHmsBookingCreatePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var hmsBookingTemplate = document.getElementById('hms-booking-footer-actions-template');
            if (footerActions && hmsBookingTemplate && hmsBookingTemplate.firstElementChild) {
                footerActions.appendChild(hmsBookingTemplate.firstElementChild);
            }

            var hmsBookingSaveBtn = document.getElementById('hms_booking_save_btn');
            if (hmsBookingSaveBtn) {
                hmsBookingSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var bookingForm = document.getElementById('create_booking');
                    if (bookingForm) {
                        bookingForm.submit();
                    }
                });
            }
        }

        if (isClinicSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var clinicSettingsBtn = document.createElement('button');
                clinicSettingsBtn.type = 'button';
                clinicSettingsBtn.className = 'btn btn-primary';
                clinicSettingsBtn.id = 'clinic_settings_save_btn';
                clinicSettingsBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                clinicSettingsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var clinicForm = document.getElementById('clinic_settings_form');
                    if (clinicForm && typeof $ !== 'undefined') {
                        var $form = $(clinicForm);
                        $.ajax({
                            url: $form.attr('action'),
                            type: 'POST',
                            data: $form.serialize(),
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Something went wrong');
                            }
                        });
                    }
                });

                footerActions.appendChild(clinicSettingsBtn);
            }
        }

        if (isNotificationTemplatePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var notificationTemplate = document.getElementById('notification-template-footer-actions-template');
            if (footerActions && notificationTemplate && notificationTemplate.firstElementChild) {
                footerActions.appendChild(notificationTemplate.firstElementChild);
            }

            var notifSaveBtn = document.getElementById('notification_template_save_btn');
            if (notifSaveBtn) {
                notifSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var notifForm = document.getElementById('notification_template_form');
                    if (notifForm) {
                        notifForm.submit();
                    }
                });
            }
        }

        if (isCatalogueSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var catalogueSettingsTemplate = document.getElementById('catalogue-settings-footer-actions-template');
            if (footerActions && catalogueSettingsTemplate && catalogueSettingsTemplate.firstElementChild) {
                footerActions.appendChild(catalogueSettingsTemplate.firstElementChild);
            }

            var catSettingsSaveBtn = document.getElementById('catalogue_settings_save_btn');
            if (catSettingsSaveBtn) {
                catSettingsSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var catSettingsForm = document.getElementById('catalogue_settings_form');
                    if (catSettingsForm) {
                        catSettingsForm.submit();
                    }
                });
            }
        }

        if (isTruckmateSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tmSettingsUpdateBtn = document.createElement('button');
                tmSettingsUpdateBtn.type = 'button';
                tmSettingsUpdateBtn.className = 'btn btn-danger';
                tmSettingsUpdateBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                tmSettingsUpdateBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var activeTab = document.querySelector('.tab-content > .tab-pane.active.show');
                    if (activeTab) {
                        var form = activeTab.querySelector('form');
                        if (form) {
                            form.submit();
                        }
                    }
                });

                footerActions.appendChild(tmSettingsUpdateBtn);
            }
        }

        if (isTailorProSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpSettingsBtn = document.createElement('button');
                tpSettingsBtn.type = 'button';
                tpSettingsBtn.className = 'btn btn-primary';
                tpSettingsBtn.id = 'tailorpro_settings_save_btn';
                tpSettingsBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                tpSettingsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpForm = document.getElementById('tailorpro_settings_form');
                    if (tpForm && typeof $ !== 'undefined') {
                        var $form = $(tpForm);
                        $.ajax({
                            url: $form.attr('action'),
                            type: 'POST',
                            data: $form.serialize(),
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.msg);
                                } else {
                                    toastr.error(result.msg);
                                }
                            },
                            error: function(xhr) {
                                toastr.error('Something went wrong');
                            }
                        });
                    }
                });

                footerActions.appendChild(tpSettingsBtn);
            }
        }

        if (isTailorProOrderPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpOrderBtn = document.createElement('button');
                tpOrderBtn.type = 'submit';
                tpOrderBtn.className = 'btn btn-primary';

                if (isTailorProOrderEdit) {
                    tpOrderBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpOrderBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpOrderBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpOrderForm = document.getElementById('tailorpro_order_form');
                    if (tpOrderForm) {
                        tpOrderForm.submit();
                    }
                });

                footerActions.appendChild(tpOrderBtn);
            }
        }

        if (isTailorProStatusPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpStatusBtn = document.createElement('button');
                tpStatusBtn.type = 'submit';
                tpStatusBtn.className = 'btn btn-primary';

                if (isTailorProStatusEdit) {
                    tpStatusBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpStatusBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpStatusBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpStatusForm = document.getElementById('tailorpro_status_form');
                    if (tpStatusForm) {
                        tpStatusForm.submit();
                    }
                });

                footerActions.appendChild(tpStatusBtn);
            }
        }

        if (isTailorProMeasurementPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpMeasurementBtn = document.createElement('button');
                tpMeasurementBtn.type = 'button';
                tpMeasurementBtn.className = 'btn btn-primary';

                if (isTailorProMeasurementEdit) {
                    tpMeasurementBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpMeasurementBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpMeasurementBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpMeasurementForm = document.getElementById('tailorpro_measurement_form');
                    if (tpMeasurementForm && typeof $ !== 'undefined') {
                        $(tpMeasurementForm).submit();
                    }
                });

                footerActions.appendChild(tpMeasurementBtn);
            }
        }

        if (isTailorProCatalogPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpCatalogBtn = document.createElement('button');
                tpCatalogBtn.type = 'button';
                tpCatalogBtn.className = 'btn btn-primary';

                if (isTailorProCatalogEdit) {
                    tpCatalogBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpCatalogBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpCatalogBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpCatalogForm = document.getElementById('tailorpro_catalog_form');
                    if (tpCatalogForm && typeof $ !== 'undefined') {
                        $(tpCatalogForm).submit();
                    }
                });

                footerActions.appendChild(tpCatalogBtn);
            }
        }

        if (isTailorProCustomFieldPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpCustomFieldBtn = document.createElement('button');
                tpCustomFieldBtn.type = 'button';
                tpCustomFieldBtn.className = 'btn btn-primary';

                if (isTailorProCustomFieldEdit) {
                    tpCustomFieldBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpCustomFieldBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpCustomFieldBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpCustomFieldForm = document.getElementById('tailorpro_custom_field_form');
                    if (tpCustomFieldForm && typeof $ !== 'undefined') {
                        $(tpCustomFieldForm).submit();
                    }
                });

                footerActions.appendChild(tpCustomFieldBtn);
            }
        }

        if (isTailorProTemplatePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tpTemplateBtn = document.createElement('button');
                tpTemplateBtn.type = 'button';
                tpTemplateBtn.className = 'btn btn-primary';

                if (isTailorProTemplateEdit) {
                    tpTemplateBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';
                } else {
                    tpTemplateBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                }

                tpTemplateBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var tpTemplateForm = document.getElementById('tailorpro_template_form');
                    if (tpTemplateForm && typeof $ !== 'undefined') {
                        $(tpTemplateForm).submit();
                    }
                });

                footerActions.appendChild(tpTemplateBtn);
            }
        }

        if (isVehicleCreatePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var vehicleSaveBtn = document.createElement('button');
                vehicleSaveBtn.type = 'button';
                vehicleSaveBtn.className = 'btn btn-primary';
                vehicleSaveBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                vehicleSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var vehicleForm = document.getElementById('vehicle_form');
                    if (vehicleForm) {
                        vehicleForm.submit();
                    }
                });

                footerActions.appendChild(vehicleSaveBtn);
            }
        }

        if (isTruckmateInvoicePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var tmSavePrintButton = document.createElement('button');
                tmSavePrintButton.type = 'button';
                tmSavePrintButton.id = 'save-and-print';
                tmSavePrintButton.className = 'btn btn-success';
                tmSavePrintButton.innerHTML = isTruckmateInvoiceEdit ? '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.update_and_print'); ?>' : '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.save_and_print'); ?>';

                var tmSubmitButton = document.createElement('button');
                tmSubmitButton.type = 'button';
                tmSubmitButton.id = 'submit-sell';
                tmSubmitButton.className = 'btn btn-primary';
                tmSubmitButton.innerHTML = isTruckmateInvoiceEdit ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                footerActions.appendChild(tmSubmitButton);
                footerActions.appendChild(tmSavePrintButton);
            }
        }

        if (isWarehousePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var warehouseSaveBtn = document.createElement('button');
                warehouseSaveBtn.type = 'button';
                warehouseSaveBtn.className = 'btn btn-primary';
                warehouseSaveBtn.innerHTML = isWarehouseEdit ? '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                warehouseSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var warehouseForm = document.getElementById('warehouse_form');
                    if (warehouseForm) {
                        warehouseForm.submit();
                    }
                });

                footerActions.appendChild(warehouseSaveBtn);
            }
        }

        if (isWarehouseTransferPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                if (isWarehouseTransferEdit) {
                    // Update button
                    var transferUpdateBtn = document.createElement('button');
                    transferUpdateBtn.type = 'button';
                    transferUpdateBtn.id = 'update_wh_transfer';
                    transferUpdateBtn.className = 'btn btn-primary';
                    transferUpdateBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?>';
                    transferUpdateBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var $form = $('form#warehouse_transfer_form');
                        if ($('table#stock_transfer_product_table tbody').find('.product_row').length <= 0) {
                            toastr.warning(LANG.no_products_added);
                            return;
                        }
                        if ($form.valid()) {
                            $('#sell-footer-actions button').prop('disabled', true);
                            $form.submit();
                        }
                    });
                    footerActions.appendChild(transferUpdateBtn);

                    // Update & Print button
                    var transferUpdatePrintBtn = document.createElement('button');
                    transferUpdatePrintBtn.type = 'button';
                    transferUpdatePrintBtn.id = 'update_and_print_wh_transfer';
                    transferUpdatePrintBtn.className = 'btn btn-success';
                    transferUpdatePrintBtn.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('messages.update'); ?> & <?php echo app('translator')->get('messages.print'); ?>';
                    transferUpdatePrintBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var $form = $('form#warehouse_transfer_form');
                        if ($('table#stock_transfer_product_table tbody').find('.product_row').length <= 0) {
                            toastr.warning(LANG.no_products_added);
                            return;
                        }
                        if (!$form.valid()) return;
                        $('#sell-footer-actions button').prop('disabled', true);
                        $('input#print_after_save').val(1);
                        $form.submit();
                    });
                    footerActions.appendChild(transferUpdatePrintBtn);
                } else {
                    // Save button
                    var transferSaveBtn = document.createElement('button');
                    transferSaveBtn.type = 'button';
                    transferSaveBtn.id = 'save_wh_transfer';
                    transferSaveBtn.className = 'btn btn-primary';
                    transferSaveBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                    transferSaveBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var $form = $('form#warehouse_transfer_form');
                        if ($('table#stock_transfer_product_table tbody').find('.product_row').length <= 0) {
                            toastr.warning(LANG.no_products_added);
                            return;
                        }
                        if ($form.valid()) {
                            $('#sell-footer-actions button').prop('disabled', true);
                            $form.submit();
                        }
                    });
                    footerActions.appendChild(transferSaveBtn);

                    // Save & Print button
                    var transferSavePrintBtn = document.createElement('button');
                    transferSavePrintBtn.type = 'button';
                    transferSavePrintBtn.id = 'save_and_print_wh_transfer';
                    transferSavePrintBtn.className = 'btn btn-success';
                    transferSavePrintBtn.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('messages.save'); ?> & <?php echo app('translator')->get('messages.print'); ?>';
                    transferSavePrintBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        var $form = $('form#warehouse_transfer_form');
                        if ($('table#stock_transfer_product_table tbody').find('.product_row').length <= 0) {
                            toastr.warning(LANG.no_products_added);
                            return;
                        }
                        if (!$form.valid()) return;
                        $('#sell-footer-actions button').prop('disabled', true);
                        $('input#print_after_save').val(1);
                        $form.submit();
                    });
                    footerActions.appendChild(transferSavePrintBtn);
                }
            }
        }

        if (isStockTransferCreatePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                // Save button
                var stSaveBtn = document.createElement('button');
                stSaveBtn.type = 'button';
                stSaveBtn.id = 'save_stock_transfer';
                stSaveBtn.className = 'btn btn-primary stock_transfer_submit_action';
                stSaveBtn.innerHTML = '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                footerActions.appendChild(stSaveBtn);

                // Save & Print button
                var stSavePrintBtn = document.createElement('button');
                stSavePrintBtn.type = 'button';
                stSavePrintBtn.id = 'save_and_print_stock_transfer';
                stSavePrintBtn.className = 'btn btn-success stock_transfer_submit_action';
                stSavePrintBtn.innerHTML = '<i class="fas fa-print"></i> <?php echo app('translator')->get('messages.save'); ?> & <?php echo app('translator')->get('messages.print'); ?>';
                footerActions.appendChild(stSavePrintBtn);
            }
        }

        if (isImportPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var importSubmitBtn = document.createElement('button');
                importSubmitBtn.type = 'button';
                importSubmitBtn.id = 'submit_import_form';
                importSubmitBtn.className = 'btn btn-primary';
                importSubmitBtn.innerHTML = isImportEditPage ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                importSubmitBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var importForm = document.getElementById('import_add_form');
                    if (importForm) {
                        importForm.submit();
                    }
                });

                footerActions.appendChild(importSubmitBtn);
            }
        }

        if (isAccountingSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var accountingSettingsTemplate = document.getElementById('accounting-settings-footer-actions-template');
            if (footerActions && accountingSettingsTemplate && accountingSettingsTemplate.firstElementChild) {
                footerActions.appendChild(accountingSettingsTemplate.firstElementChild);
            }
        }

        if (isContactPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var contactTemplate = document.getElementById('contact-footer-actions-template');
            if (footerActions && contactTemplate) {
                footerActions.innerHTML = contactTemplate.innerHTML;
            }
        }

        if (isDiscountPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            var discountTemplate = document.getElementById('discount-footer-actions-template');
            if (footerActions && discountTemplate) {
                footerActions.innerHTML = discountTemplate.innerHTML;
            }
        }

        if (isBarcodePage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var barcodeSaveBtn = document.createElement('button');
                barcodeSaveBtn.type = 'button';
                barcodeSaveBtn.className = 'btn btn-primary';
                barcodeSaveBtn.innerHTML = isBarcodeEditPage ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';

                barcodeSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var barcodeForm = document.getElementById('add_barcode_settings_form');
                    if (barcodeForm) {
                        barcodeForm.submit();
                    }
                });

                footerActions.appendChild(barcodeSaveBtn);
            }
        }

        if (isUserSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var userSettingsUpdateBtn = document.createElement('button');
                userSettingsUpdateBtn.type = 'button';
                userSettingsUpdateBtn.className = 'btn btn-success';
                userSettingsUpdateBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                userSettingsUpdateBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var userSettingsForm = document.getElementById('edit_user_settings_form');
                    if (userSettingsForm) {
                        userSettingsForm.submit();
                    }
                });

                footerActions.appendChild(userSettingsUpdateBtn);
            }
        }

        if (isEssentialsSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var essentialsSettingsUpdateBtn = document.createElement('button');
                essentialsSettingsUpdateBtn.type = 'button';
                essentialsSettingsUpdateBtn.className = 'btn btn-danger';
                essentialsSettingsUpdateBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                essentialsSettingsUpdateBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var essentialsForm = document.getElementById('essentials_settings_form');
                    if (essentialsForm) {
                        essentialsForm.submit();
                    }
                });

                footerActions.appendChild(essentialsSettingsUpdateBtn);
            }
        }

        if (isManufacturingSettingsPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var manufacturingSettingsUpdateBtn = document.createElement('button');
                manufacturingSettingsUpdateBtn.type = 'button';
                manufacturingSettingsUpdateBtn.className = 'btn btn-primary';
                manufacturingSettingsUpdateBtn.innerHTML = '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>';

                manufacturingSettingsUpdateBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var manufacturingForm = document.getElementById('manufacturing_settings_form');
                    if (manufacturingForm) {
                        manufacturingForm.submit();
                    }
                });

                footerActions.appendChild(manufacturingSettingsUpdateBtn);
            }
        }

        if (isDemandOrderPage) {
            if (footerActions) {
                footerActions.classList.remove('d-none');
                footerActions.innerHTML = '';
            }
            if (footerText) {
                footerText.classList.add('d-none');
            }
            if (fontSizeControls) {
                fontSizeControls.classList.add('d-none');
            }

            if (footerActions) {
                var demandOrderSavePrintBtn = document.createElement('button');
                demandOrderSavePrintBtn.type = 'button';
                demandOrderSavePrintBtn.className = 'btn btn-info';
                demandOrderSavePrintBtn.innerHTML = isDemandOrderEditPage ? '<i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.update_and_print'); ?>' : '<i class="fas fa-print"></i> <?php echo app('translator')->get('manufacturing::lang.save_and_print'); ?>';
                demandOrderSavePrintBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var flag = document.getElementById('save_and_print_flag');
                    if (flag) flag.value = 1;
                    var demandForm = document.getElementById('demand_order_form');
                    if (demandForm) demandForm.submit();
                });

                var demandOrderSaveBtn = document.createElement('button');
                demandOrderSaveBtn.type = 'button';
                demandOrderSaveBtn.className = 'btn btn-primary';
                demandOrderSaveBtn.innerHTML = isDemandOrderEditPage ? '<i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>' : '<i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>';
                demandOrderSaveBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var flag = document.getElementById('save_and_print_flag');
                    if (flag) flag.value = 0;
                    var demandForm = document.getElementById('demand_order_form');
                    if (demandForm) demandForm.submit();
                });

                footerActions.appendChild(demandOrderSavePrintBtn);
                footerActions.appendChild(demandOrderSaveBtn);
            }
        }

        applyFooterShortcutHints();

        document.addEventListener('keydown', function(event) {
            if (!event.shiftKey) {
                return;
            }

            var activeElement = document.activeElement;
            if (activeElement) {
                var activeTagName = (activeElement.tagName || '').toLowerCase();
                var isTypingField = activeTagName === 'input' || activeTagName === 'textarea' || activeTagName === 'select' || activeElement.isContentEditable;
                if (isTypingField) {
                    return;
                }
            }

            var key = (event.key || '').toLowerCase();
            var shortcutMap = {
                s: 'S',
                u: 'U',
                p: 'P',
                c: 'C'
            };

            if (!shortcutMap[key]) {
                return;
            }

            event.preventDefault();
            triggerFooterShortcut(shortcutMap[key]);
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('#sale-cancel')) {
                return;
            }

            if (document.getElementById('add_sell_form')) {
                window.scrollTo({ top: 0, behavior: 'smooth' });
                setTimeout(function() {
                    window.location.reload();
                }, 500);
                return;
            }

            if (document.getElementById('edit_sell_form')) {
                window.location.href = "<?php echo e(url('/pos'), false); ?>";
            }
        });
    });
</script>
