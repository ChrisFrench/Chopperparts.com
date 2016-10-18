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


\Cloudinary::config(array(
    "cloud_name" => "chopper-parts",
    "api_key"    => "126425756666297",
    "api_secret" => "8XoUt8-lapkBMoKdI1eZKgUSVWk"
));

\Braintree_Configuration::environment('sandbox');
\Braintree_Configuration::merchantId('5xcnbk7syn4gb8zw');
\Braintree_Configuration::publicKey('d7p8xfcsj7z4tz46');
\Braintree_Configuration::privateKey('8e59484a326e266e06dfd58ce55eb450');

$app->set('mailer.email_override', "chris@ammonitenetworks.com");

//BRAINTREE
//$app->set('braintree.paypal.merchant', 'Northridge4x4LLC_instant');
//$app->set('braintree.creditcard.merchant', 'Northridge4x4LLC_instant_2');
