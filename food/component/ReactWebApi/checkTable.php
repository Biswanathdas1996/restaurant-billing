<?php 
error_reporting(0);
include('../../db/query.php');
include('db_connect.php');


 $check_free_table=select("food_order",array(
            "conditions"=>array(
                 "table_no"=>$_GET['table'],
                 "done"=>0
                )
        ));
        
        
    $data=[];
    if(!empty($check_free_table) && !isset($_GET["re_order"])){
        $data["order_id"]="Table Ocupied";
        $data["msg"]="Table Ocupied";
        $data["status"]=0;
    }else{
        $data["order_id"]=null;
        $data["msg"]="Table Free";
        $data["status"]=1;
    }
    

    
    
                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($data);
    ?>