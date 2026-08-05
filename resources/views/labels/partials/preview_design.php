<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo e($business_name, false); ?> - Label Print</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #fff; }
        .label-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2mm;
            padding: 3mm;
            justify-content: flex-start;
        }
        .label-item {
            page-break-inside: avoid;
            overflow: hidden;
        }
        .label-item canvas {
            display: block;
        }
        @media print {
            body { margin: 0; }
            .no-print { display: none !important; }
            .label-grid { padding: 0; gap: 1mm; }
            @page {
                margin: 3mm;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="padding: 10px; text-align: center; background: #f0f0f0; border-bottom: 1px solid #ccc;">
        <button onclick="printLabelPreview()" style="padding: 8px 24px; font-size: 14px; cursor: pointer; background: #337ab7; color: #fff; border: none; border-radius: 4px;">
            Print Labels
        </button>
        <span style="margin-left: 15px; color: #666;">
            <?php echo e(count($label_products), false); ?> label(s) | <?php echo e($label_design->width, false); ?>" × <?php echo e($label_design->height, false); ?>" each
        </span>
    </div>

    <div class="label-grid" id="label_grid">
        <?php $__currentLoopData = $label_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $product_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="label-item" style="width: <?php echo e($label_design->width, false); ?>in; height: <?php echo e($label_design->height, false); ?>in;">
                <canvas id="label_canvas_<?php echo e($idx, false); ?>" 
                        width="<?php echo e($label_design->width * 96, false); ?>" 
                        height="<?php echo e($label_design->height * 96, false); ?>"></canvas>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script>
        var DPI = 96;
        var designData = <?php echo json_encode($label_design->design_data, 15, 512) ?>;
        var labelProducts = <?php echo json_encode($label_products, 15, 512) ?>;
        var labelWidth = <?php echo e($label_design->width, false); ?> * DPI;
        var labelHeight = <?php echo e($label_design->height, false); ?> * DPI;
        var labelPrintLocationId = <?php echo json_encode($location_id, 15, 512) ?>;
        var labelPrintPageWidth = <?php echo e((int) round($label_design->width * 25400), false); ?>;
        var labelPrintPageHeight = <?php echo e((int) round($label_design->height * 25400), false); ?>;

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
            var originalCanvases = document.querySelectorAll('canvas');
            var clonedCanvases = doc.querySelectorAll('canvas');

            originalCanvases.forEach(function(canvas, index) {
                var clonedCanvas = clonedCanvases[index];
                if (!clonedCanvas) {
                    return;
                }

                var image = document.createElement('img');
                image.src = canvas.toDataURL('image/png');
                image.width = canvas.width;
                image.height = canvas.height;
                image.style.width = canvas.style.width || canvas.width + 'px';
                image.style.height = canvas.style.height || canvas.height + 'px';
                image.style.display = 'block';
                clonedCanvas.parentNode.replaceChild(image, clonedCanvas);
            });

            doc.querySelectorAll('.no-print, script').forEach(function(el) {
                el.remove();
            });

            return '<!DOCTYPE html>' + doc.outerHTML;
        }

        function __invokeNativePrintAsLabel() {
            // Tag print so Web2Desk's window.print() override routes to label printer silently
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

            __invokeNativePrintAsLabel();
        }

        // Wait for Fabric.js to load
        document.addEventListener('DOMContentLoaded', function() {
            renderAllLabels();
            // Auto-fire silent print to configured label printer (Web2Desk)
            // after labels have rendered, so the popup never shows a print dialog.
            setTimeout(printLabelPreview, 1000);
        });

        function renderAllLabels() {
            labelProducts.forEach(function(productData, idx) {
                renderLabel(idx, productData);
            });
        }

        function renderLabel(idx, productData) {
            var canvasId = 'label_canvas_' + idx;
            var canvas = new fabric.StaticCanvas(canvasId, {
                width: labelWidth,
                height: labelHeight,
                backgroundColor: '#ffffff'
            });

            if (!designData || !designData.objects || designData.objects.length === 0) {
                // Empty design - just show a border
                canvas.add(new fabric.Rect({
                    left: 1, top: 1,
                    width: labelWidth - 2, height: labelHeight - 2,
                    fill: 'transparent', stroke: '#ccc', strokeWidth: 1
                }));
                canvas.renderAll();
                return;
            }

            // Clone the design data so we don't mutate the original
            var clonedData = JSON.parse(JSON.stringify(designData));

            // Replace data fields in the cloned objects
            clonedData.objects.forEach(function(obj) {
                if (obj.data_field && productData[obj.data_field] !== undefined) {
                    // Replace text with actual product data
                    obj.text = productData[obj.data_field] || '';
                }

                // Handle barcode elements
                if (obj.element_type === 'barcode' && obj.data_field) {
                    var barcodeValue = productData[obj.data_field] || productData['sku'] || 'N/A';
                    // Store barcode value for post-processing
                    obj._barcode_value = barcodeValue;
                    obj._barcode_format = obj.barcode_type || 'CODE128';
                }
            });

            // Load the design onto the canvas
            canvas.loadFromJSON(clonedData, function() {
                // Post-process: replace barcode placeholder text with actual barcodes
                var objectsToProcess = [];
                canvas.getObjects().forEach(function(obj) {
                    if (obj.element_type === 'barcode') {
                        objectsToProcess.push(obj);
                    }
                });

                if (objectsToProcess.length > 0) {
                    objectsToProcess.forEach(function(obj) {
                        replaceBarcodeElement(canvas, obj, productData);
                    });
                }

                canvas.renderAll();
            });
        }

        function replaceBarcodeElement(canvas, obj, productData) {
            var barcodeValue = '';
            if (obj.data_field && productData[obj.data_field]) {
                barcodeValue = productData[obj.data_field];
            } else {
                barcodeValue = productData['sku'] || productData['sub_sku'] || '0000';
            }

            var barcodeFormat = obj.barcode_type || 'CODE128';

            try {
                // Create an offscreen canvas for barcode generation
                var tempCanvas = document.createElement('canvas');
                JsBarcode(tempCanvas, barcodeValue, {
                    format: mapBarcodeFormat(barcodeFormat),
                    width: 2,
                    height: Math.max(30, obj.height ? obj.height * 0.6 : 40),
                    displayValue: true,
                    fontSize: 12,
                    margin: 2
                });

                var barcodeDataUrl = tempCanvas.toDataURL('image/png');

                // Create a Fabric image from the barcode
                fabric.Image.fromURL(barcodeDataUrl, function(img) {
                    img.set({
                        left: obj.left,
                        top: obj.top,
                        scaleX: (obj.width * (obj.scaleX || 1)) / img.width,
                        scaleY: (obj.height * (obj.scaleY || 1)) / img.height,
                        selectable: false
                    });

                    canvas.remove(obj);
                    canvas.add(img);
                    canvas.renderAll();
                });
            } catch (e) {
                // If barcode generation fails, leave the text as-is
                if (obj.text !== undefined) {
                    obj.set('text', barcodeValue);
                }
                canvas.renderAll();
            }
        }

        function mapBarcodeFormat(format) {
            var formatMap = {
                'C128': 'CODE128',
                'CODE128': 'CODE128',
                'C39': 'CODE39',
                'CODE39': 'CODE39',
                'EAN13': 'EAN13',
                'EAN8': 'EAN8',
                'UPC': 'UPC',
                'UPCA': 'UPC',
                'ITF14': 'ITF14',
                'MSI': 'MSI',
                'pharmacode': 'pharmacode'
            };
            return formatMap[format] || 'CODE128';
        }
    </script>
</body>
</html>
