  <?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 

        $totalData=[];
 
        if(isset($_GET['startDate']) && isset($_GET['endDate'])){
            $sdate=$_GET['startDate'];
            $edate=$_GET['endDate'];
                $sql = "SELECT * FROM food_inventory_add 
                            WHERE created between '$sdate'
                        AND '$edate'"; 
        }else{
            $sql = "SELECT * FROM food_inventory_add "; 
        }

        $retval=mysqli_query($conn, $sql);  
       
        if(mysqli_num_rows($retval) > 0){  
         while($row = mysqli_fetch_assoc($retval)){  
             
              $nestedData=[];
              $nestedData[]=$row['item'];
              $nestedData[]="unit";
              $nestedData[]=$row['qty'];
              $nestedData[]=$row['created'];

            $totalData[]=$nestedData;
         }  
        }else{  
        echo "0 results";  
        }  
        mysqli_close($conn); 
        
        $responce=[];
        $responce["draw"]=1;
        $responce["recordsTotal"]=count($totalData);
        $responce["recordsFiltered"]=count($totalData);
        $responce["data"]=$totalData;
        echo json_encode($responce);
  ?>