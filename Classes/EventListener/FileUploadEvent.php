<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace UniversityOfCopenhagen\KuPrototype\EventListener;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Resource\Event\AfterFileAddedEvent;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FileUploadEvent
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ApiOverview/Events/Events/Core/Resource/Index.html
     * @param \TYPO3\CMS\Core\Resource\Event\AfterFileAddedEvent
     * Return void
     */
    public function __invoke(AfterFileAddedEvent $event): void
    {
        // Generic message from locallang.xlf
        $title = (string)\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('upload-header', 'ku_prototype');
        $msg = (string)\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('upload-message', 'ku_prototype');

        $file = $event->getFile();

        // Display flash message only when uploading pdf or doc
        // $file_parts = pathinfo($file);
        // switch($file_parts['extension']) {
        //     case 'pdf':
        //     case 'doc':
        //     case 'docx':
        $this->notify($msg, $title, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING, true);
        //         break;
        // }

        // Debug
        // $this->logger->debug($file);
        // DebugUtility::debug($file);
    }

     /**
     * Notifies the user using a Flash message.
     *
     * @param string $message The message
     * @param int $severity Optional severity, must be either of
     * ::INFO, ::OK, ::WARNING, ::ERROR or ::OK.
     * @internal This method is public only to be callable from a callback
     */
    public function notify($message, $title = '', $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::OK, bool $storeInSession = false)
    {
        if (TYPO3_MODE !== 'BE' || PHP_SAPI === 'cli') {
            return;
        }
        $flashMessage = GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Messaging\FlashMessage::class,
            $message,
            $title,
            $severity,
            $storeInSession
        );

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $defaultFlashMessageQueue->enqueue($flashMessage);
    }
}
