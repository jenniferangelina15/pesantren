<?php $__env->startSection('js'); ?>
 <script type="text/javascript">
   $(document).on('click', '.pilih', function (e) {
                document.getElementById("kostum").value = $(this).attr('data-kostum');
                document.getElementById("kostum_id").value = $(this).attr('data-kostum_id');
                $('#myModal').modal('hide');
            });

            $(document).on('click', '.pilih_customer', function (e) {
                document.getElementById("customer_id").value = $(this).attr('data-customer_id');
                document.getElementById("customer_nama").value = $(this).attr('data-customer_nama');
                $('#myModal2').modal('hide');
            });
          
             $(function () {
                $("#lookup, #lookup2").dataTable();
            });
            $(document).ready(function () {
    // Fungsi untuk menghitung tgl_kembali berdasarkan perubahan tgl_pinjam
    $(document).on('input', '#tgl_pinjam', function (e) {
        var daysToAdd = parseInt($('#days_to_add').val());
        var tglPinjam = new Date($(this).val());
        var tglKembali = new Date(tglPinjam);
        tglKembali.setDate(tglKembali.getDate() + daysToAdd);

        var day = ("0" + tglKembali.getDate()).slice(-2);
        var month = ("0" + (tglKembali.getMonth() + 1)).slice(-2);
        var tglKembaliStr = tglKembali.getFullYear() + "-" + month + "-" + day;

        $('#tgl_kembali').val(tglKembaliStr);
    });

    // Fungsi untuk menghitung tgl_kembali berdasarkan perubahan days_to_add
    $(document).on('input', '#days_to_add', function (e) {
        var daysToAdd = parseInt($(this).val());
        var tglPinjam = new Date($('#tgl_pinjam').val());
        var tglKembali = new Date(tglPinjam);
        tglKembali.setDate(tglKembali.getDate() + daysToAdd);

        var day = ("0" + tglKembali.getDate()).slice(-2);
        var month = ("0" + (tglKembali.getMonth() + 1)).slice(-2);
        var tglKembaliStr = tglKembali.getFullYear() + "-" + month + "-" + day;

        $('#tgl_kembali').val(tglKembaliStr);
    });

    // Set nilai awal untuk tgl_pinjam saat halaman dimuat
    var today = new Date();
    var day = ("0" + today.getDate()).slice(-2);
    var month = ("0" + (today.getMonth() + 1)).slice(-2);
    var year = today.getFullYear();
    var tglPinjamStr = year + "-" + month + "-" + day;
    $('#tgl_pinjam').val(tglPinjamStr);

    // Set nilai awal untuk tgl_kembali berdasarkan nilai awal tgl_pinjam dan days_to_add
    var daysToAdd = parseInt($('#days_to_add').val());
    var tglPinjam = new Date($('#tgl_pinjam').val());
    var tglKembali = new Date(tglPinjam);
    tglKembali.setDate(tglKembali.getDate() + daysToAdd);

    var dayKembali = ("0" + tglKembali.getDate()).slice(-2);
    var monthKembali = ("0" + (tglKembali.getMonth() + 1)).slice(-2);
    var tglKembaliStr = tglKembali.getFullYear() + "-" + monthKembali + "-" + dayKembali;
    $('#tgl_kembali').val(tglKembaliStr);

    // Logika JavaScript lainnya...
});


            $(document).ready(function () {
              // Fungsi untuk menghitung total harga
              function hitungTotalHarga() {
                  var daysToAdd = parseInt($('#days_to_add').val());
                  var hargaKostum = parseInt($('#kostum').attr('data-harga'));

                  if (!isNaN(daysToAdd) && !isNaN(hargaKostum)) {
                      var totalHarga = daysToAdd * hargaKostum;
                      $('#total_harga').val(totalHarga);
                  }
              }

              // Panggil fungsi hitungTotalHarga saat halaman pertama kali dimuat
              hitungTotalHarga();

              // Panggil fungsi hitungTotalHarga setiap kali nilai days_to_add atau data-harga berubah
              $('#days_to_add').on('input', function () {
                  hitungTotalHarga();
              });

              $(document).on('click', '.pilih', function (e) {
                  // Ambil harga kostum dari data attribute
                  var hargaKostum = parseInt($(this).attr('data-harga'));
                  // Set nilai input dan simpan harga ke dalam data attribute kostum
                  $('#kostum').val($(this).attr('data-kostum')).attr('data-harga', hargaKostum);
                  $('#kostum_id').val($(this).attr('data-kostum_id'));
                  $('#myModal').modal('hide');

                  // Hitung total harga kembali setelah memilih kostum
                  hitungTotalHarga();
              });
          });
        </script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('transaksi.store')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

<div class="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tambah Transaksi baru</h4>
                    
                        <div class="form-group<?php echo e($errors->has('kode_transaksi') ? ' has-error' : ''); ?>">
                            <label for="kode_transaksi" class="col-md-4 control-label">Kode Transaksi</label>
                            <div class="col-md-6">
                                <input id="kode_transaksi" type="text" class="form-control" name="kode_transaksi" value="<?php echo e($kode); ?>" required readonly="">
                                <?php if($errors->has('kode_transaksi')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('kode_transaksi')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                         <div class="form-group<?php echo ($errors->has('tgl_pinjam') ? ' has-error' : ''); ?>">
                            <label for="tgl_pinjam" class="col-md-4 control-label">Tanggal Sewa</label>
                            <div class="col-md-3">
                                <input id="tgl_pinjam" type="date" class="form-control" name="tgl_pinjam" value="<?php echo (date('Y-m-d', strtotime(Carbon\Carbon::today()->toDateString()))); ?>" required <?php if(Auth::user()->level == 'user'): ?>  <?php endif; ?>>
                                <?php if($errors->has('tgl_pinjam')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl_pinjam')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('days_to_add') ? ' has-error' : ''); ?>">
                                <label for="days_to_add" class="col-md-4 control-label">Jumlah Hari</label>
                                <div class="col-md-3">
                                    <input id="days_to_add" type="number" class="form-control" name="days_to_add" value="0" required>
                                    <?php if($errors->has('days_to_add')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('days_to_add')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                         <div class="form-group<?php echo e($errors->has('tgl_kembali') ? ' has-error' : ''); ?>">
                            <label for="tgl_kembali" class="col-md-4 control-label">Tanggal Kembali</label>
                            <div class="col-md-3">
                                <input id="tgl_kembali" type="date"  class="form-control" name="tgl_kembali" value="{{ date('Y-m-d', strtotime(Carbon\Carbon::today()->addDays(0)->toDateString())) }}" required="" readonly<?php if(Auth::user()->level == 'user'): ?>  <?php endif; ?>>
                                <?php if($errors->has('tgl_kembali')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('tgl_kembali')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('kostum_id') ? ' has-error' : ''); ?>">
                            <label for="kostum_id" class="col-md-4 control-label">Kostum</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="kostum" type="text" class="form-control" readonly="" required>
                                <input id="kostum_id" type="hidden" name="kostum_id" value="<?php echo e(old('kostum_id')); ?>" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-secondary" data-toggle="modal" data-target="#myModal"><b>Cari Kostum</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                <?php if($errors->has('kostum_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('kostum_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                 
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('customer_id') ? ' has-error' : ''); ?>">
                            <label for="customer_id" class="col-md-4 control-label">Customer</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                <input id="customer_nama" type="text" class="form-control" readonly="" required>
                                <input id="customer_id" type="hidden" name="customer_id" value="<?php echo e(old('customer_id')); ?>" required readonly="">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-secondary" data-toggle="modal" data-target="#myModal2"><b>Cari Customer</b> <span class="fa fa-search"></span></button>
                                </span>
                                </div>
                                <?php if($errors->has('customer_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('customer_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                 
                            </div>
                        </div>                        

                        <div class="form-group">
                          <label for="total_harga" class="col-md-4 control-label">Total Harga</label>
                          <div class="col-md-6">
                              <input id="total_harga" type="text" class="form-control" name="total_harga"  readonly>
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary" id="submit">
                                    Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                                    Reset
                        </button>
                        <a href="<?php echo e(route('transaksi.index')); ?>" class="btn btn-light pull-right">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

</div>
</form>


  <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Kostum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Kostum</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $kostums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="pilih" data-kostum_id="<?php echo $data->id; ?>" data-kostum="<?php echo $data->kostum; ?>" data-harga="<?php echo $data->harga; ?>">
                                    <td><?php if($data->gambar): ?>
                            <img src="<?php echo e(url('images/kostum/'. $data->gambar)); ?>" alt="image" style="margin-right: 10px;" />
                          <?php else: ?>
                            <img src="<?php echo e(url('images/kostum/default.png')); ?>" alt="image" style="margin-right: 10px;" />
                          <?php endif; ?>
                          <?php echo e($data->kostum); ?></td>
                                    <td><?php echo e($data->harga); ?></td>
                                    <td><?php echo e($data->jumlah_kostum); ?></td>
                                    <td><?php echo e($data->deskripsi); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>


  <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document" >
    <div class="modal-content" style="background: #fff;">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cari Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                        <table id="lookup" class="table table-bordered table-hover table-striped">
                            <thead>
                        <tr>
                          <th>
                            Nama
                          </th>
                          <th>
                            NIK
                          </th>
                          <th>
                            Jenis Kelamin
                          </th>
                          <th>
                            No HP
                          </th>
                        </tr>
                      </thead>
                            <tbody>
                                <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="pilih_customer" data-customer_id="<?php echo $data->id; ?>" data-customer_nama="<?php echo $data->nama; ?>" >
                                    <td class="py-1">
                            <?php echo e($data->nama); ?>

                          </td>
                          <td>
                            <?php echo e($data->nik); ?>

                          </td>
                          <td>
                            <?php echo e($data->jk === "L" ? "Laki - Laki" : "Perempuan"); ?>

                          </td>
                          <td>
                            <?php echo e($data->no_hp); ?>

                          </td>
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