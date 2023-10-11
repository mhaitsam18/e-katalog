<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Kelola Paket Baru</title>
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
              <li class="breadcrumb-item active">Paket Baru</li>
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
                <h3 class="card-title">Data Paket Proses</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body"> 
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
										<th>Penyedia</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>No. Anggaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($data as $d){
                    if (!$d->status){?>
                    <tr>
                      <td colspan="9">
                      <center>  
                      Tidak Ada Data
                      </center>
                      </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$d->nama_paket?></td>
											<td><?=$d->nama_perusahaan?></td>
                      <td>
                          <?php
                            $date=date_create($d->tanggal_mulai);
                            echo date_format($date,"d/m/Y");
                          ?>
                          -
                          <?php
                            $date=date_create($d->tanggal_akhir);
                            echo date_format($date,"d/m/Y");
                          ?>
                      </td>
                      <td><?=$d->jumlahproduk?></td>
                      <td><?= rupiah($d->nominal);?></td>
                      <td><?=$d->no_pr?>
                          <a href="<?=base_url()?>LandingPage/kak/<?=$d->link?>" target="_blank" rel="noopener noreferer">Lampiran</a>
                      </td>
                      <td>
                        Paket Baru
                      </td>
                      <td>
                        <a width="100px" href="<?=base_url()?>PP/edit_kak/<?=$d->id_paket?>" >
                        <i class="fas fa-pencil-alt"></i>
                        Edit KAK
                        </a>
                        <a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-primary">
                        <i class="fas fa-check-square"></i>
                        Check
                        </a>
                      </td>
                    </tr>
                    <?php }} ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
										<th>Penyedia</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Total Harga</th>
                    <th>No. Anggaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
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
