<?php
    include('../../../../db.php');
    session_start();
    // UPDATE `employees` SET `employee_id` = NULL, `employee_firstname` = 'edit', `employee_lastname` = 'edit', `employee_username` = 'edit', `employee_password` = 'edit', `employee_phone_no` = 'edit', `employee_role` = 'edit' WHERE `employees`.`employee_id` = 9; 
    $section = '#employees-section';
    $edit_stat = "";
    $target_emp_id = "";
    $emp_firstname = "";
    $emp_lastname = "";
    $emp_username = "";
    if(isset($_GET['employee_id']) && isset($_GET['employee_firstname']) && isset($_GET['employee_lastname']) && isset($_GET['employee_username'])){
        $target_emp_id = $_GET['employee_id'];
        $emp_firstname = $_GET['employee_firstname'];
        $emp_lastname = $_GET['employee_lastname'];
        $emp_username = $_GET['employee_username'];
    }
    if(isset($_GET['edit_stat'])){
        $edit_stat = $_GET['edit_stat'];
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
    <script src="../../../../JSLibraries/jQuery/jquery-3.7.1.js"></script>
    <script src="../confirmation.js"></script>
</head>
<body id="edit">
    <main>
       <form action="./edit_user_logic.php" method="post" id="edit-user-form">
            <fieldset>
                <error class="wrap-flex-items-row" style="gap: 1rem">
                    <h3>Edit User</h3>
                    <h4 id="error"><?php echo $edit_stat?></h4>
                </error>
                <error class="wrap-flex-items-row" style="gap: 1rem">
                    <h4><?php echo $emp_firstname?> <?php echo $emp_lastname?></h4>
                    <h4><?php echo $emp_username?> <?php echo $target_emp_id?></h4>
                </error>
                <input type="hidden" name="emp_id" value="<?php echo $target_emp_id?>">
                <input type="text" name="firstname" id="" placeholder="Firstname" required>
                <input type="text" name="lastname" id="" placeholder="Lastname" required>
                <input type="text" name="username" id="" placeholder="Username" required>
                <h4>Employee Position</h4>
                <select name="employee_role" id="">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                </select>
                <div class="wrap-flex-items-row">
                    <input type="submit" value="Update User" id="submit_button">
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