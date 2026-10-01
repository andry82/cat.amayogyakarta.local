<?php

function post_data($field, $data = false)
{
	$default = is_array($data) && isset($data[$field]) ? $data[$field] : (is_string($data) || is_numeric($data) ? $data : '');
	return old($field, $default);
}

function checked_data($field, $val, $data = false)
{
	$default = is_array($data) && isset($data[$field]) ? $data[$field] : (is_string($data) || is_numeric($data) ? $data : '');
	return old($field, $default) === $val ? 'checked' : '';
}

function multichecked_data($field, $val, $data = false)
{
	$list = [];

	if (is_array($data) && isset($data[$field]))
	{
		$list = explode(',', $data[$field]);
	}

	return in_array($val, $list) ? 'checked' : '';
}

function post_change_data($field, $data = false, $changes = [])
{
	$data = array_merge($data, $changes);

	$default = is_array($data) && isset($data[$field]) ? $data[$field] : (is_string($data) || is_numeric($data) ? $data : '');
	return old($field, $default);
}

function generate_captcha_sum($min = 1, $max = 99, $maxResult = false)
{
	$x = random_int($min, $max);
	$y = random_int($min, $max);
	$z = $x + $y;

	$sum = is_numeric($maxResult) ? ($z <= $maxResult ? $z : generate_captcha_sum($min, $max, $maxResult)) : $z;

	return [
		'x'   => $x,
		'y'   => $y,
		'sum' => $sum,
	];
}