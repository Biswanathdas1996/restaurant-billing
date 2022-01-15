<?php include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 


        $delete_data=delete('food_inventory_remove',array(
            "id"=>$_GET["id"]
        ));
    echo $delete_data;

     
  ?>