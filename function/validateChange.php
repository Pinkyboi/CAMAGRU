<?php

function validateChange(&$valid,&$errors,$FILE,$SESSION,$PDO){
    try{
        if($_POST['changeUser'] == $_SESSION['pseudo'])
            $errors['pseudo'] = "You are already using that pseudo";
        else if($_POST['changeUser'] && !($errors['pseudo'] = ft_verifie_pseudo($_POST['changeUser'],$PDO))){
            $statement = "UPDATE users SET pseudo = ? WHERE email = ?";
            $field = array($_POST['changeUser'],$_SESSION['email']);
            $PDO->statementPDO($statement,$field);
            $_SESSION['pseudo'] = $_POST['changeUser'];
            $valid['pseudo'] = 'Your pseudo have been updated';
        }
        if($_POST['changeEmail'] == $_SESSION['email'])
            $errors['email'] = "You are already using that email";
        else if($_POST['changeEmail'] && !($errors['email'] = ft_verifie_mail($_POST['changeEmail'],$PDO))){
            $statement = "UPDATE users SET email = ? WHERE email = ?";
            $field = array($_POST['changeEmail'],$_SESSION['email']);
            $PDO->statementPDO($statement,$field,0);
            $_SESSION['email'] = $_POST['changeEmail'];
            $valid['email'] = 'Your email have been updated';
        }
        if($_POST['changePassword'] && !($errors['password'] = ft_verifie_password($_POST['changePassword'],$_POST['confirmChangePassword']))){
            $statement = "UPDATE users SET passwrd = ? WHERE pseudo = ?";
            $field = array(htmlentities(hash('whirlpool',$_POST['changePassword'])),$_SESSION['pseudo']);
            $PDO->statementPDO($statement,$field,1);
            $valid['password'] = 'Your password have been updated';
        }            
    }
    catch(Exeption $e){}
}
