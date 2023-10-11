<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?=base_url()?>assets/landingpage/img/logotransparan.png" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">E-Katalog UNPAD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?=base_url()?>assets/landingpage/img/dummyprofile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">PP</a>
        </div>
      </div>

      <!-- SidebarSearch Form
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=base_url()?>PP" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Kelola Paket
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url()?>PP/kelola_paket" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Paket &nbsp;&nbsp; <span class="badge bg-info">Baru</span></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>PP/kelola_negosiasi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Negosiasi Paket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url()?>PP/kelola_selesai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Verifikasi Paket</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-item">
            <a href="<?=base_url()?>PP/pengumuman" class="nav-link">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Kelola Pengumuman
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>PP/berita" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Kelola Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>PP/unduh" class="nav-link">
              <i class="nav-icon fas fa-download"></i>
              <p>
                Kelola Unduhan
              </p>
            </a>
          </li> -->
          <li class="nav-item">
						<form action="<?= base_url() ?>logout" method="post" class="nav-link">
							<?= csrf(); ?>
              <i class="nav-icon fas fa-sign-out-alt"></i>
							<button class="border-0 p-0 text-light" style="background: transparent">Logout</button>
						</form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>