<?php
    function ft_verifie($_PDO,$field,$target)
    {
        $_PDOverif = $_PDO->prepare("SELECT * FROM tb_user WHERE $field=?");
        $_PDOverif->execute([$target]);
        if($_PDOverif->fetch() == 0)
            return (1);
        else
            return(0);  
    }
?>