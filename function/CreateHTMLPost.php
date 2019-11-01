<?php
        include('connect.php');
        @session_start();

        function verifyLink($link){
                $slashTime = substr_count($link,'/');
                if($slashTime != 1){
                        $slashUrl = explode('/',$link);
                        $newLink = $slashUrl[1];
                        header("Location: http://".$_SERVER['HTTP_HOST'].'/'.$newLink);
                        die ; 
                }
        }

        function mailResend($PDO){
                try{
                        if($_SESSION['pseudo']){
                                $statement = 'SELECT * FROM users WHERE pseudo = ?';
                                $field = array($_SESSION['pseudo']);
                                $info = $PDO->statementPDO($statement,$field);
                                if($info['token']){
                                        unset($SESSION);
                                        session_destroy();
                                        session_write_close();
                                        header("Location: viewMail.php?ID={$info['ID']}");
                                        die ;
                                }
                                else if(!$info['pseudo']){
                                        unset($SESSION);
                                        session_destroy();
                                        session_write_close();
                                        header("Location: viewIndex.php");
                                        die ;
                                }                                
                        }
                }
                catch(Exeption $e){}
        }

        function headCreate(){
                $head = "<!DOCTYPE html><html lang='en'><head>";
                $head .="<meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'>";
                $head .= "<meta http-equiv='X-UA-Compatible' content='ie=edge'>";
                $head .= "<link rel='stylesheet' href='tremplet.css'>";
                $head .= "<link rel='icon' type='image/png' href='/favicon.png' />";
                $head .= "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'";
                $head .= "integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T'crossorigin='anonymous'>";
                $head .= "<script src='templet.js'></script>";
                $head .= "<title>CAMAGRU</title></head>";
                echo $head;
        }
        function navbar(){
                $navbar ="<nav class='navbar navbar-dark'><div class='container'>";
                if(isset($_SESSION['profile'])){
                    $navbar .="<a class='navbar-brand' href='./viewGallery.php'><img src='/imgs/log-logo.svg' alt=''></a>";
                    $navbar .="<div style='display:inline-flex'class='intractionAccount'>";
                    $navbar .="<div class='navProfile' >";
                    $navbar .="<img class='mignature' onclick='displayChange()' src= {$_SESSION['profile']} alt='profile-image'>";
                    $navbar .= "<a href='./viewCamera.php'><img class='camIcon' src='/imgs/camera-icon.png' alt=''></a>";
                    $navbar .="<img class='exitIcon' onclick='disconnect()' src='/imgs/exit.svg' alt=''>";
                    $navbar .="</div></div></div>";
                }
                else
                        $navbar .="<a class='navbar-brand' href='./viewIndex.php'><img src='/imgs/log-logo.svg' alt=''></a>";
                $navbar .="</div>";
                $navbar .="</nav>";
                echo $navbar;
        }
        function postUser($postID,$userImage,$userName,$SESSION){
                $userName = htmlentities($userName);
                $postUser  = "<div class='user'><div class='row'><div class='no-padding col-sm-12'>";
                $postUser .= "<div class='profile'><img class='mignature'src=$userImage alt='profile-image'>";
                $postUser .= "<div class='name'>$userName</div>";
                if(isset($SESSION['pseudo']) && $SESSION['pseudo'] == $userName){     
                        $postUser .= "<img onclick='deletePublication(this)'class='delete-icon' src='/imgs/delete-icon.png' alt='delete-icon'>";
                        $yourPost = $postID;                
                }
                else{
                        if(isset($SESSION['pseudo']))
                                $postUser .= "<img onclick='blockUser(this)'class='delete-icon' src='/imgs/more.png' alt='delete-icon'>";
                        $yourPost = 0;    
                }
                                                                                
                $postUser .="</div></div></div></div>";
                echo $postUser;
                return($yourPost);     
        }

        function postImage($postImage,$postID,$use=0){
                $post  = "<div class='row'><div class='no-padding col-sm-12'><div class='content no-padding'>";
                if(!$use)
                $post .= "<a href='viewSinglePost.php?id=$postID'><img class='no-padding img-responsive'src='$postImage' alt='content-image'></a>";
                else
                $post .= "<img class='no-padding img-responsive'src='$postImage' alt='content-image'>";
                $post .= "</div></div>";
                echo $post;       
        }

        function postLike($postLikes,$persoLike,$SESSION){
                $Like = "<div class='row'><div class='no-padding col-sm-3'>";
                if(isset($SESSION['pseudo'])){
                        $like  = "<div class='likes'>";
                        $like .= "<img onclick ='likesQuery(this)' class='logo'";
                        if(!$persoLike)
                                $like .= "src='/imgs/heart.svg' alt='like'>";
                        else
                                $like .= "src='/imgs/full-heart.svg' alt='like'>";
                        $like .= "<div class='likeNumber'>$postLikes</div>";
                        $like .= "<img onclick = 'copyLink(this)' class='logo' src='/imgs/send.svg' alt='like'>";
                        $like .= "<div class='likeNumber copiedLink'>link copied</div>";
                        $like .= "</div>";
                        
                        
                }
                else{
                        $like  = "<a href='./viewIndex.php' class='likes'>";
                        $like .= "<img class='logo'src='/imgs/heart.svg' alt='like'>";
                        $like .= "<div class='likeNumber'>$postLikes</div>";
                        $like .= "</a>";     
                }
                $like .= "</div><hr>";
                echo $like;      
        }

        function postComment($postID,$listComments,$gallery,$SESSION,$PDO){
                echo "<div class='comment'>";
                foreach($listComments as $commenter){
                        $commenterName = htmlentities($gallery->selectProfileName($commenter,$PDO));
                        $commentMessage = htmlentities($commenter['COMMENT']);
                        $commentUniqId = htmlentities($commenter['comment_id']);
                        $comment  = "<div class='singleComment'><div class='row'>";
                        $comment .= "<div class='no-padding col-sm-12'><div class='profile'>";
                        $comment .= "<img class='mignature'src='{$gallery->selectProfileImage($commenter,$PDO)}'alt='profile-image'>";
                        $comment .= "<div class='name'>$commenterName</div>";
                        if(isset($SESSION['pseudo']) && $SESSION['pseudo'] == $commenterName){
                                $comment .= "<div onclick='delcomment(this)' class='name delcom'>
                                <div style='display:none;'>$commentUniqId</div>
                                <img style ='width:10px;'src='/imgs/delete-icon.png' alt='delete-icon'></div>";                                
                        }
                        $comment .= "</div></div>";
                        $comment .= "<div class='col-sm-12'><div class='quote'>{$commentMessage}";
                        $comment .= "</div></div></div></div>";
                        $haveFriends = 1;
                        echo $comment;                                 
                }
                echo "</div>";
                if(isset($haveFriends))
                        echo '<hr>';
        }

        function postBottom($SESSION){
                if(isset($SESSION['pseudo'])){
                        $bottom  = "<div class='fieldSection'><div class='row'><div class='no-padding col-sm-12'>";
                        $bottom .= "<div class='profile'><img class='mignature'src='{$SESSION['profile']}'alt='profile-image'>";
                        $bottom .= "<div class='userName'>{$SESSION['pseudo']}</div></div>";
                        $bottom .= "<textarea rows='1' col='50' onfocus='addCommentQuery(this)'type='text'placeholder='ecrivez votre commentaire'></textarea>";
                        $bottom .= "</div></div></div>";               
                }
                else
                {
                        $bottom = "<div class='connectYourself'><p class='question'>";
                        $bottom .= "<a id='send'href='./viewIndex.php'>Log in </a>to like or comment.</p></div>";

                }
                echo $bottom;

        }

        function youCanDelete(){
                $youDelete = "<div class='delConfirmation'><div class='row'>
                <div class='confirmation'>";
                $youDelete .= "<div class='no-padding col-sm-12'>";
                
                $youDelete .="<p>you are going to delete this publication, are you sure ?</p>";
                $youDelete .= "<div class='choices'>";
                $youDelete .= "<span style='display:none'></span>";
                $youDelete .= "<div class='choice delete' onclick='deletePostQuery(this)'>Delete</div><div class='choice cancel' onclick='cancel1(3)'>Cancel</div>";
                $youDelete .= "</div></div></div></div></div>";
                echo $youDelete;
        }

        function youCanBlock(){
                $youDelete = "<div class='delConfirmation'><div class='row'>
                <div class='confirmation1'>";
                $youDelete .= "<div class='no-padding col-sm-12'>";
                
                $youDelete .="<p>by blocking this user you wont be able to see his pictures, are you sure ?</p>";
                $youDelete .= "<div class='choices'>";
                $youDelete .= "<span style='display:none'></span>";
                $youDelete .= "<div class='choice delete1' onclick='blockQuery(this)'>Block</div><div class='choice cancel1' onclick='cancel1(1)'>Cancel</div>";
                $youDelete .= "</div></div></div></div></div>";
                echo $youDelete;
        }
        function youCanErease(){
                $youDelete = "<div class='delConfirmation'><div class='row'>
                <div class='confirmation2'>";
                $youDelete .= "<div class='no-padding col-sm-12'>";
                
                $youDelete .="<p>your account and all your pictures,likes and comments will be deleted, are you sure ?</p>";
                $youDelete .= "<div class='choices'>";
                $youDelete .= "<span style='display:none'></span>";
                $youDelete .= "<div class='choice delete3' onclick='delUserQuery(this)'>delete</div><div onclick=cancel1(2) class='choice cancel2'>Cancel</div>";
                $youDelete .= "</div></div></div></div></div>";
                echo $youDelete;
        }
        function youCanEdit($SESSION,$PDO,$link='/viewGallery.php'){
                $statement = "SELECT `notification` FROM users WHERE pseudo = ?";
                $field = array($SESSION['pseudo']);
                $userName = htmlentities($SESSION['pseudo']);
                $notifStatus = $PDO->statementPDO($statement,$field);
                $checked = ($notifStatus[0]=== '1')?"checked":"";
                $profilePath = $SESSION['profile'];
                $youCanEdit  = "<div class='changeBundel'>";
                $youCanEdit .= "<div class='changeCard'><div class='row'><div class='no-padding col-sm-12'>";
                $youCanEdit .= "<div id='changeForm' class='changeForm' >";
                $youCanEdit .= "<form id='uploadImage' action='/function/uploadImage.php' method='POST' enctype='multipart/form-data'>";
                $youCanEdit .= "<div onmouseover='' onclick='chooseProfile()' class='profileParent'>";
                $youCanEdit .= "<div class='profileContain'>";
                $youCanEdit .= "<div class='edit' style='background-image: url({$SESSION['profile']})'></div></div>";
                $youCanEdit .= "<input onChange='displayImage(this)' id='profileUpload' type='file' name='profile'><br>";
                $youCanEdit .= "<input value='$link' type='hidden' name='link'><br>";
                $youCanEdit .= "</form></div>";
                $youCanEdit .= "<label for='changeUser'>Your username:</label><br><div onclick='inputClick(this)' class='inputContain'>";
                $youCanEdit .= "<input onfocusout='inputInfocus(this)' placeholder='$userName' id='changeUser' type='text'name='changeUser'>";
                $youCanEdit .= "<div class='editIcon'><img src='/imgs/edit.png' alt=''></div></div><label for='changeEmail'>Your email:</label><br>";
                $youCanEdit .= "<div onclick='inputClick(this)' class='inputContain'>";
                $youCanEdit .= "<input onfocusout='inputInfocus(this)' id='changeEmail' type='email'placeholder='{$SESSION['email']}' name='changeEmail'>";
                $youCanEdit .= "<div class='editIcon'><img src='/imgs/edit.png' alt=''></div></div>";
                $youCanEdit .= "<label for='changePassword'>Change your password:</label><br><div onclick='inputClick(this)' class='inputContain'>";
                $youCanEdit .= "<input onfocusout='inputInfocus(this)' id='changePassword' type='password'placeholder='•••••••••••••' name='changePassword'>";
                $youCanEdit .= "<div class='editIcon'><img src='/imgs/edit.png' alt=''></div></div>";
                $youCanEdit .= "<label for='confirmPassword'>Confirm your password:</label><br><div onclick='inputClick(this)' class='inputContain'>";
                $youCanEdit .= "<input onfocusout='inputInfocus(this)' placeholder='confirm your new password' id='confirmPassword' type='password' name='confirmChangePassword'>";
                $youCanEdit .= "<div class='editIcon'><img src='/imgs/edit.png' alt=''></div></div>";
                $youCanEdit .= "<label style='padding-top: 2px;' for='confirmPassword'>Send notification:</label><label class='switchBox'>";
                $youCanEdit .= "<input class='checkbox' type='checkbox' id='changeNotif' $checked><span class='slider round'></span></label><br>";
                $youCanEdit .= "<div class='removeUser' onclick='ereaseUser(this)'><img style='
                margin-top: -2px;width: 15px;' padding-left='2px'; src='/imgs/deleteAccount.png'><span class='removeText' style='margin-left:2px'>delete your account.</span></div>";
                $youCanEdit .= "<div onclick='submitImage()' class='submitChange submitRound'>save the picture</div>";
                $youCanEdit .= "<div onclick='submitChanges(this)' class='submitChange'>save informations</div>";
                $youCanEdit .= "<div style='margin-top: 12px' class='loginError errorContainer'>";
                $youCanEdit .= "</div></div></div></div></div></div>";
                echo $youCanEdit;
                youCanErease();
        }
        function viewSinglePost($data,$gallery,$SESSION,$PDO,$use=0){
                $userName  = $gallery->selectProfileName($data);
                $userImage = $gallery->selectProfileImage($data);
                $postImage = $gallery->selectImage($data);
                $postLikes = $gallery->checkLikes($data,1);
                if(isset($SESSION['pseudo']))
                        $persoLike = $gallery->checkLikes($data,$SESSION['pseudo'],2);
                else
                        $persoLike = $gallery->checkLikes($data,"",2);
                $postComments = $gallery->checkComments($data,1);
                
                $listComments = $gallery->checkComments($data,2);
                echo "<div class='post'>";
                echo "<div style='display:none' class='idPost'>{$data['ID']}</div>";
                $yourPost =     postUser($data['ID'],$userImage,$userName,$SESSION);
                                postImage($postImage,$data['ID'],$use);
                                postLike($postLikes,$persoLike,$SESSION);
                                postComment($data['ID'],$listComments,$gallery,$SESSION,$PDO);
                if(isset($SESSION['pseudo']))
                        postBottom($SESSION);
                else
                        postBottom("");  
                echo "</div>";
        }
        function allMiniPost($data,$gallery,$SESSION,$use=0,&$time){
                $userName  = $gallery->selectProfileName($data);
                $userImage = $gallery->selectProfileImage($data);
                $postImage = $gallery->selectImage($data);
                $postLikes = $gallery->checkLikes($data,1);
                $persoLike = $gallery->checkLikes($data,$SESSION['pseudo'],2);
                $postComments = $gallery->checkComments($data,1);
                $listComments = $gallery->checkComments($data,2);
                echo "<div class='post'>";
                echo "<div style='display:none' class='idPost'>{$data['ID']}</div>";
                $yourPost =     postUser($data['ID'],$userImage,$userName,$SESSION);
                                postImage($postImage,$data['ID'],$use);
                                postLike($postLikes,$persoLike,$SESSION);
                echo "</div>";
        }
        if(isset($_GET['use']) && $_GET['use'] === 'reload'){
                $index = $_GET['index'];
                if(isset($_SESSION['pseudo'])){
                        $statement = "SELECT ID FROM users WHERE pseudo = ?";
                        $field = array($_SESSION['pseudo']);
                        $userID = $PDO->statementPDO($statement,$field);
                        $gallery = new Gallery($PDO,$index,2,$userID[0]);                
                }
                else
                        $gallery = new Gallery($PDO,$index,2);    
                $datas = $gallery->connectData;
                foreach ($datas as $data){
                        viewSinglePost($data,$gallery,$_SESSION,$PDO);
                }
                youCanDelete();
                if(isset($_SESSION['pseudo']) && isset($_GET['first']))
                        youCanEdit($_SESSION,$PDO);
        }
?>