<?php
    session_start();
    include('./db_no_indi.php');
    include('./pages/session_handler.php');
    // $response['success'] = "false";
    // $response['redirect'] = "";
    // $response['message'] = '';

    $response = [
        'success' => false,
        'message' => '',
        'redirect'=> ''
    ];  
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $verify_user_sql = "SELECT * FROM `employees` WHERE `employee_username` = '$username';";
        $result = mysqli_query($conn, $verify_user_sql);

        
        if(mysqli_num_rows($result) > 0 && $result){
            $user = mysqli_fetch_assoc($result);

            $employee_id = $user['employee_id'];
            $employee_firstname = $user['employee_firstname'];
            $employee_lastname = $user['employee_lastname'];
            $employee_username = $user['employee_username'];
            $employee_password = $user['employee_password'];
            $employee_role = $user['employee_role'];
            $employee_profile_pic = $user['employee_profile_pic'];

            $_SESSION['emp_id'] = $employee_id;
            $_SESSION['emp_firstname'] = $employee_firstname;
            $_SESSION['emp_lastname'] = $employee_lastname;
            $_SESSION['emp_pfp'] = $employee_profile_pic;
            
            
            
            if($password === $employee_password){
                if($employee_role == 'admin'){
                    // echo "hello admin 33";
                    $response['success'] = true;
                    $response['redirect'] = './pages/admin-manager/admin/index.php?status=Welcome';
                }else{
                    // echo "hello manager 37";
                    $response['success'] = true;
                    $response['redirect'] = './pages/admin-manager/manager/index.php';
                }
            }else{
                $response['message'] = 'Wrong password!';
                // echo "line 43";
            }
            // echo "line 45";
        }else{
            $response['message'] = 'No user found!';
            // echo "line 47";
        }
        // echo "line 50";
        header('Content-Type: application/json');
        echo json_encode($response);
        die();
    }else{
        // echo "line 52";
        // echo '<pre>';
        //     print_r($_SESSION);
        // echo '</pre>';
        if(isset($_GET['start'])){
            
        }
        header('location: ./pages/item-tabs/index.php');
        echo json_encode($response);
        die();
    }
?>