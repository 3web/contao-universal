<?php

/**
 * Table tl_universal_data
 */
$GLOBALS['TL_DCA']['tl_universal_data'] = array
    (
    // Config
    'config' => array
        (
        'dataContainer' => 'Table',
        'ptable' => 'tl_universal_archive',
        'enableVersioning' => true,
        'sql' => array
            (
            'keys' => array
                (
                'id' => 'primary',
                'pid' => 'index'
            )
        )
    ),
    // List
    'list' => array
        (
        'sorting' => array
            (
            'mode' => 4,
            'fields' => array('sorting'),
            'headerFields' => array('title'),
            'panelLayout' => 'filter;search,limit',
            'child_record_callback' => array('tl_universal_data', 'getRowLabel')
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
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['edit'],
                'href' => 'act=edit',
                'icon' => 'edit.gif'
            ),
            'copy' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['copy'],
                'href' => 'act=paste&amp;mode=copy',
                'icon' => 'copy.gif'
            ),
            'cut' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['cut'],
                'href' => 'act=paste&amp;mode=cut',
                'icon' => 'cut.gif'
            ),
            'delete' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['delete'],
                'href' => 'act=delete',
                'icon' => 'delete.gif',
                'attributes' => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['toggle'],
                'icon' => 'visible.gif',
                'attributes' => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback' => array('tl_universal_data', 'toggleIcon')
            ),
            'show' => array
                (
                'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['show'],
                'href' => 'act=show',
                'icon' => 'show.gif'
            )
        )
    ),
    // Palettes
    'palettes' => array
        (
        'default' => '{text_legend},published,title_01,title_02,title_03,description_01,description_02,description_03;{image_legend},image_01,image_02;'
    ),
    // Fields
    'fields' => array
        (
        'id' => array
            (
            'sql' => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'sorting' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['sorting'],
            'inputType' => 'text',
            'eval' => array('tl_class' => 'w50'),
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
            (
            'sql' => "int(10) unsigned NOT NULL default '0'"
        ),
        'published' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['published'],
            'inputType' => 'checkbox',
            'eval' => array('tl_class' => 'w100'),
            'sql' => "char(1) NOT NULL default ''"
        ),
        'alias' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['alias'],
            'inputType' => 'text',
            'eval' => array
                (
                'rgxp' => 'alnum',
                'doNotCopy' => true,
                'spaceToUnderscore' => true,
                'maxlength' => 128,
                'tl_class' => 'w50'
            ),
            'save_callback' => array
                (
                array('tl_universal_data', 'generateAlias')
            ),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'title_01' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['title_01'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'long'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'title_02' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['title_02'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'long'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'title_03' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['title_03'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'text',
            'eval' => array('maxlength' => 255, 'tl_class' => 'long'),
            'sql' => "varchar(255) NOT NULL default ''"
        ),
        'description_01' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['description_01'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'textarea',
            'eval' => array('style' => 'height:48px', 'tl_class' => 'clr'),
            'sql' => "text NULL"
        ),
        'description_02' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['description_02'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'textarea',
            'eval' => array('style' => 'height:48px', 'tl_class' => 'clr'),
            'sql' => "text NULL"
        ),
        'description_03' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['description_03'],
            'exclude' => true,
            'search' => true,
            'filter' => true,
            'inputType' => 'textarea',
            'eval' => array('style' => 'height:48px', 'tl_class' => 'clr'),
            'sql' => "text NULL"
        ),
        'image_01' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['image_01'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array('tl_class' => 'clr', 'path' => 'files/', 'filesOnly' => true, files => true, 'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes'], 'orderField' => 'orderSRC_01', 'multiple' => true, 'fieldType' => 'checkbox'),
            'sql' => "blob NULL"
        ),
        'orderSRC_01' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['orderSRC_01'],
            'sql' => "blob NULL"
        ),
        'image_02' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['image_02'],
            'exclude' => true,
            'inputType' => 'fileTree',
            'eval' => array('tl_class' => 'clr', 'path' => 'files/', 'filesOnly' => true, files => true, 'extensions' => $GLOBALS['TL_CONFIG']['validImageTypes'], 'orderField' => 'orderSRC_02', 'multiple' => true, 'fieldType' => 'checkbox'),
            'sql' => "blob NULL"
        ),
        'orderSRC_02' => array
            (
            'label' => &$GLOBALS['TL_LANG']['tl_universal_data']['orderSRC_02'],
            'sql' => "blob NULL"
        ),
    )
);

/**
 * Provide miscellaneous methods that are used by the data configuration array
 */
class tl_universal_data extends Backend
{

    /**
     * Generate a song row and return it as HTML string
     * @param array
     * @return string
     */
    public function getRowLabel($row)
    {
        if (false):
            echo '<pre>';
            print_r($row);
            echo '</pre>';
        endif;



        if (($row['orderSRC_01']))
        {

            $arrBilder = deserialize($row['orderSRC_01']);
            $objFile = \FilesModel::findById($arrBilder[0]);

            if ($objFile === null)
            {
                if (!\Validator::isUuid($arrBilder[0]))
                {
                    return '<p class="error">' . $GLOBALS['TL_LANG']['ERR']['version2format'] . '</p>';
                }

                return '';
            }

            $preview = $objFile->path;

            $image = '<img src="' . $this->getImage($preview, 65, 45, 'center_center') . '" alt="' . htmlspecialchars($label) . '" style="display: inline-block;vertical-align: top;*display:inline;zoom:1;padding-right:8px;" />';
            $text .= '<span class="name">' . $row['title_01'] . '</span>';
        } else
        {
            $text .= '<span class="name">' . $row['title_01'] . '</span>';
        }


        return $image . $text;


        // $out = $this->replaceInsertTags('{{image::/' . $row['vorschaubild'] . '?width=55&height=65}}');
    }

    public function generateAlias($varValue, DataContainer $dc)
    {



        $autoAlias = false;
        // Generate alias if there is none
        if (!strlen($varValue))
        {
            $autoAlias = true;
            $varValue = standardize($dc->activeRecord->modell);
        }
        $objAlias = $this->Database->prepare("SELECT id FROM tl_universal_data WHERE id=? OR alias=?")
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

    public function toggleIcon($row, $href, $label, $title, $icon, $attributes)
    {
        if (strlen(Input::get('tid')))
        {
            $this->toggleVisibility(Input::get('tid'), (Input::get('state') == 1));
            $this->redirect($this->getReferer());
        }



        $href .= '&amp;tid=' . $row['id'] . '&amp;state=' . ($row['published'] ? '' : 1);

        if (!$row['published'])
        {
            $icon = 'invisible.gif';
        }


        return '<a href="' . $this->addToUrl($href) . '" title="' . specialchars($title) . '"' . $attributes . '>' . Image::getHtml($icon, $label) . '</a> ';
    }

    /**
     * Disable/enable a user group
     * @param integer
     * @param boolean
     */
    public function toggleVisibility($intId, $blnVisible)
    {
        // Check permissions to edit
        Input::setGet('id', $intId);
        Input::setGet('act', 'toggle');



        // Trigger the save_callback
        if (is_array($GLOBALS['TL_DCA']['tl_page']['fields']['published']['save_callback']))
        {
            foreach ($GLOBALS['TL_DCA']['tl_page']['fields']['published']['save_callback'] as $callback)
            {
                $this->import($callback[0]);
                $blnVisible = $this->$callback[0]->$callback[1]($blnVisible, $this);
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_universal_data SET published='" . ($blnVisible ? 1 : '') . "' WHERE id=?")
                ->execute($intId);
    }

}