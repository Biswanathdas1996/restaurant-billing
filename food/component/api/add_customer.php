<?php
error_reporting(0);
include('../../db/query.php');


    $check_token=select('food_customers',[
        "conditions"=>[
                "firebase_token"=>$_GET['firebase_token'],
                "created"=>date("Y-m-d")
            ]
        ]);
            if(!empty($check_token)){
                
                
                
            }else{
                $data=array(
                    "data"=>array(
                            "firebase_token"=>$_GET['firebase_token'],
                             "created"=>date("Y-m-d")
                        ),
                    "unique_field"=>array(
                         "firebase_token"
                        ),
                    );
                $insert_data = insert('food_customers',$data);
            }

    
 
 
 
 
 
   

?>