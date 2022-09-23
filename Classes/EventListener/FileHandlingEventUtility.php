<?php

namespace UniversityOfCopenhagen\KuPrototype\EventListener;

use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class FileHandlingEventUtility
{
    public static function notify(File $file)
    {
        // Filename
        $filename = $file->getName();
        // File extension
        $extension = $file->getExtension();

        // Generic message from locallang.xlf
        $header = (string)\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('upload-header', 'ku_prototype');
        $msg = (string)\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('upload-message', 'ku_prototype');
        $msg = $msg . ' ' . $filename;

        // Display flash message only when uploading pdf or doc
        switch($extension) {
            case 'pdf':
            case 'doc':
            case 'docx':
                $flashMessage = GeneralUtility::makeInstance(
                    \TYPO3\CMS\Core\Messaging\FlashMessage::class,
                    $msg,
                    $header,
                    \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING,
                    true
                );
        
                $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
                $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
                $defaultFlashMessageQueue->enqueue($flashMessage);
                break;
        }
    }
}
