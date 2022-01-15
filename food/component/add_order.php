<?php
session_start();  
include('notification/add_notification.php');
include('../config/index.php');
date_default_timezone_set('Asia/Kolkata');
if(isset($_POST['confirm_order'])){?>
    
   
 <!--/////////////////////   -->
    <style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

#outPopUp {
  position: absolute;
  width: 200px;
  height: 200px;
  z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
 
}
</style>
    
   <center  id="outPopUp"> 
   <div class="loader"></div> 

    </center>
    
 <!--/////////////////////   -->
   <?php  if(!isset($_GET["order_id"]) || $_GET["order_id"] ==""){
       

      /////////////////same device order placed
      ?>
      
      
      <?php  
      
      //include('same_device_other_table.php'); 
      
      ?>
      
      
      
      <?php 
      //////////////////////
      
      
      if(!isset($_POST['qnt']) || empty($_POST['qnt'])){
           ?>
            <script>
              window.location.replace("index.php?table_no="+<?php echo $_POST['table_no'];?>);
            </script>
           <?php
           die;
       }

        $tax=tax_calculation($_POST['subtotal']);
        $total_tax=$tax['total'];
        $total=($_POST['subtotal']+$total_tax);
        
        $session=base64_encode(get_client_ip());
        
   
        
        // setcookie("session", $session, time() + (86400 * 30), "/");
        
        $data=array(
            "data"=>array(
                "process_session"=>$session,
                "table_no"=>$_POST['table_no'],
                "sub_total"=>$_POST['subtotal'],
                "total_charges"=>$total_tax,
                "total"=>$total,
                "date"=>date("Y-m-d"),
                "time"=>date ('H:i:s', time()),
                "cooking_instruction"=>$_POST['instruction']
            ),
        );
        
        
        $insert_data = insert('food_order',$data);
        foreach($_POST['qnt'] as $key =>$value){
          $datas=[];  
             $datas=array(
                "data"=>array(
                        "order_id"=>$insert_data,
                        "item_id"=>$key,
                        "qnt"=>$value,
                        "date"=>date("Y-m-d"),
                        "time"=>date ('H:i:s', time()),
                        "table_no"=>$_POST['table_no'],
                    ),
                );
            $insert_datas = insert('food_order_item',$datas);
            
            
                 }
        
        
        $get_emails=select('food_email_notification',[
            "conditions"=>[
                "event"=>"New Order"
                ]
            ]);
           foreach($get_emails as $mail){
                
                
                $to = $mail['email'];
                $subject = "New order - Table no: ".$_POST['table_no'];
                $link=$_base_path."food/invoice/index.php?id=".$insert_data;
                
                $message =file_get_contents($link);;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                
                $text="New Order (Id: ".$insert_data.") Placed. Table no: ".$_POST['table_no'].". Total Amount: Rs.".$total."  Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                send_sms($mail['phone_no'],$text);
                
          }
          
        
          
      
        
    ///////////////////////////////////////////////////charges    
        //  $s_total_amount=$_POST['subtotal'];
        //                   foreach($tax['details'] as $charge){
        //                     $data_charge=[];  
        //                      $data_charge=array(
        //                         "data"=>array(
        //                                 "order_id"=>$insert_data,
        //                                 "name"=>$charge['name'],
        //                                 "amount"=> $charge['amount'],
        //                                 "charge_or_discount"=>$charge['charge_or_discount'],
        //                                 "created"=>date("Y-m-d"),
        //                             ),
        //                         );
        //                     $insert_charge_datas = insert('food_order_charges',$data_charge);
        //                   }
    //////////////////////////////////////////////////////////////////////    
        
    /////////////////////////////////////////////////////////// EXPO notfication       
        // $title="New order placed";
        // $msg="New order placed on table no:".$_POST['table_no'];
        // include("expo_notification.php");
 ///////////////////////////////////////////////////////////////////////////////      
      ?>
      <script>
      window.location.replace("thank_you.php?order_id="+<?php echo $insert_data;?>);
     </script> 
    <?php
    }else{
  /////////////////////////////////////////////   add items      
        $check=select('food_order',[
            "conditions"=>[
                "id"=>$_GET["order_id"]
                ]
            ]);
            
           if( ($check[0]['process_session'] != base64_encode(get_client_ip())) && ($check[0]['bypass_session']==0) ){
               ?>
              <script>
                swal("Unauthorized Device !", "Please add item(s) from which You placed order/ call waiter ", "error", {
                      buttons: {
                      
                        catch: {
                          text: "Call Waiter",
                          value: "catch",
                        },
                        Order: "View Order",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                     
                        case "Order":
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                          break;
                     
                        case "catch":
                          
                          window.open('tel:900300400');
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                          break;
                     
                        default:
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                      }
                    });
             </script> 
            <?php
             die("Unauthorized Device");   
           } 
            


        $id=$_GET["order_id"];
        //function is in head_include.php
        $sub_total=get_order_items_total_amount($id);
        $s_t=($sub_total+$_POST['total']);
        $tmp_charges=tax_calculation($s_t);
        $t_t=($s_t+$tmp_charges['total']);
        $data_u=array(
        "data"=>array(
                "total"=>($t_t),
                "sub_total"=>($s_t),
                "total_charges"=>$tmp_charges['total'],
            )
        );
        $update_data=update('food_order',$data_u,$id);
        $insert_data=$_GET["order_id"];
        foreach($_POST['qnt'] as $key =>$value){
            $check_exist_orderitem=select('food_order_item',array(
                    "conditions"=>array(
                            "order_id"=>$id,
                            "item_id"=>$key
                        )
                ));
            if(sizeof($check_exist_orderitem)>0){
              $o_i_id=$check_exist_orderitem[0]['id'];
                    $new_qnt=($check_exist_orderitem[0]['qnt']+$value);
                    $data_ou=array(
                    "data"=>array(
                            "qnt"=>$new_qnt,
                        )
                    );
                   $update_data=update('food_order_item',$data_ou,$o_i_id);
            }else{
              $datas=[];  
                $datas=array(
                    "data"=>array(
                            "order_id"=>$insert_data,
                            "item_id"=>$key,
                            "qnt"=>$value,
                            "date"=>date("Y-m-d"),
                            "time"=>date ('H:i:s', time()),
                            "table_no"=>$_POST['table_no'],
                        ),
                    );
                $insert_datas = insert('food_order_item',$datas);  
            }    
        }
      
        $get_emails=select('food_email_notification',[
            "conditions"=>[
                "event"=>"Order Modification"
                ]
            ]);
            
           foreach($get_emails as $mail){
                // $msg = "Table No: ".$_POST['table_no']."\nOrder Id: ".$insert_data;
                // $subject="New order - Table no: ".$_POST['table_no'];
                // $msg = wordwrap($msg,70);
                // mail($mail['email'],$subject,$msg);
                
                $to = $mail['email'];
                $subject="Order Modification - Table no: ".$_POST['table_no'];
                
                $link=$_base_path."food/invoice/index.php?id=".$insert_data;
                
                $message =file_get_contents($link);
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                
                $text="Order Modification (Id: ".$insert_data.") . Table no: ".$_POST['table_no']." Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                send_sms($mail['phone_no'],$text);
          }
        
        /// Send push notification to Admin
          $get_notfication_data=select('food_admin_push_notification',[
            "conditions"=>[
                "status"=>1
                ]
            ]);
            foreach($get_notfication_data as $notification){
                $to=$notification['token'];
                $clickLink=$_base_path."food/invoice/index.php?id=".$insert_data;
                $body="Order Modification from table no ".$_POST['table_no'];
                $title="Order Modification - Table no: ".$_POST['table_no'];
                
                sendPushNotification($to,$title,$body,$clickLink);
            }
        
       
        
       ////////charge for modifing order
    // $conditions=array(
    //                     "order_id"=>$id,
    //                 );
    // $delete_data=delete('food_order_charges',$conditions);
    // $s_total_amount=get_order_items_total_amount($id);//function is in head_include.php
    // $tax=tax_calculation($s_total_amount);
    
    //                       foreach($tax['details'] as $charge){
                             
    //                         $data_charge=[];  
    //                          $data_charge=array(
    //                             "data"=>array(
    //                                     "order_id"=>$id,
    //                                     "name"=>$charge['name'],
    //                                     "amount"=> $charge['amount'],
    //                                     "charge_or_discount"=>$charge['charge_or_discount'],
    //                                     "created"=>date("Y-m-d"),
    //                                 ),
    //                             );
    //                         $insert_charge_datas = insert('food_order_charges',$data_charge);
    //                       }
        
                        
        
        
/////////////////////////////////////////////////////////////////////////////////////////////// EXPO notfication       
    //     $title="Order Modification";
    //     $msg="Order Modification on table no:".$_POST['table_no']." Order Id:".$_GET["order_id"];
    //   include("expo_notification.php");
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////       
     ?>
    <script>
         window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
    </script>  
 <?php   } 

}

?>