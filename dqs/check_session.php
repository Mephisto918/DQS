<?php
session_start();
    echo '<pre>';
        print_r($_SESSION);
    echo '</pre>';
    $time = date('His');
    // echo $time;
    // $_SESSION['customer_id'] += 1;
    echo date('d-m-Y');
?>