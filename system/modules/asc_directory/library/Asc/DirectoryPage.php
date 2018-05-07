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

use Asc\Model\DirectoryRecord;
use Asc\Model\DirectorySection;

/**
 * Class Asc\DirectoryPage
 */
class DirectoryPage {
	
	public function loadListPageFromUrl($arrFragments)
    {
		
		if ($objPage = \PageModel::findPublishedByIdOrAlias($arrFragments[0])) {
			return $arrFragments;
		}
		
		// Is section?
		if ($objDirectorySection = DirectorySection::findByIdOrAlias($arrFragments[0])) {
			if ($objPage = \PageModel::findAll(array('column' => array("asc_directorySectionPage='1'", "published='1'")))) {
				return array($objPage->alias);
			}
		}
		
		// Is Record
		if ($objDirectoryRecord = DirectoryRecord::findByIdOrAlias($arrFragments[0])) {
			if ($objPage = \PageModel::findAll(array('column' => array("asc_directoryReaderPage='1'", "published='1'")))) {
				return array($objPage->alias);
			}
		}
		
        return $arrFragments;
    }
}