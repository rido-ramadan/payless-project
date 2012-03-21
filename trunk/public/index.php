<?php	

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = $_GET['url'];
//echo "asd";
//echo $url;
if(empty($url)) $url="items/viewall";
require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
