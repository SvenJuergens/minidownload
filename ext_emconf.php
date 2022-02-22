<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'minidownload',
    'description' => 'Download a file only after entering a password',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
        ],
    ],
    'version' => '0.1.0',
    'autoload' => [
        'psr-4' => [
            'Svenjuergens\\Minidownload\\' => 'Classes/',
        ],
    ],
];
