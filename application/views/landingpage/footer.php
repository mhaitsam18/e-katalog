<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-sm-6">
					<div class="single-footer-widget">
						<h6>Tentang Kami</h6>
						<p style="text-align:justify">
							E-Katalog UNPAD adalah sebuah aplikasi katalog elektronik yang dimiliki Universitas Padjajaran untuk menjadikan sebuah perantara para penjual dan pembeli produk.
						</p>
					</div>
				</div>

				<?php $kontak = $this->Model_index->get_kontak(); ?>

				<div class="col-lg-2 col-sm-6">
					<div class="single-footer-widget">
						<h6>Ikuti Kami</h6>
						<div class="footer-social d-flex align-items-center">
							<a href="https://www.facebook.com/unpad"><i class="fa fa-facebook"></i></a>
							<a href="https://twitter.com/unpad"><i class="fa fa-twitter"></i></a>
							<a href="https://www.linkedin.com/school/universitas-padjadjaran/"><i class="fa fa-linkedin"></i></a>
							<a href="https://www.instagram.com/unpad/"><i class="fa fa-instagram"></i></a>
						</div>
					</div>
				</div>
				
				<?php if(! empty($kontak['googlemap_src'])): ?>
				<div class="col-lg-5 col-sm-12">
					<div class="single-footer-widget">
						<h6>Lokasi</h6>
						<iframe class="w-100 h-100" src="<?= htmlentities($kontak['googlemap_src']) ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					Copyright &copy;
					<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is
					made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
						target="_blank" rel="noopener noreferer">Colorlib</a> Downloaded from <a href="https://themeslab.org/"
						target="_blank" rel="noopener noreferer">Themeslab</a>
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				</p>
			</div>
		</div>
	</footer>
