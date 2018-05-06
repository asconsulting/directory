<?php
 
/**
 * ASC - Directory
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    AscDirectory
 * @link       https://andrewstevens.consulting
 */

 
namespace Asc\Model;

use Asc\Model\DirectorySection as Contao\AscDirectorySectionModel;

class DirectorySection extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_asc_directory_section';

	
	public static function findByArray($arrOptions=array())
	{
//		$t = static::$strTable;
	
		
	
		return parent::find($arrOptions);
	}
}
