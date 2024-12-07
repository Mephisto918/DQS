<?php
    include('../../db.php');
    session_start();
    // echo '<pre>';
    //     print_r($_SESSION);
    // echo '</pre>';
    $customer_id = $_SESSION['customer_id'];

    // $sales = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `sales` WHERE `customer_id` = '$customer_id';")));
    $sales = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `sales` WHERE `customer_id` = '$customer_id' ORDER BY purchase_date DESC LIMIT 1")));

    // $sales = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `sales` WHERE `customer_id` = '$customer_id';")));
    // echo $sales['sales_date'];
    // echo $sales['sales_date'];

    //to solve this i need the real time and also query it
    //until next time
    // inaccurate display of reciept

    $sales_id = $sales['sales_id'];
    $sales_details = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `sales_details` WHERE `sales_id` = '$sales_id';")));

    $items = $_SESSION['item_id'];
    $item_counter =0;
    foreach($items as $item){
        $item_counter+=1;
    }
    // echo $item_counter;
    $vat_percentage = 0.12;
    $total_am = $sales['purchase_total_amount'];
    $vatable = $total_am - ($total_am * $vat_percentage);
    $vat = $total_am * $vat_percentage;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../master.css">
    <link rel="stylesheet" href="../checkout/check.css">
    <link rel="stylesheet" href="./receipt.css">
    <title>DQS</title>
    <script src="../../JSLibraries/bwip-js-master/"></script>
</head>
<body id="receipt">
    <main>
        <main-body2>
            <div id="receipt">
                <h3>ROBINSON SUPERMARKET CORPORATION <br>
                    VAT REG TIN 000-405-340-090 <br>
                    ORMOC CENTRUM <br>
                    AVILES STREET <br>
                    ORMOC CITY
                </h3>
                <?php
                    $item_show = mysqli_fetch_all(mysqli_query($conn, ("SELECT `product_id`, `product_quantity`, `product_price` FROM `sales_details` where `sales_id` = '$sales_id';")), MYSQLI_ASSOC);
                    foreach($item_show as $show){
                        $prod_id = $show['product_id'];
                        $prod = mysqli_fetch_assoc(mysqli_query($conn, ("SELECT * FROM `products` where `product_id` = '$prod_id';")));
                        echo '<div id="items">';
                            echo '<div class="item">';
                                echo '<p id="item-name">'.$prod['product_name'].'</p>';
                                echo '<p id="item-qty">x '.$show['product_quantity'].'</p>';
                                echo '<p id="item-price">'.$show['product_price'].'&nbsp;V   </p>';
                            echo '</div>';
                        echo '</div>';
                    }
                ?>
                <div id="items">

                </div>
                <footer id="receipt-footer">
                    <hr style="background-color: black; margin: 0; border: 1px solid rgb(35, 35, 35);">
                    <div class="foot" style="font-size: 15pt; font-weight: bolder;"><p>TOTAL :</p><p id="total-amount"><?php echo '₱'. $sales['purchase_total_amount']?></p></div>
                    <div class="foot"><p>PAYMENT-METHOD :</p><p><?php echo $sales['payment_method']?></p></div>

                    <div id="vat-sec">
                        <div class="foot"><p>Vatable :</p><p id="vatable"><?php echo $vatable ?></p></div>
                        <div class="foot"><p>VAT :</p><p id="vat"><?php echo $vat?></p></div>
                        <div class="foot"><p>VAT Exempt Sales :</p><p>0.00</p></div>
                        <div class="foot"><p>Zero Rated SAles :</p><p>0.00</p></div>
                        <div class="foot"><p>TOTAL :</p><p id="total-amount2"><?php echo $total_am?></p></div>
                    </div>
                    <hr style="background-color: black; margin: 0; border: 1px solid rgb(35, 35, 35);">
                    <div class="foot" style="justify-content: start; gap: 0.5rem"><p>Total Items:</p><p id="total-items"><?php echo $item_counter?></p></div>
                    <div class="foot" style="justify-content: start; gap: 0.5rem"><p>Data:</p><?php echo $sales['purchase_date']?><p id="total-items" style="margin: 0;"></p><p>Time:</p><p id="total-items" style="margin: 0;"><?php echo $sales['purchase_time']?></p></div>
                </footer>
            </div>
            <div id="back-to-cart">
                <hr>
                <h3>Thank You For Shopping!</h3>
                <a href="../../index.php">Exit</a>
            </div>
        </main-body2>
    </main>
</body>
</html>