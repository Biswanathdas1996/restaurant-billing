<?php
error_reporting(0);
    include('../../db/query.php');
    date_default_timezone_set('Asia/Kolkata');
    $get_data = file_get_contents("php://input");
    $data=json_decode($get_data,true);
        
 
  
  if(isset($data['old_order_id'])){
     $old_order_id=base64_decode($data['old_order_id']); 
     
    $delete_order_data=delete('food_order',array(
            "id"=>$old_order_id
        ));
    $delete_order_items_data=delete('food_order_item',array(
            "order_id"=>$old_order_id
        ));
    $delete_order_items_addones_data=delete('food_order_item_addones',array(
            "order_id"=>$old_order_id
        ));  
  }
  
  
  
  
  
  
    $total_amount=$data['total'];
    
/////////////////-------------------------Start of charges calculation-------/////     
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
        $item_total=(float) $total_amount;
        $tmp_charges=get_total_tax_charges($total_amount);
        $total_amount=($item_total+$tmp_charges['total']); 
        $total_charge_data=[];
        $total_charge_data["charges"]=$tmp_charges['details'];
        $total_charge_data["item_total"]=$item_total;
        $total_charge_data["total_charges"]=$tmp_charges['total'];
        $total_charge_data["amount_paid"]=$total_amount;
  
/////////////////-------------------------end of charges calculation-------///// 
 
    
  
    $session=uniqid();
    $order_data=array(
                "data"=>array(
                        "user_id"=>$data['user_id'],
                        "process_session"=>$session,
                        "table_no"=>$data['table'],
                        "cooking_instruction"=>"---",
                        "sub_total"=>$total_charge_data["item_total"],
                        "total_charges"=>$total_charge_data["total_charges"],
                        "total"=>$total_charge_data["amount_paid"],
                        "order_data"=>$get_data,
                        "date"=>date("Y-m-d"),
                        "time"=>date ('H:i:s', time()),
                        "token"=>$data['token']
                    )
        );
        if($get_data != null && $get_data !== ""){
                $insert_order_data = insert('food_order',$order_data);
                
                
                
                
                
                $total_add_ons_amount=0;
                foreach($data['cart'] as $key =>$value){
                   
                      $datas=[];  
                         $datas=array(
                            "data"=>array(
                                    "order_id"=>$insert_order_data,
                                    "item_id"=>$value['item_id'],
                                    "qnt"=>$value['qty'],
                                    "date"=>date("Y-m-d"),
                                    "time"=>date ('H:i:s', time()),
                                    "table_no"=>$data['table'],
                                    "addOnesAmout"=>$value['addOnesAmout']*$value['qty'],
                                    "totalItemPrice"=>$value['totalItemPrice'],
                                ),
                            );
                        $insert_order_item_data = insert('food_order_item',$datas);
                        
                        $data['cart'][$key]["order_item_id"]=$insert_order_item_data ;
                        
                        foreach($value['add_ones'] as $val){
                            $data_addone=[];  
                            $datas=array(
                                "data"=>array(
                                        "order_id"=>$insert_order_data,
                                        "order_item_id"=>$insert_order_item_data,
                                        "add_ones_id"=>$val,
                                        "item_id"=>$value['item_id'],
                                    ),
                                );
                            $insert_datas = insert('food_order_item_addones',$datas);
                        }

                        $total_add_ons_amount+=$value['addOnesAmout']*$value['qty'];
                }    
 ////8*****************separate and update subtotal with add ons in order table**********?????           

                $ord_update_data=array(
                    "data"=>array(
                            "sub_total"=>$total_charge_data["item_total"]-$total_add_ons_amount,
                            "add_ons_charges"=>$total_add_ons_amount,
                            // "total"=>$total_charge_data["item_total"]+$total_add_ons_amount+$total_charge_data["total_charges"]
                        )
                    );
                    $update_data=update('food_order',$ord_update_data,$insert_order_data);

// ???***********************************************************************
            if($data['user_id']){
              $get_customer=select("food_customers",[
                "conditions"=>[
                    "id"=>$data['user_id']
                    ]
                ]); 
                if(!empty($get_customer)){
                     $datac=array(
                        "data"=>array(
                                "order_id"=>$insert_order_data,
                            )
                        );
                        $update_data=update('food_customers',$datac,$data['user_id']);
                }
                
            }
            
            
            
            
            
                $get_emails=select('food_email_notification',[
                    "conditions"=>[
                        "event"=>"New Order"
                        ]
                    ]);
                   foreach($get_emails as $mail){
                        $to = $mail['email'];
                        $subject = "New order - Table no: ".$data['table'];
                        $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$insert_order_data;
                        $message =file_get_contents($link);
                        // Always set content-type when sending HTML email
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                        $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                        send_mail($to,$subject,$message,$headers);
                        $text="New Order (Id: ".$insert_order_data.") Placed. Table no: ".$data['table'].". Total Amount: Rs.".$total_charge_data["amount_paid"]."  Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                        send_sms($mail['phone_no'],$text);
                        
                  }
        }
        
        
        
   



    $responce=[];
    $responce["order_id"]=base64_encode($insert_order_data);
    $responce["confirm_order_data"]=json_encode($data);
    $responce["status"]=1;



      
    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: content-type');
    header('cache-control: max-age=1');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($responce); 
?>