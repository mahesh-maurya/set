<?php
$backendConfigDir = dirname(__FILE__);

$root = $backendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($backendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'www');

$mainLocalFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
	array(
		'name' => 'STUP CMS',
		'basePath' => 'backend',
		'params' => $params,
		'preload' => array('bootstrap', 'log'),
		'language' => 'en',
		'theme' => 'bootstrap',
		'import' => array(
			'common.components.*',
			'common.extensions.*',
			'common.uploads.*',
			'common.models.*',
			'application.components.*',
			'application.controllers.*',
			'application.models.*',
		),
		'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'stup',
				'generatorPaths' => array(
					'bootstrap.gii'
				)
			),
			'backup',		
		),
		'components' => array(
			'user' => array(
				'allowAutoLogin'=>true,
				 'class' => 'WebUser',
			),
			
			'pdfFactory'=>array(
				'class'=>'ext.pdffactory.EPdfFactory',
			),
			
			'GetAccessRule'=>array(
				'class'=>'GetAccessRuleComponent',
	   		),
			
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),
			'errorHandler' => array(
				'errorAction'=>'site/error'
			),
			
			'db'=> array(
				'connectionString' => $params['db.connectionString'],
				'username' => $params['db.username'],
				'password' => $params['db.password'],
				'schemaCachingDuration' => YII_DEBUG ? 0 : 86400000, // 1000 days
				'enableParamLogging' => YII_DEBUG,
				'charset' => 'utf8',
				'tablePrefix' => $params['db.tablePrefix'],
			),
			'urlManager' => array(
				'urlFormat' => 'path',
				'showScriptName' => false,
				'urlSuffix' => '/',
				'rules' => $params['url.rules']
			),
			
			'image'=>array(     
				'class'=>'application.extensions.image.CImageComponent',            
				'driver'=>'GD', 
			),
						
			'cache'=>array(
				'class'=>'system.caching.CFileCache',
	        ),
		),	

	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'tbl_prefix'=>'tbl_',
	),
	),
	CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);