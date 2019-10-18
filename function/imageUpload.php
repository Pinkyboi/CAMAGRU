<?php
    include('connect.php');

    session_start();

    function profilePic($SESSION,$PDO){
        $statement = "SELECT `profile` FROM users WHERE pseudo =?";
        $field = array($SESSION['pseudo']);
        $image = $PDO->statementPDO($statement,$field);
        return($image[0]);
    }
    function uploadImage(&$valid,&$errors,$FILE,&$SESSION,$PDO,$use='gallery'){
        $file = $FILE['profile'];   
        $fileName = preg_replace('/\s+/', '',$file['name']);
        $fileName = str_replace('(', '',$fileName);
        $fileName = str_replace(')', '',$fileName);
        $fileError = $file['error'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        if($fileTmpName)
            $fileInfo = getimagesize($fileTmpName);
        $allowedExtension = array("png","jpg","jpeg");
        $fileExtension = strtolower(end(explode('.',$fileName)));
        if ($FILE['profile'] && !in_array($fileExtension, $allowedExtension)) {
            return NULL;
        }
        else if ($fileError === 1) {
            return NULL;
        }
        elseif($fileError){
            return NULL;
        }
        else if ($FILE['profile'] && (!isset($fileInfo[0]) || !isset($fileInfo[1]))) {
            return NULL;
        } 
        
        if($FILE['profile']){
            $profile = profilePic($SESSION,$PDO);
            $target = "../gallery/" . uniqid($fileName) . "." . $fileExtension;
            if($profile != '../gallery/profile.png')
                unlink(profilePic($SESSION,$PDO));
            if (move_uploaded_file($fileTmpName, $target)) {
                $field = array($SESSION['pseudo'],$SESSION['email']);
                $ID = "SELECT ID FROM users WHERE pseudo = ? AND email = ?";
                $ID_USER = $PDO->statementPDO($ID,$field);
                if($use == 'profile'){
                    $statement1 = "UPDATE users SET `profile` = ? WHERE ID = ?";
                    $field1 = array($target,$ID_USER[0]);
                    $PDO->statementPDO($statement1,$field1,0);
                    
                }
                else{
                    $statement2 = "INSERT INTO  images VALUES (NULL, ?, ?)";
                    $field2 = array($target,$ID_USER[0]);
                    $PDO->statementPDO($statement2,$field2,0);
                }                
            } 
        }    
    }
    
?>