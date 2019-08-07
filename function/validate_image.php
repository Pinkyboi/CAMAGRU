<?php
    function profilePic($SESSION,$PDO){
        $statement = "SELECT `profile` FROM users WHERE pseudo =?";
        $field = array($SESSION['pseudo']);
        $image = $PDO->statementPDO($statement,$field);
        return($image[0]);
    }
    function uploadImage(&$valid,&$errors,$FILE,&$SESSION,$PDO,$use='gallery'){
        $file = $FILE['profile'];
        $fileName = $file['name'];
        $fileError = $file['error'];
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        if($fileTmpName)
            $fileInfo = getimagesize($fileTmpName);
        $allowedExtension = array("png","jpg","jpeg");
        $fileExtension = strtolower(end(explode('.',$fileName)));
        if ($_FILE['profile'] && !in_array($fileExtension, $allowedExtension)) {
                $errors['profile'] = "The file is not valid.";
        }
        else if ($fileError === 1) {
            $errors['profile'] = "the file size is too big.";
        }
        elseif($fileError){
            $errors['profile'] = 'There is an error.';
        }
        else if ($_FILE['profile'] && (!isset($fileInfo[0]) || !isset($fileInfo[1]))) {
            $errors['profile'] = "The file is not valid.";
        } 
        
        else {
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
                    $valid['profile'] = "Your profile image changed.";
                }
                else{
                    $statement2 = "INSERT INTO  images VALUES (NULL, ?, ?)";
                    $field2 = array($target,$ID_USER[0]);
                    $PDO->statementPDO($statement2,$field2,0);
                }                
            } 
            else {
                $errors['profile'] = "there is a problem in uploading image file.";
            }
        }    
    }