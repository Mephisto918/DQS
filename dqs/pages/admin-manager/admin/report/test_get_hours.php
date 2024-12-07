<?php
    include('./../../../../db.php');
    $sql = "SELECT HOUR(STR_TO_DATE(purchase_time, '%H%i%s')) AS hour, purchase_total_amount, purchase_quantity FROM  `sales`;";

    $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));

    foreach($res as $item){
        echo $item['purchase_quantity'];
    }

    
?>