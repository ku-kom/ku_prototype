<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

defined('TYPO3') or die('Access denied.');

// Container extension - rename Content Element Wizard label - also check TCEMAIN
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['itemGroups']['container'] = 'LLL:EXT:ku_prototype/Resources/Private/Language/locallang_be.xlf:container-grid';

// Make image upload mandatory in Ctype "Image only"
$GLOBALS['TCA']['tt_content']['types']['image']['columnsOverrides']['image']['config'] = [
    'minitems' => 1
];

// Make image alternative text mandatory:
// if (isset($GLOBALS['TCA']['sys_file_reference']['columns']['alternative']['config']['eval'])) {
//     $GLOBALS['TCA']['sys_file_reference']['columns']['alternative']['config']['eval']  = 'required';
// }
