<?php 
    include_once($_SERVER['DOCUMENT_ROOT'].'/function/autoloader.php');
    include_once('database.php');
    try{
      $PDOFIRST = new PDO("mysql:host=$HOST;", $DB_USER, $DB_PASSWORD);
      $PDOFIRST->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
      $query = "CREATE DATABASE IF NOT EXISTS $DB_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
      if($PDOFIRST->exec($query)){
         $PDOup = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD);
         $PDOup->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
         $query = file_get_contents('sql.sql');
         $PDOup->exec($query);         
      }
   }
   catch(Exeption $e){
      echo $e;
   }
   header('Location: /viewIndex.php');