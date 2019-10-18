<?php
    include('../function/connect.php');
    include("../function/validateImage.php");
    include('../function/verifieRegistration.php');
    include('../function/registerSend.php');
    include('../function/CreateHTMLPost.php');
    session_start();
    try{
        if($_SESSION['pseudo']){
                header("Location: viewGallery.php");
                die ;
        }
        if($_POST['submitLogin']){
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
        else if($_POST['submitRegistration']){
                $errorRegistation = array('errpsdo'=>$errpsdo,'errmail'=>$errmail,'errpass'=>$errpass);
                        if(ft_verifie_field($_POST,$PDO,$errorRegistation)){
                                send($_POST,$_SESSION,$PDO);
                                $_SESSION['sent'];
                                $mail->verificationMail($_SESSION['email'],$_SESSION['pseudo'],$_SESSION['ID'], $_SEESION['token']);
                                header("Location: viewMail.php?ID={$_SESSION['ID']}");
                                die();
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
        <div class="container loginCard">

                <div style = 'padding-bottom: 10px' class="resend">
                        <p class="galleryLink question">not convinced yet ? <a id="send"
                                href="./viewGallery.php">take a look at our gallery</a>
                        </p>                        
                </div>        
                        <div class="loginBundel">
                        <div class="row">
                                        <div class="no-padding col-sm-12 col-md-5">
                                                <div class="registration">
                                                        <img id="miniLogo" src="../imgs/logo-mini.svg" alt="logo-camagru">
                                                        <form class="registionForm" action="viewIndex.php" method="POST">
                                                                <input class="<? if($errorRegistation['errpsdo']) echo 'errorField'?>"name="userRegistration" type="text"
                                                                        placeholder="username" value=<? if(!$_SESSION['sent']) echo htmlentities($_POST['userRegistration'])?>><br>
                                                                <input class="<? if($errorRegistation['errmail']) echo 'errorField'?>" type="email" name="emailRegistration" placeholder="email" value=<? if(!$_SESSION['sent']) echo htmlentities($_POST['emailRegistration'])?>><br>
                                                                <input class="<? if($errorRegistation['errpass']) echo 'errorField'?>" type="password" name="passwordRegistration"
                                                                        placeholder="password"><br>
                                                                <input type="password" name="confirmPasswordRegistartion"
                                                                        placeholder="confirm your password"><br>
                                                                <input type="submit" name="submitRegistration" value="register">
                                                                <div style="top:12px" class="clearHiden">
                                                                        <div onclick="clearSwitch1(this)" class="clearSwitch">already have an account ? <span>Sign in</span></div>  
                                                                </div>
                                                        </form>
                                                </div>
                                                <div class="errorRegister errorContainer">
                                                        <?php
                                                        if($errorRegistation){
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
                                                <img id="miniLogo" src="../imgs/logo-mini.svg" alt="logo-camagru">
                                                <form class="loginForm" action="viewIndex.php" method="POST">
                                                        <input class="<? if($errorLogin) echo 'errorField'?>" type="text" name="accountName"
                                                                        placeholder="email or username"value=<? echo $_POST['accountName']?>><br>
                                                        <input class="<? if($errorLogin) echo 'errorField'?>" type="password" name="passwordLogin" id=""
                                                                        placeholder="password"><br>
                                                        <input type="submit" name="submitLogin" value="login">
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
                                                        if($errorLogin)
                                                                echo "<div id='loginError'class='error'><p>$errorLogin</p></div>";
                                                ?>
                                        </div>
                                </div>
                        </div>                       
                </div>
        </div>
        <footer class="footer">© 2019 CAMAGRU</footer>
</body>
<script>
        (function(){
                let hider = document.querySelector('.hider');
                let login = document.querySelector('.login');
                hider.style.width = 408 + "px";
                let leftError = document.querySelector('#loginError');
                let rightError = document.querySelector('#registerError');
                if(typeof(leftError) != 'undefined' && leftError != null){
                        switchCase();
                        console.log(leftError.innerHTML.length)
                }
        }());
</script>
</html>