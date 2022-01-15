<?php
include('../../src/query/query.php'); 
   
    
    if(isset($_GET["table_no"])){
           $get_order_data=select('food_table_book' 
                            ,array(
                            'conditions'=>array(
                                    "table_no"=>$_GET["table_no"],
                                    "status"=>1,
                                ),
                            )
                        );
            echo json_encode($get_order_data);
    }
    if(isset($_GET["del_book"])){
        
            $delete_data=delete('food_table_book',array(
                "id"=>$_GET["del_book"],
                
            ));
            echo $delete_data;
    }
    

?>                   
