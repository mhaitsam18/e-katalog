<header class="header_area sticky-header">
	<div class="main_menu">
		<nav class="navbar navbar-expand-lg navbar-light main_box">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<img src="<?= base_url() ?>assets/landingpage/img/logo transparan with text.png" alt="" width="150px" style="padding:10px">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
					<ul class="nav navbar-nav menu_nav ml-auto">
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Beranda</a></li>
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>pengumuman">Pengumuman</a></li>
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>berita">Berita</a></li>
						<li class="nav-item submenu dropdown">
							<a href="<?= base_url() ?>LandingPage/#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Informasi</a>
							<ul class="dropdown-menu">
								<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>produk_tayang">Produk Tayang</a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>transaksi">Transaksi</a>
								</li>
							</ul>
						</li>
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>unduh">Unduh</a></li>
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>tanya_jawab">Tanya Jawab</a></li>
						<li class="nav-item"><a class="nav-link" href="<?= base_url() ?>kontak">Kontak Kami</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<?php if (!$this->session->id) : ?>
							<li class="nav-item">
								<a href="login" class="cart"><span class="lnr lnr-cart"></span></a>
							</li>
						<?php else : ?>
							<li class="nav-item">
								<a href="<?= base_url() ?>PUMK/keranjang" class="cart"><span class="lnr lnr-cart"></span></a>
							</li>
							<li class="nav-item">
								<a href="<?= base_url() ?>PUMK" class="cart"><span class="lnr lnr-user"></span></a>
							</li>
						<?php endif; ?>
						<li class="nav-item">
							<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="search_input" id="search_input_box">
		<div class="container">
			<form class="d-flex justify-content-between" action="<?= base_url() ?>produk" method="get">
				<input type="text" class="form-control" id="search_input" placeholder="Cari sesuatu disini..." name="search">
				<button type="submit" class="btn"></button>
				<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
			</form>
		</div>
	</div>
</header>