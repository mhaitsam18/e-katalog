<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Tanya Jawab | E-Katalog UNPAD</title>
</head>

<body>

  <!-- Start Header Area -->
  <?php $this->load->view('landingpage/header') ?>
  <!-- End Header Area -->

  <!-- Start Banner Area -->
  <section class="banner-area organic-breadcrumb">
    <div class="container">
      <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
        <div class="col-first">
          <h1>Tanya Jawab</h1>
          <nav class="d-flex align-items-center">
            <a href="<?= base_url() ?>">Beranda<span class="lnr lnr-arrow-right"></span></a>
            <a href="#">Tanya Jawab</a>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- End Banner Area -->

  <!--================Contact Area =================-->
  <section class="contact_area section_gap_bottom">
    <?php if (!empty($faq)): ?>
    <div class="container">
      <br><br><br>
      <?php foreach ($faq as $f): ?>
      <div class="question">
        <input type="button" class="title-faq col-md-12 klik" value="<?=$f->pertanyaan?>"
          style="border:0px;color:white">
        <div class="col-md-12 my-3" style="display: none;">
          <p class="mb-0"><?=$f->jawaban;?></p>
        </div>
      </div>
      <?php endforeach;?>
      <br>
    </div>
    <?php endif;?>
  </section>
  <!--================Contact Area =================-->

  <!-- start footer Area -->
  <?php $this->load->view('landingpage/footer') ?>
  <!-- End footer Area -->

  <?php $this->load->view('landingpage/script') ?>
</body>

</html>