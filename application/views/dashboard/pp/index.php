<!DOCTYPE html>
<html lang="en">

  <?php include "head.php"?>
  <title>Dashboard PP</title>
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
      <h5>Data Status Paket</h5>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php 
                  if(empty($paket)){
                    echo "0";
                  }else{
                    echo $paket->id;
                  }?>
                </h3>

                <p>Paket Baru</p>
              </div>
              <div class="icon">
                <i class="fas fa-box"></i>
              </div>
               <a href="<?=base_url()?>PP/kelola_paket" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>
                <?php 
                  if(empty($negosiasi)){
                    echo "0";
                  }else{
                    echo $negosiasi->id;
                  }?>
                </h3>
                <p>Negosiasi</p>
              </div>
              <div class="icon">
                <i class="fas fa-handshake"></i>
              </div>
              <a href="<?=base_url()?>PP/kelola_negosiasi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>
                <?php 
                  if(empty($review)){
                    echo "0";
                  }else{
                    echo $review->id;
                  }?>
                </h3>
                <p>Review Paket</p>
              </div>
              <div class="icon">
                <i class="fas fa-eye"></i>
              </div>
              <a href="<?=base_url()?>PP/kelola_negosiasi" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
                <?php 
                  if(empty($kirim)){
                    echo "0";
                  }else{
                    echo $kirim->id;
                  }?>
                </h3>

                <p>Paket Kirim</p>
              </div>
              <div class="icon">
                <i class="fa fa-bus"></i>
              </div>
              <a href="<?=base_url()?>PP/kelola_selesai" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                <?php 
                  if(empty($selesai)){
                    echo "0";
                  }else{
                    echo $selesai->id;
                  }?>
                </h3>

                <p>Paket Selesai</p>
              </div>
              <div class="icon">
                <i class="ion ion-checkmark"></i>
              </div>
              <a href="<?=base_url()?>PP/kelola_selesai" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
								<?php 
                  if(empty($tolak)){
                    echo "0";
                  }else{
                    echo $tolak->id;
                  }?>
								</h3>

                <p>Paket Ditolak</p>
              </div>
              <div class="icon">
                <i class="ion ion-close"></i>
              </div>
              <a href="<?=base_url()?>PP/kelola_penolakan" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a> 
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-12">
    <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
						<h5>Data Pengajuan Negosiasi dari Penyedia Terkini</h5>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-handshake"></i>
                  Update Negosiasi
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Penyedia</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <table class="table">
                    <thead>
                      <th>No</th>
                      <th>ID Paket</th>
                      <th>Nominal</th>
                      <th>Catatan</th>
                      <th>Status</th>
											<th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php 
                      $no = 1;
                      foreach($data as $d){?>
                      <tr>
                        <td><?=$no++?></td>
                        <td>ID <?=$d->id_paket?></td>
                        <td>Rp <?php echo number_format($d->nominal,2,".",",");?></td>
                        <td><?=$d->catatan?></td>
                        <td><?php
                            if($d->status == 3){
                              echo "Penyedia Mengajukan Negosiasi";
                            }elseif($d->status == 4){
                              echo "Negosiasi Setuju";
                            }
                        ?></td>
												<td>
												<a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-danger">
                        <i class="fas fa-check"></i>
                        Check
                        </a>
												</td>
                      </tr>
                      <?php }?>
                    </tbody>
                    <tfoot>
                      <th>No</th>
                      <th>ID Paket</th>
                      <th>Nominal</th>
                      <th>Catatan</th>
                      <th>Status</th>
											<th>Aksi</th>
                    </tfoot>
                  </table>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
    <!-- /.content -->
    </div>
    <br><br><br>
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
