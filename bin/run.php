#!/usr/bin/env php
<?php
chdir(dirname(__DIR__));

if ($argc !== 3) {
    fwrite(STDERR, sprintf("Usage: php %s <username> <github-token>\n", basename(__FILE__)));
    exit(1);
}

list($bin, $username, $token) = $argv;

$tmp = tempnam(sys_get_temp_dir(), $username);
exec(sprintf('bin/fetch.php %s %s %s', $username, $token, $tmp));
$html = sprintf('docs/%s.html', $username);
exec(sprintf('bin/generate.php %s %s %s', $username, $tmp, $html));
