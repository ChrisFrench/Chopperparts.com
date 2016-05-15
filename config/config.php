<?php
$app->config ( $app->get ( 'PATH_ROOT' ) . 'config/common.config.ini' );
$app->set ( 'DEBUG', 3 );

$app->set ( 'LOGS', realpath ( $app->get ( 'PATH_ROOT' ) . 'logs/' ) . '/' );
$app->set ( 'TEMP', realpath ( $app->get ( 'PATH_ROOT' ) . 'tmp/' ) . '/' );

if ($app->get ( 'DEBUG' )) {
	ini_set ( 'display_errors', 1 );
	if (! $app->get ( 'CACHE' )) {
		\Cache::instance ()->reset ();
	}
}

$app->set('db.mongo.database', 'chopperparts');
$app->set('db.mongo.server','mongodb://localhost:27017' );

$app->set('HOST','www.chopperparts.com' );