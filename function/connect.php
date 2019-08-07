<?php
    include('../class/connect-class.php');
    include('../class/mail-class.php');
    $PDO = new Database();
    $_PDO = $PDO->initPDO('Camagru','root','tiger');
    $_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $_PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db_name = 'users';
    $mail = new Mail();
?>