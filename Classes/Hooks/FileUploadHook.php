<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace UniversityOfCopenhagen\KuPrototype\Hooks;

use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\DataHandling\DataHandlerProcessUploadHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FileUploadHook implements DataHandlerProcessUploadHookInterface
{
    /**
    * Post-processes a file upload.
    *
    * @param string $filename The uploaded file
    * @param DataHandler $parentObject
    */
    public function processUpload_postProcessAction(&$filename, DataHandler $pObj)
    {
        $filename = $this->processFile(
            $filename,
            '', // Target file name
            '', // Target directory
            null,
            $this->getBackendUser(),
            [$this, 'notify']
        );
    }

        /**
     * Notifies the user using a Flash message.
     *
     * @param string $message The message
     * @param int $severity Optional severity, must be either of \TYPO3\CMS\Core\Messaging\FlashMessage::INFO,
     * \TYPO3\CMS\Core\Messaging\FlashMessage::OK, \TYPO3\CMS\Core\Messaging\FlashMessage::WARNING
     * or \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR.
     * Default is \TYPO3\CMS\Core\Messaging\FlashMessage::OK.
     * @internal This method is public only to be callable from a callback
     */
    public function notify(string $message, int $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::OK): void
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

    /**
     * Returns the current BE user, if any.
     *
     * @return BackendUserAuthentication|null
     */
    protected function getBackendUser(): ?BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'] ?? null;
    }
}
