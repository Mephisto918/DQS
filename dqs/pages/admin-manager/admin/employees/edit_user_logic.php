<?php
    include('../../../../db.php');
    session_start();
    $section = '#employees-section';

    $edit_stat = "";
    if(isset($_POST['firstname']) && 
        isset($_POST['lastname']) && 
        isset($_POST['username']) && 
        isset($_POST['employee_role']) &&
        isset($_POST['emp_id'])){
        $target_emp_id = $_POST['emp_id'];
        $new_firstname = $_POST['firstname'];
        $new_lastname = $_POST['lastname'];
        $new_username = $_POST['username'];
        $new_employee_role = $_POST['employee_role'];

        if(empty($new_firstname) || empty($new_lastname) || empty($new_username)){
                $edit_stat = "Fill all given fields";
                header("Location: ./edit_user.php?edit_stat=$edit_stat");
        }else{
            $update_employee_sql = "UPDATE `employees` 
                                    SET employee_firstname = '$new_firstname',
                                        employee_lastname = '$new_lastname',     
                                        employee_username = '$new_username', 
                                        employee_role = '$new_employee_role' 
                                    WHERE employee_id = '$target_emp_id';";

            // echo "New Firstname: $new_firstname<br>";
            // echo "New Lastname: $new_lastname<br>";
            // echo "New Username: $new_username<br>";
            // echo "New Employee Role: $new_employee_role<br>";

            // echo "naa ko sud sa query";
            try{
                if(mysqli_query($conn, $update_employee_sql)){
                    $edit_stat = "User edited successfully!";
                    header("Location: ../index.php?section=".urlencode($section)."&status=$edit_stat");
                    exit();
                }
                else{
                    echo "wala mi gana ang query";
                }
            }catch(mysqli_sql_exception $e){
                if($e->getCode() == 1062){
                    $edit_stat = "User already exist!";
                    header("Location: ../index.php?section=".urlencode($section)."&status=$edit_stat");
                }else{
                    $edit_stat = "An error occured!";
                    header("Location: ../index.php?section=".urlencode($section)."&status=$edit_stat");
                }
            }
        }

    }
?>