<?php
    include('../function/connect.php');
    function deletePost($data,$PDO){
        $statement = 'DELETE FROM `images` WHERE ID = ?';
        $postID = $data['ID'];
        $field = array($postID);
        $userQuery = $PDO->statementPDO($statement,$field,0);
    }
    function selectProfileName($data,$PDO){
        $statement = 'SELECT `pseudo` FROM `users` WHERE ID = ?';
        $userID = $data['USER'];
        $field = array($userID);
        $userQuery = $PDO->statementPDO($statement,$field);
        $userName = end(explode(' ',$userQuery['pseudo']));
        return($userName);
    }
    function selectImage($data){
        $profileLink = $data['Path']; 
        $Path = end(explode(' ',$profileLink));
        return($Path);
    }
    function selectProfileImage($data,$PDO){
        $statement = 'SELECT `profile` FROM `users` WHERE ID = ?';
        $userID = $data['USER'];
        $field = array($userID);
        $userQuery = $PDO->statementPDO($statement,$field);
        $userName = end(explode(' ',$userQuery['profile']));
        return($userName);
    }
    function checkLikes($data,$PDO,$use = 1){
        if($use == 1)
            $statement = 'SELECT COUNT(*) AS COUNT FROM `likes` WHERE imageID = ?';
        else if($use == 2)
            $statement = 'SELECT USER FROM `likes` WHERE imageID = ?';
        $imageID = $data['ID'];
        $field = array($imageID);
        $userQuery = $PDO->statementPDO($statement,$field,$use);
        return (($use == 1) ? $userQuery['COUNT'] : $userQuery);
    }
    function checkComments($data,$PDO,$use = 1){
        if($use == 1)
            $statement = 'SELECT COUNT(*) AS COUNT FROM `comment` WHERE imageID = ?';
        else if($use == 2)
            $statement = 'SELECT COMMENT FROM `comment` WHERE imageID = ?';
        $imageID = $data['ID'];
        $field = array($imageID);
        $userQuery = $PDO->statementPDO($statement,$field,$use);
        return (($use == 1) ? $userQuery['COUNT'] : $userQuery);
    }
    function GetData($_PDO){
        $statement = 'SELECT * FROM `images`';
        $_PDOverif = $_PDO->prepare($statement);
        $_PDOverif->execute();
        $datas = $_PDOverif->fetchAll();
        return($datas);
    }
    $datas = GetData($_PDO);
    foreach($datas as $data){
        $userName  = selectProfileName($data,$PDO);
        $userImage = selectProfileImage($data,$PDO);
        $postImage = selectImage($data);
        $postLikes = checkLikes($data,$PDO,1);
        $postComments = checkComments($data,$PDO,1);
        $listLikes = checkLikes($data,$PDO,2);
        $listComments = checkComments($data,$PDO,2);
    }
    // foreach($listComments as $comment){
    //     echo $comment['COMMENT'];
    // }
    foreach($listLikes as $liker){
        echo selectProfileName($liker,$PDO) . ' ';
    }
?>
    
    

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <link rel='stylesheet' type='text/css' media='screen' href='../style/gallery.css'>
    <title>Document</title>
</head>
<body><?PHP
    echo"<div class='contain'>
            <div class='profile-info'>
                <div class='mignature'><img class='profile' src=$userImage alt=''></div>
                <div class='pseudo'>$userName</div>
            </div>
            <div class='content'>
                <img src=$postImage alt=''>
            </div>
            <div class='react'>
                <div class='likes'>
                    <button class='like-button' type='submit' name='like-submit' value='like'><i><img id='like' src='../imgs/heart.svg' alt=''></i></button>
                    <div id='like-number'><p>$postLikes</p></div>
                </div>
                <div class='comments'>
                    <img id='comment' src='../imgs/comment.svg' alt=''>
                    <div id='commant-number'><p>$postComments</p></div>
                </div>
            </div>
            <div class=''></div>
        </div>";
    ?>
    
</body>
</html>