<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Tambah Pengumuman</title>
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
              <li class="breadcrumb-item active">Tambah Pengumuman</li>
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
                <h3 class="card-title">Tambah Data Pengumuman</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open_multipart('PPK/inputPengumuman', array('method' => 'POST',)); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Judul Pengumuman</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul Pengumuman" id="">
                  </div>
                  <div class="form-group">
                    <label for="">Etalase Produk</label>
                    <select name="kategori" id="" class="form-control">
                        <option value="">-- Pilih Etalase --</option>
                        <?php foreach($kategori as $data){?>
                        <option value="<?=$data->id_etalase?>"><?=$data->nama_etalase?></option>
                        <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Syarat dan Ketentuan</label>
                    <textarea id="summernote" name="syarat">
                        
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="">Dokumen Pengumuman</label><br>
                    <input type="file" name="filedokumen" id="">
                  </div>
                  <div class="form-group">
                    <label for="">Jumlah Penawaran</label>
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Penawaran" id="">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <a href="<?=base_url()?>PPK/pengumuman" class="btn btn-danger">Kembali</a>
                  <input type="submit" value="Submit" class="btn btn-info">
                  <a style="color:white" href="<?=base_url()?>PPK/tambah_merek/1" class="btn btn-warning tampilkan">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  Merek
                  </a>
                  <a href="<?=base_url()?>PPK/tambah_tahapan/1" class="btn btn-success tampilkan">
                  <i class="fa fa-plus" aria-hidden="true"></i>
                  Tahapan Pengumuman
                  </a>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
                <button type="button" style="display:none" class="btn btn-success toastrDefaultSuccess">
                  Launch Success Toast
                </button>
                <button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
                  Launch Error Toast
                </button>
                <button type="button" style="display:none" class="btn btn-danger toastrDefaultWarning">
                  Launch Error Toast
                </button>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
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
    var announce = "Isi merek&tahapan terlebih dahulu dengan klik tombol +";
    $('.toastrDefaultWarning').hide(function () {
        toastr.warning(announce)
    });
    $('.tampilkan').show();
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
