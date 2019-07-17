<?php
class Database{
    public function initPDO($db_name,$db_user = 'root',$db_passwrd = 'root',$db_host = 'localhost:3306'){
        if($this->_PDO == null){
            $_PDO = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_passwrd);
            $_PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->_PDO = $_PDO;
        }
        return($this->_PDO);
    }
    public function verifyPDO($db_name,$field,$target){
        $_PDOverif = $this->_PDO->prepare("SELECT * FROM $db_name WHERE $field=?");
        $_PDOverif->execute([$target]);
        $data = $_PDOverif->fetch();
        return($data);
    }
    public function statementPDO($db_name,$statement,$field,$status=1){
        $_PDOverif = $this->_PDO->prepare("$statement");
        $i = 1;
        foreach($field as $fill){
            $_PDOverif->bindValue($i,$fill,PDO::PARAM_STR);
            $i++;
        }
        $_PDOverif->execute();
        if($status){
            $data = $_PDOverif->fetch();
            return($data);             
        }
    }
}