<?php
$get_all_charges=select('food_tax_charges',[
            "conditions"=>[
                "status"=>1
                ]
            ]);
            
    
    function order_data($order_id){
                        $get_order_data=select('food_order' 
                                        ,array(
                                        'conditions'=>array(
                                                "id"=>$order_id,
                                            ),
                                        'join_many' => array(
                                                'food_order_item'=>'order_id',
                                            ),
                                    )
                                    );
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
                           
                                $temp_data["cookong_ins"]= isset($temp_get_data[0]['cooking_instruction']) ? $temp_get_data[0]['cooking_instruction'] : "NA"; 
                            
                            
                            
                            $temp_data["title"]= $temp_get_data[0]['title'];  
                            $temp_data["type"]= $temp_get_data[0]['type'];  
                            $temp_data["special"]= $temp_get_data[0]['special'];  
                            $temp_data["category"]= $temp_get_data[0]['category'];  
                            $temp_data["non_veg"]= isset($temp_get_data[0]['non_veg']) ? $temp_get_data[0]['non_veg'] : "NA";  
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
                 return $get_data;   
    }        
     
    function get_order_items_total_amount($order_id){
        $get_order_data=order_data($order_id);
        $sub_total=0;
        foreach($get_order_data as $data){
            $tmp_sub_total=($data['price']*$data['order_item']['qnt']);
            $sub_total+=$tmp_sub_total;
        }
       return $sub_total;
    }   
    
    function get_total_tax_charges($order_id){
                        $s_total_amount=get_order_items_total_amount($order_id);
                        
                           $s_t_discount=0;
                           $get_all_charges=select('food_tax_charges',[
                            "conditions"=>[
                                "status"=>1
                                ]
                            ]);
                            $final_array=[];
                          foreach($get_all_charges as $charge){
                              $temp_array=[];
                              $temp_total_charge_amount=0;
                             if($charge['type']==0){
                                $temp_balance_amount=($s_total_amount*$charge['amount']);
                                $balance_amount=($temp_balance_amount/100);
                             }else{
                                $balance_amount=$charge['amount']; 
                             } 
                            if($charge['charge_or_discount']==0){
                                 $temp_total_charge_amount+=$balance_amount;
                            }else{
                                 $temp_total_charge_amount-=$balance_amount; 
                            }
                            $s_t_discount+=$temp_total_charge_amount;
                            
                            $temp_array=array(
                                        "name"=>$charge['name'],
                                        "amount"=> number_format($balance_amount,2),
                                        "charge_or_discount"=>$charge['charge_or_discount'],
                                        "type"=>$charge['type']
                                    );
                            $final_array["details"][]=$temp_array;       
                          }
                        $final_array["total"]=$s_t_discount;
                     return $final_array;     
    }
     
     
         function tax_calculation($amount){
                        $s_total_amount=$amount;
                           $s_t_discount=0;
                           $get_all_charges=select('food_tax_charges',[
                            "conditions"=>[
                                "status"=>1
                                ]
                            ]);
                            $final_array=[];
                          foreach($get_all_charges as $charge){
                              $temp_array=[];
                              $temp_total_charge_amount=0;
                             if($charge['type']==0){
                                $temp_balance_amount=($s_total_amount*$charge['amount']);
                                $balance_amount=($temp_balance_amount/100);
                             }else{
                                $balance_amount=$charge['amount']; 
                             } 
                            if($charge['charge_or_discount']==0){
                                 $temp_total_charge_amount+=$balance_amount;
                            }else{
                                 $temp_total_charge_amount-=$balance_amount; 
                            }
                            $s_t_discount+=$temp_total_charge_amount;
                            
                            $temp_array=array(
                                        "name"=>$charge['name'],
                                        "amount"=> number_format($balance_amount,2),
                                        "charge_or_discount"=>$charge['charge_or_discount'],
                                        "type"=>$charge['type']
                                    );
                            $final_array["details"][]=$temp_array;       
                          }
                        $final_array["total"]=$s_t_discount;
                     return $final_array;     
    }
     
            
?>