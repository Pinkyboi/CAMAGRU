<?php
    function sendmail($to,$token){
        $host = "localhost:3000/view/view_mail.php?";
        $subject = "CAMAGRU Confirmation link";
        $message = "<a href=$host"."?email=".$email."&token=".$token."></a>";
        $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        mail($to,$subject,$message,$headers);
    }
?>