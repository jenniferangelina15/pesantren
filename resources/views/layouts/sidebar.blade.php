<ul class="nav mb-5">
  <li class="nav-item nav-profile">
    <div class="nav-link">
      <div class="user-wrapper">
        <div class="profile-image">
          <?php if (Auth::user()->gambar == ''): ?>
          <img src="<?php  echo e(asset('images/user/default.png')); ?>" alt="profile image">
          <?php else: ?>
          <img src="<?php  echo e(asset('images/user/' . Auth::user()->gambar)); ?>" alt="profile image">
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
  <?php if (Auth::user()->level == 'admin'): ?>
  <li class="nav-item <?php  echo e(setActive(['santri*', 'pembayaran*', 'kasmasuk*', 'kaskeluar*', 'user*'])); ?>">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Master Data</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse <?php  echo e(setShow(['santri*', 'pembayaran*', 'kasmasuk*', 'kaskeluar*', 'user*'])); ?>"
      id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['santri*'])); ?>"
            href="<?php  echo e(route('santri.index')); ?>">Data Santri</a>
          <ul class="nav flex-column sub-menu" style="padding-left: 2rem">
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['10*'])); ?>"
                href="<?php  echo e(route('santri.index10')); ?>">Kelas 10</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['11*'])); ?>"
                href="<?php  echo e(route('santri.index11')); ?>">Kelas 11</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['12*'])); ?>"
                href="<?php  echo e(route('santri.index12')); ?>">Kelas 12</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['alumni*'])); ?>"
                href="<?php  echo e(route('santri.indexAlumni')); ?>">Alumni</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['pembayaran*'])); ?>"
            href="<?php  echo e(route('pembayaran.index')); ?>">Data Pembayaran</a>
          <ul class="nav flex-column sub-menu" style="padding-left: 2rem">
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['belum*'])); ?>"
                href="<?php  echo e(route('pembayaran.indexBelum')); ?>">Belum Setuju</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['telah*'])); ?>"
                href="<?php  echo e(route('pembayaran.indexTelah')); ?>">Telah Setuju</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['kasmasuk*'])); ?>"
            href="<?php  echo e(route('kasmasuk.index')); ?>">Data Kas Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['kaskeluar*'])); ?>"
            href="<?php  echo e(route('kaskeluar.index')); ?>">Data Kas Keluar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['user*'])); ?>" href="<?php  echo e(route('user.index')); ?>">Data
            Pengguna</a>
        </li>
      </ul>
    </div>
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
          <a class="nav-link" href="<?php  echo e(url('laporan/pembayaran')); ?>">Laporan Pembayaran</a>
          <a class="nav-link" href="<?php  echo e(url('laporan/kasmasuk')); ?>">Laporan Kas Masuk</a>
          <a class="nav-link" href="<?php  echo e(url('laporan/kaskeluar')); ?>">Laporan Kas Keluar</a>
        </li>
    </div>
  </li>

  <?php endif; ?>
  <?php if (Auth::user()->level == 'user'): ?>
  <li class="nav-item <?php  echo e(setActive(['santri*', 'pembayaran*', 'kasmasuk*', 'kaskeluar*', 'user*'])); ?>">
    <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
      <i class="menu-icon mdi mdi-content-copy"></i>
      <span class="menu-title">Master Data</span>
      <i class="menu-arrow"></i>
    </a>
    <div class="collapse <?php  echo e(setShow(['santri*', 'pembayaran*', 'kasmasuk*', 'kaskeluar*', 'user*'])); ?>"
      id="ui-basic">
      <ul class="nav flex-column sub-menu">
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['santri*'])); ?>"
            href="<?php  echo e(route('santri.index')); ?>">Data Santri</a>
          <ul class="nav flex-column sub-menu" style="padding-left: 2rem">
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['10*'])); ?>"
                href="<?php  echo e(route('santri.index10')); ?>">Kelas 10</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['11*'])); ?>"
                href="<?php  echo e(route('santri.index11')); ?>">Kelas 11</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['12*'])); ?>"
                href="<?php  echo e(route('santri.index12')); ?>">Kelas 12</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['alumni*'])); ?>"
                href="<?php  echo e(route('santri.indexAlumni')); ?>">Alumni</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['pembayaran*'])); ?>"
            href="<?php  echo e(route('pembayaran.index')); ?>">Data Pembayaran</a>
          <ul class="nav flex-column sub-menu" style="padding-left: 2rem">
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['belum*'])); ?>"
                href="<?php  echo e(route('pembayaran.indexBelum')); ?>">Belum Setuju</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php  echo e(setActive(['telah*'])); ?>"
                href="<?php  echo e(route('pembayaran.indexTelah')); ?>">Telah Setuju</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['kasmasuk*'])); ?>"
            href="<?php  echo e(route('kasmasuk.index')); ?>">Data Kas Masuk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php  echo e(setActive(['kaskeluar*'])); ?>"
            href="<?php  echo e(route('kaskeluar.index')); ?>">Data Kas Keluar</a>
        </li>
      </ul>
      <?php endif; ?>
</ul>