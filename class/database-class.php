<?php
class Database{
    public $DB_DSN;
    public $DB_USER;
    public $DB_PASSWORD;
    public $_PDO;

    public function __construct($DB_DSN,$DB_USER,$DB_PASSWORD){
        $this->DB_DSN = $DB_DSN;
        $this->DB_USER = $DB_USER;
        $this->DB_PASSWORD = $DB_PASSWORD;
        $this->_PDO = new PDO($this->DB_DSN,$this->DB_USER,$this->DB_PASSWORD);
        $this->_PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    public function verifyPDO($table_name,$field,$target){
        $PDOverif = $this->_PDO->prepare("SELECT * FROM $table_name WHERE $field=?");
        $PDOverif->execute([$target]);
        $data = $PDOverif->fetch();
        return($data);
    }
    public function statementPDO($statement,$field,$status=1){
        $PDOverif = $this->_PDO->prepare("$statement");
        $i = 1;
        foreach($field as $fill){
            $PDOverif->bindValue($i,$fill,PDO::PARAM_STR);
            $i++;
        }
        $PDOverif->execute();
        if($status == 1){
            $data = $PDOverif->fetch();
            return($data);             
        }
        if($status == 2){
            $data = $PDOverif->fetchAll();
            return($data);             
        }
    }
}