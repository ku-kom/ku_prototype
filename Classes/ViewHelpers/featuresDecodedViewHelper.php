<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Features
 *
 * @var string
 */
protected $features = '';

/**
 * Returns the features
 *
 * @return string $features
 */
public function getFeatures() {
    return $this->features;
}

/**
 * Sets the features
 *
 * @param string $features
 * @return void
 */
public function setFeatures($features) {
    $this->features = $features;
}