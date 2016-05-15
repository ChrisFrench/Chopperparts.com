<?php
header('Access-Control-Allow-Origin: *');
//AUTOLOAD all your composer libraries now.
(@include_once (__dir__ . '/../vendor/autoload.php')) OR die("You need to run php composer.phar install for your application to run.");
//Require FatFree Base Library https://github.com/bcosca/fatfree
$app = Base::instance();
//Set the PATH so we can use it in our apps
$app->set('PATH_ROOT', dirname(__dir__).'/');
//This autoload loads everything in apps/* and 
$app->set('AUTOLOAD',  $app->get('PATH_ROOT') . 'apps/;');

//load the config files for enviroment
require $app->get('PATH_ROOT') . 'config/config.php';
//SET the "app_name" or basically the instance so we can server the admin or site from same url with different loaded classes
new \DB\Mongo\Session(new DB\Mongo($app->get('db.mongo.server'),$app->get('db.mongo.database')));
$app->set('APP_NAME', 'site');

if (strpos(strtolower($app->get('URI')), $app->get('BASE') . '/admin') !== false)
{
    $app->set('APP_NAME', 'admin');
    //stupid javascript bugs with debug off
    $app->set('DEBUG', 1);
}

// bootstap each mini-app  these are in apps folder, as well as in vender/dioscouri
\Dsc\Apps::instance()->bootstrap();

// load routes; Routes are defined by their own apps in the Routes.php files
\Dsc\System::instance()->get('router')->registerRoutes();

// trigger the preflight event PreSite, PostSite etc
\Dsc\System::instance()->preflight();


$app->run();