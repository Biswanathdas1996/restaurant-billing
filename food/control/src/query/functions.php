<?php

function send_sms($number,$text){
    $check_permission=select('food_settings');
            
            if($check_permission[0]['send_sms_notifications']==1){
            $text = str_replace(' ','%20',$text);
            $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://sms.teleosms.com/api/mt/SendSMS?user=logicstixinnovations&password=12345&senderid=PIKKIT&channel=Trans&DCS=0&flashsms=0&number='.$number.'&text='.$text.'&route=2');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                curl_close($ch);
            }else{
                
            }
        }
 
        
function send_mail($to,$subject,$message,$headers){
    
    $check_permission=select('food_settings');
            
            if($check_permission[0]['send_email_notifications']==1){
                // mail($to,$subject,$message,$headers);
                 require 'PhpMailer/PHPMailerAutoload.php';
	
            	$mail = new PHPMailer;
            	//$mail->isSMTP();
            	$mail->Host="scanncatch.com";
            	$mail->Port="21513";
            	$mail->SMTPAuth=true;
            	$mail->SMTPSecure = 'tls';
            	
            	$mail->Username ="info@scanncatch.com";
            	$mail->Password =";-xhFtt)#5M7";
            
            	$mail->setFrom('info@scanncatch.com',"Scan n Catch");
            	$mail->addAddress($to);
            	$mail->addReplyTo('info@scanncatch.com');
            	$mail->isHtml(true);
            	$mail->Subject =$subject;
            	$mail->Body=$message;
            	$mail->send();
            }
    
}     







function sendPushNotification($to,$title,$body,$clickLink){
    $url ="https://fcm.googleapis.com/fcm/send";


    $to="epMrSlxCG9owFkKjnNCVAR:APA91bFg9UEZXwXi0-H4NWVCNR9u7cKi1dK10P8Yj5LPGFzcW1eYbncLnXaNR88-EqdKdzc8Tg0xv3pFE0EFUFkK_yrU73vckdeKKlLSrSAtffuMmqrWSrN_xzxj9193hmXw-Psir83Y";
    $body="This is Biswanath Das";
    $clickLink=getenv('HTTP_BASE_PATH')."food/control/pages/newOrder/";
    
    $fields=array(
        "to"=>"",
        "notification"=>array(
            "body"=>$body,
            "title"=>$title,
            "icon"=>'view-source:'.getenv('HTTP_BASE_PATH').'food/asact/img/notification.jpg',
            "click_action"=>$clickLink
        )
    );


    $headers=array(
        'Authorization: key=AAAARStlBEI:APA91bE-GY4eEM9RL0dNWxro0Rpn37h-UYmArssPa2J7lkZMPyh07UyTa5dupQHCKsR-WAfC-uc5aNGL43F9VenpU9et0CTX0b9Oj_LlPOqRFsGNTjiU6d8fPN9p7tA1Io58BPWDjTgn',
        'Content-Type:application/json'
    );

    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($fields));
    $result=curl_exec($ch);
    print_r($result);
    curl_close($ch);
}


?>