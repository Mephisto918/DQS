<?php
    include('../../../../db.php');
    session_start();
    $emp_id = $_SESSION['emp_id'];
    $id_product = $_GET['product_id'];
    $product_id = $id_product;
    $find_product_price_sql = "SELECT * FROM `products` Where `product_id` = '$id_product';";
    $result_price = mysqli_fetch_assoc(mysqli_query($conn, $find_product_price_sql));
                ///////item price problem
    $item_price = $result_price['product_price'];
    $product_name = $result_price['product_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="../../../../master.css">
    <link rel="stylesheet" href="../manager-page.css">
    <link rel="stylesheet" href="./orders.css">
    <link rel="stylesheet" href="../confirmation.css">
    <script src="../../../../JSLibraries/jQuery/jquery-3.7.1.min.js"></script>
</head>
<body id="orders">
    <main>
        <form action="./orders_logic.php" method="POST" id="order-form">
             <fieldset>
                <legend>Order Form</legend>
                <fieldset>
                    <legend>Order Information</legend>
                    <div class="wrap-flex-items-row">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="" min="1" max="999" required>
                        <input type="hidden" name="item-price" value="<?php echo $item_price?>">
                    </div>
                    <input type="hidden" name="emp_id" value="<?php echo $emp_id?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id?>">
                    <input type="hidden" name="product_name" value="<?php echo $product_name?>">
                    <input type="text" name="phone-no" id="" placeholder="Phonenumber" required>
                    <input type="email" name="email" id="" placeholder="E-mail" maxlength="100" autocomplete="street-address" required>
                    <input type="text" name="ship-add" id="" placeholder="Shipment Adress" required>
                    <fieldset>
                        <label for="">Payment Method</label>
                        <select name="pay-method" id="">
                            <option value="company_account">Company Account</option>
                            <option value="direct_transfer">Direct Transfer</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="electronic_payment">Electronice Payment</option>
                            <option value="internal_payment">Internal Payment</option>
                            <option value="company_funds">Company Funds</option>
                        </select>
                    </fieldset>
                </fieldset>
                <fieldset>
                    <legend>Item Info</legend>
                    <?php
                        if(isset($_GET['product_id'])){
                            $id_product = $_GET['product_id'];
                            $find_product_sql = "SELECT * FROM `products` Where `product_id` = '$id_product';";
                            try{
                                $result = mysqli_fetch_assoc(mysqli_query($conn, $find_product_sql));
                                $names = explode('-',$result['product_name']);
                                
                                // $item_price = $result['product_price'];   item price problem
                                echo '<fieldset >';
                                    echo '<label class="item-desc" title="'.$result['product_name'].'"><strong>'.$name = $names[0].'</strong></label>';
                                         if($result['product_weight'] > $result['product_volume']){
                                        echo '<label class="item-desc" title="'.$result['product_weight'].'">'.$result['product_weight'].'g</label>';
                                        }else{
                                            echo '<label class="item-desc" title="'.$result['product_volume'].'">'.$result['product_volume'].'mL</label>';
                                        }
                                    echo '<label><span class="item-desc">'.$result['product_price'].'</span> ₱</label>';
                                echo '</fieldset>';
                                echo '<div id="img-order-wrap">';
                                    if($result['product_photo']){
                                        echo '<img src="../../../../assets/product_images/'.$result['product_photo'].'" alt="">';
                                        // echo '<img src="../../../../assets/product_images/DelMonte100%Pineapple JuiceiberEnriched220g.jpg" alt="">';
                                    }else{
                                        echo '<div class="no-image"><h3">No Photo!</h3></div>';
                                    }
                                echo '</div>';
                            }catch(mysqli_sql_exception $e){
                                echo $e;
                                echo '<fieldset>';
                                    echo '<h2>Product not found</h2>';
                                echo '</fieldset>';
                            }
                            
                        }
                    ?>
                </fieldset>
                <div class="wrap-flex-items-row">
                    <input type="submit" name="submit" value="Add Product" id="submit_button">
                    <a href="../index.php" id="cancel-btt">Cancel</a>
                </div>
             </fieldset>
         </form>
     </main>
     <div class="status" id="status_message" style="display: none;">
    </div>
     <div id="confirmation-box" class="modal">
        <div class="modal-contents">
            <p class="confirmation-text">Are you sure about the parameter?</p>
            <div>
                <button id="confirm_yes">Yes</button>
                <button id="confirm_no">No</button>
            </div>
        </div>
    </div>
</body>
<script>
</script>
</html>