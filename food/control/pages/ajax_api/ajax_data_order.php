<?php  
    include('../../src/query/query.php');
    $datas=array();
    $get_order_data=select('food_order' 
                        ,array(
                        'conditions'=>array(
                                "done"=>0,
                            ),
                        'join_many' => array(
                                'food_order_item'=>'order_id',
                            ),
                        'order'=>array(
                                'id'=>'desc'
                            ),
                        )
                    );
        //   pr($get_order_data);         
                    
                    $i=1;
        foreach($get_order_data as $value){
            $data=array();
            // $data['serial']=$i;
            $data['order_id']="<p style='font-size: 11px;letter-spacing: 1px;'>".$value['id']."</p>";
            $data['table_no']="<p style='font-size: 11px;letter-spacing: 1px;'>".$value['table_no'] ."</p>";
            
            if($value['order_type'] != null){
                
                $get_member=select("food_menu_type",[
                    "conditions"=>[
                        "id"=>$value['order_type']
                        ]
                    ]);
                $data['customer']="<span>".$get_member[0]["name"]."</span>" ;
                
            }else{
                 $data['customer']="NA";
            }
           
            
            $data['qty']="
            <center>
             <img id='show_loader_".$value['id']."' class='img-responsive' src='../../../asact/img/lo.gif' style='height:70px;display:none;'> 
            <center>
            <span class='glyphicon glyphicon-cutlery modalltext s_hide_".$value['id']."' value='".$value['id']."' id='hide_loader_'".$value['id']."'>
            <p id='hide_loader_text_".$value['id']."' style='font-size: 11px;letter-spacing: 1px;'>View Items </p></span>";
            
            $data['amount']="<p style='font-size: 11px;letter-spacing: 1px;'> ₹".($value['total'])."</p>
            
            </img>
            ";
            
            if($value['payment_status']==0){
                $data['payment']="<p><span class='glyphicon glyphicon-time' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #bb0505 !important;'>&nbsp;Pending </span></p>";
            }
            else if($value['payment_status']==1){
                $data['payment']="<p><span class='glyphicon glyphicon-globe' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #5cb85c !important;'>&nbsp;Online Paid (Txn:".$value['txn_id']. ") </span></p>";
            }
            else if($value['payment_status']==2){
                $data['payment']="<p><span class='glyphicon glyphicon-credit-card' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #EE7B07 !important;'>&nbsp;Please Collect Cash </span></p>";
            }
            
            
            $data['time']="<p style='font-size: 9px;letter-spacing: 1px;'>".$value['date']." <br> ".$value['time']."</p>";
            
                // $accti   on_complete_button="<button title='Complete the order' type='button' class='btn btn-success complete' data='".$value['id']."' table='".$value['table_no']."'><span class='glyphicon glyphicon-ok-sign' style='color: white !important;'></span></button>";
                
              
                $acction_accept_all_device_button="<a href='../add_new_order/index.php?orderid=".$value['id']."' > <button title='Edit Order' type='button' class='btn btn-warning' style='margin-right: 3px;'><span class='glyphicon glyphicon glyphicon-edit' style='color: white !important;'></span></button></a>";
                
                 $acction_delete_button="<button title='Delete Order' type='button' class='btn btn-danger delete' data='".$value['id']."' table='".$value['table_no']."'><span class='glyphicon glyphicon-trash' style='color: white !important;'></span></button>";
                 
                 $kitchen_recept="<a href='../../../invoice/download_kitchen_recept.php?id=".$value['id']."' target='_blank'> <button title='Kitchen Copy' type='button' class='btn btn-primary '   style='margin-left: 3px;'><span class='glyphicon glyphicon-file' style='color: white !important;'></span></button></a>";
            
            
            
            
            $data['action']=$acction_complete_button.$acction_accept_all_device_button.$acction_delete_button.$kitchen_recept;
            
            
            $datas['data'][]=$data;
            $i++;
        }
echo json_encode($datas); 
?>

