<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Bayar</title>
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
    <link rel="shortcut icon" href="<?php echo e(asset('logo.png')); ?>" />
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .container-fluid {
            padding: 0;
        }

        .main-panel,
        .navbar-menu-wrapper {
            width: 100%;
        }

        .content-wrapper {
            padding: 0 15px;
        }

        .row.flex-grow {
            display: flex;
            flex-wrap: nowrap;
        }

        .card {
            flex: 1;
            margin: 10px;
        }

        .navbar.default-layout .navbar-menu-wrapper {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-menu-wrapper d-flex align-items-center">
                <ul class="navbar-nav navbar-nav-right">
                    <a class="nav-link pr-4" style="color: white" href="<?php echo e(route('wali.logout')); ?>">
                        <span class="menu-title">Logout</span>
                        <i class="menu-icon mdi mdi-logout"></i>
                    </a>
                    <div class="d-flex border-bottom">
                    </div>
                    </a>
                    </form>
                    </a>
            </div>
            </li>
            </ul>
    </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text d-block text-center text-sm d-sm-inline-block" style="color: #2c892c">Copyright ©
                        <?php echo e(date('Y')); ?>
                        Pesantren. All rights reserved.</span>
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