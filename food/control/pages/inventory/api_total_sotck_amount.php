  <?php             
                    include("../../src/config/includes.php"); 
                    echo Layout::APILayout(); 

                    $stock=select('food_inventory_add');
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
// ........................................................................                    
                    $totla_in_stock=0;
                    foreach($stock as $tdata){
                        $totla_in_stock +=$tdata['amount'];
                    }
                    
                    $totla_out_stock=0;
                    foreach($responce_issue_array as $odata){
                        $totla_out_stock +=$odata['total_issue_amount'];
                    }
// ..........................................................................                
                    
                    
                    $responce=[];
                    $responce["in_stock_amount"]=$totla_in_stock;
                    $responce["out_stock_amount"]=$totla_out_stock;
                    $responce["stock_amount"]=($totla_in_stock-$totla_out_stock);
                    

///////////////////////////////////////collect stock data
                    // $stockData=[];
                    // foreach($stock as $key=> $stockItem){
                    //     $temp=[];
                    //     $get_items=select("food_inventory_items",[
                    //       'conditions'=>array(
                    //             "id"=>$stockItem["item"],
                    //         ),
                    //     'join' =>array(
                    //             'units'=>'unit',
                    //         )
                    //       ]);
                    //       $temp["stock"]=$stockItem;
                    //       $temp["item"]=$get_items[0];
                    //       $stockData[]=$temp;
                    // }
                    // $total_stock_amount=0;
                    // foreach($stockData as $data){
                    //     $total_stock_amount +=$data["stock"]["amount"];
                    // }

 /////////////////////////////////////////////////////////////////////////////////////////calculate avg price item wise /////
                    // $temp_stock = array_unique(array_column($stock, 'item'));
                    // $unique_arr_stock = array_intersect_key($stock, $temp_stock);
                    // $avg_price_array=[];
                    // foreach($unique_arr_stock as $data){
                    //     $temp_responce=[];
                    //     $get_item_qty=select("food_inventory_add",[
                    //         "conditions"=>[
                    //             "item"=>$data['item']
                    //             ]
                    //         ]);
                    //     $avg_price=0;
                    //     $avg_qty=0;
                    //     foreach($get_item_qty as $val){
                    //         $avg_price += $val['amount'];
                    //         $avg_qty += $val['qty'];
                    //     } 
                    //     $temp_responce["item"]=$data['item'];
                    //     $temp_responce["avarage_price"]=($avg_price/$avg_qty);
                    //     $avg_price_array[]=$temp_responce;
                    // }
                    // pr($avg_price_array);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// calculate total stock amount
                    // foreach($responce_issue_array as $data){
                    //         $new = array_filter($avg_price_array, function ($var) {
                    //             return ($var['item'] == $data["item"]);
                    //         });
                    //         pr($new);
                    // }
        echo json_encode($responce);
  ?>