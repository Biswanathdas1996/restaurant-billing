<?php

   include('../../src/query/query.php'); 
        
            if(isset($_GET["id"])){
                $id=$_GET["id"];
            $data=array(
                "data"=>array(
                        "bypass_session"=>1,
                    ),
                );
            $update_data=update('food_order',$data,$id);
            echo $update_data;
        

        }                      
?>