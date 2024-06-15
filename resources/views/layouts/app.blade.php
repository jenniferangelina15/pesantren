<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>KOSTUMKU</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo e(asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/css/vendor.bundle.base.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('vendors/css/vendor.bundle.addons.css')); ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/select2.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/dataTables.bootstrap4.min.css')); ?>">
  <?php $__env->startSection('css'); ?>

  <?php echo $__env->yieldSection(); ?>
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo e(asset('logoKostumku.png')); ?>" />
</head>
<body>
    <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html" style="color: #2d2d2d">
          KOSTUMKU
        </a>
           <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
          <i class="fa fa-align-justify" style="color: #fff;"></i>
        </button>
      </div>

      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
         
          <li class="nav-item dropdown d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello, <?php echo e(Auth::user()->name); ?> !</span>
                <?php if(Auth::user()->gambar == ''): ?>
                  <img class="img-xs rounded-circle"  src="<?php echo e(asset('images/user/default.png')); ?>" alt="profile image">
                <?php else: ?>
                <img class="img-xs rounded-circle"  src="<?php echo e(asset('images/user/'.Auth::user()->gambar)); ?>" alt="profile image">
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                 
                </div>
              </a>
              <a class="dropdown-item" style="margin-top: 20px;" href="<?php echo e(route('user.edit', Auth::user()->id)); ?>">
               Edit Profile
              </a>
              <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                 Sign Out

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
              </a>
            </div>
          </li>
        </ul>
     
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <?php $__env->startSection('sidebar'); ?>
          <?php echo $__env->make('layouts.sidebar',['user' => Auth::User()], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <?php echo $__env->yieldSection(); ?>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <?php echo $__env->yieldContent('content'); ?>

        </div>
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text d-block text-center text-sm-left d-sm-inline-block" style="color: #5C57C7">Copyright © <?php echo e(date('Y')); ?>

            Jennifer Angelina. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <script src="<?php echo e(asset('vendors/js/vendor.bundle.base.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/js/vendor.bundle.addons.js')); ?>"></script>
  <script src="<?php echo e(asset('js/off-canvas.js')); ?>"></script>
  <script src="<?php echo e(asset('js/misc.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
  <script src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/dataTables.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('js/sweetalert2.all.js')); ?>"></script>
  <script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>
  <?php echo $__env->make('sweetalert::alert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php $__env->startSection('js'); ?>

  <?php echo $__env->yieldSection(); ?>
</body>

</html>
                         
   