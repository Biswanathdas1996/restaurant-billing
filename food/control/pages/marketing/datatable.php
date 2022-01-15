  <?php             
                    include("../../src/config/includes.php"); 
                    include("../../src/config/connection.php"); 
                    echo Layout::APILayout(); 

                    $limit = $_REQUEST['length'];
                    $offset = $_REQUEST['start'];
       
    
                   
                   
               
                if(isset($_REQUEST["search"]['value']) && $_REQUEST["search"]['value'] !=null){
                    
                    $search=$_REQUEST["search"]['value'];
                    
                     
                    
                    
                    $get_items=select('food_customers',[
                                  'conditions'=>array(
                                        "item" => $search
                                    ),
                            "limit"=>$limit,
                            "offset"=>$offset,
                          ]);
                    
                    
                }else{
                    $get_items=select('food_customers',[
                                  'conditions'=>array(
                                        "status"=>1,
                                    ),
                                  "order"=>array(
                                        "id"=>'desc'
                            ), 
                            "limit"=>$limit,
                            "offset"=>$offset,
                          ]);
                    
                }     
                    
                          
                          
                          
                   
                    
                    $totalData=[];
                    foreach($get_items as $data){
                        
                     
                        $nestedData=[]; 
                        $nestedData[]=$data["name"]; 
                        $nestedData[]=$data["contact"]; 
                        $nestedData[]=$data["email"]; 
                        
                       
                        
                        $nestedData[]=$data["created"]; 
                        
                        
                        $totalData[]=$nestedData;
                        
                        
                    }
                    
                    
                    $responce=[];
                    $responce["draw"]=$_REQUEST['draw'];
                    $responce["recordsTotal"]=count(select('food_customers'));
                    $responce["recordsFiltered"]=count(select('food_customers'));
                    $responce["data"]=$totalData;
                    
                    
                    // pr($totalData);
                    
                    
                    
                    

                    echo json_encode($responce);
  ?>