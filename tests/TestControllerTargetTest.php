<?php

use PHPUnit\Framework\TestCase;

final class TestControllerTargetTest extends TestCase
{
    public function testTargetOneKeepsLiveScoringButSkipsFinalOverwrite(): void
    {
        $source = file_get_contents(__DIR__ . '/../diginiq-app/app/Controllers/Test.php');

        $this->assertStringContainsString('public function jawab()', $source);
        $this->assertStringContainsString("!== 1", $source);
        $this->assertStringNotContainsString("if ((int) (\$this->user['peserta']['target'] ?? 0) === 1)\n\t\t\t{\n\t\t\t\treturn;\n\t\t\t}", $source);
    }
}
