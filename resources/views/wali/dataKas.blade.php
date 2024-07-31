<head>
    <style>
        td {
            padding-top: 5px;
        }
    </style>
</head>
<?php $__env->startSection('js'); ?>

<script type="text/javascript">

$(document).ready(function() {
    $(".users").select2();
});

</script>

<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 5
    });

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
                <div style="width: 35%">
                    <div class="card">
                        <div class="card-body">
                            <!-- Data Santri -->
                            <div class="mb-4">
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
                </div>
                <div style="width: 65%">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Data Kas Keluar</h4>
                        <form method="GET" action="<?php echo e(route('wali.dataKas')); ?>">
                            <div class="row">
                                <div class="col-md-3">
                                <label for="start_month" style="font-size: 12px">Bulan Mulai</label>
                                <input type="month" id="start_month" name="start_month" class="form-control" style="background-color: white"
                                    value="<?php echo e(isset($startMonth) ? $startMonth : ''); ?>">
                                </div>
                                <div class="col-md-3">
                                <label for="end_month" style="font-size: 12px">Bulan Akhir</label>
                                <input type="month" id="end_month" name="end_month" class="form-control" style="background-color: white"
                                    value="<?php echo e(isset($endMonth) ? $endMonth : ''); ?>">
                                </div>
                                <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                            </form>
                        <div class="table-responsive">
                        <table class="table table-striped" id="table">
                            <thead style="text-align: center">
                            <tr>
                                <th>Tanggal</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Nominal</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php $__currentLoopData = $kaskeluar;
                $__env->addLoop($__currentLoopData);
                foreach ($__currentLoopData as $kaskeluar):
                $__env->incrementLoopIndices();
                $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="py-1"><?php echo e($kaskeluar->tgl); ?></td>
                                <td>
                                <?php echo e($kaskeluar->kategori === "operasional" ? "Operasional" : ($kaskeluar->kategori === "makanan" ? "Makanan" : ($kaskeluar->kategori === "lain" ? "Lainnya" : "-"))); ?>

                                </td>
                                <td><?php echo e($kaskeluar->keterangan); ?></td>
                                <td>Rp. <?php echo e(number_format($kaskeluar->nominal)); ?></td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop();
                $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appWali', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
