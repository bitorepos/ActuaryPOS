<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($design->name, false); ?> — Print Preview</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .label-container {
            background: #fff;
            border: 1px dashed #ccc;
            display: inline-block;
            margin: 10px;
            position: relative;
            overflow: hidden;
        }
        @media print {
            body { margin: 0; padding: 0; background: #fff; }
            .label-container { border: none; margin: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 15px;">
        <button onclick="window.print()" style="padding: 8px 20px; font-size: 14px; cursor: pointer;">
            🖨️ Print
        </button>
        <button onclick="window.close()" style="padding: 8px 20px; font-size: 14px; cursor: pointer; margin-left: 10px;">
            ✕ Close
        </button>
    </div>

    <?php
        $mmToPx = 96 / 25.4; // mm to pixel conversion
        $widthPx = round($design->width * $mmToPx);
        $heightPx = round($design->height * $mmToPx);
        $designData = $design->design_data;
    ?>

    <div class="label-container" style="width: <?php echo e($widthPx, false); ?>px; height: <?php echo e($heightPx, false); ?>px;">
        <canvas id="printCanvas" width="<?php echo e($widthPx, false); ?>" height="<?php echo e($heightPx, false); ?>"></canvas>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
    <script>
        var designData = <?php echo json_encode($designData, 15, 512) ?>;
        var productData = <?php echo json_encode($product_data, 15, 512) ?>;

        var canvas = new fabric.StaticCanvas('printCanvas', {
            width: <?php echo e($widthPx, false); ?>,
            height: <?php echo e($heightPx, false); ?>,
            backgroundColor: '#ffffff'
        });

        if (designData && designData.objects) {
            canvas.loadFromJSON(designData, function() {
                // Replace data fields with actual product data
                canvas.getObjects().forEach(function(obj) {
                    if (obj.dataField && productData[obj.dataField]) {
                        if (typeof obj.text !== 'undefined') {
                            obj.set('text', productData[obj.dataField]);
                        }
                    }
                });
                canvas.renderAll();
            });
        }
    </script>
</body>
</html>
