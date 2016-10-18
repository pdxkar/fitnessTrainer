<?php

//dev setting
require('vendor/autoload.php');
//prod
//require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
		'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
		'twig.path' => __DIR__.'/views',
));

$dbopts = parse_url(getenv('DATABASE_URL'));

// Dev settings
//$dbopts["dbname"] = 'recipe';
$dbopts["port"] = "localhost";
//$dbopts["host"] = "localhost";
$dbopts["user"] = "test";
$dbopts["pass"] = "test";

//dev settings (RECIPE):
// $app->register(new Herrera\Pdo\PdoServiceProvider(),
// 		array(
// 				'pdo.dsn' => 'mysql:dbname=recipe',
// 				'pdo.port' => $dbopts["port"],
// 				'pdo.username' => $dbopts["user"],
// 				'pdo.password' => $dbopts["pass"]
// 		)
// 		);

//dev settings (DISTILLERY):
$app->register(new Herrera\Pdo\PdoServiceProvider(),
		array(
				'pdo.dsn' => 'mysql:dbname=distillerydemo',
				'pdo.port' => $dbopts["port"],
				'pdo.username' => $dbopts["user"],
				'pdo.password' => $dbopts["pass"]
		)
);

//Prod settings
//Extend app to add a PDO connection
/* $dbopts = parse_url(getenv('DATABASE_URL'));

/* $app->register(new Herrera\Pdo\PdoServiceProvider(),
	array(
		'pdo.dsn' => 'mysql:dbname='.ltrim($dbopts["path"],'/').';host='.$dbopts["host"],
		'pdo.port' => $dbopts["port"],
		'pdo.username' => $dbopts["user"],
		'pdo.password' => $dbopts["pass"]
	)
);  */


// Our web handlers
$app->get('/', function() use($app) {
	$app['monolog']->addDebug('logging output.');
	return $app['twig']->render('index.twig');
});

	$app->get('/cowsay', function() use($app) {
		$app['monolog']->addDebug('cowsay');
		return "<pre>".\Cowsayphp\Cow::say("Cool beans")."</pre>";
	});

		?>