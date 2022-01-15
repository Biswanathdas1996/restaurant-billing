<?php 
include('query.php');
$get_category=select("food_category");

$final_data=[];

foreach($get_category as $cat_val){
    $temp_data=[];
    $temp_data["id"]=$cat_val['id'];
    $temp_data["category"]=$cat_val['name'];
    $get_data=select('food_demo' 
                        ,array(
                        'conditions'=>array(
                               "category"=>$cat_val['id'],
                            ),
                        'order'=>array(
                                'id'=>'desc'
                            )
                    )
                    );
       foreach($get_data as $val){
           $item_temp_data=[];
           $item_temp_data["id"]=$val["id"];
           $item_temp_data["title"]=$val["title"];
           $item_temp_data["type"]=$val["type"];
           $item_temp_data["price"]=$val["price"];
           $item_temp_data["img"]="https://www.scanncatch.com/food/control/food_demo_img/".$val["img"];
           $item_temp_data["description"]=$val["description"];
           $temp_data["items"][] =$item_temp_data;
       }             
                    
   $final_data[] = $temp_data;              
    }                  
   




header('X-Firefox-Spdy: h2');
header('Access-Control-Allow-Origin: true');

header('cache-control: max-age=14400');
header('cf-cache-status: HIT');
header('cf-ray: max-age=55363bee0cd3dcda-SIN');

header("Content-type: application/json; charset=utf-8");
echo json_encode($final_data);
?>
           
  