<?php
    include('../../../../db.php');
    session_start();
    $section = '#products-section';
    echo '<pre>';
         print_r($_POST);
         print_r($_FILES);
    echo '</pre>';

    $add_stat = "";
    if(isset($_POST['submit'])){
        $product_category = ucwords($_POST['category']);
        $product_name = ucwords($_POST['prod-name']);
        $product_brand = ucwords($_POST['prod-brand']);
        $product_price = number_format($_POST['prod-price']);
        $product_cost = (float)$product_price * 0.85;
        // echo $product_cost;
        
        $product_size_type = $_POST['size-type'];
        $product_size_value = $_POST['size-value'];

        $product_manufacturer = ucwords($_POST['manufacturer']);

        $photo = $_FILES['product-photo'];                                         //explode('/',$photo['type'])[1]
        // $photo['tmp_name'] = $product_name; yyyyyyyyyyyyyawwwwaaa 2 hours nag debug mao ra diay mali
        $photo_path = '../../../../assets/product_images/' . $product_name . $product_size_value.'.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

        if($photo['error'] == '4'){
            $add_product_sql = "INSERT INTO `products` (`product_id`, `product_name`, `product_brand`,  `product_price`, `product_$product_size_type`, `product_manufacturer`, `product_category`, `product_cost`, `product_photo`,      `status`) 
                                                VALUES (NULL,         '$product_name','$product_brand', '$product_price','$product_size_value',        '$product_manufacturer','$product_category','$product_cost','$photo_upload_name', 'active');";
            try{
                // echo "line 30";
                mysqli_query($conn, $add_product_sql);
                $add_product_stat = "Product successfully added!";
                header("location: ../index.php?section=".urlencode($section)."&status=$add_product_stat");
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
                $add_product_stat = "Failed to add the product!";
                header("location: ../index.php?section=".urlencode($section)."&status=$add_product_stat");
            }
        }else if($photo['type'] == 'image/jpg' || $photo['type'] == 'image/png' || $photo['type'] == 'image/jpeg'){
            $photo_upload_name = $product_name . $product_size_value . '.' .pathinfo($photo['name'], PATHINFO_EXTENSION);;
            $add_product_sql = "INSERT INTO `products` (`product_id`, `product_name`, `product_brand`,  `product_price`, `product_$product_size_type`, `product_manufacturer`, `product_category`, `product_cost`, `product_photo`,       `status`) 
                                                VALUES (NULL,         '$product_name','$product_brand', '$product_price','$product_size_value',        '$product_manufacturer','$product_category','$product_cost','$photo_upload_name',  'active');";
            
            try{
                mysqli_query($conn, $add_product_sql);
                // echo $photo_upload_name;
                if(move_uploaded_file($photo['tmp_name'], $photo_path)){
                    echo "na upload daw";
                }else{
                    echo "wala na upload yawa nima";
                }
                
                $add_product_stat = "Product successfully added!";
                header("location: ../index.php?status=$add_product_stat");
            }catch(mysqli_sql_exception $e){
                if($e->getCode() == 1062){
                    $add_product_stat = "ERROR: Product already exist!";
                    header("location: ../index.php?section=".urlencode($section)."&status=$add_product_stat");
                }else{
                    $add_product_stat = "Failed to add the product!";
                    header("location: ../index.php?section=".urlencode($section)."&status=$add_product_stat");
                }
            }
        }else if(!($photo['type'] == 'image/jpeg') || !($photo['type'] == 'image/png') || !($photo['type'] == 'image/jpg')){
            $add_product_stat = "Invalid file format!";
            header("location: ./add_product_global.php?status=$add_product_stat");
        }
    }else{
        echo "line else";
    }
?>