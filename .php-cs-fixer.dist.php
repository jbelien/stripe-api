<?php

$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('public')
;

$config = new PhpCsFixer\Config();

return $config->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;