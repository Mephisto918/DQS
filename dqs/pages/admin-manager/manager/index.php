<?php
    session_start();
    include('../../../db.php');

    if(!isset($_SESSION['emp_firstname'])){
        header("location: ../../../index.php");
        exit();
    }else{
        $user_id = $_SESSION['emp_id'];
        $user_firstname = $_SESSION['emp_firstname'];
        $user_lastname = $_SESSION['emp_lastname'];
        $user_pfp = $_SESSION['emp_pfp'];

        $pfp_query_sql = "SELECT `employee_profile_pic` FROM `employees` where `employee_id` = '$user_id';";
        $result_query = mysqli_query($conn, $pfp_query_sql);
        $pfp = mysqli_fetch_assoc($result_query);
        
        $user_session_id = $user_id;
        $user_query = "SELECT * FROM `employees` where `employee_id` = '$user_id';";
        $result_user_query = mysqli_query($conn, $user_query);
        $user = mysqli_fetch_assoc($result_user_query);

        $user_logged_firstname = $user['employee_firstname'];
        $user_logged_lastname = $user['employee_lastname'];
    }
    if(isset($_GET['status'])){
        $_SESSION['status2'] = $_GET['status'];
    }
    $status_message = isset($_SESSION['status2']) ? $_SESSION['status2'] : null;
    unset($_SESSION['status2']);


    //for tables
    $products_sql = "SELECT * FROM `products`;";
    $products_products = mysqli_query($conn, $products_sql);
    $order_products = mysqli_query($conn, $products_sql);
    $inventory_products = mysqli_query($conn, $products_sql);
?>


<?php ///               ₱         peso na character kay kapoyg google    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Page</title>
    <link rel="stylesheet" href="./manager-page.css">
    <link rel="stylesheet" href="./section-handler.css">
    <link rel="stylesheet" href="../../../master.css">
    <link rel="stylesheet" href="./tables.css">
    <link rel="stylesheet" href="./confirmation.css">
    <script src="./manager.js" defer></script>
    <script src="../../../JSLibraries/jQuery/jquery-3.7.1.js"></script>
    <script src="./confirmation.js" defer></script>
<body>
    <main>
        <header>
            <h1 style="text-shadow: -1px 2px 4px var(--hard-shadow);">Manager Dashboard</h1>
            <div id="admin-info">
                <div id="dp-name-wrapper">
                    <div id="admin-photo">
                        <?php
                            if((empty($pfp['employee_profile_pic']))){
                                echo '
                                <div id="svg" style="width: 50px; height: 50px; border-radius: 50%; border: 1px double var(--secondary); object-fit: cover; background-size: 100%; box-shadow: -1px 2px 4px var(--hard-shadow);">
                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 178.29 202.03" style="width: 50px; height: 50px; border-radius: 50%; border: 1px double var(--secondary); object-fit: cover; background-size: 100%;">
                                        <path class="strokes" d="m178.25,202.03H0c.56-30.5,12.04-55.8,37.23-74.24,27.27-19.97,66.33-22.74,97.66-4.38,31.3,18.35,44.23,53.04,43.36,78.62Z"/>
                                        <path class="strokes" d="m142.66,52.4c-.07,30.71-24.57,51.77-52.65,52.34-32.23.66-54.27-25.6-54.21-52.63C35.84,27.91,55.06.12,89.23,0c31.24-.11,53.83,25.24,53.43,52.4Z"/>
                                    </svg>
                                </div>';
                            }else{
                                echo '<img style="box-shadow: -1px 2px 4px var(--hard-shadow);" src="../../../assets/profile_pictures/' . $pfp['employee_profile_pic'] . '" alt="">';   
                                        
                            }
                        ?>
                    </div>
                    <h3 id="admin-firstname"><?php echo $user_logged_firstname?></h3>
                    <h3 id="admin-lastname"><?php echo $user_logged_lastname?></h3>
                </div>
                <a href="./editaccount.php " class="add-user edit-account">Edit Account</a>
            </div>
            <nav>
                <button id="ordersbtt" class="section-button" data-section="#orders-section">Orders</button>
                <button id="inventorybtt" class="section-button" data-section="#inventory-section">Inventory</button>
                <button id="logoutbtt">Log Out</button>
            </nav>
        </header>
        
        <section class="display-visible section" id="orders-section">
            <div id="products">
            <a style="padding: 1rem 0.5rem;" href="./orders/order_pending_list.php" class="add-new-product"><h1>Pending Orders</h1></a>
                <?php
                    $order_manufacturers = [];
                    while($row = mysqli_fetch_assoc($order_products)){
                        $order_manufacturers[$row['product_manufacturer']][] = $row;
                    }
                    foreach($order_manufacturers as $manufacturer => $products){
                        echo "<div class='category'>";
                        echo "<h2>".ucwords($manufacturer)."</h2>";
                        echo "<table>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th>Brand</th>";
                            echo "<th>Size</th>";
                            echo "<th>Price</th>";
                            echo "<th>Category</th>";
                            echo "<th>Stock</th>";
                            echo "<th>Order</th>";
                        echo "</tr>";
                            foreach($products as $product){
                                $product_size_send = "";
                            echo "<tr>";
                                echo "<td title='".$product['product_name']."'>".explode('-',$product['product_name'])[0]."</td>";
                                echo "<th title=".$product['product_brand'].">".$product['product_brand']."</th>";
                                if($product['product_weight'] > $product['product_volume']){
                                    echo "<td title=".$product['product_weight'].">".$product['product_weight']."g</td>";
                                    $product_size_send = $product['product_weight'];
                                }else{
                                    echo "<td title=".$product['product_volume'].">".$product['product_volume']."mL</td>";
                                    $product_size_send = $product['product_volume'];
                                }
                                echo "<td title=".$product['product_price'].">".$product['product_price']."&nbsp;₱</td>";
                                echo "<td title=".$product['product_category'].">".$product['product_category']."</td>";
                                echo "<td title=".$product['product_stock'].">".$product['product_stock']."</td>";
                                echo '<td><a href="./orders/orders.php?product_id='.$product['product_id'].'" class="order">Order</a></td>'; 
                                                                      ////////not finished. make a if statement in shorthand about size,
                            echo "<tr>";
                            }
                        echo "</table>";
                    }
                ?>
            </div>
        </section>
        <section class="display-none section" id="inventory-section">
            <div id="Inventory">
                <?php
                    $inventory_categories = [];
                    while($row = mysqli_fetch_assoc($inventory_products)){
                        $inventory_categories[$row['product_category']][] = $row;
                    }
                    foreach($inventory_categories as $category => $products){
                        echo "<div class='category'>";
                        echo "<h2>".ucwords($category)."</h2>";
                        echo "<table>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th>Brand</th>";
                            echo "<th>Size</th>";
                            echo "<th>Price</th>";
                            echo "<th>Stock</th>";
                        echo "</tr>";
                            foreach($products as $product){
                            echo "<tr>";
                                echo "<td title='".$product['product_name']."'>".explode('-',$product['product_name'])[0]."</td>";
                                echo "<th title='".$product['product_brand']."'>".$product['product_brand']."</th>";
                                if($product['product_weight'] > 0){
                                    echo "<td title='".$product['product_weight']."'>".$product['product_weight']."g</td>";
                                }else{
                                    echo "<td title='".$product['product_volume']."'>".$product['product_volume']."mL</td>";
                                }
                                echo "<td title='".$product['product_price']."'>".$product['product_price']."&nbsp;₱</td>";
                                echo "<td title='".$product['product_stock']."'>".$product['product_stock']."</td>";
                            echo "<tr>";
                            }
                        echo "</table>";
                    }
                ?>
            </div>
        </section>
    </main>
    <div id="logout-panel" style="display: none;">
        <h1>Log Out?</h1>
        <a href="./logout.php?"><h3>YES</h3></a>
        <button id="no-logout"><h3>NO</h3></button>
    </div>
    <div class="status" id="status_message" style="display: none;">
    </div>
</body>
<style>
#svg > svg > .strokes{
    fill: var(--primary-dark);
}
</style>
<!-- 


 -->
</html>