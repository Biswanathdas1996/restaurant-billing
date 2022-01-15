<!-- Info boxes -->
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../completedOrder">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Completed Order</span>
          <span class="info-box-number"><?php echo count($completed_order); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div><!-- /.col -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../newOrder">
      <div class="info-box">
        <span class="info-box-icon bg-red"><span class="glyphicon glyphicon-time"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Pending Order</span>
          <span class="info-box-number"><?php echo count($pending_order); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div><!-- /.col -->

  <!-- fix for small devices only -->
  <div class="clearfix visible-sm-block"></div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../completedOrder">
      <div class="info-box">
        <span class="info-box-icon bg-green">₹</span>
        <div class="info-box-content">
          <span class="info-box-text">Total Sales</span>
          <span class="info-box-number" id="tatal_sales">...</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div><!-- /.col -->


  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../stocks">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-credit-card"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Purchase</span>
          <span class="info-box-number" id="total_stock_amount">...</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div>


  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../stocks">
      <div class="info-box">
      <span class="info-box-icon bg-green">₹</span>
        <div class="info-box-content">
          <span class="info-box-text">Total Miscellaneous Expanse</span>
          <span class="info-box-number">


            <?php

            $sql_miscellaneous_expance = "SELECT SUM(amount) as totalMiscellaneous_expance FROM miscellaneous_expance ";
            $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_miscellaneous_expance);
            $row_miscellaneous_expance = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
            echo  $row_miscellaneous_expance['totalMiscellaneous_expance'];
            ?>


          </span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div>


 


  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../addNewFood">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-cutlery"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Active Menu Item <small>(s)</small></span>
          <span class="info-box-number"><?php echo count($total_active_food_item); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="../completedOrder">
      <div class="info-box">
        <span class="info-box-icon bg-red"><span class="glyphicon glyphicon-compressed"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Current Stock Amount</span>
          <span class="info-box-number" id="current_stock_amount">...</span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </a>
  </div><!-- /.col -->

</div><!-- /.row -->


<script>
  $.ajax('total_amount_of_in_stock_till_date.php', // request url
    {
      success: function(data, status, xhr) { // success callback function
        var responce = JSON.parse(data);

        $("#total_stock_amount").html("₹" + responce.toFixed(2));
      }
    });


  $.ajax('tatal_sales.php', // request url
    {
      success: function(data, status, xhr) { // success callback function
        var responce = JSON.parse(data);

        $("#tatal_sales").html("₹" + responce.toFixed(2));
      }
    });




  $.ajax('../inventory/api_total_sotck_amount.php?data="get_total_inventory_amount', // request url
    {
      success: function(data, status, xhr) { // success callback function
        var responce = JSON.parse(data);

        $("#current_stock_amount").html("₹" + responce.stock_amount.toFixed(2));
      }
    });
</script>