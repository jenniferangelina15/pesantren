<?php $__env->startSection('js'); ?>

<script type="text/javascript">

// $(document).ready(function() {
//     $(".users").select2();
// });

</script>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<div class="row">
<div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Detail <b><?php echo e($data->kode_pembayaran); ?></b></h4>
                      <form class="forms-sample">

                      <div class="form-group<?php echo e($errors->has('kode_pembayaran') ? ' has-error' : ''); ?>">
                            <label for="kode_pembayaran" class="col-md-4 control-label">Kode Pembayaran</label>
                            <div class="col-md-6">
                                <input id="kode_pembayaran" type="text" class="form-control" name="kode_pembayaran" value="<?php echo e($data->kode_pembayaran);?>" required readonly="">
                                <?php if($errors->has('kode_pembayaran')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('kode_pembayaran')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo ($errors->has('bulan') ? ' has-error' : ''); ?>">
                            <label for="bulan" class="col-md-4 control-label">Bulan</label>
                            <div class="col-md-6">
                            <select class="form-control" name="bulan" required="" disabled="">
                                <option value="januari" <?php echo e($data->bulan === "januari" ? "selected" : ""); ?>>Januari</option>
                                <option value="februari" <?php echo e($data->bulan === "februari" ? "selected" : ""); ?>>Februari</option>
                                <option value="maret" <?php echo e($data->bulan === "maret" ? "selected" : ""); ?>>Maret</option>
                                <option value="april" <?php echo e($data->bulan === "april" ? "selected" : ""); ?>>April</option>
                                <option value="mei" <?php echo e($data->bulan === "mei" ? "selected" : ""); ?>>Mei</option>
                                <option value="juni" <?php echo e($data->bulan === "juni" ? "selected" : ""); ?>>Juni</option>
                                <option value="juli" <?php echo e($data->bulan === "juli" ? "selected" : ""); ?>>Juli</option>
                                <option value="agustus" <?php echo e($data->bulan === "agustus" ? "selected" : ""); ?>>Agustus</option>
                                <option value="september" <?php echo e($data->bulan === "september" ? "selected" : ""); ?>>September</option>
                                <option value="oktober" <?php echo e($data->bulan === "oktober" ? "selected" : ""); ?>>Oktober</option>
                                <option value="november" <?php echo e($data->bulan === "november" ? "selected" : ""); ?>>November</option>
                                <option value="desember" <?php echo e($data->bulan === "desember" ? "selected" : ""); ?>>Desember</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="santri_id" class="col-md-4 control-label">Santri</label>
                            <div class="col-md-6">
                                <input id="santri_nama" type="text" class="form-control" readonly=""
                                    value="<?php echo e($data->santri->nama); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nominal" class="col-md-4 control-label">Nominal</label>
                            <div class="col-md-6">
                                <input id="nominal" type="text" class="form-control" name="nominal" value="Rp. <?php  echo e(number_format($data->nominal), 2); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" <?php if($data->bukti): ?> src="<?php echo e(asset('images/pembayaran/'.$data->bukti)); ?>" <?php endif; ?> />
                            </div>
                        </div>

                        <a href="<?php echo e(route('pembayaran.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>