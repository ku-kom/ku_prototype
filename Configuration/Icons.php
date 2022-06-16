<?php

/**
 * Icon Registry
 */

defined('TYPO3_MODE') || die();

   return [
       // icon identifier
       'ku-extension-icon' => [
            // icon provider class
           'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
            // the source SVG for the SvgIconProvider
           'source' => 'EXT:ku_prototype/Resources/Public/Icons/Extension.svg',
       ],
   ];