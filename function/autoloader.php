<?php
    spl_autoload_register('myAutoloader');
    function myAutoloader($className){
        $path = '../class/';
        $ext = '-class.php';
        $fullPath = $path . $className . $ext;
        include_once($fullPath);
    }
?>