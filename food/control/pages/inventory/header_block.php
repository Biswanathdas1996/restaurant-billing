<!-- Info boxes -->
<?php
$get_stock_items1 = select("food_inventory_add");
$temp1 = array_unique(array_column($get_stock_items1, 'item'));
$unique_arr1 = array_intersect_key($get_stock_items1, $temp1);

?>



<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">
      <span class="info-box-icon bg-aqua">₹</span>
      <div class="info-box-content">
        <span class="info-box-text">Total Stock Amount</span>
        <span class="info-box-number" id="total_stock">..</span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->

  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">

    <div class="info-box">
      <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-cutlery"></span></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Items </span>
        <span class="info-box-number"><?php echo count($unique_arr1); ?></span>
      </div><!-- /.info-box-content -->
    </div><!-- /.info-box -->

  </div><!-- /.col -->
  <div class="clearfix visible-sm-block"></div>





</div><!-- /.row -->


<script>
  $.ajax('api_total_sotck_amount.php?data="get_total_inventory_amount"', // request url
    {
      success: function(data, status, xhr) { // success callback function
        var responce = JSON.parse(data);

        $("#total_stock").html("₹" + responce.stock_amount.toFixed(2));
      }
    });
</script>