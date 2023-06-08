<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') || die();

return [
    // icon identifier
    'ku-extension-icon' => [
         // icon provider class
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
         // the source SVG for the SvgIconProvider
        'source' => 'EXT:ku_prototype/Resources/Public/Icons/Extension.svg',
    ],
];
