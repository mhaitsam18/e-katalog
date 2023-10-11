<!DOCTYPE html>
<html lang="id" class="no-js">

<head>
	<?php $this->load->view('landingpage/head') ?>
	<title>Login | E-Katalog UNPAD</title>
	<link rel="stylesheet" href="<?=base_url()?>assets/landingpage/css/nice-select.css">
</head>
<body class="background-login">

	<!--================Login Box Area =================-->
	<section class="login_box_area h-100 d-flex align-items-center">
		<div class="container">
			<div class="row" style="margin-top:-50px;margin-bottom:-50px">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="<?=base_url()?>assets/landingpage/img/login.jpg" alt="">
						<div class="hover">
							<div>
							<img src="<?=base_url()?>assets/landingpage/img/logotransparan.png" style="width:300px">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner" style="background-color:white; border-radius: 0px 20px 20px 0px">
					<img src="<?=base_url()?>assets/landingpage/img/logo transparan with text.png" alt="logo" width="200px" style="margin-top:-100px">

						<?php $this->alert->tampilkan(); ?>

						<form class="row login_form" action="<?=base_url()?>login" method="post" id="contactForm">
							<?= csrf(); ?>
							<div class="col-md-12 form-group">
								<input type="email" class="form-control" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
							</div>
							<div class="col-md-12 form-group mt-lg-4">
								<input type="submit" value="Login" class="primary-btn">
							</div>
						</form>
						<p>Belum mempunyai akun? Daftarkan akun di E-Proc</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<?php $this->load->view('landingpage/script') ?>
</body>

</html>
