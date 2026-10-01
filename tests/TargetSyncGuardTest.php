<?php

$src = file_get_contents(__DIR__ . '/../diginiq-app/app/Controllers/Test.php');
$needle = "(int) (\$this->user['peserta']['target'] ?? 0) === 1";

if (strpos($src, $needle) === false) {
    fwrite(STDERR, "Missing target guard in Test controller\n");
    exit(1);
}

echo "target guard present\n";
