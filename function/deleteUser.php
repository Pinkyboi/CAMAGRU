<?php
    include('connect.php');
    include('imageUpload.php');
    session_start();
    function delAllImage($PDO,$ID){
        $statement = "SELECT `Path` FROM images WHERE USER = ?";
        $statement2 = "DELETE FROM users WHERE ID = ?";
        $field = array($ID);
        $paths = $PDO->statementPDO($statement,$field,2);
        foreach($paths as $path){
            unlink($_SERVER['DOCUMENT_ROOT'].$path[0]);
        }
        $PDO->statementPDO($statement2,$field);
    }

    function pseudoID($PDO){
        $statement = "SELECT ID FROM users WHERE pseudo = ?";
        $field = array($_SESSION['pseudo']);
        $userID = $PDO->statementPDO($statement,$field);
        return($userID[0]);
    }
    if(isset($_GET['use']) && $_GET['use'] == 'delTheUser'){
        try{
            if(isset($_SESSION['pseudo'])){ 
                $profileLink = profilePic($_SESSION,$PDO);
                if($profileLink != '/gallery/profile.png')
                    unlink($_SERVER['DOCUMENT_ROOT'].$profileLink);
                $ID = pseudoID($PDO);
                delAllImage($PDO,$ID);
                unset($_SESSION);
                session_destroy();
                session_write_close();
                echo 'viewIndex.php';
            }
        }
        catch(Exeption $e){}
    }
?>