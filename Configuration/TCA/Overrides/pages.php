<?php

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
        ]
    );


    // Make fields visible in the TCEforms in a new tab:
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages', 
        '--div--;LLL:EXT:ku_prototype/Resources/Private/Language/locallang.xlf:frontend.ku-short,ku_faculty', 
        '',
        ''
    );
});
