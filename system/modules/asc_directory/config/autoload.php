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
 * Register the classes
 */
ClassLoader::addClasses(array
(
    'Asc\Module\DirectorySections' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectorySections.php',
    'Asc\Module\DirectoryList' 			=> 'system/modules/asc_directory/library/Asc/Module/DirectoryList.php',
    'Asc\Module\DirectorySearch' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectorySearch.php',
	'Asc\Module\DirectoryResults' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectoryResults.php',
	'Asc\Module\DirectoryReader' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectoryReader.php',
	
    'Asc\Model\DirectoryRecord' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectoryRecord.php',
	'Asc\Model\DirectorySection' 		=> 'system/modules/asc_directory/library/Asc/Module/DirectorySection.php',
));

/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
    'mod_directory' 		=> 'system/modules/asc_directory/templates/modules',
	'mod_directory_list' 	=> 'system/modules/asc_directory/templates/modules',
	'mod_directory_search' 	=> 'system/modules/asc_directory/templates/modules',
	'mod_directory_results' => 'system/modules/asc_directory/templates/modules',
	'mod_directory_reader' 	=> 'system/modules/asc_directory/templates/modules',
));
