<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Tambah Negosiasi Spesifikasi</title>
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
              <li class="breadcrumb-item"><a href="#">Kelola Paket</a></li>
              <li class="breadcrumb-item"><a href="#">Paket Baru</a></li>
              <li class="breadcrumb-item active">Negosiasi Spesifikasi</li>
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
                <a href="<?=base_url()?>Penyedia/detail_nego/<?=$nego->id_paket?>" class="btn btn-danger">
                <i class="fas fa-arrow-alt-circle-left"></i>
                Kembali
                </a>
              <br><br>
            <div class="card" style="background-color:maroon">
              <div class="card-header">
                <h3 class="card-title"><b style="color:white">Negosiasi Paket <?=$nego->nama_paket?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background-color:white">
              <div class="modal-body">
							<div class="row">
                  <div class="col-md-12">
                    <h3>Daftar Produk</h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th colspan="2">Kuantitas</th>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach($produk as $data){?>
                            <tr>
                                <td><?=$no++?></td>
                                <td>
                                    <?php if(!$data->foto){?>
                                    <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk" width="150px">
                                    <?php }else{?>
                                    <img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>" alt="Foto Produk" width="150px">
                                    <?php }?>
                                </td>
                                <td>
                                  <b><?=$data->nama_produk?></b>
                                  <hr>
                                  <b>Spesifikasi</b><br>
                                  Merek : <?=$data->merek?> <br>
                                  Masa Berlaku : <?=$data->masa_berlaku?> <br>
                                  No Produk Penyedia : <?=$data->no_produk_penyedia?> <br>
                                  Deskripsi : <?=$data->deskripsi?> <br>
                                  <a href="<?=base_url()?>LandingPage/lihat_produk/<?=$data->id_produk?>" target="__blank">Lihat Spesifikasi Lainnya</a>
                                </td>
                                <td><?=$data->kuantitas?></td>
                                <td><?=$data->unit_pengukuran?></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-12">
                    <br>
                    <h3>Ajukan Negosiasi Spesifikasi Teknis</h3>
                    <br>
                    <?php echo form_open_multipart('Penyedia/input_ns', array('method' => 'POST',)); ?>
                    <input type="hidden" name="idpaket" value="<?=$nego->id_paket?>">
                    <input type="hidden" name="check" value="<?=$check?>">
										<table id="example1" class="table table-bordered table-striped">
                        <tbody>
														<?php if($check == "ada"){?>
														<tr>
                                <td>Catatan Dari Pembeli</td>
                                <td>
                                    <textarea class="form-control" disabled cols="30" rows="6"><?=$nego_spesifikasi->catatan_pembeli?></textarea>
                                </td>
                            </tr>
														<?php }?>
                            <tr>
                                <td>Spesifikasi Teknis</td>
																<td>
                                    <textarea name="spesifikasi" class="form-control" cols="30" rows="6"></textarea>
                                </td>
                            </tr>
                            <tr>
                              <td></td>
                              <td style="float:right"><input type="submit" value="Ajukan" class="btn btn-danger"></td>
                            </tr>
                        </tbody>
                    </table>
                    </form>
                  </div>
              </div>
            </div>
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
</body>
</html>
