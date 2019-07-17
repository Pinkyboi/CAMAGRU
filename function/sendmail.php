<?php
    function sendmail($to,$token){
    $subject = 'Sujet de l\'email';
    $message = "<h1>hi,</h1> your confirmation code is : $token";
    $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"";
    $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
    mail($to,$subject,$message,$headers);
    }
?>