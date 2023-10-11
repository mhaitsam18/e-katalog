<div class="timeline-body">
	<?php if (!is_null($data['nominal'])) : ?>
		<span class="d-block">Nominal: <?= rupiah($data['nominal']) ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['ongkir'])) : ?>
		<span class="d-block">Ongkir: <?= rupiah($data['ongkir']) ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['tanggal_pengiriman'])) : ?>
		<span class="d-block">Tanggal Pengiriman: <?= tanggal($data['tanggal_pengiriman']) ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['catatan_pembeli'])) : ?>
		<span class="d-block">Catatan Pembeli: <?= $data['catatan_pembeli'] ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['catatan_penyedia'])) : ?>
		<span class="d-block">Catatan Penyedia: <?= $data['catatan_penyedia'] ?></span>
	<?php endif; ?>
</div>