<?php
    function profilePic($SESSION,$PDO){
        $statement = "SELECT `profile` FROM users WHERE pseudo =?";
        $field = array($SESSION['pseudo']);
        $image = $PDO->statementPDO($statement,$field);
        return($image[0]);
    }