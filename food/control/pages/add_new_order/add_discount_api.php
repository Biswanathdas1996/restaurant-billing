<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id=$_GET["order_id"];

$discount_percent = $_POST['indivisual_discount_amount'];
    $discount_item_total = $_POST['item_total'];
    $discount_amount = ($discount_item_total / 100) * $discount_percent;
    $data = array(
        "data" => array(
            "indivisual_discount" => $discount_amount,
            "indivisual_discount_percent" => $discount_percent,
        )
    );
    $update_data = update('food_order', $data, $order_id);
