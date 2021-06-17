<?php

$finder = PhpCsFixer\Finder::create()
    ->notPath('.ebextensions')
    ->notPath('.elasticbeanstalk')
    ->notPath('docs')
    ->notPath('public')
    ->notPath('resources')
    ->notPath('storage')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

$config = new PhpCsFixer\Config();

return $config
    ->setCacheFile(__DIR__ . '/vendor/.php_cs.cache')
    ->setRules([
        '@PSR12'          => true,
        '@PHP80Migration' => true,
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'align_single_space_minimal'
            ]
        ],
    ])
    ->setFinder($finder);
