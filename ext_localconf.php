<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') || die();

// PageTS
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
    @import \'EXT:ku_prototype/Configuration/TsConfig/Page/All.tsconfig\'
');

// Add default RTE configuration
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ku_prototype'] = 'EXT:ku_prototype/Configuration/RTE/Default.yaml';

// KU sinmple editor
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ku_simple'] = 'EXT:ku_prototype/Configuration/RTE/KU_simple.yaml';

// KU news editor
$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['ku_news'] = 'EXT:ku_prototype/Configuration/RTE/KU_news.yaml';

// KU Viewhelper namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['ku'] = ['UniversityOfCopenhagen\KuPrototype\ViewHelpers'];

// Level sliding: Add custom database field to rootline - keep the '&'
$rootlinefields = &$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'];
if ($rootlinefields != '') {
    $rootlinefields .= ' , ';
}
$rootlinefields .= 'ku_faculty';

// Hook to add timestamp when page content is edited
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'UniversityOfCopenhagen\\KuPrototype\\Hooks\\LatestPageUpdates';
