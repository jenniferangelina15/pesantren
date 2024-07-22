<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Wali</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/iconfonts/puse-icons-feather/feather.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.addons.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('logo.png')}}" />
</head>

<body>
    <div class="d-flex" style="justify-content: space-between">
        <!--Left-->
        <div style="width: 45%; background-color: #2c892c;">
            <div class="container-scroller">
                <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                    <div class="content-wrapper d-flex align-items-center auth theme-one"
                        style="background-color: #2c892c">
                        <div class="row w-100">
                            <div class="col-md-12 text-center" style="margin-bottom: 20px;">
                                <img src="{{asset('logo.png')}}" width="250px">
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>
        </div>
        <!--Right-->
        <div style="width: 55%; background-color: #fff;">
            <form method="POST" action="{{ route('wali.login') }}">
                {{ csrf_field() }}
                <div class="container-scroller">
                    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
                        <div class="content-wrapper d-flex align-items-center auth theme-one">
                            <div class="row w-100">
                                <div class="col-lg-6 mx-auto">
                                    <div class="auto-form-wrapper">
                                        <div class="form-group{{ $errors->has('nik') ? ' has-error' : '' }}">
                                            <label class="label">NIK</label>
                                            <div class="input-group">
                                                <input id="nik" type="text" class="form-control" name="nik"
                                                    value="{{ old('nik') }}" required autofocus>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="mdi mdi-check-circle-outline"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @if ($errors->has('nik'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('nik') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="label">Password</label>
                                            <div class="input-group">
                                                <input id="password" type="password" class="form-control"
                                                    name="password" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="mdi mdi-check-circle-outline"></i>
                                                    </span>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary submit-btn btn-block"
                                                type="submit">Login</button>
                                        </div>
                                    </div>
                                    <p class="footer-text text-center" style="margin-top: 20px;color: #2c892c">Copyright
                                        © {{date('Y')}}
                                        Pesantren - All rights reserved.</p>
                                </div>
                            </div>
                        </div>
                        <!-- content-wrapper ends -->
                    </div>
                    <!-- page-body-wrapper ends -->
                </div>
            </form>
        </div>
    </div>
</body>

</html>