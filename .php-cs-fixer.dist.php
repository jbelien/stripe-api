<?php

$finder = PhpCsFixer\Finder::create()
    ->in('public')
    ->in('src')
    ->in('tests')
;

$config = new PhpCsFixer\Config();

return $config->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;