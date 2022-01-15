<?php
error_reporting(0);
include('../../db/query.php');

    $order_id=base64_decode($_GET['order_id']);
    $get_order_data=select('food_order',[
                "conditions"=>[
                    "id"=>$order_id,
                    "done"=>0
                    ]
                ]);
      $responce=0;
      if(count($get_order_data)>0){
          $responce=1;
      }else{
          $responce=0;
      }


    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: content-type');
    header('cache-control: max-age=1');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($responce); 
?>