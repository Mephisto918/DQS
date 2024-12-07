<?php
    include('../../../../db.php');
    session_start();
    $section = "#products-section";

    echo '<pre>';
         print_r($_POST);
         print_r($_GET);
         print_r($_FILES);
    echo '</pre>';
    $del_stat = "";
    if(isset($_GET['product_id'])){
        $target_prod_id = $_GET['product_id'];

        $delete_prod_sql = "DELETE FROM `products` WHERE `product_id` = '$target_prod_id';";
        $find_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `product_id` = '$target_prod_id';"));
        $file_name = $find_photo['product_photo'];
        $file_dir = '../../../../assets/product_images/';

        echo $file_name;
        try{
            if(empty($file_name)){
                echo "empty";
            }else{
                echo "not empty";
                unlink($file_dir.$file_name);
            }
            mysqli_query($conn, $delete_prod_sql);
            $del_stat = "Successfully deleted the product!";
            header("Location: ../index.php?section=".urlencode($section)."&status=$del_stat");
            exit();
        }catch(mysqli_sql_exception $e){
            $del_stat = "There is a problem on deleting the product :(";
            header("Location: ../index.php?section=".urlencode($section)."&status=$del_stat");
        }
    }    
?>