<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Edit Spesifikasi</title>
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/codemirror/theme/monokai.css">
  <!-- SimpleMDE -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/simplemde/simplemde.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/toastr/toastr.min.css">
</head>
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
              <li class="breadcrumb-item active">Etalase Produk</li>
              <li class="breadcrumb-item active">Edit Spesifikasi Etalase Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Edit Data Spesifikasi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('Penyedia/updateSpesifikasi', array('method' => 'POST',)); ?>
              <div class="card-body">
                  <div class="form-group">
                    <br>
                  <label>Spesifikasi Produk <?=$data->nama_produk?></label>
                  <br>
                    <table width="80%" cellpadding="8">
                        <tr>
                            <th colspan="3" style="color:blue">Format</th>
                        </tr>
                        <tr>
                            <td><b>Judul Spesifikasi</b></td>
                            <td>=</td>
                            <td><b>Nilai Spesifikasi</b></td>
                        </tr>
                        <tr>
                            <th colspan="3" style="color:blue">Contoh</th>
                        </tr>
                        <tr>
                            <td>Warna Produk</td>
                            <td>=</td>
                            <td>Biru,Hitam,Coklat</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi" class="form-control" placeholder="Spesifikasi Produk" value="<?=$data->spesifikasi?>"></td>
                            <td>=</td>
                            <td>
                            <input type="text" name="nilai" class="form-control" placeholder="Nilai Spesifikasi" value="<?=$data->nilai?>">
                            <input type="hidden" name="id" class="form-control" value="<?=$data->id_meta?>">
                            </td>
                        </tr>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?=base_url()?>Penyedia/edit_spesifikasi/<?=$data->id_produk?>" class="btn btn-danger">Kembali</a>
                    <input type="submit" value="Submit" class="btn btn-info">
                </div> 
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<!-- ./wrapper -->

<!-- jQuery -->
<?php include "script.php"?>

</body>
</html>
