<?php

//return CMap::mergeArray(
//	require(dirname(__FILE__).'/main.php'),
//	array(
//		'components'=>array(
//			'fixture'=>array(
//				'class'=>'system.test.CDbFixtureManager',
//			),
//			/* uncomment the following to provide test database connection
//			'db'=>array(
//				'connectionString'=>'DSN for test database',
//			),
//			*/
//		),
//	)
//);

// Definitions
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Load the config files
$config = require __DIR__.DS.'protected'.DS.'config'.DS.'test.php';

// Load Yii and Composer extensions
require_once __DIR__.DS.'vendor'.DS.'yiisoft'.DS.'yii'.DS.'framework'.DS.'yii.php';
require_once __DIR__.DS.'vendor'.DS.'autoload.php';

// Return for Codeception
return array(
    'class' => 'CWebApplication',
    'config' => $config,
);
