<div class="card p-4">
	<div class="my-4 text-center">
		<h4>REFRESH / SINKRONISASI NILAI</h4>
	</div>
	<div class="my-2">
        <?php 
        $message = '<p>Refresh atau Sinkronisasi Nilai adalah proses update Nilai yang dihitung secara otomatis oleh sistem.</p>';
        $message .= '<p>Nilai yang dimaksud antara lain, </p>';
        $message .= '<ul><li>Nilai Skor Tertulis dihitung dari poin jawaban tertulis yang benar</li>';
        $message .= '<li>Nilai Skor Praktik dihitung dari input nilai praktik</li>';
        $message .= '<li>Nilai Skor Wawancara dihitung dari input nilai wawancara</li>';
        $message .= '<li>dan semua nilai rata-rata lainnya</li></ul>';
        ?>
		<?=alert('info', 'Penting', $message)?>
        <?php 
        $message = '<p>Refresh atau Sinkronisasi Nilai hanya diberlakukan untuk Nilai Test yang sedang berjalan.<br>';
        $message .= 'Hal ini untuk menghindari perubahan nilai yang sudah diproses pada Test yang telah berlalu. </p>';
        $message .= '<p>Untuk memulai proses sinkronisasi nilai, pilih Kode Test yang akan disinkronisasi lalu klik tombol Sinkronisasi. </p>';
        ?>
		<?=alert('warning', 'Perhatian', $message)?>
	</div>
    <?php if (empty($data)) : ?>
		<?=alert('danger', 'Perhatian', 'Saat ini tidak ada Test yang sedang berlangsung.')?>
    <?php else : ?>
	<div class="row mb-4">
		<div class="col-2">Kode Test</div>
		<div class="col-4">
            <?=form_dropdown('kode_test', array_key_value($data, ['kode_test' => 'kode_test, nama_test'], [], " - "), [], 'class="form-control" id="kode_test"')?>
        </div>
        <div class="col-2">
            <a href="#" data-url="<?=site_url('admin/penilaian/sync')?>" id="sync">
                <i class="fa fa-2x fa-sync text-success ml-2"></i>
            </a>
        </div>
	</div>
    <?php endif; ?>
</div>