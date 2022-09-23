<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

/**
 * Listens for file replacements and displays flash message if the file is
 * a pdf or doc.
 */
namespace UniversityOfCopenhagen\KuPrototype\EventListener;

use TYPO3\CMS\Core\Resource\Event\AfterFileReplacedEvent;

final class FileReplacedEvent
{
    /**
    * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Events/Events/Core/Resource/AfterFileReplacedEvent.html
    * @param \TYPO3\CMS\Core\Resource\Event\AfterFileReplacedEvent
    * Return void
    */
    public function __invoke(AfterFileReplacedEvent $event): void
    {
        $file = $event->getFile();
        FileHandlingEventUtility::notify($file);
    }

}
