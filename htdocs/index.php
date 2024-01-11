<?php
ob_start();
session_start();


error_reporting(E_ALL);

date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");

spl_autoload_register(
    function($className)
    {
        $className = str_replace("_", "\\", $className);
        $className = ltrim($className, '\\');
        $fileName = '';
        $namespace = '';
        if ($lastNsPos = strripos($className, '\\'))
        {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        
        
        $t = $fileName . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
        if(file_exists($t)) {
            require $t;
        } else {
            require $fileName . str_replace('_', DIRECTORY_SEPARATOR, $className) . '.class.php';
        }
        
    }
);

use modele\bdd as bdd;
use modele\action;

bdd::auth();
action::invoke();

include('public/index.php');

ob_end_flush();