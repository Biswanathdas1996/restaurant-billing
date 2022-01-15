<?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 


 
        if(isset($_GET['startDate']) && $_GET['startDate'] != null && isset($_GET['endDate']) && $_GET['endDate'] !=null ){
          
            $sdate=$_GET['startDate'];
            $edate=$_GET['endDate'];
                $sql = "SELECT * FROM food_order 
                            WHERE done = 1 AND date between '$sdate'
                        AND '$edate' "; 
                        
        }
        else{
        
            $sql = "SELECT * FROM food_order WHERE done = 1 "; 
            
        }

        $retval=mysqli_query($conn, $sql);  
       
       $total=0;
        if(mysqli_num_rows($retval) > 0){  
        
         while($row = mysqli_fetch_assoc($retval)){  
             
            
               
                        
               
              $total+=($row['total']);
         
              
             

           
         }  
        }else{  
          
          
        }  
        mysqli_close($conn); 
        
        $responce=[];
        
        $responce["total_sales"]=$total;
        $responce["total_order"]=mysqli_num_rows($retval);
        
        echo json_encode($responce);
  ?>