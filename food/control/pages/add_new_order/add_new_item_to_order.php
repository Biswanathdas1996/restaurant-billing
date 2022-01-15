<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");
$order_id=$_GET["orderid"];
$get_food_item_menu = select("food_demo", [
    "conditions" => [
        "id" => $_POST['item_id']
    ]
]);
// pr($get_food_item_menu);
$data = array(
    "data" => array(
        "order_id" => $order_id,
        "item_category_id" => $get_food_item_menu[0]['category'],
        "item_id" => $get_food_item_menu[0]['id'],
        "qnt" => $_POST['qty'],
        "date" => date("Y-m-d"),
        "time" => date("h:i:sa"),
        "table_no" => $_POST["table_no"],
        "addOnesAmout" => 0,
        "totalItemPrice" => $get_food_item_menu[0]['price']*$_POST['qty'],
    )
);
$insert_data = insert('food_order_item', $data);





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
           
  