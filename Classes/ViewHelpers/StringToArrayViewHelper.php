<?php

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

class StringToArrayViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{
    /**
     * This is a transient field, that means, that it havent
     * a declaration in SQL and TCA, but allows to add the getter,
     * which will do some special jobs... ie. will explode the comma
     * separated string to the array
     *
     * @var array
     */
        protected $featuresDecoded = [];
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
    public function getFeatures()
    {
        return $this->features;
    }

    /**
 * Sets the features
 *
 * @param string $features
 * @return void
 */
    public function setFeatures($features)
    {
        $this->features = $features;
    }

    /**
 * And this is getter of transient field, setter is not needed in this case
 * It just returns the array of IDs divided by comma
 *
 * @return array
 */
    public function getFeaturesDecoded()
    {
        return \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(',', $this->features, true);
    }

}
