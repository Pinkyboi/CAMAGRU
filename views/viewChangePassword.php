<?
    include('../function/connect.php');
    include('../function/verifieRegistration.php');
    include('../function/CreateHTMLPost.php');
    try{
        $statement = "SELECT * FROM `password_reset` WHERE token = ? AND email = ?";
        $field = array($_GET['token'],$_GET['email']);
        if(!$_GET['token'] || !$_GET['email'] || !$PDO->statementPDO($statement,$field)){
            header('Location: ./viewIndex.php');
            die; 
        }
        else{
            $token = $_GET['token'];
            $email = $_GET['email'];
        }        
    }
    catch(Exeption $e){}
    headCreate();
    echo '<body>';
    session_start();
    navbar($_SESSION); 
?>
<script>
    
</script>
<div class="container mail">
        <div id="card">
            <div class="row">
                <div class="no-padding col-sm-12">
                    <div class="field" style='padding-top:80px'>
                        <div class="confirm-message">
                            <div style='margin-right: 25px;' class="logo"><img src="../imgs/lock.png" alt=""></div>
                            <h1 class="title">Change your password</h1><br>
                            <p>Welcome back! in the fields bellow enter your new password and confirm it.<br><span style='font-weight:600'><?php echo $_SESSION['email']?></span></p><br>
                        </div>
                        <form onsubmit = "passwordResend(event)">
                            <input type="hidden" id='token' value = "<?php echo $token?>">
                            <input type="hidden" id='email' value = "<?php echo $email?>">
                            <input class="passwordResend" type="password" name="email" placeholder="Enter your new password"><br>
                            <input class="passwordResend" type="password" name="email" placeholder="Confirm your password"><br>
                            <input type="submit" style='margin-top:15px' value='send' id='passwordEmailSend' name="reset-request-submit">
                            <div class="resendPassword">
                                <div class="resendQuestion">
                                   <p class="question">Go to <a href="./viewIndex.php" id="send">login</a> 
                                </div>
                            </div>                            
                                    <div style="margin-top: 5px" class="loginError errorContainer">
                                    </div>
                        </form>
                        <div class="errorContainer"></div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</html>