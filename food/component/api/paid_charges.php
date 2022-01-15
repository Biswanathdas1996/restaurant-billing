<?php
error_reporting(0);
include('../../db/query.php');

$order_id=2;


$get_orrder_amouts=select("food_order",[
        "conditions"=>[
                "id"=>$order_id
            ]
    ]);
    

$get_orrder_charges=select("food_order_charges",[
        "conditions"=>[
                "order_id"=>$order_id
            ]
    ]);
 
 
 
 
 
 pr($get_orrder_amouts);   

?>