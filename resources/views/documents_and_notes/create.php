<div class="modal-dialog modal-lg" role="document">
    <?php echo Form::open(['action' => '\App\Http\Controllers\DocumentAndNoteController@store', 'id' => 'docus_notes_form', 'method' => 'post']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <?php echo app('translator')->get('lang_v1.add_note'); ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- model id like project_id, user_id -->
        <?php echo Form::hidden('notable_id', $notable_id, ['class' => 'form-control']); ?>

        <!-- model name like App\User -->
        <?php echo Form::hidden('notable_type', $notable_type, ['class' => 'form-control']); ?>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                   <div class="mb-3">
                        <?php echo Form::label('heading', __('lang_v1.heading') . ':*' ); ?>

                        <?php echo Form::text('heading', null, ['class' => 'form-control', 'required' ]); ?>

                   </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('description', __('lang_v1.description') . ':'); ?>

                        <?php echo Form::textarea('description', null, ['class' => 'form-control ', 'id' => 'docs_note_description']); ?>

                    </div>
                </div>
            </div>
            <?php if(in_array('upload_documents', $enabled_modules)): ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="fileupload">
                            <?php echo app('translator')->get('lang_v1.documents'); ?>:
                        </label>
                        <div class="dropzone" id="docusUpload"></div>
                    </div>
                    <input type="hidden" id="docus_notes_media" name="file_name[]" value="">
                </div>
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <?php echo Form::label("doc_expiry_date" , __('lang_v1.expiry_date') . ':'); ?>

                        <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <?php echo Form::text('doc_expiry_date', null, ['class' => 'form-control', 'readonly', 'id' => 'doc_expiry_date']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <div class="form-check">
                            <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="is_private" value="1"> <?php echo app('translator')->get('lang_v1.is_private'); ?>
                                <i class="fa fa-info-circle" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.note_will_be_visible_to_u_only'); ?>"></i>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">
                <?php echo app('translator')->get('messages.save'); ?>
            </button>
             <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
    <?php echo Form::close(); ?>

</div><!-- /.modal-dialog -->
