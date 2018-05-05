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

use Asc\Model\DirectoryRecord as \AscDirectoryModel;

class DirectoryRecord extends \Model
{

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
