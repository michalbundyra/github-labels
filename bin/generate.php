#!/usr/bin/env php
<?php
chdir(dirname(__DIR__));

if ($argc !== 4) {
    fwrite(STDERR, sprintf("Usage: php %s <username> <data-file> <output-file>\n", basename(__FILE__)));
    exit(1);
}

list($bin, $username, $dataFile, $outputFile) = $argv;

if (! file_exists($dataFile)) {
    fwrite(STDERR, "Data file does not exist\n");
}

$data = include $dataFile;

ob_start();
include 'template/layout.phtml';
$content = ob_get_clean();

file_put_contents($outputFile, $content);
