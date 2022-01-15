<?php 
include("../../src/query/query.php");
include("../../src/config/connection.php");

$total_data=[];
$final_data=[];


if(isset($_GET["id"]) && $_GET["id"] !=null){
    
    $id=$_GET["id"];
    
    $sql = "SELECT * FROM food_demo WHERE id = '$id'";  
 
                    $retval=mysqli_query($conn, $sql); 
                    
                        $temp_data=[];
                        
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
                               $temp_data["items"] =$item_temp_data;
                                       
                     }  
                    }else{  
                     $temp_data["items"] =[];
                    }
           $final_data = $temp_data;         
                    
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
           
  