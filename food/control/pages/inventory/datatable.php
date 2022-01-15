  <?php             
                    include("../../src/config/includes.php"); 
                    include("../../src/config/connection.php"); 
                    echo Layout::APILayout(); 

                    $limit = $_REQUEST['length'];
                    $offset = $_REQUEST['start'];
       
    
                   
                   // ..........................calculate total////
                    $get_items_total=select('food_inventory_add'); 
                    $temps = array_unique(array_column($get_items_total, 'item'));
                    $unique_arr_for_total = array_intersect_key($get_items_total, $temps);
                    // ..................end................
               
                if(isset($_REQUEST["search"]['value']) && $_REQUEST["search"]['value'] !=null){
                    
                    $search=$_REQUEST["search"]['value'];
                    
                    $sql = "SELECT * FROM food_inventory_items WHERE name LIKE '%$search%'";  
                    $retval=mysqli_query($conn, $sql);  
                      
                    if(mysqli_num_rows($retval) > 0){  
                     while($row = mysqli_fetch_assoc($retval)){  
                       $itemId= $row['id'];  
                     }  
                    }else{  
                    echo "0 results";  
                    }  
                    
                    
                    $get_items=select('food_inventory_add',[
                                  'conditions'=>array(
                                        "item" => $itemId
                                    ),
                                'join' =>array(
                                        'food_inventory_items'=>'item',
                                    ),
                            "limit"=>$limit,
                            "offset"=>$offset,
                          ]);
                    
                    
                }else{
                    $get_items=select('food_inventory_add',[
                                  'conditions'=>array(
                                        "status"=>1,
                                    ),
                                'join' =>array(
                                        'food_inventory_items'=>'item',
                                    ),
                            "limit"=>$limit,
                            "offset"=>$offset,
                          ]);
                    
                }     
                    
                          
                          
                          
                          
                    $temp = array_unique(array_column($get_items, 'item'));
                    $unique_arr = array_intersect_key($get_items, $temp);

                    // pr($unique_arr);
                    
                    $totalData=[];
                    foreach($unique_arr as $data){
                        
                        $get_unit=select('units',[
                            "conditions"=>[
                                "id"=>$data['food_inventory_items']['unit']
                                ]
                            ]);
                        
                        $nestedData=[]; 
                        $nestedData[]=$data['food_inventory_items']['name']; 
                        $nestedData[]="₹".number_format($data['food_inventory_items']['avarage_price'],2)." /<small>".$get_unit[0]['unit_name']."</small>";
                        
                        
                        
                        
                        
                        $get_add_data=select("food_inventory_add",[
                            "conditions"=>[
                                "item"=>$data['item']
                                ]
                            ]);
                        $total_add=0;
                        foreach($get_add_data as $datas){
                            $total_add += $datas['qty'];
                        }
                        
                        $get_issue_data=select("food_inventory_remove",[
                            "conditions"=>[
                                "item"=>$data['item']
                                ]
                            ]);
                        $total_issue=0;
                        foreach($get_issue_data as $datai){
                            $total_issue += $datai['qty'];
                        }
                        
                        $temp_estock=($total_add - $total_issue);
                        $estock=$temp_estock." ".$get_unit[0]['unit_name'];
                        // $nestedData[]=$estock;
                        
                        if($total_issue !=0){
                            $percent=100-((100/$total_add)*$total_issue);
                        }else{
                            $percent=100;
                        }
                        
                        $nestedData[]="₹".$temp_estock *$data['food_inventory_items']['avarage_price'];
                        // <span class="progress-number"><b>'.$total_issue." ".$get_unit[0]['unit_name'].' </b>/'.$total_add.' '.$get_unit[0]['unit_name'].' </span>
                        
                        $nestedData[]='<div class="progress-group">
                            <span class="progress-text">'.$estock.'</span>
            
                            <div class="progress sm" style="background: #80808030;">
                              <div class="progress-bar progress-bar-aqua" style="width: '.$percent.'%"></div>
                            </div>
                          </div>';
                        
                        $totalData[]=$nestedData;
                        
                        
                    }
                    
                    
                    $responce=[];
                    $responce["draw"]=$_REQUEST['draw'];
                    $responce["recordsTotal"]=count($unique_arr_for_total);
                    $responce["recordsFiltered"]=count($unique_arr_for_total);
                    $responce["data"]=$totalData;
                    
                    
                    // pr($totalData);
                    
                    
                    
                    

                    echo json_encode($responce);
  ?>