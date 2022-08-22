<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Docs: https://t3terminal.com/blog/typo3-site-configuration/

$GLOBALS['SiteConfiguration']['site']['columns']['ku_user_faculty'] = [
    'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_content_responsible',
    'config' => [
        'type' => 'select',
        'renderType' => 'selectSingle',
        // List of backend users
        'items' => [
            ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_content_responsible', ''],
        ],
        'itemsProcFunc' => 'UniversityOfCopenhagen\KuPrototype\UserFunctions\BackendUsers->getBackendUsers',
    ],
];

// add a new palette for custom fields for t3kit specific options
$GLOBALS['SiteConfiguration']['site']['palettes']['ku_user_faculty'] = [
    'showitem' => 'ku_user_faculty'
];

$GLOBALS['SiteConfiguration']['site']['types']['0']['showitem'] = str_replace(
    'base,',
    'base,--palette--;;ku_user_faculty,',
    $GLOBALS['SiteConfiguration']['site']['types']['0']['showitem']
);
