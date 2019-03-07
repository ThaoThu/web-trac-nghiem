<?php session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
define("app_path",__DIR__);
define("layout_path", app_path.'/View/layout');
define('controller_path',app_path.'/Controller');
define("model_path", app_path.'/Model');
define("base_path", "/TRAC-NGHIEM");

require_once 'Core/app.php';
$app = new MyMVC();
$app->run();



?>