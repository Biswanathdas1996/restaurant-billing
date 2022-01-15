<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id=$_GET["order_id"];




if (isset($_POST['table_no'])) {
    $note_data = array(
        "data" => array(
            "table_no" => $_POST['table_no'],
        )
    );
    $update_data = update('food_order', $note_data, $order_id);
}

