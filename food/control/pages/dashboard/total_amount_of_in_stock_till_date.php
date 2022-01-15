  <?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 


        $get_all_data=select('food_inventory_add');
        $total=0;
        foreach($get_all_data as $data){
            $total+=$data["amount"];
        }

        echo $total;
  ?>