<?php

   include('../../src/query/query.php'); 
        
        $orderid=$_GET["order_id"];
     
                $data=array(
                "data"=>array(
                        "indivisual_discount"=>$_GET["amount"]
                    )
                );
                
                $update_data=update('food_order',$data,$orderid);
        
      
        
        

                             
?>