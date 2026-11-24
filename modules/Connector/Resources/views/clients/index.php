
<?php $__env->startSection('title', __( 'connector::lang.clients' )); ?>

<?php $__env->startSection('vue'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'connector::lang.clients' ); ?></h1>
</section>

<?php if(empty($is_demo)): ?>
<section class="content">
	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'connector::lang.clients' )]); ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('superadmin')): ?>
                    <a href="<?php echo e(action([\Modules\Connector\Http\Controllers\ClientController::class, 'regenerate']), false); ?>" class="btn btn-block btn-default" >
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get( 'connector::lang.regenerate_doc' ); ?></a>
                <?php endif; ?>
                
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-bs-toggle="modal" 
                    data-bs-target="#create_client_modal">
                    <i class="fas fa-plus"></i> <?php echo app('translator')->get( 'connector::lang.create_client' ); ?></button>
            </div>
        <?php $__env->endSlot(); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="clients_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                        <th><?php echo app('translator')->get( 'business.business_name' ); ?></th>
                        <th><?php echo app('translator')->get( 'connector::lang.client_secret' ); ?></th>
                        <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                    </tr>
                </thead>
                <tbody>
                	<?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                		<tr>
                			<td><?php echo e($client->id, false); ?></td>
                			<td><?php echo e($client->name, false); ?></td>
                      <td><?php echo e($client->business_name, false); ?></td>
                			<td><?php echo e($client->secret, false); ?></td>
                			<td><?php echo Form::open(['url' => action([\Modules\Connector\Http\Controllers\ClientController::class, 'destroy'], [$client->id]), 'method' => 'delete', 'id' => 'create_client_form' ]); ?><button type="submit" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> <?php echo app('translator')->get( 'messages.delete' ); ?></button><?php echo Form::close(); ?></td>
                		</tr>
                	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php else: ?>
<section>
    <div class="col-md-12 text-danger">
        <br/>
        <?php echo app('translator')->get('lang_v1.disabled_in_demo'); ?>
    </div>
</section>
<?php endif; ?>



<!-- Create Client Modal -->
<div class="modal fade" id="create_client_modal" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\Modules\Connector\Http\Controllers\ClientController::class, 'store']), 'method' => 'post', 'id' => 'create_client_form' ]); ?>


    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'connector::lang.create_client' ); ?></h4>
    </div>

    <div class="modal-body">
      <div class="form-group">
        <?php echo Form::label('name', __( 'user.name' ) . ':*'); ?>

          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'user.name' ) ]); ?>

      </div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
	$(document).ready( function(){
		clients_table = $('#clients_table').DataTable();
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>