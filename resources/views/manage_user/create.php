

<?php $__env->startSection('title', __( 'user.add_user' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><?php echo app('translator')->get( 'user.add_user' ); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<?php echo Form::open(['url' => action([\App\Http\Controllers\ManageUserController::class, 'store']), 'method' => 'post', 'id' => 'user_add_form' ]); ?>

  <div class="row">
    <div class="col-md-12">
  <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group mb-2">
            <?php echo Form::label('surname', __( 'business.prefix' ) . ':'); ?>

              <?php echo Form::text('surname', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group mb-2">
            <?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

              <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group mb-2">
            <?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

              <?php echo Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
          <div class="form-group mb-2">
            <?php echo Form::label('email', __( 'business.email' ) . ':'); ?>

              <?php echo Form::text('email', null, ['class' => 'form-control', 'placeholder' => __( 'business.email' ) ]); ?>

          </div>
        </div>
  
        <div class="col-md-4">
          <div class="form-group mb-2">
            <div class="form-check">
              <br/>
              <label class="form-check-label">
<?php echo Form::checkbox('is_active', 'active', true, ['class' => 'form-check-input status']); ?> <?php echo e(__('lang_v1.status_for_user'), false); ?>

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
      <?php if(empty($type) || $type !== 'employees'): ?>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group mb-2">
            <div class="form-check">
              <label class="form-check-label">
                <?php echo Form::checkbox('allow_login', 1, true, 
                [ 'class' => 'form-check-input', 'id' => 'allow_login']); ?> <?php echo e(__( 'lang_v1.allow_login' ), false); ?>

              </label>
            </div>
          </div>
        </div>
      </div>
      <div class="user_auth_fields">
        <div class="row">
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
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label('password', __( 'business.password' ) . ':*'); ?>

              <?php echo Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.password' ) ]); ?>

            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group mb-2">
              <?php echo Form::label('confirm_password', __( 'business.confirm_password' ) . ':*'); ?>

              <?php echo Form::password('confirm_password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.confirm_password' ) ]); ?>

            </div>
          </div>
        </div>
      </div>
      <?php else: ?>
        <?php echo Form::hidden('allow_login', 0); ?>

      <?php endif; ?>
      <?php if(empty($type) || $type !== 'employees'): ?>
      <div class="row user_role_field">
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
            <?php echo Form::select('role', $roles, null, ['class' => 'form-control select2']); ?>

          </div>
        </div>
      </div>
      <?php else: ?>
      <div class="row">
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
            <?php echo Form::select('role', $roles, null, ['class' => 'form-control select2']); ?>

          </div>
        </div>
      </div>
      <?php endif; ?>
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
                  <?php echo Form::checkbox('access_all_locations', 'access_all_locations', true, 
                  ['class' => 'form-check-input']); ?> <?php echo e(__( 'role.all_locations' ), false); ?> 
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
                  <?php echo Form::checkbox('location_permissions[]', 'location.' . $location->id, false, 
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
            <?php echo Form::text('allowed_ips', null, ['class' => 'form-control', 'placeholder' => "Comma Seperated ex: 192.168.100.101,192.168.100.102"]); ?>

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
            <?php echo Form::text('device_id', null, ['class' => 'form-control', 'placeholder' => "Device ID"]); ?>

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
              <?php echo Form::text('cmmsn_percent', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.cmmsn_percent' ) ]); ?>

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
              <?php echo Form::text('max_sales_discount_percent', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.max_sales_discount_percent' ) ]); ?>

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
              <?php echo Form::select('quick_menu_id', $quick_menus, null, ['class' => 'form-control select2']); ?>

          </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        
        <div class="col-md-4">
          <div class="form-group mb-2">
              <div class="form-check">
              <br/>
                <label class="form-check-label">
<?php echo Form::checkbox('selected_contacts', 1, false, 
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
        <div class="col-sm-4 hide selected_contacts_div">
            <div class="form-group mb-2">
                <?php echo Form::label('user_allowed_contacts', __('lang_v1.selected_contacts') . ':'); ?>

                <div class="form-group mb-2">
                    <?php echo Form::select('selected_contact_ids[]', [], null, ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'id' => 'user_allowed_contacts' ]); ?>

                </div>
            </div>
        </div>
      </div>

    <?php echo $__env->renderComponent(); ?>
  </div>
  </div>
    <?php echo $__env->make('user.edit_profile_form_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(!empty($form_partials)): ?>
      <?php $__currentLoopData = $form_partials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $partial; ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  <input type="hidden" name="type" value="<?php echo e(request('type'), false); ?>">
<?php echo Form::close(); ?>


<div id="user-footer-actions-template" class="d-none">
    <div>
        <button class="btn btn-primary" type="submit" form="user_add_form">
            <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
        </button>
    </div>
</div>
  <?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  __page_leave_confirmation('#user_add_form');
  
  var isEmployeeUser = '<?php echo e(isset($type) && $type === "employees" ? "1" : "0", false); ?>' === '1';

  $(document).ready(function(){
    $('#selected_contacts').on('change', function(event){
      $('div.selected_contacts_div').toggleClass('hide');
    });
    // $('#selected_contacts').on('change', function(event){
    //   $('div.selected_contacts_div').addClass('hide');
    // });

    if ($('#allow_login').length) {
      $('#allow_login').on('change', function(event){
        $('div.user_auth_fields').toggleClass('hide');
        $('div.user_role_field').toggleClass('hide');
      });
    }
    // $('#allow_login').on('change', function(event){
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

  $('form#user_add_form').validate({
      rules: (function() {
          var rules = {
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
                          }
                      }
                  }
              }
          };

          if (!isEmployeeUser) {
              rules.password = {
                  required: true,
                  minlength: 5
              };
              rules.confirm_password = {
                  equalTo: "#password"
              };
              rules.username = {
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
              };
          }

          return rules;
      })(),
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
  $('#username').change( function(){
    if($('#show_username').length > 0){
      if($(this).val().trim() != ''){
        $('#show_username').html("<?php echo e(__('lang_v1.your_username_will_be'), false); ?>: <b>" + $(this).val() + "<?php echo e($username_ext, false); ?></b>");
      } else {
        $('#show_username').html('');
      }
    }
  });

  if($('#truckmate_license_expiry').length){
    $('#truckmate_license_expiry').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    $('#truckmate_tacograph_expiry').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });

    $('#truckmate_cpc_expiry').datetimepicker({
        format: moment_date_format,
        ignoreReadonly: true,
    });
  }


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>