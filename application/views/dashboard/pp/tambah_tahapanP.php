<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Tambah Tahapan Pengumuman</title>
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
              <li class="breadcrumb-item active">Tambah Tahapan Pengumuman</li>
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
                <h3 class="card-title">Tambah Data Tahapan Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('PPK/inputTahapan', array('method' => 'POST',)); ?>
              <div class="card-body">
                  <div class="form-g">
                    <label>Pengumuman</label>
                    <select name="kategoriP" id="" class="form-control">
                        <option value="">-- Pilih Pengumuman --</option>
                        <?php foreach($pengumuman as $data){?>
                        <option value="<?=$data->id_pengumuman?>"><?=$data->judul ?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <br>
                  <label>Tahapan Pengumuman</label>
                  <br>
                    <table width="80%" cellpadding="8">
                        <tr>
                            <th colspan="3" style="color:blue">Format</th>
                        </tr>
                        <tr>
                            <td><b>Judul</b></td>
                            <td><b>Tanggal Mulai</b></td>
                            <td><b>Tanggal Akhir</b></td>
                            <td><b>Perubahan</b></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul1" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai1" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir1" class="form-control" id=""></td>
                            <td><textarea name="perubahan1" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul2" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai2" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir2" class="form-control" id=""></td>
                            <td><textarea name="perubahan2" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul3" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai3" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir3" class="form-control" id=""></td>
                            <td><textarea name="perubahan3" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul4" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai4" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir4" class="form-control" id=""></td>
                            <td><textarea name="perubahan4" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul5" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai5" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir5" class="form-control" id=""></td>
                            <td><textarea name="perubahan5" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="judul6" class="form-control" placeholder="Judul Jadwal"></td>
                            <td><input type="date" name="tanggalmulai6" class="form-control" id=""></td>
                            <td><input type="date" name="tanggalakhir6" class="form-control" id=""></td>
                            <td><textarea name="perubahan6" class="form-control" placeholder="Perubahan" id="" cols="30" rows="5"></textarea></td>
                        </tr>
                        <tr>
                    </table>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?=base_url()?>PPK/tambah_pengumuman/0" class="btn btn-danger">Kembali</a>
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
      dater: 3000
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
      dater: 3000
    });

    var announce = "Data gagal disimpan";
    $('.toastrDefaultError').hide(function() {
      toastr.error(announce)
    });
</script>
<?php }?>
</body>
</html>
