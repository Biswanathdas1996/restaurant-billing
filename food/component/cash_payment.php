<?php 
include('../db/query.php');;
include('head_includes.php');
date_default_timezone_set('Asia/Kolkata');
$id=$_POST["order_id"];
$table=$_POST["table_no"];

        $data=array(
        "data"=>array(
                "payment_status"=>2,
                "txn_id"=>"cash",
            ),
        );
    $update_payment_status=update('food_order',$data,$id);
   
   
    $s_total_amount=get_order_items_total_amount($id);//function is in head_include.php
    $tax=tax_calculation($s_total_amount);
                          foreach($tax['details'] as $charge){
                            $data_charge=[];  
                             $data_charge=array(
                                "data"=>array(
                                        "order_id"=>$id,
                                        "name"=>$charge['name'],
                                        "amount"=> $charge['amount'],
                                        "charge_or_discount"=>$charge['charge_or_discount'],
                                        "created"=>date("Y-m-d"),
                                    ),
                                );
                            $insert_charge_datas = insert('food_order_charges',$data_charge);
                          }
   
    /////////////////////////////////////////////////////////////////////////////////////////////// EXPO notfication       
    //   $title="Collect Cash";
    //   $msg="Please Collect Cash On Table No:".$table." Order Id:".$id;
    //   include("expo_notification.php");
 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 
            // $t_amount=$s_total_amount+$charge['amount']+$tax;
            $get_order_data=select('food_order',[
                "conditions"=>[
                    "id"=>$_POST["order_id"]
                    ]
                ]);
            
              
               
            $get_emails=select('food_email_notification',[
            "conditions"=>[
                "event"=>"Ask for Cash Pay"
                ]
            ]);
           foreach($get_emails as $mail){
                // $msg = "Table No: ".$_POST['table_no']."\nOrder Id: ".$insert_data;
                // $subject="New order - Table no: ".$_POST['table_no'];
                // $msg = wordwrap($msg,70);
                // mail($mail['email'],$subject,$msg);
                
                $to = $mail['email'];
                $subject="Collect Cash Payment - Table no: ".$_POST["table_no"];
                
                $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$_POST["order_id"];
                
                $message =file_get_contents($link);;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                
                $text="Collect Cash (Id: ".$_POST["order_id"]."): Rs.".$get_order_data[0]['total']." . Table no: ".$_POST['table_no']." Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                send_sms($mail['phone_no'],$text);
                
          }
 
 
?>
<script>
    
    window.location.replace("../thank_you.php?order_id="+<?php echo $id;?>);
</script>