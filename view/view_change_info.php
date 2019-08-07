<?php
    include('../function/verifie_registration.php');
    include('../function/connect.php');
    include("../function/validate_image.php");
    include("../function/validate_change.php");
    session_start();
    $error = array();
    if(!$_SESSION['email'] || !$_SESSION['pseudo']){
        header('Location: view_login.php');
        die();
    }
    else{
        if($_POST['submit-changes']){
            if($_FILES['profile']['name'])
                uploadImage($valid,$errors,$_FILES,$_SESSION,$PDO,'profile');
            validateChange($valid,$errors,$_FILE,$_SESSION,$PDO);
            $_SESSION['profile'] = profilePic($_SESSION,$PDO);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" media="screen" href="../style/mail.css" />
    <title>CAMAGRU</title>
<body>
    <div class="change left">
        <div onclick="triggerClick()" class="exit"></div>
        <div class="norme">    
            <form style="margin: -15px !important;"class="form" action="view_change_info.php" method="post" enctype="multipart/form-data">
                <div class="parent">
                    <img  src='<?php if($_SESSION['profile']) echo $_SESSION['profile']; else echo '../gallery/profile.png';?>' alt='profile-image' id="upload">
                    <label for="profile" id="label-profile">Hi</label>
                    <input  onChange="displayImage(this)" id="profile" type="file" name="profile"><br>
                </div>
                <label for="pseudo">Your pseudo:</label><br>
                    <input id="pseudo" class="special" type="text" name="pseudo" placeholder=<?php echo $_SESSION['pseudo']?>><br>
                <label for="email">Your email:</label><br>
                    <input id="email" class="special" type="email" name="email" placeholder=<?php echo $_SESSION['email']?>><br>
                <label for="password">Your new password:</label><br>
                    <input id="password" class="special" type="password" name="password"><br>
                <label for="password1">Confirm your new password:</label><br>
                    <input id="password1" class="special" type="password" name="password1"><br>
                <input type="submit" class="special" name= "submit-changes"value="submit">
            </form>
        </div>
            <div class="contain-error">
                <?php
                    if(is_array($errors)){
                        foreach ($errors as $error){
                            if($error)
                                echo "<div class='errors'>$error</div>";
                        }                    
                    }
                    if(is_array($valid)){
                        foreach ($valid as $valide){
                            if($valide)
                                echo "<div class='valide'>$valide</div>";
                        }                    
                    }
                ?>
            </div>
    </div>
    <footer class="footer">© 2019 CAMAGRU</footer>
    <script>
    function triggerClick(e) {
        var left = document.querySelector('.left');
        left.style.display = "none";
    }
    function displayImage(e) {
    if (e.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e){
        document.querySelector('#upload').setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
    }
    </script>
</body>
</html>