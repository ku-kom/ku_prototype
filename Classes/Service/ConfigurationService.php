<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPrototype\Service;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Site\Entity\Site;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/***
 *
 * This file is part of the "ku_prototype" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 *
 *  (c) 2019
 *
 ***/

/**
 * Settings service
 */
class ConfigurationService
{
    /**
     * @return string
     */
    public function provideConfiguration(): string
    {
        $siteConfiguration = $this->getSite()->getConfiguration();
        $settings = [
            'footerColOne' => $siteConfiguration['footerColOne'] ?? '',
            'footerColTwo' => $siteConfiguration['footerColTwo'] ?? '',
            'footerColThree' => $siteConfiguration['footerColThree'] ?? '',
            'footerColFour' => $siteConfiguration['footerColFour'] ?? '',
            'footercolumns' => $this->getFooterColumnConfiguration($siteConfiguration)
        ];

        return json_encode($settings);
    }

    protected function getFooterColumnConfiguration(array $siteConfiguration): array
    {
        $contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $footercolumns = [];
        for ($i = 1; $i <= 3; $i++) {
            if (
                ($siteConfiguration["manifestShortcuts{$i}Name"] ?? '') !== '' &&
                ($siteConfiguration["manifestShortcuts{$i}Url"] ?? '') !== ''
            ) {
                $footercolumns[] = \array_filter([
                    'name' => $siteConfiguration["manifestShortcuts{$i}Name"] ?? '',
                    'short_name' => $siteConfiguration["manifestShortcuts{$i}ShortName"] ?? '',
                    'description' => $siteConfiguration["manifestShortcuts{$i}Description"] ?? '',
                    'description' => $siteConfiguration["manifestShortcuts{$i}Description"] ?? '', 
                ]);
            }
        }

        return $footercolumns;
    }

    /**
     * @return ExtensionConfiguration
     */
    protected function getExtensionConfiguration(): ExtensionConfiguration
    {
        return GeneralUtility::makeInstance(ExtensionConfiguration::class);
    }

    /**
     * @return ServerRequest
     */
    protected function getServerRequest(): ServerRequest
    {
        return $GLOBALS['TYPO3_REQUEST'];
    }

    /**
     * @return Site
     */
    protected function getSite(): Site
    {
        return $this->getServerRequest()->getAttribute('site');
    }
}