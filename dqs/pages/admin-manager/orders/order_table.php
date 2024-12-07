<?php
    include('../../../db.php');

    $find_orders_sql = "SELECT * FROM `orders`";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../admin/tables.css">
    <link rel="stylesheet" href="../admin/orders/orders.css">
    <link rel="stylesheet" href="../admin/admin-page.css">
    <link rel="stylesheet" href="../../../master.css">
    <link rel="stylesheet" href="../../../style.css">
</head>
<body>
    <main>
        <header>
            <h1 style="text-shadow: -1px 2px 4px var(--hard-shadow);">Processes Table</h1>
            <nav>
                <button onclick="window.location.href = '../admin/orders/order_pending_list.php'">Back</button>
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
                            <th>Redacted</th>
                            <th>Rejected</th>
                            <th>Delivered</th>
                        </tr>
                        <?php
                            $s = mysqli_query($conn, $find_orders_sql);
                            while($row = mysqli_fetch_assoc($s)){
                                if($row['order_status'] == 'pending'){
                                    echo "<tr>";
                                    echo "<th title='".$row['order_id']."'>".$row['order_id']."</th>";
                                    echo "<th title='".$row['product_name']."'>".explode('-',$row['product_name'])[0]."</th>";
                                    echo "<th title='".$row['employee_fullname']."'>".$row['employee_fullname']."</th>";
                                    echo "<td title='".$row['order_quantity']."'>".$row['order_quantity']."</td>";
                                    echo "<td title='".$row['order_amount']."'>".$row['order_amount']." &nbsp;₱</td>";
                                    echo '<td ><a href="./proccess.php?response_type=redact&order_id='.$row['order_id'].'" class="delete"><p>Redact</p></a></td>';
                                    echo '<td ><a href="./proccess.php?response_type=reject&order_id='.$row['order_id'].'" class="delete"><p>Reject</p></a></td>';
                                    echo '<td ><a href="./proccess.php?response_type=deliver&order_id='.$row['order_id'].'" class="edit"><p>Deliver</p></a></td>';
                                
                                }
                            echo "<tr>";
                            }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</style>
</html>