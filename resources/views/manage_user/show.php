

<?php $__env->startSection('title', __( 'lang_v1.view_user' )); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <h3><?php echo app('translator')->get( 'lang_v1.view_user' ); ?></h3>
            </div>
            <div class="col-md-4 col-12 mt-15 float-end">
                <?php echo Form::select('user_id', $users, $user->id , ['class' => 'form-control select2', 'id' => 'user_id']); ?>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <?php
                            if(isset($user->media->display_url)) {
                                $img_src = $user->media->display_url;
                            } else {
                                $name = !empty($user->first_name) ? $user->first_name : 'U';
                                if(config('constants.is_offline')) {
                                    $img_src = 'data:image/svg+xml,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128"><rect width="128" height="128" fill="#6c757d"/><text x="50%" y="54%" dominant-baseline="middle" text-anchor="middle" fill="#fff" font-size="64" font-family="Arial,sans-serif">' . strtoupper(mb_substr($name, 0, 1)) . '</text></svg>');
                                } else {
                                    $img_src = 'https://ui-avatars.com/api/?name='.$user->first_name;
                                }
                            }
                        ?>

                        <img class="profile-user-img img-responsive" src="<?php echo e($img_src, false); ?>" style="width:150px; height:150px" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            <?php echo e($user->user_full_name, false); ?>

                        </h3>

                        <p class="text-muted text-center" title="<?php echo app('translator')->get('user.role'); ?>">
                            <?php echo e($user->role_name, false); ?>

                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get( 'business.username' ); ?></b>
                                <a class="float-end"><?php echo e($user->username, false); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get( 'business.email' ); ?></b>
                                <a class="float-end"><?php echo e($user->email, false); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo e(__('lang_v1.status_for_user'), false); ?></b>
                                <?php if($user->status == 'active'): ?>
                                    <span class="label label-success float-end">
                                        <?php echo app('translator')->get('business.is_active'); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="label label-danger float-end">
                                        <?php echo app('translator')->get('lang_v1.inactive'); ?>
                                    </span>
                                <?php endif; ?>
                            </li>
                        </ul>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.update')): ?>
                            <br>
                            <a href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'edit'], [$user->id]), false); ?>" class="btn btn-primary btn-block">
                                <i class="fa fa-edit"></i>
                                <?php echo app('translator')->get("messages.edit"); ?>
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo e(action([\App\Http\Controllers\ManageUserController::class, 'printUser'], [$user->id]), false); ?>?print_on_load=true" class="btn btn-primary btn-block">
                            <i class="glyphicon glyphicon-print"></i>
                            <?php echo app('translator')->get("messages.print"); ?>
                        </a>
                        </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="nav-item p-2">
                            <a class="nav-link active" href="#user_info_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-user" aria-hidden="true"></i> <?php echo app('translator')->get( 'lang_v1.user_info'); ?></a>
                        </li>
                        
                        <li class="nav-item p-2">
                            <a class="nav-link" href="#documents_and_notes_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-paperclip" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.documents_and_notes'); ?></a>
                        </li>

                        <li class="nav-item p-2">
                            <a class="nav-link" href="#activities_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-pen-square" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.activities'); ?></a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="user_info_tab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                            <p><strong><?php echo app('translator')->get( 'lang_v1.cmmsn_percent' ); ?>: </strong> <?php echo e($user->cmmsn_percent, false); ?>%</p>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            $selected_contacts = ''
                                        ?>
                                        <?php if(count($user->contactAccess)): ?> 
                                            <?php
                                                $selected_contacts_array = [];
                                            ?>
                                            <?php $__currentLoopData = $user->contactAccess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                                <?php
                                                    $selected_contacts_array[] = $contact->name; 
                                                ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                            <?php
                                                $selected_contacts = implode(', ', $selected_contacts_array);
                                            ?>
                                        <?php else: ?> 
                                            <?php
                                                $selected_contacts = __('lang_v1.all'); 
                                            ?>
                                        <?php endif; ?>
                                        <p>
                                            <strong><?php echo app('translator')->get( 'lang_v1.allowed_contacts' ); ?>: </strong>
                                                <?php echo e($selected_contacts, false); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php echo $__env->make('user.show_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <div class="tab-pane fade" id="documents_and_notes_tab" role="tabpanel">
                            <!-- model id like project_id, user_id -->
                            <input type="hidden" name="notable_id" id="notable_id" value="<?php echo e($user->id, false); ?>">
                            <!-- model name like App\User -->
                            <input type="hidden" name="notable_type" id="notable_type" value="App\User">
                            <div class="document_note_body">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="activities_tab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo $__env->make('activity_log.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <!-- document & note.js -->
    <?php echo $__env->make('documents_and_notes.document_and_note_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script type="text/javascript">
        $(document).ready( function(){
            $('#user_id').change( function() {
                if ($(this).val()) {
                    window.location = "<?php echo e(url('/users'), false); ?>/" + $(this).val();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>