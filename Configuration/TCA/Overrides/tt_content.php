<?php
defined('TYPO3_MODE') || die();

call_user_func(function () {

    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes']['minidownload_minidownload'] = 'tx_minidownload_minidownload';
    $tempColumns = [
        'tx_minidownload_download_pw' => [
            'config' => [
                'autocomplete' => '0',
                'behaviour' => [
                    'allowLanguageSynchronization' => '0',
                ],
                'type' => 'input',
            ],
            'exclude' => '1',
            'label' => 'LLL:EXT:minidownload/Resources/Private/Language/locallang_db.xlf:tt_content.tx_minidownload_download_pw',
        ],
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
        'LLL:EXT:minidownload/Resources/Private/Language/locallang_db.xlf:tt_content.CType.div._minidownload_',
        '--div--',
    ];
    $GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = [
        'LLL:EXT:minidownload/Resources/Private/Language/locallang_db.xlf:tt_content.CType.minidownload_minidownload',
        'minidownload_minidownload',
        'tx_minidownload_minidownload',
    ];
    $tempTypes = [
        'minidownload_minidownload' => [
            'columnsOverrides' => [
                'bodytext' => [
                    'config' => [
                        'enableRichtext' => 1,
                    ],
                ],
            ],
            'showitem' => '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,header,bodytext,assets,tx_minidownload_download_pw,--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,--palette--;;language,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,--palette--;;hidden,--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,--div--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_category.tabs.category,categories,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,rowDescription,--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
        ],
    ];
    $GLOBALS['TCA']['tt_content']['types'] += $tempTypes;
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'minidownload',
        'Configuration/TypoScript/',
        'minidownload'
    );

});

