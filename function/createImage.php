<?php
    function getPathSticker($sticker){
        if($sticker === '1')
            return('../stickers/gnomed.png');
        else if($sticker === '2')
            return('../stickers/punpun.png');
        else if($sticker === '3')
            return('../stickers/ricardo.png');
        else if($sticker === '4')
            return('../stickers/toby.png');
        else if($sticker === '5')
            return('../stickers/trump-pepe.png');
        else
            return('../stickers/dio.png');
    }
    function addNewPost($link,$PDO,$SESSION){
        $statement = 'SELECT ID FROM `users` WHERE pseudo = ?';
        $ID = $PDO->statementPDO($statement,array($SESSION['pseudo']),1);
        $statement1 = "INSERT INTO  images VALUES (NULL, ?, ?)";
        $field = array($link,$ID[0]);
        $PDO->statementPDO($statement1,$field,0);
    }
    
    function verifyNewPost($SESSION,$POST,$PDO){
        try{
            if(isset($SESSION['time']) && $SESSION['time'] == $POST['time']){
                $sticker = getPathSticker($POST['sticker']);
                $rawCanvas = $POST['encodedCanva'];
                $folderPath = "../gallery/";
                $filtredCanva = str_replace('data:image/png;base64,', '',$rawCanvas);
                if(empty($filtredCanva)){
                        header('Location: ./viewCamera.php');
                        die;
                }
                $encodedCanva = str_replace(' ', '+',$filtredCanva);
                $decodeCava = base64_decode($filtredCanva, TRUE);
                if($decodeCava && !empty($filtredCanva)){
                    $destWidth = 900;
                    $destHeight = 675;
                    $resourceCanva = imagecreatefromstring($decodeCava);
                    $width = imagesx($resourceCanva);
                    $height = imagesy($resourceCanva);
                    var_dump($POST);
                    if(floor($width * 0.75) === floor($height)){
                        $cleanCanva = imagecreatetruecolor($destWidth,$destHeight);
                        imagecopyresampled($cleanCanva, $resourceCanva, 0, 0, 0, 0, $destWidth, $destHeight, $width, $height);
                        $sticker = imagecreatefrompng($sticker);
                        $stickerW = $destWidth * 0.3;
                        $stickerY = $destWidth * 0.4;
                        imagecopy($cleanCanva, $sticker, 0, $destHeight - 270, 0, 0,$stickerW,$stickerY);
                        $file = $folderPath . uniqid() . '.png';
                        imagepng($cleanCanva, $file);
                        addNewPost($file,$PDO,$SESSION); 
                    }
                }
            }            
        }
        catch(Exeption $e){}
    }
?>