<?php
    include('../../../../db.php');
    session_start();
    $product_category = "";
    if(isset($_GET['product_category'])){
        $product_category = $_GET['product_category'];
    }
    $status = "";
    if(isset($_GET['status'])){
        $status = $_GET['status'];
        $product_category = $_GET['prod-category'];
    }
    $section = '#products-section';
    // 0.87   =  87%
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
        <form action="./add_product_by_category_logic.php" method="POST" enctype="multipart/form-data"> 
            <fieldset>
                <h3>Add New Product in this Category: <?php echo ucfirst($product_category)?> <span style="color:red"><h3><?php echo $status;?></h3></span></h3>
            </fieldset>
             <fieldset>
                <input type="hidden" name="prod-category" value="<?php echo $product_category?>">
                <label for="prod-name">Product Name:</label>
                <input type="text" name="prod-name" id="" required>
                <label for="prod-brand">Product Brand:</label>
                <input type="text" name="prod-brand" id="" required>
                <label for="prod-price">Price: </label>
                <input type="number" name="prod-price" min="0" step="any" id="" required>
                <select name="size-type" id="">
                    <option value="weight">Weight</option>
                    <option value="volume">Volume</option>
                </select>
                <input type="number" name="size-value" min="0" step="any" id="" required>
                <label for="manufacturer">Manufacturer: </label>
                <input type="text" name="manufacturer" id="">
                <h4>Product Photo: </h4>
                <input type="file" name="product-photo" id="product-photo">
                <div class="wrap-flex-items-row">
                    <input type="submit" name="submit" value="Add Product">
                    <?php echo '<a href="../index.php?section=' . urlencode($section) . '">Cancel</a>';?>
                </div>
             </fieldset>
         </form>
     </main>
</body>
</html>