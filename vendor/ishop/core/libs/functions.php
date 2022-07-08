<?php

function debug($arr, $die = 0){
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if($die == 1){
        die;
    }
}

function dd($arr){
    echo '<pre>' . print_r($arr, true) . '</pre>';
    die;
}

function redirect($http = false, $messege_type = '', $messege = ''){
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");

    if($messege_type && $messege){
        if($messege_type == 'error'){
            $_SESSION['error'] = $messege;
        }elseif($messege_type == 'success'){
            $_SESSION['success'] = $messege;
        }
    }
    exit;
}

function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}