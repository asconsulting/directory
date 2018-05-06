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

class DirectorySection extends \Model
{
	
	static $arrClassNames = array('tl_asc_directory_section' => "\Asc\Model\DirectorySection");
	
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
