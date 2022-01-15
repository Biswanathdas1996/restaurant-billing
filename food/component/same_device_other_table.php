<?php 
$check_dev=select('food_order',[
            "conditions"=>[
                "process_session"=>base64_encode(get_client_ip()),
                "done"=>0
                
                ]
            ]);
  
            
           if( !empty($check_dev) && ($check[0]['bypass_session']==0) ){
               ?>
               <br>
                <a href='thank_you.php?order_id=<?php echo $check_dev[0]['id'];?>'>
                   <button class="btn btn-danger">Go to Order</button>
                </a>
                <br>
              <script>
                swal("Unauthorized Device !", "Please add item(s) from which You placed order/ call waiter ", "error", {
                      buttons: {
                      
                        catch: {
                          text: "Call Waiter",
                          value: "catch",
                        },
                        Order: "View Order",
                      },
                    })
                    .then((value) => {
                      switch (value) {
                     
                        case "Order":
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                          break;
                     
                        case "catch":
                          
                          window.open('tel:900300400');
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                          break;
                     
                        default:
                          window.location.replace("thank_you.php?order_id="+<?php echo $_GET["order_id"];?>);
                      }
                    });
             </script> 
            <?php
             die("Already an active order is there");   
           } 
           
 ?>