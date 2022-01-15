<?php
     
     

    $host =   'localhost';  
    $user =   'root';   
    $pass =   '';  
    $dbname = 'scanncat_papun'; 
     
    // $host =   'localhost';  
    // $user =   'scanncat_user';  
    // $pass =   'MERZrWrNpCA!';  
    // $dbname = 'scanncat_papun'; 


    $conn = mysqli_connect($host, $user, $pass,$dbname);  
    if(!$conn){  
      die('Could not connect: '.mysqli_connect_error());  
    }  
    
    
    
    ?>