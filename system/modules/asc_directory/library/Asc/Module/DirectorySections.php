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
class DirectorySections extends \Contao\Module
{
 
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_dir_sections';

 
    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
 
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['dir_sections'][0]) . ' ###';
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
			
		$arrSections = array();
		$objDirectorySection = DirectorySection::findAll(array('column' => array("published='1'"), 'order'=>$strSectionOrder));
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
		$this->Template->sections = $arrSections;	
    }

}