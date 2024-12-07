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
    <link rel="stylesheet" href="./admin-page.css">
    <link rel="stylesheet" href="./report/report.css">
    <link rel="stylesheet" href="./section-handler.css">
    <link rel="stylesheet" href="../../../master.css">
    <link rel="stylesheet" href="./tables.css">
    <link rel="stylesheet" href="./confirmation.css">
    <script src="./admin.js" defer></script>
    <script src="../../../JSLibraries/jQuery/jquery-3.7.1.js"></script>
    <script src="./confirmation.js" defer></script>
    <script src="./report/reportgraphs.js" defer></script>
    <script src="../../../JSLibraries/d3.v7.min.js"></script>
    <script src="./report/testing_fetch.js" defer></script>
    <script src="./report/inquiries.js" defer></script>
<body>
    <main>
        <header>
            <h1 style="text-shadow: -1px 2px 4px var(--hard-shadow);">Admin Dashboard</h1>
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
                <a href="./edit_account.php " class="add-user edit-account">Edit Account</a>
            </div>
            <nav>
                <button id="reportbtt" class="section-button" data-section="#report-section">Report</button>
                <button id="productsbtt" class="section-button" data-section="#products-section">Products</button>
                <button id="ordersbtt" class="section-button" data-section="#orders-section">Orders</button>
                <button id="inventorybtt" class="section-button" data-section="#inventory-section">Inventory</button>
                <button id="employeesbtt" class="section-button" data-section="#employees-section">Employees</button>
                <button id="logoutbtt">Log Out</button>
            </nav>
        </header>
        
        <section class="display-visible section" id="report-section"> <!--remve gride afet -->
            <div style="height: fit-content; display: flex; gap: 1rem;">
                <button id="chartbtt" class="report-section-button" data-report="#chart-report">Charts</button>
                <button id="inquiriesbtt" class="report-section-button" data-report="#inquiries-report">Inquiries</button>
            </div>
            <div class="report-section-items">
                <div class="chartday">
                    <div class="label-result">
                        <h1>Today's Revenue</h1>
                        <h2>₱<span id="revenue">2336.00</span></h2>
                    </div>
                    <!-- <canvas id="revenue-canvas" width="400" height="200">
                        
                    </canvas> -->
                    <!-- <svg id="chart" width="400" height="200"></svg> -->
                    
                    <svg id="chartday" width="400px" height="200px"></svg>
                </div>
                <div id="pie-section">
                    <div class="pies">
                        <div class="pie"></div>
                        <h5>Total Revenue</h5>
                    </div>
                    <div class="pies">
                        <div class="pie"></div>
                        <h5>Stock Status</h5>
                    </div>
                    <div class="pies">
                        <div class="pie"></div>
                        <h5>Total Customers</h5>
                    </div>
                    <div class="pies">
                        <div class="pie"></div>
                        <h5>1</h5>
                    </div>
                </div>
                <div class="chartweek">
                    <div class="label-result">
                        <h1>Week's Revenue</h1>
                        <h2>₱<span id="revenue">2336.00</span></h2>
                    </div>
                    <svg id="chartweek" width="400px" height="200px"></svg>
                </div>
                <div class="chartmonth">
                    <div class="label-result">
                        <h1>Month's Revenue</h1>
                        <h2>₱<span id="revenue">2336.00</span></h2>
                    </div>
                    <svg id="chartmonth" width="400px" height="200px"></svg>
                </div>
            </div>
            <div id="products" class="inquiries">
                <div id="submit-section">
                    <form id="date_range_selector">
                        <div class="form-container">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-container">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" required>
                        </div>

                        <button type="submit">Submit</button>
                    </form>
                </div>
                <table>
                    <tbody>
                        <tr>
                            <th colspan="3" style="text-align: right; font-size: 20pt;" id="total_sales">0</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                        <tbody id="sales_table">

                        </tbody>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="display-none section" id="products-section">
            <div id="products">
                <a href="./products/add_product_global.php" class="add-new-product"><h1>+ New Product</h1></a>
                <?php
                    $orders_categories = [];
                    while($row = mysqli_fetch_assoc($products_products)){
                        $orders_categories[$row['product_category']][] = $row;
                    }
                    foreach($orders_categories as $category => $products){
                        echo '<div class="category">';
                        echo '<div style="display: flex; flex-direction: row;">';
                            echo "<h2>".ucwords($category)."</h2>";
                            echo '<h3><a href="./products/add_product_by_category.php?product_category='.$category.'" class="add-product-on-category">+ Product</a></h3>';
                        echo '</div>';    
                        echo "<table>";
                            echo "<tr>";
                            echo "<th>Name</th>";
                            echo "<th>Brand</th>";
                            echo "<th>Size</th>";
                            echo "<th>Price</th>";
                            echo "<th>Stock</th>";
                               echo "<th>Edit</th>";
                               echo "<th>Delete</th>";
                        echo "</tr>";
                            foreach($products as $product){
                            echo "<tr>";
                                echo "<td title='".$product['product_name']."'>".explode("-",$product['product_name'])[0]."</td>";
                                echo "<th title=".$product['product_brand'].">".$product['product_brand']."</th>";
                                    if($product['product_weight'] > $product['product_volume']){
                                        echo "<td title=".$product['product_weight'].">".$product['product_weight']."g</td>";
                                    }else{
                                        echo "<td title=".$product['product_volume'].">".$product['product_volume']."mL</td>";
                                    }
                                echo "<td title=".$product['product_price'].">".$product['product_price']."&nbsp;₱</td>";
                                echo "<td title=".$product['product_stock'].">".$product['product_stock']."</td>";
                                echo '<td><a href="./products/edit_products.php?product_id='.$product['product_id'].'" class="edit"><p>Edit</p></a></td>';
                                echo '<td><a href="./products/delete_product.php?product_id='.$product['product_id'].'" class="delete" name="delete-product"><p>Delete</p></a></td>';
                            echo "<tr>";
                            }
                        echo "</table>";
                    }
                ?>
            </div>
        </section>
        <section class="display-none section" id="orders-section">
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
        <section class="display-none section" id="employees-section">
            <div id="employee-section-container">
                <a href="./employees/add_user.php" class="add-user">Add User</a>
                <table id="employee-table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Position</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                        $employee_table = "Select * from employees";
                        $employee_table_row = mysqli_query($conn, $employee_table);
                    
                        while($table_row = mysqli_fetch_assoc($employee_table_row)) :?>
                            <tr>
                                <th title="<?php echo $table_row['employee_id'] ?>"><?php echo $table_row['employee_id'] ?></th>
                                <td title="<?php echo $table_row['employee_firstname'] ?> <?php echo $table_row['employee_lastname'] ?>"><?php echo $table_row['employee_firstname'] ?> <?php echo $table_row['employee_lastname'] ?></td>
                                <td title="<?php echo $table_row['employee_username'] ?>"><?php echo $table_row['employee_username'] ?></td>
                                <td title="<?php echo $table_row['employee_role'] ?>"><?php echo $table_row['employee_role'] ?></td>
                                <td ><a href="./employees/edit_user.php?employee_id=<?php echo $table_row['employee_id']?>
                                                                      &employee_firstname=<?php echo $table_row['employee_firstname']?>
                                                                      &employee_lastname=<?php echo $table_row['employee_lastname']?>
                                                                      &employee_username=<?php echo $table_row['employee_username']?>" class="edit"><p>Edit</p></a></td>
                                <td ><a name="delete-employee" href="./employees/delete_user.php?employee_id=<?php echo $table_row['employee_id']?>" class="delete"><p>Delete</p></a></td>
                                
                            </tr>
                    <?php endwhile ?>
                </table>
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
    <div id="confirmation-box" class="modal">
        <div class="modal-contents">
            <p class="confirmation-text"></p>
            <div>
                <button id="confirm_yes">Yes</button>
                <button id="confirm_no">No</button>
            </div>
        </div>
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