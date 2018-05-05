<?php
 
/**
 * ASC - Directory
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    AscDirectory
 * @link       https://andrewstevens.consulting
 */

 
namespace Asc;


/**
 * Class Asc\DirectoryPage
 */
class DirectoryPage extends \Contao\Frontend {
	
	public function loadListPageFromUrl($arrFragments)
    {
		
		if ($objPage = \PageModel::findPublishedByIdOrAlias($arrFragments[0])) {
			return $arrFragments;
		}
		
		$objAttribute = \Database::getInstance()->execute("SELECT field_name, attributeListPage FROM tl_iso_attribute WHERE type LIKE 'attributeCategory' ORDER BY CHAR_LENGTH(field_name) DESC");
			
		while($objAttribute->next()) { 
			if (substr($arrFragments[0], 0, (strlen($objAttribute->field_name) + 1)) == ($objAttribute->field_name ."_")) {
				$objNewPage = \PageModel::findPublishedByIdOrAlias($objAttribute->attributeListPage);
				if ($objNewPage) {
					return array($objNewPage->alias);
				}
			}
		}
		
        return $arrFragments;
    }
}