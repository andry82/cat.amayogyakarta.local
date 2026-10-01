<a href="<?=site_url('admin/soal')?>" class="btn btn-primary mb-4"><i class="fa fa-arrow-left mr-2"></i> Kembali</a>
<div class="alert alert-secondary">
	<h4>Keterangan</h4>
	<p>Teks background hijau di dalam pilihan adalah jawaban yang benar.</p>
</div>
<div class="card p-4">
	<table class="table table-striped datatable-grid">
		<thead>
			<tr>
				<th width="20">No</th>
				<th>Pertanyaan</th>
				<th width="250">Pilihan</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 0;
			foreach ($soal as $row) :
				$i++;
				$jawaban = $row['jawaban'];

				$tpl = '<div class="mt-3 p-3 bg-success">:pilihan:</div>';
	
				$pilihan = [
					format_pilihan($row, 'a', $jawaban, $tpl),
					format_pilihan($row, 'b', $jawaban, $tpl),
					format_pilihan($row, 'c', $jawaban, $tpl),
					format_pilihan($row, 'd', $jawaban, $tpl),
				]; ?>
			<tr>
				<td><?=$i?></td>
				<td><?=$row['pertanyaan']?></td>
				<td><?=implode('<br>', $pilihan)?></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>