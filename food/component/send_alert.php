<?php

   
           $get_emails=select('food_email_notification');
           foreach($get_emails as $mail){
                // $msg = "Table No: ".$_POST['table_no']."\nOrder Id: ".$insert_data;
                // $subject="New order - Table no: ".$_POST['table_no'];
                // $msg = wordwrap($msg,70);
                // mail($mail['email'],$subject,$msg);
                
                $to = $mail['email'];
                $subject = "New order - Table no: ".$_POST['table_no'];
                
                $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$insert_data;
                
                $message =file_get_contents($link);;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                mail($to,$subject,$message,$headers);
                
          }
?>