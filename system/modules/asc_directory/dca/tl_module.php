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
$GLOBALS['TL_DCA']['tl_module']['palettes']['dir_sections'] 	= '{title_legend},name,headline,type;{directory_order_legend},sectionSortField,sectionSortOrder;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dir_list'] 		= '{title_legend},name,headline,type;{config_legend},directoryShowAll;{directory_order_legend},sectionSortField,sectionSortOrder,recordSortField,recordSortOrder;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dir_search'] 	= '{title_legend},name,headline,type;{config_legend},directoryFields;{redirect_legend:hide},jumpTo;{directory_order_legend},sectionSortField,sectionSortOrder,recordSortField,recordSortOrder;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dir_results'] 	= '{title_legend},name,headline,type;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';
$GLOBALS['TL_DCA']['tl_module']['palettes']['dir_reader'] 	= '{title_legend},name,headline,type;{directory_order_legend},sectionSortField,sectionSortOrder;{template_legend:hide},customTpl;{expert_legend:hide},guests,cssID,space';

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

// Sort Fields
$GLOBALS['TL_DCA']['tl_module']['fields']['recordSortField'] = array
(
	'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['recordSortField'],
	'exclude' 			=> true,
	'inputType' 		=> 'select',
	'default'			=> 'name',
	'options' 			=> 
		array(
			'alias'			=> 'Alias', 
			'name'			=> 'Name', 
			'first_name'	=> 'First Name', 
			'last_name'		=> 'Last Name', 
			'title'			=> 'Title', 
			'company'		=> 'Company'
		),
	'eval' 				=> array('tl_class'=>'clr w50'),
	'sql' 				=> "varchar(32) NOT NULL default 'name'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['recordSortOrder'] = array
(
	'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['sectionSortField'],
	'exclude' 			=> true,
	'inputType' 		=> 'select',
	'default'			=> 'DESC',
	'options' 			=> 
		array(
			'ASC'			=> 'Ascending (A-Z, 0-9)',
			'DESC'			=> 'Descending (Z-A, 9-0)',
		),
	'eval' 				=> array('tl_class'=>'w50'),
	'sql' 				=> "varchar(4) NOT NULL default 'ASC'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sectionSortField'] = array
(
	'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['sectionSortField'],
	'exclude' 			=> true,
	'inputType' 		=> 'select',
	'default'			=> 'name',
	'options' 			=> 
		array(
			'alias'			=> 'Alias', 
			'name'			=> 'Name'
		),
	'eval' 				=> array('tl_class'=>'clr w50'),
	'sql' 				=> "varchar(32) NOT NULL default 'name'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['sectionSortOrder'] = array
(
	'label' 			=> &$GLOBALS['TL_LANG']['tl_module']['sectionSortField'],
	'exclude' 			=> true,
	'inputType' 		=> 'select',
	'default'			=> 'ASC',
	'options' 			=> 
		array(
			'ASC'			=> 'Ascending (A-Z, 0-9)',
			'DESC'			=> 'Descending (Z-A, 9-0)',
		),
	'eval' 				=> array('tl_class'=>'w50'),
	'sql' 				=> "varchar(4) NOT NULL default 'ASC'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['directoryShowAll'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['directoryShowAll'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'m12 w50', 'fallback'=>true),
    'sql'                     => "char(1) NOT NULL default ''",
);
