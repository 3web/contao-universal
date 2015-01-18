<?php

/**
 * Table tl_universal_archive
 */
$GLOBALS['TL_DCA']['tl_universal_archive'] = array
    (
    // Config
    'config' => array
        (
        'dataContainer' => 'Table',
        'ctable' => array('tl_universal_data'),
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
            'mode' => 0,
            'fields' => array('title'),
            'flag' => 1,
            'panelLayout' => 'filter,limit',
        ),
        'label' => array
            (
            'fields' => array('title'),
            'format' => '<strong>%s</strong>'
        ),
        'global_operations' => array
            (
            'all' => array
                (
                'label' => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href' => 'act=select',
                'class' => 'header_edit_all',
                'attributes' => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
            (
            'edit' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['edit'],
                'href' => 'table=tl_universal_data',
                'icon' => 'edit.gif'
            ),
            'editheader' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['editheader'],
                'href' => 'act=edit',
                'icon' => 'header.gif'
            ),
            'copy' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['copy'],
                'href' => 'act=copy',
                'icon' => 'copy.gif'
            ),
            'delete' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'show' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
        (
        'default' => '{title_legend},published,listascategory,title;description'
    ),
    // Fields
    'fields' => array
        (
        'id' => array
            (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['sorting'],
            'inputType' => 'text',
            'eval' => array('tl_class' => 'w50'),
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'published' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['published'],
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'long'),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'listascategory' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['listascategory'],
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'long'),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'title' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['title'],
            'exclude' => true,
            'filter' => true,
            'search' => true,
            'inputType' => 'text',
            'eval' => array('mandatory' => true, 'maxlength' => 128, 'tl_class' => 'w50'),
            'sql' => "varchar(128) NOT NULL default ''"
        ),
        'description' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_archive']['description'],
            'exclude' => true,
            'search' => true,
            'inputType' => 'textarea',
            'eval' => array('style' => 'height: 48px', 'tl_class' => 'long', 'rte' => 'tinyMCE'),
            'sql' => "text NULL"
        )
    )
);
