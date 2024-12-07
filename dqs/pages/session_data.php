<?php //all data are handled post
    // include('../db.php');
    // include('./session_handler.php');
    // session_start();

    // echo '<pre>';
    //     print_r($_POST);
    // echo '</pre>';

    // if(isset($_POST['id='])){
    //     $array_id = $_POST['id='];
    //     SDTS('item_id', $array_id);      //first value should be strin
    //     $try_echo = $_SESSION['item_id'];
    
    //     forEach($try_echo as $id){
    //         echo $id;
    //     }
    // }
    // if(isset($_POST['total_cart'])){
    //     $total_cart = $_POST['total_cart'];
    //     SDTS('total_cart', $total_cart);      //first value should be strin
    //     $try_echo_total = $_SESSION['total_cart'];
    //     echo $try_echo_total;
    // }

    // ------------------------------------------------------------
    include('../db_no_indi.php');
    include('./session_handler.php');
    session_start();

    // echo '<pre>';
    //     print_r($_POST);
    //     print_r($_SESSION);
    // echo '</pre>';
    if(!(isset($_SESSION['item_id']))){
        $_SESSION['item_id'] = [];
    }
    if(!(isset($_SESSION['total_cart']))){
        $_SESSION['total_cart'] = 0.00;
    }

    if(isset($_POST['id='])){
        $array_id = $_POST['id='];
        SDTS('item_id', $array_id);   //works fine   //first value should be strin
        // ATS('item_id', $array_id);      causses duplication bug
        $try_echo = $_SESSION['item_id'];
    
        forEach($try_echo as $id){
            echo $id;
        }
    }else{
        initialize_session('item_id', []);
    }
    if(isset($_POST['total_cart'])){
        $total_cart = $_POST['total_cart'];
        SDTS('total_cart', $total_cart);      //first value should be strin
        $try_echo_total = $_SESSION['total_cart'];
        echo $try_echo_total;
    }

    // $response = [];
    // echo json_encode($response);
?>