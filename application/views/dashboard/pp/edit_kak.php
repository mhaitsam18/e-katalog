<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Edit Kerangka Acuan Kerja</title>
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
                            <h1>Kelola Berita</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active">Kelola Paket</li>
                                <li class="breadcrumb-item active">Edit SP</li>
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
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Edit Data Kerangka Acuan Kerja</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?php echo form_open_multipart('PP/inputKAK', array('method' => 'POST',)); ?>
                                <div class="card-body">
                                    <div class="form-g">
                                        <label>ID Paket</label>
                                        <input type="hidden" name="idpaket" value="<?=$kak->id_paket?>">
																				<input type="hidden" name="idkak" value="<?=$kak->id_kak?>">
                                        <input type="text" value="<?=$kak->id_paket?>" class="form-control" disabled> <br>
                                        <label>ID Kerangka Acuan Kerja</label>
                                        <input type="text" value="<?=$kak->id_kak?>" class="form-control" disabled><br>
																				<label>Nama Pembuat Komitmen</label>
                                        <input type="text" value="<?=$kak->nama_pk?>" class="form-control" disabled>
                                    </div>
																		<div class="form-group">
																			<br>
																			<label for="" style="color:red">Paket yang bersangkutan dengan KAK tersebut</label>
																			<?php foreach($paket as $p){?>
																			<input type="text" value="<?=$p->id_paket?> - <?=$p->nama_paket?>" class="form-control" disabled> <br>
																			<?php }?>
																		</div>
                                    <div class="form-group">
                                        <label for="">Data Kerangka Acuan Kerja</label>
                                        <br><br>
                                        <label for="">Nomor PR</label>
                                        <input type="text" name="no_pr" class="form-control" value="<?=$kak->no_pr?>" placeholder="Nomor Kerangka Acuan Kerja"><br>
																				<label for="">Nama Paket</label>
                                        <input type="text" name="namapaket" class="form-control" value="<?=$kak->nama_paket?>"><br>
																				<label for="">Uraian Pekerjaan</label>
                                        <textarea class="form-control" name="uraian_pekerjaan" id="" cols="30" rows="5"><?=$kak->uraian_pekerjaan?></textarea><br>
																				<label for="">Ruang Lingkup</label>
                                        <textarea class="form-control" name="ruang_lingkup" id="" cols="30" rows="8"><?=$kak->ruang_lingkup?></textarea><br>
                                        <label for="">Tanggal Mulai</label>
                                        <input type="date" name="tanggalmulai" class="form-control" value="<?=$kak->tanggal_mulai?>"><br>
                                        <label for="">Tanggal Akhir</label>
                                        <input type="date" name="tanggalakhir" class="form-control" value="<?=$kak->tanggal_akhir?>">
                                        <br>
                                        <label for="">Jenis Pembayaran</label>
                                        <select name="jenis" class="form-control">
																						<?php if(!$kak->jenis_pembayaran){?>
																						<?php }else{?>
																						<option value="<?=$kak->jenis_pembayaran?>"><?=ucfirst($kak->jenis_pembayaran)?></option>
																						<?php }?>
                                            <option value="">-- Pilih Jenis Pembayaran --</option>
                                            <option value="sekaligus">Sekaligus</option>
                                            <option value="termin">Termin</option>
                                            <option value="bulanan">Bulanan</option>
                                        </select>
																				<br>
																				<label for="">Nama PK</label>
                                        <select name="pk" class="form-control">
																						<?php if(!$kak->nama_pk){?>
																						<?php }else{?>
																						<option value="<?=$kak->id_pk?>"><?=ucfirst($kak->nama_pk)?></option>
																						<?php }?>
                                            <option value="">-- Pilih PK --</option>
																						<?php foreach($akun as $a){?>
                                            <option value="<?=$a->id_pk?>"><?=$a->nama_pk?></option>
																						<?php }?>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <a href="<?=base_url()?>PP/kelola_paket" class="btn btn-danger">Kembali</a>
                                    <input type="submit" value="Submit" class="btn btn-info">
                                </div>
                            </div>
                            <button type="button" style="display:none" class="btn btn-success toastrDefaultSuccess">

                            </button>
                            <button type="button" style="display:none" class="btn btn-danger toastrDefaultError">
   
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
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

</body>

</html>