<?php
date_default_timezone_set('Asia/Kolkata');
   include('../../src/query/query.php'); 
        
        $id=$_GET["id"];
        if($_GET){
        
        
        
        $delete_scan_data=delete('food_scan_report',array(
            "id"=>$id
        ));
        
       
 
        
        
      
 
         
         
         
        }                      
?>