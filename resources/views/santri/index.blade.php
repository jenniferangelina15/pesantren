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
    <a href="<?php echo e(route('santri.create')); ?>" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i>
      Tambah Santri</a>
  </div>
  <div class="col-lg-2">
    <a href="{{ route('santri.updateStatus') }}" class="btn btn-primary btn-rounded btn-fw"
      onclick="return confirm('Anda yakin ingin update status?')">
      <i class="fa fa-refresh"></i>Update Status
    </a>
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
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Santri</h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead style="text-align: center">
              <tr>
                <th>
                  NIK
                </th>
                <th>
                  Nama
                </th>
                <th>
                  Kelas
                </th>
                <th>
                  Jenis Kelamin
                </th>
                <th>
                  Sisa Tagihan
                </th>
                <th>
                  Bulan Ini
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
                <td>
                  <a href="<?php  echo e(route('santri.show', $data->id)); ?>">
                    <?php  echo e($data->nik); ?>
                  </a>
                </td>
                <td class="py-1">
                  <?php  echo e($data->nama); ?>

                </td>

                <td>
                  <?php  echo e($data->kelas); ?>
                </td>
                <td>
                  <?php  echo e($data->jk === "L" ? "Laki - Laki" : "Perempuan"); ?>
                </td>
                <td>
                  <?php  echo e($data->bulan_tagihan); ?>
                </td>
                <td>
                  <?php  if ($data->status == 'tagih'): ?>
                  <label class="badge badge-danger" style="font-size: 0.8rem;">Tagih</label>
                  <?php  elseif ($data->status == 'cek'): ?>
                  <label class="badge badge-warning" style="font-size: 0.8rem;">Cek</label>
                  <?php  else: ?>
                  <label class="badge badge-success" style="font-size: 0.8rem;">Lunas</label>
                  <?php  endif; ?>

                </td>
                <td>
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start"
                      style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 30px, 0px);">
                      <a class="dropdown-item" href="<?php  echo e(route('santri.edit', $data->id)); ?>"> Edit </a>
                      <form action="<?php  echo e(route('santri.destroy', $data->id)); ?>" class="pull-left"
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