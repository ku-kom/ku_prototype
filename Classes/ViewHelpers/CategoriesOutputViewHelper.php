<?php

declare(strict_types=1);

namespace UniversityOfCopenhagen\KuPrototype\ViewHelpers;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
 
/**
 * will return certain system categories (sys_category) data of an element
 * either as an array or as a string with certain parameters
 *
 * EXAMPLES:
 *
 * call an array with all category data to be used in a loop, e.g. for an HTML tag for each category:
 *    <f:if condition="{data.categories}">
 *        <f:for each="{ku:CategoriesOutput(recUid: data.uid)}" as="category">
 *            <span class="{category.slug}">{category.title}</span>
 *        </f:for>
 *    </f:if>
 *
 * call a “data-categories” attribute with the slug field of the categories, comma-separated (default):
 *     {ku:CategoriesOutput(recUid: data.uid, fieldString: 'slug', htmlAttr: 'data-categories')}
 *     output: ' data-categories="catx,caty"'
 *
 * call all categories as CSS classes (space as string separator, prefix 'cat-' for each category)
 *     {ku:CategoriesOutput(recUid: data.uid, fieldString: 'slug', stringSeparator: ' ', catPrefix: 'cat-')}
 *     output: 'cat-catx cat-caty'
 */
class CategoriesOutputViewHelper extends AbstractViewHelper
{
    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('recUid', 'integer', 'record UID, e.g. of a content element', true);
        $this->registerArgument('tableName', 'string', 'optional: table of records you want the categories returned for (default: tt_content)', false, 'tt_content');
        $this->registerArgument('fieldString', 'string', 'optional: name of sys_categories table field – if given, the return value will be a string', false, null);
        $this->registerArgument('stringSeparator', 'string', 'optional: separator for string', false, ',');
        $this->registerArgument('htmlAttr', 'string', 'optional: wrap in attribute for HTML tag (in case of fieldString given)', false, null);
        $this->registerArgument('catPrefix', 'string', 'optional: prefix for each category (e.g. for CSS classes)', false, null);
    }
 
    /**
     * @return mixed
     */
    public function render()
    {
        $recUid = $this->arguments['recUid'];
        $tableName = $this->arguments['tableName'];
        $fieldString = $this->arguments['fieldString'];
        $stringSeparator = $this->arguments['stringSeparator'];
        $htmlAttr = $this->arguments['htmlAttr'];
        $catPrefix = $this->arguments['catPrefix'];

        /**
         * default query for sys_category table
         */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('sys_category');

        /**
         * select the fields that will be returned, use asterisk for all
         */
        $queryBuilder->select('sys_category.uid', 'sys_category.title', 'sys_category.slug', 'sys_category_record_mm.uid_foreign', 'sys_category_record_mm.tablenames');
        $queryBuilder->from('sys_category');
        $queryBuilder->join(
            'sys_category',
            'sys_category_record_mm',
            'sys_category_record_mm',
            $queryBuilder->expr()->eq('sys_category_record_mm.uid_local', $queryBuilder->quoteIdentifier('sys_category.uid'))
        );
        $queryBuilder->where(
            $queryBuilder->expr()->eq('sys_category_record_mm.uid_foreign', $queryBuilder->createNamedParameter($recUid, \PDO::PARAM_INT)),
            $queryBuilder->expr()->like('sys_category_record_mm.tablenames', $queryBuilder->createNamedParameter($tableName))
        );

        $result = $queryBuilder->execute();
        $res = [];
        $returnString = '';
        $i = 1;
        while ($row = $result->fetch()) {
            $res[] = $row;
            if ($fieldString !== null) {
                if (isset($row[$fieldString])) {
                    $returnString .= ($i === 1) ? '' : $stringSeparator;
                    $returnString .= ($catPrefix !== null) ? $catPrefix : '';
                    $returnString .= $row[$fieldString];
                }
            }
            $i++;
        }

        if ($returnString !== '') {
            return ($htmlAttr !== null)
                ? ' ' . $htmlAttr . '="' . $returnString . '"'
                : $returnString;
        } elseif ($fieldString !== null) {
            return '';
        } else {
            return $res;
        }
    }
 
}