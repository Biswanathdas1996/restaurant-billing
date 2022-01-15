<?php
error_reporting(0);
    include('../../db/query.php');
    date_default_timezone_set('Asia/Kolkata');
    
        
  
    $order_id=base64_decode($_GET["order_id"]);
        $get_data=select('food_order' 
                        ,array(
                        'conditions'=>array(
                                "id"=>$order_id,
                            )
                    )
                );
    // pr($get_data);
    $get_order_item_data=select('food_order_item' 
                        ,array(
                        'conditions'=>array(
                                "order_id"=>$order_id,
                            )
                    )
                );
    $final_array=[];
    $cart=[];
    
   
    foreach($get_order_item_data as $data){
        
        $temp_cart=[];
        
          
        
            $temp_cart['addOnesAmout']=(int) $data["addOnesAmout"];
            $temp_cart['totalItemPrice']=$data["totalItemPrice"];
            $temp_cart['item_id']=$data["item_id"];
            $temp_cart['order_item_id']=(int) $data["id"];
            $temp_cart['qty']=(int)$data["qnt"];
        
            $get_item= select('food_demo' 
                        ,array(
                        'conditions'=>array(
                                "id"=>$data["item_id"],
                            )
                    )
                );
            $temp_cart['itemDetails']=$get_item[0];
            
            
            $get_addones=select('food_order_item_addones',[
                    "conditions"=>[
                            "order_item_id"=>$data["id"]
                        ]
                ]);
                
            $addones=[];
            if(count($get_addones>0)){
                foreach($get_addones as $add){

                  $addones[]=$add["add_ones_id"];  
                  
                }
            }
                
        
        $temp_cart['add_ones']=$addones;
        $cart[]=$temp_cart;
    }
    
    
  

   $final_array["cart"]=$cart;
   $final_array["table"]=$get_data[0]["table_no"];
   $final_array["token"]=$get_data[0]["token"];
   $final_array["total"]=$get_data[0]["sub_total"];

    


      
    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: content-type');
    header('cache-control: max-age=1');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($final_array);
 
?>