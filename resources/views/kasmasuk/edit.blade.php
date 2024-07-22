<?php $__env->startSection('js'); ?>

<script type="text/javascript">

// $(document).ready(function() {
//     $(".users").select2();
// });

</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('kasmasuk.update', $data->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>

        <?php echo e(method_field('put')); ?>

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Edit Kas Masuk</h4>
                        
                        <div class="form-group<?php echo ($errors->has('tgl') ? ' has-error' : ''); ?>">
                            <label for="tgl" class="col-md-4 control-label">Tanggal Kas Masuk</label>
                            <div class="col-md-6">
                                <input id="tgl" type="date" class="form-control" name="tgl" value="<?php echo e($data->tgl); ?>" required >
                                <?php if($errors->has('tgl')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('kategori') ? ' has-error' : ''); ?>">
                            <label for="kategori" class="col-md-4 control-label">Kategori Kas Masuk</label>
                            <div class="col-md-6">
                            <select class="form-control" name="kategori" required="">
                                <option value="sumbangan" <?php echo e($data->kategori === "sumbangan" ? "selected" : ""); ?>>Sumbangan</option>
                                <option value="pembayaran" <?php echo e($data->kategori === "pembayaran" ? "selected" : ""); ?>>Pembayaran</option>
                                <option value="lain" <?php echo e($data->kategori === "lain" ? "selected" : ""); ?>>Lainnya</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('keterangan') ? ' has-error' : ''); ?>">
                            <label for="keterangan" class="col-md-4 control-label">Keterangan</label>
                            <div class="col-md-6">
                                <input id="keterangan" type="text" class="form-control" name="keterangan" value="<?php echo e($data->keterangan); ?>" required>
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
                                <input id="nominal" type="text" class="form-control" name="nominal" value="<?php echo e($data->nominal); ?>" required>
                                <?php if($errors->has('nominal')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('nominal')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" id="submit">
                                    Ubah
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="<?php echo e(route('kasmasuk.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>