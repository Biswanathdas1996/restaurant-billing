  <?php             
                    include("../../src/config/includes.php"); 
                    echo Layout::APILayout(); 

                    $stock=select('food_customers');
                    
        echo count($stock);
  ?>