<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'直播',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

    'defaultController'=>'Corp',
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'111111',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'corp'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
//	        'loginUrl'=>array('corp/roadshow')
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
		        'class'=>'application.components.McryptUrl',
				'showScriptName'=>false,
//			'urlFormat'=>'path',
//			'rules'=>array(
//				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
//				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
//				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
//			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=ip;dbname=dataname',
			'emulatePrepare' => true,
			'username' => ' ',
			'password' => ' (fol',
			'charset' => 'utf8',
		),		
		'db2'=>array(
			'connectionString' => 'mysql:host=ip;dbname=dataname',
			'class'=>'CDbConnection',
			'emulatePrepare' => true,
			'username' => ' ',
			'password' => ' ',
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'error/error',
        ),
	),

	'params'=>require(dirname(__FILE__).'/params.php'),
);