<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">

  <div class="col-lg-2">
    <a href="<?php echo e(route('transaksi.create')); ?>" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Transaksi</a>
  </div>
    <div class="col-lg-12">
                  <?php if(Session::has('message')): ?>
                  <div class="alert alert-<?php echo e(Session::get('message_type')); ?>" id="waktu2" style="margin-top:10px;"><?php echo e(Session::get('message')); ?></div>
                  <?php endif; ?>
                  </div>
</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Data Transaksi</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-striped" id="table">
                      <thead>
                        <tr>
                          <th>
                            Kode
                          </th>
                          <th>
                            Kostum
                          </th>
                          <th>
                            Penyewa
                          </th>
                          <th>
                            Tgl Pinjam
                          </th>
                          <th>
                            Tgl Kembali
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td class="py-1">
                          <a href="<?php echo e(route('transaksi.show', $data->id)); ?>"> 
                            <?php echo e($data->kode_transaksi); ?>

                          </a>
                          </td>
                          <td>
                            <?php echo e($data->kostum->kostum); ?>
                          </td>

                          <td>
                            <?php echo e($data->customer->nama); ?>

                          </td>
                          <td>
                           <?php echo e(date('d/m/y', strtotime($data->tgl_pinjam))); ?>

                          </td>
                          <td>
                            <?php echo e(date('d/m/y', strtotime($data->tgl_kembali))); ?>

                          </td>
                          <td>
                          <?php if($data->status == 'sewa'): ?>
                            <label class="badge badge-warning">Sewa</label>
                          <?php else: ?>
                            <label class="badge badge-success">Kembali</label>
                          <?php endif; ?>
                          </td>
                          <td>
                          <?php if(Auth::user()->level == 'admin'): ?>
                          <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                          <?php if($data->status == 'sewa'): ?>
                          <form action="<?php echo e(route('transaksi.update', $data->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('put')); ?>

                            <button class="dropdown-item" onclick="return confirm('Anda yakin data ini sudah kembali?')"> Sudah Kembali
                            </button>
                          </form>
                          <?php endif; ?>
                            <form action="<?php echo e(route('transaksi.destroy', $data->id)); ?>" class="pull-left"  method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('delete')); ?>

                            <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')"> Delete
                            </button>
                          </form>
                          </div>
                        </div>
                        <?php else: ?>
                        <?php if($data->status == 'sewa'): ?>
                        <form action="<?php echo e(route('transaksi.update', $data->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('put')); ?>

                            <button class="btn btn-info btn-xs" onclick="return confirm('Anda yakin data ini sudah kembali?')">Sudah Kembali
                            </button>
                          </form>
                          <?php else: ?>
                          -
                          <?php endif; ?>
                        <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
               
                </div>
              </div>
            </div>
          </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>