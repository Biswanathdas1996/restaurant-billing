<?php

   include('../../src/query/query.php'); 
        
            if(isset($_GET["order_item_id"])){
                $order_item_id=$_GET["order_item_id"];
                $qty=$_GET["qty"];
                $orderid=$_GET["order_id"];
               
                
                $id=$order_item_id;
                
                $get_order_item_id=select('food_order_item',[
                    "conditions"=>[
                        "id"=>$id
                        ]
                    ]);
                    
                $data=array(
                "data"=>array(
                        "qnt"=>(int) $qty,
                        "addOnesAmout"=>(int) (($get_order_item_id[0]["addOnesAmout"]/$get_order_item_id[0]["qnt"])*$qty),
                        "totalItemPrice"=>(int) (($get_order_item_id[0]["totalItemPrice"]/$get_order_item_id[0]["qnt"])*$qty),
                    )
                );
                $update_data=update('food_order_item',$data,$id);
                
    
               $curl = curl_init();
                curl_setopt_array($curl, array(
                  CURLOPT_URL => getenv('HTTP_BASE_PATH').'food/component/api/current_charges_api.php',
                //   CURLOPT_URL => '../../../component/api/current_charges_api.php',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => array('data' => $orderid),
                ));
                
                $response = curl_exec($curl);
                
                curl_close($curl);
                
                $response=json_decode($response,true);
                
     
                $data=array(
                "data"=>array(
                        "sub_total"=>floatval($response["item_total"]),
                        "total_charges"=>floatval($response["total_charges"]),
                        "total"=>floatval($response["amount_paid"]),
                    )
                );
                
                $update_data=update('food_order',$data,$orderid);
        
      
        
        

        }                      
?>