<div class="timeline-body">
	<?php if (!is_null($data['tanggal_mulai'])) : ?>
		<span class="d-block">Tanggal Mulai: <?= rupiah($data['tanggal_mulai']) ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['tanggal_akhir'])) : ?>
		<span class="d-block">Tanggal Akhir: <?= tanggal($data['tanggal_akhir']) ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['catatan_pembeli'])) : ?>
		<span class="d-block">Catatan Pembeli: <?= $data['catatan_pembeli'] ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['catatan_penyedia'])) : ?>
		<span class="d-block">Catatan Penyedia: <?= $data['catatan_penyedia'] ?></span>
	<?php endif; ?>
</div>