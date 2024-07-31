<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 20
    });
  });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-lg-2">
    <a href="<?php echo e(route('pembayaran.create')); ?>" class="btn btn-primary btn-rounded btn-fw"><i
        class="fa fa-plus"></i>
      Tambah Pembayaran</a>
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
    <form method="GET" action="<?php echo e(route('pembayaran.index')); ?>">
      <div class="row">
        <div class="col-md-3">
          <label for="filter_month">Bulan</label>
          <select id="filter_month" name="filter_month" class="form-control" style="background-color: white">
            <option value="">Semua Bulan</option>
            <option value="januari" <?php echo e(isset($filterMonth) && $filterMonth == 'januari' ? 'selected' : ''); ?>>
              Januari</option>
            <option value="februari" <?php echo e(isset($filterMonth) && $filterMonth == 'februari' ? 'selected' : ''); ?>>Februari</option>
            <option value="maret" <?php echo e(isset($filterMonth) && $filterMonth == 'maret' ? 'selected' : ''); ?>>Maret
            </option>
            <option value="april" <?php echo e(isset($filterMonth) && $filterMonth == 'april' ? 'selected' : ''); ?>>April
            </option>
            <option value="mei" <?php echo e(isset($filterMonth) && $filterMonth == 'mei' ? 'selected' : ''); ?>>Mei
            </option>
            <option value="juni" <?php echo e(isset($filterMonth) && $filterMonth == 'juni' ? 'selected' : ''); ?>>Juni
            </option>
            <option value="juli" <?php echo e(isset($filterMonth) && $filterMonth == 'juli' ? 'selected' : ''); ?>>Juli
            </option>
            <option value="agustus" <?php echo e(isset($filterMonth) && $filterMonth == 'agustus' ? 'selected' : ''); ?>>
              Agustus</option>
            <option value="september" <?php echo e(isset($filterMonth) && $filterMonth == 'september' ? 'selected' : ''); ?>>September</option>
            <option value="oktober" <?php echo e(isset($filterMonth) && $filterMonth == 'oktober' ? 'selected' : ''); ?>>
              Oktober</option>
            <option value="november" <?php echo e(isset($filterMonth) && $filterMonth == 'november' ? 'selected' : ''); ?>>November</option>
            <option value="desember" <?php echo e(isset($filterMonth) && $filterMonth == 'desember' ? 'selected' : ''); ?>>Desember</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="filter_year">Tahun</label>
          <input type="number" id="filter_year" name="filter_year" class="form-control"
            style="padding-top: 11px; padding-bottom: 11px; background-color:white" min="2020" max="2100"
            value="<?php echo e(isset($filterYear) ? $filterYear : '2024'); ?>">
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
        <h4 class="card-title">Data Pembayaran</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead style="text-align: center">
              <tr>
                <th>Kode Pembayaran</th>
                <th>Nama Santri</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Nominal</th>
                <th>Status Pembayaran</th>
                <th>Action</th>
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
                  <a
                    href="<?php  echo e(route('pembayaran.show', $data->id)); ?>"><?php  echo e($data->kode_pembayaran); ?></a>
                </td>
                <td><?php  echo e($data->santri->nama); ?></td>
                <td><?php  echo e($data->kelas); ?></td>
                <td><?php  echo e($data->bulan); ?></td>
                <td>Rp. <?php  echo e(number_format($data->nominal), 2); ?></td>
                <td style="text-align: center">
                  <?php  if ($data->status == 'belum setuju'): ?>
                  <label class="badge badge-warning" style="font-size: 0.8rem;">Belum Setuju</label>
                  <?php  else: ?>
                  <label class="badge badge-success" style="font-size: 0.8rem;">Setuju</label>
                  <?php  endif; ?>
                </td>
                <td style="text-align: center">
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-toggle="dropdown"
                      aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                      <a class="dropdown-item" href="<?php  echo e(route('pembayaran.edit', $data->id)); ?>"> Edit </a>
                      <form action="<?php  echo e(route('pembayaran.destroy', $data->id)); ?>" class="pull-left"
                        method="post">
                        <?php  echo e(csrf_field()); ?>

                        <?php  echo e(method_field('delete')); ?>

                        <button class="dropdown-item"
                          onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
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