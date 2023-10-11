<?php foreach ($alerts as $jenis => $pesan) : ?>
	<?php if (empty($pesan)) continue; ?>
	<div class="row">
		<div class="col-12">
			<div class="alert alert-<?= $jenis; ?> alert-dismissible fade show" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

				<?php if(count($pesan) == 1): ?>
					<?= $pesan[0]; ?>
				<?php else: ?>
					<ul class="m-0">
						<?php foreach ($pesan as $p) : ?>
						<li><?= $p; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				
			</div>
		</div>
	</div>
<?php endforeach; ?>
