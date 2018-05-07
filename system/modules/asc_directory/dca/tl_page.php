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
 * Extend tl_page palettes
 */
$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(';{publish_legend}', ';{asc_directory_legend},asc_directorySectionPage,asc_directoryReaderPage;{publish_legend}', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);

/**
 * Add fields to tl_page
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['asc_directorySectionPage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['asc_directorySectionPage'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'clr m12 w50', 'fallback'=>true),
    'sql'                     => "char(1) NOT NULL default ''",
);

$GLOBALS['TL_DCA']['tl_page']['fields']['asc_directoryReaderPage'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_page']['asc_directoryReaderPage'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'m12 w50', 'fallback'=>true),
    'sql'                     => "char(1) NOT NULL default ''",
);
