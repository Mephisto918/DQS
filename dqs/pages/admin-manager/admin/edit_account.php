<?php
    include('../../../db.php');
    session_start();

    $edit_stat = "";
    if(isset($_GET['edit-account-stat'])){
        $edit_stat = $_GET['edit-account-stat'];
    }
    if(isset($_SESSION['emp_id'])){
       $emp_id = $_SESSION['emp_id'];
    }
    $emp_old_data = mysqli_fetch_assoc(mysqli_query($conn, ("Select * from `employees` where `employee_id` = '$emp_id';")));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../master.css">
    <link rel="stylesheet" href="./admin-page.css">
</head>
<body id="edit">
    <main>
       <form action="./edit_account_logic.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <error class="wrap-flex-items-row" style="gap: 1rem; grid-column-end: 3;
  grid-column-start: 1;">
                    <h3>Edit Account</h3>
                    <h4 id="error" style="color: red"><?php echo $edit_stat?></h4>
                </error>
                <?php
                    echo '<label>'.$emp_old_data['employee_firstname'].'</label>';
                    echo '<input type="hidden" name="old-firstname" value="'.$emp_old_data['employee_firstname'].'">';
                    echo '<input type="text" name="firstname" id="" placeholder="Firstname">';
                    echo '<label>'.$emp_old_data['employee_lastname'].'</label>';
                    echo '<input type="hidden" name="old-lastname" value="'.$emp_old_data['employee_lastname'].'">';
                    echo '<input type="text" name="lastname" id="" placeholder="Lastname">';
                    echo '<label>'.$emp_old_data['employee_username'].'</label>';
                    echo '<input type="hidden" name="old-username" value="'.$emp_old_data['employee_username'].'">';
                    echo '<input type="text" name="username" id="" placeholder="Username">';
                    echo '<input type="hidden" name="old-password" value="'.$emp_old_data['employee_password'].'">';
                    echo '<input type="password" name="password" id="" placeholder="New Password" style="grid-column-end: 2;grid-column-start: 2;">';
                    echo '<error class="wrap-flex-items-row" style="justify-content: space-between; grid-column-end: 3;grid-column-start: 1;">';
                        echo '<h4>Add Profile Picture</h4>';
                        echo '<input type="file" name="profile-picture" id="profile-picture" style="
                        border-radius: 5px;
                        padding: 0.8rem;
                        box-shadow: 0px 0px 10px 1px var(--hard-shadow);">';
                    echo '</error>';
                    
                ?>
                <div class="wrap-flex-items-row">
                    <input type="submit" name="submit" value="Update Account">
                    <a href="./index.php">Cancel</a>
                </div>
            </fieldset>
        </form>
    </main>
</body>
</html>