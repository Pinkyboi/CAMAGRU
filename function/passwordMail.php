<?
    include('connect.php');
    function sendEmailPassword($PDO,$mail){
        $messageSend = array();
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        if($_GET['email']){
            try{
                if($PDO->verifyPDO('users','email',htmlentities($_GET['email']))){
                    $statement = "SELECT * FROM password_reset WHERE email = ?";
                    $field = array($token,htmlentities($_GET['email']));
                    if(!$PDO->verifyPDO('password_reset' ,'email',$_GET['email'])){
                        $statement = 'INSERT INTO password_reset VALUES (NULL,?,?)';
                        $PDO->statementPDO($statement,$field,0);
                        $valid = "the email has been sent";
                    }
                    else{
                        $statement = "UPDATE password_reset SET token = ? WHERE email = ?";
                        $PDO->statementPDO($statement,$field,0);
                        $valid = "the email has been resent";
                    }
                    $statement = "SELECT ID FROM users WHERE email = ?";
                    $id = $PDO->statementPDO($statement,array($_GET['email']));
                    $statement = "SELECT pseudo FROM users WHERE email = ?";
                    $pseudo = $PDO->statementPDO($statement,array($_GET['email']));
                    $mail->passwordMail($pseudo[0],$id[0],$token,$_GET['email']);
                }
                else
                $error = "There's no account with is email";                   
            }
            catch(Exeption $e){}
        }
        else
            $error = "Please enter your email";
        if($valid || $error){
            echo json_encode($messageSend = array(
                'valid' => $valid,
                'error' => $error,
            ));            
        }
    }
    if($_GET['ressendPassword']){
        sendEmailPassword($PDO,$mail);
    }
?>