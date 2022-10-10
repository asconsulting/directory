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
 * Table tl_asc_directory
 */
$GLOBALS['TL_DCA']['tl_asc_directory'] = array
(
 
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'enableVersioning'            => true,
        'sql' => array
        (
            'keys' => array
            (
                'id' => 'primary',
                'alias' => 'index'
            )
        )
    ),
 
    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 1,
            'fields'                  => array('name'),
            'flag'                    => 1,
            'panelLayout'             => 'filter;search,limit'
        ),
        'label' => array
        (
            'fields'                  => array('name', 'image'),
            'format'                  => '%s - %s',
			'label_callback'        => array('Asc\Backend\Record', 'generateLabel')
        ),
        'global_operations' => array
        (
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_asc_directory']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_asc_directory']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_asc_directory']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . ($GLOBALS['TL_LANG']['MSC']['deleteConfirm'] ?? null) . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_asc_directory']['toggle'],
				'icon'                => 'visible.gif',
				'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
				'button_callback'     => array('tl_asc_directory', 'toggleIcon')
			),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_asc_directory']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),
 
    // Palettes
    'palettes' => array
    (
        'default'                     => '{record_legend},name,alias,first_name,last_name,title,company;{address_legend},address_1,address_2,address_3,city,state,zip,country,latitude,longitude;{contact_legend},phone,mobile,fax,email,website;{details_legend},sections,image,description,notes;{publish_legend},published'
    ),
 
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
		'alias' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['alias'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'search'                  => true,
			'eval'                    => array('unique'=>true, 'rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
			'save_callback' => array
			(
				array('tl_asc_directory', 'generateAlias')
			),
			'sql'                     => "varchar(128) COLLATE utf8_bin NOT NULL default ''"

		),
		'name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['name'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'first_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['first_name'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'last_name' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['last_name'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['title'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
		'company' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['company'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		
		
		// Address Fields
		'address_1' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['address_1'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'address_2' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['address_2'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'address_3' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['address_3'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'city' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['city'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(128) NOT NULL default ''"
        ),
		'state' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['state'],
            'exclude'                 => true,
            'search'                  => true,
			'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>64, 'tl_class'=>'w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
		'zip' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['zip'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>128, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
		'country' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['country'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'inputType'               => 'select',
			'options'                 => System::getCountries(),
			'eval'                    => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(2) NOT NULL default ''"
		),
		'latitude' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['latitude'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>32, 'tl_class'=>'w50', 'rgxp'=>'digit', 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
		'longitude' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['longitude'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('maxlength'=>32, 'tl_class'=>'w50', 'rgxp'=>'digit', 'tl_class'=>'w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
		
		
		// Contact Fields
		'phone' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['phone'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'mobile' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['mobile'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'fax' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['fax'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>64, 'rgxp'=>'phone', 'decodeEntities'=>true, 'tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'email' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['email'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('maxlength'=>255, 'rgxp'=>'email', 'unique'=>true, 'decodeEntities'=>true, 'tl_class'=>'clr w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'website' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['website'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('rgxp'=>'url', 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		
		
		// Details Fields
		'sections' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['sections'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'eval'                    => array('multiple'=>true, 'csv'=>',', 'tl_class'=>'clr'),
			'foreignKey'              => 'tl_asc_directory_section.name',
			'relation'                => array('type'=>'hasMany', 'load'=>'lazy'),	
			'sql'                     => "mediumtext NULL"
		),
		'image' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['image'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('filesOnly'=>true, 'extensions'=>Config::get('validImageTypes'), 'fieldType'=>'radio', 'class'=>'clr w50'),
			'sql'                     => "blob NULL"
		),
		'description' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['description'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true, 'class'=>'clr long'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		'notes' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['notes'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('rte'=>'tinyMCE', 'helpwizard'=>true, 'class'=>'clr long'),
			'explanation'             => 'insertTags',
			'sql'                     => "mediumtext NULL"
		),
		
		
		// Publish Fields
		'published' => array
		(
			'exclude'                 => true,
			'label'                   => &$GLOBALS['TL_LANG']['tl_asc_directory']['published'],
			'inputType'               => 'checkbox',
			'filter'                  => true,
			'eval'                    => array('doNotCopy'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		)
    )
);

/**
 * Class tl_asc_directory
 */
class tl_asc_directory extends Backend
{
	/**
	 * Auto-generate an article alias if it has not been set yet
	 * @param mixed
	 * @param \DataContainer
	 * @return string
	 * @throws \Exception
	 */
	public function generateAlias($varValue, DataContainer $dc)
	{
		$autoAlias = false;

		// Generate an alias if there is none
		if ($varValue == '')
		{
			$autoAlias = true;
			$varValue = standardize(StringUtil::restoreBasicEntities($dc->activeRecord->name));
		}

		// Add a prefix to reserved names (see #6066)
		if (in_array($varValue, array('top', 'wrapper', 'header', 'container', 'main', 'left', 'right', 'footer')))
		{
			$varValue = 'staff-' . $varValue;
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_asc_directory WHERE id=? OR alias=?")
								   ->execute($dc->id, $varValue);

		// Check whether the page alias exists
		if ($objAlias->numRows > 1)
		{
			if (!$autoAlias)
			{
				throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
			}

			$varValue .= '-' . $dc->id;
		}

		return $varValue;
	}
	

	/**
	 * Return the "toggle visibility" button
	 * @param array
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */
	public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
	{
		if (strlen(Input::get('tid')))
		{
			$this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1), (@func_get_arg(12) ?: null));
			$this->redirect($this->getReferer());
		}

		$href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

		if (!$row['published'])
		{
			$icon = 'invisible.gif';
		}

		return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
	}	
	
	
	/**
	 * Disable/enable a user group
	 * @param integer
	 * @param boolean
	 * @param \DataContainer
	 */
	public function toggleVisibility($intId, $blnVisible, DataContainer $dc=null)
	{
		$objVersions = new Versions('tl_asc_directory', $intId);
		$objVersions->initialize();

		// Trigger the save_callback
		if (is_array($GLOBALS['TL_DCA']['tl_asc_directory']['fields']['published']['save_callback']))
		{
			foreach ($GLOBALS['TL_DCA']['tl_asc_directory']['fields']['published']['save_callback'] as $callback)
			{
				if (is_array($callback))
				{
					$this->import($callback[0]);
					$blnVisible = $this->$callback[0]->$callback[1]($blnVisible, ($dc ?: $this));
				}
				elseif (is_callable($callback))
				{
					$blnVisible = $callback($blnVisible, ($dc ?: $this));
				}
			}
		}

		// Update the database
		$this->Database->prepare("UPDATE tl_asc_directory SET tstamp=". time() .", published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
					   ->execute($intId);

		$objVersions->create();
		$this->log('A new version of record "tl_asc_directory.id='.$intId.'" has been created'.$this->getParentEntries('tl_asc_directory', $intId), __METHOD__, TL_GENERAL);
	}		
}
