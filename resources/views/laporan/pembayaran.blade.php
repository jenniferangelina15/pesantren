<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

    $(document).on('click', '.pilih', function (e) {
        document.getElementById("santri_id").value = $(this).attr('data-santri_id');
        document.getElementById("santri_nama").value = $(this).attr('data-santri_nama');
        document.getElementById("santri_kelas").value = $(this).attr('data-santri_kelas');
        $('#myModal').modal('hide');
    });

    $("#lookup").dataTable();
  });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row"></div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Laporan Pembayaran</h4>
        <form action="<?php echo e(route('pembayaranPdf')); ?>" method="GET">
          <div class="form-group<?php echo e($errors->has('kelas') ? ' has-error' : ''); ?>">
            <label for="kelas" class="col-md-4 control-label">Kelas</label>
            <div class="col-md-6">
              <select class="form-control" id="kelas" name="kelas">
                <option value="">Semua</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </div>
          </div>
          <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
            <label for="status" class="col-md-4 control-label">Status</label>
            <div class="col-md-6">
              <select class="form-control" name="status">
                <option value="">Semua</option>
                <option value="setuju">Telah Setuju</option>
                <option value="belum setuju">Belum Setuju</option>
              </select>
            </div>
          </div>
          <div class="form-group<?php echo e($errors->has('santri_id') ? ' has-error' : ''); ?>">
            <label for="santri_id" class="col-md-4 control-label">Santri</label>
            <div class="col-md-6">
              <div class="input-group">
                <input id="santri_nama" type="text" class="form-control" readonly required>
                <input id="santri_kelas" type="text" name="santri_kelas" class="form-control" readonly required>
                <input id="santri_id" type="hidden" name="santri_id" required readonly>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    <b>Cari Santri</b> <span class="fa fa-search"></span>
                  </button>
                </span>
              </div>
              <?php if ($errors->has('santri_id')) : ?>
                <span class="help-block">
                  <strong><?php echo e($errors->first('santri_id')); ?></strong>
                </span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary">
                Download PDF
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Santri</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Kelas</th>
              <th>NIK</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $santris; $__env->addLoop($__currentLoopData); foreach ($__currentLoopData as $data) : $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr class="pilih" data-santri_id="<?php echo e($data->id); ?>" data-santri_nama="<?php echo e($data->nama); ?>" data-santri_kelas="<?php echo e($data->kelas); ?>">
                <td><?php echo e($data->nama); ?></td>
                <td><?php echo e($data->kelas); ?></td>
                <td><?php echo e($data->nik); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
