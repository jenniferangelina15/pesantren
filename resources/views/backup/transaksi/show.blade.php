<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail <b><?php echo e($data->kode_transaksi); ?></b></h4>
                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" <?php if($data->kostum->gambar): ?>
                                src="<?php echo e(asset('images/kostum/' . $data->kostum->gambar)); ?>" <?php endif; ?> />
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('kode_transaksi') ? ' has-error' : ''); ?>">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi"
                                    value="<?php echo e($data->kode_transaksi); ?>" required readonly="">
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('tgl_pinjam') ? ' has-error' : ''); ?>">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Pinjam</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam"
                                    value="<?php echo e(date('Y-m-d', strtotime($data->tgl_pinjam))); ?>" readonly="">
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('tgl_kembali') ? ' has-error' : ''); ?>">
                            <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date" class="form-control" name="tgl_kembali"
                                    value="<?php echo e(date('Y-m-d', strtotime($data->tgl_kembali))); ?>" readonly="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="kostum_id" class="col-md-4 control-label">Kostum</label>
                            <div class="col-md-6">
                                <input id="kostum" type="text" class="form-control" readonly=""
                                    value="<?php echo e($data->kostum->kostum); ?>">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="customer_id" class="col-md-4 control-label">Customer</label>
                            <div class="col-md-6">
                                <input id="customer_nama" type="text" class="form-control" readonly=""
                                    value="<?php echo e($data->customer->nama); ?>">

                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <?php if($data->status == 'sewa'): ?>
                                    <label class="badge badge-warning">Sewa</label>
                                <?php else: ?>
                                    <label class="badge badge-success">Kembali</label>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('total_harga') ? ' has-error' : ''); ?>">
                            <label for="total_harga" class="col-md-4 control-label">Total Harga</label>
                            <div class="col-md-6">
                                <input id="total_harga" type="text" class="form-control" name="total_harga"
                                    value="<?php echo e($data->total_harga); ?>" readonly="">
                            </div>
                        </div>

                        <a href="<?php echo e(route('transaksi.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>