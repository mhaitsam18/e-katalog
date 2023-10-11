<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Kelola Paket Selesai</title>
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
              <li class="breadcrumb-item active">Selesai</li>
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
                <h3 class="card-title">Data Paket Diproses atau Sedang Dikirim</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($proses as $d){
                    if (!$d->id_paket){?>
                    <tr>
                      <td colspan="8">
                      <center>  
                      Tidak Ada Data
                      </center>
                      </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$d->nama_paket?></td>
                      <td> <?php
                            $date=date_create($d->tanggal_mulai);
                            echo date_format($date,"d/m/Y");
                          ?>
                          -
                          <?php
                            $date=date_create($d->tanggal_akhir);
                            echo date_format($date,"d/m/Y");
                          ?></td>
                      <td><?=$d->jumlahproduk?></td>
                      <td>
                      <center>
                        <?php if(!$d->dokumen){?>
													Dokumen belum diupload
												<?php }else{?>
													<a href="<?=base_url()?>uploads/dokumen/<?=$d->dokumen?>" target="download" class="btn btn-success btn-inline-blok btn-sm">
                        <i class="fas fa-folder"></i>
                        Dokumen
                        </a>
												<?php }?>
                        </center> 
                      </td>
                      <td>
                      <?php
                                if($d->status == 1){?>
                                <button class="btn btn-primary">Persetujuan Paket</button>
                                <?php }elseif($d->status == 2){?>
                                <button class="btn btn-warning">Negosiasi ke Penyedia</button>
                                <?php }elseif($d->status == 3){?>
                                <button class="btn btn-warning">Negosiasi ke Kembali</button>
                                <?php }elseif($d->status == 4){?>
                                <button class="btn btn-warning">Review Paket</button>
                                <?php }elseif($d->status == 5){?>
                                <button class="btn btn-warning">Pengiriman Paket oleh Penyedia</button>
                                <?php }elseif($d->status == 6){?>
                                <button class="btn btn-warning">Paket Sudah Terkirim</button>
                                <?php }elseif($d->status == 7){?>
                                <button class="btn btn-warning">Paket Selesai</button>
                                <?php }else{} ?>
                      </td>
                      <td>
                               <?php if($d->status == 5){ ?>
                                <a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                                Detail
                                </a>
                               <?php }elseif($d->status == 6){?>
																Segera verifikasi pada PUMK
                               <?php }elseif($d->status == 7){?>
                                <a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                                Detail
                                </a>
                                <?php }else{
                                  echo "-";
                                } ?>
                      </td>
                    </tr>
                    <?php }}?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>No</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Dokumen</th>
                    <th>Status</th>
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

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Paket Selesai Diterima</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Dokumen</th>
										<th>No. Receipt</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($selesai as $d){
                    if (!$d->id_paket){?>
                    <tr>
                      <td colspan="8">
                      <center>  
                      Tidak Ada Data
                      </center>
                      </td>
                    </tr>
                    <?php }else{ ?>
                    <tr>
                      <td><?=$no++?></td>
                      <td><?=$d->nama_paket?></td>
                      <td> <?php
                            $date=date_create($d->tanggal_mulai);
                            echo date_format($date,"d/m/Y");
                          ?>
                          -
                          <?php
                            $date=date_create($d->tanggal_akhir);
                            echo date_format($date,"d/m/Y");
                          ?></td>
                      <td><?=$d->jumlahproduk?></td>
                      <td>
                      <center>
                        <?php if(!$d->dokumen){?>
													Dokumen belum diupload
												<?php }else{?>
													<a href="<?=base_url()?>uploads/dokumen/<?=$d->dokumen?>" target="download" class="btn btn-success btn-inline-blok btn-sm">
                        <i class="fas fa-upload"></i>
                        Dokumen
                        </a>
												<?php }?>
                        </center> 
                      </td>
											<td>
											<center>
                        <?php if(!$d->receipt){?>
													<span style="color:red">Receipt belum diupload</span>
												<?php }else{
													echo $d->receipt;
												 }?>
                        </center> 
											</td>
                      <td>
                      <?php
                                if($d->status == 1){?>
                                <button class="btn btn-primary">Persetujuan Paket</button>
                                <?php }elseif($d->status == 2){?>
                                <button class="btn btn-warning">Negosiasi ke Penyedia</button>
                                <?php }elseif($d->status == 3){?>
                                <button class="btn btn-warning">Negosiasi ke Kembali</button>
                                <?php }elseif($d->status == 4){?>
                                <button class="btn btn-warning">Review Paket</button>
                                <?php }elseif($d->status == 5){?>
                                <button class="btn btn-warning">Pengiriman Paket oleh Penyedia</button>
                                <?php }elseif($d->status == 6){?>
                                <button class="btn btn-warning">Paket Sudah Terkirim</button>
                                <?php }elseif($d->status == 7){?>
                                <button class="btn btn-warning">Paket Selesai</button>
                                <?php }else{} ?>
                      </td>
                      <td>
                               <?php if($d->status == 5){ ?>
                                <a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                                Detail
                                </a>
                               <?php }elseif($d->status == 6){?>
                                    Segera verifikasi pada PUMK
                               <?php }elseif($d->status == 7){?>
                                <a href="<?=base_url()?>PP/detail_paket/<?=$d->id_paket?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                                Detail
                                </a>
                                <?php }else{
                                  echo "-";
                                } ?>
                      </td>
                    </tr>
                    <?php }}?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>No</th>
                    <th>Nama Paket</th>
                    <th>Tanggal Paket</th>
                    <th>Total Produk</th>
                    <th>Dokumen</th>
										<th>No.Receipt</th>
                    <th>Status</th>
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

<?php foreach($kirim as $d){?>
<div class="modal fade" id="verif<?=$d->id_paket?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi Paket</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-8">
                      <p>Apakah Anda yakin untuk melakukan <b>verifikasi</b> paket <?=$d->id_paket?> ini sudah sampai ditempat?</p>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
              <a href="<?=base_url()?>PP/verifikasi_paket/<?=$d->id_paket?>" class="btn btn-danger">Iya</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php }?>

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

<!-- Status 

paket baru 0 - belum ada no pr
paket baru 1 - udah ada no pr
paket pending - pp
paket nego ke pp - pp
paket nego ke penyedia - penyedia
paket disetujui - penyedia & pp
paket direview - pp
paket diproses - penyedia
paket dikirim - pp
paket diverifikkasi - pumk -->

