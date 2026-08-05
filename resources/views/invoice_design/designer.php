
<?php $__env->startSection('title', __('invoice_design.invoice_designer') . ' - ' . $design->name); ?>

<?php $__env->startSection('css'); ?>
<style>
    .designer-wrapper {
        display: flex;
        gap: 0;
        height: calc(100vh - 120px);
        overflow: hidden;
        margin-bottom: -40px;
        position: relative;
        z-index: 10;
    }
    /* Left Panel */
    .designer-left-panel {
        width: 250px;
        min-width: 250px;
        background: #f8f9fa;
        border-right: 1px solid #dee2e6;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .designer-left-panel > .panel-section:last-child,
    .designer-left-panel > #header_fields_panel,
    .designer-left-panel > #detail_fields_panel,
    .designer-left-panel > #footer_fields_panel {
        flex: 1;
        overflow-y: auto;
        min-height: 0;
    }
    .panel-section { border-bottom: 1px solid #dee2e6; }
    .panel-section-title {
        background: #e9ecef;
        padding: 8px 12px;
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        color: #495057;
        margin: 0;
        cursor: pointer;
        user-select: none;
    }
    .panel-section-title i { margin-right: 5px; }
    .panel-section-body { padding: 8px; }

    .toolbox-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 5px;
    }
    .tool-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 8px 4px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background: #fff;
        cursor: pointer;
        font-size: 10px;
        color: #495057;
        transition: all 0.15s;
    }
    .tool-btn:hover { background: #e3f2fd; border-color: #2196F3; }
    .tool-btn i { font-size: 18px; margin-bottom: 3px; color: #2196F3; }

    /* Data field badges */
    .data-field-list { display: flex; flex-wrap: wrap; gap: 4px; }
    .data-field-badge {
        display: inline-block;
        padding: 3px 8px;
        font-size: 10px;
        background: #e8f5e9;
        border: 1px solid #a5d6a7;
        border-radius: 12px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.15s;
    }
    .data-field-badge:hover {
        background: #c8e6c9;
        border-color: #66bb6a;
    }
    .data-field-badge.detail-field { background: #fff3e0; border-color: #ffcc80; }
    .data-field-badge.detail-field:hover { background: #ffe0b2; border-color: #ffa726; }
    .data-field-badge.footer-field { background: #e3f2fd; border-color: #90caf9; }
    .data-field-badge.footer-field:hover { background: #bbdefb; border-color: #42a5f5; }

    /* Center Panel — Canvas Area */
    .designer-center-panel {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #e0e0e0;
    }
    .canvas-toolbar {
        display: flex;
        align-items: center;
        gap: 5px;
        padding: 6px 12px;
        background: #343a40;
        color: #fff;
        flex-wrap: wrap;
    }
    .canvas-toolbar .btn { padding: 3px 8px; font-size: 12px; }
    .canvas-toolbar .btn-dark { background: #495057; border-color: #495057; }
    .canvas-toolbar .divider {
        width: 1px;
        height: 24px;
        background: rgba(255,255,255,0.2);
        margin: 0 4px;
    }
    .canvas-area {
        flex: 1;
        overflow: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Section containers */
    .section-container {
        margin-bottom: 2px;
        position: relative;
    }
    .section-label-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #555;
        color: #fff;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
    }
    .section-label-bar.header-bar { background: #1565C0; }
    .section-label-bar.detail-bar { background: #e65100; }
    .section-label-bar.footer-bar { background: #2e7d32; }
    .section-label-bar .section-info {
        font-weight: normal;
        font-size: 10px;
        opacity: 0.8;
    }
    .section-canvas-wrap {
        border: 2px solid #999;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        position: relative;
    }
    .section-canvas-wrap.active-section {
        border-color: #2196F3;
        box-shadow: 0 0 0 2px rgba(33,150,243,0.3), 0 2px 8px rgba(0,0,0,0.15);
    }

    /* Right Panel — Properties */
    .designer-right-panel {
        width: 260px;
        min-width: 260px;
        background: #f8f9fa;
        border-left: 1px solid #dee2e6;
        overflow-y: auto;
    }
    .prop-group { padding: 8px 10px; border-bottom: 1px solid #e9ecef; }
    .prop-group-title {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        color: #6c757d;
        margin-bottom: 6px;
    }
    .prop-row {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    .prop-row label {
        width: 70px;
        font-size: 11px;
        margin: 0;
        color: #495057;
        flex-shrink: 0;
    }
    .prop-row input, .prop-row select {
        flex: 1;
        min-width: 0;
        font-size: 12px;
        padding: 3px 6px;
        border: 1px solid #ced4da;
        border-radius: 3px;
    }
    .prop-row input[type="color"] { padding: 1px 3px; height: 28px; }
    .prop-row input[type="number"] { width: 65px; }

    /* Section height dragger */
    .section-resize-handle {
        height: 6px;
        background: repeating-linear-gradient(90deg, #ccc, #ccc 4px, transparent 4px, transparent 8px);
        cursor: ns-resize;
        opacity: 0.6;
    }
    .section-resize-handle:hover { opacity: 1; background-color: #2196F3; }

    /* Active section indicator in left panel */
    .section-tab { cursor: pointer; padding: 6px 10px; border-bottom: 1px solid #dee2e6; }
    .section-tab.active { background: #d1ecf1; border-left: 3px solid #0dcaf0; }
    .section-tab .badge { font-size: 9px; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header" style="padding: 5px 15px;">
    <div class="d-flex justify-content-between align-items-center">
        <h1 style="font-size: 18px; margin: 0;">
            <i class="fa fa-file-text-o"></i> <?php echo e($design->name, false); ?>

            <small class="text-muted">
                (<?php echo e($design->paper_type == 'thermal_80' ? '80mm Thermal' : ($design->paper_type == 'thermal_58' ? '58mm Thermal' : strtoupper($design->paper_type)), false); ?>)
            </small>
        </h1>
        <div>
            <a href="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'index']), false); ?>" class="btn btn-sm btn-secondary">
                <i class="fa fa-arrow-left"></i> <?php echo app('translator')->get('messages.go_back'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Hidden inputs for design data -->
<input type="hidden" id="design_id" value="<?php echo e($design->id, false); ?>">
<input type="hidden" id="paper_type" value="<?php echo e($design->paper_type, false); ?>">
<input type="hidden" id="paper_width" value="<?php echo e($design->paper_width, false); ?>">
<input type="hidden" id="paper_height" value="<?php echo e($design->paper_height ?? 0, false); ?>">
<input type="hidden" id="is_continuous" value="<?php echo e($design->is_continuous ? 1 : 0, false); ?>">
<input type="hidden" id="header_height" value="<?php echo e($design->header_height, false); ?>">
<input type="hidden" id="detail_row_height" value="<?php echo e($design->detail_row_height, false); ?>">
<input type="hidden" id="footer_height" value="<?php echo e($design->footer_height, false); ?>">
<input type="hidden" id="header_design" value='<?php echo json_encode($design->header_design, 15, 512) ?>'>
<input type="hidden" id="detail_design" value='<?php echo json_encode($design->detail_design, 15, 512) ?>'>
<input type="hidden" id="footer_design" value='<?php echo json_encode($design->footer_design, 15, 512) ?>'>
<input type="hidden" id="save_url" value="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'saveDesign'], [$design->id]), false); ?>">
<input type="hidden" id="sample_data_url" value="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'getSampleData']), false); ?>">
<input type="hidden" id="preview_url" value="<?php echo e(action([\App\Http\Controllers\InvoiceDesignController::class, 'printPreview'], [$design->id]), false); ?>">

<div class="designer-wrapper">
    
    <div class="designer-left-panel">
        
        <div class="panel-section">
            <div class="panel-section-title">
                <i class="fa fa-layer-group"></i> Active Section
            </div>
            <div class="section-tab active" data-section="header">
                <i class="fa fa-arrow-up text-primary"></i> <strong>Header</strong>
                <span class="badge bg-primary section-info-badge"><?php echo e($design->header_height, false); ?>mm</span>
            </div>
            <div class="section-tab" data-section="detail">
                <i class="fa fa-list text-warning"></i> <strong>Detail Row</strong>
                <span class="badge bg-warning section-info-badge"><?php echo e($design->detail_row_height, false); ?>mm</span>
            </div>
            <div class="section-tab" data-section="footer">
                <i class="fa fa-arrow-down text-success"></i> <strong>Footer</strong>
                <span class="badge bg-success section-info-badge"><?php echo e($design->footer_height, false); ?>mm</span>
            </div>
        </div>

        
        <div class="panel-section">
            <div class="panel-section-title"><i class="fa fa-th"></i> <?php echo app('translator')->get('label_design.toolbox'); ?></div>
            <div class="panel-section-body">
                <div class="toolbox-grid">
                    <div class="tool-btn" data-tool="text" title="Add static text">
                        <i class="fa fa-font"></i>Text
                    </div>
                    <div class="tool-btn" data-tool="data_field" title="Add data field">
                        <i class="fa fa-database"></i>Data Field
                    </div>
                    <div class="tool-btn" data-tool="line" title="Add line">
                        <i class="fa fa-minus"></i>Line
                    </div>
                    <div class="tool-btn" data-tool="rectangle" title="Add rectangle">
                        <i class="fa fa-square-o"></i>Rectangle
                    </div>
                    <div class="tool-btn" data-tool="image" title="Add image / logo">
                        <i class="fa fa-image"></i>Image
                    </div>
                    <div class="tool-btn" data-tool="barcode" title="Add barcode">
                        <i class="fa fa-barcode"></i>Barcode
                    </div>
                    <div class="tool-btn" data-tool="table_header" title="Add table header row">
                        <i class="fa fa-columns"></i>Table Hdr
                    </div>
                    <div class="tool-btn" data-tool="horizontal_line" title="Add horizontal divider">
                        <i class="fa fa-ellipsis-h"></i>Divider
                    </div>
                </div>
            </div>
        </div>

        
        <div class="panel-section" id="header_fields_panel">
            <div class="panel-section-title" style="background: #1565C0; color: #fff;">
                <i class="fa fa-arrow-up"></i> Header Fields
            </div>
            <div class="panel-section-body">
                <div class="data-field-list">
                    <?php $__currentLoopData = $header_data_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="data-field-badge" data-field="<?php echo e($field_key, false); ?>" data-section="header" title="<?php echo e($field_label, false); ?>"><?php echo e($field_label, false); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="panel-section" id="detail_fields_panel" style="display:none;">
            <div class="panel-section-title" style="background: #e65100; color: #fff;">
                <i class="fa fa-list"></i> Detail Row Fields
            </div>
            <div class="panel-section-body">
                <div class="data-field-list">
                    <?php $__currentLoopData = $detail_data_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="data-field-badge detail-field" data-field="<?php echo e($field_key, false); ?>" data-section="detail" title="<?php echo e($field_label, false); ?>"><?php echo e($field_label, false); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <div class="panel-section" id="footer_fields_panel" style="display:none;">
            <div class="panel-section-title" style="background: #2e7d32; color: #fff;">
                <i class="fa fa-arrow-down"></i> Footer Fields
            </div>
            <div class="panel-section-body">
                <div class="data-field-list">
                    <?php $__currentLoopData = $footer_data_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="data-field-badge footer-field" data-field="<?php echo e($field_key, false); ?>" data-section="footer" title="<?php echo e($field_label, false); ?>"><?php echo e($field_label, false); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    
    <div class="designer-center-panel">
        
        <div class="canvas-toolbar">
            <button class="btn btn-sm btn-outline-light" id="btn_save" title="Save (Ctrl+S)">
                <i class="fa fa-save"></i> Save
            </button>
            <div class="divider"></div>
            <button class="btn btn-sm btn-dark" id="btn_undo" title="Undo (Ctrl+Z)"><i class="fa fa-undo"></i></button>
            <button class="btn btn-sm btn-dark" id="btn_redo" title="Redo (Ctrl+Y)"><i class="fa fa-repeat"></i></button>
            <div class="divider"></div>
            <button class="btn btn-sm btn-dark" id="btn_delete" title="Delete (Del)"><i class="fa fa-trash"></i></button>
            <button class="btn btn-sm btn-dark" id="btn_duplicate" title="Duplicate (Ctrl+D)"><i class="fa fa-copy"></i></button>
            <div class="divider"></div>
            <button class="btn btn-sm btn-dark" id="btn_align_left" title="Align Left"><i class="fa fa-align-left"></i></button>
            <button class="btn btn-sm btn-dark" id="btn_align_center" title="Align Center"><i class="fa fa-align-center"></i></button>
            <button class="btn btn-sm btn-dark" id="btn_align_right" title="Align Right"><i class="fa fa-align-right"></i></button>
            <div class="divider"></div>
            <button class="btn btn-sm btn-dark" id="btn_bring_front" title="Bring to Front"><i class="fa fa-arrow-up"></i></button>
            <button class="btn btn-sm btn-dark" id="btn_send_back" title="Send to Back"><i class="fa fa-arrow-down"></i></button>
            <div class="divider"></div>
            <span class="text-light" style="font-size:11px;">
                Zoom: <span id="zoom_level">100</span>%
            </span>
            <button class="btn btn-sm btn-dark" id="btn_zoom_in">+</button>
            <button class="btn btn-sm btn-dark" id="btn_zoom_out">−</button>
            <button class="btn btn-sm btn-dark" id="btn_zoom_fit">Fit</button>
            <div class="divider"></div>
            <button class="btn btn-sm btn-outline-warning" id="btn_preview" title="Preview with sample data">
                <i class="fa fa-eye"></i> Preview
            </button>
        </div>

        
        <div class="canvas-area" id="canvas_scroll_area">
            
            <div class="section-container" id="section_header">
                <div class="section-label-bar header-bar" data-section="header">
                    <span><i class="fa fa-arrow-up"></i> HEADER</span>
                    <span class="section-info" id="header_height_label"><?php echo e($design->header_height, false); ?>mm</span>
                </div>
                <div class="section-canvas-wrap active-section" id="header_canvas_wrap">
                    <canvas id="header_canvas"></canvas>
                </div>
                <div class="section-resize-handle" data-section="header" title="Drag to resize header"></div>
            </div>

            
            <div class="section-container" id="section_detail">
                <div class="section-label-bar detail-bar" data-section="detail">
                    <span><i class="fa fa-list"></i> DETAIL ROW (repeats per product)</span>
                    <span class="section-info" id="detail_height_label"><?php echo e($design->detail_row_height, false); ?>mm</span>
                </div>
                <div class="section-canvas-wrap" id="detail_canvas_wrap">
                    <canvas id="detail_canvas"></canvas>
                </div>
                <div class="section-resize-handle" data-section="detail" title="Drag to resize detail row"></div>
            </div>

            
            <div class="section-container" id="section_footer">
                <div class="section-label-bar footer-bar" data-section="footer">
                    <span><i class="fa fa-arrow-down"></i> FOOTER</span>
                    <span class="section-info" id="footer_height_label"><?php echo e($design->footer_height, false); ?>mm</span>
                </div>
                <div class="section-canvas-wrap" id="footer_canvas_wrap">
                    <canvas id="footer_canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

    
    <div class="designer-right-panel">
        <div class="prop-group" id="no_selection_msg">
            <p class="text-muted text-center" style="font-size: 12px; margin: 20px 0;">
                <i class="fa fa-mouse-pointer" style="font-size:24px;"></i><br/>
                Select an element to edit its properties
            </p>
        </div>

        <div id="properties_panel" style="display:none;">
            
            <div class="prop-group">
                <div class="prop-group-title">Element</div>
                <div class="prop-row">
                    <label>Type</label>
                    <span id="prop_type" style="font-size:12px; font-weight:600;"></span>
                </div>
                <div class="prop-row" id="prop_data_field_row" style="display:none;">
                    <label>Field</label>
                    <select id="prop_data_field" class="form-control form-control-sm"></select>
                </div>
            </div>

            
            <div class="prop-group">
                <div class="prop-group-title">Position & Size</div>
                <div class="prop-row">
                    <label>X</label>
                    <input type="number" id="prop_left" step="0.5">
                    <label style="width:30px; text-align:center;">Y</label>
                    <input type="number" id="prop_top" step="0.5">
                </div>
                <div class="prop-row">
                    <label>W</label>
                    <input type="number" id="prop_width" step="0.5" min="1">
                    <label style="width:30px; text-align:center;">H</label>
                    <input type="number" id="prop_height" step="0.5" min="1">
                </div>
            </div>

            
            <div class="prop-group" id="text_props" style="display:none;">
                <div class="prop-group-title">Text</div>
                <div class="prop-row">
                    <label>Content</label>
                    <input type="text" id="prop_text">
                </div>
                <div class="prop-row">
                    <label>Font</label>
                    <select id="prop_fontFamily">
                        <option value="Arial">Arial</option>
                        <option value="Helvetica">Helvetica</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Courier New">Courier New</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Roboto">Roboto</option>
                        <option value="Calibri">Calibri</option>
                    </select>
                </div>
                <div class="prop-row">
                    <label>Size</label>
                    <input type="number" id="prop_fontSize" min="4" max="72" step="1">
                    <label style="width:40px; text-align:center;">Bold</label>
                    <input type="checkbox" id="prop_bold" style="width:auto;">
                </div>
                <div class="prop-row">
                    <label>Color</label>
                    <input type="color" id="prop_fill" value="#000000">
                    <label style="width:40px; text-align:center;">Italic</label>
                    <input type="checkbox" id="prop_italic" style="width:auto;">
                </div>
                <div class="prop-row">
                    <label>Align</label>
                    <select id="prop_textAlign">
                        <option value="left">Left</option>
                        <option value="center">Center</option>
                        <option value="right">Right</option>
                    </select>
                </div>
            </div>

            
            <div class="prop-group" id="shape_props" style="display:none;">
                <div class="prop-group-title">Appearance</div>
                <div class="prop-row">
                    <label>Fill</label>
                    <input type="color" id="prop_shape_fill" value="#ffffff">
                </div>
                <div class="prop-row">
                    <label>Stroke</label>
                    <input type="color" id="prop_stroke" value="#000000">
                    <label style="width:40px; text-align:center;">Width</label>
                    <input type="number" id="prop_strokeWidth" min="0" max="10" step="0.5" style="width:50px;">
                </div>
            </div>

            
            <div class="prop-group" id="barcode_props" style="display:none;">
                <div class="prop-group-title">Barcode</div>
                <div class="prop-row">
                    <label>Format</label>
                    <select id="prop_barcode_type">
                        <option value="CODE128">CODE128</option>
                        <option value="CODE39">CODE39</option>
                        <option value="EAN13">EAN13</option>
                        <option value="EAN8">EAN8</option>
                        <option value="UPC">UPC</option>
                        <option value="QR">QR Code</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="image_upload_modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('label_design.upload_image'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Select Image File</label>
                    <input type="file" class="form-control" id="image_file_input" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Or paste Image URL</label>
                    <input type="text" class="form-control" id="image_url_input" placeholder="https://...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
                <button type="button" class="btn btn-primary" id="btn_add_image"><?php echo app('translator')->get('label_design.add_image'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
<script src="<?php echo e(asset('js/invoice_designer.js?v=' . $asset_v), false); ?>"></script>
<script>
    // Append modals to body to avoid z-index issues
    $(function() { $('#image_upload_modal').appendTo('body'); });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>