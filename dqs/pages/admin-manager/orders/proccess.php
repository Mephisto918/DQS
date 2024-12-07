<?php
    include('../../../db.php');
    echo '<pre>';
    print_r($_POST);
    print_r($_GET);
    print_r($_FILES);
    echo '</pre>';

    
    if(isset($_GET['response_type'])){
        $reply = $_GET['response_type'];
        $ord_id = $_GET['order_id'];

        if($reply == 'redact'){
            try{
                mysqli_query($conn, ("UPDATE `orders` SET `order_status` = 'redacted' WHERE `orders`.`order_id` = '$ord_id'; "));
                echo "product redacted";
                header("location: ./order_table.php");
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
                echo $e;
            }
        }else if($reply == 'reject'){
            try{
                mysqli_query($conn, ("UPDATE `orders` SET `order_status` = 'rejected' WHERE `orders`.`order_id` = '$ord_id'; "));
                echo "product redacted";
                header("location: ./order_table.php");
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
                echo $e;
            }
        }else if($reply == 'deliver'){
            echo $find_value_of_order = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `orders` WHERE `order_id` = '$ord_id';")))['order_quantity'];
            echo $find_product_id = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `orders` WHERE `order_id` = '$ord_id';")))['product_id'];
            try{
                mysqli_query($conn, ("UPDATE `orders` SET `order_status` = 'delivered' WHERE `orders`.`order_id` = '$ord_id'; "));
                mysqli_query($conn, ("UPDATE `products` SET `product_stock` = '$find_value_of_order' WHERE `product_id` = '$find_product_id'; "));
                
                header("location: ./order_table.php");
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
                echo $e;
            }
        }
    }
?>