<?php
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id = $_GET["order_id"];


$check = select("food_customers", [
    "conditions" => [
        "order_id" => $order_id
    ]
]);
if (count($check) > 0) {
    $customer_data = array(
        "data" => array(
            $_POST['fieldName'] => $_POST['fieldValue'],
            "order_id" => $order_id
        )
    );
    $update_data = update('food_customers', $customer_data, $check[0]["id"]);
} else {
    $customer_data = array(
        "data" => array(
            $_POST['fieldName'] => $_POST['fieldValue'],
            "order_id" => $order_id,
            "created"=> date("Y-m-d")
        )
    );
    $update_data = insert('food_customers', $customer_data);
}
