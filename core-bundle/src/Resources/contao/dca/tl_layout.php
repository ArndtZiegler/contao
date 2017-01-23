<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Table tl_layout
 */
$GLOBALS['TL_DCA']['tl_layout'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'ptable'                      => 'tl_theme',
		'enableVersioning'            => true,
		'onload_callback' => array
		(
			array('tl_layout', 'checkPermission')
		),
		'sql' => array
		(
			'keys' => array
			(
				'id' => 'primary'
			)
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 4,
			'fields'                  => array('name'),
			'panelLayout'             => 'filter;sort,search,limit',
			'headerFields'            => array('name', 'author', 'tstamp'),
			'child_record_callback'   => array('tl_layout', 'listLayout'),
			'child_record_class'      => 'no_padding'
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
				'label'               => &$GLOBALS['TL_LANG']['tl_layout']['edit'],
				'href'                => 'act=edit',
				'icon'                => 'edit.svg'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_layout']['copy'],
				'href'                => 'act=paste&amp;mode=copy',
				'icon'                => 'copy.svg'
			),
			'cut' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_layout']['cut'],
				'href'                => 'act=paste&amp;mode=cut',
				'icon'                => 'cut.svg',
				'attributes'          => 'onclick="Backend.getScrollOffset()"'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_layout']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.svg',
				'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_layout']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.svg'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('rows', 'cols', 'addJQuery', 'addMooTools', 'static'),
		'default'                     => '{title_legend},name;{header_legend},rows;{column_legend},cols;{sections_legend:hide},sections;{webfonts_legend:hide},webfonts;{style_legend},framework,stylesheet,external,loadingOrder,combineScripts;{picturefill_legend:hide},picturefill;{modules_legend},modules;{jquery_legend:hide},addJQuery;{mootools_legend:hide},addMooTools;{script_legend},scripts,analytics,script;{static_legend:hide},static;{expert_legend:hide},template,doctype,viewport,titleTag,cssClass,onload,head'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'rows_2rwh'                   => 'headerHeight',
		'rows_2rwf'                   => 'footerHeight',
		'rows_3rw'                    => 'headerHeight,footerHeight',
		'cols_2cll'                   => 'widthLeft',
		'cols_2clr'                   => 'widthRight',
		'cols_3cl'                    => 'widthLeft,widthRight',
		'addJQuery'                   => 'jquery,jSource',
		'addMooTools'                 => 'mootools,mooSource',
		'static'                      => 'width,align'
	),

	// Fields
	'fields' => array
	(
		'id' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL auto_increment"
		),
		'pid' => array
		(
			'foreignKey'              => 'tl_theme.name',
			'sql'                     => "int(10) unsigned NOT NULL default '0'",
			'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
		),
		'tstamp' => array
		(
			'sql'                     => "int(10) unsigned NOT NULL default '0'"
		),
		'name' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['name'],
			'inputType'               => 'text',
			'exclude'                 => true,
			'sorting'                 => true,
			'flag'                    => 1,
			'search'                  => true,
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'rows' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['rows'],
			'default'                 => '2rwh',
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('1rw', '2rwh', '2rwf', '3rw'),
			'eval'                    => array('helpwizard'=>true, 'cols'=>4, 'submitOnChange'=>true),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'sql'                     => "varchar(8) NOT NULL default ''"
		),
		'headerHeight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['headerHeight'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'footerHeight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['footerHeight'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'cols' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['cols'],
			'default'                 => '2cll',
			'exclude'                 => true,
			'inputType'               => 'radioTable',
			'options'                 => array('1cl', '2cll', '2clr', '3cl'),
			'eval'                    => array('helpwizard'=>true, 'cols'=>4, 'submitOnChange'=>true),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'sql'                     => "varchar(8) NOT NULL default ''"
		),
		'widthLeft' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['widthLeft'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'widthRight' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['widthRight'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'sections' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['sections'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'sectionWizard',
			'sql'                     => "varchar(1022) NOT NULL default ''"
		),
		'framework' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['framework'],
			'default'                 => array('layout.css', 'responsive.css'),
			'exclude'                 => true,
			'inputType'               => 'checkboxWizard',
			'options'                 => array('layout.css', 'responsive.css', 'grid.css', 'reset.css', 'form.css', 'icons.css'),
			'eval'                    => array('multiple'=>true, 'helpwizard'=>true),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'save_callback' => array
			(
				array('tl_layout', 'checkFramework')
			),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'stylesheet' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['stylesheet'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkboxWizard',
			'foreignKey'              => 'tl_style_sheet.name',
			'options_callback'        => array('tl_layout', 'getStyleSheets'),
			'eval'                    => array('multiple'=>true),
			'xlabel' => array
			(
				array('tl_layout', 'styleSheetLink')
			),
			'sql'                     => "blob NULL",
			'relation'                => array('type'=>'hasMany', 'load'=>'lazy')
		),
		'external' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['external'],
			'exclude'                 => true,
			'inputType'               => 'fileTree',
			'eval'                    => array('multiple'=>true, 'orderField'=>'orderExt', 'fieldType'=>'checkbox', 'filesOnly'=>true, 'extensions'=>'css,scss,less'),
			'sql'                     => "blob NULL"
		),
		'orderExt' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['orderExt'],
			'sql'                     => "blob NULL"
		),
		'loadingOrder' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['loadingOrder'],
			'default'                 => 'external_first',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('external_first', 'internal_first'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(16) NOT NULL default ''"
		),
		'combineScripts' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['combineScripts'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('tl_class'=>'w50 m12'),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'modules' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['modules'],
			'default'                 => array(array('mod'=>0, 'col'=>'main', 'enable'=>1)),
			'exclude'                 => true,
			'inputType'               => 'moduleWizard',
			'sql'                     => "blob NULL"
		),
		'template' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['template'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'select',
			'options_callback'        => array('tl_layout', 'getPageTemplates'),
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(64) NOT NULL default ''"
		),
		'doctype' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['doctype'],
			'exclude'                 => true,
			'filter'                  => true,
			'sorting'                 => true,
			'flag'                    => 11,
			'inputType'               => 'select',
			'options'                 => array('html5'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		),
		'webfonts' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['webfonts'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'viewport' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['viewport'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'titleTag' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['titleTag'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'cssClass' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['cssClass'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'onload' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['onload'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'head' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['head'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:60px', 'preserveTags'=>true, 'rte'=>'ace|html', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'addJQuery' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['addJQuery'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'jSource' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['jSource'],
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('j_local', 'j_googleapis', 'j_fallback'),
			'eval'                    => array('tl_class'=>'w50'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'sql'                     => "varchar(16) NOT NULL default ''"
		),
		'jquery' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['jquery'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_layout', 'getJqueryTemplates'),
			'eval'                    => array('multiple'=>true),
			'sql'                     => "text NULL"
		),
		'addMooTools' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['addMooTools'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'mooSource' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['mooSource'],
			'default'                 => 'moo_local',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('moo_local', 'moo_googleapis', 'moo_fallback'),
			'eval'                    => array('tl_class'=>'w50'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'sql'                     => "varchar(16) NOT NULL default ''"
		),
		'mootools' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['mootools'],
			'exclude'                 => true,
			'filter'                  => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_layout', 'getMooToolsTemplates'),
			'eval'                    => array('multiple'=>true),
			'sql'                     => "text NULL"
		),
		'picturefill' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['picturefill'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'analytics' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['analytics'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_layout', 'getAnalyticsTemplates'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_layout'],
			'eval'                    => array('multiple'=>true),
			'sql'                     => "text NULL"
		),
		'scripts' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['scripts'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'checkboxWizard',
			'options_callback'        => array('tl_layout', 'getScriptTemplates'),
			'eval'                    => array('multiple'=>true),
			'sql'                     => "text NULL"
		),
		'script' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['script'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'textarea',
			'eval'                    => array('style'=>'height:120px', 'preserveTags'=>true, 'rte'=>'ace|html', 'tl_class'=>'clr'),
			'sql'                     => "text NULL"
		),
		'static' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['static'],
			'exclude'                 => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true),
			'sql'                     => "char(1) NOT NULL default ''"
		),
		'width' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['width'],
			'exclude'                 => true,
			'inputType'               => 'inputUnit',
			'options'                 => $GLOBALS['TL_CSS_UNITS'],
			'eval'                    => array('includeBlankOption'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
			'sql'                     => "varchar(255) NOT NULL default ''"
		),
		'align' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_layout']['align'],
			'default'                 => 'center',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('left', 'center', 'right'),
			'reference'               => &$GLOBALS['TL_LANG']['MSC'],
			'eval'                    => array('tl_class'=>'w50'),
			'sql'                     => "varchar(32) NOT NULL default ''"
		)
	)
);


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class tl_layout extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Check permissions to edit the table
	 *
	 * @throws Contao\CoreBundle\Exception\AccessDeniedException
	 */
	public function checkPermission()
	{
		if ($this->User->isAdmin)
		{
			return;
		}

		if (!$this->User->hasAccess('layout', 'themes'))
		{
			throw new Contao\CoreBundle\Exception\AccessDeniedException('Not enough permissions to access the page layout module.');
		}
	}


	/**
	 * Return all style sheets of the current theme
	 *
	 * @param DataContainer $dc
	 *
	 * @return array
	 */
	public function getStyleSheets(DataContainer $dc)
	{
		$intPid = $dc->activeRecord->pid;

		if (Input::get('act') == 'overrideAll')
		{
			$intPid = Input::get('id');
		}

		$objStyleSheet = $this->Database->prepare("SELECT id, name FROM tl_style_sheet WHERE pid=?")
										->execute($intPid);

		if ($objStyleSheet->numRows < 1)
		{
			return array();
		}

		$return = array();

		while ($objStyleSheet->next())
		{
			$return[$objStyleSheet->id] = $objStyleSheet->name;
		}

		return $return;
	}


	/**
	 * Return all page templates as array
	 *
	 * @return array
	 */
	public function getPageTemplates()
	{
		return $this->getTemplateGroup('fe_');
	}


	/**
	 * Return all MooTools templates as array
	 *
	 * @return array
	 */
	public function getMooToolsTemplates()
	{
		return $this->getTemplateGroup('moo_');
	}


	/**
	 * Return all jQuery templates as array
	 *
	 * @return array
	 */
	public function getJqueryTemplates()
	{
		return $this->getTemplateGroup('j_');
	}


	/**
	 * Return all script templates as array
	 *
	 * @return array
	 */
	public function getScriptTemplates()
	{
		return $this->getTemplateGroup('js_');
	}


	/**
	 * Return all analytics templates as array
	 *
	 * @return array
	 */
	public function getAnalyticsTemplates()
	{
		return $this->getTemplateGroup('analytics_');
	}


	/**
	 * List a page layout
	 *
	 * @param array $row
	 *
	 * @return string
	 */
	public function listLayout($row)
	{
		return '<div style="float:left">'. $row['name'] ."</div>\n";
	}


	/**
	 * Add a link to edit the stylesheets of the theme
	 *
	 * @param DataContainer $dc
	 *
	 * @return string
	 */
	public function styleSheetLink(DataContainer $dc)
	{
		return ' <a href="contao/main.php?do=themes&amp;table=tl_style_sheet&amp;id=' . $dc->activeRecord->pid . '&amp;popup=1&amp;nb=1&amp;rt=' . REQUEST_TOKEN . '" title="' . StringUtil::specialchars($GLOBALS['TL_LANG']['tl_layout']['edit_styles']) . '" onclick="Backend.openModalIframe({\'width\':768,\'title\':\''.StringUtil::specialchars(str_replace("'", "\\'", $GLOBALS['TL_LANG']['tl_layout']['edit_styles'])).'\',\'url\':this.href});return false">' . Image::getHtml('edit.svg', '', 'style="vertical-align:text-bottom"') . '</a>';
	}


	/**
	 * Auto-select layout.css if responsive.css is selected (see #8222)
	 *
	 * @param mixed $value
	 *
	 * @return string
	 */
	public function checkFramework($value)
	{
		if (empty($value))
		{
			return '';
		}

		$array = StringUtil::deserialize($value);

		if (empty($array) || !is_array($array))
		{
			return $value;
		}

		if (($i = array_search('responsive.css', $array)) !== false && array_search('layout.css', $array) === false)
		{
			array_insert($array, $i, 'layout.css');
		}

		return $array;
	}
}
