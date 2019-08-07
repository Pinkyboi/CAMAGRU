<?php

    function    ft_verifie_password($POST){
        if(strlen($POST['password']) < 8||strlen($POST['password']) > 28){
            unset($POST['password1']);
            return "wrong password lenght.";
        }     
        if($POST['password'] != $POST['password1']){
            unset($POST['password1']);
            return "wrong password confirmation.";
        }
        return NULL;
    }

    function    ft_verifie_mail($POST,$PDO){
        if($PDO->verifyPDO('users','email',$_POST['email'])){
            return "this email is already taken.";
        }
        if(!filter_var($POST['email'],FILTER_VALIDATE_EMAIL)){
            return "please choose a valide email.";
        }
        return NULL;
    }

    function    ft_verifie_pseudo($POST,$PDO){
        if($PDO->verifyPDO('users','pseudo',$_POST['pseudo'])){
            return "this pseudo is already taken.";
        }
        if(strlen($_POST['pseudo']) > 15){
            return "the pseudo lenght is too big.";
        }
        return NULL;       
    }

    function ft_verifie_field($POST,$_PDO,&$error){
        if(isset($POST['submit'])){
            foreach($error as $err)
                $err == NULL;
            $error['password'] = ft_verifie_password($POST);
            $error['errmail']  = ft_verifie_mail($POST,$_PDO);
            $error['errpsdo']  = ft_verifie_pseudo($POST,$_PDO);
            foreach($error as $err){
                if($err)
                    return(false);   
            }
            return(true);
        }
    }
?>
