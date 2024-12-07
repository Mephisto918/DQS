<?php
    include('../../../../db.php');
    session_start();

    // echo '<pre>';
    //      print_r($_POST);
    //      print_r($_FILES);
    //      print_r($_GET);
    // echo '</pre>';

    if(isset($_GET['product_id'])){
        $prod_id = $_GET['product_id'];

        $find_this_item_sql = "SELECT * FROM `products` WHERE `product_id` = '$prod_id';";
        $product = mysqli_fetch_assoc(mysqli_query($conn, $find_this_item_sql));
    }
    $section = '#products-section';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../master.css">
    <link rel="stylesheet" href="../admin-page.css">
    <link rel="stylesheet" href="./products-forms.css">
</head>
<body id="products">
    <main>
        <form action="./edit_products_logic.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <h3>Edit Product</h3>
            </fieldset>
             <fieldset>
            <?php
                echo '<input type="hidden" name="product-id" value="'.$product['product_id'].'">';
                echo '<label for="" title="'.$product['product_name'].'">'.explode('-', $product['product_name'])[0].'</label>';
                echo '<input type="hidden" name="old-product-name" value="'.$product['product_name'].'">';
                echo '<input type="text" name="new-product-name" id="" placeholder="New Name">';
                echo '<label for="" title="'.$product['product_brand'].'">'.$product['product_brand'].'</label>';
                echo '<input type="hidden" name="old-product-brand" value="'.$product['product_brand'].'">';
                echo '<input type="text" name="new-product-brand" placeholder="New Brand">';
                echo '<label for="'.$product['product_price'].'">'.$product['product_price'].' ₱</label>';
                echo '<input type="hidden" name="old-product-price" value="'.$product['product_price'].'">';
                echo '<input type="text" name="new-product-price" placeholder="New Price">';
                if($product['product_weight'] > $product['product_volume']){
                    echo "<td title=".$product['product_weight'].">".$product['product_weight']."g</td>";
                    echo '<input type="hidden" name="old-product-weight" value="'.$product['product_weight'].'">';
                    echo '<input type="text" name="new-product-weight" placeholder="New Wieght">';
                }else{
                    echo "<td title=".$product['product_volume'].">".$product['product_volume']."mL</td>";
                    echo '<input type="hidden" name="old-product-volume" value="'.$product['product_volume'].'">';
                    echo '<input type="text" name="new-product-volume" placeholder="New Volume">';
                }
                echo '<label for="" title="'.$product['product_manufacturer'].'">'.$product['product_manufacturer'].'</label>';
                echo '<input type="hidden" name="old-product-manufacturer" value="'.$product['product_manufacturer'].'">';
                echo '<input type="text" name="new-product-manufacturer" placeholder="New Manufacturer">';
                echo '<h4>New product photo: </h4>';
                echo '<input type="hidden" name="old-product-photo" value="'.$product['product_photo'].'" id="product-photo">';
                echo '<input type="file" name="new-product-photo" id="product-photo">';
                echo '<div class="wrap-flex-items-row">';
                    echo '<input type="submit" name="submit" value="Edit Product">';
                    echo '<a href="../index.php?section=' . urlencode($section) . '">Cancel</a>';
                echo '</div>';
            ?>
             </fieldset>
         </form>
     </main>
</body>
</html>