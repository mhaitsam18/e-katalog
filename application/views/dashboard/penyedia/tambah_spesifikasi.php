<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Tambah Spesifikasi</title>
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
              <li class="breadcrumb-item active">Tambah Spesifikasi Etalase Produk</li>
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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Data Spesifikasi</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('Penyedia/inputSpesifikasi', array('method' => 'POST',)); ?>
              <div class="card-body">
                  <div class="form-g">
                    <label>Produk</label>
                    <select name="kategori" id="" class="form-control">
                        <option value="">-- Pilih Produk --</option>
                        <?php foreach($produk as $data){?>
                        <option value="<?=$data->id_produk?>"><?=$data->nama_produk?> - <?php echo number_format($data->harga,2,".",",");?> </option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <br>
                  <label>Spesifikasi Produk</label>
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
                            <td style="color:grey">Warna Produk</td>
                            <td style="color:grey">=</td>
                            <td style="color:grey">Biru,Hitam,Coklat</td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi1" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td>
                            <input type="text" name="nilai1" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi2" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai2" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi3" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai3" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi4" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai4" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi5" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai5" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        
                        <tr>
                            <td><input type="text" name="spesifikasi6" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai6" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi7" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai7" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi8" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai8" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi9" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai9" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="spesifikasi10" class="form-control" placeholder="Spesifikasi Produk"></td>
                            <td>=</td>
                            <td><input type="text" name="nilai10" class="form-control" placeholder="Nilai Spesifikasi"></td>
                        </tr>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?=base_url()?>Penyedia/tambah_produk/0" class="btn btn-danger">Kembali</a>
                  <input type="submit" value="Submit" class="btn btn-info">
                </div> 
            </div>
                <button type="button" style="display:none" class="btn btn-success toastrDefaultSuccess">
                  Launch Success Toast
                </button>
                <button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
                  Launch Error Toast
                </button>
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
<script src="<?=base_url()?>assets/dashboard/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?=base_url()?>assets/dashboard/plugins/toastr/toastr.min.js"></script>
<!-- Page specific script -->
<?php if($hasil == "berhasil"){?>
<script>
      var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
    var announce = "Data tersimpan";
    $('.toastrDefaultSuccess').hide(function() {
      toastr.success(announce)
    })
</script>
<?php }else if($hasil == "gagal"){?>
<script>
      var Toast2 = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var announce = "Data gagal disimpan";
    $('.toastrDefaultError').hide(function() {
      toastr.error(announce)
    });
</script>
<?php }?>
</body>
</html>
