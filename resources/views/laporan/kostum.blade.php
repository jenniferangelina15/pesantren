@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    $('#table').DataTable({
      "iDisplayLength": 50
    });

} );
</script>
@stop
@extends('layouts.app')

@section('content')
<div class="row">

</div>
<div class="row" style="margin-top: 20px;">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">

                <div class="card-body">
                  <h4 class="card-title">Laporan Kostum</h4>
<!-- 
  <div class="col-md-2 pull-left">
    <a href="{{ url('laporan/kostum/pdf') }}" class="btn btn-primary btn-rounded btn-fw"><b><i class="fa fa-download"></i> Export PDF</a></b>
  </div> -->

  <button type="button" class="btn btn-info"  aria-haspopup="true" aria-expanded="false">
  <a href="{{ url('laporan/kostum/pdf') }}" style="color: white"><b><i class="fa fa-download" style="color: white"></i> Export PDF</a></b>
          </button>
                </div>
              </div>
            </div>
          </div>
@endsection