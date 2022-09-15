<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace UniversityOfCopenhagen\KuPrototype\EventListener;

use Psr\Log\LoggerInterface;
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

    public function __invoke(AfterFileAddedEvent $event): void
    {   
        // Generic message from locallang.xlf
        $msg = (string)\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('upload-message', 'ku_prototype');

        $filename = $event->getFile();

        // $file_parts = pathinfo($filename);
        // switch($file_parts['extension']) {
        //     case 'pdf':
        //     case 'doc':
        //     case 'docx':
                 $this->notify($msg, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING);
        //         break;
        // }

        // Debug
        $this->logger->debug($filename);
        DebugUtility::debug($filename);
    }

     /**
     * Notifies the user using a Flash message.
     *
     * @param string $message The message
     * @param int $severity Optional severity, must be either of 
     * ::INFO, ::OK, ::WARNING, ::ERROR or ::OK.
     * @internal This method is public only to be callable from a callback
     */
    public function notify($message, $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::OK)
    {
        if (TYPO3_MODE !== 'BE' || PHP_SAPI === 'cli') {
            return;
        }
        $flashMessage = GeneralUtility::makeInstance(
            \TYPO3\CMS\Core\Messaging\FlashMessage::class,
            $message,
            '',
            $severity,
            true
        );
        /** @var \TYPO3\CMS\Core\Messaging\FlashMessageService $flashMessageService */
        $flashMessageService = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessageService::class);
        /** @var \TYPO3\CMS\Core\Messaging\FlashMessageQueue $defaultFlashMessageQueue */
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
        $defaultFlashMessageQueue->enqueue($flashMessage);
    }
}
