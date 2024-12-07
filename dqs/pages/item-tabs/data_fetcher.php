<?php
    include('../../db_no_indi.php');
    header('Content-Type: application/json');
    // echo '<pre>';
    //     print_r($_POST);
    //     print_r($_GET);
    // echo '</pre>';

    
    if(isset($_GET['prod_id'])){
        $prod_id = $_GET['prod_id'];
    }
    $item = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `products` where `product_id` = '$prod_id';")));

    if($item_volume = $item['product_volume'] > $item_weight = $item['product_weight']){
        $item_size = $item['product_volume'];
        $item_size_type = 'volume';
    }else{
        $item_size = $item['product_weight'];
        $item_size_type = 'weight';
    }
    
    $item_name = $item['product_name'];
    $item_price = $item['product_price'];
    $item_category = $item['product_category'];
    $item_img = $item['product_photo'];
    $item_id = $item['product_id'];
    $item_brand = $item['product_brand'];

    $response = [
        'prod_id' => $item_id,
        'prod_name' => $item_name,
        'prod_size' => $item_size,
        'prod_size_type' => $item_size_type,
        'prod_price' => $item_price,
        'prod_category' => $item_category,
        'prod_img' => $item_img,
        'prod_brand' => $item_brand
    ];
    echo json_encode($response);
?>