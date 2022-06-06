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
        [   // Faculty select box on every site root page
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

            // Javascript assets multiple select box on every page
            'assets_js' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_assets_js',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectMultipleSideBySide',
                    'items' => [
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_assets_js.scroll_indicator', 'scroll',],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_assets_js.crazyEgg', 'crazyegg',],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_assets_js.advanced','--div--',],
                        ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_assets_js.jQuery', 'jquery',],
                    ],
                    'size' => 3,
                    'autoSizeMax' => 5,
                ],
            ],
        ]
    );


    // Make fields visible in the TCEforms in a new KU tab:
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages', 
        '--div--;LLL:EXT:ku_prototype/Resources/Private/Language/locallang.xlf:frontend.ku-short,ku_faculty', 
        '',
        ''
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'assets_js', '', 'after:ku_faculty');
});
