<div class="timeline-body">
	<?php if (!is_null($data['nama_pp'])) : ?>
		<span class="d-block">PP: <?= $data['nama_pp'] ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['no_pr'])) : ?>
		<span class="d-block">No. PR: <?= $data['no_pr'] ?></span>
	<?php endif; ?>

	<?php if (!is_null($data['status'])) : ?>
		<span class="d-block">Status: <?= status_paket($data['status']) ?></span>
	<?php endif; ?>
</div>