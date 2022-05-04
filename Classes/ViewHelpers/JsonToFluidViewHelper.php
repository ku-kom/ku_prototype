<?php 

declare(strict_types=1);

/*
 * This file is part of the package ku_protopype.
 * Usage: <ku:JsonToFluid api="https://yoursite/path.json" />
 *
 */
namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;
use TYPO3\CMS\Core\Http\RequestFactory;
use TYPO3\CMS\Core\Utility\GeneralUtility;


/**
 * renders the header of the results page
 * @internal
 */
class JsonToFluidViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * As this ViewHelper renders HTML, the output must not be escaped.
     *
     * @var bool
     */
    protected $escapeOutput = false;

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        $this->registerArgument('api', 'string', '', true);
    }

    /**
     * @param array $arguments
     * @param callable|\Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return array
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $api = $arguments['api'];
        $req = GeneralUtility::makeInstance(RequestFactory::class);
        $response = $req->request($api,'GET',[]);
        $rawResponse = $response->getBody()->getContents();
        return json_decode($rawResponse, true);
    }
}