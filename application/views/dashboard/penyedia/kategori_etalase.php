<!DOCTYPE html>
<html lang="id">
<?php include "head.php"?>
<title>Kategori Etalase Produk</title>
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../../dist/css/adminlte.min.css">

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
                            <h1>Kelola Kategori Etalase Penyedia</h1>
														<span style="color:red">*Jika ingin menambahkan etalase produk & item produk harap hubungi admin e-katalog UNPAD</span>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                                <li class="breadcrumb-item active">Kategori Etalase Produk Penyedia</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
																			<b>Data Kategori Etalase Produk</b>
																		</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Jenis Kategori Etalase Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($kategori_etalase as $data){?>
                                            <tr>
                                                <td>
                                                    <?=$data->id_ke?>
                                                </td>
                                                <td>
                                                    <?=$data->nama_ke?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
												<div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
																				<b>Data Etalase Produk</b>
																		</h3>
																		<button class="btn btn-success" style="font-size:12px;float:right;margin-top:10px">Penyedia ID<?php echo $this->session->id ?></button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Jenis Kategori</th>
                                                <th>Etalase Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($etalase_produk as $data){?>
                                            <tr>
                                                <td>
                                                    <?=$data->id_etalase?>
                                                </td>
                                                <td>
                                                    <?=$data->nama_ke?>
                                                </td>
                                                <td>
                                                    <?=$data->nama_etalase?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Kode</th>
                                                <th>Jenis Kategori</th>
                                                <th>Etalase Produk</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
												<div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
																			<b>Data Item Produk</b>
																		</h3>
																		<button class="btn btn-success" style="font-size:12px;float:right;margin-top:10px">Penyedia ID<?php echo $this->session->id ?></button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example3" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Item</th>
                                                <th>Unit Pengukuran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($item as $data){?>
                                            <tr>
                                                <td>
                                                    <?=$data->no_item?>
                                                </td>
                                                <td>
                                                    <?=$data->nama_item?>
                                                </td>
                                                <td>
                                                    <?=$data->uom?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Item</th>
                                                <th>Unit Pengukuran</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                     
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
            <div class="float-right d-Kodene d-sm-block">
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
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $("#example2").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
            $("#example3").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                // "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        });
    </script>
</body>

</html>