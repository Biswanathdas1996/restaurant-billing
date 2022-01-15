<?php
include("../../src/query/query.php");
include("../../src/config/connection.php");



    $cooking_data = array(
        "data" => array(
       
            "cooking_instruction" => $_POST['fieldValue']
        )
    );
    $update_data = update('food_order_item', $cooking_data, $_POST['itemId']);

