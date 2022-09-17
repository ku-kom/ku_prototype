<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class AuthorNameViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    /**
     * Initialize arguments
     *
     * @return void
     */
    public function initializeArguments()
    {
        $this->registerArgument('authorUid', 'integer', 'uid of the author', true);
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        return self::getAuthorRealName($arguments['authorUid']);
    }

    /**
     * Returns the real name and e-mail of selected author by uid if set,
     * otherwise admin.
     *
     * @param int $authorUid
     * @return string
     */
    protected static function getAuthorRealName(int $authorUid): string
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');

        $result = $queryBuilder
        ->select('realName', 'email')
        ->from('be_users')
        ->where($queryBuilder->expr()->eq(
            'uid',
            $queryBuilder->createNamedParameter($authorUid, \PDO::PARAM_STR)
        ))
        ->execute()
        ->fetch();

        $name = $result['realName'];
        $email = $result['email'];

        if ($result !== false ? $result : null) {
            if ($name && $email) {
                return $name . '<br><a href="mailto:' . $email . '">' . $email . '</a>';
            } else {
                return $name;
            }
        }
    }
}
