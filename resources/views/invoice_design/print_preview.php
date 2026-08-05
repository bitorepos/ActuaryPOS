<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Preview</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #e0e0e0; font-family: Arial, sans-serif; }
        .no-print { text-align: center; padding: 12px; background: #343a40; color: #fff; }
        .no-print button { padding: 8px 24px; font-size: 14px; cursor: pointer; background: #28a745; color: #fff; border: none; border-radius: 4px; margin: 0 5px; }
        .no-print button:hover { background: #218838; }
        .no-print .info { color: #adb5bd; font-size: 13px; margin-left: 15px; }
        .invoice-page {
            background: #fff;
            margin: 20px auto;
            box-shadow: 0 2px 12px rgba(0,0,0,0.2);
            overflow: hidden;
            position: relative;
        }
        .invoice-page canvas { display: block; }
        .section-separator { border: none; border-top: 1px dashed #ccc; margin: 0; }
        @media print {
            body { background: #fff; margin: 0; }
            .no-print { display: none !important; }
            .invoice-page { box-shadow: none; margin: 0; }
            @page { margin: 0; size: auto; }
            html, body { height: auto !important; min-height: 0 !important; overflow: visible !important; }
            *, :after, :before { background-color: #fff !important; }
        }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">🖨️ Print</button>
        <span class="info">
            <?php echo e($design->name, false); ?> |
            <?php echo e($design->paper_type == 'thermal_80' ? '80mm Thermal' : ($design->paper_type == 'thermal_58' ? '58mm Thermal' : strtoupper($design->paper_type)), false); ?>

            <?php if($design->is_continuous): ?> (Continuous Roll) <?php endif; ?>
            | <?php echo e(count($detail_data), false); ?> product line(s)
        </span>
    </div>

    <?php
        $mmToPx = 96 / 25.4;
        $pageWidthPx = $design->paper_width * $mmToPx;
        $headerHeightPx = $design->header_height * $mmToPx;
        $detailRowHeightPx = $design->detail_row_height * $mmToPx;
        $footerHeightPx = $design->footer_height * $mmToPx;
        $totalDetailHeight = count($detail_data) * $detailRowHeightPx;
        $totalPageHeight = $headerHeightPx + $totalDetailHeight + $footerHeightPx;

        // For fixed page sizes, calculate if content fits or needs page breaks
        if (!$design->is_continuous && $design->paper_height) {
            $pageHeightPx = $design->paper_height * $mmToPx;
        } else {
            $pageHeightPx = $totalPageHeight; // continuous: page height = content height
        }
    ?>

    <div class="invoice-page" style="width: <?php echo e($pageWidthPx, false); ?>px;">
        
        <canvas id="header_canvas" width="<?php echo e($pageWidthPx, false); ?>" height="<?php echo e($headerHeightPx, false); ?>"></canvas>

        
        <?php $__currentLoopData = $detail_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <canvas id="detail_canvas_<?php echo e($idx, false); ?>" width="<?php echo e($pageWidthPx, false); ?>" height="<?php echo e($detailRowHeightPx, false); ?>"></canvas>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <canvas id="footer_canvas" width="<?php echo e($pageWidthPx, false); ?>" height="<?php echo e($footerHeightPx, false); ?>"></canvas>
    </div>

    <script>
        var MM_TO_PX = 96 / 25.4;
        var headerDesign = <?php echo json_encode($design->header_design, 15, 512) ?>;
        var detailDesign = <?php echo json_encode($design->detail_design, 15, 512) ?>;
        var footerDesign = <?php echo json_encode($design->footer_design, 15, 512) ?>;
        var headerData = <?php echo json_encode($header_data, 15, 512) ?>;
        var detailData = <?php echo json_encode($detail_data, 15, 512) ?>;
        var footerData = <?php echo json_encode($footer_data, 15, 512) ?>;
        var paperWidthPx = <?php echo e($pageWidthPx, false); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            renderSection('header_canvas', headerDesign, headerData, <?php echo e($headerHeightPx, false); ?>);

            detailData.forEach(function(row, idx) {
                renderSection('detail_canvas_' + idx, detailDesign, row, <?php echo e($detailRowHeightPx, false); ?>);
            });

            renderSection('footer_canvas', footerDesign, footerData, <?php echo e($footerHeightPx, false); ?>);
        });

        function renderSection(canvasId, designData, data, height) {
            var canvas = new fabric.StaticCanvas(canvasId, {
                width: paperWidthPx,
                height: height,
                backgroundColor: '#ffffff'
            });

            if (!designData || !designData.objects || designData.objects.length === 0) {
                canvas.renderAll();
                return;
            }

            var cloned = JSON.parse(JSON.stringify(designData));

            // Replace data field placeholders with actual data
            cloned.objects.forEach(function(obj) {
                if (obj.data_field && data[obj.data_field] !== undefined) {
                    if (obj.text !== undefined) {
                        obj.text = String(data[obj.data_field] || '');
                    }
                }

                // Also replace placeholder patterns in static text
                if (obj.text !== undefined && !obj.data_field) {
                    obj.text = obj.text.replace(/\{\{(\w+)\}\}/g, function(match, key) {
                        return data[key] !== undefined ? String(data[key]) : match;
                    });
                }

                if (obj.element_type === 'barcode' && obj.data_field) {
                    obj._barcode_value = data[obj.data_field] || data['barcode'] || '0000';
                    obj._barcode_format = obj.barcode_type || 'CODE128';
                }
            });

            canvas.loadFromJSON(cloned, function() {
                // Post-process barcodes
                canvas.getObjects().forEach(function(obj) {
                    if (obj.element_type === 'barcode') {
                        replaceBarcodeElement(canvas, obj, data);
                    }
                });
                canvas.renderAll();
            });
        }

        function replaceBarcodeElement(canvas, obj, data) {
            var value = '';
            if (obj.data_field && data[obj.data_field]) {
                value = data[obj.data_field];
            } else {
                value = data['barcode'] || data['sku'] || '0000';
            }

            var format = obj.barcode_type || 'CODE128';

            // QR Code handling
            if (format === 'QR') {
                // For QR, just leave as text for now
                if (obj.text !== undefined) obj.set('text', value);
                canvas.renderAll();
                return;
            }

            try {
                var tempCanvas = document.createElement('canvas');
                JsBarcode(tempCanvas, value, {
                    format: mapFormat(format),
                    width: 2,
                    height: Math.max(25, (obj.height || 30) * 0.6),
                    displayValue: true,
                    fontSize: 10,
                    margin: 2
                });

                var dataUrl = tempCanvas.toDataURL('image/png');
                fabric.Image.fromURL(dataUrl, function(img) {
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
                if (obj.text !== undefined) obj.set('text', value);
                canvas.renderAll();
            }
        }

        function mapFormat(f) {
            var map = { 'C128': 'CODE128', 'CODE128': 'CODE128', 'C39': 'CODE39', 'CODE39': 'CODE39', 'EAN13': 'EAN13', 'EAN8': 'EAN8', 'UPC': 'UPC', 'UPCA': 'UPC' };
            return map[f] || 'CODE128';
        }
    </script>
</body>
</html>
