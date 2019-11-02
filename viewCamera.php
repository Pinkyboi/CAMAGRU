<?php        
        include('./function/connect.php');
        include('./function/CreateHTMLPost.php');
        include('./function/imageUpload.php');
        include('./function/createImage.php');
        include('./function/exitSession.php');
        try{
                verifyLink($_SERVER['PHP_SELF']);
                mailResend($PDO);
                if(!isset($_SESSION['profile'])){
                        header('Location: viewIndex.php');
                        die;    
                }
                else if(isset($_POST['submitButton']))
                        verifyNewPost($_SESSION,$_POST,$PDO);
                $time = $_SESSION['time'] = time();                
        }
        catch(Exeption $e){}
        headCreate();
        echo "<body class='camBody' onresize='adaptSticker()' onkeydown='moveSticker(event)'>";
        navbar();
        if(isset($_SESSION['pseudo']))
                youCanEdit($_SESSION,$PDO,$_SERVER['PHP_SELF']); 
?>
        <div class="cam container">
                <div class="row">
                        <div class="no-padding col-md-8">
                                <div class="fix-cam">
                                        <div class="row">
                                                <div class="no-padding col-sm-12">
                                                        <div onload='changePos()'class="takePic">
                                                                <div class="stickerBundel">
                                                                        <video id="video"></video>
                                                                        <canvas id="canvasUpload" ></canvas>
                                                                        <div class="sticker"></div>
                                                                </div>
                                                                <div class="arrows">
                                                                        <div class="leftArrow"></div>
                                                                        <div class="rightArrow"></div>
                                                                </div>
                                                                <div class="choices">
                                                                        <button   id="startButton">Take a picture</button>
                                                                        <button onclick="hideThePic()"id="saveButton">Save</button>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="no-padding col-sm-12">
                                                        <div id="containUpload">
                                                                <div onclick="uploadImage()" class="uploadBundel">
                                                                        <button id="uploadButton">upload an images</button>
                                                                        <form class="form" action="view_change_info.php" method="post" enctype="multipart/form-data">
                                                                                <input onChange="displayOnCanva(this)" id="imagesUpload" type="file" name="profile"><br>
                                                                        </form>
                                                                        <div id="upload">
                                                                                <img id="uploadIcon" src="/imgs/uploadIcon.png" alt="">
                                                                        </div>
                                                                        
                                                                </div>                                                                
                                                        </div>         
                                                </div>
                                        </div>
                                        <div class="row">
                                                <div class="no-padding col-sm-12">
                                                        <div class="thePic">
                                                                <div class="stickerBundel">
                                                                        <canvas id="canvas"></canvas>
                                                                        <div class="sticker2"></div>
                                                                </div>
                                                                <div class="choices">
                                                                        <form method="POST" action='./viewCamera.php'>
                                                                                <input type="hidden" name="time" value="<?php echo $time; ?>" />
                                                                                <input type="hidden" class='encodedCanva' name="encodedCanva">
                                                                                <input type="hidden" name="posY" class="posY" >
                                                                                <input type="hidden" name="posX" class="posX" >
                                                                                <div class="sticker-input">
                                                                                        <input class="dio" type="radio"
                                                                                                name="sticker" value="0"
                                                                                                >
                                                                                        <input class="gnomed"
                                                                                                type="radio"
                                                                                                name="sticker"
                                                                                                value="1">
                                                                                        <input class="punpun"
                                                                                                type="radio"
                                                                                                name="sticker"
                                                                                                value="2">
                                                                                        <input class="ricardo"
                                                                                                type="radio"
                                                                                                name="sticker"
                                                                                                value="3">
                                                                                        <input class="toby" type="radio"
                                                                                                name="sticker"
                                                                                                value="4">
                                                                                        <input class="trump-pepe"
                                                                                                type="radio"
                                                                                                name="sticker" value="5">
                                                                                </div>
                                                                                <input type='submit' onclick='saveThePic(event)' id="submitButton" name='submitButton' value='Submit'>
                                                                        </form>
                                                                        <button onclick="hidePic()"
                                                                                id="cancelButton">Cancel</button>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="no-padding col-md-4">
                                <div class="clean-preview">
                                        <div class="preview">
                                        <?php
                                                try{
                                                        $statement  = 'SELECT ID FROM `users` WHERE pseudo = ?';
                                                        $fields = array($_SESSION['pseudo']);
                                                        $time =1;
                                                        $index = $PDO->statementPDO($statement,$fields);
                                                        $gallery = new Gallery($PDO,$index['ID'],4);
                                                        $datas = $gallery->connectData;
                                                        echo "<div class='parent'>";
                                                        foreach ($datas as $data)
                                                                allMiniPost($data,$gallery,$_SESSION,0,$time);
                                                        echo "</div>";
                                                        youCanDelete();                                                   
                                                }
                                                catch(Exeption $e){}
                                        ?>
                                        </div>
                                </div>
                                <input class="copyField" style="opacity:0" type="text">
                        </div>
                </div>
        </div>
        <div class="focus"></div>
        <footer class="footer">© 2019 CAMAGRU</footer>
</body>
        <script src="cam.js"></script>
        <script>
 
        </script>
</html>