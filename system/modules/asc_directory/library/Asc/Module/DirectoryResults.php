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
    protected $strTemplate = 'mod_directory_results';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['asc_directory_results'][0]) . ' ###';
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
		if (!$objSearchModule || $objSearchModule->type != 'asc_directory_search') {
			return FALSE;
		}

		$this->Template->results = array();
		
		$strKeywords = \Input::post('s');

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
		
		if (!is_array($this->directorySearchFields)) {
			$arrFields = unserialize($this->directorySearchFields);
		}
		
		if (!is_array($arrFields) || empty($arrFields)) {
			return false;
		}
		
		$arrSearchSections = \Input::post('section');
		
		$arrSections = array();
		$objDirectorySection = DirectorySection::findAll($arrSections);
		while ($objDirectorySection->next()) {
			if (in_array($objDirectorySection->id, $arrSections) && $objDirectorySection->published) { 
				$arrSections[] = $objDirectorySection->row();
			}
		}
		
		if (!empty($arrSearchSections) && empty($arrSections)) {
			return false;
		}
		
		$arrColumns = array();
		if (!empty($arrSections)) {
			$strColumn = '(';
			foreach ($arrSections as $intSection) {
				$strColumn .= "FIND_IN_SET('" .$intSection ."', sections) OR ";
			}
			$strColumn = substr($strColumn, 0, -4);
			$strColumn .= ")";
			$arrColumns[] = $strColumn;
		}
		
		$strColumn = '(';
		foreach ($arrFields as $strField) {
			$strColumn .= $strField ." LIKE '%" .$strKeywords ."%' OR ";
		}
		$strColumn = substr($strColumn, 0, -4);
		$strColumn .= ")";
		$arrColumns[] = $strColumn;
		
		$arrColumns[] = "published='1'";
			
		$objDirectoryRecord = DirectoryRecord::find(array('column' => $arrColumns));
		
		if (!$objDirectoryRecord) {
			return false;
		}
		
		$arrResults = array();
		while($objDirectoryRecord->next()) {
			$arrResults[] = $objDirectoryRecord->row();
		}
		
		$this->Template->directory_search = $this->id;
		$this->Template->records = $arrResults;
    }

}