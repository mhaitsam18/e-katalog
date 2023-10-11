<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Kelola Berita</title>
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
            <h1>Kelola Berita</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Beranda</a></li>
              <li class="breadcrumb-item active">Berita</li>
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
                <h3 class="card-title">Data Berita</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <a href="<?=base_url()?>Penyedia/tambah_berita/0" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Tambah
                </a><br><br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Berita</th>
                    <th>Kategori Berita</th>
                    <th>Judul Berita</th>
                    <th>Penulis</th>
                    <th>Gambar Berita</th>
                    <th>Deskripsi</th>
                    <th>Tags</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;
                    foreach($berita as $data){?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$data->tanggal?></td>
                      <td><button class="btn btn-dark"><?=$data->nama_kb?></button></td>
                      <td><?=$data->judul?></td>
                      <td>
                      <i class="fas fa-user"></i>
                        Penulis
                        <?=$data->penulis?>
                      </td>
                      <td>
                        <?php if(!$data->gambar){
                          echo "Gambar Tidak Ada";
                        }else{?>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#poster<?=$data->id_berita?>">
                        <i class="fas fa-image"></i>  
                        Poster
                        </button>
                        <?php }?>
                      </td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg<?=$data->id_berita?>">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        Deskripsi
                      </button>
                      </td>
                      <td>
                      <a href="<?=base_url()?>Penyedia/tag_berita/<?=$data->id_berita?>" class="btn btn-warning">
                            <i class="fas fa-info-circle"></i>  
                        Tags</a>
                      </td>
                      <td>
                        <a href="<?=base_url()?>Penyedia/hapus_berita/<?=$data->id_berita?>" class="btn btn-danger">
                            <i class="fas fa-trash"></i>  
                        Hapus</a>
                      </td>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Berita</th>
                    <th>Kategori Berita</th>
                    <th>Judul Berita</th>
                    <th>Penulis</th>
                    <th>Gambar Berita</th>
                    <th>Deskripsi</th>
                    <th>Tags</th>
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
<!-- ./wrapper -->

<?php foreach($berita as $b) {?>
<div class="modal fade" id="poster<?=$b->id_berita?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Gambar <?=$b->judul?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <center>
              <img src="<?=base_url()?>uploads/poster_berita/<?=$b->gambar?>" alt="" width="600px">
              </center>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php } ?>

<?php foreach($berita as $b) {?>
<div class="modal fade" id="modal-lg<?=$b->id_berita?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Isi Berita <?=$b->judul?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5>Deskripsi</h5>
              <p><?=$b->body?></p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php } ?>

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
