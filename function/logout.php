<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    echo './viewIndex.php';
    die;
?>