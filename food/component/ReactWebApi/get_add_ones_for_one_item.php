<?php 
error_reporting(0);
include('../../db/query.php');
// include('db_connect.php');


     
                
  $itemId=$_GET["item_id"];
  

  
  $get_item_details=select('food_demo',array(
                "conditions"=>array(
                    "id"=>$itemId
                    )
      )); 
      
      
  $check_already_add=select('food_menu_item_addones',array(
                "conditions"=>array(
                    "food_item_id"=>$itemId
                    )
      ));
      
        $responce=[];
        $responce["item"]=$get_item_details[0];
        $responce["addones"]=$check_already_add;



                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($responce);




