<?php if($is_first): ?>
<div class="label-preview-toolbar no-print">
	<button type="button" onclick="printLabelPreview()">Print Labels</button>
</div>
<script>
	var labelPrintLocationId = <?php echo json_encode($location_id, 15, 512) ?>;
	var labelPrintPageWidth = <?php echo e((int) round($paper_width * 25400), false); ?>;
	var labelPrintPageHeight = <?php echo e((int) round($paper_height * 25400), false); ?>;

	function getConfiguredLabelPrinter() {
		if (!window.electronAPI || typeof window.electronAPI.getHostname !== 'function') {
			return Promise.resolve(null);
		}

		return window.electronAPI.getHostname().then(function(hostname) {
			if (!hostname || !labelPrintLocationId) {
				return null;
			}

			var url = '/workstation-settings/for-machine?location_id='
				+ encodeURIComponent(labelPrintLocationId)
				+ '&machine_name='
				+ encodeURIComponent(hostname);

			return fetch(url, {
				credentials: 'same-origin',
				headers: { 'X-Requested-With': 'XMLHttpRequest' }
			});
		}).then(function(response) {
			if (!response) {
				return null;
			}
			return response.json();
		}).then(function(result) {
			if (result && result.success && result.data && result.data.label_printer_name) {
				return result.data.label_printer_name;
			}
			return null;
		}).catch(function(error) {
			console.error('[LabelPrint] Could not load workstation label printer:', error);
			return null;
		});
	}

	function buildLabelPrintHtml() {
		var doc = document.documentElement.cloneNode(true);
		doc.querySelectorAll('.no-print, script').forEach(function(el) {
			el.remove();
		});

		return '<!DOCTYPE html>' + doc.outerHTML;
	}

	function __invokeNativePrintAsLabel() {
		// Tag the print call so Web2Desk's window.print() override knows to route
		// to the configured Label printer (uses settings.label_printer_name) silently.
		try { window.__printType = 'label'; } catch (e) {}
		window.print();
	}

	function printLabelPreview() {
		if (window.electronAPI && typeof window.electronAPI.silentPrint === 'function') {
			getConfiguredLabelPrinter().then(function(printerName) {
				if (!printerName) {
					console.warn('[LabelPrint] No printer from /workstation-settings/for-machine; falling back to override');
					__invokeNativePrintAsLabel();
					return;
				}

				window.electronAPI.silentPrint({
					html: buildLabelPrintHtml(),
					printer: printerName,
					silent: true,
					printBackground: true,
					copies: 1,
					pageWidth: labelPrintPageWidth,
					pageHeight: labelPrintPageHeight,
					printType: 'label'
				});
			}).catch(function() { __invokeNativePrintAsLabel(); });
			return;
		}

		// No electronAPI bridge: rely on Web2Desk's window.print() override (printType='label')
		__invokeNativePrintAsLabel();
	}

	document.addEventListener('keydown', function(event) {
		if ((event.ctrlKey || event.metaKey) && event.key && event.key.toLowerCase() === 'p') {
			event.preventDefault();
			printLabelPreview();
		}
	});

	// Auto-fire silent print on load so the popup goes straight to the
	// configured label printer without showing a system print dialog.
	window.addEventListener('load', function() {
		setTimeout(printLabelPreview, 600);
	});
</script>
<?php endif; ?>

<table align="center" style="border-spacing: <?php echo e($barcode_details->col_distance * 1, false); ?>in <?php echo e($barcode_details->row_distance * 1, false); ?>in; overflow: hidden !important;">
<?php $__currentLoopData = $page_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

	<?php if($loop->index % $barcode_details->stickers_in_one_row == 0): ?>
		<!-- create a new row -->
		<tr>
		<!-- <columns column-count="<?php echo e($barcode_details->stickers_in_one_row, false); ?>" column-gap="<?php echo e($barcode_details->col_distance*1, false); ?>"> -->
	<?php endif; ?>
		<td align="center" valign="center">
			<div style="overflow: hidden !important;display: flex; flex-wrap: wrap;align-content: center;width: <?php echo e($barcode_details->width * 1, false); ?>in; height: <?php echo e($barcode_details->height * 1, false); ?>in; justify-content: center; background-color:lightgrey">
				

				<div>

					
					<?php if(!empty($print['business_name'])): ?>
						<b style="display: block !important; font-size: <?php echo e($print['business_name_size'], false); ?>px"><?php echo e($business_name, false); ?></b>
					<?php endif; ?>

					
					<?php if(!empty($print['name'])): ?>
						<span style="display: block !important; font-size: <?php echo e($print['name_size'], false); ?>px">
							<?php echo e($page_product->product_actual_name, false); ?>


							<?php if(!empty($print['lot_number']) && !empty($page_product->lot_number)): ?>
								<span style="font-size: <?php echo e(12*$factor, false); ?>px">
									 (<?php echo e($page_product->lot_number, false); ?>)
								</span>
							<?php endif; ?>
						</span>
					<?php endif; ?>

					
					<?php if(!empty($print['variations']) && $page_product->is_dummy != 1): ?>
						<span style="display: block !important; font-size: <?php echo e($print['variations_size'], false); ?>px">
							<?php echo e($page_product->product_variation_name, false); ?>:<b><?php echo e($page_product->variation_name, false); ?></b>
						</span>
					<?php endif; ?>

					
					<?php if(!empty($print['unit'])): ?>
						<span style="display: block !important; font-size: <?php echo e($print['unit_size'], false); ?>px">
							<?php echo e($page_product->unit_name, false); ?>

						</span>
					<?php endif; ?>
					
					<?php if(!empty($print['sub_unit'])): ?>
						<span style="display: block !important; font-size: <?php echo e($print['sub_unit_size'], false); ?>px">
							<?php $__currentLoopData = $page_product->sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo e($sub_unit['name'], false); ?>

							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</span>
					<?php endif; ?>
					
					<?php if(!empty($print['category'])): ?>
						<span style="display: block !important; font-size: <?php echo e($print['category_size'] ?? 11, false); ?>px">
							<?php echo e($page_product->category ?? '', false); ?>

						</span>
					<?php endif; ?>

					
					<?php if(!empty($print['price'])): ?>
					<span style="font-size: <?php echo e($print['price_size'], false); ?>px;">
						<?php echo app('translator')->get('lang_v1.price'); ?>:
						<b><?php echo e(session('currency')['symbol'] ?? '', false); ?>


						<?php if($print['price_type'] == 'inclusive'): ?>
							<?php echo e(number_format($page_product->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						<?php else: ?>
							<?php echo e(number_format($page_product->default_sell_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						<?php endif; ?></b>
					</span>
					<?php endif; ?>
					
					
					<?php if(!empty($print['discount_price'])): ?>
					<span style="font-size: <?php echo e($print['discount_price_size'], false); ?>px;">
						<br>Discount Price:
						<b><?php echo e(session('currency')['symbol'] ?? '', false); ?>

							<?php echo e(number_format($page_product->discounted_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

						</b>
					</span>
					<?php endif; ?>
					
					<?php
					if(!empty($print['barcode_size'])){
						$barcode_size = $print['barcode_size'];
					}else{
						$barcode_size = $barcode_details->height*0.35;
					}
					
					?>
					<?php if(!empty($print['barcode'])): ?>
					
					<img style="max-width:90% !important;height: <?php echo e($barcode_size, false); ?>in !important; display: block;" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($page_product->sub_sku, $page_product->barcode_type, 1,30, array(0, 0, 0), false), false); ?>">
					<?php endif; ?>
					<span style="font-size: 10px !important">
						<?php echo e($page_product->sub_sku, false); ?>

					</span>
					
					<?php if(!empty($print['packing_date']) && !empty($page_product->packing_date)): ?>
						<br>
						<span style="font-size: <?php echo e($print['packing_date_size'], false); ?>px">
							<b><?php echo app('translator')->get('lang_v1.mfg_date_short'); ?>:</b>
							<?php echo e($page_product->packing_date, false); ?>

						</span>
					<?php endif; ?>
					<?php if(!empty($print['exp_date']) && !empty($page_product->exp_date)): ?>
						<span style="font-size: <?php echo e($print['exp_date_size'], false); ?>px">
							<b><?php echo app('translator')->get('lang_v1.expiry_date_short'); ?>:</b>
							<?php echo e($page_product->exp_date, false); ?>

						</span>
						<?php if($barcode_details->is_continuous): ?>
						<br>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		
		</td>

	<?php if($loop->iteration % $barcode_details->stickers_in_one_row == 0): ?>
		</tr>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>

<style type="text/css">
	<?php
		$label_font = !empty($print['label_font']) ? $print['label_font'] : 'Arial, Helvetica Neue, Helvetica, sans-serif';
	?>
	body{
		margin:5px !important;
		font-family: <?php echo e($label_font, false); ?> !important;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		font-weight: 500;
		letter-spacing: 0.02em;
	}
	.label-preview-toolbar {
		position: sticky;
		top: 0;
		z-index: 1000;
		padding: 10px;
		text-align: center;
		background: #f5f5f5;
		border-bottom: 1px solid #ddd;
	}
	.label-preview-toolbar button {
		padding: 8px 24px;
		border: 0;
		border-radius: 4px;
		background: #337ab7;
		color: #fff;
		font-size: 14px;
		cursor: pointer;
	}
	td{
		/* outline: 1px dotted lightgray; */
		font-family: <?php echo e($label_font, false); ?> !important;
	}
	b, strong {
		font-weight: 700;
	}
	span, div {
		font-family: <?php echo e($label_font, false); ?> !important;
	}
	@media print{
		.no-print {
			display: none !important;
		}
		
		table{
			page-break-after: always;
		}

		
		@page {
		size: <?php echo e($paper_width, false); ?>in <?php echo e($paper_height, false); ?>in;

		/*width: <?php echo e($barcode_details->paper_width, false); ?>in !important;*/
		/*height:<?php if($barcode_details->paper_height != 0): ?><?php echo e($barcode_details->paper_height, false); ?>in !important <?php else: ?> auto <?php endif; ?>;*/
		margin-top: <?php echo e($margin_top, false); ?>in !important;
		margin-bottom: <?php echo e($margin_top, false); ?>in !important;
		margin-left: <?php echo e($margin_left, false); ?>in !important;
		margin-right: <?php echo e($margin_left, false); ?>in !important;
	}
	}
</style>
