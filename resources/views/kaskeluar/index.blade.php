<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

  });
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">

  <div class="col-lg-2">
    <a href="<?php echo e(route('kaskeluar.create')); ?>" class="btn btn-primary btn-rounded btn-fw"><i
        class="fa fa-plus"></i>
      Tambah Kas Keluar</a>
  </div>
  <div class="col-lg-12">
    <?php if (Session::has('message')): ?>
    <div class="alert alert-<?php  echo e(Session::get('message_type')); ?>" id="waktu2" style="margin-top:10px;">
      <?php  echo e(Session::get('message')); ?>
    </div>
    <?php endif; ?>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12">
    <form method="GET" action="<?php echo e(route('kaskeluar.index')); ?>">
      <div class="row">
        <div class="col-md-3">
          <label for="start_month">Bulan Mulai</label>
          <input type="month" id="start_month" name="start_month" class="form-control" style="background-color: white"
            value="<?php echo e(isset($filterStartMonth) ? $filterStartMonth : ''); ?>">
        </div>
        <div class="col-md-3">
          <label for="end_month">Bulan Akhir</label>
          <input type="month" id="end_month" name="end_month" class="form-control" style="background-color: white"
            value="<?php echo e(isset($filterEndMonth) ? $filterEndMonth : ''); ?>">
        </div>
        <div class="col-md-3 align-self-end">
          <button type="submit" class="btn btn-primary">Filter</button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Kas Keluar</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead style="text-align: center">
              <tr>
                <th>
                  Tanggal
                </th>
                <th>
                  Kategori
                </th>
                <th>
                  Keterangan
                </th>
                <th>
                  Nominal
                </th>
                <th>
                  Action
                </th>
              </tr>
            </thead>
            <tbody style="text-align: center">
              <?php $__currentLoopData = $datas;
$__env->addLoop($__currentLoopData);
foreach ($__currentLoopData as $data):
  $__env->incrementLoopIndices();
  $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="py-1">
                  <?php  echo e($data->tgl); ?>
                </td>
                <td>
                  <?php  echo e($data->kategori === "operasional" ? "Operasional" : ($data->kategori === "makanan" ? "Makanan" : ($data->kategori === "lain" ? "Lainnya" : "-"))); ?>
                </td>
                <td>
                  <?php  echo e($data->keterangan); ?>
                </td>
                <td>
                  <?php  echo e($data->nominal); ?>
                </td>
                <td>
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start"
                      style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="<?php  echo e(route('kaskeluar.edit', $data->id)); ?>"> Edit </a>
                      <form action="<?php  echo e(route('kaskeluar.destroy', $data->id)); ?>" class="pull-left"
                        method="post">
                        <?php  echo e(csrf_field()); ?>

                        <?php  echo e(method_field('delete')); ?>

                        <button class="dropdown-item" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                          Delete
                        </button>
                      </form>

                    </div>
                  </div>
                </td>
              </tr>
              <?php endforeach;
$__env->popLoop();
$loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>