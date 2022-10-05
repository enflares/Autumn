<?php
declare(strict_types=1);

use Autumn\App;

if(version_compare(PHP_VERSION, '8.1.0') < 0) {
    exit('PHP version must be over 8.1.0');
}

if (defined('PUB_ROOT')) return;
defined('PUB_ROOT') or define('PUB_ROOT', __DIR__);
defined('DOC_ROOT') or define('DOC_ROOT', dirname(__DIR__));

require(DOC_ROOT . '/vendor/autoload.php');

App::start()->end();
