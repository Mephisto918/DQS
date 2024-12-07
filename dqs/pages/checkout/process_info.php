<?php
    include('../../db_no_indi.php');
    session_start();

    
    $prod_ids = $_SESSION['item_id'];
    
    $total_am = 0;
    $total_items = 0;
    foreach($prod_ids as $id){ ////////// kalimot kos total amount haha
        $product = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `products` WHERE `product_id` = '$id';")));
        $price = (float)$product['product_price'];
        $total_am += $price;
        $total_items++; 
    }

    function count_quantity($ids){
        $count_item = [];
        // for($a = count($arr_id); $a < 0; $a++){
        //     echo $a . '<br>';
        // }
        foreach($ids as $id){
            if(isset($count_item[$id])){
                $count_item[$id ]++;    //if exist add counter
            }else{
                $count_item[$id] = 1;   //if not, init 1
            }
        }
        $sorted_arr = [];
        foreach($count_item as $id => $count){
            $sorted_arr[] = [$id, $count];    //subset arr  [item id, quantity]
        }
        return $sorted_arr;
    }
    $items = [];
    $sorted = count_quantity($prod_ids);

    
    foreach($sorted as $item){
        $id = $item[0];       // 1st sub array => id
        $quantity = $item[1]; //2nd sub array => count
        if($item_info = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `products` WHERE `product_id` = $id;")))){
            $size = "";
            $size_type = "";
            if($item_info['product_weight']){
                $size = $item_info['product_weight'];
                $size_type = 'g';
            }else{
                $size = $item_info['product_volume'];
                $size_type = 'mL';
            }

            // echo $item_info['product_name'] . ' ' .$item_info['product_price'] . 'Count x '.$quantity .$size.$size_type.' <br>';
            $items [] = [
                'id' => $id,
                'quantity' => $quantity,
                'price' => $item_info['product_price'],
                'name' => $item_info['product_name'],
                'size' => $size,
                'size_type' => $size_type
            ];
        }    
    }
    header('Content-Type: application/json');
    echo json_encode(['items_array' => $items,
                      'total_amount' => $total_am,
                      'total_items'  => $total_items]);
?>