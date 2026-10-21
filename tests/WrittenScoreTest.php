<?php

require_once __DIR__ . '/../diginiq-app/app/Libraries/WrittenScore.php';

use App\Libraries\WrittenScore;
use PHPUnit\Framework\TestCase;

final class WrittenScoreTest extends TestCase
{
	public function testCapsScoreWhenMainIsPositive(): void
	{
		$this->assertSame(10, WrittenScore::cap(14, 10));
		$this->assertSame(8, WrittenScore::cap(8, 10));
	}

	public function testDoesNotCapScoreWhenMainIsZeroOrNegative(): void
	{
		$this->assertSame(14, WrittenScore::cap(14, 0));
		$this->assertSame(14, WrittenScore::cap(14, -1));
	}
}