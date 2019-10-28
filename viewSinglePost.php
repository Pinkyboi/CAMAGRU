<?php
    include('./function/CreateHTMLPost.php');
    include('./function/exitSession.php');
    try{
        verifyLink($_SERVER['PHP_SELF']);
        if(isset($_FILES['profile']['name'])){
                uploadImage($_FILES,$_SESSION,$PDO,'profile');
                $_SESSION['profile'] = profilePic($_SESSION,$PDO);
        }              
        if(isset($_GET['id']))
        {
                $index = $_GET['id'];
                if(isset($_SESSION['pseudo'])){
                        $statement = "SELECT ID FROM users WHERE pseudo = ?";
                        $field = array($_SESSION['pseudo']);
                        $userID = $PDO->statementPDO($statement,$field);
                        $index = $_GET['id'];
                        $gallery = new Gallery($PDO,$index,3,$userID[0]);
                }
                else
                        $gallery = new Gallery($PDO,$index,1);
                $datas = $gallery->connectData;
                if(!empty($datas)){
                        headCreate();
                        navbar($_SESSION);
                        echo "<div class='container main'>";
                        echo "<div class='parent'>";
                        echo "<input class='copyField' style='opacity:0'type='text'>";
                        echo'<body>';
                        viewSinglePost($datas[0],$gallery,$_SESSION,1);
                        if(isset($_SESSION['pseudo']))
                                youCanEdit($_SESSION,$PDO,"{$_SERVER['PHP_SELF']}?id={$_GET['id']}"); 
                        youCanDelete();
                        youCanBlock();                         
                }
                else{
                   header('Location: ./viewGallery.php');
                   die ;
                }
                
        }
    }
    catch(Exeption $e){}
        
    echo "</div>";
    echo "</div>";
    echo "<div class='focus'></div>";
    echo "<footer class='footer'>© 2019 CAMAGRU</footer>";
?>
</body>
        <script>
                var verifVar = 0;
                var index = 0;
                const resend = (function(statement,use=0){
                var newXML = new XMLHttpRequest();
                newXML.open('GET',statement,true);
                newXML.onreadystatechange = function(){
                    if(this.status == 200 && this.readyState == 4){
                        if(use === 1){
                                jsonMessage = JSON.parse(this.responseText);
                                displayErrorChange(jsonMessage)                                            
                        }
                        if(use === 2){
                                childs = document.createElement('div');
                                childs.classList.add('removableDiv');
                                childs.innerHTML =  this.responseText;
                                parent = document.querySelector('.parent');
                                parent.appendChild(childs);
                                unwrap(document.querySelector('.removableDiv'));
                        }
                    }
                    
                }
                newXML.send();
                });
        </script>
</html>