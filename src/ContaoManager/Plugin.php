<?php

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Delirius\UniversalModul\ContaoManager;

use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

/**
 * Plugin for the Contao Manager.
 *
 * @author Andreas Schempp <https://github.com/aschempp>
 */
class Plugin implements BundlePluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function getBundles(ParserInterface $parser)
    {
        return [
            BundleConfig::create('Delirius\UniversalModul\DeliriusUniversalModul')
                ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
                // ->setReplace(['calendar']),

                // BundleConfig::create('BugBuster\XingBundle\BugBusterXingBundle')
                // ->setLoadAfter(['Contao\CoreBundle\ContaoCoreBundle'])
                // ->setReplace(['xing']),
        ];
    }
}
