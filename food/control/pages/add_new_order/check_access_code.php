<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$code=$_GET["code"];

$check=select("user",[
    "conditions"=>[
        "access_code"=>$code
    ]
]);
if($check){
    echo $check[0]["admin"];
    
}else{
    echo 0;
}

