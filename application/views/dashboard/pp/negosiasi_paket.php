<!DOCTYPE html>
<html lang="id">
  <?php include "head.php"?>
  <title>Detail Negosiasi</title>
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
              <li class="breadcrumb-item active">Detail Negosiasi</li>
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
            <div class="card" style="background-color:maroon">
              <div class="card-header">
                <h3 class="card-title"><b style="color:white">Detail Negosiasi Paket <?=$nego->nama_pr?></b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="background-color:white">
              <div class="modal-body">
                <a href="<?=base_url()?>Penyedia/kelola_negosiasi" class="btn btn-danger">
                    <i class="fas fa-arrow-alt-circle-left"></i>
                    Kembali
                </a>
                <br><br>
              <div class="row">
                  <div class="col-md-12">
                    <h3>Daftar Produk</h3>
                  <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Foto Produk</th>
                            <th>Nama Produk</th>
                            <th>Kuantitas</th>
                            <th>Harga Produk</th>
                            <th>Total Produk</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach($produk as $data){?>
														<?php 
														 if (!$d->status){?>
															<tr>
																<td colspan="6">
																<center>  
																Tidak Ada Data
																</center>
																</td>
															</tr>
															<?php }else{ ?>
                            <tr>
                                <td><?=$no++?></td>
                                <td>
                                    <?php if(!$data->foto){?>
                                    <img src="<?=base_url()?>assets/landingpage/img/dummyproduct.png" alt="Foto Produk" width="150px">
                                    <?php }else{?>
                                    <img src="<?=base_url()?>uploads/foto_produk/<?=$data->foto?>" alt="Foto Produk" width="150px">
                                    <?php }?>
                                </td>
                                <td><?=$data->nama_produk?></td>
                                <td><?=$data->kuantitas?></td>
                                <td>Rp <?php echo number_format($data->harga,2,".",",");?></td>
                                <td>Rp <?php echo number_format($data->total,2,".",",");?></td>
                            </tr>
                            <?php }?>
                            <tr>
                                <td colspan="5"><b>Subtotal</b></td>
                                <td><b>Rp <?php echo number_format($data->subtotal,2,".",",");?></b></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="col-md-6">
                    <br>
                    <h3>Data Negosiasi PBJ</h3>
                    <br>
                    <table id="example1" class="table table-bordered table-striped">
                            <tr>
                                <th colspan="2">Negosiasi Harga</th>
                            </tr>
                            <tr>
                                <td>Nominal yang diajukan</td>
                                <td>Rp <?php echo number_format($nego_harga->nominal,2,".",",");?></td>
                            </tr>
                            <tr>
                                <td>Referensi Harga Ongkir</td>
                                <td>Rp <?php echo number_format($nego_harga->ongkir,2,".",",");?></td>
                            </tr>
                            <tr>
                              <td>Tanggal Pengiriman</td>
                              <td><?=$nego_harga->tanggal_pengiriman?></td>
                            </tr>
                                <?php if(!$nego_harga->catatan_pembeli){?>
                                  
                                <?php }else{?>
                            <tr>
                                <td>Catatan Pembeli</td>
                                <td>
                                  <?=$nego_harga->catatan_pembeli?>
                                </td>
                            </tr>
                            <?php }?>
                            <?php if(!$nego_harga->catatan_penyedia){?>
                                  
                                  <?php }else{?>
                              <tr>
                                  <td>Catatan Penyedia</td>
                                  <td>
                                    <?=$nego_harga->catatan_penyedia?>
                                  </td>
                              </tr>
                              <?php }?>
                            <tr>
                                <th colspan="2">Negosiasi Spesifikasi</th>
                            </tr>
                            <tr>
                                <td>Spesifikasi yang diajukan</td>
                                <td><?=$nego_spesifikasi->spesifikasi?></td>
                            </tr>
                            <tr>
                                <td>Nilai</td>
                                <td><?=$nego_spesifikasi->nilai?></td>
                            </tr>
                            <?php if(!$nego_spesifikasi->catatan_pembeli){?>
                                  
                                  <?php }else{?>
                              <tr>
                                  <td>Catatan Pembeli</td>
                                  <td>
                                    <?=$nego_spesifikasi->catatan_pembeli?>
                                  </td>
                              </tr>
                              <?php }?>
                              <?php if(!$nego_spesifikasi->catatan_penyedia){?>
                                    
                                    <?php }else{?>
                                <tr>
                                    <td>Catatan Penyedia</td>
                                    <td>
                                      <?=$nego_spesifikasi->catatan_penyedia?>
                                    </td>
                                </tr>
                                <?php }?>
                        </tbody>
                    </table>
                    <p>Keterangan : Jika setuju dengan data tawaran/negosiasi yang tertera di atas maka klik tombol "Setuju", Jika tidak isi data ajukan negosiasi pada tabel sebelah kanan lalu klik tombol "Ajukan Negosiasi"</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg<?=$nego_harga->id_paket?>">
                    <i class="fas fa-check-double"></i>   
                        Setuju
                      </button>
                  </div>
                  <div class="col-md-6">
                    <div class="tampilkan">
                  <br>
                    <h3>Ajukan Negosiasi</h3>
                    <br>
                    <?php echo form_open_multipart('Penyedia/inputAjukan', array('method' => 'POST',)); ?>
                    <input type="hidden" name="idpaket" value="<?=$nego_harga->id_paket?>">
                    <table id="example1" class="table table-bordered table-striped">
                            <tr>
                                <th colspan="2">Negosiasi Harga</th>
                            </tr>
                            <tr>
                                <td>Nominal yang diajukan</td>
                                <td>
                                <div style="display:flex">
                                    <p>Rp&nbsp;&nbsp;</p>
                                    <input type="number" name="nominal" id="" class="form-control" placeholder="Nominal Rp..">
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Referensi Harga Ongkir</td>
                                <td><div style="display:flex">
                                    <p>Rp&nbsp;&nbsp;</p>
                                    <input type="number" name="ongkir" id="" class="form-control" placeholder="Ongkos Kirim">
                                </div></td>
                            </tr>
                            <tr>
                              <td>Tanggal Pengiriman</td>
                              <td><input type="datetime" name="tgl" class="form-control" id="" placeholder="yyyy-mm-dd hh:mm:ss"></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td><textarea name="catatan" class="form-control" id="" cols="30" rows="10" placeholder="Catatan Penyedia"></textarea></td>
                            </tr>
                            <tr>
                                <th colspan="2">Negosiasi Spesifikasi</th>
                            </tr>
                            <tr>
                                <td>Spesifikasi yang diajukan</td>
                                <td>
                                    <textarea id="summernote" name="syarat" placeholder="Spesifikasi yang diajukan">
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Nilai</td>
                                <td>
                                <textarea name="nilai" class="form-control" id="" cols="30" rows="10" placeholder="Nilai"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td> <textarea name="catatan2" class="form-control" id="" cols="30" rows="10" placeholder="Catatan Penyedia"></textarea></td>
                            </tr>
														<?php }?>
                        </tbody>
                    </table>
                    <!-- <input type="submit" value="Ajukan Nego"> -->
                    <button class="btn btn-danger">
                    <i class="fas fa-handshake"></i>
                    Ajukan Nego
                    </button>
                    </form>
                    <br>
                    </div>
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

<div class="modal fade" id="modal-lg<?=$nego_harga->id_paket?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi Negosiasi</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-8">
                      <p>Apakah Anda yakin untuk <b>menyetujui</b> negosiasi ini?</p>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <a href="<?=base_url()?>Penyedia/persetujuan_paket/<?=$nego_harga->id_paket?>" class="btn btn-danger">Setuju</a>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
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
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>
</body>
</html>
