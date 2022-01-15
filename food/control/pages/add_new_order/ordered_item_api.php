<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");
$order_id=$_GET["orderid"];
$get_order = select("food_order", [
    "conditions" => [
        "id" => $order_id
    ],
    'join_many' => array(
        'food_order_item' => 'order_id',
    ),
    'order'=>array(
            'id'=>'desc'
        ),
]);
$responce_data=[];
foreach($get_order[0]['food_order_item'] as $item){

    $check_if_add_ons=select("food_menu_item_addones",[
        "conditions"=>[
            "food_item_id"=>$item['item_id']
        ]
    ]);

    $temp=[];
    $get_item = select("food_demo", [
        "conditions" => [
            "id" => $item["item_id"]
        ]
    ]);
    $item_total += ($get_item[0]['price'] * $item["qnt"]);
    $temp["item_id"]=$item['id'];
    $temp["item_name"]=$get_item[0]['title'];
    $temp["price"]=$get_item[0]['price'];
    $temp["qnt"]=$item['qnt'];
    $temp["item_total"]=number_format($get_item[0]['price'] * $item["qnt"], 2);
    if($item['cooking_instruction'] != null){
        $temp["cooking_instruction"]=$item['cooking_instruction'];
    }else{
        $temp["cooking_instruction"]="";
    }
    if(!empty($check_if_add_ons)){
        $temp["add_ons"]=1;
    }else{
        $temp["add_ons"]=0;
    }
    $responce_data[]=  $temp;
}


echo json_encode($responce_data);


?>
           
  