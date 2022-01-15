<?php  
include('../../src/query/query.php');
$get_all_order=select("food_order",[
    "conditions"=>[
        "done"=>0
        ]               
    ]    
);
$get_last_order=select("food_order",[
    "conditions"=>[
        "done"=>0
        ],
        'order'=>array(
                'id'=>'desc'
                        ),
        "limit"=>1,                
    ]    
);
$total=count($get_all_order);
$datas=array();
     $lastid=$get_last_order[0]['id'];
     $table_no=$get_last_order[0]['table_no'];
 $data=array();
  $data['total']=$total;
  $data['lastid']=$lastid;
  $data['table_no']=$table_no;
//   $data['payment_status']=$pay_status;
 $datas['data']= $data;
 echo json_encode($datas);
 ?>