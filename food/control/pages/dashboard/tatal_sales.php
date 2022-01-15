
  <?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 


        $completed_order=select('food_order',[
        "conditions"=>[
            "done"=>1
            ]
        ]);
  
        $total_sales=0;
        foreach($completed_order as $data){
            $total_sales+=($data['total']);
        }

        echo $total_sales;
  ?>



