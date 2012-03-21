<?php	

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('DEFAULT_CON', "Home_con/");


if(!empty($_GET['url'])) $url = $_GET['url']; 
//echo $url;
if(empty($url)) $url=DEFAULT_CON;
require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
