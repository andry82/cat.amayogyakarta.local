<?php

function alert($type, $title, $message)
{
	$tpl = '
	<div class="alert alert-%type% alert-dismissible fade show mt-3" role="alert">
	  <strong>%title%!</strong> %message%
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>';

	return str_replace(
		[
			'%type%',
			'%title%',
			'%message%',
		],
		[
			$type,
			$title,
			$message,
		],
		$tpl
	);
}

function format_pilihan($data, $pilihan, $jawaban, $tpl)
{
	$textPilihan = $pilihan . '. ' . nl2br($data[$pilihan]);

	return ($pilihan === $jawaban) ? str_replace(':pilihan:', $textPilihan, $tpl) : $textPilihan;
}

function format_nilai($nilai, $decimal = 2)
{
	if (is_string($nilai)) {
		$nilai = (float) $nilai;
	}
	
	return (! empty(fmod($nilai, 1))) ? number_format($nilai, $decimal, '.', ',') : $nilai;
}