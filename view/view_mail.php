<?php
    session_start();
    include('../function/connect.php');
    include('../function/sendmail.php');
    if($_POST['submit']){
            $number = $_POST;
        unset($number['submit']);
        foreach($number as $nb){
            if(strlen($nb) != 1)
                $error = "wrong number of parameters";
        }
        $nb = implode($number);
        if(strlen($nb) != 4){
            $error = "wrong number of parameters";
        }
        if(!$error){
            if($_SESSION['token'] == $nb){
                $statement = "UPDATE $db_name SET `token` = ? WHERE email = "."'".$_SESSION['email']."'";
                if($PDO->verifyPDO($db_name,"token",$nb)){
                    $token = array('0');
                    $PDO->statementPDO($db_name,$statement,$token,0);
                }
                else
                    $error = "wrong code";            
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAMAGRU</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../style/mail.css" />
</head>
<body>
    <div class="container">
        <div class="field">
            <div class="logo"><img src="../imgs/mail.png" alt=""></div>
            <div class="translate">
                <h1 class="title">Verification link sent!</h1><br>
                <p>Your acount hs been sccessfully registred to complete the precess please enter the 4 digit code sent to <br><span id="email"><?php echo $_SESSION['email']?></span></p><br>
                <form action="view_mail.php" method="POST">
                    <input class='<?php if($error) echo "error"?>'type="text" name = "num1" maxlength="1" required>
                    <input class='<?php if($error) echo "error"?>'type="text" name = "num2" maxlength="1" required>
                    <input class='<?php if($error) echo "error"?>'type="text" name = "num3" maxlength="1" required>
                    <input class='<?php if($error) echo "error"?>'type="text" name = "num4" maxlength="1" required><br>
                    <input type="submit" name = "submit" value="send">
                </form>
            </div>
        </div> 
        <div class="resend">
            <p class="question"> if you didn't get any email ?<a href="view_main.php" class="send"> Resend confirmation email</a></p>
                    <div class="errors-contain">
            <?php if($error)echo "<div class='errors'>$error</div>";?>
        </div>
        </div>

    </div>

</body>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</html>  