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

class DirectoryRecord extends \Model
{

	static $arrClassNames = array('tl_asc_directory_record' => "\Asc\Model\DirectoryRecord");
	
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_asc_directory';

	public static function findByArray($arrOptions=array())
	{
//		$t = static::$strTable;
	
		return parent::find($arrOptions);
	}
	
}
