<?php 
date_default_timezone_set('Asia/Kolkata');
include("../../src/query/query.php");
include("../../src/config/connection.php");


if(isset($_GET["table_no"])){
    $table_no=$_GET["table_no"];
    $type=1;
}else{
    $type=$_GET["type"];
    $table_no=null;
}





    $data=array(
        "data"=>array(
                "order_type"=>$type,
                "table_no"=>$table_no,
                "date"=>date("Y-m-d"),
                "time"=>date ('H:i:s', time()),
            )
        );
     $insert_data = insert('food_order',$data);
    
    header("Location: index.php?orderid=".$insert_data);

?> 

<script>
      window.location.replace("index.php?orderid="+<?php echo $insert_data;?>);
     </script> 

           
  