<?php
error_reporting(0); 
include('../../db/query.php');

if(!isset($_SERVER["PHP_AUTH_USER"])){
    header("www-Authenticate: Basic realm=\"Provet Area\"");
    header("HTTP/1.0 401 Unauthorized");
    print("Sorry, You need proper details");
    exit;
    
}else{
    if(($_SERVER["PHP_AUTH_USER"]=='papun') && ($_SERVER["PHP_AUTH_PW"]== '111111')){
            unset($_SERVER);
                            
                              if(isset($_POST['qnt'])){
                                        $get_data=[];
                                        foreach($_POST['qnt'] as $key =>$value){
                                            if($value>0){
                                                $temp_data=[];
                                                $temp_get_data=select('food_demo' 
                                                                ,array(
                                                                'conditions'=>array(
                                                                        "id"=>$key
                                                                    )
                                                            ));
                                    $temp_data["id"]= $temp_get_data[0]['id'];           
                                    $temp_data["title"]= $temp_get_data[0]['title'];  
                                    $temp_data["type"]= $temp_get_data[0]['type'];  
                                    $temp_data["special"]= $temp_get_data[0]['special'];  
                                    $temp_data["category"]= $temp_get_data[0]['category'];  
                                    $temp_data["non_veg"]= $temp_get_data[0]['non_veg'];  
                                    $temp_data["price"]= $temp_get_data[0]['price'];  
                                    $temp_data["discounted_price"]= $temp_get_data[0]['discounted_price'];  
                                    $temp_data["status"]= $temp_get_data[0]['status'];  
                                    $temp_data["img"]= $temp_get_data[0]['img'];  
                                    $temp_data["description"]= $temp_get_data[0]['description'];
                                    $temp_data["order_qnt"]= $value;
                                    $get_data[]=$temp_data; 
                                }
                            }
                            $total_data["data"]=  $get_data;            
                        }
                        if(isset($_POST['table_no'])){
                            $total_data["table_no"]=  $_POST['table_no'];   
                        }
                        if(isset($_POST['total'])){
                            $total_data["total"]=  $_POST['total'];   
                        }
                        //pr($total_data);
                        // header('X-Firefox-Spdy: h2');
                        // header('Access-Control-Allow-Origin: true');
                        // header('cache-control: max-age=14400');
                        // header('cf-cache-status: HIT');
                        // header('cf-ray: max-age=55363bee0cd3dcda-SIN');
                        // header("Content-type: application/json; charset=utf-8");
                        echo json_encode($total_data);

    }else{
        header("www-Authenticate: Basic realm=\"Provet Area\"");
        header("HTTP/1.0 401 Unauthorized");
        print("Sorry, You need proper details");
        exit;
    }
}






?>