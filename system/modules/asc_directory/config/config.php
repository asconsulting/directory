<?php
 
/**
 * ASC - Directory
 *
 * Copyright (C) 2018 Andrew Stevens Consulting
 *
 * @package    AscDirectory
 * @link       https://andrewstevens.consulting
 */

 
/**
 * Front end modules
 */ 
$GLOBALS['FE_MOD']['asc_directory']['asc_directory_sections'] 	= 'Asc\Module\DirectorySections';
$GLOBALS['FE_MOD']['asc_directory']['asc_directory_list'] 		= 'Asc\Module\DirectoryList';
$GLOBALS['FE_MOD']['asc_directory']['asc_directory_search'] 	= 'Asc\Module\DirectorySearch'; 
$GLOBALS['FE_MOD']['asc_directory']['asc_directory_results'] 	= 'Asc\Module\DirectoryResults'; 
$GLOBALS['FE_MOD']['asc_directory']['asc_directory_reader'] 	= 'Asc\Module\DirectoryReader'; 
 
 
/**
 * Back end modules
 */
if (!is_array($GLOBALS['BE_MOD']['asc_directory']))
{
    array_insert($GLOBALS['BE_MOD'], 1, array('asc_directory' => array()));
}

array_insert($GLOBALS['BE_MOD']['asc_directory'], 0, array
( 
	'asc_directory' => array
	(
		'tables' => array('tl_asc_directory'),
		'icon'   => '/system/modules/asc_directory/assets/directory.png'
	),
	'asc_sections' => array
	(
		'tables' => array('tl_asc_directory_section'),
		'icon'   => '/system/modules/asc_directory/assets/directory.png'
	)
));

/**
 * Models
 */
$GLOBALS['TL_MODELS']['tl_asc_directory'] = 'Asc\Model\DirectoryRecord';
$GLOBALS['TL_MODELS']['tl_asc_directory_section'] = 'Asc\Model\DirectorySection';

/**
 * Hooks
 */
$GLOBALS['TL_HOOKS']['getPageIdFromUrl'][] = array('Asc\DirectoryPage', 'loadListPageFromUrl');


/**
 * Styles
 */
 if (version_compare(VERSION, '4.4', '>=')) {
	$GLOBALS['TL_CSS'][] = 'system/modules/asc_directory/assets/css/backend-contao4.css|static';
}