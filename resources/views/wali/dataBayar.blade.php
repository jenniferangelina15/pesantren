<head>
    <style>
        td {
            padding-top: 5px;
        }
        .collapse-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out;
        }
        .collapse-content.show {
            max-height: 500px; /* Adjust based on content height */
        }
    </style>
</head>
<?php $__env->startSection('js'); ?>
<!-- Scripts -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/misc.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".users").select2();
    });
    document.getElementById('kelasFilter').addEventListener('change', function() {
        var selectedClass = this.value;
        var rows = document.querySelectorAll('#table tbody tr');
        rows.forEach(function(row) {
            if (selectedClass === '' || row.dataset.kelas === selectedClass) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).prev().attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(function () {
        $(".uploads").change(function() {
            readURL(this);
        });
    });

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
        var defaultClass = "{{ $santri->kelas }}";
        if (defaultClass) {
            $('#kelasFilter').val(defaultClass).trigger('change');
        }
    });
    $(document).ready(function() {
        $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var kodePembayaran = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);

            // AJAX request to get payment details
            $.ajax({
                url: '/get-pembayaran-details', // Update with your route
                type: 'GET',
                data: { kode_pembayaran: kodePembayaran },
                success: function(data) {
                    // Update modal with the data
                    modal.find('#kode_pembayaran').val(data.kode_pembayaran);
                    modal.find('#santri_nama').val(data.santri.nama);
                    modal.find('#santri_kelas').val(data.santri.kelas);
                    modal.find('select[name="bulan"]').val(data.bulan);
                    modal.find('input[name="status"]').val(data.status);
                    modal.find('input[name="nominal"]').val(data.nominal);
                    if(data.bukti) {
                        modal.find('img').attr('src', '/images/pembayaran/' + data.bukti);
                    } else {
                        modal.find('img').attr('src', '');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Optionally, show an alert or some error message
                }
            });
        });
    });

    function readURL() {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).prev().attr('src', e.target.result);}
            reader.readAsDataURL(input.files[0]);}
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
    <!-- Alert Message -->
    @if ($santri->status === 'tagih')
    <div class="alert alert-danger mt-2 mb-2">
        Tagihan bulan ini belum dibayar !
    </div>
    <button id="collapseButton" class="btn btn-primary">Lihat Cara Pembayaran</button>
    <div id="collapseContent" class="collapse-content">
        <div class="card ml-0 mr-0 col-7">
            <div class="p-4" style="border-radius: 5px;">
                <p>Berikut tata cara pembayaran SPP Pondok Pesantren Al Majidiyah:</p>
                <p>1. Salin nomor rekening yang tertera</p>
                <p>2. Lakukan pembayaran pada ATM/Brilink terdekat</p>
                <p>3. Klik Tambah Pembayaran dan upload bukti pembayaran anda saat periode dibuka</p>
                <p>4. Tunggu hasil pengecekan dari bendahara</p>
                <p>5. Silahkan menghubungi ke nomor WA tertera apabila memiliki kendala</p>
                <input type="text" id="rekToCopy" class="form-control" value="11223344" style="position: absolute; left: -9999px;">
                <input type="text" id="WAToCopy" class="form-control" value="0761-112233" style="position: absolute; left: -9999px;">
                <center>
                    <button id="copyRekButton" class="btn col-4 btn-primary mb-2">Salin Nomor Rekening</button><br>
                    <button id="copyWAButton" class="btn col-4 btn-primary">Salin Nomor WA</button>
                </center>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('collapseButton').addEventListener('click', function() {
            var content = document.getElementById('collapseContent');
            if (content.classList.contains('show')) {
                content.classList.remove('show');
            } else {
                content.classList.add('show');
            }
        });

        document.getElementById('copyRekButton').addEventListener('click', function() {
            var rekToCopy = document.getElementById('rekToCopy');
            rekToCopy.select();
            rekToCopy.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
            alert('Nomor rekening telah disalin!');
        });

        document.getElementById('copyWAButton').addEventListener('click', function() {
            var textToCopy = document.getElementById('WAToCopy');
            WAToCopy.select();
            WAToCopy.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
            alert('Nomor WA telah disalin!');
        });
    </script>
    @endif    
    <div class="row">
        <div class="col-md-12 d-flex align-items-stretch grid-margin">
            <div class="row flex-grow">
                <div style="width: 35%">
                    <div class="card">
                        <div class="card-body">
                            <!-- Data Santri -->
                            <div class="mb-4">
                            <div class="mb-3">
                                <h4>Data <b><?php echo e($santri->nama); ?></b></h4>
                            </div>
                            <table>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Nama
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->nama }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    NIK
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->nik }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Kelas
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->kelas }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Alamat
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    No HP
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->no_hp }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Jenis Kelamin
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                        @if($santri->jk == 'L')
                                            Laki-Laki
                                        @elseif($santri->jk == 'P')
                                            Perempuan
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Sisa Tagihan
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                    {{ $santri->bulan_tagihan }} bulan
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-4 control-label card-title">
                                    Status Bulan Ini
                                    </td>
                                    <td class="col-md-4 control-label card-title">
                                        @if($santri->status == 'tagih')
                                            <label class="badge-danger pl-1 pr-1" style="border-radius: 5px">Belum Pembayaran</label> 
                                        @elseif($santri->status == 'cek')
                                            <label class="badge-warning pl-1 pr-1" style="border-radius: 5px">Dalam Pengecekan</label>
                                        @elseif($santri->status == 'lunas')
                                            <label class="badge-success pl-1 pr-1" style="border-radius: 5px">Lunas</label>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div style="width: 65%">
                    <div class="card">
                        <div class="card-body">
                            <!-- Data Santri -->
                            <div class="mb-3">
                                <h4>Pembayaran <b><?php echo e($santri->nama); ?></b></h4>
                            </div>
                            <?php
                                // Hitung jumlah pembayaran santri di kelas saat ini
                                $jumlahPembayaran = \App\Pembayaran::where('santri_id', $santri->id)
                                                    ->where('kelas', $santri->kelas)
                                                    ->count();
                            ?>

                            @if($jumlahPembayaran < 12)
                                <!-- Button to open the upload modal -->
                                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#uploadModal">
                                    Tambah Pembayaran
                                </button>
                            @endif
                            <!-- Filter Kelas -->
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <select id="kelasFilter" class="form-control" style="background-color: white">
                                        <option value="">Semua Kelas</option>
                                        @foreach ($kelasOptions as $kelas)
                                            <option value="{{ $kelas }}">{{ "Kelas $kelas" }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @if($pembayarans->isEmpty())
                                <p class="text-center">Data pembayaran kosong</p>
                            @else
                            <div class="table-responsive">
                                <!-- Tabel Pembayaran -->
                                <table class="table table-striped" id="table">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Kode Bayar</th>
                                            <th>Bulan</th>
                                            <th>Kelas</th>
                                            <th>Status</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($pembayarans as $pembayaran)
                                        <tr data-kelas="{{ $pembayaran->kelas }}">
                                            <td>{{ $pembayaran->kode_pembayaran }}</td>
                                            <td>{{ $pembayaran->bulan }}</td>
                                            <td>{{ $pembayaran->kelas }}</td>
                                            <td>
                                                @if($pembayaran->status == 'belum setuju')
                                                    <label class="badge badge-warning" style="font-size: 0.8rem;">Belum Setuju</label>
                                                @elseif($pembayaran->status == 'setuju')
                                                    <label class="badge badge-success" style="font-size: 0.8rem;">Setuju</label>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Contoh button di tabel -->
                                                <button type="button" class="btn btn-primary detail-btn" data-toggle="modal" data-target="#detailModal" data-id="{{ $pembayaran->kode_pembayaran }}">
                                                    Lihat Detail
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Modal -->
    @php
        $bulanIndonesia = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $bulanSaatIni = $bulanIndonesia[date('n')];
    @endphp
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Tambah Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('wali.storeWali') }}" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>
                    <div class="modal-body">
                        <input id="kode_pembayaran" type="text" class="form-control" name="kode_pembayaran" value="{{ $kode }}" hidden readonly>
                        <div class="form-group">
                            <label for="santri_nama" class="form-label">Nama Santri</label>
                            <input id="santri_nama" type="text" class="form-control" value="{{ $santri->nama }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="santri_kelas" class="form-label">Kelas</label>
                            <input id="santri_kelas" type="text" name="kelas" class="form-control" value="{{ $santri->kelas }}" readonly>
                        </div>
                        <input id="santri_id" type="hidden" name="santri_id" value="{{ $santri->id }}" readonly>
                        <div class="form-group">
                            <label for="santri_kelas" class="form-label">Kelas</label>
                            <select class="form-control" name="bulan" required="">
                                <option value=""></option>
                                <?php foreach ($bulanIndonesia as $key => $bulan): ?>
                                    <option value="<?php echo e(strtolower($bulan)); ?>" <?php echo e(strtolower($bulan) == strtolower($bulanSaatIni) ? 'selected' : ''); ?>>
                                        <?php echo e($bulan); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bukti" class="form-label">Bukti Pembayaran</label>
                            <br>
                            <img width="200" height="200" class="mb-2" id="bukti-preview" />
                            <input type="file" class="uploads form-control" name="bukti" accept="image/jpeg, image/png, image/jpg" required>
                            <p class="text-gray" style="font-size: 12px; font-style: italic">Jenis file : jpg/jpeg/png | Ukuran maks : 3mb</p>
                            @if ($errors->has('bukti'))
                                <div class="alert alert-danger mt-2">
                                    {{ $errors->first('bukti') }}
                                </div>
                            @endif
                        </div>
                        <input type="hidden" name="status" value="belum setuju">
                        <input type="hidden" name="nominal" value="500000">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>      
    @if($pembayarans->isEmpty())
        <p class="text-center"></p>
    @else
    <!-- Detail modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="forms-sample">
                    <?php echo e(csrf_field()); ?>
                    <div class="modal-body">
                        <input id="kode_pembayaran" type="text" class="form-control" name="kode_pembayaran" value="<?php echo e($pembayaran->kode_pembayaran);?>" hidden readonly>
                        <div class="form-group">
                            <label for="kelas" class="col-md-4 control-label">Kelas</label>
                            <input id="santri_kelas" type="text" name="kelas" class="form-control" value="<?php echo e($santri->kelas);?>" readonly>
                        </div>
                        <input id="santri_id" type="hidden" name="santri_id" value="<?php echo e($santri->id);?>" readonly>
                        <div class="form-group<?php echo ($errors->has('bulan') ? ' has-error' : ''); ?>">
                            <label for="bulan" class="col-md-4 control-label">Bulan</label>
                                <select class="form-control" name="bulan" required="" disabled="">
                                    <option value="januari" <?php echo e($pembayaran->bulan === "januari" ? "selected" : ""); ?>>Januari</option>
                                    <option value="februari" <?php echo e($pembayaran->bulan === "februari" ? "selected" : ""); ?>>Februari</option>
                                    <option value="maret" <?php echo e($pembayaran->bulan === "maret" ? "selected" : ""); ?>>Maret</option>
                                    <option value="april" <?php echo e($pembayaran->bulan === "april" ? "selected" : ""); ?>>April</option>
                                    <option value="mei" <?php echo e($pembayaran->bulan === "mei" ? "selected" : ""); ?>>Mei</option>
                                    <option value="juni" <?php echo e($pembayaran->bulan === "juni" ? "selected" : ""); ?>>Juni</option>
                                    <option value="juli" <?php echo e($pembayaran->bulan === "juli" ? "selected" : ""); ?>>Juli</option>
                                    <option value="agustus" <?php echo e($pembayaran->bulan === "agustus" ? "selected" : ""); ?>>Agustus</option>
                                    <option value="september" <?php echo e($pembayaran->bulan === "september" ? "selected" : ""); ?>>September</option>
                                    <option value="oktober" <?php echo e($pembayaran->bulan === "oktober" ? "selected" : ""); ?>>Oktober</option>
                                    <option value="november" <?php echo e($pembayaran->bulan === "november" ? "selected" : ""); ?>>November</option>
                                    <option value="desember" <?php echo e($pembayaran->bulan === "desember" ? "selected" : ""); ?>>Desember</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <input id="status" type="text" name="status" class="form-control" value="<?php echo e($pembayaran->status);?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nominal" class="col-md-4 control-label">Nominal</label>
                            <input id="nominal" type="text" name="nominal" class="form-control" value="<?php echo e($pembayaran->nominal);?>" readonly>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <img width="200" height="200" <?php if($pembayaran->bukti): ?> src="<?php echo e(asset('images/pembayaran/'.$pembayaran->bukti)); ?>" <?php endif; ?> />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.appWali', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
</script>