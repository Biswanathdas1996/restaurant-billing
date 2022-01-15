<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, getenv('HTTP_BASE_PATH').'food/control/pages/ajax_api/ajax_modal_data.php?id='.$_GET["id"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$result=json_decode($result,true);

// echo "<pre>";
// print_r($result);
// echo "</pre>";

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Single Order</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
 
<div class="container">
 
 <div class="panel panel-default">
  <div class="panel-heading">Order Details</div>
  <div class="panel-body">
      
    <table class="table table-bordered">
    
    <tbody>
      <tr>
        <td>Table No</td>
        <td><?php echo $result['table_no']; ?></td>
      </tr>
      <tr>
        <td>Order Id</td>
        <td><?php echo $result['Order_id']; ?></td>
      </tr>
      <tr>
        <td>Payment Status</td>
        <td><?php echo $result['txt']; ?></td>
      </tr>
      
    </tbody>
  </table>
    
    
    
      
      
      </div>
</div>
 
  <div class="panel panel-default">
    <div class="panel-heading">Order Items</div>
    <div class="panel-body">
        
        
          <div class="container-fluid">
                     <div class="row">
                         <div class="col-md-12">
                  
                  
                    <?php foreach($result['data'] as $results){?>         
                             
                   <div class="menu-content">
                            <div class="row" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="dish-img">
                                        <a href="#"><img src="../addNewFood/food_demo_img/<?php echo $results['img']?>" alt="hii" class="rounded-circle" style="height: 70px;width: 70px;"></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 title_wraper desc_t">
                                    <div class="dish-content">
                                        <h5 class="dish-title">
                                            <a class="title_text"  href="#"><?php echo $results['title']?></a>
                                            
                                        </h5>
                                        <span class="dish-meta">In <?php echo $results['type']?></span>
                                        <p style="font-size: 12px;" >Rs.<?php echo $results['price']?></p>
                                       
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding-right: 0px;padding-left: 5px;">
                                    <div class="">
                                       
                                      <p>Qty. <?php echo $results['order_item']['qnt'] ?></p>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php } ?>    
                        
                        
                    <div id="cooking_ins"></div>
                
           
            </div>    
            </div>    
            </div>  


<p>Cooking Instruction: <b><?php echo $result['cooking_instruction'] ? $result['cooking_instruction'] : "Not given";  ?></b></p>

        </div>
  </div>






<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">
            
  <table class="table table-bordered">
    
    <tbody>
      <tr>
        <td>Item Total</td>
        <td>₹<?php echo $result['item_total']; ?></td>
      </tr>
      <tr>
        <td>Other Charges</td>
        <td>₹<?php echo $result['charges_total']; ?></td>
      </tr>
      <tr>
        <td>Today's Total</td>
        <td>₹<?php echo $result['total']; ?></td>
      </tr>
      
    </tbody>
  </table>
</div>

</div>

</div>
</body>
</html>

<!--...................................................-->





