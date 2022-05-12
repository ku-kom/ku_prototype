<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 * @package TYPO3
 * @subpackage toolbox
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 2 or later
 * @author Marcus Biesioroff biesior@gmail.com>
 *
 * Sample ViewHelper for listing file's categories
 *
 * Usage:
 * 
 * <ul>
 *     <f:for each="{toolbox:fileCategories(file: file)}" as="file_cat">
 *         <li>{file_cat.title}</li>
 *     </f:for>
 * </ul>
 *
 * <toolbox:fileCategories file="{file}" />
 * or
 * {toolbox:fileCategories(file: file)}
 */


class FileCategoriesViewHelper extends AbstractViewHelper
{

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;

    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('file', 'mixed', 'File');
    }


    public function render()
    {
        /** @var FileReference $fileRef */
        $fileRef = $this->arguments['file'];
        $file = $fileRef->getOriginalFile();
        $uid = $file->getUid();
        /** @var QueryResult $res */
        $res =  $this->getCategories($uid);
        return $res->toArray();
    }


    private function getCategories($uid)
    {
        $query = $this->categoryRepository->createQuery();
        $sql = "SELECT sys_category.* FROM sys_category
            INNER JOIN sys_category_record_mm ON sys_category_record_mm.uid_local = sys_category.uid AND sys_category_record_mm.fieldname = 'categories' AND sys_category_record_mm.tablenames = 'sys_file_metadata'
            INNER JOIN sys_file_metadata ON  sys_category_record_mm.uid_foreign = sys_file_metadata.uid
            WHERE sys_file_metadata.file = '" . (int)$uid . "'
            AND sys_category.deleted = 0
            ORDER BY sys_category_record_mm.sorting_foreign ASC";
        return $query->statement($sql)->execute();
    }
}