  <?php             
                    include("../../src/config/includes.php"); 
                    echo Layout::APILayout(); 

        
                    $issue=select('food_inventory_remove',[
                          'conditions'=>array(
                                "status"=>1,
                            ),
                        'join' =>array(
                                'food_inventory_items'=>'item',
                            )
                          ]); 

                    $temp = array_unique(array_column($issue, 'item'));
                    $unique_arr = array_intersect_key($issue, $temp);
                    $responce_issue_array=[];
                    
                    foreach($unique_arr as $data){
                        $temp_responce=[];
                        $get_item_qty=select("food_inventory_remove",[
                            "conditions"=>[
                                "item"=>$data['item']
                                ]
                            ]);
                        $t_qty=0;
                        foreach($get_item_qty as $val){
                            $t_qty += $val['qty'];
                        } 
                        $temp_responce["item"]=$data;
                        $temp_responce["total_issue"]=$t_qty;
                        $temp_responce["total_issue_amount"]=((float) $t_qty * (float) $data['food_inventory_items']['avarage_price']);
                        $responce_issue_array[]=$temp_responce;
                    }
                    // pr($responce_issue_array);
              
                    
                    
                    $responce=[];
                    $responce["out_stock"]=$responce_issue_array;
                    

                    echo json_encode($responce);
  ?>