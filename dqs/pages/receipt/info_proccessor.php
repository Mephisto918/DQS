<?php
    include('../../db_no_indi.php');
    // include('../../db.php');
    session_start();
    // echo '<pre>';
    //     print_r($_POST);
    //     print_r($_SESSION);
    // echo '</pre>';
    $message="";
    $status = "";
    $error = "";
    try{
        mysqli_begin_transaction($conn); ///////

        // ---------------------------------------------------sales table --------------------------
        $items = $_SESSION['item_id'];
        $total_items = 0;
        foreach($items as $item){
            $total_items += 1;
        }

        $customer_id = json_decode($_SESSION['customer_id']);
        $purchase_total_amount = json_decode($_SESSION['total_cart']);
        $purchase_total_items = $total_items;
        $purchase_transaction_method = $_POST['payment_choice'];
        $time = date('h:i:s');
        $date = date('Y-m-d');

        // ---------------------------------------------------sales table --------------------------
        // ---------------------------------------------------sales details table --------------------------
        $data_pass = $_POST['data_pass'];
        if(mysqli_query($conn, ("INSERT INTO `sales` (`customer_id`,  `purchase_date`, `purchase_time`, `purchase_quantity`,      `purchase_total_amount`,  `payment_method`) 
                                              VALUES ('$customer_id', '$date',         '$time',         '$purchase_total_items', '$purchase_total_amount', '$purchase_transaction_method');"))){
            $sales_id = mysqli_insert_id($conn);

            $items = [];
            foreach($data_pass as $data){
                $item = json_decode($data);
                if($item === null && json_last_error() !== JSON_ERROR_NONE){
                    die('error' . json_last_error_msg());
                }
                $items[] = $item;
            }
            foreach($items as $item){
                $id = $item->id;
                $quantity = $item->quantity;
                $price = $item->price;
                $product_old_stock = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `products` WHERE `product_id` = '$id';")))['product_stock'];
                $minus_stock = $product_old_stock - $quantity;
                mysqli_query($conn, ("UPDATE `products` SET `product_stock` = '$minus_stock' WHERE `products`.`product_id` = $id;"));

                mysqli_query($conn, ("INSERT INTO `sales_details` (`sales_id`, `product_id`, `product_quantity`, `product_price`) VALUES  ('$sales_id','$id','$quantity','$price')"));
                
                // echo 'sales details okay'.'<br>';
            }
        }
        
        // ---------------------------------------------------sales details table --------------------------
        mysqli_commit($conn);
        $message = 'Transaction Successful';
        $status = true;
    }catch(Exception $e){
        mysqli_rollback($conn);
        if($e->getCode() == 1062){
            $error = "Duplication Error in SQL";
        }

        $message = 'Transaction Failed';
        $status = false;
    }


    $reponse = [
        'status' => $status,
        'message' => $message,
        'error' => $error
    ];
    header('Content-Type: application/json');
    echo json_encode($reponse);
?>