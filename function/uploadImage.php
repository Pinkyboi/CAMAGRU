<?php
    include('../function/imageUpload.php');
    include('../function/connect.php');

    session_start();
    if($_FILES['profile']['name']){
        uploadImage($valid,$errors,$_FILES,$_SESSION,$PDO,'profile');
        $_SESSION['profile'] = profilePic($_SESSION,$PDO);
    }
    header('Location:'.$_POST['link']);
?>