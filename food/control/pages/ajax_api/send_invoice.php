<?php
date_default_timezone_set('Asia/Kolkata');
   include('../../src/query/query.php'); 
        $id=$_GET["id"];
       
        $to=$_GET["email"];
        if($_GET){
        

                
                $subject = "Invoice - ".date("d/m/Y");
                
               
        
               
                $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$id;
                $message =file_get_contents($link);
                
                
                
                send_mail($to,$subject,$message,$headers);
                
                
                // $text="Please Clean - Table no: ".$_GET["table_no"]."  Time: ".date("Y-m-d")." :: ".date ('H:i:s', time());
                // send_sms($mail['phone_no'],$text);
                
          
                
         
         
         
        }                      
?>

<center>
    <h2>Email Send </h2>
    <button onclick="window.history.back()" style="padding: 10px 40px;cursor: pointer;">Back</button>
</center>

