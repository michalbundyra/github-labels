# github-labels

Get repositories' labels for specific github user or organization.

Scripts require github token to run. To generate it, please follow steps
described [here](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/#creating-a-token).

## Usage

Repository contains three scripts:

### `bin/fetch.php <username> <github-token> <output-file>`

Get labels for all repositories (public or available for authenticated token)
and generate file with the following format:
```php
<?php
return [
    'repository-name' => [
        'label-text' => 'label-color',
        'another-label' => 'color',
        ...
    ],
    ...
];
```

### `bin/generate.php <username> <data-file> <output-file>`

Generate html table from file data (generated in script `bin/fetch.php`).
File is generated using template
[`template/layout.phtml`](template/layout.phtml).

### `bin/run.php <username> <github-token>`

The script uses two previous script: `bin/fetch.php` and `bin/generate.php`
and generate output html file in `html/` directory.
