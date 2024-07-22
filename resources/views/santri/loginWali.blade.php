<!DOCTYPE html>
<html>
<head>
    <title>Login Wali</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h2>Login Wali</h2>
        <form action="{{ route('loginWali.login') }}" method="post" enctype="multipart/form-data">
        <?php echo e(csrf_field()); ?>
        <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" name="nik" class="form-control" id="nik" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" required>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
