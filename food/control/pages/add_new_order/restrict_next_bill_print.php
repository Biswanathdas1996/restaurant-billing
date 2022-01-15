<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id=$_GET["order_id"];
$status_data=$_GET["data"];


    $note_data = array(
        "data" => array(
            "is_bill_printed" => $status_data,
        )
    );
    $update_data = update('food_order', $note_data, $order_id);

