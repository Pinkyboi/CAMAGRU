<?php
    include_once($_SERVER['DOCUMENT_ROOT'].'/function/autoloader.php');
    include($_SERVER['DOCUMENT_ROOT'].'/config/database.php');
    $PDO = new Database($DB_DNS,$DB_USER,$DB_PASSWORD);
    $_PDO = $PDO->_PDO;
    $_PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
    $mail = new Mail();
?>