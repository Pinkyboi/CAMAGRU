<?php
    spl_autoload_register('myAutoloader');
    function myAutoloader($className){
        $path = $_SERVER['DOCUMENT_ROOT'].'/'.'class/';
        $ext = '-class.php';
        $fullPath = $path . $className . $ext;
        include_once($fullPath);
    }
?>