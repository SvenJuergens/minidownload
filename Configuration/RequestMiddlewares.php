<?php

return [
    'frontend' => [
        'svenjuergens/minidownload/file-download' => [
            'target' => 'Svenjuergens\\Minidownload\\Middleware\\FileDownload',
            'before' => [
                'typo3/cms-frontend/page-resolver',
            ],
        ],
    ],
];
