<?php

defined('TYPO3_MODE') || die();

// Add faculty fields to pages table to show TCA fields definitions
$GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['pages']['columns'],
    [
        'ku_faculty' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty', '--div--'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_inherit',''],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_ku', 'ku'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_hum', 'hum'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_sund', 'sund'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_jura', 'jura'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_teo', 'teo'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_science', 'science'],
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_samf', 'samf'],
                ],
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'ku_faculty', '1,3,4', 'before:doktype');

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
});
