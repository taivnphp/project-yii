<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// change the following paths if necessary
$yii=dirname(__FILE__).'/lib/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';
define('DS', DIRECTORY_SEPARATOR);
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
//show profiler
defined('YII_DEBUG_SHOW_PROFILER') or define('YII_DEBUG_SHOW_PROFILER',true);
//enable profiling
defined('YII_DEBUG_PROFILING') or define('YII_DEBUG_PROFILING',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',1);

require_once($yii);
Yii::createWebApplication($config)->run();
