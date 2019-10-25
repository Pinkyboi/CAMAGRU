<?php
    include_once('autoloader.php');
    include('../config/database.php');
    $PDO = new Database($DB_DNS,$DB_USER,$DB_PASSWORD);
    $_PDO = $PDO->_PDO;
    $_PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
    $mail = new Mail();
?>