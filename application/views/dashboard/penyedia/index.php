<!DOCTYPE html>
<html lang="en">

<?php include "head.php"?>
<title>Dashboard Penyedia</title>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?=base_url()?>assets/landingpage/img/logotransparan.png" alt="Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php include "navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "sidebar.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <h5>Data Ringkasan</h5>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$produk->id?></h3>

                <p>Jumlah Produk</p>
              </div>
              <div class="icon">
               <i class="fas fa-shopping-bag"></i>
              </div>
               <a href="<?=base_url()?>Penyedia/etalase_produk" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
					<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-default">
              <div class="inner">
                <h3><?=$pengumuman->id?></h3>

                <p>Jumlah Pengumuman</p>
              </div>
              <div class="icon">
               <i class="fas fa-newspaper"></i>
              </div>
               <a href="<?=base_url()?>Penyedia/pengumuman" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
        </div>
				<div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$nego->id?></h3>
                <p>Negosiasi Paket</p>
              </div>
              <div class="icon">
                	<i class="fas fa-handshake"></i>
              </div>
              <a href="<?=base_url()?>Penyedia/kelola_negosiasi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
									<?=$proses->id?>
                </h3>
                <p>Paket Harus Diproses</p>
              </div>
              <div class="icon">
                <i class="fas fa-truck"></i>
              </div>
               <a href="<?=base_url()?>Penyedia/kelola_kirim" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
					<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$kirim->id?></h3>

                <p>Paket Sudah Dikirim</p>
              </div>
              <div class="icon">
               <i class="fas fa-shopping-bag"></i>
              </div>
               <a href="<?=base_url()?>Penyedia/kelola_selesai" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$selesai->id?></h3>
                <p>Paket Selesai</p>
              </div>
              <div class="icon">
              <i class="fas fa-check-square"></i>
              </div>
                <a href="<?=base_url()?>Penyedia/kelola_selesai" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
               <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-box"></i>
                  Produk Terbaru
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach($produknew as $data){?>
                            <tr>
                                <td><?=$no++?></td>
                                <td>
                                    <?php if(!$data->foto){?>
                                    <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk" style="width:100px;height:100px">
                                    <?php }else{?>
                                    <img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>" style="width:100px;height:100px">
                                    <?php }?>
                                </td>
                                <td><?=$data->nama_produk?></td>
                                <td>Rp <?php echo number_format($data->harga,2,".",",")?></td>
                                <td><?=$data->unit_pengukuran?></td>
                                <td><?=$data->stok?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
        </div>
      </div><!-- /.container-fluid -->
    </section>

		
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include "script.php"?>
</body>
</html>
