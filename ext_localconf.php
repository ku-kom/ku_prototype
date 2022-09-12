<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3_MODE') || die();

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

// Add custom database field to rootline - keep the '&'
$rootlinefields = &$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'];
if ($rootlinefields != '') {
    $rootlinefields .= ' , ';
}
$rootlinefields .= 'ku_faculty';

// KU Hook for file upload:

/** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
$signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);

// Hook into \TYPO3\CMS\Core\Resource\ResourceStorage
$signalSlotDispatcher->connect(
    'TYPO3\\CMS\\Core\\Resource\\ResourceStorage',
    \TYPO3\CMS\Core\Resource\ResourceStorageInterface::SIGNAL_PostFileAdd,
    \UniversityOfCopenhagen\KuPrototype\Slots\FileUpload::class
);

// Uploads in uploads/ of good old non-FAL files
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processUpload'][] = \UniversityOfCopenhagen\KuPrototype\Hooks\FileUploadHook::class;
