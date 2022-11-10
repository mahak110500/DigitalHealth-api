<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
 

    $host        = "host = localhost";
    $port        = "port = 5432";
    $dbname      = "dbname = postgres";
    $credentials = "user = postgres password=postgres";
 
    $db = pg_connect("$host $port $dbname $credentials");
   //  if(!$db) {
   //     echo "Error : Unable to open database\n";
   //  } else {
   //     echo "Opened database successfully\n";
   //  }


    
?>