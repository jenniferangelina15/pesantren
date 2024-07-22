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

  <div class="col-lg-12">
    <?php if(Session::has('message')): ?>
    <div class="alert alert-<?php echo e(Session::get('message_type')); ?>" id="waktu2" style="margin-top:10px;">
      <?php echo e(Session::get('message')); ?></div>
  <?php endif; ?>
  </div>
</div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Data Pembayaran <b><?php echo e($data->nama); ?></b> </h4>

        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kelas
                </th>
                <th>
                  Bulan
                </th>
                <th>
                  Status
                </th>
                <th>
                  Bukti
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
          <td class="py-1">
            <?php echo e($data->pembayaran->kelas); ?>

          </td>

          <td>
            <?php echo e($data->kelas); ?>

          </td>
          <td>
            <?php echo e($data->jk === "L" ? "Laki - Laki" : "Perempuan"); ?>

          </td>
          <td>
            <?php echo e($data->status); ?>
          </td>
          <td>
          <a href="<?php echo e(route('santri.showPembayaran', $data->id)); ?>">
            <?php echo e($data->nik); ?>

            </a>
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