<?php 
error_reporting(0);
include('../../db/query.php');
include('../../db/connection.php');
// include('db_connect.php');

$total_data=[];
$final_data=[];


if(isset($_GET["search"]) && $_GET["search"] !=null){
    
    $search=$_GET["search"];
    
   $sql = "SELECT * FROM food_demo WHERE title LIKE '%$search%'";  
                    $retval=mysqli_query($conn, $sql); 
                    
                        $temp_data=[];
                        $temp_data["id"]=1;
                        $temp_data["category"]="Search Data";
                    if(mysqli_num_rows($retval) > 0){  
                     while($row = mysqli_fetch_assoc($retval)){ 
                         
                               $item_temp_data=[];
                               $item_temp_data["id"]=$row["id"];
                               $item_temp_data["title"]=$row["title"];
                               $item_temp_data["type"]=$row["type"];
                               $item_temp_data["price"]=$row["price"];
                               $item_temp_data["img"]=$row["img"];
                               $item_temp_data["description"]=$row["description"];
                               if($row["status"]==0){
                                    $item_temp_data["status"]="disabled_div";
                               }else{
                                    $item_temp_data["status"]="";
                               }
                               $temp_data["items"][] =$item_temp_data;
                                       
                     }  
                    }else{  
                     $temp_data["items"] =[];
                    }
           $final_data[] = $temp_data;         
                    
}else{
    $get_category=select("food_category");
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
     if(count($get_data)>0){               
       foreach($get_data as $val){
           $item_temp_data=[];
           $item_temp_data["id"]=$val["id"];
           $item_temp_data["title"]=$val["title"];
           $item_temp_data["type"]=$val["type"];
           $item_temp_data["price"]=$val["price"];
           $item_temp_data["img"]=$val["img"];
           $item_temp_data["description"]=$val["description"];
           if($val["status"]==0){
                $item_temp_data["status"]="disabled_div";
           }else{
                $item_temp_data["status"]="";
           }
           $temp_data["items"][] =$item_temp_data;
       }             
           $final_data[] = $temp_data;
     }
    } 
}


     

   
    

    
$total_data["data"]=  $final_data;  

// header('X-Firefox-Spdy: h2');
// header('Access-Control-Allow-Origin: true');
// header('cache-control: max-age=14400');
// header('cf-cache-status: HIT');
// header('cf-ray: max-age=55363bee0cd3dcda-SIN');
// header("Content-type: application/json; charset=utf-8");


echo json_encode($total_data);
?>
           
  