<?php $__env->startSection('js'); ?>

<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

    // Grafik Kas Masuk vs Kas Keluar
    var ctxKas = document.getElementById('kasChart').getContext('2d');
    var kasChart = new Chart(ctxKas, {
      type: 'bar',
      data: {
        labels: ['Kas Masuk', 'Kas Keluar'],
        datasets: [{
          label: 'Nominal',
          data: [<?php echo e($totalKasMasuk); ?>, <?php echo e($totalKasKeluar); ?>],
          backgroundColor: ['rgba(44, 137, 44, 0.8)', 'rgba(44, 137, 44, 0.4)'],
          borderColor: ['rgba(44, 137, 44, 1)', 'rgba(44, 137, 44, 1)'],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Grafik Pembayaran
    var ctxPembayaran = document.getElementById('pembayaranChart').getContext('2d');
    var pembayaranChart = new Chart(ctxPembayaran, {
      type: 'pie',
      data: {
        labels: ['Setuju', 'Belum Setuju'],
        datasets: [{
          label: 'Jumlah',
          data: [<?php echo e($pembayaran->where('status', 'setuju')->count()); ?>, <?php echo e($pembayaran->where('status', 'belum setuju')->count()); ?>],
          backgroundColor: ['rgba(44, 137, 44, 0.5)', 'rgba(44, 137, 44, 0.8)'],
          borderColor: ['rgba(44, 137, 44, 1)', 'rgba(44, 137, 44, 1)'],
          borderWidth: 1
        }]
      }
    });

    // Grafik Status Santri
    var ctxSantri = document.getElementById('santriChart').getContext('2d');
    var santriChart = new Chart(ctxSantri, {
      type: 'doughnut',
      data: {
        labels: ['Tagih', 'Cek', 'Lunas'],
        datasets: [{
          label: 'Jumlah',
          data: [
            <?php echo e($santri->where('status', 'tagih')->count()); ?>,
            <?php echo e($santri->where('status', 'cek')->count()); ?>,
            <?php echo e($santri->where('status', 'lunas')->count()); ?>
          ],
          backgroundColor: ['rgba(44, 137, 44, 0.4)', 'rgba(44, 137, 44, 0.6)', 'rgba(44, 137, 44, 0.8)'],
          borderColor: ['rgba(44, 137, 44, 1)', 'rgba(44, 137, 44, 1)', 'rgba(44, 137, 44, 1)'],
          borderWidth: 1
        }]
      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<head>
  <style>
    #pembayaranChart {
      width: 50% !important;
      height: 50% !important;
    }

    #santriChart {
      width: 50% !important;
      height: 50% !important;
    }
  </style>
</head>
<div class="row">
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body pl-5 pr-5">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-book text-primary icon-lg" style="width: 60px;height: 60px;"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Kas</p>
            <div class="fluid-container">
              <h3 class="font-weight-large text-primary text-right mb-0">Rp.
                <?php echo e(number_format($totalKasMasuk - $totalKasKeluar), 2); ?>
              </h3>
            </div>
          </div>
        </div>
        <table class="table table-sm mt-2" style="text-align: center; color: #2e482e">
          <tr class="thead">
            <th class="p-2">Kas Masuk</th>
            <th>Kas Keluar</th>
          </tr>
          <tr>
            <td class="mr-1 p-2">Rp. <?php echo e(number_format($totalKasMasuk), 2); ?></td>
            <td class="mr-1">Rp. <?php echo e(number_format($totalKasKeluar), 2); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body pl-5 pr-5">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-primary icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Pembayaran</p>
            <div class="fluid-container">
              <h3 class="font-weight-large text-primary text-right mb-0"><?php echo e($pembayaran->count()); ?> data
              </h3>
            </div>
          </div>
        </div>
        <table class="table table-sm mt-2" style="text-align: center; color: #2e482e">
          <tr class="thead">
            <th class="p-2">Setuju</th>
            <th>Belum Setuju</th>
          </tr>
          <tr>
            <td class="mr-1 p-2"><?php echo e($pembayaran->where('status', 'setuju')->count()); ?></td>
            <td class="mr-1"> <?php echo e($pembayaran->where('status', 'belum setuju')->count()); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body pl-5 pr-5">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-account-location text-primary icon-lg"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Santri</p>
            <div class="fluid-container">
              <h3 class="font-weight-large text-primary text-right mb-0"><?php echo e($santri->count()); ?> orang</h3>
            </div>
          </div>
        </div>
        <table class="table table-sm mt-2" style="text-align: center; color: #2e482e">
          <tr class="thead">
            <th class="p-2">Tagih</th>
            <th>Cek</th>
            <th>Lunas</th>
          </tr>
          <tr>
            <td class="mr-1 p-2"><?php echo e($santri->where('status', 'tagih')->count()); ?></td>
            <td class="mr-1"> <?php echo e($santri->where('status', 'cek')->count()); ?></td>
            <td class="mr-1"> <?php echo e($santri->where('status', 'lunas')->count()); ?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <!-- Grafik Kas Masuk vs Kas Keluar -->
      <div class="">
        <div class="card card-statistics">
          <div class="card-body">
            <h4 class="card-title">Kas Masuk vs Kas Keluar</h4>
            <center>
              <canvas id="kasChart" style="weight: 500px"></canvas>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <!-- Grafik Pembayaran -->
      <div class="">
        <div class="card card-statistics">
          <div class="card-body">
            <h4 class="card-title">Status Pembayaran</h4>
            <center>
              <canvas id="pembayaranChart"></canvas>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <!-- Grafik Status Santri -->
      <div class="chart-container">
        <div class="card card-statistics">
          <div class="card-body">
            <h4 class="card-title">Status Santri</h4>
            <center>
              <canvas id="santriChart"></canvas>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Data Pembayaran belum setuju</h4>
        <div class="table-responsive">
          <table class="table table-striped" id="table">
            <thead>
              <tr>
                <th>
                  Kode
                </th>
                <th>
                  Nama Santri
                </th>
                <th>
                  Kelas
                </th>
                <th>
                  Bulan
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $datas;
$__env->addLoop($__currentLoopData);
foreach ($__currentLoopData as $data):
  $__env->incrementLoopIndices();
  $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="py-1">
                  <a href="<?php  echo e(route('pembayaran.edit', $data->id)); ?>">
                    <?php  echo e($data->kode_pembayaran); ?>

                  </a>
                </td>
                <td>
                  <?php  echo e($data->santri->nama); ?>

                </td>
                <td>
                  <?php  echo e($data->santri->kelas); ?>

                </td>
                <td>
                  <?php  echo e($data->bulan); ?>

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