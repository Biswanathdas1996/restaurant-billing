<?php
date_default_timezone_set('Asia/Kolkata');
   include('../../src/query/query.php'); 
        $id=$_GET["id"];
        $table=$_GET["table_no"];
        $payment_method=$_GET["payment_method"];
        
        if($_GET){
        $data=array(
        "data"=>array(
                "done"=>1,
                "payment_method"=>$payment_method,
            ),
        );
        $update_data=update('food_order',$data,$id);
        echo $update_data;
        
        // $conditions=array(
        //     "table_no"=>$table,
        // );
        // $delete_data=delete('food_table_book',$conditions); 
        
    ///////////////////////////////////////////////////// 
     $get_order=select("food_order",[
         "conditions"=>[
             "id"=>$id
             ]
         ]);
         
    $get_scan_token=select("food_scan_report",[
         "conditions"=>[
             "token"=>$get_order[0]['token']
             ]
         ]);
         
    $sdata=array(
        "data"=>array(
                "token"=>"",
                "status"=>0,
            ),
        );
    $update_data=update('food_scan_report',$sdata,$get_scan_token[0]["id"]);
         
    
        
 ///////////////////////////////////////////////////////////////////////////////////////////////  notfication       
       
       $get_emails=select('food_email_notification',[
            "conditions"=>[
                "event"=>"Table Clean Request"
                ]
            ]);
           foreach($get_emails as $mail){
                
                
                $to = $mail['email'];
                $subject = "Please Clean - Table no: ".$_GET["table_no"];
                
               
                
                $message ="Please Clean - Table no: ".$_GET["table_no"];;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                
                $text="Please Clean - Table no: ".$_GET["table_no"]."  Time: ".date("Y-m-d")." :: ".date ('H:i:s', time());
                send_sms($mail['phone_no'],$text);
                
          }
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
         
         
         
        }                      
?>