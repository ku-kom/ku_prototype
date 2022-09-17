<?php

declare(strict_types=1);

/*
 * This file is part of the package ku_prototype.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sep 2022 Nanna Ellegaard, University of Copenhagen.
 */

namespace UniversityOfCopenhagen\KuPrototype\UserFunctions;

class Time
{
    /**
     * Output the current time
     *
     * @param  string          Empty string (no content to process)
     * @param  array           TypoScript configuration
     * @return string          HTML output, showing the current server time.
     */
    public function printTime(string $content, array $conf): string
    {
        date_default_timezone_set('Europe/Copenhagen');
        return '<div class="current-time">' . date('H:i:s') . '</div>';
    }
}
