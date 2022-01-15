<?php

   include('../../src/query/query.php'); 
        
            if(isset($_GET["id"])){
                $id=$_GET["id"];
                
            
                $delete_data=delete('food_order_item',array(
                        "id"=>$id
                    ));
               
               $orderid=$_GET["order_id"];
               
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