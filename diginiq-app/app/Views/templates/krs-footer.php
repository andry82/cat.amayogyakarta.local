<table class="sub-title" width='<?=$width?>'>
	<tr>
		<td width="230">
			<table class="noborder" border="0" cellspacing=0>
				<tr align="center" style="line-height:28px"><td>Menyetujui,</td></tr>
				<tr align="center" style="line-height:20px"><td>Dosen Wali,</td></tr>
				<tr align="center" style="line-height:40px"><td>&nbsp;</td></tr>
				<tr align="center" style="line-height:15px;"><td><u><?=$dosenWali?></u></td></tr>
			</table>
		</td>
		<td></td>
		<td width="230">
			<table class="noborder" border="0" cellspacing=0>
				<tr align="center" style="line-height:28px"><td>Semarang, <?=(empty($tanggal)?date_id(date("Y-m-d")):date_id($tanggal))?></td></tr>
				<tr align="center" style="line-height:20px"><td>Mahasiswa Ybs</td></tr>
				<tr align="center" style="line-height:40px"><td>&nbsp;</td></tr>
				<tr align="center" style="line-height:15px;"><td><u><?=$nama?></u></td></tr>			
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			Lembar: <ol><li>Untuk Mahasiswa</li><li>Untuk Dosen Wali</li><li>Untuk Akademik</li></ol>
		</td>
	</tr>
</table>