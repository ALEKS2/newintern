<?php
define("ROOT_PATH", dirname(__DIR__));
define("CLASS_PATH", ROOT_PATH. "/php/classes");
function myAutoload($class){
    if(preg_match('/\A\w+\Z/', $class)){
        include(CLASS_PATH.'/'.$class.'.php');
    }
}
spl_autoload_register('myAutoload');