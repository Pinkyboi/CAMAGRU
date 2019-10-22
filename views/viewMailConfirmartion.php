<?php
    include('../function/connect.php');
    include('../function/CreateHTMLPost.php');
    include('../function/exitSession.php');
    headCreate();
    echo '<body>';
    navbar();
    if(!isset($_GET['token']) || !isset($_GET['ID'])){
        header('Location: ./viewIndex.php');
        die ;
    }
    else{
        try{
            $statement = "SELECT * FROM `users` WHERE  ID = ? AND token = ?";
            $field = array($_GET['ID'],$_GET['token']);
            if($PDO->statementPDO($statement,$field)){
                $statement2 = "UPDATE users SET token = 0 WHERE ID = ? AND token = ?";
                $PDO->statementPDO($statement2,$field,0);
            }
            else{
                header('Location: ./viewIndex.php');
                die();  
            }
        }
        catch(Exeption $e){}
    }
?>
    <div class="container mail">
        <div id="card">
            <div class="row">
                <div class="no-padding col-sm-12">
                    <div style="margin-top: 70px;">
                        <div class="confirm-message">
                            <div class="logo" style="margin-left:40px; padding-bottom:10px;"><img src="../imgs/validation.png" alt=""></div>
                            <h1 class="title">Your account have been Acrivated!</h1><br>
                            <p>Welcome to CAMAGRU You can connect to account now!</p><br>
                        </div>
                    </div>

                </div>
            </div>
            <div class="returnLogin">
                <p class="question"><a id="send" href="./viewIndex.php">login</a></p>
            </div>
        </div>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
</body>

</html>