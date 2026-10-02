<?php

$src = file_get_contents(__DIR__ . '/../diginiq-app/app/Controllers/Test.php');

if (strpos($src, 'public function jawab()') === false || strpos($src, '> 0') === false) {
    fwrite(STDERR, "Missing final-submit target guard\n");
    exit(1);
}

if (strpos($src, "(int) (\$this->user['peserta']['target'] ?? 0) === 1") !== false
    || strpos($src, "(int) (\$this->user['peserta']['target'] ?? 0) !== 1") !== false) {
    fwrite(STDERR, "Old target guard still present in Test controller\n");
    exit(1);
}

echo "target final-sync guard ok\n";
