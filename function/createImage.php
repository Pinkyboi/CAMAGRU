<?php
    function getPathSticker($sticker){
        if($sticker === '1')
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/gnomed.png');
        else if($sticker === '2')
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/punpun.png');
        else if($sticker === '3')
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/ricardo.png');
        else if($sticker === '4')
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/toby.png');
        else if($sticker === '5')
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/trump-pepe.png');
        else
            return($_SERVER['DOCUMENT_ROOT'].'/stickers/dio.png');
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
                $folderPath = "/"."gallery/";
                $filtredCanva = str_replace('data:image/png;base64,', '',$rawCanvas);
                if(empty($filtredCanva)){
                    header('Location:'.$_SERVER['DOCUMENT_ROOT'].'/viewCamera.php');
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
                    if(!(isset($POST['posY']) && isset($POST['posX']))){
                        $POST['posY'] = 0;
                        $POST['posX'] = 0;                        
                    }
                    $postY = floatval($POST['posY']);
                    $postX = floatval($POST['posX']);  
                    if(floor($width * 0.75) === floor($height)){
                        $cleanCanva = imagecreatetruecolor($destWidth,$destHeight);
                        imagecopyresampled($cleanCanva, $resourceCanva, 0, 0, 0, 0, $destWidth, $destHeight, $width, $height);
                        $sticker = imagecreatefrompng($sticker);
                        $stickerW = $destWidth * 0.3;
                        $stickerY = $destHeight * 0.4;
                        $offsetX = $postX * ($destWidth - $stickerW)/3;
                        $offsetY = $destHeight - $postY *($destHeight - $stickerY)/3 - $stickerY;
                        if($POST['posX'] > 3|| $POST['posX'] < 0)
                            $offsetX = 0;
                        if($POST['posY'] > 3|| $POST['posY'] < 0)
                            $offsetY = $destHeight - $stickerY;
                        imagecopy($cleanCanva, $sticker, $offsetX , $offsetY, 0, 0,$stickerW,$stickerY);
                        $file = $folderPath . uniqid() . '.png';
                        imagepng($cleanCanva, $_SERVER['DOCUMENT_ROOT'].$file);
                        addNewPost($file,$PDO,$SESSION); 
                    }
                }
            }            
        }
        catch(Exeption $e){}
    }
?>