<?php

/** Check if environment is development and display errors **/

function setReporting() {
    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors','On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
    }
}

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
	if ( get_magic_quotes_gpc() ) {
		$_GET    = stripSlashesDeep($_GET   );
		$_POST   = stripSlashesDeep($_POST  );
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

/** Check register globals and remove them **/

function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

/** Main Call Function **/

function callHook() {
	global $url;

	$urlArray = array();
	$urlArray = explode("/",$url);

	$controller = $urlArray[0];
	//array_shift($urlArray);
	if(count($urlArray)>1){
		$action = $urlArray[1];
		if(empty($urlArray[1])) $action="index";
	}
	else $action="index";
	
	//echo "action=".$action."<br>";
	if(count($urlArray)>2){
		array_shift($urlArray);
		array_shift($urlArray);
		$queryString = $urlArray;
	}else $queryString=Array();
	//echo "querystring=".$queryString."<br>";
	$controllerName = $controller;
	$controller = ucwords($controller);
	$model = rtrim($controller, 's');
	//echo "model=".rtrim($controller, 's');
	//$controller .= 'Controller';
	//$model = "sa";
	//$dispatch = new $controller($model,$controllerName,$action);
	if(class_exists($controllerName))
            $dispatch = new $controller($model,$controllerName);
	else {
//            if(file_exists(BASE_URL.$controllerName))
//                echo "File ada";
//            else
            header( 'Location: '.BASE_URL.'home_con/error/' ) ;            
        }

	if ((int)method_exists($controller, $action)) {
            call_user_func_array(array($dispatch,$action),$queryString);
	} else {
            header( 'Location: '.BASE_URL.'home_con/error/' ) ;            
		/* Error Generation Code Here */
	}
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
//echo "<br>lib;".$className."<br>";
		require_once(ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php')) {
//echo "<br>con;".$className."<br>";
		require_once(ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.php');
	} else if (file_exists(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php')) {
//echo "<br>mod;".$className."<br>";
		require_once(ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.php');
	} else {
//echo "<br>error;".$className."<br>";
		/* Error Generation Code Here */
	}
}

setReporting();
removeMagicQuotes();
unregisterGlobals();
callHook();
