<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') || die();

// KU: Add input fields to site_language in "Language" tab in site configuration:
$GLOBALS['SiteConfiguration']['site_language']['columns']['local_footer_address'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.local_footer_address',
    'description' => '',
    //'displayCond' => 'FIELD:languageId:>:0',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Site address information (html allowed)',
        'cols' => 25,
        'rows' => 8,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['columns']['local_footer_contact'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.local_footer_contact',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Site contact information (html allowed)',
        'cols' => 25,
        'rows' => 8,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColOne'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col1',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html to override global footer column',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColTwo'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col2',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html to override global footer column',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColThree'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col3',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html to override global footer column',
        'cols' => 60,
        'rows' => 15,
    ],
];
$GLOBALS['SiteConfiguration']['site_language']['columns']['footerColFour'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:backend_layout.column.footer_col4',
    'description' => '',
    'config' => [
        'type' => 'text',
        'placeholder' => 'Add html to override global footer column',
        'cols' => 60,
        'rows' => 15,
    ],
];

$GLOBALS['SiteConfiguration']['site_language']['types']['1']['showitem'] = str_replace(
    'default,',
    'default, local_footer_address, local_footer_contact, footerColOne, footerColTwo, footerColThree, footerColFour,',
    $GLOBALS['SiteConfiguration']['site_language']['types']['1']['showitem']
);
