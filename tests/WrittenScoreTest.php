<?php

use App\Libraries\WrittenScoring;
use PHPUnit\Framework\TestCase;

final class WrittenScoreTest extends TestCase
{
    public function testMainCapsEarnedPointsWithoutChangingCorrectAnswers(): void
    {
        $questions = [
            ['id' => 3, 'nomor' => 3, 'jawaban' => 'b', 'kunci_jawaban' => 'a'],
            ['id' => 2, 'nomor' => 2, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
            ['id' => 1, 'nomor' => 1, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
        ];

        $result = WrittenScoring::calculate($questions, 5, 5);

        $this->assertSame([
            'points' => [1 => 5, 2 => 0, 3 => 0],
            'total'  => 5,
        ], $result);
        $this->assertSame('a', $questions[1]['jawaban']);
        $this->assertSame('a', $questions[2]['jawaban']);
    }

    public function testMainCanPartiallyAwardTheLastCorrectAnswer(): void
    {
        $questions = [
            ['id' => 1, 'nomor' => 1, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
            ['id' => 2, 'nomor' => 2, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
            ['id' => 3, 'nomor' => 3, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
        ];

        $result = WrittenScoring::calculate($questions, 5, 7);

        $this->assertSame([
            'points' => [1 => 5, 2 => 2, 3 => 0],
            'total'  => 7,
        ], $result);
    }

    public function testMainZeroDoesNotLimitTheScore(): void
    {
        $questions = [
            ['id' => 1, 'nomor' => 1, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
            ['id' => 2, 'nomor' => 2, 'jawaban' => 'b', 'kunci_jawaban' => 'a'],
            ['id' => 3, 'nomor' => 3, 'jawaban' => 'a', 'kunci_jawaban' => 'a'],
        ];

        $result = WrittenScoring::calculate($questions, 5, 0);

        $this->assertSame([
            'points' => [1 => 5, 2 => 0, 3 => 5],
            'total'  => 10,
        ], $result);
    }
}