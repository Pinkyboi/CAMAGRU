<?php
    include('../function/connect.php');
    include('../function/resendMail.php');
    include('../function/CreateHTMLPost.php');
    if($_SESSION['pseudo']){
        header("Location: viewGallery.php");
        die;
    }
    if(!$_GET['ID'] && getToken($_GET['ID'],$PDO)){
        header('Location: viewIndex.php');
        die();
    }
    headCreate();
    session_start();
    echo '<body>';
    navbar($_SESSION);
?>
    <div class="container mail">
        <div id="card">
            <div class="row">
                <div class="no-padding col-sm-12">
                    <div class="field">
                        <div class="confirm-message">
                            <div class="logo"><img src="../imgs/mail.png" alt=""></div>
                            <h1 class="title">Verification link sent!</h1><br>
                            <p>Your acount has been sccessfully registred to complete the precess enter the link sent to
                                your email<br><span id="email"><?php echo $_SESSION['email']?></span></p><br>
                        </div>
                    </div>
                </div>
            </div>
                <div class="resend">
                    <p class="question"> if you didn't get any email ?<a id="send"
                               href="./viewMail.php?<?php if($_SESSION['ID'])echo 'ID='.$_SESSION['ID']?><?php if($_SESSION['resend'])echo '&resend='.$_SESSION['resend']?>">
                            Resend confirmation email</a>
                    </p>
                    <div class="errorRegister errorContainer">
                            <div id='registerError' class='error valide'></div>
                    </div>
                </div>
        </div> 
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>
    <script>
        (function(){
            if('<?php echo $_GET['ID'] ?>')
                var IDuser = '<?php echo $_GET['ID'] ?>';
                const link = document.querySelector('#send');
                const content = document.querySelector('.valide');
                const resend = (function(){
                let newXML = new XMLHttpRequest();
                newXML.open('GET',"../function/resendMail.php?use=1&ID="+IDuser,true);
                newXML.onreadystatechange = function(){
                    if(this.status == 200 && this.readyState == 4){
                        content.innerHTML = this.responseText;
                        content.style.opacity = 1;
                        setTimeout(function(){ content.style.opacity = 0; }, 5000);
                    }
                    console.log(this.responseText);
                }
                
                newXML.send();
                
            });
            link.addEventListener( 'click', function(e){
                e.preventDefault();
                resend();
            })
        }());

    </script>
</html>