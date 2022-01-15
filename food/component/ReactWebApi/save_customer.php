<?php 
error_reporting(0);
    include('../../db/query.php');
     date_default_timezone_set('Asia/Kolkata');
    $get_data = file_get_contents("php://input");
     $data=json_decode($get_data,true);
     
    
    $data=array(
                "data"=>array(
                        "name"=>$_POST['name'],
                        "contact"=>$_POST['contact'],
                        "email"=>$_POST['email'],
                        "remark"=>$_POST['remark'],
                        "created"=>date("Y-m-d"),
                    )
                );
    $insert_data = insert('food_customers',$data);
    
   
    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: content-type');
    header('cache-control: max-age=1');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($insert_data);
?>
