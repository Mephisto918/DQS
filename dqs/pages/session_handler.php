<?php
    // // session_start();

    // // echo '<pre>';
    // //     print_r($_POST);
    // // echo '</pre>';
    // // $_SESSION['item_id'] = "";
    // // $_SESSION['total_cart'] = "";
    // function SDTS($session_name, $value){ //Save Data To Session
    //     $_SESSION[$session_name] = $value;
    //     return $_SESSION[$session_name];
    // }
    // function GDFS($session_name){   //Get Data From Session
    //     if(isset($_SESSION['$session_name'])){
    //         return $_SESSION['$session_name'];    
    //     }else{
    //         return null;
    //     }
    // }
    // function RDFS($session_name){ //Remove Data From Session
    //     unset($_SESSION['$session_name']);
    // }

    // ------------------------------------------------------
    // session_start();

    // echo '<pre>';
    //     print_r($_POST);
    // echo '</pre>';
    // $_SESSION['item_id'] = "";
    // $_SESSION['total_cart'] = "";
    function SDTS($session_name, $value){ //Save Data To Session //should be string first param
        $_SESSION[$session_name] = $value;
        return $_SESSION[$session_name];
    }
    function GDFS($session_name){//Get Data From Session
        if(isset($_SESSION['$session_name'])){
            return $_SESSION['$session_name'];    
        }else{
            return null;
        }
    }
    function RDFS($session_name){ //Remove Data From Session
        unset($_SESSION['$session_name']);
    }
    function ATS($session_name, $value){//Append To Session
        if(!isset($_SESSION[$session_name])){
            $_SESSION[$session_name] = [];
        }
        if(is_array($_SESSION[$session_name])){
            $_SESSION[$session_name] = array_merge($_SESSION[$session_name], $value); //append
        }else{
            $_SESSION[$session_name] = $value; //if not replace
        }
        return $_SESSION[$session_name];
    }
    function initialize_session($session_name, $default_value){
        if(isset($_SESSION[$session_name])){
            $_SESSION[$session_name] = $default_value;
        }
    }
?>