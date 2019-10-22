<?php
class Gallery{
    public $data;
    public function __construct($PDO,$index,$number=2,$userID=0){
        if($number == 2){
            if($userID)
                $statement = "SELECT * FROM images WHERE USER NOT IN (SELECT blocked_id FROM block WHERE blocker_id = $userID) LIMIT 5 OFFSET ?";
            else
                $statement = "SELECT * FROM `images` LIMIT 5 OFFSET ?";
            $_PDOverif = $PDO->_PDO->prepare($statement);
            $offset = array($index);
            $_PDOverif->execute($offset);            
        }
        else if($number == 1){
            $statement = "SELECT * FROM `images` WHERE ID = ?";
            $_PDOverif = $PDO->_PDO->prepare($statement);
            $offset = array($index);
            $_PDOverif->execute($offset);   
        }
        else if($number == 3){
            $statement = "SELECT * FROM `images` WHERE USER NOT IN (SELECT blocked_id FROM block WHERE blocker_id = $userID)AND ID = ?";
            $_PDOverif = $PDO->_PDO->prepare($statement);
            $offset = array($index);
            $_PDOverif->execute($offset);    
        }
        else if($number == 4){
            $statement = "SELECT * FROM `images` WHERE USER = ?";
            $_PDOverif = $PDO->_PDO->prepare($statement);
            $offset = array($index);
            $_PDOverif->execute($offset);   
        }
        $datas = $_PDOverif->fetchAll();
        $this->PDO = $PDO;
        $this->connectData = $datas;
    }
    public function deletePost($data){
        $statement = 'DELETE FROM `images` WHERE ID = ?';
        $postID = $data['ID'];
        $field = array($postID);
        $userQuery = $this->PDO->statementPDO($statement,$field,0);
    }
    public function selectProfileName($data){
        $statement = 'SELECT `pseudo` FROM `users` WHERE ID = ?';
        $userID = $data['USER'];
        $field = array($userID);
        $userQuery = $this->PDO->statementPDO($statement,$field);
        $name = explode(' ',$userQuery['pseudo']);
        $userName = end($name);
        return($userName);
    }
    public function selectImage($data){
        $profileLink = $data['Path']; 
        $PathLink = explode(' ',$profileLink);
        $Path = end($PathLink);
        return($Path);
    }
    public function selectProfileImage($data){
        $statement = 'SELECT `profile` FROM `users` WHERE ID = ?';
        $userID = $data['USER'];
        $field = array($userID);
        $userQuery = $this->PDO->statementPDO($statement,$field);
        $name = explode(' ',$userQuery['profile']);
        $userName = end($name);
        return($userName);
    }
    public function checkLikes($data, $pseudo='none',$use = 1){
        $imageID = $data['ID'];
        if($use == 1){
            $statement = 'SELECT COUNT(*) AS COUNT FROM `likes` WHERE imageID = ?';
            $field = array($imageID);
        } 
        else if($use == 2){
            $statement1 = "SELECT ID FROM `users` WHERE pseudo = ?";
            $field1 = array($pseudo);
            $IDQuery = $this->PDO->statementPDO($statement1,$field1,1);
            $statement = "SELECT * FROM `likes` WHERE imageID = ? AND `USER` = ?";
            $field = array($imageID,$IDQuery['ID']);   
        }
        $userQuery = $this->PDO->statementPDO($statement,$field,1);
        return (($use == 1) ? $userQuery['COUNT'] : $userQuery);
    }
    public function checkComments($data,$use = 1){
        if($use == 1)
            $statement = 'SELECT COUNT(*) AS COUNT FROM `comment` WHERE imageID = ?';
        else if($use == 2)
            $statement = 'SELECT * FROM `comment` WHERE imageID = ?';
        $imageID = $data['ID'];
        $field = array($imageID);
        $userQuery = $this->PDO->statementPDO($statement,$field,$use);
        return (($use == 1) ? $userQuery['COUNT'] : $userQuery);
    }
}