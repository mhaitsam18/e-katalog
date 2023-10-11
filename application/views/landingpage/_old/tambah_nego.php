<!DOCTYPE html>
<html lang="id" class="no-js">

<?php include "head.php" ?>

<body>

    <!-- Start Header Area -->
    <?php include "header.php" ?>
	<!-- End Header Area -->

    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Proses Negosiasi</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Detail Paket<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Proses Negosiasi</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <br><br>
    <!--================Blog Area =================-->
    <section class="blog_area">
            <div class="row">
                <div class="col-lg-10" style="margin-left:90px">
                <a href="<?=base_url()?>PBJ/detailpaket/<?=$id?>" class="primary-btn">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Kembali
                </a>
                <div style="width:100%;text-align:center">
                    <a href="<?=base_url()?>PBJ/riwayat_nh/<?=$id?>" class="btn btn-primary">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    Riwayat Negosiasi Harga</a>
                    <a href="<?=base_url()?>PBJ/riwayat_ns/<?=$id?>" class="btn btn-danger">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    Riwayat Negosiasi Spesifikasi</a>
                </div>
                <br><br>
                    <h2>Data Negosiasi</h2>
                    <br><br>
                    <table class="table">
                        <tr>
                            <th><h3>Negosiasi Harga Saat Ini</h3></th>
                        </tr>
                        <tr>
                            <th>Nominal yang Diajukan</th>
                            <th>Referensi Ongkir</th>
                            <th>Tanggal Pengiriman</th>
                            <th>Catatan Pembeli</th>
                            <th>Catatan Penyedia</th>
                        </tr>
                        <?php if($harga == "Tidak ada"){?>
                        <tr>
                            <td colspan="4">Tidak Data</td>
                        </tr>
                        <?php }else{?>
                        <tr>
                            <td>Rp <?php echo number_format($harga->nominal,2,".",",")?></td>
                            <td>Rp <?php echo number_format($harga->ongkir,2,".",",")?></td>
                            <td><?=$harga->tanggal_pengiriman?></td>
                            <td><?=$harga->catatan_pembeli?></td>
                            <td><?=$harga->catatan_penyedia?></td>
                        </tr>
                        <?php }?>
                        </table>
                        <table class="table">
                        <tr>
                            <th><h3>Negosiasi Spesifikasi Saat Ini</h3></th>
                        </tr>
                        <tr>
                            <th>Spesifikasi</th>
                            <th>Nilai</th>
                            <th>Catatan Pembeli</th>
                            <th>Catatan Penyedia</th>
                        </tr>
                        <?php if($spesifikasi == "Tidak ada"){?>
                        <tr>
                            <td colspan="4"><center>Tidak Ada</center></td>
                        </tr>
                        <?php }else{?>
                        <tr>
                            <td><?=$spesifikasi->spesifikasi?></td>
                            <td><?=$spesifikasi->nilai?></td>
                            <td><?=$spesifikasi->catatan_pembeli?></td>
                            <td><?=$spesifikasi->catatan_penyedia?></td>
                        </tr>
                        <?php }?>
                    </table>
                    <br><br><br>
                    
                    <?php if($paket->status == 3){?>
                   <center> 
                        <p>**Jika Anda setuju dengan pernyataan negosiasi data di atas, maka klik tombol setuju"</p>
                           <a href="<?=base_url()?>PBJ/update_paket_fix/<?=$paket->id_paket?>" class="btn btn-danger" style="color:white">
                               <i class="fa fa-check"></i>
                               Negosiasi Setuju</a>
                   </center>
                   <?php }?>
                   <br><br>
                    <?php echo form_open_multipart('PBJ/updateNego', array('method' => 'POST',)); ?>
                    <div class="col-md-12">
                        <h2>Pengajuan Negosiasi</h2>
                        <table class="table">
                            <tr>
                                <th colspan="2"><h5>Negosiasi Harga</h5>
                                <?php if($harga == "Tidak ada"){ ?>
                                <input type="hidden" name="cek" value="new">
                                <?php }?>
                                </th>
                            </tr>
                            <tr>
                                <th>Nominal yang Diajukan</th>
                                <td>
                                    <div style="display:flex">
                                        <p>Rp</p>&nbsp;&nbsp;
                                    <input type="number" name="nominal" class="form-control" placeholder="Nominal (Rp)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Referensi Ongkir</th>
                                <td>
                                    <div style="display:flex">
                                        <p>Rp</p>&nbsp;&nbsp;
                                    <input type="number" name="ongkir" class="form-control" placeholder="Ongkir (Rp)">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengiriman</th>
                                <td><input type="datetime" name="tanggal" class="form-control" placeholder="yyyy-mm-dd hh:mm:ss"></td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td><textarea name="catatan" id="editor" placeholder="Catatan" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th colspan="2"><h5>Negosiasi Spesifikasi</h5>
                                <?php if($spesifikasi == "Tidak ada"){ ?>
                                <input type="hidden" name="cek2" value="new">
                                <?php }?>
                                </th>
                            </tr>
                            <tr>
                                <th>Spesifikasi</th>
                                <td><textarea name="spesifikasi" id="editor1" placeholder="Catatan" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th>Nilai</th>
                                <td><textarea name="nilai" id="editor2" placeholder="Catatan" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <th>Catatan Spesifikasi</th>
                                <td><textarea name="c_spesifikasi" id="editor3" placeholder="Catatan" cols="30" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="hidden" name="idpaket" value="<?=$harga->id_paket?>">
                                    <input type="submit" value="Simpan" class="primary-btn" style="border:0;float:right">
                                </td>
                            </tr>
                        </table>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!-- start footer Area -->
    <?php include "footer.php"?>
    <!-- End footer Area -->
    <?php include "script.php"?>
    <script src="<?=base_url()?>assets/landingpage/js/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
	ClassicEditor
		.create( document.querySelector( '#editor' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
    </script>
    <script>
	ClassicEditor
		.create( document.querySelector( '#editor1' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
    </script>
    <script>
	ClassicEditor
		.create( document.querySelector( '#editor2' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
    </script>
    <script>
	ClassicEditor
		.create( document.querySelector( '#editor3' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
    </script>

</body>

</html>
