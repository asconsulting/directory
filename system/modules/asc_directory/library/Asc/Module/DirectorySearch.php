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
class DirectorySearch extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dir_search';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dir_search'][0]) . ' ###';
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
		
		$strSearch = \Input::post('s');
		
		$arrOptions = array('column'=>array('published=1'), 'order'=>$strSectionOrder);
		$objDirectorySection = DirectorySection::findAll($arrOptions);
		
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
		
		$objResultsPage = \PageModel::findPublishedById($this->jumpTo);
		$this->Template->action = $objResultsPage->getFrontendUrl();
		$this->Template->directory_search = $this->id;
		$this->Template->search = $strSearch;
		$this->Template->sections = $arrSections;	
    }

}