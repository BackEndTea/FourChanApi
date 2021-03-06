<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);
$config = PhpCsFixer\Config::create()
    ->setUsingCache(true)
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'no_unused_imports' => true,
        'ordered_imports' => true,
        'psr0' => false,
        'single_quote' => true,
        'trailing_comma_in_multiline_array' => true,
    ])
    ->setFinder($finder);
if (getenv('TRAVIS')) {
    $config->setCacheFile(getenv('HOME') . '/.php-cs-fixer/.php_cs.cache');
}
return $config;