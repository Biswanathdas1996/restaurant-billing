<?php 
error_reporting(0);
include('../../db/query.php');

        
        $get_order_data=select('food_order',array(
                                'conditions'=>array(
                                        "id"=>$_POST['data'],
                                    ),
                                'join_many' => array(
                                        'food_order_item'=>'order_id',
                                    ),
                            )
                        );
        $total_get_data=[];                
        $get_data=[];
        foreach($get_order_data[0]['food_order_item'] as $key =>$value){
            if($value>0){
                $temp_data=[];
                $temp_get_data=select('food_demo' 
                                ,array(
                                'conditions'=>array(
                                        "id"=>$value['item_id']
                                    )
                            )
                            );
                $temp_data["id"]= $temp_get_data[0]['id'];
                $temp_data["cookong_ins"]= $temp_get_data[0]['cooking_instruction'];  
                $temp_data["title"]= $temp_get_data[0]['title'];  
                $temp_data["type"]= $temp_get_data[0]['type'];  
                $temp_data["special"]= $temp_get_data[0]['special'];  
                $temp_data["category"]= $temp_get_data[0]['category'];  
                $temp_data["non_veg"]= $temp_get_data[0]['non_veg'];  
                $temp_data["price"]= $temp_get_data[0]['price'];  
                $temp_data["discounted_price"]= $temp_get_data[0]['discounted_price'];  
                $temp_data["status"]= $temp_get_data[0]['status'];  
                $temp_data["img"]= $temp_get_data[0]['img'];  
                $temp_data["description"]= $temp_get_data[0]['description'];
                $temp_data["order_qnt"]=$value['qnt'];
                $temp_data["order_item"]= $value;
                $get_data[]=$temp_data; 
            }
           
        }
         $total_get_data["data"]=$get_data;
        echo json_encode($total_get_data);


?>