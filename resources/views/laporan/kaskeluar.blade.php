@extends('layouts.app')

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
<div class="row"></div>
<div class="row" style="margin-top: 20px;">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Laporan Kas Keluar</h4>
        <form action="{{ route('kaskeluarPdf') }}" method="GET">
          <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
            <label for="kategori" class="col-md-4 control-label">Kategori</label>
            <div class="col-md-6">
              <select class="form-control" id="kategori" name="kategori">
                <option value="">Semua</option>
                <option value="makanan">Makanan</option>
                <option value="operasional">Operasional</option>
                <option value="lainnya">Lainnya</option>
              </select>
            </div>
          </div>
          <div class="form-group{{ $errors->has('start_month') ? ' has-error' : '' }}">
            <label for="start_month" class="col-md-4 control-label">Bulan Mulai</label>
            <div class="col-md-6">
              <input type="month" class="form-control" id="start_month" name="start_month" value="{{ request('start_month') }}">
            </div>
          </div>
          <div class="form-group{{ $errors->has('end_month') ? ' has-error' : '' }}">
            <label for="end_month" class="col-md-4 control-label">Bulan Akhir</label>
            <div class="col-md-6">
              <input type="month" class="form-control" id="end_month" name="end_month" value="{{ request('end_month') }}">
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
@endsection
