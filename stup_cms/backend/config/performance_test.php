<?php
/**
 * main.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/22/12
 * Time: 5:48 PM
 *
 * This file holds the configuration settings of your backend application.
 **/
$backendConfigDir = dirname(__FILE__);

$root = $backendConfigDir . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..';

$params = require_once($backendConfigDir . DIRECTORY_SEPARATOR . 'params.php');

// Setup some default path aliases. These alias may vary from projects.
Yii::setPathOfAlias('root', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');
Yii::setPathOfAlias('backend', $root . DIRECTORY_SEPARATOR . 'backend');
Yii::setPathOfAlias('www', $root. DIRECTORY_SEPARATOR . 'backend' . DIRECTORY_SEPARATOR . 'www');
/* uncomment if you need to use frontend folders */
/* Yii::setPathOfAlias('frontend', $root . DIRECTORY_SEPARATOR . 'frontend'); */


$mainLocalFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-local.php';
$mainLocalConfiguration = file_exists($mainLocalFile)? require($mainLocalFile): array();

$mainEnvFile = $backendConfigDir . DIRECTORY_SEPARATOR . 'main-env.php';
$mainEnvConfiguration = file_exists($mainEnvFile) ? require($mainEnvFile) : array();

return CMap::mergeArray(
	array(
		'name' => 'Project_base',
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#basePath-detail
		'basePath' => 'backend',
		// set parameters
		'params' => $params,
		// preload components required before running applications
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#preload-detail
		'preload' => array('bootstrap', 'log'),
		// @see http://www.yiiframework.com/doc/api/1.1/CApplication#language-detail
		'language' => 'en',
		// using bootstrap theme ? not needed with extension
		'theme' => 'bootstrap',
		// setup import paths aliases
		// @see http://www.yiiframework.com/doc/api/1.1/YiiBase#import-detail
		'import' => array(
			'common.components.*',
			'common.extensions.*',
			/* uncomment if required */
			/* 'common.extensions.behaviors.*', */
			/* 'common.extensions.validators.*', */
			'common.models.*',
			// uncomment if behaviors are required
			// you can also import a specific one
			/* 'common.extensions.behaviors.*', */
			// uncomment if validators on common folder are required
			/* 'common.extensions.validators.*', */
			'application.components.*',
			'application.controllers.*',
			'application.models.*'
		),
		/* uncomment and set if required */
		// @see http://www.yiiframework.com/doc/api/1.1/CModule#setModules-detail
		 'modules' => array(
			'gii' => array(
				'class' => 'system.gii.GiiModule',
				'password' => 'admin',
				'generatorPaths' => array(
					'bootstrap.gii'
				)
			),
			
		
		),
		'components' => array(
			'user' => array(
				'allowAutoLogin'=>true,
				 'class' => 'WebUser',
			),
			
			'GetAccessRule'=>array(
	        'class'=>'GetAccessRuleComponent',
	   		 ),
			/* load bootstrap components */
			'bootstrap' => array(
				'class' => 'common.extensions.bootstrap.components.Bootstrap',
				'responsiveCss' => true,
			),
			'errorHandler' => array(
				// @see http://www.yiiframework.com/doc/api/1.1/CErrorHandler#errorAction-detail
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
				'enableProfiling' => $params['db.enableProfiling'],
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
			
			'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				array(
					'class' => 'common.extensions.pqp.PQPLogRoute',
					'categories' => 'application.*, exception.*',
					),
				),
			),
		
			'cache'=>array(
	        'class'=>'system.caching.CFileCache',
	        //'class'=>'system.caching.CMemCache',
			//'keyPrefix'=>'idol',
	       	),
			/* make sure you have your cache set correctly before uncommenting */
			/* 'cache' => $params['cache.core'], */
			/* 'contentCache' => $params['cache.content'] */
		),	

				// this is used in contact page
	'params'=>array(
		// this is used in contact page
		//'adminEmail'=>'webmaster@example.com',
		'tbl_prefix'=>'tbl_',
         
         //facebook local app details - http://localhost/junior_idol/
       //  'appId'=>'571994749517901',
		//'secret'=>'	d87d4710551734c2bd2aea27fea152d6',
		
         //facebook live app details - http://indianidol.sonyliv.com/
		//'appId'=>'483426531726644',
		//'secret'=>'09e5eac7f234ac0349e261e5e8c60fe3'
	),
	),
	CMap::mergeArray($mainEnvConfiguration, $mainLocalConfiguration)
);