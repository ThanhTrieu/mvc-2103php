<?php

if(!defined('ROOT_PATH')) {
    // phai chay qua file index de ton tai const ROOT_PATH
    // khong duoc phep chay truc tiep vao file nay
    die('Can not access');
}

// file nay se la noi tiep nhan cac request gui len
// domain-name/oop-mvc/index.php?c=home&m=index
// c : controller
// m : phuong thuc cua controller do 
$controller = ucfirst($_GET['c'] ?? 'login'); // lay dc ten controller
$method = trim($_GET['m'] ?? 'index'); // lay ra duoc ten phuong thuc

// khoi tao doi tuong cua controller va truy cap vao phuong thuc
$fileController = PATH_CONTROLLERS.$controller."Controller.php";
$pathObject = PATH_CONTROLLERS.$controller.'Controller';
// App\controllers\HomeController.php;

$filePathController = str_replace('\\','/', $fileController);
if(file_exists($filePathController)){
    // khoi tao doi tuong
    $obj = new $pathObject();
    // truy cap phuong thuc
    $obj->$method();
} else {
    die('can not find request');
}