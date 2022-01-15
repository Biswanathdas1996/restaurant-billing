<?php 
error_reporting(0);
 include('../../db/query.php');
    date_default_timezone_set('Asia/Kolkata');

$id=base64_decode($_GET["order_id"]);


  $get_order_data=select('food_order',[
                "conditions"=>[
                    "id"=>$id
                    ]
                ]);


        $data=array(
        "data"=>array(
                "payment_status"=>2,
                "txn_id"=>"cash",
            ),
        );
    $update_payment_status=update('food_order',$data,$id);
   
   

       
          
            
              
               
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
                $subject="Collect Cash Payment - Table no: ".$get_order_data[0]['table_no'];
                
                $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$id;
                
                $message =file_get_contents($link);;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                
                $text="Collect Cash (Id: ".$id."): Rs.".$get_order_data[0]['total']." . Table no: ".$get_order_data[0]['table_no']." Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                send_sms($mail['phone_no'],$text);
                
          }
          
    $responce=1;
    
    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Headers: content-type');
    header('cache-control: max-age=1');
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($responce);   
 
 
?>
