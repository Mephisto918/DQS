<?php
    include('../../../../db.php');
    session_start();

    $section = '#employees-section';

    if (!isset($_SESSION['emp_id'])) {
        header("Location: ../index.php");
        exit();
    }
    
    $delete_stat = "";
    $folder_path = '../../../../assets/profile_pictures/';
    if(isset($_GET['employee_id'])){
        $emp_id = $_GET['employee_id'];

        $delete_query = "DELETE FROM `employees` WHERE `employee_id` = '$emp_id';";

        $find_old_photo = mysqli_fetch_assoc(mysqli_query($conn ,("SELECT * FROM `employees` WHERE `employee_id` = '$emp_id';")))['employee_profile_pic'];
        echo $folder_path . $find_old_photo;
        try{
            mysqli_query($conn, $delete_query);
            if(file_exists($folder_path. $find_old_photo)){
                if(unlink($folder_path. $find_old_photo)){
                    echo "na delete daw";
                }else{
                    echo "wala na delete ang file";
                }
            }else{
                echo "walay file";
            }
            $delete_stat = "Sucessfully Deleted";
            header("Location: ../index.php?section=".urlencode($section)."&status=$delete_stat");
            exit();
        }catch(mysqli_sql_exception $e){
            $delete_stat = $e;
            echo $error;
        }
        $_SESSION['delete_stat'] = $delete_stat;
        header("Location: ../index.php?status=$delete_stat&section=".urlencode($section));
        exit();
    }else{
        $delete_stat = "No employee ID provided.";
        header("Location: ../index.php?status=$delete_stat&section=".urlencode($section));
        exit();
    }
?>