<?php 
    include('../db/query.php');
      
    $data=array(
                "data"=>array(
                        "name"=>$_POST['name'],
                        "contact"=>$_POST['contact'],
                        "email"=>$_POST['email'],
                        "remark"=>$_POST['remark'],
                    )
                );
    $insert_data = insert('food_customers',$data);
    
    echo $insert_data;
?>
