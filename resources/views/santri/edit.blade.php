<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    // $(document).ready(function() {
    //     $(".users").select2();
    // });

</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('santri.update', $data->id)); ?>" method="post" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('put')); ?>

    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Santri</h4>

                            <div class="form-group<?php echo e($errors->has('nama') ? ' has-error' : ''); ?>">
                                <label for="nama" class="col-md-4 control-label">Nama</label>
                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control" name="nama"
                                        value="<?php echo e($data->nama); ?>" required>
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
                                        value="<?php echo e($data->nik);  ?>" maxlength="20" required>
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
                                    <input id="kelas" type="number" class="form-control" name="kelas"
                                        value="<?php echo e($data->kelas);  ?>" required>
                                    <?php if ($errors->has('kelas')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('kelas')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('wali') ? ' has-error' : ''); ?>">
                                <label for="wali" class="col-md-4 control-label">Nama Wali</label>
                                <div class="col-md-6">
                                    <input id="wali" type="string" class="form-control" name="wali"
                                        value="<?php echo e($data->wali);  ?>" required>
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
                                        value="<?php echo e($data->alamat);  ?>" required>
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
                                        value="<?php echo e($data->no_hp);  ?>" required>
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
                                        <option value="L" <?php echo e($data->jk === "L" ? "selected" : ""); ?>>Laki -
                                            Laki</option>
                                        <option value="P" <?php echo e($data->jk === "P" ? "selected" : ""); ?>>Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('bulan_tagihan') ? ' has-error' : ''); ?>">
                                <label for="bulan_tagihan" class="col-md-4 control-label">Sisa Bulan Tagihan</label>
                                <div class="col-md-6">
                                    <input id="bulan_tagihan" type="number" class="form-control" name="bulan_tagihan"
                                        value="<?php echo e($data->bulan_tagihan);  ?>" required>
                                    <?php if ($errors->has('bulan_tagihan')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('bulan_tagihan')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                <?php 
                            $bulanIndonesia = [
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
];
$bulanSaatIni = $bulanIndonesia[date('n')];
                            ?>
                                <label for="status" class="col-md-4 control-label">Status Pembayaran Bulan
                                    <?php echo $bulanSaatIni ?> </label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status" required="">
                                        <option value=""></option>
                                        <option value="tagih" <?php echo e($data->status === "tagih" ? "selected" : ""); ?>>Tagih</option>
                                        <option value="tagih" <?php echo e($data->status === "cek" ? "selected" : ""); ?>>
                                            Cek</option>
                                        <option value="lunas" <?php echo e($data->status === "lunas" ? "selected" : ""); ?>>Lunas</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" onkeyup='check();'
                                        name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="confirm_password" type="password" onkeyup="check()" class="form-control"
                                        name="password_confirmation">
                                    <span id='message'></span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="submit">
                                Ubah
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