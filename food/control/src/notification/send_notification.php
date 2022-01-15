<?php
function sendNotification(){
    $url ="https://fcm.googleapis.com/fcm/send";

    $fields=array(
        "to"=>"epMrSlxCG9owFkKjnNCVAR:APA91bFg9UEZXwXi0-H4NWVCNR9u7cKi1dK10P8Yj5LPGFzcW1eYbncLnXaNR88-EqdKdzc8Tg0xv3pFE0EFUFkK_yrU73vckdeKKlLSrSAtffuMmqrWSrN_xzxj9193hmXw-Psir83Y",
        "notification"=>array(
            "body"=>"This is Biswanath Das",
            "title"=>"Hola",
            "icon"=>'view-source:'.getenv('HTTP_BASE_PATH').'food/asact/img/notification.jpg',
            "click_action"=>"https://scanncatch.com"
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
sendNotification();