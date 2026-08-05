<!-- Camera Capture Modal -->
<div class="modal fade" id="camera_capture_modal" tabindex="-1" aria-labelledby="camera_capture_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="camera_capture_modal_label">
                    <i class="fas fa-camera"></i> <?php echo app('translator')->get('lang_v1.capture_product_image'); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="camera_container">
                    <video id="camera_preview" autoplay playsinline class="w-100 rounded" style="max-height: 400px; object-fit: cover; display: none;"></video>
                    <canvas id="camera_canvas" style="display: none;"></canvas>
                    <div id="captured_image_container" style="display: none;">
                        <img id="captured_image_preview" class="w-100 rounded" style="max-height: 400px; object-fit: contain;" alt="Captured">
                    </div>
                    <div id="camera_loading" class="py-5">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p class="mt-2 text-muted"><?php echo app('translator')->get('lang_v1.starting_camera'); ?>...</p>
                    </div>
                    <div id="camera_error" style="display: none;" class="py-5">
                        <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        <p class="mt-2 text-danger" id="camera_error_msg"></p>
                    </div>
                </div>
                <div id="camera_switch_container" class="mt-2" style="display: none;">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="switch_camera_btn">
                        <i class="fas fa-sync-alt"></i> <?php echo app('translator')->get('lang_v1.switch_camera'); ?>
                    </button>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" id="capture_photo_btn" style="display: none;">
                    <i class="fas fa-camera"></i> <?php echo app('translator')->get('lang_v1.take_photo'); ?>
                </button>
                <button type="button" class="btn btn-warning" id="retake_photo_btn" style="display: none;">
                    <i class="fas fa-redo"></i> <?php echo app('translator')->get('lang_v1.retake'); ?>
                </button>
                <button type="button" class="btn btn-success" id="use_photo_btn" style="display: none;">
                    <i class="fas fa-check"></i> <?php echo app('translator')->get('lang_v1.use_photo'); ?>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.cancel'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
