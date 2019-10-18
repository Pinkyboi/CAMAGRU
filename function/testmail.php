<?php
    function verificationMail($email, $user, $id, $token) {
        $verifMail = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTggNTgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU4IDU4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBvbHlnb24gc3R5bGU9ImZpbGw6I0UzQkEyRSIgcG9pbnRzPSIwLDUgMCw0NCAyOCw0NCA1Niw0NCA1Niw1ICAgIiBkYXRhLW9yaWdpbmFsPSIjRENENkNEIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0RDRDZDRCI+PC9wb2x5Z29uPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNFQkMyMzUiIGQ9Ik0zMC45NjUsMjcuMTA3Yy0xLjYzNywxLjQ2Mi00LjI5MiwxLjQ2Mi01LjkzLDBsLTIuMDg3LTEuODQzQzE2LjQxOSwzMS4wOTEsMCw0NCwwLDQ0aDIxLjYwNyAgICBoMTIuNzg3SDU2YzAsMC0xNi40MTktMTIuOTA5LTIyLjk0OC0xOC43MzZMMzAuOTY1LDI3LjEwN3oiIGRhdGEtb3JpZ2luYWw9IiNFOEUzRDkiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRThFM0Q5Ij48L3BhdGg+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0ZBQ0YzQiIgZD0iTTAsNWwyNS4wMzUsMjIuMTA3YzEuNjM3LDEuNDYyLDQuMjkyLDEuNDYyLDUuOTMsMEw1Niw1SDB6IiBkYXRhLW9yaWdpbmFsPSIjRUZFQkRFIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0VGRUJERSI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPGNpcmNsZSBzdHlsZT0iZmlsbDojQ0Y2Njc5IiBjeD0iNDYiIGN5PSI0MSIgcj0iMTIiIGRhdGEtb3JpZ2luYWw9IiMyNkI5OTkiIGNsYXNzPSJhY3RpdmUtcGF0aCIgZGF0YS1vbGRfY29sb3I9IiMyNkI5OTkiPjwvY2lyY2xlPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGRkZGRkY7IiBkPSJNNTIuNTcxLDM1LjE3OWMtMC40NTUtMC4zMTYtMS4wNzctMC4yMDQtMS4zOTIsMC4yNWwtNS41OTYsOC4wNGwtMy45NDktMy4yNDIgICAgYy0wLjQyNi0wLjM1MS0xLjA1Ny0wLjI4OC0xLjQwNywwLjEzOWMtMC4zNTEsMC40MjctMC4yODksMS4wNTcsMC4xMzksMS40MDdsNC43ODYsMy45MjljMC4xOCwwLjE0NywwLjQwNCwwLjIyNywwLjYzNCwwLjIyNyAgICBjMC4wNDUsMCwwLjA5MS0wLjAwMywwLjEzNy0wLjAwOWMwLjI3Ni0wLjAzOSwwLjUyNC0wLjE5LDAuNjg0LTAuNDE5bDYuMjE0LTguOTI5QzUzLjEzNiwzNi4xMTgsNTMuMDI0LDM1LjQ5NSw1Mi41NzEsMzUuMTc5eiIgZGF0YS1vcmlnaW5hbD0iI0ZGRkZGRiIgY2xhc3M9IiI+PC9wYXRoPgoJPC9nPgo8L2c+PC9nPiA8L3N2Zz4=";
          $subject = "Reset your password";
          $headers = "From: " . strip_tags('abenaissCamagru.com') . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
          $to = $email;
          $message = "
          <html>
            <head>
              <title>$subject</title>
            </head>
              <body>
                <div style='color: #E1E1E1 !important;font-family:Tahoma, Geneva, Verdana, sans-serif;position: absolute;width: 100%;height: 400px;text-align: center;border-radius: 5px;background-color: #202020;box-shadow: 0 0 0.2rem rgba(0, 0, 0, 0.2);'>
                  <img style = 'padding: 6px;width: 130px;margin-left: 3px; margin-top:-15px; padding-top: 100px;' class='image'src='$verifMail'/>
                  <h1 style = 'color: #E2E1E1;font-size: 30px;'>$subject</h1>
                  <p style='color: #A7A3A4;font-size: 14px; font-weight: 600; margin-top: 20px;margin-bottom: 15px;'> Hello $user</p>
                  <p style='color: #A7A3A4;font-size: 14px;'>To reset your password enter this link</p>
                  <a href= localhost:3000/views/viewMailConfirmartion.php?token=$token&ID=$id><button style='margin-top: 10px; border: none;border-radius: 5px;font-size: 15px;color: #E2E1E1;padding: 5px 15px;background-color: rgb(170, 73, 92);'>Verify your email</button></a>
                </div>
            </body>
          </html>
          ";
          if(mail($to, $subject, $message, $headers));
            return(1);
            // echo $to,$subject,$message, $headers;
        //   if(mail($to,$subject,$message, $headers))
            // echo "HI";
    }
    if(verificationMail('8v0u78u6m4@montokop.pw','duude','32',"chi le3ba"))
        echo "hi";
?>