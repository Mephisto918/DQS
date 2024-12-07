<?php
    include('../../../../db_no_indi.php');
    session_start();

    // echo '<pre>';
    //     print_r($_GET);
    // echo '</pre>';

    $start = date('Y-m-d', strtotime($_GET['start']));
    $end = date('Y-m-d', strtotime($_GET['end']));
    
    $new_start = explode("-", $start);
    $new_end = explode("-", $end);
    $error_message = "";
    $response = [];
    // if($new_start[0] >= $new_end[0]||
    //     $new_start[1] >= $new_end[1]&&
    //     $new_start[2] >= ($new_end[2])){
    //         $error_message = 'Invalid date range';
    //         $response[] = [
    //             'error' => $error_message,
    //             'status' => false
    //         ];
    // }else{
    //     // echo 'Valid date range';
    //     $start_date = $new_start[0] . '-' . $new_start[1] . '-' . $new_start[2];
    //     $end_date = $new_end[0] . '-' . $new_end[1] . '-' . $new_end[2];

        
    //     $total_sales = 0;
    //     $que = mysqli_fetch_all(mysqli_query($conn, ("SELECT * FROM `sales` WHERE `purchase_date` BETWEEN '$start_date' AND '$end_date';")), MYSQLI_ASSOC);
    //     // echo $que['sales_id'];
    //     foreach($que as $item){
    //         $yy = explode('-', $item['purchase_date'])[0];
    //         $mm = explode('-', $item['purchase_date'])[1];
    //         $dd = explode('-', $item['purchase_date'])[2];
    //         $date = $mm .'-' . $dd . '-' . $yy;
    //         $total_am = $item['purchase_total_amount'];
    //         $total_sales += $total_am;
    //         $response[] = [
    //             'date' => $date,
    //             'quantity' => $item['purchase_quantity'],
    //             'total' => $item['purchase_total_amount'],
    //             'total_sales' => $total_sales
    //         ];
    //     }
    // }
    if($new_start[0] <= $new_end[0]&&
        $new_start[1] <= $new_end[1]&&
        $new_start[2] <= ($new_end[2])){
             // echo 'Valid date range';
             $start_date = $new_start[0] . '-' . $new_start[1] . '-' . $new_start[2];
             $end_date = $new_end[0] . '-' . $new_end[1] . '-' . $new_end[2];
 
             
             $total_sales = 0;
             $que = mysqli_fetch_all(mysqli_query($conn, ("SELECT * FROM `sales` WHERE `purchase_date` BETWEEN '$start_date' AND '$end_date';")), MYSQLI_ASSOC);
             // echo $que['sales_id'];
             foreach($que as $item){
                 $yy = explode('-', $item['purchase_date'])[0];
                 $mm = explode('-', $item['purchase_date'])[1];
                 $dd = explode('-', $item['purchase_date'])[2];
                 $date = $mm .'-' . $dd . '-' . $yy;
                 $total_am = $item['purchase_total_amount'];
                 $total_sales += $total_am;
                 $response[] = [
                     'date' => $date,
                     'quantity' => $item['purchase_quantity'],
                     'total' => $item['purchase_total_amount'],
                     'total_sales' => $total_sales
                 ];
             } 
        }else{
            $error_message = 'Invalid date range';
            $response[] = [
                'error' => $error_message,
                'status' => false
            ];
        }

    header('Content-Type: application/json');
    echo json_encode($response);
?>