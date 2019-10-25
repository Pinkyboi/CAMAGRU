<?php
    include('../function/connect.php');
    include('../function/resendMail.php');
    include('../function/CreateHTMLPost.php');
    include('../function/exitSession.php');
    if(isset($_SESSION['pseudo'])){
        header("Location: viewGallery.php");
        die;
    }
    if(!isset($_GET['ID']) && !getToken($_GET['ID'],$PDO)){
        header('Location: viewIndex.php');
        die();
    }
    headCreate();
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
                                your email<br><span id="email"><?php if(isset($_SESSION['email']))echo $_SESSION['email']?></span></p><br>
                        </div>
                    </div>
                </div>
            </div>
                <div class="resend">
                    <p class="question"> if you didn't get any email ?<a id="send">
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
                var IDuser = '<?php echo $_GET['ID'] ?>';
                const link = document.querySelector('#send');
                const content = document.querySelector('.valide');
                const resend = (function(){
                var newXML = new XMLHttpRequest();
                newXML.open('GET',"../function/resendMail.php?use=1&ID="+IDuser,true);
                newXML.onreadystatechange = function(){
                    if(this.status == 200 && this.readyState == 4){
                        if(!this.responseText)
                            window.location.replace("./viewIndex.php");
                        content.innerHTML = this.responseText;
                        content.style.opacity = 1;
                        setTimeout(function(){ content.style.opacity = 0; }, 5000);
                    }
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