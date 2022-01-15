<?php 
error_reporting(0); 
include('../../db/connection.php'); 
$id=mysqli_real_escape_string($conn,$_GET["order_id"]);;
$datas=array();
$sql = "SELECT * FROM `food_order` WHERE `id`='$id' AND `done` = 0";  
$retval=mysqli_query($conn, $sql);  
$total=mysqli_num_rows($retval);

 $data=array();
 $data['total']=$total;
 $datas['data']= $data;
 
 echo json_encode($datas);
?>