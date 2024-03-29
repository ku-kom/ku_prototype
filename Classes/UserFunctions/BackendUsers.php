<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

namespace UniversityOfCopenhagen\KuPrototype\UserFunctions;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class BackendUsers
{
    /**
     * Gets list of backend users.
     *
     * @param array	The current config array.
     * @return array
     */
    public function getBackendUsers($config)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('be_users');

        $result = $queryBuilder
            ->select('realName', 'uid')
            ->from('be_users')
            ->orderBy('realName', 'ASC')
            ->executeQuery();

        while ($row = $result->fetchAssociative()) {
            // Each user row
            $name = $row['realName'];
            $uid = $row['uid'];

            if ($name) {
                $config ['items'] [] = [
                    // label, value
                    $name, $uid
                ];
            }
        }

        return $config;
    }
}
