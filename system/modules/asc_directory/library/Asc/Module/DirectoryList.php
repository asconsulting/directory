<?php
 
/**
 * ASC - Directory
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    AscDirectory
 * @link       https://andrewstevens.consulting
 */

 
namespace Asc\Module;
 
use Asc\Model\DirectoryRecord;
use Asc\Model\DirectorySection;
 
/**
 * Class Asc\Module\DirectoryReader
 */
class DirectoryList extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_directory_list';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['asc_directory_list'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&table=tl_module&act=edit&id=' . $this->id;
 
            return $objTemplate->parse();
        }
 
        return parent::generate();
    }
	
	 
    /**
     * Generate the module
     */
    protected function compile()
    {	
		
		$pageAlias = \Environment::get('request');
		if (substr($pageAlias, -5) == '.html') {
			$pageAlias = substr($pageAlias, 0, -5);
		}
		
		$objDirectorySection = DirectorySection::findByIdOrAlias($pageAlias);
		
		// Return if no pending items were found
		if (!$objDirectorySection)
		{
			$this->Template->errNotFound = TRUE;
			return;
		}
		
		$this->Template->section_name = $objDirectorySection->name;
		$this->Template->section_image = $objDirectorySection->image;
		$this->Template->section_description = $objDirectorySection->description;
		
		$arrColumns = array("FIND_IN_SET('" .$objDirectorySection->id ."', sections)");
		$arrColumns[] = "published='1'";
			
		$objDirectoryRecord = DirectoryRecord::findAll(array('column' => $arrColumns));
		
		if (!$objDirectoryRecord) {
			return false;
		}
		
		$arrResults = array();
		while($objDirectoryRecord->next()) {
			$arrResults[] = $objDirectoryRecord->row();
		}
		

		
		$this->Template->records = $arrResults;
    }

}