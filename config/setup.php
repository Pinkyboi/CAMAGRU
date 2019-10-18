<?php 
    include_once('../function/autoloader.php');
    include_once('database.php');
    try{
      $PDOup = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD); 
      $query = file_get_contents('sql.sql');
      $PDOup->exec($query);
   }
   catch(Exeption $e){
      echo $e;
   }
   header('Location: ../views/viewIndex.php');