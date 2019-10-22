<?php
    function send($POST,&$SESSION,$PDO,$use=0,$tempToken=0){
        try{
            if($use === 0){
                $token  = md5(uniqid($_POST['userRegistration'], true));
                $SESSION['token'] = $token;
                $password = hash('whirlpool',$_POST['passwordRegistration']);
                $statement = "INSERT INTO  users VALUES (NULL, ?,?,?,?,'../gallery/profile.png','1')";
                $fields = array(htmlentities($_POST['userRegistration']),htmlentities($_POST['emailRegistration']),$password,$SESSION['token']);
                $PDO->statementPDO($statement, $fields,0);            
            }
            if($use === 1)
                $token  = $tempToken;
            $statement2 = "SELECT ID FROM users WHERE token = ?";
            $fieldToken = array($token);
            $ID = $PDO->statementPDO($statement2, $fieldToken,1);
            $SESSION['ID'] = $ID['0'];            
        }
        catch(Exeption $e){}
    }
?>