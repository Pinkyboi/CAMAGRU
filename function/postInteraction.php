<?php
    include('connect.php');
    session_start();
    function getInfoOwner(&$email, &$pseudo, $PDO){
        $statement2 = "SELECT USER FROM  `images` WHERE ID = ?";
        $commentedID = $PDO->statementPDO($statement2,array($_GET['postID']));
        $statement3 = "SELECT `pseudo` FROM `users` WHERE ID = ?";
        $pseudo = $PDO->statementPDO($statement3,array($commentedID[0]));
        $statement4 = "SELECT `email` FROM `users` WHERE ID = ?";
        $email = $PDO->statementPDO($statement4,array($commentedID[0]));
    }

    function getNotified($PDO){
        $statement = "SELECT USER FROM  `images` WHERE ID = ?";
        $userID = $PDO->statementPDO($statement,array($_GET['postID']));
        $statement1 = 'SELECT `notification` FROM `users` WHERE ID = ?';
        $notif = $PDO->statementPDO($statement1,array($userID[0]));
        return $notif[0];
    }

    if($_GET['use'] == 'delete' && $_GET['postID'] && $_SESSION['pseudo']){
        $statement   = "SELECT `USER` FROM images WHERE ID = ?";
        $field = array($_GET['postID']);
        $userID = $PDO->statementPDO($statement,$field);
        $statement1  = "SELECT pseudo FROM users WHERE ID = ?";
        $field1 = array($userID['USER']);
        $user = $PDO->statementPDO($statement1,$field1);
     
        if($user['pseudo'] === $_SESSION['pseudo']){
            $statement2 = 'SELECT `Path` FROM `images` WHERE ID = ?';
            $statement3 = 'DELETE FROM `comment` WHERE imageID = ?';
            $statement4 = 'DELETE FROM `likes`   WHERE imageID = ?';
            $statement5 = 'DELETE FROM `images`   WHERE ID = ?';
            $statementArray = array($statement2,$statement3,$statement4,$statement5);
            foreach($statementArray as $state){
                $field2 = array($_GET['postID']);
                if($state === 'SELECT `Path` FROM `images` WHERE ID = ?'){
                    $link = $PDO->statementPDO($state,$field2,1);
                    unlink($link['Path']);
                }    
                else
                    $PDO->statementPDO($state,$field2);                  
            }
        }
    }

    if($_GET['use'] == 'like' && $_GET['postID'] && $_SESSION['pseudo']){
        try{
            $statement = "SELECT ID FROM users WHERE pseudo = ?";
            $field = array($_SESSION['pseudo']);
            $userID = $PDO->statementPDO($statement,$field);
            $statement2 = "SELECT `pseudo` FROM `users` WHERE ID = ?";
            $pseudo = $PDO->statementPDO($statement2,array($userID[0]));
            $statement = "SELECT USER FROM `likes` WHERE imageID = ? AND `USER` = ?";
            $field = array($_GET['postID'],$userID['ID']);
            $liked = $PDO->statementPDO($statement, $field);
            if($liked['USER']){
                $statement2 = "DELETE FROM `likes` WHERE `USER` = ? AND imageID = ?";
                $field2 = array($userID['ID'],$_GET['postID']);
                $PDO->statementPDO($statement2, $field2);
            }
            else{
                $statement1 = "INSERT INTO `likes` VALUES (NULL,?,?)";
                $field1 = array($_GET['postID'],$userID['ID']);
                $PDO->statementPDO($statement1, $field1);
                if(getNotified($PDO)){
                    getInfoOwner($email, $pseudo, $PDO);
                    $mail->likeMail($pseudo[0],$_SESSION['pseudo'],$email[0],$_GET['postID']);
                }
            }            
        }
        catch(Exeption $e){}
    }
    if($_GET['use'] == 'comment' && $_GET['postID'] && $_SESSION['pseudo'] && $_GET['comment']){
        try{
            $comment = $_GET['comment'];
            $statement = "SELECT ID FROM users WHERE pseudo = ?";
            $field = array($_SESSION['pseudo']);
            $userID = $PDO->statementPDO($statement,$field);
            $statement = "INSERT INTO  `comment` VALUES(NULL,?,?,?,?)";
            $field = array($userID['ID'],$comment,$_GET['postID'],uniqid());
            $PDO->statementPDO($statement,$field);
            if(getNotified($PDO)){
                getInfoOwner($email, $pseudo, $PDO);
                $mail->commentMail($pseudo[0],$_SESSION['pseudo'],$email[0],$_GET['postID']);
            }            
        }
        catch(Exeption $e){}
    }
    if($_GET['use'] == 'block' && $_GET['postID']){
        try{
            $statement = "SELECT ID FROM users WHERE pseudo = ?";
            $field = array($_SESSION['pseudo']);
            $userID = $PDO->statementPDO($statement,$field);
            $statement2   = "SELECT `USER` FROM images WHERE ID = ?";
            $field = array($_GET['postID']);
            $blockedID = $PDO->statementPDO($statement2,$field);
            $statement = "INSERT INTO `block` VALUES (NULL,?,?)";
            $field = array($userID[0],$blockedID[0]);
            $PDO->statementPDO($statement,$field,0);
        }
        catch(Exeption $e){}
    }
    if($_GET['use'] == 'commentDel' && $_GET['commentID']){
        try{
            $commentID = $_GET['commentID'];
            $statement = "DELETE FROM comment WHERE comment_id = ?";
            $field = array($commentID);
            $PDO->statementPDO($statement,$field,0);           
        }
        catch(Exeption $e){}
    }
?>