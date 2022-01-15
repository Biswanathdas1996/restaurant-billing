<?php
date_default_timezone_set('Asia/Kolkata');
   include('../../src/query/query.php'); 
        $id=$_GET["id"];
     
        if($_GET){
        
        
        
        $delete_order_data=delete('food_order',array(
            "id"=>$id
        ));
        
        $delete_item_data=delete('food_order_item',array(
            "order_id"=>$id
        ));
        
        $delete_item_data=delete('food_order_item',array(
            "order_id"=>$id
        ));
 
        
        
      
        
 //------------------------------------------------
 
      $get_order=select("food_order",[
         "conditions"=>[
             "id"=>$id
             ]
         ]);
         
    $get_scan_token=select("food_scan_report",[
         "conditions"=>[
             "token"=>$get_order[0]['token']
             ]
         ]);
         
    $sdata=array(
        "data"=>array(
                "token"=>"",
                "status"=>0
            ),
        );
    $update_data=update('food_scan_report',$sdata,$get_scan_token[0]["id"]);
    
 //------------------------------------------------
         
         
         
        }                      
?>