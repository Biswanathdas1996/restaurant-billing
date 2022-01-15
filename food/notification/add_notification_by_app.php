<?php
 include('query.php');
 include('add_notification.php');
 // Getting the received JSON into $json variable.
 $json = file_get_contents('php://input');
 // decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
 // Populate User name from JSON $obj array and store into $name.
    $text = $obj['massege'];



 /////////////////////////////////////////////////////////////////////////////////////////////// EXPO notfication       
       
       $title="New Message";
       $msg=$text;
       include("../expo_notification.php");
 ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    // notifications($text,$text,1);

   $MSG = 'User Registered Successfully' ;
 
    // Converting the message into JSON format.
    $json = json_encode($MSG);

    echo $json ;

 
 







?>