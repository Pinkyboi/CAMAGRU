<?php 
    include_once('../function/autoloader.php');
    include_once('database.php');
    try{
      $PDOFIRST = new PDO("mysql:host=$HOST;", $DB_USER, $DB_PASSWORD);
      $query = "CREATE DATABASE IF NOT EXISTS Camagru CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";
      $PDOFIRST->exec($query);
      $PDOup = new PDO($DB_DNS, $DB_USER, $DB_PASSWORD); 
      $query = file_get_contents('sql.sql');
      $PDOup->exec($query);
   }
   catch(Exeption $e){
      echo $e;
   }
   header('Location: ../views/viewIndex.php');