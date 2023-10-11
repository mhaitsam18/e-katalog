<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Riwayat Negosiasi Spesifik</title>
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
              <li class="breadcrumb-item active">Riwayat Negosiasi Harga</li>
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
          <a href="<?=base_url()?>PP/detail_paket_negosiasi/<?=$id?>" class="btn btn-danger">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
                </a><br><br>
            <div class="card" style="background-color:#007BFF">
              <div class="card-header">
                <h3 class="card-title"><b style="color:white">Detail Riwayat Negosiasi Spesifikasi</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background-color:white">
              <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                    <h3>Daftar Negosiasi Spesifikasi </h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Waktu</th>
                            <th>Oleh</th>
                            <th>Catatan Penyedia</th>
                            <th>Catatan Pembeli</th>
                        </thead>
                        <tbody>
													<tr>
														<td colspan="5"><span style="color:red;"><center>↓↓ Update Status Paket Terbaru ↓↓</center></span></td>
													</tr>
                            <?php 
                            $no = 1;
                            foreach($riwayat as $data){?>
                            <tr>
                                <td><?=$no++?></td>
                                <td><?=$data->tanggal?></td>
                                <td>
                                <?php 
                                    if(!$data->catatan_penyedia){?>
                                      PP ke Penyedia
                                    <?php }else if(!$data->catatan_pembeli){?>
                                      Penyedia ke PP
                                    <?php }else{?>
                                      <p>-</p>
                                    <?php } ?>
                               </td>
                               <td>
                               <?php  if(!$data->catatan_penyedia){
                                      echo "-";
                                      }else{
                                ?>
                               <?=$data->catatan_penyedia?>
                                <?php }?>
                                </td>
                               <td>
                               <?php  if(!$data->catatan_pembeli){
                                      echo "-";
                                      }else{
                                ?>
                               <?=$data->catatan_pembeli?>
                                <?php }?>
                               </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
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

<?php foreach($riwayat as $p) {?>
<div class="modal fade" id="modal-lg<?=$p->id_paket?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Catatan Negosiasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-8">
                  <b>Catatan Pembeli</b><br><br>
                  <?php if(!$p->catatan_pembeli){?>
                  <textarea name="catatan" id="" cols="100" rows="5" disabled>Tidak Ada</textarea>
                  <?php }else{?>
                  <textarea name="catatan" id="" cols="100" rows="5" disabled><?=$p->catatan_pembeli?></textarea>
                  <?php }?>
                  <br><br>
                  <b>Catatan Penyedia</b><br><br>
                  <?php if(!$p->catatan_penyedia){?>
                  <textarea name="catatan" id="" cols="100" rows="5" disabled>Tidak Ada</textarea>
                  <?php }else{?>
                  <textarea name="catatan" id="" cols="100" rows="5" disabled><?=$p->catatan_penyedia?></textarea>
                  <?php }?>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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