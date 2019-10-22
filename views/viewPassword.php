<?php
    include("../function/connect.php");
    include('../function/CreateHTMLPost.php');
    include('../function/exitSession.php');   
    headCreate();
    echo '<body>';
    navbar();

?>
    <div class="container mail">
        <div id="card">
            <div class="row">
                <div class="no-padding col-sm-12">
                    <div class="field">
                        <div class="confirm-message">
                            <div class="logo"><img src="../imgs/password.png"></div>
                            <h1 class="title">Reset your password</h1><br>
                            <p>An email will be send to you with instruction on how reset your password.<br>
                                <form onsubmit = "emailResend(event)"class="send-email" action="view_password.php" method="GET">
                                    <input  style="margin-top: 20px;"class="emailRessend" type="email" name="email"
                                        placeholder="Enter your email address"><br>
                                    <input type="submit" value='send' id='passwordEmailSend' name="reset-request-submit">
                                    <div style="margin-top: 5px" class="loginError errorContainer">
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>
</html>