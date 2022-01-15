<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id=$_GET["order_id"];

if (isset($_POST['noteData'])) {
    $note_data = array(
        "data" => array(
            "orddr_note" => $_POST['noteData'],
        )
    );
    $update_data = update('food_order', $note_data, $order_id);
}
