<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Tambah Merek</title>
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
            <h1>Kelola Pengumuman</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Pengumuman</li>
              <li class="breadcrumb-item active">Tambah Merek</li>
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
                <h3 class="card-title">Tambah Data Merek</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('Penyedia/inputMerek', array('method' => 'POST',)); ?>
              <div class="card-body">
                  <div class="form-g">
                    <label>Pengumuman</label>
                    <select name="kategoriP" id="" class="form-control">
                        <option value="">-- Pilih Pengumuman --</option>
                        <?php foreach($pengumuman as $data){?>
                        <option value="<?=$data->id_pengumuman?>"><?=$data->judul?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <br>
                  <label>Data Merek</label>
                  <br>
                    <table width="100%" cellpadding="8">
                        <tr>
                            <td><b>Merek</b></td>
                            <td><b>Deskripsi</b></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="merek1" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi1" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                         <tr>
                            <td><input type="text" name="merek2" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi2" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                         <tr>
                            <td><input type="text" name="merek3" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi3" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                         <tr>
                            <td><input type="text" name="merek4" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi4" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                         <tr>
                            <td><input type="text" name="merek5" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi5" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                         <tr>
                            <td><input type="text" name="merek6" class="form-control" placeholder="Merek"></td>
                            <td><textarea name="deskripsi6" class="form-control" placeholder="Deskripsi" id="" cols="100" rows="1"></textarea></td>
                        </tr>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?=base_url()?>Penyedia/tambah_pengumuman/0" class="btn btn-danger">Kembali</a>
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
