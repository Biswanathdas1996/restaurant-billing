<?php
if(!isset($_SERVER["PHP_AUTH_USER"])){
    header("www-Authenticate: Basic realm=\"Provet Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print("Sorry, You need proper details");
    exit;
    
}else{
    if(($_SERVER["PHP_AUTH_USER"]=='bill') && ($_SERVER["PHP_AUTH_PW"]== '1234')){
        echo "itz good";
    }else{
        header("www-Authenticate: Basic realm=\"Provet Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print("Sorry, You need proper details");
        exit;
    }
}


?>