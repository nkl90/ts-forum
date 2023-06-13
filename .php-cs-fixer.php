<?php

declare(strict_types=1);

if (PHP_VERSION_ID < 8_02_00 || PHP_VERSION_ID >= 8_03_00) {
    fwrite(STDERR, "PHP CS Fixer's config for PHP-HIGHEST can be executed only on highest supported PHP version - 8.2.*.\n");
    fwrite(STDERR, "Running it on lower PHP version would prevent calling migration rules.\n");

    exit(1);
}

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude('var')
;

$config = (new PhpCsFixer\Config())
    ->setFinder($finder)
;

$config->setRules(array_merge($config->getRules(), [
    '@PHP82Migration' => true,
    '@PHP80Migration:risky' => false,
    'heredoc_indentation' => false,
]));

return $config;
