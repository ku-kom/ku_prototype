<?php

defined('TYPO3_MODE') || die();

// Add some fields to pages table to show TCA fields definitions
$GLOBALS['TCA']['pages']['columns'] = array_replace_recursive(
    $GLOBALS['TCA']['pages']['columns'],
    [
        'ku_faculties' => [
            'exclude' => 0,
            'label' => 'Vælg fakultet',
            'description' => '',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['Vælg fakultet', '--div--'],
                    ['KU', 1],
                    ['Det Humanistiske Fakultet', 2],
                    ['Det Sundhendvidenskabelige Fakultet', 3],
                    ['Det Juridiske Fakultet', 4],
                    ['Det Teologiske Fakultet', 5],
                    ['Det Natur- og Biovidenkabelige Fakultet', 6],
                    ['Det Samfundsvidenskabelige Fakultet', 7],
                ],
                'size' => 1,
                'maxitems' => 1,
            ],
        ],
    ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'ku_faculties', '1,3,4', 'before:doktype');

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
