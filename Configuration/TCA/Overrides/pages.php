<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

call_user_func(function () {
    /**
     * Temporary variables
     */
    $extensionKey = 'ku_prototype';

    /**
     * Default PageTS for KuPrototype
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
        $extensionKey,
        'Configuration/TsConfig/Page/All.tsconfig',
        'KU prototype'
    );

    // Add faculty fields to pages table to show TCA fields definitions
    $GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['pages']['columns'],
        [
            'ku_faculty' => [
                // Faculty select box on every site root page
                'displayCond' => 'FIELD:is_siteroot:REQ:true', // Site root only
                'exclude' => 1,
                'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty', '--div--'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_inherit', ''],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_ku', 'ku'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_hum', 'hum'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_sund', 'sund'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_jura', 'jura'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_teo', 'teo'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_science', 'science'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_samf', 'samf'],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_unset', 'unset'],
                    ],
                ],
            ],
            'ku_select_author' => [
                // List of backend users
                'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_author',
                'exclude' => 1,
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_author', ''],
                    ],
                    'itemsProcFunc' => 'UniversityOfCopenhagen\KuPrototype\UserFunctions\BackendUsers->getBackendUsers',
                    // 'foreign_table' => 'be_users',
                    // 'foreign_table_where' => 'AND be_users.realName IN (0,-1) ORDER BY be_users.realName ASC',
                ],
            ],
        ]
    );

    // Make fields visible in the TCEforms in a new KU tab:
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        '--div--;LLL:EXT:ku_prototype/Resources/Private/Language/locallang.xlf:frontend.ku-short,ku_faculty,ku_select_author',
        '',
        ''
    );
});
