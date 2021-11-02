<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'vendor/autoload.php';

define('ROOT_PATH', 'index.php');
define('PATH_CONTROLLERS', 'app\controllers\\');
define('PATH_MODELS', 'app\models\\');

if(file_exists('web/route.php')){
    require_once 'app/helpers/common.php';
    require 'web/route.php';
} else {
    require 'upgrade.php';
}