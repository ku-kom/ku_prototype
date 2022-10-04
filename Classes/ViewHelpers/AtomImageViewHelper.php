<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class AtomImageViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('contentNode', 'string', 'The node item.content', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        return self::getAtomImage($arguments['contentNode']);
    }

    /**
     * Returns first image src in Atom content node
     *
     * @param string $contentNode
     * @return string
     */
    protected static function getAtomImage(string $contentNode): string
    {
        $data = $contentNode;
        $regex_format = '/<img.*?src="([^">]*\/([^">]*?))".*?>/i';
        $result = array();
        
        // Find first image src
        if (preg_match($regex_format, $data, $result)) {
            return $result[1];
        } else {
            return '';
        }
    }
}
