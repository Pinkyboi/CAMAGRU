<?php
        include('./function/connect.php');
        include('./function/CreateHTMLPost.php');
        include('./function/imageUpload.php');
        include('./function/exitSession.php');
        verifyLink($_SERVER['PHP_SELF']);
        mailResend($PDO);
        headCreate();
        echo '<body>';
        navbar($_SESSION);
        echo "<div class='container main'>";
        echo "<div class='parent'>";
        echo "<input class='copyField' style='opacity:0'type='text'>";
        echo "</div>";
        echo "</div>";
        echo "<div style='display:none'class='spinner'>";
        echo "<div class='bounce1'></div>";
        echo "<div class='bounce2'></div>";
        echo "<div class='bounce3'></div></div>";
        echo "<div class='focus'></div>";
        youCanBlock();
        echo "<footer class='footer' style='position:fixed !important'>© 2019 CAMAGRU</footer>";
?>
        
</body>

        <script>
                
                (function(e){
                        var scrollSave = 0;
                        var index = 0;
                        var dead = false;
                        var spinner = document.querySelector('.spinner');
                        var postVerif = document.querySelectorAll('.post');
                        var statement = "./function/CreateHTMLPost.php?use=reload&index="+index+"&first=1";
                        if(!postVerif[0]){
                                resendQuery(statement,2);
                        }
                        window.addEventListener('scroll',function(){
                                var scrollable = document.documentElement.scrollHeight - window.innerHeight;
                                var scrolled = window.scrollY;
                                if(Math.ceil(scrolled) === scrollable){
                                        if(dead == false){
                                                dead = true;
                                                index = document.querySelectorAll('.post').length;
                                                var spinner = document.querySelector('.spinner');
                                                spinner.style.display ='block';
                                                var statement = "./function/CreateHTMLPost.php?use=reload&index="+index;  
                                                setTimeout(function(){resendQuery(statement,2);}, 2000);
                                                setTimeout(function(){spinner.style.display ='none'}, 3000);
                                                setTimeout(function(){dead = false}, 4000); 
                                                if(scrollable > scrollSave){
                                                        index = document.querySelectorAll('.post').length;
                                                        scrollSave = scrollable;   
                                                }
                                        }
                                }
                        })
                })();
        </script>
</html>