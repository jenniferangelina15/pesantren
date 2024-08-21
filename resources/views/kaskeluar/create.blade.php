<?php $__env->startSection('js'); ?>

<script type="text/javascript">

// $(document).ready(function() {
//     $(".users").select2();
// });

</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('kaskeluar.store')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Kas Keluar</h4>
                      
                        <div class="form-group<?php echo ($errors->has('tgl') ? ' has-error' : ''); ?>">
                            <label for="tgl" class="col-md-4 control-label">Tanggal Kas Keluar</label>
                            <div class="col-md-3">
                                <input id="tgl" type="date" class="form-control" name="tgl" value="<?php echo (date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString()))); ?>" required >
                                <?php if($errors->has('tgl')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('kategori') ? ' has-error' : ''); ?>">
                            <label for="kategori" class="col-md-4 control-label">Kategori Kas Keluar</label>
                            <div class="col-md-6">
                            <select class="form-control" name="kategori" required="">
                                <option value=""> </option>
                                <option value="operasional">Operasional</option>
                                <option value="makanan">Makanan</option>
                                <option value="lain">Lainnya</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('keterangan') ? ' has-error' : ''); ?>">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="<?php echo e(old('keterangan')); ?>" required>
                                <?php if($errors->has('keterangan')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('keterangan')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('nominal') ? ' has-error' : ''); ?>">
                            <label for="nominal" class="col-md-4 control-label">Nominal</label>
                            <div class="col-md-6">
                                <input id="nominal" type="text" class="form-control" name="nominal" value="<?php echo e(old('nominal')); ?>" required>
                                <?php if($errors->has('nominal')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('nominal')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="<?php echo e(route('kaskeluar.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>