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
use Contao\ModuleModel;
 
/**
 * Class Asc\Module\DirectoryReader
 */
class DirectoryResults extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dir_results';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dir_results'][0]) . ' ###';
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
		$intSearchModule = \Input::post('directory_search');
		if (!$intSearchModule) {
			return FALSE;
		}
		
		$objSearchModule = ModuleModel::findByPk($intSearchModule);
		if (!$objSearchModule || $objSearchModule->type != 'dir_search') {
			return FALSE;
		}
		
				
		$strSectionOrder = ($objSearchModule->sectionSortField ? $objSearchModule->sectionSortField : 'name') ." " .($objSearchModule->sectionSortOrder ? $objSearchModule->sectionSortOrder : 'ASC');
		$strRecordOrder = ($objSearchModule->recordSortField ? $objSearchModule->recordSortField : 'name') ." " .($objSearchModule->recordSortOrder ? $objSearchModule->recordSortOrder : 'ASC');

		$this->Template->results = array();
		
		$strKeywords = \Input::post('search');

		// Clean the keywords
		$strKeywords = utf8_strtolower($strKeywords);
		$strKeywords = \StringUtil::decodeEntities($strKeywords);

		if (function_exists('mb_eregi_replace'))
		{
			$strKeywords = mb_eregi_replace('[^[:alnum:] \*\+\'"\.:,_-]|\. |\.$|: |:$|, |,$', ' ', $strKeywords);
		}
		else
		{
			$strKeywords = preg_replace(array('/\. /', '/\.$/', '/: /', '/:$/', '/, /', '/,$/', '/[^\w\' *+".:,-]/u'), ' ', $strKeywords);
		}

		
		// Check keyword string
		if (!strlen($strKeywords))
		{
			return false;
		}
		
		if (!is_array($objSearchModule->directoryFields)) {
			$arrFields = unserialize($objSearchModule->directoryFields);
		} else {
			$arrFields = $objSearchModule->directoryFields;
		}

		if (!is_array($arrFields) || empty($arrFields)) {
			return false;
		}
		
		$arrSearchSections = \Input::post('section');
		
		$arrSections = array();
		$objDirectorySection = DirectorySection::findAll(array('order' => $strSectionOrder));
		
		while ($objDirectorySection->next()) {
			if (in_array($objDirectorySection->id, $arrSearchSections) && $objDirectorySection->published) { 
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
		}

		if (!empty($arrSearchSections) && empty($arrSections)) {
			return false;
		}
		
		$arrColumns = array();
		if (!empty($arrSections)) {
			$strColumn = '(';
			foreach ($arrSections as $arrSection) {
				$strColumn .= "FIND_IN_SET('" .$arrSection['id'] ."', sections) OR ";
			}
			$strColumn = substr($strColumn, 0, -4);
			$strColumn .= ")";
			$arrColumns[] = $strColumn;
		}

		$strColumn = '(';
		foreach ($arrFields as $strField) {
			//$strColumn .= $strField ." LIKE '" .$strKeywords ."%' OR ";
			$strColumn .= "INSTR(" .$strField .", '" .$strKeywords ."') > 0 OR ";
		}
		$strColumn = substr($strColumn, 0, -4);
		$strColumn .= ")";
		$arrColumns[] = $strColumn;
		
		$arrColumns[] = "published='1'";
		
		$arrResults = array();
		if ($objDirectoryRecord = DirectoryRecord::findAll(array('column' => $arrColumns, 'order'=>$strSectionOrder))) {
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
		}
		
		$this->Template->directory_search = $this->id;
		$this->Template->records = $arrResults;
    }

}