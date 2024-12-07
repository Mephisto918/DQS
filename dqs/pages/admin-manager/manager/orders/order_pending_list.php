<?php
    include('../../../../db.php');
    $section = '#orders-section';
    $find_orders_sql = "SELECT * FROM `orders`";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./orders.css">
    <link rel="stylesheet" href="../confirmation.css">
    <link rel="stylesheet" href="../manager-page.css">
    <link rel="stylesheet" href="../report.css">
    <link rel="stylesheet" href="../section-handler.css">
    <link rel="stylesheet" href="../tables.css">
    <link rel="stylesheet" href="../../../../master.css">
    <link rel="stylesheet" href="../../../../style.css">
    <script src="./orders.js" defer></script>
    <script src="../../../../JSLibraries/jQuery/jquery-3.7.1.js"></script>
</head>
<body>
    <main>
        <header>
            <h1 style="text-shadow: -1px 2px 4px var(--hard-shadow);">Order Sections</h1>
            <nav>
                <button id="orders-btt">Orders</button>
                <button id="history-btt">History</button>
                <?php echo '<button onclick="window.location.href=\'../index.php?section=' . urlencode($section) . '\'">Back</button>'; ?>
            </nav>
        </header>
        <section class="display-visible" id="orders-section">
            <div id="Inventory">
                <div class="category">
                    <table>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Order Placer</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Email</th>
                            <th>Cost</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            $s = mysqli_query($conn, $find_orders_sql);
                            while($row = mysqli_fetch_assoc($s)){
                                if($row['order_status'] == 'pending'){
                                    echo "<tr>";
                                    echo "<td title='".$row['order_date']."'>".$row['order_date']."</td>";
                                    echo "<th title='".$row['product_name']."'>".explode('-',$row['product_name'])[0]."</th>";
                                    echo "<th title='".$row['employee_fullname']."'>".$row['employee_fullname']."</th>";
                                    echo "<td title='".$row['order_quantity']."'>".$row['order_quantity']."</td>";
                                    echo "<td title='".$row['order_amount']."'>".$row['order_amount']." &nbsp;₱</td>";
                                    echo "<td title='".$row['order_placer_email']."'>".$row['order_placer_email']."</td>";
                                    echo "<td title='".$row['order_shipment_add']."'>".$row['order_shipment_add']."</td>";
                                    // if($row['product_weight'] > 0){
                                    //     echo "<td title='".$row['product_weight']."'>".$row['product_weight']."g</td>";
                                    // }else{
                                    //     echo "<td title='".$row['product_volume']."'>".$row['product_volume']."mL</td>";
                                    // }
                                    echo "<td title='".$row['order_status']."'>".$row['order_status']."</td>";
                                }
                            echo "<tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
        <section id="history-section">
            <div id="Inventory">
                <div class="category">
                    <table>
                        <tr>
                            <th>Order ID</th>
                            <th>Product Name</th>
                            <th>Order Placer</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                            <th>Email</th>
                            <th>Cost</th>
                            <th>Status</th>
                        </tr>
                        <?php
                            $s = mysqli_query($conn, $find_orders_sql);
                            while($row = mysqli_fetch_assoc($s)){
                                if($row['order_status'] != 'pending'){
                                    echo "<tr>";
                                    echo "<td title='".$row['order_date']."'>".$row['order_date']."</td>";
                                    echo "<th title='".$row['product_name']."'>".explode('-',$row['product_name'])[0]."</th>";
                                    echo "<th title='".$row['employee_fullname']."'>".$row['employee_fullname']."</th>";
                                    echo "<td title='".$row['order_quantity']."'>".$row['order_quantity']."</td>";
                                    echo "<td title='".$row['order_amount']."'>".$row['order_amount']." &nbsp;₱</td>";
                                    echo "<td title='".$row['order_placer_email']."'>".$row['order_placer_email']."</td>";
                                    echo "<td title='".$row['order_shipment_add']."'>".$row['order_shipment_add']."</td>";
                                    // if($row['product_weight'] > 0){
                                    //     echo "<td title='".$row['product_weight']."'>".$row['product_weight']."g</td>";
                                    // }else{
                                    //     echo "<td title='".$row['product_volume']."'>".$row['product_volume']."mL</td>";
                                    // }
                                    echo "<td title='".$row['order_status']."'>".$row['order_status']."</td>";
                                }
                            echo "<tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </main>
        <!-- <a class="box" href="../../orders/order_table.php"></a> -->
</body>
<style>
.box{
    background-color: green;
    position: absolute;
    bottom: 0.5rem;
    right: 0.5rem;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
}
</style>
</html>