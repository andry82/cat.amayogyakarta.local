<?php
namespace App\Libraries;

class WrittenScore
{
	public static function cap($score, $main)
	{
		$score = (int) $score;
		$main  = (int) $main;

		return $main > 0 ? min($score, $main) : $score;
	}
}