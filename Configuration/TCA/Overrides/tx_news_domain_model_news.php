<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

// Make News teaser field required
if (isset($GLOBALS['TCA']['tx_news_domain_model_news']['columns']['teaser']['config']['eval'])) {
    $GLOBALS['TCA']['tx_news_domain_model_news']['columns']['teaser']['config']['eval']  = 'required';
}
