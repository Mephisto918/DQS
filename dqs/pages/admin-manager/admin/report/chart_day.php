<?php
    // $query = "SELECT HOUR(STR_TO_DATE(time_column, '%H%i%s')) AS hour, total_amount, purchase_quantity FROM  `sales`;";



    $res = mysqli_query($conn, $sql);

    if($res){
        $data = array();
        while($row = mysqli_fetch_assoc($res)){
            $data[] = $row['hour'];
        }
    }

    echo json_encode($data);
?>