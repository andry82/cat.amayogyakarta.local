<?php

use PHPUnit\Framework\TestCase;

final class RegistrationMainMasterTest extends TestCase
{
    public function testParticipantRegistrationUsesConfiguredMainMaster(): void
    {
        $controller = file_get_contents(__DIR__ . '/../diginiq-app/app/Controllers/Home.php');
        $registrationSchema = file_get_contents(__DIR__ . '/../writable/sql/registrasi.sql');
        $participantView = file_get_contents(__DIR__ . '/../writable/sql/peserta.sql');

        $this->assertStringContainsString('$this->settings->mainMaster ?? null', $controller);
        $this->assertStringContainsString("'main'                => \$mainMaster", $controller);
        $this->assertStringContainsString('`main` VARCHAR (100) NULL', $registrationSchema);
        $this->assertStringContainsString('`r`.`main`                 AS `main`', $participantView);
    }
}
