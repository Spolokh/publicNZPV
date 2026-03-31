<?php

session_start();

define('root', dirname(__DIR__));
define('rootpath', dirname(__FILE__));
define('VENDOR', root. '/libs');
define('UPLOADS', root. '/uploads');
define('VIEWS_PATH', rootpath.'/views');
define('MODEL_PATH', rootpath.'/models');
define('CONTR_PATH', rootpath.'/controllers');
define('MINIMUM_PHP', '7.0.33');

if ( version_compare(PHP_VERSION, MINIMUM_PHP, '<') )
{
    exit('Your host needs to use PHP ' .MINIMUM_PHP. ' or higher to run this version CMS! This version ' . PHP_VERSION);
}

require_once 'core/view.php';
require_once 'core/model.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/functions.php';

spl_autoload_register('classRegister');

$config = include_once ('core/config.php');
Config::init($config);

ORM::configure(Config::dsn());
ORM::configure([
    'dbprefix' => Config::get('prefix'),
    'username' => Config::get('dbuser'),
    'password' => Config::get('dbpass')
]);

Route::start();
