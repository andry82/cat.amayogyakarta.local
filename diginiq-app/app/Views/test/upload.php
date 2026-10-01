<div class="col-12">
	<input id="upload" type="file" name="files" multiple data-browse-on-zone-click="true" data-language="id" data-required="true">
</div>
<div class="col-12 my-3">
	<?php
	if (! empty($files))
	{ ?>
	<ol><p><strong>File yang sudah diunggah: </strong></p>
	<?php
	foreach ($files as $file)
	{
		?><li><a href="<?=site_url('test/files/' . $file['filename'])?>"><?=$file['filename']?></a></li>
	<?php 
	} ?>
	</ol>
	<?php 
	}
	else 
	{ 
		echo "<p>Belum ada file yang diunggah</p>";
	} ?>
</div>
<div class="col">
	<div class="d-flex justify-content-center">
	    <a href="<?=site_url('logout')?>" class="btn px-4 btn-warning btn-lg">TES SELESAI - TUTUP SISTEM</a>
	</div>
</div>