<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Universal
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'universalList' => 'system/modules/universal/modules/universalList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'universal_debug'        => 'system/modules/universal/templates',
	'universal_list_default' => 'system/modules/universal/templates',
));
