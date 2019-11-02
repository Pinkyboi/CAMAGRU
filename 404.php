<?php
    include('./function/CreateHTMLPost.php');
    headCreate();
    navbar(1); 
?>
<body>
      <div class="container contain404">
            <div id="field404">
                <div class="row">
                        <div class="no-padding col-sm-12">
                            <div class="logo404"><img src="/imgs/404.svg" alt="404-logo"></div>
                            <div class="message404">we couldn’t find this page</div>
                            <div class="submessage">maybe it is out there, somewhere...</div>
                            <a style="text-decoration:none" href="/viewIndex.php">
                                <div><span class="backToHome">go to home page</span></div>
                            </a>
                        </div>
                </div>
            </div>       
      </div>
      <footer class="footer">© 2019 CAMAGRU</footer> 
</body>
</html>