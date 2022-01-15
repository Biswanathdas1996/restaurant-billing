<?php
include('query.php');

$token=$_GET["token"];

 if($_GET){
    $data=array(
        "data"=>array(
                "token"=>$token,
            ),
        "unique_field"=>array(
             "token"
            ),
        );
    $insert_data = insert('notification_user',$data);
 } 

?> 