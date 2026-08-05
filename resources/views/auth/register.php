

<?php $__env->startSection('content'); ?>

<div class="row">

    <h1 class="page-header text-center"><?php echo e(config('app.name', 'BitorePOS'), false); ?></h2>
    
    <div class="col-md-8 col-md-offset-2">
        
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title text-center">Register and Get Started in minutes</h3>
            </div>

            <?php echo Form::open(['url' => <?php echo e(route('business.postRegister'), false); ?>]); ?>

            <?php echo Form::token(); ?>


                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <?php echo Form::label('name','Business Name:'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-suitcase"></i>
                                </span>
                                <?php echo Form::text('name', null, ['class' => 'form-control','placeholder' => 'Business name']); ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('start_date','Start Date:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <?php echo Form::text('start_date', null, ['class' => 'form-control start-date-picker','placeholder' => 'Start Date', 'readonly']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('currency','Currency:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <?php echo Form::select('currency', $currencies, '', ['class' => 'form-control','placeholder' => 'Select Currency']); ?>

                        </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('country','Country:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-globe"></i>
                            </span>
                            <?php echo Form::text('country', null, ['class' => 'form-control','placeholder' => 'Country']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('state','State:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('state', null, ['class' => 'form-control','placeholder' => 'State']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('city','City:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('city', null, ['class' => 'form-control','placeholder' => 'City']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('zip_code','Zip Code:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('zip_code', null, ['class' => 'form-control','placeholder' => 'Zip/Postal Code']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('landmark','Landmark:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('landmark', null, ['class' => 'form-control','placeholder' => 'Landmark']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('tax_label_1','Tax 1 Name:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('tax_label_1', null, ['class' => 'form-control','placeholder' => 'GST / VAT / Other']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('tax_number_1','Tax 1 No.:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('tax_number_1', null, ['class' => 'form-control',]); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('tax_label_2','Tax 2 Name:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('tax_label_2', null, ['class' => 'form-control','placeholder' => 'GST / VAT / Other']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('tax_number_2','Tax 2 No.:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('tax_number_2', null, ['class' => 'form-control',]); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <hr/>
                    </div>

                    <!-- Owner Information -->
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('surname','Surname:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('surname', null, ['class' => 'form-control','placeholder' => 'GST / VAT / Other']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('first_name','First Name:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('first_name', null, ['class' => 'form-control','placeholder' => 'Owner Name']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group mb-2">
                        <?php echo Form::label('last_name','Last Name:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('last_name', null, ['class' => 'form-control','placeholder' => 'Owner Name']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('username','Username:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::text('username', null, ['class' => 'form-control','placeholder' => 'Username used for login']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('email','Email:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <?php echo Form::text('email', null, ['class' => 'form-control','placeholder' => '']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('password','Password:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <?php echo Form::password('password', ['class' => 'form-control','placeholder' => 'Login Password']); ?>

                        </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <?php echo Form::label('confirm_password','Confirm Password:'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <?php echo Form::password('confirm_password', ['class' => 'form-control','placeholder' => 'Same as Login Password']); ?>

                        </div>
                        </div>
                    </div>

                    </div><!-- /.row -->
                </div>
                <!-- /.box-body -->
                
                <div class="box-footer">
                    <button type="button" class="btn btn-success float-end">Register</button>
                </div>

            <?php echo Form::close(); ?>

            
        </div>
          <!-- /.box -->
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>