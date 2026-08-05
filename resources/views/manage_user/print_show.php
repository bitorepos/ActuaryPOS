
<?php $__env->startSection('title', __( 'lang_v1.view_user' )); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="spacer"></div>
    <div class="row">
        <div class="col-12 text-right mb-12" >
            <button type="button" class="btn btn-primary no-print btn-sm" id="print_user" 
                 aria-label="Print"><i class="fas fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12" style="border: 1px solid #ccc;">
            <div class="spacer"></div>
            <div id="user_content">
                <div class="row">
                    <div class="col-3">
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

                        <img class="profile-user-img img-responsive" src="<?php echo e($img_src, false); ?>" style="width:200px; height:200px" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            <?php echo e($user->user_full_name, false); ?>

                        </h3>

                        <p class="text-muted text-center" title="<?php echo app('translator')->get('user.role'); ?>">
                            <?php echo e($user->role_name, false); ?>

                        </p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get( 'business.username' ); ?></b>
                                <p class="float-end"><?php echo e($user->username, false); ?></p>
                            </li>
                            <li class="list-group-item  text-wrap">
                                <b><?php echo app('translator')->get( 'business.email' ); ?></b>
                                <p class="float-end text-decoration-none"><?php echo e($user->email, false); ?></p>
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
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="col-6">
                                        <p><strong><?php echo app('translator')->get( 'lang_v1.cmmsn_percent' ); ?>: </strong> <?php echo e($user->cmmsn_percent, false); ?>%</p>
                                </div>
                                <div class="col-6">
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
                </div>
            </div>
            <div class="spacer"></div>
        </div>
    </div>
    <div class="spacer"></div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', '#print_user', function(){
            $('#user_content').printThis({
                importCSS: true,
                importStyle: true,
                loadCSS: [
                    "<?php echo e(asset('css/vendor.css'), false); ?>", // Adjust path as needed
                    "<?php echo e(asset('css/app.css'), false); ?>" // Optional: add your custom styles too
                ]
            });
        });
        <?php if(!empty(request()->input('print_on_load'))): ?>
        $(window).on('load', function(){
            $('#user_content').printThis();
        });
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>