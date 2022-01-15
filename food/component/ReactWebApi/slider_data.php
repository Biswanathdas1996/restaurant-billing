<?php 
error_reporting(0);
include('../../db/query.php');
// include('db_connect.php');



  
  $slider_data=select('slider_settings',array(
                "conditions"=>array(
                    "status"=>1
                    )
      )); 
      
 


                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($slider_data);



