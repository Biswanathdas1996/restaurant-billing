<?php
include('query.php');
$final_data=[];

$table_no=$_GET["table_no"];

    $get_table_order=select('food_order',array(
        "conditions"=>array(
            "done"=>0,
            "table_no"=>$table_no
            )
    ));
    // pr($get_table_order);
    
 $order_id=$get_table_order[0]['id'];

if(sizeof($get_table_order)>0){
$get_order_items=select('food_order_item',array(
        "conditions"=>array(
                "order_id"=>$order_id
            ),
            'join' =>array(
                            'food_demo'=>'item_id',
                           ),
    ));

$final_data["subtotal"]=$get_table_order[0]['sub_total'];
$final_data["gst"]=$get_table_order[0]['gst'];
$final_data["total"]=$get_table_order[0]['total'];


    
}



$temp_array=[];
foreach($get_order_items as $val){
    
    $temp_data=[];
    $temp_data["id"]=$val['id'];
    $temp_data["name"]=$val['food_demo']['title'];
    $temp_data["price"]=$val['food_demo']['price'];
   
    $temp_data["img"]="https://www.scanncatch.com/food/control/food_demo_img/".$val['food_demo']['img'];
    $temp_data["qnt"]=$val['qnt'];
    $temp_data["created"]=$val['date']." ".$val['time'];
    $temp_array[]=$temp_data;

}


$final_data["items"]=$temp_array;

// pr($final_data);



header('X-Firefox-Spdy: h2');
header('Access-Control-Allow-Origin: true');
header('cache-control: max-age=14400');
header('cf-cache-status: HIT');
header('cf-ray: max-age=55363bee0cd3dcda-SIN');
header("Content-type: application/json; charset=utf-8");
echo json_encode($final_data);

?>