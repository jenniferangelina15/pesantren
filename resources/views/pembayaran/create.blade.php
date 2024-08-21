<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    $(document).on('click', '.pilih', function (e) {
        document.getElementById("santri_id").value = $(this).attr('data-santri_id');
        document.getElementById("santri_nama").value = $(this).attr('data-santri_nama');
        document.getElementById("santri_kelas").value = $(this).attr('data-santri_kelas');
        $('#myModal').modal('hide');
    });

    $(function () {
        $("#lookup").dataTable();
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
        $("#f").submit(function () {
            // do ajax submit or just classic form submit
            //  alert("fake subminting")
            return false
        })
    })
</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('pembayaran.store')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tambah Pembayaran baru</h4>
                            <div
                                class="form-group<?php echo e($errors->has('kode_pembayaran') ? ' has-error' : ''); ?>">
                                <label for="kode_pembayaran" class="col-md-4 control-label">Kode Pembayaran</label>
                                <div class="col-md-6">
                                    <input id="kode_pembayaran" type="text" class="form-control" name="kode_pembayaran"
                                        value="<?php echo e($kode); ?>" required readonly="">
                                    <?php if ($errors->has('kode_pembayaran')): ?>
                                    <span class="help-block">
                                        <strong><?php    echo e($errors->first('kode_pembayaran')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('santri_id') ? ' has-error' : '' }}">
                                <label for="santri_id" class="col-md-4 control-label">Santri</label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input id="santri_nama" type="text" class="form-control"
                                            value="{{ $santri ? $santri->nama : '' }}" readonly required>
                                        <input id="santri_kelas" type="text" name="kelas" class="form-control"
                                            value="{{ $santri ? $santri->kelas : '' }}" readonly required>
                                        <input id="santri_id" type="hidden" name="santri_id"
                                            value="{{ $santri ? $santri->id : old('santri_id') }}" required readonly>
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#myModal"><b>Cari Santri</b> <span
                                                    class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                    @if ($errors->has('santri_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('santri_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group<?php echo ($errors->has('bulan') ? ' has-error' : ''); ?>">
                                <label for="bulan" class="col-md-4 control-label">Bulan</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="bulan" required="">
                                        <option value=""></option>
                                        <option value="januari">Januari</option>
                                        <option value="februari">Februari</option>
                                        <option value="maret">Maret</option>
                                        <option value="april">April</option>
                                        <option value="mei">Mei</option>
                                        <option value="juni">Juni</option>
                                        <option value="juli">Juli</option>
                                        <option value="agustus">Agustus</option>
                                        <option value="september">September</option>
                                        <option value="oktober">Oktober</option>
                                        <option value="november">November</option>
                                        <option value="desember">Desember</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nominal" class="col-md-4 control-label">Nominal</label>
                                <div class="col-md-6">
                                    <input id="nominal" type="text" class="form-control" name="nominal" value="500000">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bukti" class="col-md-4 control-label">Bukti</label>
                                <div class="col-md-6">
                                    <img width="200" height="200" />
                                    <input type="file" class="uploads form-control" style="margin-top: 20px;" name="bukti" accept="image/jpeg, image/png, image/jpg" required>
                                    <p class="text-gray" style="font-size: 12px; font-style: italic">Jenis file : jpg/jpeg/png | Ukuran maks : 3mb</p>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                <label for="status" class="col-md-4 control-label">Status Pembayaran</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status" required="">
                                        <option value="setuju">Setuju</option>
                                        <option value="belum setuju" selected>Belum Setuju</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" id="submit">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-danger">
                                Reset
                            </button>
                            <a href="<?php echo e(route('pembayaran.index')); ?>"
                                class="btn btn-light pull-right">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
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
                        <?php $__currentLoopData = $santris;
$__env->addLoop($__currentLoopData);
foreach ($__currentLoopData as $data):
    $__env->incrementLoopIndices();
    $loop = $__env->getLastLoop(); ?>
                        <tr class="pilih" data-santri_id="<?php    echo $data->id; ?>"
                            data-santri_nama="<?php    echo $data->nama; ?>"
                            data-santri_kelas="<?php    echo $data->kelas; ?>">
                            <td><?php    echo e($data->nama); ?></td>
                            <td><?php    echo e($data->kelas); ?></td>
                            <td><?php    echo e($data->nik); ?></td>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
document.querySelector('input[name="bukti"]').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        if (!['image/jpeg', 'image/png', 'image/jpg'].includes(file.type)) {
            alert('Tipe file tidak valid. Hanya jpeg, jpg, dan png yang diperbolehkan.');
            event.target.value = ''; // Clear the input
            return;
        }
        if (file.size > 3 * 1024 * 1024) { // 3MB in bytes
            alert('Ukuran file maksimal adalah 3MB.');
            event.target.value = ''; // Clear the input
            return;
        }

        // Preview the image
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('bukti-preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});