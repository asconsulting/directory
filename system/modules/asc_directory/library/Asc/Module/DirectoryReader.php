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
class DirectoryReader extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dir_reader';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dir_reader'][0]) . ' ###';
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
		
		$objDirectoryRecord = DirectoryRecord::findByIdOrAlias($pageAlias);
		
		// Return if no pending items were found
		if (!$objDirectoryRecord)
		{
			$this->Template->errNotFound = TRUE;
			return;
		}
		
		$arrSections = explode(',', $objDirectoryRecord->sections);
		if (!is_array($arrSections)) {$arrSections = array();}
		
		$objDirectorySection = DirectorySection::findMultipleByIds($arrSections, array('order' => 'name'));
		$arrSections = array();
		while ($objDirectorySection->next()) {
			$arrRecord = $objDirectorySection->row();
			
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
			$arrSections[] = $arrRecord;
		}
		
		$arrRecord = $objDirectoryRecord->row();
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
		if ($arrRecord['sections']) {
			if (!is_array($arrRecord['sections'])) {
				$arrRecord['sections'] = explode(',', $arrRecord['sections']);
			}
			if (!is_array($arrRecord['sections'])) {
				$arrRecord['sections'] = array();
			}
			$arrSections = array();
			foreach($arrRecord['sections'] as $section) {
				$objDirectorySection = DirectorySection::findByPk($section);
				if ($objDirectorySection) {
					if ($objDirectorySection->published) {
						$arrSection = $objDirectorySection->row();
						if ($objDirectorySection->image) {
							$strImage = '';
							$uuid = \StringUtil::binToUuid($objDirectorySection->image);
							$objFile = \FilesModel::findByUuid($uuid);
							$strImage = $objFile->path;
							if ($objFile) {
								$arrSection['image'] = $strImage;
							}
						}
						$arrSections[$section] = $arrSection;
					}
				}
			}
			$arrRecord['sections'] = $arrSections;
		}

		
		$this->Template->setData($arrRecord);
		$this->Template->sections = $arrSections;	
    }

}