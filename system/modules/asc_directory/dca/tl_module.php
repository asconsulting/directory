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
 * Add a palette to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['asc_directory_section'] 	= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['asc_directory_list'] 		= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['asc_directory_search'] 	= '{title_legend},name,headline,type;{config_legend},directoryFields;{redirect_legend:hide},jumpTo;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['asc_directory_results'] 	= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['asc_directory_reader'] 	= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';

// Search Fields
$GLOBALS['TL_DCA']['tl_module']['fields']['directoryFields'] = array
(
	'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['directoryFields'],
	'exclude' 			=> true,
	'inputType' 		=> 'checkbox',
	'options' 			=> 
		array(
			'alias'			=> 'Alias', 
			'name'			=> 'Name', 
			'first_name'	=> 'First Name', 
			'last_name'		=> 'Last Name', 
			'title'			=> 'Title', 
			'company'		=> 'Company', 
			'phone'			=> 'Phone',
			'mobile'		=> 'Mobile', 
			'fax'			=> 'Fax',
			'email'			=> 'Email',
			'website'		=> 'Website',
			'image'			=> 'Image',
			'description'	=> 'Description'
		),
	'eval' 				=> array('multiple'=>true),
	'sql' 				=> "blob NULL"
);