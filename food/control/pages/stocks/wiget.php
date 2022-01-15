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
       
        $totalAmount=0;
        if(mysqli_num_rows($retval) > 0){  
         while($row = mysqli_fetch_assoc($retval)){  
             
            
             
            $totalAmount+=$row['amount'];
           
         }  
        }else{  
      
        }  
        mysqli_close($conn); 

        echo number_format($totalAmount,2);
  ?>