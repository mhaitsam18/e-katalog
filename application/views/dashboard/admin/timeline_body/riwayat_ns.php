<div class="timeline-body">
	<span class="d-block"><?= $data['spesifikasi'].': '.$data['nilai'] ?></span>

	<?php if (!is_null($data['catatan_pembeli'])) : ?>
		<span class="d-block">Catatan Pembeli: <?= $data['catatan_pembeli'] ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['catatan_penyedia'])) : ?>
		<span class="d-block">Catatan Penyedia: <?= $data['catatan_penyedia'] ?></span>
	<?php endif; ?>
</div>