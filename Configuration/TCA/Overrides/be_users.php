<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

call_user_func(static function () {
    // Add fields to be_users table to show TCA fields definitions
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'be_users',
        [
        'ku_user_faculty' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['LLL:EXT:ku_prototype/Resources/Private/Language/locallang_tca.xlf:select_faculty_unset', ''],
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

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'be_users',
        'ku_user_faculty',
        '',
        'after:password'
    );
});
