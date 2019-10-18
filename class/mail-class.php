<?php
    class Mail{
      public function verificationMail($email, $user, $id, $token) {
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
          mail($to, $subject, $message, $headers);
        }
        public function likeMail($liked,$liker,$email,$id){
          $likeMail = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTcgNTciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU3IDU3OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBvbHlnb24gc3R5bGU9ImZpbGw6I0UzQkEyRSIgcG9pbnRzPSIwLDUuNSAwLDQ0LjUgMjgsNDQuNSA1Niw0NC41IDU2LDUuNSAgICIgZGF0YS1vcmlnaW5hbD0iI0RDRDZDRCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNEQ0Q2Q0QiPjwvcG9seWdvbj4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRUJDMjM1IiBkPSJNMzAuOTY1LDI3LjYwN2MtMS42MzcsMS40NjItNC4yOTIsMS40NjItNS45MywwbC0yLjA4Ny0xLjg0M0MxNi40MTksMzEuNTkxLDAsNDQuNSwwLDQ0LjVoMjEuNjA3ICAgIGgxMi43ODdINTZjMCwwLTE2LjQxOS0xMi45MDktMjIuOTQ4LTE4LjczNkwzMC45NjUsMjcuNjA3eiIgZGF0YS1vcmlnaW5hbD0iI0U4RTNEOSIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFOEUzRDkiPjwvcGF0aD4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRkFDRjNCIiBkPSJNMCw1LjVsMjUuMDM1LDIyLjEwN2MxLjYzNywxLjQ2Miw0LjI5MiwxLjQ2Miw1LjkzLDBMNTYsNS41SDB6IiBkYXRhLW9yaWdpbmFsPSIjRUZFQkRFIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0VGRUJERSI+PC9wYXRoPgoJPC9nPgoJPGc+CgkJPHBhdGggc3R5bGU9ImZpbGw6I0NGNjY3OSIgZD0iTTQ1LDM0LjdjMC45NjktMi4xODMsMy4xMDktNC4yLDUuNjg0LTQuMmMzLjQ2NywwLDUuOTY0LDIuODIxLDYuMjc4LDYuMTgzICAgIGMwLDAsMC4xNywwLjgzNS0wLjIwMywyLjMzN2MtMC41MDgsMi4wNDYtMS43MDEsMy44NjQtMy4zMTEsNS4yNTFMNDUsNTEuNWwtOC40NDctNy4yMjljLTEuNjEtMS4zODctMi44MDMtMy4yMDUtMy4zMTEtNS4yNTEgICAgYy0wLjM3My0xLjUwMi0wLjIwMy0yLjMzNy0wLjIwMy0yLjMzN2MwLjMxNC0zLjM2MiwyLjgxMS02LjE4Myw2LjI3OC02LjE4M0M0MS44OTEsMzAuNSw0NC4wMzEsMzIuNTE3LDQ1LDM0Ljd6IiBkYXRhLW9yaWdpbmFsPSIjRjA5MzcyIiBjbGFzcz0iYWN0aXZlLXBhdGgiIGRhdGEtb2xkX2NvbG9yPSIjRjA5MzcyIj48L3BhdGg+Cgk8L2c+CjwvZz48L2c+IDwvc3ZnPg==";
          $subject = "Post liked";
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
                <img style = 'padding: 6px;width: 130px;margin-left: 3px; margin-top:-15px; padding-top: 100px;' src='$likeMail'/>
                <h1 style = 'color: #E2E1E1;font-size: 30px;'>$subject</h1>
                <p style='color: #A7A3A4;font-size: 14px; font-weight: 600; margin-top: 20px;margin-bottom: 15px;'> Hello $liked</p>
                <p style='color: #A7A3A4;font-size: 14px;'>Your post has been liked by $liker</p>
                <a href= localhost:3000/views/viewSinglePost.php?id=$id><button style='margin-top: 10px;' style='margin-top: 10px; border: none;border-radius: 5px;font-size: 15px;color: #E2E1E1;padding: 5px 15px;background-color: rgb(170, 73, 92);'>Your post</button></a>
              </div>
            </body>
          </html>
          
          ";
          mail($to, $subject, $message, $headers);
        }
        public function commentMail($commented,$commenter,$email,$id){
          $commentMail = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTcgNTciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU3IDU3OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBvbHlnb24gc3R5bGU9ImZpbGw6I0UzQkEyRSIgcG9pbnRzPSIwLDQuNSAwLDQzLjUgMjgsNDMuNSA1Niw0My41IDU2LDQuNSAgICIgZGF0YS1vcmlnaW5hbD0iI0RDRDZDRCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNEQ0Q2Q0QiPjwvcG9seWdvbj4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRUNDMjMyIiBkPSJNMzAuOTY1LDI2LjYwN2MtMS42MzcsMS40NjItNC4yOTIsMS40NjItNS45MywwbC0yLjA4Ny0xLjg0M0MxNi40MTksMzAuNTkxLDAsNDMuNSwwLDQzLjVoMjEuNjA3ICAgIGgxMi43ODdINTZjMCwwLTE2LjQxOS0xMi45MDktMjIuOTQ4LTE4LjczNkwzMC45NjUsMjYuNjA3eiIgZGF0YS1vcmlnaW5hbD0iI0U4RTNEOSIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0U4RTNEOSI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGQUNGM0IiIGQ9Ik0wLDQuNWwyNS4wMzUsMjIuMTA3YzEuNjM3LDEuNDYyLDQuMjkyLDEuNDYyLDUuOTMsMEw1Niw0LjVIMHoiIGRhdGEtb3JpZ2luYWw9IiNFRkVCREUiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRUZFQkRFIj48L3BhdGg+Cgk8L2c+Cgk8Zz4KCQk8cG9seWdvbiBzdHlsZT0iZmlsbDojQ0Y2Njc5IiBwb2ludHM9IjQ1LDMwLjUgNDguNzA4LDM3Ljc0MiA1NywzOC45MDMgNTEsNDQuNTQgNTIuNDE2LDUyLjUgNDUsNDguNzQyIDM3LjU4NCw1Mi41IDM5LDQ0LjU0ICAgICAzMywzOC45MDMgNDEuMjkyLDM3Ljc0MiAgICIgZGF0YS1vcmlnaW5hbD0iI0YyOUMyMSIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNGMjlDMjEiPjwvcG9seWdvbj4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+";
          $subject = "Post commented";
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
                <img style = 'padding: 6px;width: 130px;margin-left: 3px; margin-top:-15px; padding-top: 100px;'class='image' src='$commentMail'/>
                <h1 style = 'color: #E2E1E1;font-size: 30px;'>$subject</h1>
                <p style='color: #A7A3A4;font-size: 14px; font-weight: 600; margin-top: 20px;margin-bottom: 15px;'> Hello $commented </p>
                <p style='color: #A7A3A4;font-size: 14px;'>Your post has been commented by $commenter</p>
                <a href= localhost:3000/views/viewSinglePost.php?id=$id><button style='margin-top: 10px;' style='margin-top: 10px; border: none;border-radius: 5px;font-size: 15px;color: #E2E1E1;padding: 5px 15px;background-color: rgb(170, 73, 92);'>Your post</button></a>
              </div>
            </body>
          </html>
          ";
          mail($to, $subject, $message, $headers);
        }
        public function passwordMail($user,$id,$token,$email){
          $passwordMail = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTggNTgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU4IDU4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxnPgoJPGc+CgkJPHBvbHlnb24gc3R5bGU9ImZpbGw6I0UzQkEyRSIgcG9pbnRzPSIwLDUuNSAwLDQ0LjUgMjgsNDQuNSA1Niw0NC41IDU2LDUuNSAgICIgZGF0YS1vcmlnaW5hbD0iI0RDRDZDRCIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNEQ0Q2Q0QiPjwvcG9seWdvbj4KCQk8cGF0aCBzdHlsZT0iZmlsbDojRUJDMjM1IiBkPSJNMzAuOTY1LDI3LjYwN2MtMS42MzcsMS40NjItNC4yOTIsMS40NjItNS45MywwbC0yLjA4Ny0xLjg0M0MxNi40MTksMzEuNTkxLDAsNDQuNSwwLDQ0LjVoMjEuNjA3ICAgIGgxMi43ODdINTZjMCwwLTE2LjQxOS0xMi45MDktMjIuOTQ4LTE4LjczNkwzMC45NjUsMjcuNjA3eiIgZGF0YS1vcmlnaW5hbD0iI0U4RTNEOSIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0U4RTNEOSI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNGQUNGM0IiIGQ9Ik0wLDUuNWwyNS4wMzUsMjIuMTA3YzEuNjM3LDEuNDYyLDQuMjkyLDEuNDYyLDUuOTMsMEw1Niw1LjVIMHoiIGRhdGEtb3JpZ2luYWw9IiNFRkVCREUiIGNsYXNzPSIiIGRhdGEtb2xkX2NvbG9yPSIjRUZFQkRFIj48L3BhdGg+Cgk8L2c+Cgk8Zz4KCQk8cmVjdCB4PSIzOCIgeT0iMzYuNSIgc3R5bGU9ImZpbGw6I0M0QzRDNCIgd2lkdGg9IjIwIiBoZWlnaHQ9IjE2IiBkYXRhLW9yaWdpbmFsPSIjQ0JCMjkyIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iI0NCQjI5MiI+PC9yZWN0PgoJCTxwYXRoIHN0eWxlPSJmaWxsOiM0MjQyNDIiIGQ9Ik01MSw0My41YzAtMS42NTctMS4zNDMtMy0zLTNzLTMsMS4zNDMtMywzYzAsMS4zMTcsMC44NTQsMi40MjQsMi4wMzUsMi44MjcgICAgQzQ3LjAyNCw0Ni4zODUsNDcsNDYuNDM5LDQ3LDQ2LjV2MmMwLDAuNTUyLDAuNDQ4LDEsMSwxczEtMC40NDgsMS0xdi0yYzAtMC4wNjEtMC4wMjQtMC4xMTUtMC4wMzUtMC4xNzMgICAgQzUwLjE0Niw0NS45MjQsNTEsNDQuODE3LDUxLDQzLjV6IiBkYXRhLW9yaWdpbmFsPSIjN0Y1QzUzIiBjbGFzcz0iIiBkYXRhLW9sZF9jb2xvcj0iIzdGNUM1MyI+PC9wYXRoPgoJCTxwYXRoIHN0eWxlPSJmaWxsOiNCREMzQzc7IiBkPSJNNDMsMzQuNWMwLTIuNzU3LDIuMjQzLTUsNS01czUsMi4yNDMsNSw1djJoMnYtMmMwLTMuODYtMy4xNC03LTctN3MtNywzLjE0LTcsN3YyaDJWMzQuNXoiIGRhdGEtb3JpZ2luYWw9IiNCREMzQzciIGNsYXNzPSIiPjwvcGF0aD4KCTwvZz4KPC9nPjwvZz4gPC9zdmc+";
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
            <div style='color: #E1E1E1 !important;font-family:Tahoma, Geneva, Verdana, sans-serif;position: absolute;width: 100%;height: 400px;text-align: center;border-radius: 5px;background-color: #202020;box-shadow: 0 0 0.2rem rgba(0, 0, 0, 0.2);'>
              <body>
                <img style = 'padding: 6px;width: 130px;margin-left: 3px; margin-top:-15px; padding-top: 100px;' class='image' src='$passwordMail'/>
                <h1 style = 'color: #E2E1E1;font-size: 30px;'>$subject</h1>
                <p style='color: #A7A3A4;font-size: 14px; font-weight: 600; margin-top: 20px;margin-bottom: 15px;'> Hello $user </p>
                <p style='color: #A7A3A4;font-size: 14px;'>Here is your link to change your password</p>
                <a href= localhost:3000/views/viewChangePassword.php?token=$token&email=$email><button style='margin-top: 10px; border: none;border-radius: 5px;font-size: 15px;color: #E2E1E1;padding: 5px 15px;background-color: rgb(170, 73, 92);'>Click here</button></a>
              </div>
            </body>
          </html>
          ";
          mail($to, $subject, $message, $headers);
        }
    }
    
?>