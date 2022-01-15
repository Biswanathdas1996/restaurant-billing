<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");
$order_id=$_GET["orderid"];


$delete_data = delete('food_order_item', array(
    "id" => $_POST["order_item_id"]
));



$get_order_itms_data = select("food_order_item", [
    "conditions" => [
        "order_id" => $order_id
    ],
    'join' => array(
        'food_demo' => 'item_id',
    ),
]);
$actual_item_total=0;
foreach ($get_order_itms_data as $val){
    $actual_item_total+=$val['qnt']*$val['food_demo']['price'];
}
$order_data = array(
    "data" => array(
        "sub_total" => $actual_item_total
    )
);
$update_data_order_data = update('food_order', $order_data, $order_id);




if($insert_data){
    echo json_encode(1);
}else{
    echo json_encode(0);
}







?>
           
  