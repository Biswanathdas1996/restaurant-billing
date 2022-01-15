<?php
include('query.php');
$final_data=[];
$get_data=select('view_notification',array(
        'conditions'=>array(
            "status"=>1
            ),
            'order'=>array(
                'id'=>'asc'
                          ),
    ));

$final_data["message"]=$get_data;

$get_total_done_order=select('food_order',array(
        "conditions"=>array(
            "done"=>1
            )
    ));

$get_today_total_done_order=select('food_order',array(
        "conditions"=>array(
            "done"=>1,
            "date"=>date("Y-m-d")
            )
    ));   
    
$get_today_total_open_order=select('food_order',array(
        "conditions"=>array(
            "done"=>0,
            
            )
    ));


$get_total_active_table=select('food_table');

$t_table=$get_total_active_table[0]['total_working_no_of_table'];

$not_ocupied_table=intval($t_table)-intval(count($get_today_total_open_order));

$final_data["total_done_order"]=count($get_total_done_order); 
$final_data["get_today_total_done_order"]=count($get_today_total_done_order);  
$final_data["get_today_total_open_order"]=count($get_today_total_open_order);  
$final_data["total_free_table"]=$not_ocupied_table;  


header('X-Firefox-Spdy: h2');
header('Access-Control-Allow-Origin: true');

header('cache-control: max-age=14400');
header('cf-cache-status: HIT');
header('cf-ray: max-age=55363bee0cd3dcda-SIN');

header("Content-type: application/json; charset=utf-8");
echo json_encode($final_data);




?>











