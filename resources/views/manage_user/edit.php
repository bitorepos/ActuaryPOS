

<?php $__env->startSection('title', __( 'user.edit_user' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'user.edit_user' ); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <input type="hidden" value="<?php echo e($user->id, false); ?>" id="user_id">
    <?php if(!empty($user->allow_login)): ?>
    <input type="hidden" value="<?php echo e($user->username, false); ?>" id="username">
    <?php endif; ?>
    <input type="hidden" value="<?php echo e(session('business.name'), false); ?>" id="hidden_business_name">
    
    <?php echo Form::open(['url' => action([\App\Http\Controllers\ManageUserController::class, 'update'], [$user->id]), 'method' => 'PUT', 'id' => 'user_edit_form', 'files' => true]); ?>

    <div class="row">
        <div class="col-md-12">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group mb-2">
                  <?php echo Form::label('surname', __( 'business.prefix' ) . ':'); ?>

                    <?php echo Form::text('surname', $user->surname, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-2">
                  <?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

                    <?php echo Form::text('first_name', $user->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group mb-2">
                  <?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

                    <?php echo Form::text('last_name', $user->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group mb-2">
                  <?php echo Form::label('email', __( 'business.email' ) . ':'); ?>

                    <?php echo Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => __( 'business.email' ) ]); ?>

                </div>
            </div>

            <div class="col-md-2 col-sm-4">
              <div class="mb-3">
                <?php echo Form::label('profile_photo', __('lang_v1.upload_image') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?>"></i>
                <?php echo Form::file('profile_photo', ['id' => 'profile_photo', 'accept' => 'image/*']); ?>

              </div>
            </div>
            <div class="col-md-4">
              <?php
                  $img_src = '';
                  if(isset($user->media->display_url)) {
                      $img_src = $user->media->display_url;
                  }
              ?>
              <?php if(!empty($img_src)): ?>
                <img class="profile-user-img float-start img-responsive" src="<?php echo e($img_src, false); ?>" style="width: 150px;height:150px" alt="User profile picture">
              <?php endif; ?>
            </div>

            <div class="col-md-2">
                <div class="mb-3">
                  <div class="form-check">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('is_active', $user->status, $is_checked_checkbox, ['class' => 'form-check-input status']); ?> <?php echo e(__('lang_v1.status_for_user'), false); ?>

                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_user_active') . '"></i>';
                }
            ?>
                  </div>
                </div>
            </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        </div>
        <div class="col-md-12">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary'], ['title' => __('lang_v1.roles_and_permissions')]); ?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group mb-2">
                    <div class="form-check">
                      <label class="form-check-label">
<?php echo Form::checkbox('allow_login', 1, !empty($user->allow_login), 
                        [ 'class' => 'form-check-input', 'id' => 'allow_login']); ?> <?php echo e(__( 'lang_v1.allow_login' ), false); ?>

                      </label>
                    </div>
                </div>
              </div>
            </div>
            <div class="user_auth_fields <?php if(empty($user->allow_login)): ?> hide <?php endif; ?>">
              <div class="row">
                <?php if(empty($user->allow_login)): ?>
                  <div class="col-md-4">
                      <div class="form-group mb-2">
                        <?php echo Form::label('username', __( 'business.username' ) . ':'); ?>

                        <?php if(!empty($username_ext)): ?>
                          <div class="input-group">
                            <?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]); ?>

                            <span class="input-group-text"><?php echo e($username_ext, false); ?></span>
                          </div>
                          <p class="help-block" id="show_username"></p>
                        <?php else: ?>
                            <?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ) ]); ?>

                        <?php endif; ?>
                        <p class="help-block"><?php echo app('translator')->get('lang_v1.username_help'); ?></p>
                      </div>
                  </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                      <?php echo Form::label('password', __( 'business.password' ) . ':'); ?>

                        <?php echo Form::password('password', ['class' => 'form-control', 'placeholder' => __( 'business.password'), 'required' => empty($user->allow_login) ? true : false, 'autocomplete'=> false, 'readonly', 'onfocus'=> "this.removeAttribute('readonly');" ]); ?>

                        <p class="help-block"><?php echo app('translator')->get('user.leave_password_blank'); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                      <?php echo Form::label('confirm_password', __( 'business.confirm_password' ) . ':'); ?>

                        <?php echo Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __( 'business.confirm_password' ), 'required' => empty($user->allow_login) ? true : false,  'readonly', 'onfocus'=> "this.removeAttribute('readonly');" ]); ?>

                    </div>
                </div>
              </div>
              <div class="row">
                <?php if(!empty($user->allow_login)): ?>
                  <div class="col-md-2">
                      <div class="form-group mb-2">
                          <button type="button" class="btn btn-primary" id="generate_mobile_secret"><?php if(!empty($client)): ?> Regenerate <?php else: ?> Generate <?php endif; ?> Mobile App Client</button>                 
                      </div>
                  </div>
                  <div class="col-md-2">
                      <div class="form-group mb-2">
                        <b>Client ID : </b>  
                        <p id="mobile_app_token_id"><?php if(!empty($client)): ?> <?php echo e($client->id, false); ?> <?php else: ?> Click Button to Generate  <?php endif; ?> </p>                 
                      </div>
                  </div>
                  <div class="col-md-8">
                      <div class="form-group mb-2">
                        <b>Client ID Secret : </b>  
                        <p id="mobile_app_token"><?php if(!empty($client)): ?> <?php echo e($client->secret, false); ?> <?php else: ?> Click Button to Generate <?php endif; ?></p>                 
                      </div>
                  </div>
                <?php else: ?>
                  <div class="col-md-12">
                      <div class="form-group mb-2">
                        <b>For Mobile App Client ID Please Create Username and Password First.</b>  
                      </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <div class="row user_role_field <?php if(empty($user->allow_login)): ?> hide <?php endif; ?>">
              <div class="col-md-6">
                  <div class="form-group mb-2">
                    <?php echo Form::label('role', __( 'user.role' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.admin_role_location_permission_help') . '"></i>';
                }
            ?>
                      <?php echo Form::select('role', $roles, !empty($user->roles->first()->id) ? $user->roles->first()->id : null, ['class' => 'form-control select2', 'style' => 'width: 100%;']); ?>

                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                  <h4><?php echo app('translator')->get( 'role.access_locations' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.access_locations_permission') . '"></i>';
                }
            ?></h4>
              </div>
              <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('access_all_locations', 'access_all_locations', !is_array($permitted_locations) && $permitted_locations == 'all', 
                          [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'role.all_locations' ), false); ?> 
                          </label>
                          <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.all_location_permission') . '"></i>';
                }
            ?>
                      </div>
                    </div>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12">
                        <div class="form-check">
                          <label class="form-check-label">
<?php echo Form::checkbox('location_permissions[]', 'location.' . $location->id, is_array($permitted_locations) && in_array($location->id, $permitted_locations), 
                            [ 'class' => 'form-check-input']); ?> <?php echo e($location->name, false); ?> <?php if(!empty($location->location_id)): ?>(<?php echo e($location->location_id, false); ?>) <?php endif; ?>
                          </label>
                        </div>
                    </div>
                    <?php
                      $biz_locations[$location->id] = $location->name;
                    ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-5">
                <?php
                  $allowed_ips = '';
                  $user->allowed_ips = json_decode($user->allowed_ips, true);
                ?>
                <?php if(!empty($user->allowed_ips)): ?>
                  <?php $__currentLoopData = $user->allowed_ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php
                      $allowed_ips .= $ip;
                    ?>  
                    <?php if(!$loop->last): ?>
                      <?php
                        $allowed_ips .= ',';
                      ?>  
                    <?php endif; ?>  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="form-group mb-2">
                    <?php echo Form::label('allowed_ips', "Allowed Login IP's:"); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.restrictions_user_login_ip') . '"></i>';
                }
            ?>
                    <?php echo Form::text('allowed_ips', $allowed_ips, ['class' => 'form-control', 'placeholder' => "Comma Seperated ex: 192.168.100.101,192.168.100.102"]); ?>

                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group mb-2">
                    <?php echo Form::label('device_id', "Allowed Device ID:"); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.restrictions_user_device_id') . '"></i>';
                }
            ?>
                    <?php echo Form::text('device_id', $user->device_id, ['class' => 'form-control', 'placeholder' => "Device ID"]); ?>

                </div>
              </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary'], ['title' => __('sale.sells')]); ?>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group mb-2">
                  <?php echo Form::label('cmmsn_percent', __( 'lang_v1.cmmsn_percent' ) . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.commsn_percent_help') . '"></i>';
                }
            ?>
                    <?php echo Form::text('cmmsn_percent', !empty($user->cmmsn_percent) ? number_format($user->cmmsn_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : 0, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' )]); ?>

                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group mb-2">
                  <?php echo Form::label('max_sales_discount_percent', __( 'lang_v1.max_sales_discount_percent' ) . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.max_sales_discount_percent_help') . '"></i>';
                }
            ?>
                    <?php echo Form::text('max_sales_discount_percent', !is_null($user->max_sales_discount_percent) ? number_format($user->max_sales_discount_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.max_sales_discount_percent' ) ]); ?>

                </div>
            </div>

            <?php if(in_array('quick_menu', session('business.enabled_modules', []))): ?>
            <div class="col-md-4">
              <div class="form-group mb-2">
                <?php echo Form::label('quick_menu_id', __( 'business.quick_menu' ) . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.admin_role_location_permission_help') . '"></i>';
                }
            ?>
                  <?php echo Form::select('quick_menu_id', $quick_menus, $user->quick_menu_id, ['class' => 'form-control select2']); ?>

              </div>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <div class="form-check">
                    <br/>
                      <label class="form-check-label">
<?php echo Form::checkbox('selected_contacts', 1, 
                        $user->selected_contacts, 
                        [ 'class' => 'form-check-input', 'id' => 'selected_contacts']); ?> <?php echo e(__( 'lang_v1.allow_selected_contacts' ), false); ?>

                      </label>
                      <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.allow_selected_contacts_tooltip') . '"></i>';
                }
            ?>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4 selected_contacts_div <?php if(!$user->selected_contacts): ?> hide <?php endif; ?>">
                <div class="form-group mb-2">
                  <?php echo Form::label('user_allowed_contacts', __('lang_v1.selected_contacts') . ':'); ?>

                    <div class="form-group mb-2">
                      <?php echo Form::select('selected_contact_ids[]', $contact_access, array_keys($contact_access), ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'id' => 'user_allowed_contacts' ]); ?>

                    </div>
                </div>
            </div>
            </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
  <?php echo $__env->make('user.edit_profile_form_part', ['bank_details' => !empty($user->bank_details) ? json_decode($user->bank_details, true) : null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(!empty($form_partials)): ?>
      <?php $__currentLoopData = $form_partials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $partial; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <input type="hidden" name="type" value="<?php echo e(request('type'), false); ?>">
    <?php echo Form::close(); ?>


    <div id="user-footer-actions-template" class="d-none">
        <div>
            <button class="btn btn-primary" type="submit" form="user_edit_form">
                <i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?>
            </button>
        </div>
    </div>
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    __page_leave_confirmation('#user_edit_form');
    
    $('#selected_contacts').on('change', function(event){
      $('div.selected_contacts_div').toggleClass('hide');
    });
    // $('#selected_contacts').on('ifUnchecked', function(event){
    //   $('div.selected_contacts_div').addClass('hide');
    // });
    $('#allow_login').on('change', function(event){
      $('div.user_auth_fields').toggleClass('hide');
      $('div.user_role_field').toggleClass('hide');
    });
    // $('#allow_login').on('ifUnchecked', function(event){
    //   $('div.user_auth_fields').addClass('hide');
    // });

    $('#user_allowed_contacts').select2({
        ajax: {
            url: '/contacts/customers',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term, // search term
                    page: params.page,
                    all_contact: true
                };
            },
            processResults: function(data) {
                return {
                    results: data,
                };
            },
        },
        templateResult: function (data) { 
            var template = '';
            if (data.supplier_business_name) {
                template += data.supplier_business_name + "<br>";
            }
            template += data.text + "<br>" + LANG.mobile + ": " + data.mobile;

            return  template;
        },
        minimumInputLength: 1,
        escapeMarkup: function(markup) {
            return markup;
        },
    });
  });

  $('form#user_edit_form').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    email: {
                        email: true,
                        remote: {
                            url: "/business/register/check-email",
                            type: "post",
                            data: {
                                email: function() {
                                    return $( "#email" ).val();
                                },
                                user_id: <?php echo e($user->id, false); ?>

                            }
                        }
                    },
                    password: {
                        minlength: 5
                    },
                    confirm_password: {
                        equalTo: "#password",
                    },
                    username: {
                        minlength: 5,
                        remote: {
                            url: "/business/register/check-username",
                            type: "post",
                            data: {
                                username: function() {
                                    return $( "#username" ).val();
                                },
                                <?php if(!empty($username_ext)): ?>
                                  username_ext: "<?php echo e($username_ext, false); ?>"
                                <?php endif; ?>
                            }
                        }
                    }
                },
                messages: {
                    password: {
                        minlength: 'Password should be minimum 5 characters',
                    },
                    confirm_password: {
                        equalTo: 'Should be same as password'
                    },
                    username: {
                        remote: 'Invalid username or User already exist'
                    },
                    email: {
                        remote: '<?php echo e(__("validation.unique", ["attribute" => __("business.email")]), false); ?>'
                    }
                }
            });
    
    $(document).on('change', '#essentials_department_id', function(){
      if($(this).val() !== '') {
          $.ajax({
              url: '/get-sub-taxonomies?type=hrm_department&parent_category=' + $(this).val(),
              dataType: 'json',
              success: function(result) {
                  $('#essentials_sub_department_id').select2('destroy')
                      .empty()
                      .select2({
                          data: result.sub_categories,
                      });
                      $('#essentials_sub_department_id').change();
              },
          });
      }else{
        $('#essentials_sub_department_id').select2('destroy')
                      .empty()
                      .select2({
                          data: [{id: "null", text: "Please Select"}],
                      });
                      $('#essentials_sub_department_id').change();
      }
    });

    $(document).on('click', 'button.enroll_user', function() {
        let terminal_api_key = $('input#terminal_api_key').val();
        let terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        let user_id = $('#user_id').val();
        data = {
            api_key: terminal_api_key,
            api_secret: terminal_api_secret,
            device_id: 'device1',
            name: first_name+' '+last_name,
            user_id: user_id,
            password: '1234',
            uid: user_id,
        };
        $.ajax({
            url: "http://127.0.0.1:5000/add_user",
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function(result) {
                console.log(result);
                if(result.success){
                    $('#essentials_attendence_uid').val(user_id);
                    toastr.success(result.message);
                }else{
                    toastr.warning(result.message);
                }
                loading.toggleClass('hide');
            },
            error: function(){
                loading.toggleClass('hide');
                toastr.error('Nothing Synced - Please Check If Conncetor Software is Running');
            },
        });
    });

    $(document).on('click', 'button.trigger_enroll_finger', function() {
        let terminal_api_key = $('input#terminal_api_key').val();
        let terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        let user_id = $('#essentials_attendence_uid').val();
        if(user_id > 0){
          data = {
              api_key: terminal_api_key,
              api_secret: terminal_api_secret,
              device_id: 'device1',
              uid: user_id,
              temp_id: 6,
          };
          $.ajax({
              url: "http://127.0.0.1:5000/delete_finger",
              data: data,
              method: 'POST',
              dataType: 'json',
              success: function(result) {
                  if(result.success){
                      console.log(result.message);
                      $('#essentials_attendence_finger').val(0);
                  }else{
                      console.log(result.message);
                      $('#essentials_attendence_finger').val(0);
                  }
                  loading.toggleClass('hide');
              },
          });
          
          $.ajax({
              url: "http://127.0.0.1:5000/add_finger",
              data: data,
              method: 'POST',
              dataType: 'json',
              success: function(result) {
                  if(result.success){
                      toastr.success(result.message);
                      $('#essentials_attendence_finger').val(1);
                  }else{
                      toastr.warning(result.message);
                      $('#essentials_attendence_finger').val(0);
                  }
                  loading.toggleClass('hide');
              },
              error: function(){
                  loading.toggleClass('hide');
                  toastr.error('Nothing Synced - Please Check If Conncetor Software is Running');
              },
          });
        }
    });

    $(document).on('click', 'button.trigger_enroll_face', function() {
        let terminal_api_key = $('input#terminal_api_key').val();
        let terminal_api_secret = $('input#terminal_api_secret').val();
        var loading = $(this).find('i');
        loading.toggleClass('hide');
        let user_id = $('#essentials_attendence_uid').val();
        if(user_id > 0){
          data = {
              api_key: terminal_api_key,
              api_secret: terminal_api_secret,
              device_id: 'device1',
              uid: user_id,
          };
          $.ajax({
              url: "http://127.0.0.1:5000/add_face",
              data: data,
              method: 'POST',
              dataType: 'json',
              success: function(result) {
                  // if(result.success){
                  //     toastr.success(result.message);
                  // }else{
                  //     toastr.warning(result.message);
                  // }
                  $('#essentials_attendence_face').val(1);
                  toastr.success('User Face Enrolled');
                  loading.toggleClass('hide');
              },
              error: function(){
                  loading.toggleClass('hide');
                  toastr.error('Nothing Synced - Please Check If Conncetor Software is Running');
              },
          });
        }
    });

    if($('#truckmate_license_expiry').length){
      $('#truckmate_license_expiry').datepicker({
          autoclose: true
      });
      $('#truckmate_tacograph_expiry').datepicker({
          autoclose: true
      });
      $('#truckmate_cpc_expiry').datepicker({
          autoclose: true
      });      
    }
    $(document).on('click', 'button#generate_mobile_secret', function() {
        $(this).attr('disabled', 'disabled');
        let user_id = $('#user_id').val();
        let username = $('#username').val();

        data = {
            user_id: user_id,
            username: username,
        };

        $.ajax({
            url: "/connector/generate-secret",
            data: data,
            method: 'POST',
            dataType: 'json',
            success: function(result) {
                if(result.success){
                    $('#mobile_app_token_id').text(result.id);  
                    $('#mobile_app_token').text(result.secret);
                    toastr.success(result.msg);
                }else{
                    toastr.warning(result.msg);
                }
                $('button#generate_mobile_secret').removeAttr('disabled');
            },
            error: function(){
                toastr.error('Not Generated - Please Retry');
                $('button#generate_mobile_secret').removeAttr('disabled');
            },
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>