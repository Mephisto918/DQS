<?php
    include('../../../../db.php');
    session_start();
    $section = '#products-section';
    echo '<pre>';
         print_r($_POST);
         print_r($_FILES);
         print_r($_GET);
    echo '</pre>';

    $edit_product_stat = "";
    if(isset($_POST['submit'])){
        $product_id = $_POST['product-id'];
        if(!empty($_POST['old-product-name']) && empty($_POST['new-product-name'])){
            $state_product_name =  $_POST['old-product-name'];
        }else{
            $state_product_name =  $_POST['new-product-name'];
        }
        if(!empty($_POST['old-product-brand']) && empty($_POST['new-product-brand'])){
            $state_product_brand =  $_POST['old-product-brand'];
        }else{
            $state_product_brand =  $_POST['new-product-brand'];
        }
        if(!empty($_POST['old-product-price']) && empty($_POST['new-product-price'])){
            $state_product_price =  $_POST['old-product-price'];
        }else{
            $state_product_price =  $_POST['new-product-price'];
        }
        $state_product_cost = (float)$state_product_price * 0.85;

        $state_product_size_type = ""; ///// weight / volume
        $state_product_size = "";      /////     kg / ml
        if(isset($_POST['old-product-volume'])){
            if(!empty($_POST['old-product-volume']) && empty($_POST['new-product-volume'])){
                $state_product_size =  $_POST['old-product-volume'];
                $state_product_size_type = 'volume';
            }else{
                $state_product_size =  $_POST['new-product-volume'];
                $state_product_size_type = 'volume';
            }
            $state_product_size_type_symbol = 'mL';
        }else{
            if(!empty($_POST['old-product-weight']) && empty($_POST['new-product-weight'])){
                $state_product_size = $_POST['old-product-weight'];
                $state_product_size_type = 'weight';
            }else{
                $state_product_size = $_POST['new-product-weight'];
                $state_product_size_type = 'weight';
            }
            $state_product_size_type_symbol = 'g';
        }

        if(!empty($_POST['old-product-manufacturer']) && empty($_POST['new-product-manufacturer'])){
            $state_product_manufacturer =  $_POST['old-product-manufacturer'];
        }else{
            $state_product_manufacturer =  $_POST['new-product-manufacturer'];
        }
        
        $photo = $_FILES['new-product-photo'];
        $folder_path = '../../../../assets/product_images/';
        $photo_path = $folder_path . $state_product_name . $state_product_size .'.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
        // echo $photo_path;

        if($photo['error'] == 4){
            $file_name = $state_product_name . $state_product_size .'.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
            echo $find_old_photo = mysqli_fetch_assoc(mysqli_query($conn ,("SELECT * FROM `products` WHERE `product_id` = '$product_id';")))['product_photo'];
            $edit_product_sql = "UPDATE `products` SET `product_name` = '$state_product_name', 
                                `product_brand` = '$state_product_brand', 
                                `product_price` = '$state_product_price', 
                                `product_$state_product_size_type` = '$state_product_size', 
                                `product_manufacturer` = '$state_product_manufacturer', 
                                `product_cost` = '$state_product_cost',
                                `product_photo` = '' 
                                WHERE `products`.`product_id` = '$product_id'; ";
            try{
                
                    if(file_exists($folder_path. $find_old_photo)){
                        if(unlink($folder_path. $find_old_photo)){
                            echo "na delete daw";
                        }else{
                            echo "wala na delete ang file";
                        }
                    }else{
                        echo "walay file";
                    }
                    mysqli_query($conn, $edit_product_sql);
                $edit_product_stat = "Product updated successfully!";
                header("location: ../index.php?section=".urlencode($section)."&status=$edit_product_stat");
            }catch(mysqli_sql_exception $e){
                $edit_product_stat = "There is a problem on updating the product :(";
                header("location: ../index.php?section=".urlencode($section)."&status=$edit_product_stat");
            }
        }else if($photo['type'] == 'image/jpeg' || $photo['type'] == 'image/png' || $photo['type'] == 'image/jpg'){  //////main part 
            $file_name = $state_product_name . $state_product_size.'.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
            $edit_product_sql = "UPDATE `products` SET `product_name` = '$state_product_name', 
                                `product_brand` = '$state_product_brand', 
                                `product_price` = '$state_product_price', 
                                `product_$state_product_size_type` = '$state_product_size', 
                                `product_manufacturer` = '$state_product_manufacturer', 
                                `product_cost` = '$state_product_cost',
                                `product_photo` = '$file_name' 
                                WHERE `products`.`product_id` = '$product_id'; ";
            
            $find_old_photo = mysqli_fetch_assoc(mysqli_query($conn ,("SELECT * FROM `products` WHERE `product_id` = '$product_id';")))['product_photo'];
            $folder_path . $find_old_photo;
            echo $photo['tmp_name'];
            echo $photo_path;
            try{
                // echo "true";
                // mysqli_query($conn, $edit_product_sql);

                if(move_uploaded_file($photo['tmp_name'], $photo_path)){
                    if(file_exists($folder_path. $find_old_photo)){
                        if($file_name == $find_old_photo){

                        }else{
                            if(unlink($folder_path. $find_old_photo)){
                                echo "na delete daw";
                            }else{
                                echo "wala na delete ang file";
                            }
                        }
                    }else{
                        echo "walay file";
                    }
                }else{
                    echo "wala na upload yawa nima";
                }

                $edit_product_stat = "Product updated successfully!";
                header("location: ../index.php?section=".urlencode($section)."&status=$edit_product_stat");
            }catch(mysqli_sql_exception $e){
                echo $e->getMessage();
                $edit_product_stat = "Special Characters are not allowed!";
                header("location: ../index.php?section=".urlencode($section)."&status=$edit_product_stat");
            }
        }else if(!($photo['type'] == 'image/jpeg') || !($photo['type'] == 'image/png') || !($photo['type'] == 'image')){
            $edit_product_stat = "Invalid file format!";
            header("location: ./edit_products.php?status=$edit_product_stat");
        }

    }
?>