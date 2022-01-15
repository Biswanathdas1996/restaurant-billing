<?php 
error_reporting(0);
include('../../db/query.php');

// $total_amount=$_GET['total_amount'];
$order_id=base64_decode($_GET['order_id']);

$get_order_data=select('food_order',[
            "conditions"=>[
                "id"=>$order_id
                ],
                'join_many' => array(
                    'food_order_item' => 'order_id',
                ),
            ]);

    $total_add_ons_amount=0;
    foreach($get_order_data[0]['food_order_item'] as $addons){
        $total_add_ons_amount+= $addons['addOnesAmout'];
    }


$get_all_charges=select('food_tax_charges',[
            "conditions"=>[
                "status"=>1
                ]
            ]);
    
            
 
    
    function get_total_tax_charges($total_amount){
                        $s_total_amount=$total_amount;
                        
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
                             $ch_value=$balance_amount;
                            if($charge['charge_or_discount']==0){
                                 $temp_total_charge_amount+=$balance_amount;
                            }else{
                                 $temp_total_charge_amount-=$balance_amount; 
                            }
                            $s_t_discount+=$temp_total_charge_amount;
                            
                            if($charge['charge_or_discount']==0){
                                            $balance_amount="₹".number_format($balance_amount,2);
                                            
                                        }else{
                                            $balance_amount="-₹".number_format($balance_amount,2);
                                            
                                        }
                            
                            
                            $temp_array=array(
                                        "name"=>$charge['name'],
                                        "percent_or_fixed"=> $charge['amount'],
                                        "amount"=> $balance_amount,
                                        "value"=>$ch_value,
                                        "charge=0_&_discount=1"=>$charge['charge_or_discount'],
                                        "%=0_&_fixed=1"=>$charge['type']
                                    );
                            $final_array["details"][]=$temp_array;       
                          }
                        $final_array["total"]=$s_t_discount;
                     return $final_array;     
    }
     
      //$get_data=order_data($_GET["order_id"]); //function is in head_include.php
      $indivisual_discount =  $get_order_data[0]['indivisual_discount']  ;
      $total_amount =  $get_order_data[0]['sub_total'] -$indivisual_discount ;
    
      $item_total=(float) ($total_amount);
      
      $tmp_charges=get_total_tax_charges($total_amount+$total_add_ons_amount);
      $total_amount=($item_total+$tmp_charges['total']); 
      $total_charge_data=[];
     
        $indiDiscount=[];
       

        $indiDiscount["%=0_&_fixed=1"]=1;
        $indiDiscount["amount"]="-₹".$indivisual_discount;
        $indiDiscount["charge=0_&_discount=1"]=1;
        $indiDiscount["name"]="Discount";
        $indiDiscount["percent_or_fixed"]=$get_order_data[0]['indivisual_discount_percent'];
        $indiDiscount["value"]=$indivisual_discount;
     
     
     
     
        $charge_list=array_push($tmp_charges['details'],$indiDiscount);
      $total_charge_data["charges"]=$tmp_charges['details'];
      $total_charge_data["add_ons_charges"] = $total_add_ons_amount;
      
       $total_charge_data["item_total"]=(float) $get_order_data[0]['sub_total'];
       $total_charge_data["sub_total"]= $get_order_data[0]['sub_total'] -$indivisual_discount;
       
      $total_charge_data["total_charges"]=$tmp_charges['total'];
      $total_charge_data["packing_charges"]=$get_order_data[0]['packing_charges'];
      $total_charge_data["amount_paid"]=$get_order_data[0]['total'];
      

      
                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($total_charge_data);
