<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Riwayat Paket</title>
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include "navbar.php"?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "sidebar.php"?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kelola Paket</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item"><a href="#">Kelola Paket</a></li>
              <li class="breadcrumb-item active">Riwayat Paket</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <a href="<?=base_url()?>PP/detail_paket_negosiasi/<?=$id?>" class="btn btn-danger">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
                </a>
                <br><br>
            <div class="card" style="background-color:#218838">
              <div class="card-header">
                <h3 class="card-title"><b style="color:white">Detail Riwayat Paket <?=$nego->nama_paket?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background-color:white">
              <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                    <h3>Daftar Paket</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Oleh</th>
                            <th>Catatan</th>
                        </thead>
                        <tbody>
													<tr>
														<td colspan="4"><span style="color:red;"><center>↓↓ Update Status Paket Terbaru ↓↓</center></span></td>
													</tr>
                            <?php 
                            $no = 1;
                            foreach($riwayat as $data){?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data->tanggal?></td>
                               <td>
                               <?php 
                                    if($data->status == 1){?>
                                      <button class="btn btn-primary">PP</button>
                                      <?php }elseif($data->status == 2){?>
                                      <button class="btn btn-warning">PP ke Penyedia</button>
                                      <?php }elseif($data->status == 3){?>
                                      <button class="btn btn-warning">Penyedia ke PP</button>
                                      <?php }elseif($data->status == 4){?>
                                      <button class="btn btn-info">PP</button>
                                      <?php }elseif($data->status == 5){?>
                                      <button class="btn btn-dark">Penyedia</button>
                                      <?php }elseif($data->status == 6){?>
                                      <button class="btn btn-success">PUMK</button>
                                    <?php }else{?>
                                      <button class="btn btn-danger">PP</button>
                                    <?php } ?>
                               </td>
                               <td>
                               <?php
                                if($data->status == 0){?>
                                <button class="btn btn-primary">Paket Dibuat</button>
                                <?php }elseif($data->status == 1){?>
                                <button class="btn btn-primary">Persetujuan Paket</button>
                                <?php }elseif($data->status == 2){?>
                                <button class="btn btn-warning">Ajukan Negosiasi</button>
                                <?php }elseif($data->status == 3){?>
                                <button class="btn btn-warning">Negosiasi Kembali</button>
                                <?php }elseif($data->status == 4){?>
                                <button class="btn btn-info">Review Paket</button>
                                <?php }elseif($data->status == 5){?>
                                <button class="btn btn-dark">Pengiriman Paket oleh Penyedia</button>
                                <?php }elseif($data->status == 6){?>
                                <button class="btn btn-success">Paket Sudah Terkirim</button>
                                <?php }elseif($data->status == 7){?>
                                <button class="btn btn-danger">Paket Selesai</button>
                                <?php }else{} ?>
                                <br>
                                <i><span><?=$data->aksi?></span></i>
                               </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                  </div>
              </div>
            </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<?php include "script.php"?>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
