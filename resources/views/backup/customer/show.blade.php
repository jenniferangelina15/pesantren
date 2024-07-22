<?php $__env->startSection('js'); ?>

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b><?php echo e($data->nama); ?></b></h4>
                      <form class="forms-sample">

                        <div class="form-group<?php echo e($errors->has('nama') ? ' has-error' : ''); ?>">
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input id="nama" type="text" class="form-control" name="nama" value="<?php echo e($data->nama); ?>" readonly>
                                <?php if($errors->has('nama')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('nama')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('nik') ? ' has-error' : ''); ?>">
                            <label for="nik" class="col-md-4 control-label">NIK</label>
                            <div class="col-md-6">
                                <input id="nik" type="number" class="form-control" name="nik" value="<?php echo e($data->nik); ?>" maxlength="8" readonly>
                                <?php if($errors->has('nik')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('nik')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('tempat_lahir') ? ' has-error' : ''); ?>">
                            <label for="tempat_lahir" class="col-md-4 control-label">Tempat Lahir</label>
                            <div class="col-md-6">
                                <input id="tempat_lahir" type="text" class="form-control" name="tempat_lahir" value="<?php echo e($data->tempat_lahir); ?>" readonly>
                                <?php if($errors->has('tempat_lahir')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tempat_lahir')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('tgl_lahir') ? ' has-error' : ''); ?>">
                            <label for="tgl_lahir" class="col-md-4 control-label">Tanggal Lahir</label>
                            <div class="col-md-6">
                                <input id="tgl_lahir" type="text" class="form-control" name="tgl_lahir" value="<?php echo e(date('d F Y', strtotime($data->tgl_lahir))); ?>" readonly>
                                <?php if($errors->has('tgl_lahir')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl_lahir')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('level') ? ' has-error' : ''); ?>">
                            <label for="level" class="col-md-4 control-label">Jenis Kelamin</label>
                            <div class="col-md-6">
                            <select class="form-control" name="jk" required="" disabled="">
                                <option value=""></option>
                                <option value="L" <?php echo e($data->jk === "L" ? "selected" : ""); ?>>Laki - Laki</option>
                                <option value="P" <?php echo e($data->jk === "P" ? "selected" : ""); ?>>Perempuan</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('alamat') ? ' has-error' : ''); ?>">
                            <label for="alamat" class="col-md-4 control-label">Alamat</label>
                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo e($data->alamat); ?>" readonly>
                                <?php if($errors->has('alamat')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('alamat')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('no_hp') ? ' has-error' : ''); ?>">
                            <label for="no_hp" class="col-md-4 control-label">No HP</label>
                            <div class="col-md-6">
                                <input id="no_hp" type="text" class="form-control" name="no_hp" value="<?php echo e($data->no_hp); ?>" readonly>
                                <?php if($errors->has('no_hp')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('no_hp')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- <div class="form-group " style="margin-bottom: 20px;">
                            <label for="user_id" class="col-md-4 control-label">User Login</label>
                            <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" value="<?php echo e($data->user->username); ?>" readonly="">
                            </div>
                        </div> -->

                        <a href="<?php echo e(route('customer.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>