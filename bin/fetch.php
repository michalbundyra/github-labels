#!/usr/bin/env php
<?php
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

if ($argc !== 4) {
    fwrite(STDERR, sprintf("Usage: php %s <username> <github-token> <output-file>\n", basename(__FILE__)));
    exit(1);
}

list($bin, $username, $token, $outputFile) = $argv;

$client = new \Github\Client();
$client->authenticate($token, null, $client::AUTH_URL_TOKEN);

$userData = $client->user()->show($username);
$reposCount = $userData['public_repos'];

$userApi = new \Webimpress\GithubLabels\User($client);

$page = 1;
$data = [];
while (count($data) < $reposCount) {
    $repos = $userApi->repositories($username, 'owner', 'full_name', 'asc', $page);

    foreach ($repos as $repo) {
        $labels = $client->repo()->labels()->all($username, $repo['name']);
        $data[$repo['name']] = [];
        foreach ($labels as $label) {
            $data[$repo['name']][$label['name']] = $label['color'];
        }
    }

    ++$page;
}

file_put_contents($outputFile, '<' . '?php return ' . var_export($data, true) . ';' . PHP_EOL, LOCK_EX);
