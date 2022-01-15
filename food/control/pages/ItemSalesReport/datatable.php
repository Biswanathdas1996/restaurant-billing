<?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 

       $limit = $_REQUEST['length'];
       $offset = $_REQUEST['start'];

        $totalData=[];
        if(isset($_GET['startDate']) && isset($_GET['endDate'])){
            $sdate=$_GET['startDate'];
            $edate=$_GET['endDate'];
                $sql = "SELECT * FROM food_order_item GROUP BY item_id
                            WHERE date between '$sdate'
                        AND '$edate' LIMIT $limit OFFSET $offset"; 
                        
            $sql_count = "SELECT * FROM food_order_item 
                            WHERE date between '$sdate'
                        AND '$edate' GROUP BY item_id"; 
                        
                        
             $retval_count=mysqli_query($conn, $sql_count);             
        }
        else{
            
            $sql = "SELECT * FROM food_order_item GROUP BY item_id LIMIT $limit OFFSET $offset "; 
            $sql_count ="SELECT * FROM food_order_item GROUP BY item_id "; 
            $retval_count=mysqli_query($conn, $sql_count);
            
        }

        $retval=mysqli_query($conn, $sql);  
       
        if(mysqli_num_rows($retval) > 0){  
         while($row = mysqli_fetch_assoc($retval)){  
             
              $nestedData=[];
               
               $get_item=select("food_demo",[
                        "conditions"=>[
                            "id"=>$row['item_id']
                            ]
                    ]);
                $nestedData[]="<img class='img-responsive' src='../addNewFood/food_demo_img/".$get_item[0]["img"]."' style='width: 50px;height: 50px;'> ";
                
                
                $nestedData[]=$get_item[0]["title"];
                
                $get_all_ordered_item=select("food_order_item",[
                        "conditions"=>[
                            "item_id"=>$row['item_id']
                            ]
                    ]);
                $qnt=0;
                foreach($get_all_ordered_item as $data){
                    $qnt+=$data["qnt"];
                }
                          
                $nestedData[]=$qnt;         
                     
               
            $totalData[]=$nestedData;
         }  
        }else{  
          
          
        }  
        mysqli_close($conn); 
        
     
        
        $responce=[];
        $responce["draw"]=$_REQUEST['draw'];
        $responce["recordsTotal"]=mysqli_num_rows($retval_count);
        $responce["recordsFiltered"]=mysqli_num_rows($retval_count);
        $responce["data"]=$totalData;
        echo json_encode($responce);
  ?>