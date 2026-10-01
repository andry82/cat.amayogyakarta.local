<?php

function convertDateFormat($date, $from = 'Y-m-d', $to = 'd-m-Y')
{
	if (empty(intval(str_replace("-", '', $date))))
		return '';

	$dt = \DateTime::createFromFormat($from, $date);

	if (is_object($dt))
		return $dt->format($to);

	return $date;
}

function range_tanggal($tgl1, $tgl2, $penghubung = ' - ')
{
	$tgl1 = date_id($tgl1);
	$tgl2 = date_id($tgl2);

	if (! empty($tgl1) && ! empty($tgl2))
	{
		return $tgl1 . $penghubung . $tgl2;
	}
	return $tgl1 . $tgl2;
}

function range_waktu($mulai = '', $selesai = '', $suffix = ' WIB')
{
	if (! in_array('00:00:00', [$mulai, $selesai]))
	{
		return substr($mulai, 0, 5) . ' - ' . substr($selesai, 0, 5) . $suffix;
	}
	
	return $mulai . $selesai;
}

function date_id($tgl, $sep = ' ')
{
	if (strlen($tgl) >= 10 && ($tgl !== '0000-00-00' || $tgl !== '0000-00-00 00:00:00'))
	{
		$tanggal = substr($tgl,8,2);
		$bulan   = getBulan(substr($tgl,5,2));
		$tahun   = substr($tgl,0,4);

		return empty($tanggal) ? '' : $tanggal.$sep.$bulan.$sep.$tahun;
	}
	return '';		 
}

function bln_thn($tgl,$sep =' ')
{
	$tanggal = substr($tgl,8,2);
	$bulan   = getBulan(substr($tgl,5,2));
	$tahun   = substr($tgl,0,4);

	return empty($tanggal) ? '' : $bulan.$sep.$tahun;		 
 
}

function shortdate_id($tgl,$sep = "-")
{
	$tanggal = substr($tgl,8,2);
	$bulan   = substr(getBulan(substr($tgl,5,2)),0,3);
	$tahun   = substr($tgl,0,4);

	return empty($tanggal) ? '' : $tanggal.$sep.$bulan.$sep.$tahun;	 
}

function getBulan($bln)
{
	switch ($bln)
	{
		case 1: 
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}

function option_bulan($initialValue = [])
{
	$options = $initialValue;

	for ($i = 1; $i <= 12; $i++)
	{
		$options[$i] = getBulan($i);
	}

	return $options;
}

function option_tahun($initialValue = [])
{
	$options = $initialValue;

	for ($i = date('Y'); $i > 2010; $i--)
	{
		$options[$i] = $i;
	}

	return $options;
}

function addFormattedDate($posts, $field)
{
	$fields = is_array($field) ? $field : explode(',', $field);

	foreach($fields as $column)
	{
		$posts = _addFormattedDate($posts, $column);
	}
	return $posts;
}

function _addFormattedDate($posts, $field)
{
	if (isset($posts[$field]))
	{
		$dt = \DateTime::createFromFormat('d-m-Y', $posts[$field]);

		if (is_object($dt))
		{
			$posts[$field] = $dt->format('Y-m-d');
		}
	}
	return $posts;
}

function isSameDay($date1, $date2 = null)
{
    if (empty($date2))
	{
		$date2 = date('Y-m-d');
	}

    return date("z-Y", strtotime($date1)) === date("z-Y", strtotime($date2));
}

function date_in_range($date_from_user, $start_date, $end_date = null)
{

	if (is_array($start_date))
	{
		$ranges = min_max_date($start_date);

		$start_date = $ranges['min'];
		$end_date   = $ranges['max'];
	}

	// Convert to timestamp
	$start_ts = strtotime($start_date);
	$end_ts   = strtotime($end_date);
	$user_ts  = strtotime($date_from_user);

	// Check that user date is between start & end
	return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}

function min_max_date($date)
{
	usort($date, function($a, $b) {
		$dateTimestamp1 = strtotime($a);
		$dateTimestamp2 = strtotime($b);

		return $dateTimestamp1 < $dateTimestamp2 ? -1: 1;
	});

	return [
		'min' => $date[0],
		'max' => $date[count($date) - 1],
	];
}