<?php  
include('../../src/query/query.php');
 $get_all_tables=select('food_table');
 $final_div_html="";
 for($i=1;$i<=$total_no_of_working_table=$get_all_tables[0]['total_working_no_of_table'];$i++){
     $check_table_status=select('food_order',[
         "conditions"=>[
             "table_no"=>$i,
             "done"=>0
             ]
         ]);
         
     $get_scan_data=select('food_scan_report',[
            "conditions"=>[
                "table_no"=>$i,
                "status"=>1
                ]
        ]);
        
     if(!empty($check_table_status)){
         $ordre_id=$check_table_status[0]['id'];
         $button_class='class="btn btn-danger " onclick="window.location.href = `../add_new_order/index.php?orderid='.$ordre_id.'`" title="Ongoing Order"  value="'.$check_table_status[0]['id'].'"';
         $order_id='Bill No:<b>'.$check_table_status[0]['id'].'</b> Amount:<b>'.$check_table_status[0]['total'].'</b>';
     }else{
         
         if(!empty($get_scan_data)){
            
             $clearid=$get_scan_data[0]["id"];
             
             
             $button_class='class="btn btn-warning table_reserve" title="QR already scanned" onclick="swal({  title: `QR already scanned!`,
                                  text: `Do you want to clear and re-scan & place new order?`,
                                  icon: `warning`,
                                  buttons: true,
                                  dangerMode: true,
                                }) .then((willDelete) => {
                                  if (willDelete) {
                                    fetch(`../ajax_api/clear_scan_data.php?id='.$clearid.'`)
                                      .then(response => response.json())
                                      .then(result => console.log(result))
                                      .catch(error => console.log(`error`, error))
                                  }
                                });" data="'.$i.'"';
             $order_id='';
         }else{
             
             $button_class='class="btn btn-success table_reserve tableId" title="Free Table"  data="'.$i.'"';
            $order_id='';
          
         }
         
       
         
     }
     $temp_div_html='<div class="col-md-2 col-sm-6 col-xs-6" style="padding: 0px 0px;">
                   <button type="button" '.$button_class.'  value="" style="padding: 8px 6px; width:95%; margin:2px;">
                          <span class="glyphicon glyphicon-text-size" style="font-size: 20px;"></span>
                         <p style="margin: 0px 0px;padding-top: 5px;font-size: 11px;font-weight:300">Table: <b>'.$i.'</b>&nbsp;&nbsp;'.$order_id.'</p>
                         
                     </button>
                 </div>';
     $final_div_html=$final_div_html.$temp_div_html;
 }
 echo $final_div_html;
?>