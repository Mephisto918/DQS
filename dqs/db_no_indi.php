<?php
    $server = 'localhost';
    $user = "root";
    $pass = ""; 
    $db = "dqs";

    $conn = "";

    $db_stat = "";
    try{
        $conn = mysqli_connect($server, $user, $pass, $db);
        $db_stat = "success";
    }catch(mysqli_sql_exception $e){
        $db_stat = $e;   
    }
?>