<?php
error_reporting(0);
include('../../db/query.php');

$order_id=$_POST['data'];

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
 
 $total_data_i=[];
 $total_data_i["item_total"]=$get_orrder_amouts[0]['sub_total'];
 $total_data_i["charges_total"]=$get_orrder_amouts[0]['total_charges'];
 $total_data_i["charges"]=$get_orrder_charges;
 $total_data_i["total"]=$get_orrder_amouts[0]['total'];
 
//  pr($total_data);
 
    echo json_encode($total_data_i);    

?>