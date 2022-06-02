<?php

defined('TYPO3_MODE') || die();

// KU: Add input fields to site_language in "Language" tab in site configuration:
$GLOBALS['SiteConfiguration']['site_language']['columns']['local_footer_address'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.local_footer_address',
    'description' => '',
    //'displayCond' => 'FIELD:languageId:>:0',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Site address (html allowed)',
        'cols' => 25,
        'rows' => 8,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['columns']['local_footer_contact'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.local_footer_contact',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Site contact (html allowed)',
        'cols' => 25,
        'rows' => 8,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColOne'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col1',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColTwo'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col2',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColThree'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col3',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColFour'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col4',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html',
        'cols' => 60,
        'rows' => 15,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['types']['0']['showitem'] = str_replace(
    '--palette--;;default,',
    '--palette--;;default,local_footer_address,local_footer_contact,footerColOne,footerColTwo,footerColThree,footerColFour,',
    $GLOBALS['SiteConfiguration']['site_language']['types']['1']['showitem']
);
