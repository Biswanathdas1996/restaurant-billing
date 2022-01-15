<?php

include("../../src/config/includes.php"); 
  echo Layout::DLayout();


    function send_push($token,$body,$title){
        $url ="https://fcm.googleapis.com/fcm/send";
        $fields=array(
            "to"=>$token,
            "notification"=>array(
                "body"=>$body,
                "title"=>$title,
                "icon"=>'view-source:'.getenv('HTTP_BASE_PATH').'food/asact/img/notification.jpg',
                "click_action"=>'https://scanncatch.com',
                "sound" => "default"
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
        // print_r($result);
        curl_close($ch);
    
        return $result;
    }


if($_POST["token"]){
        $token=$_POST["token"];
        $body=$_POST["text"];
        $title=$_POST["title"];
        echo $responce= send_push($token,$body,$title);
        
        
}else if($_POST["bulk"]){
        $body=$_POST["text"];
        $title=$_POST["title"];
        $get_customers=select("food_customers");
       
        foreach($get_customers as $data){
            if($data["firebase_token"] != null){
                $token=$data["firebase_token"];
                 $responce= send_push($token,$body,$title);
                
            }
        }
        echo $responce;                              
}

    
    

?>