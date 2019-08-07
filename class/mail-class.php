<?php
    class Mail
    {
        public function verification_mail($mail, $user, $token) {
            $subject = "Email verification";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $message = "
            <html>
              <head>
                <title>$subject</title>
              </head>
              <body>
                Hello " . htmlspecialchars($user) ."</br>
                To finalyze your subscribtion please click the link below </br>
                <a href= localhost:3000/confirm_email.php?pseudo=$user&token=$token>Verify my email</a>
              </body>
            </html>
            ";
            mail($mail, $subject, $message, $headers);
          }
          
        public function password_mail($mail,$token){
            $subject = "Reset your password";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $message = "
            <html>
              <head>
                <title>$subject</title>
              </head>
              <body>
                Hello</br>
                <a href= localhost:3000/view/view_change_password.php?token=$token &email=$mail>Change password</a>
              </body>
            </html>
            ";
            mail($mail, $subject, $message, $headers);
        }
    }
    
?>