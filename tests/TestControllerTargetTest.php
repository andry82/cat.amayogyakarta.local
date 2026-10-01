<?php

use PHPUnit\Framework\TestCase;

final class TestControllerTargetTest extends TestCase
{
    public function testTargetBypassIsDisabled(): void
    {
        $source = file_get_contents(__DIR__ . '/../diginiq-app/app/Controllers/Test.php');

        $this->assertStringNotContainsString("\$this->user['peserta']['target']", $source);
        $this->assertStringNotContainsString("=== 1", $source);
        $this->assertStringNotContainsString("!== 1", $source);
    }
}
