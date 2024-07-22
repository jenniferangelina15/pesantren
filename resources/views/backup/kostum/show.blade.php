<?php $__env->startSection('js'); ?>

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
        function readURL() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).prev().attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function () {
            $(".uploads").change(readURL)
            $("#f").submit(function(){
                // do ajax submit or just classic form submit
              //  alert("fake subminting")
                return false
            })
        })
        </script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b><?php echo e($data->kostum); ?></b> </h4>
                      <form class="forms-sample">

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" <?php if($data->gambar): ?> src="<?php echo e(asset('images/kostum/'.$data->gambar)); ?>" <?php endif; ?> />
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('kostum') ? ' has-error' : ''); ?>">
                            <label for="kostum" class="col-md-4 control-label">Kostum</label>
                            <div class="col-md-6">
                                <input id="kostum" type="text" class="form-control" name="kostum" value="<?php echo e($data->kostum); ?>" readonly="">
                                <?php if($errors->has('kostum')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('kostum')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('harga') ? ' has-error' : ''); ?>">
                            <label for="harga" class="col-md-4 control-label">Harga</label>
                            <div class="col-md-6">
                                <input id="harga" type="text" class="form-control" name="harga" value="<?php echo e($data->harga); ?>" readonly>
                                <?php if($errors->has('harga')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('harga')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('jumlah_kostum') ? ' has-error' : ''); ?>">
                            <label for="jumlah_kostum" class="col-md-4 control-label">Stok</label>
                            <div class="col-md-6">
                                <input id="jumlah_kostum" type="number" maxlength="4" class="form-control" name="jumlah_kostum" value="<?php echo e($data->jumlah_kostum); ?>" readonly>
                                <?php if($errors->has('jumlah_kostum')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('jumlah_kostum')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('deskripsi') ? ' has-error' : ''); ?>">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>
                            <div class="col-md-6">
                                <input id="deskripsi" type="text" class="form-control" name="deskripsi" value="<?php echo e($data->deskripsi); ?>" readonly="">
                                <?php if($errors->has('deskripsi')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('deskripsi')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <a href="<?php echo e(route('kostum.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>