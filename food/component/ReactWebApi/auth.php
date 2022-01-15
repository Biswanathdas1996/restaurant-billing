<?php 
error_reporting(0);
include('../../db/query.php');
include('db_connect.php');


    $token=$_GET["token"];
    $get_data=select('food_scan_report' 
                        ,array(
                        'conditions'=>array(
                                "token"=>$token,
                                "status"=>1,
                            )
                    )
                );
    if(count($get_data)>0){
        $check_table_data=select('food_order',
                            array(
                                'conditions'=>array(
                                        "table_no"=>$get_data[0]['table_no'],
                                        "done"=>0
                                    )
                            )
                        );
        
        $responce=[];
        if(count($check_table_data)>0){
            
            if($check_table_data[0]["token"] == $token) {
                $responce["data"]=$get_data[0];
                $responce["msg"]="Table Free to Use";
                $responce["status"]=1;
            }else{
                $responce["data"]=[];
                $responce["msg"]="Table Occupied";
                $responce["status"]=0;
            }
        }  else{
        
            $responce["data"]=$get_data[0];
            $responce["msg"]="Table Free to Use";
            $responce["status"]=1;
        }
    }else{
        $responce["data"]=[];
        $responce["msg"]="Invalid Request";
        $responce["status"]=0;
    }
                  
    



                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($responce);



?>
           
  