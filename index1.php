<?php
header("HTTP/1.1 301 Moved Permanently");
header("Location: http://www.ya.ru/");
exit();
?>
<?php
//проект версия 0.1
// change the following paths if necessary
$yii=dirname(__FILE__).'/yii/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',0);

require_once($yii);
Yii::createWebApplication($config)->run();