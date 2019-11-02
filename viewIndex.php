<?php
    include('./function/connect.php');
    include("./function/validateImage.php");
    include('./function/verifieRegistration.php');
    include('./function/registerSend.php');
    include('./function/CreateHTMLPost.php');
        try{
                verifyLink($_SERVER['PHP_SELF']);
                if(isset($_SESSION['pseudo'])){
                        header("Location: viewGallery.php");
                        die ;
                }
                if(isset($_POST['submitLogin'])){
                        unset($_SESSION['sent']);
                        $statement = "SELECT * FROM users WHERE (pseudo = ? AND passwrd = ?) OR (email = ? AND passwrd = ?)";
                        $password = hash('whirlpool',$_POST['passwordLogin']);
                        $field = array(htmlentities($_POST['accountName']),$password,htmlentities($_POST['accountName']),$password);
                        $verif = $PDO->statementPDO($statement,$field);
                        if(!$verif){
                        if($PDO->verifyPDO('users','email',$_POST['accountName']) || $PDO->verifyPDO('users','pseudo',$_POST['accountName']))
                                $errorLogin = "Sorry, that password isn't right";
                        else
                                $errorLogin = "Sorry, no account correspond";         
                        }
                        else{
                                if($verif['token']){
                                        send('',$_SESSION,$PDO,1,$verif['token']);
                                        header("Location: viewMail.php?ID={$_SESSION['ID']}");    
                                }  
                                else{
                                        $_SESSION['pseudo'] = $verif['pseudo'];
                                        $_SESSION['email']  = $verif['email'];
                                        $_SESSION['profile'] = profilePic($_SESSION,$PDO);
                                        header("Location: viewGallery.php");     
                                }
                        die();
                        }  
                }
                else if(isset($_POST['submitRegistration'])){
                        $errpsdo = '';
                        $errmail = '';
                        $errpass = '';
                        $errorRegistation = array('errpsdo'=>$errpsdo,'errmail'=>$errmail,'errpass'=>$errpass);
                        if(ft_verifie_field($_POST,$PDO,$errorRegistation)){
                                send($_POST,$_SESSION,$PDO);
                                $mail->verificationMail($_POST['emailRegistration'], $_POST['userRegistration'], $_SESSION['ID'], $_SESSION['token']);
                                header("Location: viewMail.php?ID={$_SESSION['ID']}");
                                die ;
                        }             
                }
                        
        }
        catch(Exeption $e){}
        headCreate();
          
?>

<body onload='loginResposive()' onresize="loginResposive()">
        <?php
            navbar($_SESSION);    
        ?>
        <div class="resend">
                 <p class="galleryLink question">not convinced yet ? <a id="send"
                        href="./viewGallery.php">take a look at our gallery</a>
                </p>                        
        </div>
        <div class="loginContain">
                <div class="container loginCard"> 
                        <div class="loginBundel">
                                <div class="row">
                                                <div class="no-padding col-sm-12 col-md-5">
                                                        <div class="registration">
                                                                <img id="miniLogo" src="/imgs/logo-mini.svg" alt="logo-camagru">
                                                                <form class="registionForm" action="viewIndex.php" method="POST">
                                                                        <input autocomplete="off" class="<?php if(isset($errorRegistation['errpsdo'])) echo 'errorField'?>"name="userRegistration" type="text"
                                                                                placeholder="username" value="<?php if(!isset($_SESSION['sent']) && isset($_POST['userRegistration'])) echo htmlentities($_POST['userRegistration'])?>"><br>
                                                                        <input autocomplete="off" class="<?php if(isset($errorRegistation['errmail'])) echo 'errorField'?>" type="email" name="emailRegistration" placeholder="email" value="<?php if(!isset($_SESSION['sent']) && isset($_POST['emailRegistration'])) echo htmlentities($_POST['emailRegistration'])?>"><br>
                                                                        <input autocomplete="off" class="<?php if(isset($errorRegistation['errpass'])) echo 'errorField'?>" type="password" name="passwordRegistration"
                                                                                placeholder="password"><br>
                                                                        <input autocomplete="off" type="password" name="confirmPasswordRegistartion"
                                                                                placeholder="confirm your password"><br>
                                                                        <input autocomplete="off" type="submit" name="submitRegistration" value="register">
                                                                        <div style="top:12px" class="clearHiden">
                                                                                <div onclick="clearSwitch1(this)" class="clearSwitch">already have an account ? <span>Sign in</span></div>  
                                                                        </div>
                                                                </form>
                                                        </div>
                                                        <div class="errorRegister errorContainer">
                                                                <?php
                                                                if(isset($errorRegistation)){
                                                                        foreach($errorRegistation as $err){
                                                                                if($err)
                                                                                        echo "<div id='registerError' class='error'>$err</div>";
                                                                        }                                                         
                                                                }
                                                                ?>
                                                        </div>
                                                </div>                                        
                                        <div class="hideContain no-padding col-md-2">
                                        <div class="hider">
                                                <div class="hidenElement">
                                                        <div class="litteralHiden">
                                                                <h1 class="Welcome">Welcome !</h1>
                                                                <p class="discription">to CAMAGRU the 42 web project</p>            
                                                        </div>
                                                        <div onClick="switchCase()"class="switch">already have an account ? <span>Sign in</span></div>     
                                                </div>
                                        </div>
                                        </div>
                                        <div class="no-padding col-sm-12 col-md-5">
                                                <div class="login">
                                                        <img id="miniLogo" src="/imgs/logo-mini.svg" alt="logo-camagru">
                                                        <form class="loginForm" action="viewIndex.php" method="POST">
                                                                <input autocomplete="off" class="<?php if(isset($errorLogin)) echo 'errorField'?>" type="text" name="accountName"
                                                                                placeholder="email or username"value="<?php if(isset($_POST['accountName']))echo $_POST['accountName']?>"><br>
                                                                <input autocomplete="off" class="<?php if(isset($errorLogin)) echo 'errorField'?>" type="password" name="passwordLogin" id=""
                                                                                placeholder="password"><br>
                                                                <input autocomplete="off" type="submit" name="submitLogin" value="login">
                                                                <div class="passwordText">
                                                                <a href="./viewPassword.php">did you forgot your password </a>    
                                                                </div>
                                                                <div class="clearHiden">
                                                                        <div onclick="clearSwitch2(this)"class="clearSwitch">don't have an account yet ?<span>Sign up</span></div>  
                                                                </div>
                                                        </form>     
                                                </div>
                                                <div class="errorLogin errorContainer">
                                                        <?php
                                                                if(isset($errorLogin))
                                                                        echo "<div id='loginError'class='error'><p>$errorLogin</p></div>";
                                                        ?>
                                                </div>
                                        </div>
                                </div>                       
                        </div>
                </div>
        </div>
       <footer class="footer">© 2019 CAMAGRU</footer> 
</body>

<script>
        (function(){
                var hider = document.querySelector('.hider');
                var login = document.querySelector('.login');
                hider.style.width = 408 + "px";
                var leftError = document.querySelector('#loginError');
                var rightError = document.querySelector('#registerError');
                if(typeof(leftError) != 'undefined' && leftError != null){
                        switchCase();
                }
        }());
</script>
</html>