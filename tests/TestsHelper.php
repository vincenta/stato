<?php

/*
 * Include PHPUnit dependencies
 */
require_once 'PHPUnit/Framework.php';

error_reporting( E_ALL | E_STRICT );

date_default_timezone_set('Europe/Paris');

/*
 * Prepend the Stato webflow/lib/, orm/lib/ and tests/ directories to the include_path
 */
$path = array(
    dirname(__FILE__),
    dirname(__FILE__).'/../webflow/lib',
    dirname(__FILE__).'/../orm/lib',
    get_include_path()
);
set_include_path(implode(PATH_SEPARATOR, $path));
