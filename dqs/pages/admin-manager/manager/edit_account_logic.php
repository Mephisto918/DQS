<?php
    include('../../../db.php');
    echo '<pre>';
         print_r($_POST);
         print_r($_FILES);
         print_r($_GET);
    echo '</pre>';
    session_start();
    $edit_stat = "";
    if(isset($_POST['submit'])){
        $target_emp_id = $_SESSION['emp_id'];

        $state_firstname = !empty($_POST['old-firstname']) && empty($_POST['firstname']) ? $_POST['old-firstname'] : $_POST['firstname'];
        $state_lastname = !empty($_POST['old-lastname']) && empty($_POST['lastname']) ? $_POST['old-lastname'] : $_POST['lastname'];
        $state_username = !empty($_POST['old-username']) && empty($_POST['username']) ? $_POST['old-username'] : $_POST['username'];
        $state_password = !empty($_POST['old-password']) && empty($_POST['password']) ? $_POST['old-password'] : $_POST['password'];

        $new_profile_picture = $_FILES['profile-picture'];
        $emp_fullname = $state_firstname . " " . $state_lastname;

        $photo = $_FILES['profile-picture'];
        $folder_path = '../../../assets/profile_pictures/';
        $photo_path = $folder_path . $emp_fullname . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

        if(empty($new_profile_picture)){ //orig
            $new_profile_picture = "";
        }else{
            // $time = time();
            $pfp_name = $new_profile_picture['name'];
            $pfp_temp_name = $new_profile_picture['tmp_name'];
            $pfp_destination_path = '../../../assets/profile_pictures/' . $pfp_name;
            $allowed_files = ['png', 'jpg', 'jpeg', ''];
            $file_extention = explode('.', $pfp_name);
            $file_extention = end($file_extention);
        }

            if($new_profile_picture['error'] == '4'){
                    $get_old_user_pfp = "Select `employee_profile_pic` From `employees` where `employee_id` = '$target_emp_id';";
                    $find_old_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `employees` where `employee_id` = '$target_emp_id';"))['employee_profile_pic'];

                    $update_user_account_sql = "UPDATE `employees` 
                                        SET employee_firstname = '$state_firstname',
                                            employee_lastname = '$state_lastname',     
                                            employee_username = '$state_username', 
                                            employee_password = '$state_password', 
                                            employee_profile_pic = '$pfp_name' 
                                        WHERE employee_id = '$target_emp_id';";
                    try{
                        $old_user_pfp = mysqli_fetch_assoc(mysqli_query($conn, $get_old_user_pfp));
                            if(file_exists($folder_path. $find_old_photo)){
                                if(unlink($folder_path. $find_old_photo)){
                                    echo "na delete daw";
                                }else{
                                    echo "wala na delete ang file";
                                }
                            }else{
                                echo "walay file";
                            }
                        mysqli_query($conn, $update_user_account_sql);
                        move_uploaded_file($pfp_temp_name, $pfp_destination_path);
                        $edit_stat = "Account Updated!";
                        header("location: ./index.php?status=$edit_stat");
                        die();
                    }catch(mysqli_sql_exception $e){
                        if($e->getCode() == 1062){
                            $edit_stat = "Username already in use";
                            header("location: ./edit_account.php?edit-account-stat=$edit_stat");
                            die();
                        }else{
                            $edit_stat = "line 62 error";
                            header("location: ./edit_account.php?edit-account-stat=$edit_stat");
                            die();
                        }
                    }
                header("location: ./edit_account.php?edit-account-stat=$edit_stat");
            }else if((in_array($file_extention, $allowed_files) == false)){
                echo "line 50";
                $edit_stat = "Invalid file format!";
                header("location: ./edit_account.php?edit-account-stat=$edit_stat");
        }   else if(in_array($file_extention, $allowed_files)){
                if($new_profile_picture['size'] < 10000000){ // file upload
                    "line 49 file upload";
                    $find_old_photo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `employees` where `employee_id` = '$target_emp_id';"))['employee_profile_pic'];
                    $file_name = $emp_fullname . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);

                    $update_user_account_sql = "UPDATE `employees` 
                                        SET employee_firstname = '$state_firstname',
                                            employee_lastname = '$state_lastname',     
                                            employee_username = '$state_username', 
                                            employee_password = '$state_password', 
                                            employee_profile_pic = '$file_name' 
                                        WHERE employee_id = '$target_emp_id';";
                    try{
                        mysqli_query($conn, $update_user_account_sql);
                        echo $photo['tmp_name'];
                        echo $photo_path;

                        if(move_uploaded_file($photo['tmp_name'], $photo_path)){
                            if(file_exists($folder_path. $find_old_photo)){
                                if($file_name == $find_old_photo){
                                    
                                }else{
                                    if(unlink($folder_path. $find_old_photo)){
                                        echo "na delete daw";
                                    }else{
                                        echo "wala na delete ang file";
                                    }
                                }
                            }else{
                                echo "walay file";
                            }
                        }else{
                            echo "wala na upload yawa nima";
                        }
                        
                        $edit_stat = "Account Updated!";
                        header("location: ./index.php?status=$edit_stat");
                        die();
                    }catch(mysqli_sql_exception $e){
                        if($e->getCode() == 1062){
                            $edit_stat = "Username already in use";
                            header("location: ./edit_account.php?edit-account-stat=$edit_stat");
                            die();
                        }else{
                            $edit_stat = "line 62 error";
                            header("location: ./edit_account.php?edit-account-stat=$edit_stat");
                            die();
                        }
                    }
                    echo "line 68";
                }else{
                    echo "line 45";
                    $edit_stat = "File is too big";
                    header("location: ./edit_account.php?edit-account-stat=$edit_stat");
                   
                }
                echo "line 75";
            }
            echo "line 77";
    }
    else{
        $edit_stat = "Error";
        header("location: ./edit_account.php?edit-account-stat=$edit_stat");
        die();
    }

       // $update_employee_sql = "UPDATE `employees` 
            //                         SET employee_firstname = '$new_firstname',
            //                             employee_lastname = '$new_lastname',     
            //                             employee_username = '$new_username', 
            //                             employee_role = '$new_employee_role' 
            //                         WHERE employee_id = '$target_emp_id';";
?>


