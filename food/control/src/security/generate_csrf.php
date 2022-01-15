<?php 
session_start();

    if($_POST['type']=="add"){
        $table=base64_decode($_POST['data']);
        $_SESSION['token_create_'.$table]=base64_encode(openssl_random_pseudo_bytes(32));
        echo $_SESSION['token_create_'.$table];
    }
    else if($_POST['type']=="update"){
        $table=base64_decode($_POST['data']);
        $_SESSION['token_update_'.$table]=base64_encode(openssl_random_pseudo_bytes(32));
        echo $_SESSION['token_update_'.$table];
    }
    

?>