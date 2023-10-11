<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Detail Paket Negosiasi</title>
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
              <li class="breadcrumb-item"><a href="#">Paket Pengiriman</a></li>
              <li class="breadcrumb-item active">Detail Paket</li>
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
            <?php 
            if($nego->status == 5){?>
              <a href="<?=base_url()?>Penyedia/kelola_kirim" class="btn btn-danger">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
              </a>
            <?php }else{?>
                <a href="<?=base_url()?>Penyedia/kelola_selesai" class="btn btn-danger">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
              </a>
              <?php } ?>
              <br><br>
            <div class="card" style="background-color:maroon">
              <div class="card-header">
							<h3 class="card-title"><b style="color:white">Detail <?=$nego->nama_paket?> </b></h3>
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
														<th>Harga Produk</th>
														<th>Total Produk</th>
													</thead>
													<tbody>
														<?php
                            $no = 1;
                            foreach($produk as $data){?>
														<tr>
															<td>
																<?=$no++?>
															</td>
															<td>
																<?php if(!$data->foto){?>
																<img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png"
																	alt="Foto Produk" width="150px">
																<?php }else{?>
																<img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>"
																	alt="Foto Produk" width="150px">
																<?php }?>
															</td>
															<td>
																<b>
																	<?=$data->nama_produk?>
																</b><span>&nbsp;&nbsp;&nbsp;</span>
																<hr>
																<b>Spesifikasi</b><br>
																Merek :
																<?=$data->merek?> <br>
																Masa Berlaku :
																<?=$data->masa_berlaku?> <br>
																No Produk Penyedia :
																<?=$data->no_produk_penyedia?> <br>
																Deskripsi :
																<?=$data->deskripsi?> <br>
																<a href="<?=base_url()?>LandingPage/lihat_produk/<?=$data->id_produk?>"
																	target="__blank">Lihat Spesifikasi Lainnya</a>
															</td>
															<td>
																<?=$data->kuantitas?>
															</td>
															<td>
																<?=$data->unit_pengukuran?>
															</td>
															<td>Rp
																<?php echo number_format($data->harga,2,".",",");?>
															</td>
															<td>Rp
																<?php echo number_format($data->total,2,".",",");?>
															</td>
														</tr>
														<?php }?>
														<tr>
															<td colspan="5"><b>Subtotal</b></td>
															<td colspan="2" style="text-align:right"><b>Rp
																	<?php echo number_format($subtotal->total,2,".",",");?>
																</b></td>
														</tr>
														<tr>
															<td colspan="5"><b>PPN (11%)</b></td>
															<td colspan="2" style="text-align:right"><b
																	style="color:red">Rp
																	<?php 
                                $ppn = $subtotal->total*0.11;
                                echo number_format($ppn,2,".",",");?>
																</b></td>
														</tr>
														<tr>
															<td colspan="5"><b>Total Pembayaran</b></td>
															<td colspan="2" style="text-align:right"><b>Rp
																	<?php 
                                $total = $ppn+$subtotal->total;
                                echo number_format($total,2,".",",");?>
																</b></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-md-6">
												<br>
												<h3>Daftar Paket</h3>
												<br>
												<table class="table table-bordered table-striped">
													<thead>
														<th>Jenis</th>
														<th>Keterangan</th>
													</thead>
													<tr>
														<td>Nomor Anggaran PR</td>
														<td>
															<?=$nego->no_pr?>
														</td>
													</tr>
													<tr>
														<td>Nama Paket</td>
														<td>
															<?=$nego->nama_paket?>
														</td>
													</tr>
													<tr>
														<td>Pekerjaan</td>
														<td>
															<?=$nego->uraian_pekerjaan?>
														</td>
													</tr>
													<tr>
														<td>Tanggal Paket</td>
														<td>
															<?php
                            $date=date_create($nego->tanggal_mulai);
                            echo date_format($date,"d/m/Y");
                          ?>
															-
															<?php
                            $date=date_create($nego->tanggal_akhir);
                            echo date_format($date,"d/m/Y");
                          ?>
														</td>
													</tr>
													<tr>
														<td>Total Produk</td>
														<td>
															<?=$nego->jumlahproduk?>
														</td>
													</tr>
													<tr>
														<td>Total Harga</td>
														<td>Rp
															<?php echo number_format($nego->total,2,".",",");?>
															<?php
                                    function penyebut($nilai) {
                                    $nilai = abs($nilai);
                                    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                                    $temp = "";
                                    if ($nilai < 12) {
                                        $temp = " ". $huruf[$nilai];
                                    } else if ($nilai <20) {
                                        $temp = penyebut($nilai - 10). " belas";
                                    } else if ($nilai < 100) {
                                        $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                                    } else if ($nilai < 200) {
                                        $temp = " seratus" . penyebut($nilai - 100);
                                    } else if ($nilai < 1000) {
                                        $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                                    } else if ($nilai < 2000) {
                                        $temp = " seribu" . penyebut($nilai - 1000);
                                    } else if ($nilai < 1000000) {
                                        $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                                    } else if ($nilai < 1000000000) {
                                        $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                                    } else if ($nilai < 1000000000000) {
                                        $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                                    } else if ($nilai < 1000000000000000) {
                                        $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                                    }     
                                    return $temp;
                                }
                            
                                function terbilang($nilai) {
                                    if($nilai<0) {
                                        $hasil = "minus ". trim(penyebut($nilai));
                                    } else {
                                        $hasil = trim(penyebut($nilai));
                                    }     		
                                    return $hasil;
                                }
                            
                                $hasil = terbilang($nego->total);
                                ?>
															<br>
															<i style="text-transform:capitalize;color:red">
																<?=$hasil?>
															</i>
														</td>
													</tr>
													<tr>
														<td>Status</td>
														<td>
															<?php
                                if($nego->status == 0){?>
															<button class="btn btn-primary">Paket Dibuat</button>
															<?php }elseif($nego->status == 1){?>
															<button class="btn btn-primary">Persetujuan Paket</button>
															<?php }elseif($nego->status == 2){?>
															<button class="btn btn-warning">Ajukan Negosiasi</button>
															<?php }elseif($nego->status == 3){?>
															<button class="btn btn-warning">Negosiasi Kembali</button>
															<?php }elseif($nego->status == 4){?>
															<button class="btn btn-info">Review Paket</button>
															<?php }elseif($nego->status == 5){?>
															<button class="btn btn-dark">Pengiriman Paket oleh
																Penyedia</button>
															<?php }elseif($nego->status == 6){?>
															<button class="btn btn-success">Paket Sudah
																Terkirim</button>
															<?php }elseif($nego->status == 7){?>
															<button class="btn btn-danger">Paket Selesai</button>
															<?php }else{} ?>
														</td>
													</tr>
												</table>
												<br>
												<h3>Data Pengiriman</h3>
												<br>
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th>Alamat Lengkap</th>
													</thead>
													<tbody>
														<tr>
															<td>
																<?php if(!$nego->alamat_kirim){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																<?=$nego->alamat_kirim; }?>
															</td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="col-md-6">
												<br>
												<h3>Data Negosiasi</h3>
												<br>
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th>Jenis</th>
														<th>Keterangan</th>
													</thead>
													<tbody>
														<tr>
															<td>Posisi</td>
															<td>
																<?php
                                    if($nego->status == 0){?>
																<p>PUMK</p>
																<?php }elseif($nego->status == 1){?>
																<p>PP</p>
																<?php }elseif($nego->status == 2){?>
																<p>Penyedia</p>
																<?php }elseif($nego->status == 3){?>
																<p>PP</p>
																<?php }elseif($nego->status == 4){?>
																<p>PP</p>
																<?php }elseif($nego->status == 5){?>
																<p>Penyedia</p>
																<?php }elseif($nego->status == 6){?>
																<p>PUMK</p>
																<?php }elseif($nego->status == 7){?>
																<p>PP</p>
																<?php }else{} ?>
															</td>
														</tr>
														<tr>
															<th colspan="2">
																<center>
																	<p style="margin-bottom:2px"> Harga, Teknis,
																		dan Tanggal</p>
																</center>
															</th>
														</tr>
														<tr>
															<th colspan="2">Negosiasi Harga</th>
														</tr>
														<tr>
															<td>Nominal yang diajukan</td>
															<td>
																<?php if(!$nego_harga){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																Rp
																<?php echo number_format($nego_harga->nominal,2,".",",");?>
																<?php }?>
															</td>
														</tr>
														<tr>
															<td>Referensi Harga Ongkir</td>
															<td>
																<?php if(!$nego_harga){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																Rp
																<?php echo number_format($nego_harga->ongkir,2,".",",");?>
																<?php }?>
															</td>
														</tr>
														<tr>
															<td>Catatan</td>
															<td>
																<?php if(!$nego_harga){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																<b> Penyedia :</b>
																<?=$nego_harga->catatan_penyedia?> <br>
																<b>Pembeli &nbsp; :</b>
																<?=$nego_harga->catatan_pembeli?>
																<?php }?>
															</td>
														</tr>
														<tr>
															<th colspan="2">Negosiasi Teknis</th>
														</tr>
														<tr>
															<td>Spesifikasi teknis <br> yang diajukan</td>
															<td>
																<?php if(!$nego_spesifikasi || $nego_spesifikasi == NULL){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																<?=$nego_spesifikasi->catatan_pembeli?>
																<?php }?>
															</td>
														</tr>
														<tr>
															<td>Catatan dari penyedia</td>
															<td>
																<?php if(!$nego_spesifikasi || $nego_spesifikasi == NULL){?>
																<p>Tidak Ada</p>
																<?php }else{?>
																<?=$nego_spesifikasi->catatan_penyedia?>
																<?php }?>
															</td>
														</tr>
														<tr>
															<th colspan="2">Negosiasi Tanggal</th>
														</tr>
														<tr>
															<td>Tanggal Pengiriman
																<br>
																<?php if(!$nego_tanggal){?>
																<?php }else{?>
																<?php if($nego_tanggal->catatan_pembeli == NULL){?>
																	<span style="font-size:10px;color:red">(Pengajuan dari Penyedia)</span>
																	<?php }else{?>
																	<span style="font-size:10px;color:red">(Pengajuan dari PP)</span>
																	<?php }}?>
															</td>
															<td>
																<?php if(!$nego_tanggal){?>
																<p>Tidak Ada Negosiasi</p>
																<?php
                                    }else{
                                    $date=date_create($nego_tanggal->tanggal_mulai);
                                    echo date_format($date,"d/m/Y");
                                    echo "<br> - <br>";
                                    $date=date_create($nego_tanggal->tanggal_akhir);
                                    echo date_format($date,"d/m/Y");
                                    ?>
															</td>
														</tr>
														<tr>
															<td>Status</td>
															<td>
																<?php if($nego->status == 5){?>
																<p>Setuju</p>
																<?php }else{?>
																<p>Pending</p>
																<?php }?>
															</td>
														</tr>
														<tr>
															<td>Catatan</td>
															<td>
																<?php 
																	if(!$nego_tanggal){
																		echo "-";
																	if($nego_tanggal->catatan_penyedia == NULL){
																		echo "-";?>
																	<?=$nego_tanggal->catatan_penyedia?>
																	<?php }else{?>
																		<?=$nego_tanggal->catatan_pembeli?>
																<?php }}?>
															</td>
														</tr>
														<?php }?>
													</tbody>
												</table>
                    <br>
                    <?php if($nego->status == 2){?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#setuju<?=$nego->id_paket?>">
                    <i class="fas fa-check-circle"></i>
                        Setuju
                    </button>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#nego<?=$nego->id_paket?>">
                    <i class="fas fa-pencil-alt"></i>
                        Ajukan Negosiasi
                    </button>
                    <?php }else if($nego->status == 5){?>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kirim<?=$nego->id_paket?>">
                    <i class="fas fa-bus"></i>
                        Paket Sudah Dikirim
                    </button>
                    <?php }?>
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

      <div class="modal fade" id="setuju<?=$nego->id_paket?>">
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
                      <p>Apakah Anda yakin untuk <b>menyetujui</b> paket ini?</p>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?=base_url()?>Penyedia/persetujuan_paket/<?=$nego->id_paket?>" class="btn btn-danger">Setuju</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="kirim<?=$nego->id_paket?>">
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
                      <p>Apakah Anda yakin sudah <b>mengirimkan</b> paket ini sampai tujuan?</p>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
              <a href="<?=base_url()?>Penyedia/persetujuan_kirim/<?=$nego->id_paket?>" class="btn btn-danger">Setuju</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
</body>
</html>
