<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id=$_GET["order_id"];


$data = array(
    "data" => array(
        "packing_charges" => $_POST['packing_charges_amount'],
    )
);
$update_datas = update('food_order', $data, $order_id);

