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
    <div class="col-md-12 d-flex align-items-stretch grid-margin">
        <div class="row flex-grow">
            <div style="width: 50%">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Detail <b><?php echo e($data->nama); ?></b></h4>
                            <form class="forms-sample" >
                                <div class="form-group<?php echo e($errors->has('nama') ? ' has-error' : ''); ?>">
                                    <label for="nama" class="col-md-4 control-label">Nama</label>
                                    <div class=" pl-2">
                                        <input id="nama" type="text" class="form-control" name="nama" value="<?php echo e($data->nama); ?>" readonly>
                                        <?php if($errors->has('nama')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('nama')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group<?php echo e($errors->has('nik') ? ' has-error' : ''); ?>">
                                    <label for="nik" class="col-md-4 control-label">NIK</label>
                                    <div class="pl-2">
                                        <input id="nik" type="number" class="form-control" name="nik" value="<?php echo e($data->nik); ?>" maxlength="8" readonly>
                                        <?php if($errors->has('nik')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('nik')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="form-group<?php echo e($errors->has('kelas') ? ' has-error' : ''); ?>">
                                    <label for="kelas" class="col-md-4 control-label">Kelas</label>
                                    <div class="pl-2">
                                        <input id="kelas" type="integer" class="form-control" name="kelas" value="<?php echo e($data->kelas); ?>" readonly>
                                        <?php if($errors->has('kelas')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('kelas')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('bulan_tagihan') ? ' has-error' : ''); ?>">
                                    <label for="bulan_tagihan" class="col-md-4 control-label">Sisa Bulan Tagihan</label>
                                    <div class="pl-2">
                                        <input id="bulan_tagihan" type="integer" class="form-control" name="bulan_tagihan" value="<?php echo e($data->bulan_tagihan); ?>" readonly>
                                        <?php if($errors->has('bulan_tagihan')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('bulan_tagihan')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('wali') ? ' has-error' : ''); ?>">
                                    <label for="wali" class="col-md-4 control-label">Nama Wali</label>
                                    <div class="pl-2">
                                        <input id="wali" type="string" class="form-control" name="wali" value="<?php echo e($data->wali);  ?>" readonly>
                                        <?php if($errors->has('wali')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('wali')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('alamat') ? ' has-error' : ''); ?>">
                                    <label for="alamat" class="col-md-4 control-label">Alamat</label>
                                    <div class="pl-2">
                                        <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo e($data->alamat);  ?>" readonly>
                                        <?php if($errors->has('alamat')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('alamat')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('no_hp') ? ' has-error' : ''); ?>">
                                    <label for="no_hp" class="col-md-4 control-label">No HP</label>
                                    <div class="pl-2">
                                        <input id="no_hp" type="text" class="form-control" name="no_hp" value="<?php echo e($data->no_hp);  ?>" readonly>
                                        <?php if($errors->has('no_hp')): ?>
                                            <span class="help-block">
                                                <strong><?php echo e($errors->first('no_hp')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('jk') ? ' has-error' : ''); ?>">
                                    <label for="jk" class="col-md-4 control-label">Jenis Kelamin</label>
                                    <div class="pl-2">
                                    <select class="form-control" name="jk" required="" disabled="">
                                        <option value=""></option>
                                        <option value="L" <?php echo e($data->jk === "L" ? "selected" : ""); ?>>Laki - Laki</option>
                                        <option value="P" <?php echo e($data->jk === "P" ? "selected" : ""); ?>>Perempuan</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group<?php echo e($errors->has('status') ? ' has-error' : ''); ?>">
                                    <label for="status" class="col-md-4 control-label">Status Pembayaran</label>
                                    <div class="pl-2">
                                    <select class="form-control" name="status" required="" disabled="">
                                        <option value=""></option>
                                        <option value="tagih" <?php echo e($data->status === "tagih" ? "selected" : ""); ?>>Tagih</option>
                                        <option value="cek" <?php echo e($data->status === "cek" ? "selected" : ""); ?>>Cek</option>
                                        <option value="lunas" <?php echo e($data->status === "lunas" ? "selected" : ""); ?>>Lunas</option>
                                    </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 50%">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex mb-2" style="justify-content:space-between">
                                <div style="padding-top: 10px">
                                    <h4 class="card-title">Pembayaran <b><?php echo e($data->nama); ?></b></h4>
                                </div>
                                <div>
                                    @if ($data->bulan_tagihan > 0)
                                    <div style="margin-bottom:10px">
                                        <a href="<?php echo e(route('pembayaran.create', ['santri_id' => $data->id])); ?>" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i>
                                            Tambah Pembayaran</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <!-- Filter Kelas -->
                                <div class="col-md-3">
                                    <select id="kelasFilter" class="form-control">
                                        @foreach ($kelasOptions as $kelas)
                                            <option value="{{ $kelas }}">{{ "Kelas $kelas" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- Tabel Pembayaran -->
                                <table class="table table-striped" id="table">
                                    <thead style="text-align: center">
                                        <tr>
                                            <th>Kode Bayar</th>
                                            <th>Bulan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center">
                                        @foreach ($pembayarans as $pembayaran)
                                            <tr data-kelas="{{ $pembayaran->kelas }}" 
                                                class="{{ $data->kelas == $pembayaran->kelas ? 'kelas-aktif' : '' }}">
                                                <td>
                                                    <a href="{{ route('pembayaran.edit', $pembayaran->id) }}">
                                                        {{ $pembayaran->kode_pembayaran }}
                                                    </a>
                                                </td>
                                                <td>{{ $pembayaran->bulan }}</td>
                                                <td>
                                                    @if($pembayaran->status == 'belum setuju')
                                                        <label class="badge badge-warning" style="font-size: 0.8rem;">Belum Setuju</label>
                                                    @elseif($pembayaran->status == 'setuju')
                                                        <label class="badge badge-success" style="font-size: 0.8rem;">Setuju</label>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="<?php echo e(route('santri.index')); ?>" class="btn btn-light" center>Back</a>
            @if ($data->bulan_tagihan == 0)
                <a href="{{ route('santri.updateKelas', $data->id) }}" class="btn btn-primary" onclick="return confirm('Anda yakin ingin update kelas?')">
                    Update Kelas 
                </a>
            @endif
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
function updateKelas(id) {
    if (confirm('Apakah Anda yakin ingin memperbarui kelas dan bulan tagihan?')) {
        window.location.href = '/santri/updateKelas/' + id;
    }
}
</script>

<script type="text/javascript">
    $(document).ready(function () {
        // Menyaring tabel berdasarkan pilihan kelas
        $('#kelasFilter').on('change', function () {
            var selectedClass = $(this).val();
            
            $('#table tbody tr').each(function () {
                var rowClass = $(this).data('kelas');
                
                if (selectedClass === "" || rowClass == selectedClass) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Menampilkan data pembayaran untuk kelas santri saat ini secara default
        var defaultClass = "{{ $data->kelas }}";
        if (defaultClass) {
            $('#kelasFilter').val(defaultClass).trigger('change');
        }
    });
</script>

