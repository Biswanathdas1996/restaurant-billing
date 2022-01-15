<?php 
    include('../db/query.php');
        $data=[];  
         $data=array(
            "data"=>array(
                    "order_id"=>$_POST['order_id'],
                    "rating"=>$_POST['rate'],
                    "created"=>date("Y-m-d"),
                ),
            );
        $insert_charge_datas = insert('food_feedback',$data);
        
        
        
        
   
        $id=$_POST['order_id'];
        $data=array(
        "data"=>array(
                "rating"=>$_POST['rate'],
                
            ),
        );
        $update_payment_status=update('food_order',$data,$id);



        ///////Customer info update
        $check_token=select('food_customers',[
        "conditions"=>[
                "firebase_token"=>$_POST['FireBaseToken']
            ]
        ]);
            if(!empty($check_token)){
                
                    $id=$check_token[0]['id'];
                    $data=array(
                    "data"=>array(
                            "name"=>$_POST['name'],
                            "contact"=>$_POST['contact'],
                            "email"=>$_POST['email'],
                            "remark"=>$_POST['remark']
                        )
                    );
                    $update_data=update('food_customers',$data,$id);
        
       
            }else{
                $data=array(
                    "data"=>array(
                            "name"=>$_POST['name'],
                            "contact"=>$_POST['contact'],
                            "email"=>$_POST['email'],
                            "remark"=>$_POST['remark'],
                        )
                    );
                $insert_data = insert('food_customers',$data);
            }

        
        
        
        ///////////



?>
<!--FireBaseToken-->





<script>

    window.location.replace("../../index.php");
</script>