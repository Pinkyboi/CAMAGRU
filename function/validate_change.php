<?php
    function validateChange(&$valid,&$errors,$FILE,$SESSION,$PDO){
        try{
            if($_POST['pseudo'] == $_SESSION['pseudo'])
                $errors['pseudo'] = "You are already using that pseudo";
            else if($_POST['pseudo'] && !($errors['pseudo'] = ft_verifie_pseudo($_POST,$PDO))){
                $statement = "UPDATE users SET pseudo = ? WHERE email = ?";
                $field = array($_POST['pseudo'],$_SESSION['email']);
                $PDO->statementPDO($statement,$field);
                $_SESSION['pseudo'] = $_POST['pseudo'];
                $valid['pseudo'] = 'Your pseudo have been updated';
            }
            if($_POST['email'] == $_SESSION['email'])
                $errors['email'] = "You are already using that email";
            else if($_POST['email'] && !($errors['email'] = ft_verifie_mail($_POST,$PDO))){
                $statement = "UPDATE users SET email = ? WHERE email = ?";
                $field = array($_POST['email'],$_SESSION['email']);
                $PDO->statementPDO($statement,$field,0);
                $_SESSION['email'] = $_POST['email'];
                $valid['email'] = 'Your email have been updated';
            }
            if($_POST['password'] && !($errors['password'] = ft_verifie_password($_POST))){
                $statement = "UPDATE users SET passwrd = ? WHERE pseudo = ?";
                $field = array(htmlentities(hash('whirlpool',$_POST['password'])),$_SESSION['pseudo']);
                $PDO->statementPDO($statement,$field,1);
                $valid['password'] = 'Your password have been updated';
            }            
        }
        catch(Exeption $e){
            var_dump($e->getMessage());
        }
    }
