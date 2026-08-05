
<?php $__env->startSection('title', __('label_design.label_designer') . ' - ' . $design->name); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* Designer Layout */
    .designer-wrapper {
        display: flex;
        gap: 0;
        height: calc(100vh - 120px);
        overflow: hidden;
    }

    /* Left Panel — Toolbox & Element Tree */
    .designer-left-panel {
        width: 250px;
        min-width: 250px;
        background: #f8f9fa;
        border-right: 1px solid #dee2e6;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }
    .panel-section {
        border-bottom: 1px solid #dee2e6;
    }
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
    .panel-section-body {
        padding: 8px;
    }

    /* Toolbox Buttons */
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
    .tool-btn:hover {
        background: #e2e6ea;
        border-color: #adb5bd;
    }
    .tool-btn i {
        font-size: 18px;
        margin-bottom: 3px;
    }

    /* Element Tree */
    .element-tree {
        list-style: none;
        padding: 0;
        margin: 0;
        font-size: 12px;
        overflow-y: auto;
        max-height: 200px;
    }
    .element-tree li {
        padding: 5px 10px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        border-bottom: 1px solid #f0f0f0;
    }
    .element-tree li:hover { background: #e9ecef; }
    .element-tree li.active { background: #cce5ff; font-weight: 600; }
    .element-tree li i { font-size: 12px; color: #6c757d; }

    /* Center — Canvas Area */
    .designer-canvas-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #6c757d;
        overflow: auto;
        position: relative;
    }
    .canvas-toolbar {
        background: #343a40;
        padding: 6px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }
    .canvas-toolbar .btn { font-size: 12px; padding: 3px 8px; }
    .canvas-toolbar .separator { width: 1px; height: 24px; background: #555; }
    .canvas-toolbar select, .canvas-toolbar input {
        font-size: 12px;
        padding: 2px 6px;
        border-radius: 3px;
        border: 1px solid #555;
        background: #495057;
        color: #fff;
    }
    .zoom-display {
        color: #adb5bd;
        font-size: 12px;
        min-width: 50px;
        text-align: center;
    }

    .canvas-scroll-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow: auto;
    }
    .canvas-wrapper {
        background: #fff;
        box-shadow: 0 2px 20px rgba(0,0,0,0.3);
        position: relative;
    }

    /* Right Panel — Properties */
    .designer-right-panel {
        width: 280px;
        min-width: 280px;
        background: #f8f9fa;
        border-left: 1px solid #dee2e6;
        overflow-y: auto;
        font-size: 12px;
    }
    .props-group {
        padding: 8px 12px;
        border-bottom: 1px solid #e9ecef;
    }
    .props-group-title {
        font-weight: 600;
        font-size: 11px;
        text-transform: uppercase;
        color: #6c757d;
        margin-bottom: 6px;
    }
    .props-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 5px;
    }
    .props-row label {
        width: 60px;
        font-size: 11px;
        color: #495057;
        margin: 0;
        flex-shrink: 0;
    }
    .props-row input, .props-row select {
        flex: 1;
        font-size: 11px;
        padding: 3px 6px;
        border: 1px solid #ced4da;
        border-radius: 3px;
    }
    .props-row input[type="color"] {
        width: 30px;
        height: 24px;
        padding: 1px;
        flex: none;
    }
    .props-row input[type="checkbox"] {
        flex: none;
        width: auto;
    }

    /* Status bar */
    .designer-statusbar {
        background: #343a40;
        color: #adb5bd;
        font-size: 11px;
        padding: 3px 12px;
        display: flex;
        justify-content: space-between;
    }

    /* No selection state */
    .no-selection-msg {
        padding: 20px 12px;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }

    /* Ruler-like border on canvas */
    .canvas-wrapper { border: 1px solid #999; }

    /* Data field badge */
    .data-field-badge {
        display: inline-block;
        padding: 2px 6px;
        background: #e2e6ea;
        border-radius: 3px;
        margin: 2px;
        cursor: pointer;
        font-size: 11px;
    }
    .data-field-badge:hover { background: #cce5ff; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header" style="padding: 5px 15px;">
    <div class="d-flex justify-content-between align-items-center">
        <h4 style="margin:0;">
            <i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('label_design.label_designer'); ?>: <strong><?php echo e($design->name, false); ?></strong>
            <small class="text-muted">(<?php echo e($design->width, false); ?>" × <?php echo e($design->height, false); ?>")</small>
        </h4>
        <div>
            <button type="button" class="btn btn-success btn-sm" id="btn_save_design">
                <i class="fa fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
            </button>
            <button type="button" class="btn btn-info btn-sm" id="btn_preview_design">
                <i class="fa fa-eye"></i> <?php echo app('translator')->get('barcode.preview'); ?>
            </button>
            <a href="<?php echo e(action([\App\Http\Controllers\LabelDesignController::class, 'index']), false); ?>" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i> <?php echo app('translator')->get('messages.back'); ?>
            </a>
        </div>
    </div>
</section>

<div class="designer-wrapper">
    <!-- LEFT PANEL: Toolbox + Element Tree -->
    <div class="designer-left-panel">
        <!-- Toolbox -->
        <div class="panel-section">
            <div class="panel-section-title"><i class="fa fa-wrench"></i> <?php echo app('translator')->get('label_design.toolbox'); ?></div>
            <div class="panel-section-body">
                <div class="toolbox-grid">
                    <div class="tool-btn" data-tool="text" title="Add Text">
                        <i class="fa fa-font"></i>
                        <span><?php echo app('translator')->get('label_design.text'); ?></span>
                    </div>
                    <div class="tool-btn" data-tool="datafield" title="Add Data Field">
                        <i class="fa fa-database"></i>
                        <span><?php echo app('translator')->get('label_design.data_field'); ?></span>
                    </div>
                    <div class="tool-btn" data-tool="barcode" title="Add Barcode">
                        <i class="fa fa-barcode"></i>
                        <span><?php echo app('translator')->get('barcode.barcode'); ?></span>
                    </div>
                    <div class="tool-btn" data-tool="image" title="Add Image">
                        <i class="fa fa-image"></i>
                        <span><?php echo app('translator')->get('label_design.image'); ?></span>
                    </div>
                    <div class="tool-btn" data-tool="line" title="Add Line">
                        <i class="fa fa-minus"></i>
                        <span><?php echo app('translator')->get('label_design.line'); ?></span>
                    </div>
                    <div class="tool-btn" data-tool="rectangle" title="Add Rectangle">
                        <i class="fa fa-square-o"></i>
                        <span><?php echo app('translator')->get('label_design.rectangle'); ?></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Fields -->
        <div class="panel-section">
            <div class="panel-section-title"><i class="fa fa-database"></i> <?php echo app('translator')->get('label_design.data_fields'); ?></div>
            <div class="panel-section-body" style="max-height: 200px; overflow-y: auto;">
                <?php $__currentLoopData = $data_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="data-field-badge" data-field="<?php echo e($field_key, false); ?>" title="<?php echo app('translator')->get('label_design.click_to_add'); ?> <?php echo e($field_label, false); ?>">
                        <i class="fa fa-plus-circle"></i> <?php echo e($field_label, false); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Element Tree -->
        <div class="panel-section" style="flex:1; display:flex; flex-direction:column; overflow:hidden;">
            <div class="panel-section-title"><i class="fa fa-sitemap"></i> <?php echo app('translator')->get('label_design.element_tree'); ?></div>
            <ul class="element-tree" id="element_tree">
                <li class="text-muted" style="font-style: italic; justify-content: center;">
                    <?php echo app('translator')->get('label_design.no_elements'); ?>
                </li>
            </ul>
        </div>
    </div>

    <!-- CENTER — Canvas -->
    <div class="designer-canvas-area">
        <div class="canvas-toolbar">
            <button class="btn btn-outline-light btn-sm" id="btn_zoom_in" title="Zoom In"><i class="fa fa-search-plus"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_zoom_out" title="Zoom Out"><i class="fa fa-search-minus"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_zoom_fit" title="Zoom to Fit"><i class="fa fa-expand"></i></button>
            <span class="zoom-display" id="zoom_display">100%</span>
            <div class="separator"></div>
            <button class="btn btn-outline-light btn-sm" id="btn_undo" title="Undo (Ctrl+Z)"><i class="fa fa-undo"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_redo" title="Redo (Ctrl+Y)"><i class="fa fa-repeat"></i></button>
            <div class="separator"></div>
            <button class="btn btn-outline-light btn-sm" id="btn_delete" title="Delete Selected (Del)"><i class="fa fa-trash"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_duplicate" title="Duplicate (Ctrl+D)"><i class="fa fa-clone"></i></button>
            <div class="separator"></div>
            <button class="btn btn-outline-light btn-sm" id="btn_align_left" title="Align Left"><i class="fa fa-align-left"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_align_center" title="Align Center"><i class="fa fa-align-center"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_align_right" title="Align Right"><i class="fa fa-align-right"></i></button>
            <div class="separator"></div>
            <button class="btn btn-outline-light btn-sm" id="btn_bring_front" title="Bring to Front"><i class="fa fa-arrow-up"></i></button>
            <button class="btn btn-outline-light btn-sm" id="btn_send_back" title="Send to Back"><i class="fa fa-arrow-down"></i></button>
            <div class="separator"></div>
            <button class="btn btn-outline-warning btn-sm" id="btn_clear_all" title="Clear All"><i class="fa fa-eraser"></i></button>
        </div>

        <div class="canvas-scroll-container">
            <div class="canvas-wrapper" id="canvas_wrapper">
                <canvas id="label_canvas"></canvas>
            </div>
        </div>
    </div>

    <!-- RIGHT PANEL: Properties -->
    <div class="designer-right-panel" id="properties_panel">
        <div class="panel-section-title" style="background:#e9ecef; border-bottom:1px solid #dee2e6;">
            <i class="fa fa-cog"></i> <?php echo app('translator')->get('label_design.properties'); ?>
        </div>

        <!-- No Selection -->
        <div id="no_selection" class="no-selection-msg">
            <?php echo app('translator')->get('label_design.select_element_to_edit'); ?>
        </div>

        <!-- Properties Form (hidden by default) -->
        <div id="props_form" style="display:none;">
            <!-- Identity -->
            <div class="props-group">
                <div class="props-group-title"><?php echo app('translator')->get('label_design.identity'); ?></div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.type'); ?></label>
                    <input type="text" id="prop_type" readonly class="form-control-plaintext" style="background: #f0f0f0;">
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.name_label'); ?></label>
                    <input type="text" id="prop_name" placeholder="Element name">
                </div>
            </div>

            <!-- Position & Size -->
            <div class="props-group">
                <div class="props-group-title"><?php echo app('translator')->get('label_design.position_size'); ?></div>
                <div class="props-row">
                    <label>X</label>
                    <input type="number" id="prop_left" step="0.1">
                    <label>Y</label>
                    <input type="number" id="prop_top" step="0.1">
                </div>
                <div class="props-row">
                    <label>W</label>
                    <input type="number" id="prop_width" step="0.1" min="1">
                    <label>H</label>
                    <input type="number" id="prop_height" step="0.1" min="1">
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.angle'); ?></label>
                    <input type="number" id="prop_angle" step="1" min="-360" max="360">
                </div>
            </div>

            <!-- Appearance -->
            <div class="props-group">
                <div class="props-group-title"><?php echo app('translator')->get('label_design.appearance'); ?></div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.fill'); ?></label>
                    <input type="color" id="prop_fill" value="#000000">
                    <input type="text" id="prop_fill_text" size="7" value="#000000">
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.stroke'); ?></label>
                    <input type="color" id="prop_stroke" value="#000000">
                    <input type="number" id="prop_stroke_width" min="0" max="10" step="0.5" style="width:50px;">
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.opacity'); ?></label>
                    <input type="range" id="prop_opacity" min="0" max="1" step="0.05" style="flex:1;">
                    <span id="prop_opacity_val">1</span>
                </div>
            </div>

            <!-- Text Properties (shown for text elements only) -->
            <div class="props-group" id="text_props" style="display:none;">
                <div class="props-group-title"><?php echo app('translator')->get('label_design.text_properties'); ?></div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.font'); ?></label>
                    <select id="prop_font_family">
                        <option value="Arial">Arial</option>
                        <option value="Arial Black">Arial Black</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Tahoma">Tahoma</option>
                        <option value="Trebuchet MS">Trebuchet MS</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier New">Courier New</option>
                        <option value="Roboto">Roboto</option>
                    </select>
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.size'); ?></label>
                    <input type="number" id="prop_font_size" min="4" max="200" step="1">
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.style'); ?></label>
                    <button type="button" class="btn btn-xs btn-outline-secondary" id="prop_bold" title="Bold"><i class="fa fa-bold"></i></button>
                    <button type="button" class="btn btn-xs btn-outline-secondary" id="prop_italic" title="Italic"><i class="fa fa-italic"></i></button>
                    <button type="button" class="btn btn-xs btn-outline-secondary" id="prop_underline" title="Underline"><i class="fa fa-underline"></i></button>
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.align'); ?></label>
                    <button type="button" class="btn btn-xs btn-outline-secondary text-align-btn" data-align="left"><i class="fa fa-align-left"></i></button>
                    <button type="button" class="btn btn-xs btn-outline-secondary text-align-btn" data-align="center"><i class="fa fa-align-center"></i></button>
                    <button type="button" class="btn btn-xs btn-outline-secondary text-align-btn" data-align="right"><i class="fa fa-align-right"></i></button>
                </div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.text_val'); ?></label>
                    <textarea id="prop_text" rows="2" style="flex:1; font-size:11px; border:1px solid #ced4da; border-radius:3px; padding:3px;"></textarea>
                </div>
            </div>

            <!-- Data Binding (shown for data-bound elements) -->
            <div class="props-group" id="data_binding_props" style="display:none;">
                <div class="props-group-title"><i class="fa fa-database"></i> <?php echo app('translator')->get('label_design.data_binding'); ?></div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.field'); ?></label>
                    <select id="prop_data_field">
                        <option value="">-- <?php echo app('translator')->get('label_design.none'); ?> --</option>
                        <?php $__currentLoopData = $data_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field_key => $field_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($field_key, false); ?>"><?php echo e($field_label, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!-- Barcode Properties -->
            <div class="props-group" id="barcode_props" style="display:none;">
                <div class="props-group-title"><i class="fa fa-barcode"></i> <?php echo app('translator')->get('label_design.barcode_settings'); ?></div>
                <div class="props-row">
                    <label><?php echo app('translator')->get('label_design.barcode_type'); ?></label>
                    <select id="prop_barcode_type">
                        <option value="C128">Code 128</option>
                        <option value="C39">Code 39</option>
                        <option value="EAN13">EAN-13</option>
                        <option value="EAN8">EAN-8</option>
                        <option value="UPCA">UPC-A</option>
                        <option value="UPCE">UPC-E</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Bar -->
<div class="designer-statusbar">
    <span id="status_coords">X: 0, Y: 0</span>
    <span id="status_label_size"><?php echo app('translator')->get('label_design.label_size'); ?>: <?php echo e($design->width, false); ?>mm × <?php echo e($design->height, false); ?>mm</span>
    <span id="status_save"><?php echo app('translator')->get('label_design.unsaved'); ?></span>
</div>

<!-- Image Upload Modal -->
<div class="modal fade" id="image_upload_modal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo app('translator')->get('label_design.upload_image'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo app('translator')->get('label_design.select_image'); ?></label>
                    <input type="file" id="image_file_input" accept="image/*" class="form-control">
                </div>
                <div class="form-group mt-2">
                    <label><?php echo app('translator')->get('label_design.or_image_url'); ?></label>
                    <input type="text" id="image_url_input" class="form-control" placeholder="https://...">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_add_image_confirm"><?php echo app('translator')->get('label_design.add_image'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Print Preview Modal -->
<div class="modal fade" id="print_preview_modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-eye"></i> <?php echo app('translator')->get('label_design.print_preview'); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center" id="print_preview_content">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_print_from_preview"><i class="fa fa-print"></i> <?php echo app('translator')->get('sale.print'); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden config data -->
<input type="hidden" id="design_id" value="<?php echo e($design->id, false); ?>">
<input type="hidden" id="design_width" value="<?php echo e($design->width, false); ?>">
<input type="hidden" id="design_height" value="<?php echo e($design->height, false); ?>">
<input type="hidden" id="design_data" value='<?php echo json_encode($design->design_data, 15, 512) ?>'>
<input type="hidden" id="save_url" value="<?php echo e(route('label-designs.save-design', $design->id), false); ?>">
<input type="hidden" id="sample_data_url" value="<?php echo e(route('label-designs.sample-data'), false); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"></script>
<script src="<?php echo e(asset('js/label_designer.js?v=' . $asset_v), false); ?>"></script>
<script>
    // Move modals to body so they escape any stacking context from parent wrappers
    $(document).ready(function() {
        $('#image_upload_modal, #print_preview_modal').appendTo('body');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>