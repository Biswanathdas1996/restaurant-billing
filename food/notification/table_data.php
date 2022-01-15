<?php
include('query.php');
$final_data=[];
  
    
$get_today_total_open_order=select('food_order',array(
        "conditions"=>array(
            "done"=>0,
            )
    ));

// pr($get_today_total_open_order);



$get_total_active_table=select('food_table');
$t_table=$get_total_active_table[0]['total_working_no_of_table'];

$ocupier_tables=[];

for($i=1;$i<=$t_table;$i++){
    
    $temp_data=[];
    $temp_data["table"]=$i;
    $get_temp_order=select('food_order',array(
        "conditions"=>array(
            "done"=>0,
            "table_no"=>$i
            )
    ));
    // pr($get_temp_order);
    if(sizeof($get_temp_order)>0){
        $temp_data["table_status"]=1;
        
    }else{
        $temp_data["table_status"]=0;
        
    }
  $ocupier_tables[]= $temp_data; 
    
}







$free_table=intval($t_table)-intval(count($get_today_total_open_order));

$final_data["free_table"]=$free_table;
$final_data["ocupied_table"]=count($get_today_total_open_order);
$final_data["table_status"]=$ocupier_tables;

header('X-Firefox-Spdy: h2');
header('Access-Control-Allow-Origin: true');

header('cache-control: max-age=14400');
header('cf-cache-status: HIT');
header('cf-ray: max-age=55363bee0cd3dcda-SIN');

header("Content-type: application/json; charset=utf-8");
echo json_encode($final_data);

?>