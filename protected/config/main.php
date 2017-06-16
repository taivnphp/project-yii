<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');

$rules     = require(__DIR__ . '/rules.php');
$dbConfig  = require(__DIR__ . '/db.php');
$params    =  require(__DIR__ . '/params.php');
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Project Name',
    // preloading 'log' component
    'preload' => array('log'),
    'theme' => 'es',
    // autoloading model and component classes
    'import' => array(
        'application.models.base.*',
        'application.models.*',
        'application.components.*',
        'ext.widgets.*',        
        'application.extensions.*',                
        'application.messages.*',                
    ),
    'aliases' => array(
        //Aliases
    ),
    // application components
    'components' => array(      
        'db' => $dbConfig,  
        //'language' => 'en',
        'sourceLanguage' => 'en',
        'request'=>array(
            'class' => 'application.components.CustomHttpRequest',
            'enableCsrfValidation'=>true,
        ),        
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'helper' => array(
            'class' => 'application.components.HelperComponent'
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log'=>array(
			'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'webApplication.log',
                    'enabled' =>YII_DEBUG_SHOW_PROFILER,
                    'levels'=>'trace, warning, error, profile, info, vardump',
                    'filter'=>'CLogFilter',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'batchCommand.log',
                    'levels'=>'info, error'
                ),                
            ),
		),
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName' => false,
            'rules' => $rules
        ),
        'session'=>array(
            'class'=> 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'Session',
            'timeout' => 7200
        ),
        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'admin'
        ),
        // 'message' => array(
        //     'source' => 'MPhpMessageSource'
        // ),
        'coreMessages'=>array('basePath'=>'protected/messages'),
    ), // Component
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'abcdef',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array('bootstrap.gii')
        ),
    ),    
    'params'=> $params
);