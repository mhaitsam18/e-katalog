<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Kelola Negosiasi</title>
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
              <li class="breadcrumb-item active">Kelola Negosiasi</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Negosiasi Paket</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Paket</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>Status Negosiasi</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($data as $d){
                    if (!$d->id_paket){?>
                    <tr>
                      <td colspan="8">
                      <center>  
                      Tidak Ada Data
                      </center>
                      </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?php
                                $date=date_create($d->tanggal_mulai);
                                echo date_format($date,"d/m/Y");
                                ?> - 
                          <?php
                                $date=date_create($d->tanggal_akhir);
                                echo date_format($date,"d/m/Y");
                                ?></td>
                      <td><?=$d->nama_paket?></td>
                      <td><?=$d->jumlahproduk?></td>
                      <td>
                        <?php if(!$d->nominal){?>
                          Rp <?php echo number_format($d->subtotal,2,".",",");?>
                        <?php }else{?>
                          Rp <?php echo number_format($d->nominal,2,".",",");?>
                          <?php }?>
                      </td>
                      <td>
                        <center>
                        <?php 
                        if($d->status == 2){?>
                        <button class="btn btn-primary">Persetujuan Paket</button>
                        <?php }elseif($d->status == 3){?>
                        <button class="btn btn-warning">Negosiasi Terkirim</button>
                        <?php }elseif($d->status == 4){?>
                        <button class="btn btn-success">Review Paket Oleh PP</button>
                        <?php }elseif($d->status == 5){?>
                        <button class="btn btn-warning">Paket Disetujui</button>
                        <?php }else{} ?>
                        </center>
                      </td>
                      <td>
                        <center>
                        <a href="<?=base_url()?>Penyedia/detail_nego/<?=$d->id_paket?>" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                        Detail
                        </a>
                      </td>
                      </center>
                    </tr>
                    <?php }} ?>
                  </tbody>
                  <tfoot>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pemesan</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>Status Negosiasi</th>
                    <th>Aksi</th>
                  </tfoot>
                </table>
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
