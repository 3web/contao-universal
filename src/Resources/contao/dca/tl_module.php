<?php

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['universal_list'] = '{title_legend},name,type;{universal_legend},universal_list_archive,universal_template,universal_per_page,universal_filter_page;';



/**
 * Add fields to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['universal_list_archive'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['universal_list_archive'],
    'exclude' => true,
    'inputType' => 'checkboxWizard',
    'foreignKey' => 'tl_universal_archive.title',
    'eval' => array('multiple' => true, 'mandatory' => false,'tl_class' => 'm12'),
    'sql' => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['universal_per_page'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['universal_per_page'],
    'exclude' => true, // Zugang fuer Benutzer
    'inputType' => 'text',
    'eval' => array('mandatory' => false, 'maxlength' => 12, 'tl_class' => 'w50'),
    'sql' => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['universal_filter_page'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['universal_filter_page'],
    'inputType' => 'checkbox',
    'eval' => array('tl_class' => 'w50 m12'),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['universal_template'] = array
    (
    'label' => &$GLOBALS['TL_LANG']['tl_module']['universal_template'],
    'default' => 'slogan_standard',
    'exclude' => true,
    'inputType' => 'select',
    'options_callback' => array('tl_module_universal', 'getTemplates'),
    'eval' => array('tl_class' => 'm12'),
    'sql' => "varchar(255) NOT NULL default ''"
);

class tl_module_universal extends Backend
{

    /**
     * Return all event templates as array
     * @param object
     * @return array
     */
    public function getTemplates(DataContainer $dc)
    {
        return $this->getTemplateGroup('universal_');
    }

}

?>