<ul class="nav">
  <li class="nav-item nav-profile">
    <div class="nav-link">
      <div class="user-wrapper">
        <div class="profile-image">
          <?php if(Auth::user()->gambar == ''): ?>

        <img src="<?php echo e(asset('images/user/default.png')); ?>" alt="profile image">
      <?php else: ?>

      <img src="<?php echo e(asset('images/user/' . Auth::user()->gambar)); ?>" alt="profile image">
    <?php endif; ?>
        </div>
        <div class="text-wrapper">
          <p class="profile-name"><?php echo e(Auth::user()->name); ?></p>
          <div>
            <small class="designation text-muted"
              style="text-transform: uppercase;letter-spacing: 1px;"><?php echo e(Auth::user()->level); ?></small>
            <span class="status-indicator online"></span>
          </div>
        </div>
      </div>
    </div>
  </li>
  <li class="nav-item <?php echo e(setActive(['/', 'home'])); ?>">
    <a class="nav-link" href="<?php echo e(url('/')); ?>">
      <i class="menu-icon mdi mdi-television"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>
  <?php if(Auth::user()->level == 'user'): ?>
  <li class="nav-item <?php echo e(setActive(['customer*', 'kostum*'])); ?>">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Master Data</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse <?php echo e(setShow(['customer*', 'kostum*'])); ?>" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link <?php echo e(setActive(['customer*'])); ?>" href="<?php echo e(route('customer.index')); ?>">Data Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(setActive(['kostum*'])); ?>" href="<?php echo e(route('kostum.index')); ?>">Data Kostum</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item <?php echo e(setActive(['transaksi*'])); ?>">
    <a class="nav-link" href="<?php echo e(route('transaksi.index')); ?>">
      <i class="menu-icon mdi mdi-backup-restore"></i>
      <span class="menu-title">Transaksi</span>
    </a>
  </li>
  <?php endif; ?>
  <?php if(Auth::user()->level == 'admin'): ?>
  <li class="nav-item <?php echo e(setActive(['customer*', 'kostum*', 'user*'])); ?>">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Master Data</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse <?php echo e(setShow(['customer*', 'kostum*', 'user*'])); ?>" id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link <?php echo e(setActive(['customer*'])); ?>" href="<?php echo e(route('customer.index')); ?>">Data Customer</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo e(setActive(['kostum*'])); ?>" href="<?php echo e(route('kostum.index')); ?>">Data Kostum</a>
        </li>
      </ul>
    </div>
  </li>
  <li class="nav-item <?php echo e(setActive(['transaksi*'])); ?>">
    <a class="nav-link" href="<?php echo e(route('transaksi.index')); ?>">
      <i class="menu-icon mdi mdi-backup-restore"></i>
      <span class="menu-title">Transaksi</span>
    </a>
  </li>
    <li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#ui-laporan" aria-expanded="false" aria-controls="ui-laporan">
      <i class="menu-icon mdi mdi-table"></i>
      <span class="menu-title">Laporan</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="ui-laporan">
      <ul class="nav flex-column sub-menu">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('laporan/trs')); ?>">Laporan Transaksi</a>
      </li>
      <!--
          <li class="nav-item">
            <a class="nav-link" href="">Laporan Anggota</a>
          </li>
          -->
      <li class="nav-item">
        <a class="nav-link" href="<?php echo e(url('laporan/kostum')); ?>">Laporan Kostum</a>
      </li>
      </ul>
    </div>
    </li>
  <?php endif; ?>
</ul>