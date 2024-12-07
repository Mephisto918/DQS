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
        echo '
            <div style="width: 20px;
                        aspect-ratio: 1; 
                        border-radius: 50%;
                        position: absolute;
                        left: 2%;
                        bottom: 2%;
                        background-color: green;">
            </div>
        ';
    }catch(mysqli_sql_exception $e){
        $db_stat = $e;   
        echo '
            <div style="width: 20px;
                        aspect-ratio: 1; 
                        border-radius: 50%;
                        position: absolute;
                        left: 2%;
                        bottom: 2%;
                        background-color: red;">
            </div>
        ';    
    }
?>