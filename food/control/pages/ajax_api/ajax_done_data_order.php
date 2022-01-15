<?php  
    include('../../src/query/query.php');
    $datas=array();
    $get_order_data=select('food_order' 
                        ,array(
                        'conditions'=>array(
                                "done"=>1,
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
            
            $data['rating']="<p style='font-size: 11px;letter-spacing: 1px;'><b>".($value['rating'] ?$value['rating']." <span class='glyphicon glyphicon-star'></span>" : "")."</b></p>";
            
            $data['table_no']="<p style='font-size: 11px;letter-spacing: 1px;'>".$value['table_no']."</p>";
            // $data['qty']="
            // <span class='glyphicon glyphicon-cutlery modalltext' value='".$value['id']."'>
            // <p style='font-size: 11px;letter-spacing: 1px;'>View Items (".sizeof($value['food_order_item']).")</p></span>";
            
            // $data['indivisual_discount']="<p style='font-size: 11px;letter-spacing: 1px;'> ₹".$value['indivisual_discount']."</p>";
            
            $data['amount']="<p style='font-size: 11px;letter-spacing: 1px;'> ₹".($value['total']-$value['indivisual_discount'])."</p>";
            
            
            
            
            if($value['payment_status']==0){
                $data['payment']="<p><span class='glyphicon glyphicon-time' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #bb0505 !important;'>&nbsp;Pending </span></p>";
            }
            else if($value['payment_status']==1){
                $data['payment']="<p><span class='glyphicon glyphicon-globe' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #5cb85c !important;'>&nbsp;Online Paid </span></p>";
            }
            else if($value['payment_status']==2){
                $data['payment']="<p><span class='glyphicon glyphicon-credit-card' style='font-size: 12px !important ;letter-spacing: 1px !important;color: #EE7B07 !important;'>&nbsp;Cash Paid </span></p>";
            }
            $data['time']="<p style='font-size: 9px;letter-spacing: 1px;'>".$value['date']." <br> ".$value['time']."</p>";
            
            
            
            
            
            // $data['invoice']="<a href='../../../invoice/index.php?id=".$value['id']."' target='_blank'>"."<span class='glyphicon glyphicon-paste'></span>"."</a>";
            
            
            
            
            $data['invoice']="
            <form action='../ajax_api/send_invoice.php' class='form-inline'>
                <div class='form-group'>
                    <input type='email' name='email' placeholder='Enter Email'required/>
                    <input type='hidden' name='id' value=".$value['id']."'/>
                </div>
                <button type='submit' class='btn btn-primary'>Send</button>
                
                <a href='../../../invoice/download.php?id=".$value['id']."' target='_blank'> <button type='Button' class='btn btn-success'>Download</button></a>
               
            </form>    
                    ";
           
            $datas['data'][]=$data;
            $i++;
        }
echo json_encode($datas); 
?>

