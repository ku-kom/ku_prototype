<?php

defined('TYPO3_MODE') || die();

// KU: Add input field to site_language in "Language" tab in site configuration:

$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColOne'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col1',
    'description' => '',
    //'displayCond' => 'FIELD:languageId:>:0',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Html',
        'cols' => 50,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColTwo'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col2',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Html',
        'cols' => 50,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColThree'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col3',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Html',
        'cols' => 50,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColFour'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col4',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Html',
        'cols' => 50,
        'rows' => 15,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['types']['1']['showitem'] = str_replace(
    '--palette--;;default,',
    '--linebreak--, footerColOne,
    --linebreak--, footerColTwo,
    --linebreak--, footerColThree,
    --linebreak--, footerColFour',
    $GLOBALS['SiteConfiguration']['site_language']['types']['1']['showitem']
);
