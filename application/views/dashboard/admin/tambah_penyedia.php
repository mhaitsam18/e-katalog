<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Tambah Berita</title>
<link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
  href="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
              <h1>Kelola Penyedia</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Penyedia</li>
                <li class="breadcrumb-item active">Tambah Penyedia</li>
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
                  <h3 class="card-title">Tambah Data Penyedia</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <?php echo form_open_multipart('Admin/input_penyedia', array('method' => 'POST')); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_penyedia">Nama Penyedia</label>
                    <input type="text" name="nama_penyedia"
                      class="form-control <?=form_error('nama_penyedia') ? 'is-invalid' : '';?>"
                      placeholder="Nama Penyedia" id="nama_penyedia" value="<?=set_value('nama_penyedia');?>">
                    <?=form_error('nama_penyedia', '<small class="text-danger">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="alamat_penyedia">Alamat Penyedia</label>
                    <input type="text" name="alamat_penyedia"
                      class="form-control <?=form_error('alamat_penyedia') ? 'is-invalid' : '';?>"
                      placeholder="Alamat Penyedia" id="alamat_penyedia" value="<?=set_value('alamat_penyedia');?>">
                    <?=form_error('alamat_penyedia', '<small class="text-danger">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan</label>
                    <input type="text" name="nama_perusahaan"
                      class="form-control <?=form_error('nama_perusahaan') ? 'is-invalid' : '';?>"
                      placeholder="Nama Perusahaan" id="nama_perusahaan" value="<?=set_value('nama_perusahaan');?>">
                    <?=form_error('nama_perusahaan', '<small class="text-danger">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="bank">Nama Bank</label>
                    <input type="text" name="bank" class="form-control <?=form_error('bank') ? 'is-invalid' : '';?>"
                      placeholder="Nama Bank" id="bank" value="<?=set_value('bank');?>">
                    <?=form_error('bank', '<small class="text-danger">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="norek">Nomor Rekening</label>
                    <input type="number" name="norek" class="form-control <?=form_error('norek') ? 'is-invalid' : '';?>"
                      placeholder="Nomor Rekening" id="norek" value="<?=set_value('norek');?>">
                    <?=form_error('norek', '<small class="text-danger">', '</small>');?>
                  </div>
                  <div class="form-group">
                    <label for="etalase">Kategori Etalase</label>
                    <select class="select2 <?=form_error('etalase') ? 'is-invalid' : '';?>" id="etalase"
                      name="etalase[]" multiple="multiple" data-placeholder="Kategori Etalase" style="width: 100%;">
                      <?php foreach ($etalase as $e) {?>
                      <option value="<?=$e->id_etalase?>"><?=$e->nama_etalase?></option>
                      <?php }?>
                    </select>
                    <?=form_error('etalase', '<small class="text-danger">', '</small>');?>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class=" card-footer">
                  <a href="<?=base_url()?>Admin/penyedia" class="btn btn-danger">Kembali</a>
                  <input type="submit" value="Submit" class="btn btn-info">
                </div>
                <?php echo form_close(); ?>
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
              <button type="button" style="display:none" class="btn btn-warning toastrDefaultWarning">
                Launch Warning Toast
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
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
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
</body>

</html>