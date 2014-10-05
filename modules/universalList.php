<?php

class format_produkteList extends \Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'format_produkte_list_default';

    /**
     * Compile the current element
     */
    protected function compile()
    {


        $objParams = Database::getInstance()
                ->prepare("SELECT * FROM tl_module WHERE id=?")
                ->limit(1)
                ->execute($this->id);

        if ($objParams->format_produkte_list_archive === '')
        {
            return false;
        }
        if ($objParams->format_produkte_per_page !== '')
        {
            $numberPerPage = $objParams->format_produkte_per_page;
        } else
        {
            $numberPerPage = 0;
        }

        if (\Input::get('pageStart') > 0)
        {
            $pageStart = \Input::get('page') * $numberPerPage;
        } else
        {
            $pageStart = 0;
        }

        $arrCat = deserialize($objParams->format_produkte_list_archive);
        $strAnd = implode(',', $arrCat);

        if ($objParams->format_produkte_filter_page)
        {
            global $objPage;

           // $strJump = 'AND a.jumpTo_01 = ' . $objPage->id;
            $strJump = 'AND a.jumpTo_01 LIKE "%%:' . $objPage->id . ';%%"';
        }

        //Wenn nötig, dann neues Template aktivieren
        if (($objParams->format_produkte_template != $this->strTemplate) && ($objParams->format_produkte_template != ''))
        {
            $this->strTemplate = $objParams->format_produkte_template;
            $this->Template = new FrontendTemplate($this->strTemplate);
        }



        $arrUniversalData = array();

        $query = ' SELECT SQL_CALC_FOUND_ROWS a.*, b.title as arc_title,b.description as arc_description, b.id as arc_id FROM tl_format_produkte_data a, tl_format_produkte_archive b WHERE a.pid=b.id  AND b.id IN (' . $strAnd . ') ' . $strJump . ' AND a.published = "1" ORDER BY FIELD(b.id,' . $strAnd . '), a.sorting';

        $objData = Database::getInstance()->prepare($query)->limit($numberPerPage, $pageStart)->execute();
        $objNum = Database::getInstance()->execute('SELECT FOUND_ROWS() as num');
        $query_cc = ' SELECT a.pid, COUNT(a.id) as cc FROM tl_format_produkte_data a WHERE 1 AND a.pid IN (' . $strAnd . ') ' . $strJump . ' AND a.published = "1" GROUP BY a.pid';
        $objCount = Database::getInstance()->prepare($query_cc)->execute();
        while ($objCount->next())
        {
            $arrCount[$objCount->pid] = $objCount->cc;
        }

        
        /* category */
        $query_cat = ' SELECT id,title_01 FROM tl_format_produkte_data WHERE 1  AND published = "1" ';
        $objCat = Database::getInstance()->prepare($query_cat)->execute();
        while ($objCat->next())
        {
            $arrCat[$objCat->id] = $objCat->title_01;
        }


        $j = 0;
        while ($objData->next())
        {

            $j++;
            $countcat = $arrCount[$objData->pid];
            $class = ((($j % 2) == 0) ? ' even' : ' odd') . (($j == 1) ? ' first' : '');
            if ($j == $countcat)
            {
                $class .= ' last';
                $j = 0;
            }

            $arrNew = array
                (
                'id' => trim($objData->id),
                'title_01' => trim($objData->title_01),
                'title_02' => trim($objData->title_02),
                'url_01' => trim($objData->url_01),
                'url_02' => trim($objData->url_02),
                'description_01' => trim($objData->description_01),
                'description_02' => trim($objData->description_02),
                'jumpTo_01' => trim($objData->jumpTo_01),
                'arc_title' => trim($objData->arc_title),
                'arc_description' => trim($objData->arc_description),
                'arc_count' => $countcat,
                'class' => $class,
            );

            /* 01 */
            if ($objData->orderSRC_01)
            {
                $arrImages = array();
                $arrImagesPath = array();
                $arrTemp = deserialize($objData->orderSRC_01);
                if (is_array($arrTemp))
                {
                    $arrImages = $arrTemp;
                } else
                {
                    $arrImages[] = $arrTemp;
                }
                foreach ($arrImages as $image)
                {
                    $objFile = \FilesModel::findById($image);
                    if ($objFile->path && file_exists(TL_ROOT . "/" . $objFile->path))
                    {
                        $arrImagesPath[] = $this->getImage($objFile->path, 1200, 500, 'center_center');
                    }
                }
                $arrNew['image_01'] = $arrImagesPath;
            }
            /* 02 */
            if ($objData->orderSRC_02)
            {
                $arrImages = array();
                $arrImagesPath = array();
                $arrTemp = deserialize($objData->orderSRC_02);
                if (is_array($arrTemp))
                {
                    $arrImages = $arrTemp;
                } else
                {
                    $arrImages[] = $arrTemp;
                }
                foreach ($arrImages as $image)
                {
                    $objFile = \FilesModel::findById($image);
                    if ($objFile->path && file_exists(TL_ROOT . "/" . $objFile->path))
                    {
                        $arrImagesPath[] = $objFile->path;
                    }
                }
                $arrNew['image_02'] = $arrImagesPath;
            }
            if ($objData->category_01 > 0)
            {
                $arrNew['category_01'] = $arrCat[$objData->category_01];
            }
            if ($objData->category_02 > 0)
            {
                $arrNew['category_02'] = $arrCat[$objData->category_02];
            }


            $arrUniversalData[$objData->arc_id][] = $arrNew;
        }
        $this->Template->arrUniversalData = $arrUniversalData;

        if ($numberPerPage > 0) // on/off
        {

            /* pagination */
            $strPager = '';
            if ($objNum->num > $numberPerPage)
            {
                $fcc = $objNum->num / $numberPerPage;
                $cc = floor($fcc);
                if ($fcc > $cc)
                {
                    $cc++;
                }
                $strPager .= '<ul class="pagination">';

                for ($i = 0; $i < $cc; $i++)
                {
                    $page = $i + 1;
                    if (\Input::get('pageStart') == $i)
                    {
                        $strPager .= '<li>';
                        $strPager .= '<a class="link current" href="' . $this->addToUrl('pageStart=' . $i) . '">' . $page . '</a>';
                        $strPager .= '</li>';
                    } else
                    {
                        $strPager .= '<li>';
                        $strPager .= '<a  class="link" href="' . $this->addToUrl('pageStart=' . $i) . '">' . $page . '</a>';
                        $strPager .= '</li>';
                    }
                }
                $strPager .= '</ul>';
            }

            $this->Template->pagination = $strPager;
        } // on/off
    }

// complile
}
