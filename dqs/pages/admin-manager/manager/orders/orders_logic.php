<?php
    include('../../../../db.php');
    session_start();
    $section = '#orders-section';

    echo '<pre>';
         print_r($_POST);
    echo '</pre>';
    $add_order_stat = "";
    if(isset($_POST['submit'])){
        echo "inside function";
        $emp_id = $_POST['emp_id'];
        $prod_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['item-price'];
        $phone_no = $_POST['phone-no'];
        $email = $_POST['email'];
        $ship_add = $_POST['ship-add'];
        $pay_meth = $_POST['pay-method'];

        $total_amount = (float)$quantity * $price;

        $find_emp_full_name_sql = "SELECT * FROM `employees` WHERE `employee_id` = '$emp_id'";
        $result_emp_full_name = mysqli_fetch_assoc(mysqli_query($conn, $find_emp_full_name_sql));
        $emp_fullname = $result_emp_full_name['employee_firstname'] . $result_emp_full_name['employee_lastname'];

        echo $emp_fullname;
        
        $add_order_sql = "INSERT INTO `orders` (`order_id`, `product_id`, `product_name`, `order_quantity`, `employee_id`, `order_amount`, `employee_fullname`, `order_placer_phone_no`, `order_placer_email`, `order_shipment_add`, `order_payment_method`, `order_status`) 
                                        VALUES (NULL,       '$prod_id',  '$product_name', '$quantity',      '$emp_id',     '$total_amount','$emp_fullname',     '$phone_no',             '$email',             '$ship_add',          '$pay_meth',            'pending'); ";

        try{
            mysqli_query($conn, $add_order_sql);
            echo $emp_fullname;
            $add_order_stat = "Successfully Added an order";
            header("location: ../index.php?section=".urlencode($section)."&status=$add_order_stat");
        }catch(mysqli_sql_exception $e){
            echo $add_order_stat = "Error making an order!";
            echo $e->getMessage();
            header("location: ../index.php?section=".urlencode($section)."&status=$add_order_stat");
        }
    }
?>