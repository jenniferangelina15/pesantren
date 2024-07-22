<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    // $(document).ready(function() {
    //     $(".users").select2();
    // });

</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('santri.store')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Santri baru</h4>

                            <div class="form-group<?php echo e($errors->has('nama') ? ' has-error' : ''); ?>">
                                <label for="nama" class="col-md-4 control-label">Nama</label>
                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control" name="nama"
                                        value="<?php echo e(old('nama')); ?>" required>
                                    <?php if ($errors->has('nama')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('nama')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('nik') ? ' has-error' : ''); ?>">
                                <label for="nik" class="col-md-4 control-label">NIK</label>
                                <div class="col-md-6">
                                    <input id="nik" type="text" class="form-control" name="nik"
                                        value="<?php echo e(old('nik')); ?>" maxlength="20" required>
                                    <?php if ($errors->has('nik')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('nik')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('kelas') ? ' has-error' : ''); ?>">
                                <label for="kelas" class="col-md-4 control-label">Kelas</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="kelas" required="">
                                        <option value=""></option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('bulan_tagihan') ? ' has-error' : ''); ?>">
                                <label for="bulan_tagihan" class="col-md-4 control-label">Bulan Tagihan</label>
                                <div class="col-md-6">
                                    <input id="bulan_tagihan" type="number" class="form-control" name="bulan_tagihan"
                                        value="12" required>
                                    <?php if ($errors->has('bulan_tagihan')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('bulan_tagihan')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('wali') ? ' has-error' : ''); ?>">
                                <label for="wali" class="col-md-4 control-label">Nama Wali</label>
                                <div class="col-md-6">
                                    <input id="wali" type="string" class="form-control" name="wali"
                                        value="<?php echo e(old('wali')); ?>" required>
                                    <?php if ($errors->has('wali')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('wali')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('alamat') ? ' has-error' : ''); ?>">
                                <label for="alamat" class="col-md-4 control-label">Alamat</label>
                                <div class="col-md-6">
                                    <input id="alamat" type="text" class="form-control" name="alamat"
                                        value="<?php echo e(old('alamat')); ?>" required>
                                    <?php if ($errors->has('alamat')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('alamat')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('no_hp') ? ' has-error' : ''); ?>">
                                <label for="no_hp" class="col-md-4 control-label">No HP</label>
                                <div class="col-md-6">
                                    <input id="no_hp" type="text" class="form-control" name="no_hp"
                                        value="<?php echo e(old('no_hp')); ?>" required>
                                    <?php if ($errors->has('no_hp')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('no_hp')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('jk') ? ' has-error' : ''); ?>">
                                <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="jk" required="">
                                        <option value=""></option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <input id="status" type="text" class="form-control" name="status" value="tagih" hidden>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label for="password" class="col-md-4 control-label">Password Akun</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                        value="<?php echo e(old('password')); ?>" required>
                                    <?php if ($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="confirm_password" type="password" onkeyup="check()" class="form-control"
                                        name="password_confirmation" required>
                                    <span id='message'></span>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary" id="submit">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Reset
                            </button>
                            <a href="<?php echo e(route('santri.index')); ?>" class="btn btn-light pull-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>