<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?= base_url() ?>assets/landingpage/img/logotransparan.png" alt="Logo E-catalog" class="brand-image elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-light">E-Katalog</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url() ?>assets/landingpage/img/dummyprofile.png" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">Admin</a>
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
					<a href="<?= base_url() ?>Admin" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Daftar User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
							<li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>PPK</p>
                </a>
              </li>
							<li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>PP</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.html" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Penyedia</p>
                </a>
              </li>
            </ul>
          </li> -->
				<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-box"></i>
						<p>
							Daftar Paket
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?= base_url() ?>Admin/paket_diproses" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Paket Diproses</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>Admin/paket_dinegosiasi" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Negosiasi</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>Admin/paket_dikirim" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Paket Dikirim</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url() ?>Admin/paket_selesai" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Paket Selesai</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/etalase_produk" class="nav-link">
						<i class="nav-icon fas fa-shopping-bag"></i>
						<p>
							Etalase Produk
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/penyedia" class="nav-link">
						<i class="nav-icon fa fa-solid fa-users"></i>
						<p>
							Daftar Penyedia
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/pengumuman" class="nav-link">
						<i class="nav-icon fas fa-bullhorn"></i>
						<p>
							Kelola Pengumuman
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/berita" class="nav-link">
						<i class="nav-icon fas fa-newspaper"></i>
						<p>
							Kelola Berita
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/unduhan" class="nav-link">
						<i class="nav-icon fas fa-download"></i>
						<p>
							Kelola Unduhan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/faq" class="nav-link">
						<i class="nav-icon fas fa-question-circle"></i>
						<p>
							Kelola FAQ
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/kontak" class="nav-link">
						<i class="nav-icon fas fa-address-card"></i>
						<p>
							Kelola Kontak
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url() ?>Admin/kategori" class="nav-link">
						<i class="nav-icon fas fa-list"></i>
						<p>
							Kategori-Kategori
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt"></i>
						<p>
							<button class="border-0 p-0 text-light" style="background: transparent" form="form-logout">Logout</button>
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<form action="<?= base_url() ?>logout" method="post" class="nav-link" id="form-logout">
			<?= csrf(); ?>
		</form>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>