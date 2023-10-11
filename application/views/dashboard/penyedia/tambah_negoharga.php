<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Tambah Negosiasi Harga</title>
<link rel="stylesheet" href="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet"
	href="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
								<li class="breadcrumb-item active">Negosiasi Harga</li>
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
									<h3 class="card-title"><b style="color:white">Negosiasi Paket
											<?=$nego->nama_paket?></b></h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body" style="background-color:white">
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<h3>Daftar Produk</h3>
												<?php echo form_open_multipart('Penyedia/input_nh', array('method' => 'POST',)); ?>
													<input type="hidden" name="check" value="<?=$check?>">
													<input type="hidden" name="id_paket" value="<?=$nego->id_paket?>">
												<table id="example1" class="table table-bordered table-striped">
														<thead>
															<th>No</th>
															<th>Foto Produk</th>
															<th>Nama Produk</th>
															<th colspan="2">Kuantitas</th>
															<th>Harga Produk
																<span style="color:red;font-size:10px">*harga belum termasuk ppn</span>
															</th>
															<?php if($check == "ada"){?>
															<th>
															<span style="color:red">Harga Negosiasi Saat Ini</span>
															</th>
															<th>Catatan Negosiasi PP</th>
															<th><span style="color:red">Catatan Negosiasi Dari Penyedia</span></th>
															<?php }else{?>
															<th>
															<span style="color:red">Ajukan Negosiasi</span>
															</th>
															<th><span style="color:red">Catatan Negosiasi Dari Penyedia</span></th>
															<?php }?>
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
																<td><?=$data->nama_produk?></td>
																<td><?=$data->kuantitas?>
																		<input type="hidden" name="kuantitas<?=$no-1?>" value="<?=$data->kuantitas?>" id="">
																</td>
																<td><?=$data->unit_pengukuran?></td>
																<td>Rp
																	<?php echo number_format($data->harga,2,".",",");?>
																	<input type="hidden" name="id<?=$no-1?>" value="<?=$data->id_keranjang?>">
																</td>
															<?php if($check == "ada"){?>
																<td><input type="number" name="nominal<?=$no-1?>"
																		class="form-control" value="<?=$data->nominal?>"
																		placeholder="Masukan Nominal" id=""></td>
																		<td>
																	<textarea
																		class="form-control" id="" cols="30"
																		rows="8" disabled><?=$data->catatan_pembeli?></textarea>
																</td>
																<td>
																	<textarea name="catatanpenyedia<?=$no-1?>"
																		placeholder="Catatan Negosiasi"
																		class="form-control" id="" cols="30"
																		rows="8"></textarea>
																</td>
															<?php }else{?>
																<td><input type="number" name="nominal<?=$no-1?>"
																		class="form-control" value="<?=$data->harga?>"
																		placeholder="Masukan Nominal" id=""></td>
																<td>
																	<textarea name="catatanpenyedia<?=$no-1?>"
																		placeholder="Catatan Negosiasi"
																		class="form-control" id="" cols="30"
																		rows="8"></textarea>
																</td>
															<?php }?>
															</tr>
															<?php }?>
															<tr>
																<td colspan="5"><b>Ongkir</b></td>
																<td style="text-align:right"><b>Rp
																		<?php
																		if($check == "belum ada"){
																			echo number_format(0,2,".",",");
																		}else{
																			echo number_format($nego_harga->ongkir,2,".",",");
																		}
																		?>
																	</b></td>
																<td><input type="number" name="ongkir"
																		class="form-control"
																		value="0"
																		placeholder="Ongkos Kirim" id=""></td>
																<td rowspan="4" colspan="2">
																	<b>Keterangan</b><br>
																	<textarea name="keterangan" id="" cols="30" rows="10" class="form-control" placeholder="Catatan Tambahan Negosiasi"></textarea>
																</td>
															</tr>
														<?php if($check == "belum ada"){?>
														<tr>
															<td colspan="5"><b>Subtotal</b></td>
															<td style="text-align:right"><b>Rp
																	<?php echo number_format($subtotal->total,2,".",",");?>
																</b></td>
																<td></td>
														</tr>
														<tr>
															<td colspan="5"><b>PPN (11%)</b></td>
															<td style="text-align:right"><b
																	style="color:red">Rp
																	<?php 
                                $ppn = $subtotal->total*0.11;
                                echo number_format($ppn,2,".",",");?>
																</b></td>
																<td></td>
														</tr>
														<tr>
															<td colspan="5"><b>Total Pembayaran</b></td>
															<td style="text-align:right"><b>Rp
																	<?php 
                                $total = $ppn+$subtotal->total;
                                echo number_format($total,2,".",",");?>
																</b></td>
																<td></td>
														</tr>
														<?php }else{?>
														<tr>
															<td colspan="5"><b>Total Pembayaran</b></td>
															<td style="text-align:right"><b>Rp
																	<?php 
                                echo number_format($nego_harga->nominal,2,".",",");?>
																</b></td>
																<td></td>
														</tr>
														<?php }?>
														</tbody>
													</table>
													<input type="submit" class="btn btn-danger" value="Ajukan Negosiasi" style="float:right">
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
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
			reserved.
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
					<a href="<?=base_url()?>PBJ/persetujuan_paket/<?=$nego->id_paket?>"
						class="btn btn-danger">Setuju</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="modal fade" id="tolak<?=$nego->id_paket?>">
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
							<p>Apakah Anda yakin untuk <b>menolak</b> paket ini?</p>
						</div>
					</div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="<?=base_url()?>PBJ/penolakan_paket/<?=$nego->id_paket?>" class="btn btn-danger">Tolak</a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>

	<div class="modal fade" id="nego<?=$nego->id_paket?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><b>Negosiasi</b> Paket</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<p>Apakah Anda yakin untuk melakukan <b>negosiasi</b> paket ini?</p>
							<p>Jika iya klik tombol dibawah ini</p>
							<a href="<?=base_url()?>PBJ/negosiasi_harga/<?=$nego->id_paket?>" class="btn btn-primary">
								<i class="fas fa-money-bill"></i>
								Negosiasi Harga Saja
							</a>
							<a href="<?=base_url()?>PBJ/negosiasi_spesifikasi/<?=$nego->id_paket?>"
								class="btn btn-danger">
								<i class="fas fa-server"></i>
								Negosiasi Spesifikasi Saja
							</a>
							<a href="<?=base_url()?>PBJ/negosiasi_all/<?=$nego->id_paket?>" class="btn btn-warning">
								<i class="fas fa-handshake"></i>
								Negosiasi Harga & Spesifikasi</a>
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

	<!-- jQuery -->
	<?php include "script.php"?>
	<script src="<?=base_url()?>assets/dashboard/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script
		src="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script
		src="<?=base_url()?>assets/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
