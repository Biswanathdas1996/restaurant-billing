<?php 
include('query.php');
$session_id=$_GET["session_id"];
 
$delete_data=delete('food_order_item_dami',array(
            "session_id"=>$session_id,
        ));



?>