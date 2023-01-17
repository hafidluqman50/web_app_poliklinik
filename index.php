<?php
define('ROOT',dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);

require_once 'config.php';
require_once 'core/Autoload.php';
require_once 'core/Helper.php';
require_once 'core/DB.php';
require_once 'core/Controllers.php';
require_once 'core/Models.php';
require_once 'routes/web.php';