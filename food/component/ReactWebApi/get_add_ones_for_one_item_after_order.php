<?php 
error_reporting(0);
include('../../db/query.php');
// include('db_connect.php');


     
                
   $itemId=$_GET["item_id"];
   $order_item_id=$_GET["order_item_id"];
 
   $order_id=base64_decode($_GET["order_id"]);
  

  
  $get_item_details=select('food_demo',array(
                "conditions"=>array(
                    "id"=>$itemId
                    )
      )); 
      
    $get_add_ones_from_order=select('food_order_item_addones',array(
                "conditions"=>array(
                    "order_id"=>$order_id,
                    "item_id"=>$itemId,
                    "order_item_id"=>$order_item_id
                    )
      ));  
      
    //   pr($get_add_ones_from_order);
      
      $temp_add_one=[];
      foreach($get_add_ones_from_order as $val){
            $check_already_add=select('food_menu_item_addones',array(
                "conditions"=>array(
                    "id"=>$val['add_ones_id']
                            )
             ));
            //  pr($check_already_add);
             $temp_add_one[]=$check_already_add[0];
      }

      
  
      
        $responce=[];
        $responce["item"]=$get_item_details[0];
        $responce["addones"]=$temp_add_one;



                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($responce);




