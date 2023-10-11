<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Edit Produk</title>
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
              <h1>Kelola Etalase Produk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                <li class="breadcrumb-item active">Etalase Produk</li>
                <li class="breadcrumb-item active">Edit Etalase Produk</li>
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
                  <h3 class="card-title">Edit Data Etalase Produk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php echo form_open_multipart('Penyedia/updateProduk', array('method' => 'POST')); ?>
                <div class="card-body">
                  <div class="form-g">
                    <label>Kategori Etalase Produk</label>
                    <input type="hidden" name="id" value="<?=$detail_produk->id_produk?>">
                    <select name="kategori" id="" class="form-control">
                      <option value="<?=html_escape($detail_produk->id_etalase)?>"><?=$detail_produk->nama_etalase?>
                      </option>
                      <option value="">-- Pilih Kategori --</option>
                      <?php foreach ($etalase_produk as $etalase) {?>
                      <option value="<?=html_escape($etalase->id_etalase)?>"><?=$etalase->nama_etalase?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk"
                      value="<?=html_escape($detail_produk->nama_produk)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Merk Produk</label>
                    <input type="text" name="merk" class="form-control" placeholder="Merk"
                      value="<?=html_escape($detail_produk->merek)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Masa Berlaku Produk</label>
                    <input type="date" name="masaberlaku" class="form-control"
                      value="<?=html_escape($detail_produk->masa_berlaku)?>">
                  </div>
                  <div class="form-group">
                    <label for="" style="display:block;margin-bottom:-4px">Harga Produk</label>
                    <span style="color:red;font-size:12px">*harga yang ditampilkan akan ditambahkan otomatis 11% untuk
                      PPN </span>
                    <input type="number" name="hargaproduk" class="form-control" placeholder="Harga Produk"
                      value="<?=html_escape($detail_produk->harga)?>">
                  </div>
                  <div class="form-group">
                    <label for="">No. Produk Penyedia</label>
                    <input type="text" name="noproduk" class="form-control"
                      value="<?=html_escape($detail_produk->no_produk_penyedia)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Unit Pengukuran</label>
                    <input type="text" name="unit" class="form-control" placeholder="Unit Pengukuran"
                      value="<?=html_escape($detail_produk->unit_pengukuran)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Kode KBKI</label>
                    <input type="text" name="kode" class="form-control" placeholder="Kode KBKI (Contoh :0,0)"
                      value="<?=html_escape($detail_produk->kode_kbki)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Nilai TKDN</label>
                    <input type="text" name="nilai" class="form-control" placeholder="Nilai TKDN (%)"
                      value="<?=html_escape($detail_produk->nilai_tkdn)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Stok Produk</label>
                    <input type="number" name="stokproduk" class="form-control" placeholder="Stok Produk"
                      value="<?=html_escape($detail_produk->stok)?>">
                  </div>
                  <div class="form-group">
                    <label for="">Foto Produk</label><br>
                    <?php if (!$detail_produk->foto) {?>
                    <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk" width="150px">
                    <?php } else {?>
                    <img src="<?=base_url()?>uploads/foto_produk/<?=$detail_produk->foto?>" alt="Foto Produk"
                      width="150px">
                    <?php }?>
                    <input type="file" name="foto" id="">
                  </div>
                  <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" id="" cols="15"
                      rows="6"><?=$detail_produk->deskripsi?></textarea>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="<?=base_url()?>Penyedia/etalase_produk" class="btn btn-danger">Kembali</a>
                  <input type="submit" value="Submit" class="btn btn-info">
                  <a href="<?=base_url()?>Penyedia/edit_spesifikasi/<?=$detail_produk->id_produk?>"
                    class="btn btn-warning tampilkan" style="color:white">
                    <i class="fas fa-edit"></i>
                    Edit Spesifikasi
                  </a>
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
  <script>
  $(function() {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
  </script>
  <?php if ($hasil == "berhasil") {?>
  <script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  var announce = "Data Sudah Diperbaharui";
  $('.toastrDefaultSuccess').hide(function() {
    toastr.success(announce)
  })
  </script>
  <?php } else if ($hasil == "gagal") {?>
  <script>
  var Toast2 = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

  var announce = "Data Gagal Diperbaharui";
  $('.toastrDefaultError').hide(function() {
    toastr.error(announce)
  });
  </script>
  <?php }?>
</body>

</html>