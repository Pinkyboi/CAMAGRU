<?php
    function ft_verifie_field(&$POST,$_PDO,&$error){
        if(isset($POST['submit'])){
            foreach($error as $err)
                $err == NULL;
            $i = 0;
            if(strlen($_POST['password']) < 8||strlen($_POST['password']) > 28){
                $i++;
                $error['errpass'] = "wrong password lenght.";
            }
                
            if($POST['password'] != $POST['password1']){
                $i++;
                $error['errpass'] = "wrong password confirmation.";
                unset($POST['password2']);
            }   
            if(!filter_var($POST['email'],FILTER_VALIDATE_EMAIL)){
                $i++;
                $error['errmail'] = "please choose a valide email.";
            }
            if($_PDO->verifyPDO('users','pseudo',$_POST['pseudo'])){
                $i++;
                $error['errpsdo'] = "this pseudo is already taken.";
            }
            if(strlen($_POST['pseudo']) > 15){
                $i++;
                $error['errpsdo'] = "the pseudo lenght is too big.";
            }
            if($_PDO->verifyPDO('users','email',$_POST['email'])){
                $i++;
                $error['errmail']= "this email is already taken.";
            }
            if($i != 0)  
                return(false);
            return(true);
        }
    }
?>
