<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Detail Spesifikasi Produk</title>
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
            <h1>Kelola Etalase Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Spesifikasi Etalase Produk</li>
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
            <div class="card" style="background-color:blue">
              <div class="card-header">
                <h3 class="card-title"><b style="color:white">Data Produk <?=$detail_produk->nama_produk?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background-color:white">
              <div class="modal-body">
              <div class="row">
                  <div class="col-md-6">
                    <table cellpadding="10">
                        <tr>
                        <th>Nama Produk</th>
                        <td>:</td>
                        <td><?=$detail_produk->nama_produk?></td>
                      </tr>
                      <tr>
                        <th>Merk</th>
                        <td>:</td>
                        <td><?=$detail_produk->merek?></td>
                      </tr>
                      <tr>
                        <th>Harga Asli</th>
                        <td>:</td>
                        <td>Rp <?php echo number_format($detail_produk->harga,2,".",",");?></td>
                      </tr>
                      <tr>
                        <th>Harga Sesudah PPN (11%)</th>
                        <td>:</td>
                        <td><p style="color:red">Rp <?php echo number_format($detail_produk->harga_ppn,2,".",",");?></p></td>
                      </tr>
                      <tr>
                        <th>Masa Berlaku Produk</th>
                        <td>:</td>
                        <td><?=$detail_produk->masa_berlaku?></td>
                      </tr>
                      <tr>
                        <th>No. Produk Penyedia</th>
                        <td>:</td>
                        <td><?=$detail_produk->no_produk_penyedia?></td>
                      </tr>
                      <tr>
                        <th>Unit Pengukuran</th>
                        <td>:</td>
                        <td><?=$detail_produk->unit_pengukuran?></td>
                      </tr>
                      <tr>
                        <th>Kode KBKI</th>
                        <td>:</td>
                        <td><button class="btn btn-primary"><?=$detail_produk->kode_kbki?></button></td>
                      </tr>
                      <tr>
                        <th>Nilai TKDN(%)</th>
                        <td>:</td>
                        <td><?=$detail_produk->nilai_tkdn?>&nbsp;<i style="color:maroon" class="fas fa-external-link-alt"></i></td>
                      </tr>
                      <tr>
                        <th>Deskripsi</th>
                        <td>:</td>
                        <td><?=$detail_produk->deskripsi?></td>
                      </tr>
                      <tr>
                        <th colspan="3"><b style="color:blue">Spesifikasi lainnya</b></th>
                      </tr>
                      <?php foreach($spesifikasi as $data){?>
                        <tr>
                        <th style="text-transform: capitalize;"><?=$data->spesifikasi?></th>
                        <td>:</td>
                        <td><?=$data->nilai?></td>
                      </tr>
                        <?php }?>
                    </table>
                  </div>
                  <div class="col-md-6">
                  <?php if(!$detail_produk->foto){?>
                        <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="foto produk" width="450px">
                        <?php }else{?>
                        <img src="<?=base_url()?>uploads/foto_produk/<?=$detail_produk->foto?>" alt="foto produk" width="450px">
                        <?php }?>
                  </div>
              </div>
            </div>
            <a href="<?=base_url()?>Penyedia/etalase_produk" class="btn btn-dark">
            <i class="fas fa-angle-double-left"></i>
            Kembali</a>
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
