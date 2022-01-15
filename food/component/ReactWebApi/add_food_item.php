<?php 
error_reporting(0);
include('../../db/query.php');
// include('db_connect.php');

    $post = file_get_contents('php://input');
    $post_data = json_decode($post,true);
                
  $itemId=$post_data["itemId"];
  $Qty=$post_data["Qty"];
  $session=$post_data["sessionId"];
  $tableNo=$post_data["tableNo"];
  
  $check_already_add=select('food_checkout',array(
                "conditions"=>array(
                    "session"=>$session,
                    "item"=>$itemId,
                    "table_no"=>$tableNo
                    )
      ));
    if(!empty($check_already_add)){
        $id=$check_already_add[0]['id'];
        $data=array(
        "data"=>array(
                "qty"=>$Qty,
            ),
        );
        $Ndata=$update_data=update('food_checkout',$data,$id);
    }else{
       $data=array(
        "data"=>array(
                "item"=>$itemId,
                "qty"=>$Qty,
                "date"=>date("Y-m-d"),
                "session"=>$session,
                "table_no"=>$tableNo,
            )    
        );
        $Ndata=$insert_data = insert('food_checkout',$data);
  }



                    header('Access-Control-Allow-Methods: PUT, POST, GET, DELETE, PATCH, OPTIONS');
                    header('Access-Control-Allow-Origin: *');
                    header('Access-Control-Allow-Credentials: true');
                    header('Access-Control-Allow-Headers: content-type');
                    header('cache-control: max-age=1');
                    header("Content-type: application/json; charset=utf-8");
                    echo json_encode($Ndata);





