  <?php             
        include("../../src/config/includes.php"); 
        include("../../src/config/connection.php");
        echo Layout::APILayout(); 

        $get_item_id=select('food_inventory_add', [
          "conditions" => [
            "id"=>$_GET["id"]
          ]
        ]);

        $delete_data=delete('food_inventory_add',array(
            "id"=>$_GET["id"]
        ));

        
            // pr($get_item_id);
        $get_previous_items = select('food_inventory_add', [
          "conditions" => [
              "item" => $get_item_id[0]["item"]
          ]
        ]);
        // pr($get_previous_items);
        $total_prev_price = 0;
        $total_prev_qty = 0;
        foreach ($get_previous_items as $data) {
            $total_prev_price += $data['amount'];
            $total_prev_qty += $data['qty'];
        }
        $avg_price = ($total_prev_price ) / ($total_prev_qty );

        $id = $get_item_id[0]["item"];
        $data_update = array(
            "data" => array(
                "avarage_price" => $avg_price,
            )
        );
        $update_data = update('food_inventory_items', $data_update, $id);
     

      echo $delete_data;

     
  ?>