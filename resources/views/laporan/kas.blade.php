@section('js')
<script type="text/javascript">
  $(document).ready(function () {
    $('#table').DataTable({
      "iDisplayLength": 50
    });
  });
</script>
@endsection

@section('content')
<div class="row" style="margin-top: 20px;">
  
<div class="col-md-12 grid-margin stretch-card">
  <div class="row flex-grow">
    <div style="width: 50%">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Filter Kas Masuk</h4>
            <form action="{{ route('kasPdf') }}" method="GET">
              <div class="form-group{{ $errors->has('kategori_masuk') ? ' has-error' : '' }}">
                <label for="kategori_masuk" class="col-md-4 control-label">Kategori Kas Masuk</label>
                <div class="col-md-12">
                  <select class="form-control" id="kategori_masuk" name="kategori_masuk">
                    <option value="">Semua</option>
                    <option value="sumbangan">Sumbangan</option>
                    <option value="pembayaran">Pembayaran</option>
                    <option value="lain">Lainnya</option>
                  </select>
                </div>
              </div>
              <div class="form-group{{ $errors->has('start_month_masuk') ? ' has-error' : '' }}">
                <label for="start_month_masuk" class="col-md-4 control-label">Bulan Mulai Kas Masuk</label>
                <div class="col-md-12">
                  <input type="month" class="form-control" id="start_month_masuk" name="start_month_masuk" value="{{ request('start_month_masuk') }}">
                </div>
              </div>
              <div class="form-group{{ $errors->has('end_month_masuk') ? ' has-error' : '' }}">
                <label for="end_month_masuk" class="col-md-4 control-label">Bulan Akhir Kas Masuk</label>
                <div class="col-md-12">
                  <input type="month" class="form-control" id="end_month_masuk" name="end_month_masuk" value="{{ request('end_month_masuk') }}">
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div style="width: 50%">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Filter Kas Keluar</h4>
              <div class="form-group{{ $errors->has('kategori_keluar') ? ' has-error' : '' }}">
                <label for="kategori_keluar" class="col-md-4 control-label">Kategori Kas Keluar</label>
                <div class="col-md-12">
                  <select class="form-control" id="kategori_keluar" name="kategori_keluar">
                    <option value="">Semua</option>
                    <option value="operasional">Operasional</option>
                    <option value="makanan">Makanan</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                </div>
              </div>
              <div class="form-group{{ $errors->has('start_month_keluar') ? ' has-error' : '' }}">
                <label for="start_month_keluar" class="col-md-4 control-label">Bulan Mulai Kas Keluar</label>
                <div class="col-md-12">
                  <input type="month" class="form-control" id="start_month_keluar" name="start_month_keluar" value="{{ request('start_month_keluar') }}">
                </div>
              </div>
              <div class="form-group{{ $errors->has('end_month_keluar') ? ' has-error' : '' }}">
                <label for="end_month_keluar" class="col-md-4 control-label">Bulan Akhir Kas Keluar</label>
                <div class="col-md-12">
                  <input type="month" class="form-control" id="end_month_keluar" name="end_month_keluar" value="{{ request('end_month_keluar') }}">
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group" style="width: 100%">    
      <center>
        <button type="submit" class="col-3 mt-4 btn btn-primary">
          Download PDF
        </button>
      </center>
    </div>
  </form>
  </div>
</div>
</div>
@endsection
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
