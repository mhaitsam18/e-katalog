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
							<?php if($nego->status == 1){ ?>
							<a href="<?=base_url()?>PP/detail_paket/<?=$nego->id_paket?>" class="btn btn-danger">
								<i class="fas fa-arrow-alt-circle-left"></i>
								Kembali
							</a>
							<?php }else{?>
							<a href="<?=base_url()?>PP/detail_paket_negosiasi/<?=$nego->id_paket?>"
								class="btn btn-danger">
								<i class="fas fa-arrow-alt-circle-left"></i>
								Kembali
							</a>
							<?php } ?>
							<br><br>
							<div class="card" style="background-color:maroon">
								<div class="card-header">
									<h3 class="card-title"><b style="color:white">Negosiasi Paket
											<?=$nego->nama_paket?></b></h3>
								</div>
								<!-- /.card-header -->
								<?php if($check == "belum ada"){?>
								<div class="card-body" style="background-color:white">
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<h3>Ajukan Negosiasi Harga</h3>
												<?php echo form_open_multipart('PP/input_nh', array('method' => 'POST',)); ?>
												<input type="hidden" name="check" value="<?=$check?>">
												<input type="hidden" name="id_paket" value="<?=$nego->id_paket?>">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th>No</th>
														<th>Foto Produk</th>
														<th>Nama Produk</th>
														<th colspan="2">Kuantitas</th>
														<th>Harga Produk
															<span style="color:red;font-size:10px">*harga belum termasuk
																ppn</span>
														</th>
														<th>
															<?php if($check == "belum ada"){?>
															Ajukan Harga Negosiasi
															<?php }else{?>
															<span style="color:red">Harga Negosiasi Saat Ini</span>
															<?php }?>
														</th>
														<?php if($check == "belum ada"){?>
														<th>Catatan Negosiasi PP</th>
														<?php }else{?>
														<th>Catatan Negosiasi PP</th>
														<th><span style="color:red">Catatan Negosiasi Dari
																Penyedia</span></th>
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
																<input type="hidden" name="kuantitas<?=$no-1?>"
																	value="<?=$data->kuantitas?>" id="">
															</td>
															<td><?=$data->unit_pengukuran?></td>
															<td>Rp
																<?php echo number_format($data->harga,2,".",",");?>
																<input type="hidden" name="id<?=$no-1?>"
																	value="<?=$data->id_keranjang?>">
															</td>
															<td><input type="number" name="nominal<?=$no-1?>"
																	class="form-control" value="<?=$data->harga?>"
																	placeholder="Masukan Nominal" id=""></td>
															<td>
																<textarea name="catatanpembeli<?=$no-1?>"
																	placeholder="Catatan Negosiasi" class="form-control"
																	id="" cols="30" rows="8"></textarea>
															</td>
														</tr>
														<?php }?>
														<tr>
															<td colspan="5"><b>Ongkir</b></td>
															<td><b>Rp
																	<?php
																		if($check == "belum ada"){
																			echo number_format(0,2,".",",");
																		}else{
																			echo number_format($subtotal->ongkir,2,".",",");
																		}
																		?>
																</b></td>
															<td><input type="number" name="ongkir" class="form-control"
																	value="0" placeholder="Ongkos Kirim" id=""></td>
															<td rowspan="4">
																<b>Keterangan</b><br>
																<textarea name="keterangan" id="" cols="30" rows="10"
																	class="form-control"
																	placeholder="Catatan Tambahan Negosiasi"></textarea>
															</td>
														</tr>
														<tr>
															<td colspan="5"><b>Subtotal</b></td>
															<td><b>Rp
																	<?php echo number_format($subtotal->total,2,".",",");?>
																</b></td>
															<td></td>
														</tr>
														<tr>
															<td colspan="5"><b>PPN (11%)</b></td>
															<td><b style="color:red">Rp
																	<?php 
                                $ppn = $subtotal->total*0.11;
                                echo number_format($ppn,2,".",",");?>
																</b></td>
															<td></td>
														</tr>
														<tr>
															<td colspan="5"><b>Total Pembayaran</b></td>
															<td><b>Rp
																	<?php 
                                $total = $ppn+$subtotal->total;
                                echo number_format($total,2,".",",");?>
																</b></td>
															<td></td>
														</tr>
													</tbody>
												</table>
												<input type="submit" class="btn btn-danger" value="Ajukan Negosiasi"
													style="float:right">
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php }else{?>
								<div class="card-body" style="background-color:white">
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<h3>Ajukan Negosiasi Harga</h3>
												<?php echo form_open_multipart('PP/input_nh', array('method' => 'POST',)); ?>
												<input type="hidden" name="check" value="<?=$check?>">
												<input type="hidden" name="id_paket" value="<?=$nego->id_paket?>">
												<table id="example1" class="table table-bordered table-striped">
													<thead>
														<th>No</th>
														<th>Foto Produk</th>
														<th>Nama Produk</th>
														<th colspan="2">Kuantitas</th>
														<th>Harga Produk
															<span style="color:red;font-size:10px">*harga belum termasuk
																ppn</span>
														</th>
														<th>
															<?php if($check == "belum ada"){?>
															Ajukan Harga Negosiasi
															<?php }else{?>
															<span style="color:red">Harga Negosiasi Saat Ini</span>
															<?php }?>
														</th>
														<?php if($check == "belum ada"){?>
														<th>Catatan Negosiasi PP</th>
														<?php }else{?>
														<th>Catatan Negosiasi PP</th>
														<th><span style="color:red">Catatan Negosiasi Dari
																Penyedia</span></th>
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
																<input type="hidden" name="kuantitas<?=$no-1?>"
																	value="<?=$data->kuantitas?>" id="">
															</td>
															<td><?=$data->unit_pengukuran?></td>
															<td>Rp
																<?php echo number_format($data->harga,2,".",",");?>
																<input type="hidden" name="id<?=$no-1?>"
																	value="<?=$data->id_keranjang?>">
															</td>
															<td><input type="number" name="nominal<?=$no-1?>"
																	class="form-control" value="<?=$data->nominal?>"
																	placeholder="Masukan Nominal" id=""></td>
															<td>
																<textarea name="catatanpembeli<?=$no-1?>"
																	placeholder="Catatan Negosiasi" class="form-control"
																	id="" cols="30" rows="8"></textarea>
															</td>
															<td>
																<textarea class="form-control" id="" cols="30" rows="8"
																	disabled><?=$data->catatan_penyedia?></textarea>
															</td>
														</tr>
														<?php }?>
														<tr>
															<td colspan="5"><b>Ongkir</b></td>
															<td><b>Rp
																	<?php
																		if($check == "belum ada"){
																			echo number_format(0,2,".",",");
																		}else{
																			echo number_format($subtotal->ongkir,2,".",",");
																		}
																		?>
																</b></td>
														<td><input type="number" name="ongkir" class="form-control"
																value="0" placeholder="Ongkos Kirim" id=""></td>
														<td rowspan="4" colspan="2">
															<b>Keterangan Penyedia</b><br>
															<textarea id="" cols="30" rows="4" class="form-control"
																disabled><?=$subtotal->catatan_penyedia?></textarea><br>
															<b>Ajukan Keterangan</b><br>
															<textarea name="keterangan" id="" cols="30" rows="5"
																class="form-control"
																placeholder="Catatan Tambahan Negosiasi"></textarea>
														</td>
														</tr>
														<tr>
															<td colspan="5"><b>Total Pembayaran
																	<br>Sebelumya</b></td>
															<td><b>Rp
																	<?php echo number_format($subtotal->nominal,2,".",",");?>
																</b></td>
															<td></td>
														</tr>
													</tbody>
												</table>
												<input type="submit" class="btn btn-danger" value="Ajukan Negosiasi"
													style="float:right">
												</form>
											</div>
										</div>
									</div>
								</div>
								<?php }?>
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
