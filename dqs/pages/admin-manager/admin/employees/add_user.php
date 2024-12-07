<?php
    include('../../../../db.php');
    session_start();
    // INSERT INTO `employees` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_username`, `employee_password`, `employee_phone_no`, `employee_role`) VALUES (NULL, 'Edward', 'Camagong', 'Edward123', 'edward12345', '09455219703', 'admin'); 
    $section = '#employees-section';
    $add_stat = "";
    if(isset($_POST['firstname']) &&
       isset($_POST['lastname']) &&
       isset($_POST['username']) &&
       isset($_POST['password']) &&
       isset($_POST['phone-number']) &&
       isset($_POST['employee-role'])){

        $add_firstname = $_POST['firstname'];
        $add_lastname = $_POST['lastname'];
        $add_username = $_POST['username'];
        $add_password = $_POST['password'];
        $add_phone_number = $_POST['phone-number'];
        $add_role = $_POST['employee-role'];

        if(empty($add_firstname) ||
           empty($add_lastname) ||
           empty($add_username) ||
           empty($add_password)){
            $add_stat = "Fill the given fields!";   
        }
        else{
            $add_user_sql = "INSERT INTO `employees` (`employee_id`, `employee_firstname`, `employee_lastname`, `employee_username`, `employee_password`, `employee_phone_no`, `employee_role`) 
                                VALUES (NULL, '$add_firstname', '$add_lastname', '$add_username', '$add_password', '$add_phone_number', '$add_role');";

                try{
                    mysqli_query($conn, $add_user_sql);
                    $add_stat = "User Successfully Added!";
                    header("location: ../index.php?section=".urlencode($section)."&status=$add_stat");
                }catch(mysqli_sql_exception $e){
                    if($e->getCode() == 1062){
                        $add_stat = $e->getMessage();
                        header("location: ../index.php?section=".urlencode($section)."&status=$add_stat");
                    }
                    else{
                        $add_stat = "An unexpected error occurred!";
                        header("location: ../index.php?section=".urlencode($section)."&status=$add_stat");
                    }
                }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../../master.css">
    <link rel="stylesheet" href="../admin-page.css">
    <link rel="stylesheet" href="../confirmation.css">
    <script src="../confirmation.js" defer></script>
    <script src="../../../../JSLibraries/jQuery/jquery-3.7.1.min.js"></script>
</head>
<body id="edit">
    <main>
       <form action="./add_user.php" method="post" id="add-user-form">
            <fieldset>
                <error class="wrap-flex-items-row" style="gap: 1rem">
                    <h3>Add User</h3>
                    <h4 id="error" style="color: red";"><?php echo $add_stat?></h4>
                </error>
                <input required type="text" name="firstname" id="firstname" placeholder="Firstname">
                <input type="text" name="lastname" id="lastname" placeholder="Lastname" required>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="text" name="phone-number" id="phone-number" placeholder="Phone Number (Optional)">
                <h4>Employee Position</h4>
                <select name="employee-role" id="employee-role">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
                <div class="wrap-flex-items-row">
                    <input type="submit" value="Add User" id="submit_button">
                    <?php echo '<a href="../index.php?section=' . urlencode($section) . '">Cancel</a>';?>
                </div>
            </fieldset>
        </form>
        <div id="confirmation-box" class="modal">
            <div class="modal-contents">
                <p>Are you sure you want to add this new user?</p>
                <p>Please confirm to proceed</p>
                <div>
                    <button id="confirm_yes">Yes</button>
                    <button id="confirm_no">No</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>