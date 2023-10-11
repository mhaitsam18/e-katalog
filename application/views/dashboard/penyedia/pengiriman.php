<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Kelola Pengiriman</title>
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
								<li class="breadcrumb-item active">Kelola Pengiriman</li>
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
									<h3 class="card-title">Data Pengiriman</h3>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<th>No</th>
											<th>Nama Paket</th>
											<th>Total Produk</th>
											<th>Status</th>
											<th>Lampiran</th>
											<th>Upload Dokumen</th>
											<th>Aksi</th>
										</thead>
										<tbody>
											<?php
                    $no = 1;
                    foreach($data as $d){
                    if (!$d->id_paket){?>
											<tr>
												<td colspan="9">
													<center>
														Tidak Ada Data
													</center>
												</td>
											</tr>
											<?php }else{ ?>
											<tr>
												<td>
													<?=$no++?>
												</td>
												<td><?=$d->nama_paket?></td>
												<td><?=$d->jumlahproduk?></td>
												<td>
													<center>
														<?php 
                        if($d->status == 2){?>
														<button class="btn btn-primary">Persetujuan Paket</button>
														<?php }elseif($d->status == 3){?>
														<button class="btn btn-warning">Negosiasi Terkirim</button>
														<?php }elseif($d->status == 4){?>
														<button class="btn btn-warning">Pengajuan Negosiasi dari
															PP</button>
														<?php }elseif($d->status == 5){?>
														<button class="btn btn-warning">Paket Harus Dikirim</button>
														<?php }else{} ?>
													</center>
												</td>
												<td>
													<center>
														<a href="<?=base_url()?>Penyedia/print_kontrak/<?=$d->id_paket?>"
															target="_blank"
															class="btn btn-success btn-inline-blok btn-sm"
															rel="noopener noreferer">
															<i class="fas fa-folder"></i>
															Kontrak
														</a>
														<a href="<?=base_url()?>Penyedia/print_invoice/<?=$d->id_paket?>"
															target="_blank"
															class="btn btn-primary btn-inline-blok btn-sm"
															rel="noopener noreferer">
															<i class="fas fa-file-zip-o"></i>
															Invoice
														</a>
													</center>
												</td>
												<td>
												<?php if(!$d->dokumen){?>
													<button type="button" class="btn btn-danger" data-toggle="modal"
														data-target="#unduh<?=$d->id_paket?>">
														<i class="fas fa-upload"></i>
														Upload Dokumen
													</button>
									<?php }else{?>
										<center>
										<a href="<?=base_url()?>uploads/dokumen/<?=$d->dokumen?>"
															target="_blank"
															class="btn btn-default"
															rel="noopener noreferer">
															<i class="fas fa-file"></i>
															Dokumen
														</a>
										</center>
									<?php }?>
												</td>
												<td>
													<center>
														<a href="<?=base_url()?>Penyedia/detail_kirim/<?=$d->id_paket?>"
															class="btn btn-primary">
															<i class="fas fa-eye"></i>
															Detail
														</a>
												</td>
												</center>
											</tr>
											<?php }} ?>
										</tbody>
										<tfoot>
											<th>No</th>
											<th>Nama Paket</th>
											<th>Total Produk</th>
											<th>Status</th>
											<th>Lampiran</th>
											<th>Upload Dokumen</th>
											<th>Aksi</th>
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
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
			reserved.
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>

	<?php foreach($data as $d){?>
	<div class="modal fade" id="unduh<?=$d->id_paket?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Konfirmasi Negosiasi</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php echo form_open_multipart('Penyedia/input_dokumen', array('method' => 'POST',)); ?>
					<input type="hidden" name="id" value="<?=$d->id_paket?>">
					<p>Upload Berkas Dokumen Disini</p>
					<table class="table">
						<tr>
							<td>Dokumen</td>
						</tr>
						<tr>
							<td>
									<input type="file" name="foto" id="">
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
					<input type="submit" value="Submit" class="btn btn-danger">
					</form>
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