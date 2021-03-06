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
    protected $strTemplate = 'mod_dir_list';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dir_list'][0]) . ' ###';
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
		
		$strSectionOrder = ($this->sectionSortField ? $this->sectionSortField : 'name') ." " .($this->sectionSortOrder ? $this->sectionSortOrder : 'ASC');
		$strRecordOrder = ($this->recordSortField ? $this->recordSortField : 'name') ." " .($this->recordSortOrder ? $this->recordSortOrder : 'ASC');
		
		$pageAlias = \Environment::get('request');
		if (substr($pageAlias, -5) == '.html') {
			$pageAlias = substr($pageAlias, 0, -5);
		}
		
		if ($objDirectorySection = DirectorySection::findByIdOrAlias($pageAlias)) {
			$this->Template->section = $pageAlias;
		} else {
			$this->Template->section = false;
		}
		
		if ($objDirectorySection->image) {
			$strImage = '';
			$uuid = \StringUtil::binToUuid($objDirectorySection->image);
			$objFile = \FilesModel::findByUuid($uuid);
			$strImage = $objFile->path;
			if ($objFile) {
				$this->Template->section_image = $strImage;
			}
		}

		$this->Template->section_name = $objDirectorySection->name;
		$this->Template->section_description = $objDirectorySection->description;
		
		if ($objDirectorySection || !$this->directoryShowAll) {
			$arrColumns = array("FIND_IN_SET('" .$objDirectorySection->id ."', sections)");
		}
		$arrColumns[] = "published='1'";
			
		$objDirectoryRecord = DirectoryRecord::findAll(array('column' => $arrColumns, 'order' => $strRecordOrder));
		
		if (!$objDirectoryRecord) {
			return false;
		}
		
		$arrResults = array();
		while($objDirectoryRecord->next()) {
			$arrRecord = $objDirectoryRecord->row();
			
			$arrSections = explode(',', $objDirectoryRecord->sections);
			if (!is_array($arrSections)) {$arrSections = array();}
			
			$objDirectorySection = DirectorySection::findMultipleByIds($arrSections, array('order' => $strSectionOrder));
			$arrSections = array();
			while ($objDirectorySection->next()) {
				$arrSection = $objDirectorySection->row();
				
				if ($arrSection['image']) {
					$strImage = '';
					$uuid = \StringUtil::binToUuid($arrSection['image']);
					$objFile = \FilesModel::findByUuid($uuid);
					$strImage = $objFile->path;
					if ($objFile) {
						$arrSection['image'] = $strImage;
					} else {
						$arrSection['image'] = '';
					}
				}
				$arrSections[] = $arrSection;
			}
			$arrRecord['sections'] = $arrSections;
			
			if ($arrRecord['image']) {
				$strImage = '';
				$uuid = \StringUtil::binToUuid($arrRecord['image']);
				$objFile = \FilesModel::findByUuid($uuid);
				$strImage = $objFile->path;
				if ($objFile) {
					$arrRecord['image'] = $strImage;
				} else {
					$arrRecord['image'] = '';
				}
			}
			$arrResults[] = $arrRecord;
		}
		
		$this->Template->records = $arrResults;
    }

}