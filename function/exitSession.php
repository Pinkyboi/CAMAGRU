<?php
    function verifSession($PDO,$SESSION){
        if(isset($_SESSION['pseudo'])){
            $statement = "SELECT ID FROM users WHERE pseudo = ?";
            $field = array($_SESSION['pseudo']);
            $userID = $PDO->statementPDO($statement,$field);
            if(empty($userID)){
                unset($SESSION);
                session_destroy();
                session_write_close();
                header("Location: {$_SERVER['PHP_SELF']}"); 
            }                        
        }
    }
?>
