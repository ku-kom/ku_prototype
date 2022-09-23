<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

/**
 * Listens for fileuploads and displays flash message if the file is
 * a pdf or doc.
 */
namespace UniversityOfCopenhagen\KuPrototype\EventListener;

use TYPO3\CMS\Core\Resource\Event\AfterFileAddedEvent;

final class FileUploadEvent
{
    /**
    * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Events/Events/Core/Resource/Index.html
    * @param \TYPO3\CMS\Core\Resource\Event\AfterFileAddedEvent
    * Return void
    */
    public function __invoke(AfterFileAddedEvent $event): void
    {
        $file = $event->getFile();
        FileHandlingEventUtility::notify($file);
    }

}
