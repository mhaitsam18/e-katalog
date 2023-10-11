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
                    <h1>Riwayat Paket</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Detail Paket<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Riwayat Paket</a>
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
                <a href="<?=base_url()?>PBJ/tambahnegosiasi/<?=$id?>" class="primary-btn">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Kembali
                </a>
                <br><br>
                    <h2>Riwayat Negosiasi Harga</h2>
                    <table class="table" width="100%">
                        <thead>
                            <th>No</th>
                            <th>Aksi</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Ongkir</th>
                            <th>Tanggal Pengiriman</th>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            foreach($riwayat as $data){?>
                                <tr>
                                    <td><?=$no++?></td>
                                    <td><?=$data->aksi?></td>
                                    <td><?=$data->tanggal?></td>
                                    <td>
                                        <?php if(!$data->nom){?>
                                           Rp <?php echo number_format($data->nominal,2,".",",")?>
                                        <?php }else{?>
                                           Rp <?php echo number_format($data->nom,2,".",",")?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if(!$data->ongk){?>
                                           Rp <?php echo number_format($data->ongkir,2,".",",")?>
                                        <?php }else{?>
                                           Rp <?php echo number_format($data->ongk,2,".",",")?>
                                        <?php }?>
                                    </td>
                                    <td>
                                        <?php if(!$data->tgl){?>
                                            <?=$data->tanggal_pengiriman?>
                                        <?php }else{?>
                                            <?=$data->tgl?>
                                        <?php }?>   
                                    </td>
                                </tr>
                                <?php }?>
                        </tbody>
                    </table>
                    <br><br><br><br><br><br>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!-- start footer Area -->
    <?php include "footer.php"?>
    <!-- End footer Area -->

    <?php include "script.php"?>
</body>

</html>
