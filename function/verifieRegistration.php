<?php
    function    ft_verifie_password($password,&$confirmPassword){
        $regexPassword = "/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&\#])[A-Za-z\d@$!%*?&\#]{8,}/";
        if(!preg_match($regexPassword, $password)){
            unset($confirmPassword);  
            return "Your password should be at least 8 characters long contain digits, (lower/upper)case leters and special caracters (@$!%*?&#).";          
        }
        else if($password != $confirmPassword){
            unset($confirmPassword);
            return "wrong password confirmation.";
        }
        return NULL;
    }

    function    ft_verifie_mail($email,$PDO){
        if($PDO->verifyPDO('users','email',$email)){
            return "this email is already taken.";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            return "please choose a valide email.";
        }
        return NULL;
    }

    function    ft_verifie_pseudo($user,$PDO){
        $regexPseudo = "/^[A-Za-z0-9\.\_\-]{0,}$/";
        if(!preg_match($regexPseudo, $user)){
            return "digits leters and (._-) are the only characters alowed for a username";
        }  
        else if($PDO->verifyPDO('users','pseudo',$user)){
            return "this username is already taken.";
        }
        else if(strlen($user) > 15){
            return "the username lenght is too big.";
        }
        else if(strlen($user) < 4)
            return "the username must contain at least 4 characters.";
        return NULL;       
    }

    function ft_verifie_field($POST,$PDO,&$error){
        if(isset($POST['submitRegistration'])){
            foreach($error as $err)
                $err == NULL;
            $error['errpass'] = ft_verifie_password($POST['passwordRegistration'],$POST['confirmPasswordRegistartion']);
            $error['errmail']  = ft_verifie_mail($POST['emailRegistration'],$PDO);
            $error['errpsdo']  = ft_verifie_pseudo($POST['userRegistration'],$PDO);
            foreach($error as $err){
                if($err)
                    return(false);   
            }
            return(true);
        }
    }  
?>
