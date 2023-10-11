<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Detail Produk</title>
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
              <li class="breadcrumb-item active">Etalase Produk</li>
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
                <h3 class="card-title">Data Etalase Produk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <a href="<?=base_url()?>Penyedia/tambah_produk/0" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        Tambah
                  </a><br><br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Merk</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Informasi</th>
                    <th>Harga Produk <br>
                        <span style="font-size:12px;color:red">*harga setelah pajak</span>
                    </th>
                    <th>Stok</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no = 1;
                    foreach($produk as $data){?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$data->merek?>
											</td>
                      <td><?=$data->nama_etalase?></td>
                      <td>
                        <?php if(!$data->foto){?>
                        <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="foto produk" width="200px">
                        <?php }else{?>
                        <img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>" alt="foto produk" width="200px">
                        <?php }?>
                      </td>
                      <td><?=$data->nama_produk?></td>
                      <td>
												<center>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg<?=$data->id_produk?>">
                          <i class="fa fa-info-circle" aria-hidden="true"></i>
                          Spesifikasi
                        </button>
                        <br>
                        <a style="color:white" href="<?=base_url()?>Penyedia/lampiran/<?=$data->id_produk?>" class="btn btn-warning">
                        <i class="fas fa-file"></i>
                        Lampiran
                        </a><br>
												</center>
                      </td>
                      <td>Rp <?php echo number_format($data->harga_ppn,2,".",",");?></td>
                      <td><?=$data->stok?></td>
                      <td>
                        <a href="<?=base_url()?>Penyedia/edit_produk/<?=$data->id_produk?>" class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                        </a>
                        <a href="<?=base_url()?>Penyedia/hapus_produk/<?=$data->id_produk?>" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Hapus
                        </a>
                      </td>
                    </tr>
                    <?php }?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Merk</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Informasi</th>
                    <th>Harga Produk</th>
                    <th>Stok</th>
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

<?php foreach($produk as $p) {?>
<div class="modal fade" id="modal-lg<?=$p->id_produk?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Spesifikasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5>Produk <?=$p->nama_produk?></h5>
              <div class="row">
                  <div class="col-md-6">
                    <table cellpadding="10">
                      <tr>
                        <th>Merk</th>
                        <td>:</td>
                        <td><?=$p->merek?></td>
                      </tr>
                      <tr>
                        <th>Masa Berlaku Produk</th>
                        <td>:</td>
                        <td><?=$p->masa_berlaku?></td>
                      </tr>
                      <tr>
                        <th>No. Produk Penyedia</th>
                        <td>:</td>
                        <td><?=$p->no_produk_penyedia?></td>
                      </tr>
                      <tr>
                        <th>Unit Pengukuran</th>
                        <td>:</td>
                        <td><?=$p->unit_pengukuran?></td>
                      </tr>
                      <tr>
                        <th>Kode KBKI</th>
                        <td>:</td>
                        <td><button class="btn btn-primary"><?=$p->kode_kbki?></button></td>
                      </tr>
                      <tr>
                        <th>Nilai TKDN(%)</th>
                        <td>:</td>
                        <td><?=$p->nilai_tkdn?>&nbsp;<i style="color:maroon" class="fas fa-external-link-alt"></i></td>
                      </tr>
                      <tr>
                        <th>Deskripsi</th>
                        <td>:</td>
                        <td><?=$p->deskripsi?></td>
                      </tr>
                      <tr>
                        <th colspan="3"><a href="<?=base_url()?>Penyedia/spesifikasi_produk/<?=$p->id_produk?>">Spesifikasi lainnya</a></th>
                      </tr>
                    </table>
                  </div>
                  <div class="col-md-6">
                        <?php if(!$p->foto){?>
                        <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="foto produk" width="350px">
                        <?php }else{?>
                        <img src="<?=base_url()?>uploads/foto_produk/<?=$p->foto?>" alt="foto produk" width="350px">
                        <?php }?>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
        Launch Error Toast
      </button>
      <script>
      $('.toastrDefaultError').hide();
      </script>
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
  });
</script>
</body>
</html>
