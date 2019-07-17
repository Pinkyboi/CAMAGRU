<?php
    include('../class/connect-class.php');
    $PDO = new Database();
    $_PDO = $PDO->initPDO('Camagru','root','tiger');
    $db_name = 'users';
?>