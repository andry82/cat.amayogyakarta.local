<?php
namespace App\Libraries;

use Arifrh\DynaModel\DB;
use RuntimeException;

class WrittenScoring
{
	public static function calculate(array $questions, int $pointsPerCorrect, int $maximum): array
	{
		usort($questions, static function ($first, $second) {
			return (int) $first['nomor'] <=> (int) $second['nomor'];
		});

		$points = [];
		$total  = 0;
		$pointsPerCorrect = max(0, $pointsPerCorrect);

		foreach ($questions as $question)
		{
			$id = (int) $question['id'];
			$points[$id] = 0;

			if (! isset($question['jawaban'])
				|| $question['jawaban'] === ''
				|| (string) $question['jawaban'] !== (string) $question['kunci_jawaban'])
			{
				continue;
			}

			$earned = $pointsPerCorrect;

			if ($maximum > 0)
			{
				$earned = min($earned, max(0, $maximum - $total));
			}

			$points[$id] = $earned;
			$total += $earned;
		}

		return [
			'points' => $points,
			'total'  => $total,
		];
	}

	public static function recalculate(string $noRegistration): int
	{
		$registration = DB::table('registrasi')->findOneBy([
			'no_registrasi' => $noRegistration,
		]);

		if (! is_array($registration))
		{
			throw new RuntimeException('Registrasi tidak ditemukan: ' . $noRegistration);
		}

		$test = DB::table('tests')->findOneBy([
			'kode_test' => $registration['kode_test'],
		]);

		if (! is_array($test))
		{
			throw new RuntimeException('Tes tidak ditemukan: ' . $registration['kode_test']);
		}

		$table = DB::table('tes_tertulis');
		$questions = $table->orderBy('nomor', 'asc')->findBy([
			'no_registrasi' => $noRegistration,
		]);

		if (! is_array($questions))
		{
			$questions = [];
		}

		$result = self::calculate(
			$questions,
			(int) $test['poin_tes_tertulis'],
			(int) ($registration['main'] ?? 0)
		);

		foreach ($questions as $question)
		{
			$table->updateBy([
				'poin' => $result['points'][(int) $question['id']],
			], [
				'no_registrasi' => $noRegistration,
				'id'            => $question['id'],
			]);
		}

		DB::table('registrasi')->updateBy([
			'skor_tertulis' => $result['total'],
		], [
			'no_registrasi' => $noRegistration,
		]);

		return $result['total'];
	}
}
