<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::DLayout();
$get_payment_methods = select("payment_methods");

$get_memu_type = select("food_menu_type");

if (isset($_POST["sdate"])) {
  $date = $_POST["sdate"];

  $sdate = $_POST["sdate"] . "<br>";
  $edate = $_POST["edate"];


  $sql = "SELECT * FROM food_order 
                            WHERE done = 1 AND date between '$sdate'
                        AND '$edate' ORDER BY `food_order`.`date` DESC ";


  $retval = mysqli_query($conn, $sql);
  $get_order = [];
  if (mysqli_num_rows($retval) > 0) {
    while ($row = mysqli_fetch_assoc($retval)) {
      $temp_array = [];

      $temp_array['id'] = $row['id'];
      $temp_array['user_id'] = $row['user_id'];
      $temp_array['process_session'] = $row['process_session'];
      $temp_array['bypass_session'] = $row['bypass_session'];
      $temp_array['table_no'] = $row['table_no'];
      $temp_array['cooking_instruction'] = $row['cooking_instruction'];
      $temp_array['sub_total'] = $row['sub_total'];
      $temp_array['add_ons_charges'] = $row['add_ons_charges'];
      $temp_array['total_charges'] = $row['total_charges'];
      $temp_array['indivisual_discount'] = $row['indivisual_discount'];
      $temp_array['packing_charges'] = $row['packing_charges'];
      $temp_array['total'] = $row['total'];
      $temp_array['date'] = $row['date'];
      $temp_array['time'] = $row['time'];
      $temp_array['done'] = $row['done'];
      $temp_array['payment_status'] = $row['payment_status'];
      $temp_array['payment_method'] = $row['payment_method'];
      $temp_array['txn_id'] = $row['txn_id'];
      $temp_array['rating'] = $row['rating'];
      $temp_array['process'] = $row['process'];
      $temp_array['order_data'] = $row['order_data'];
      $temp_array['token'] = $row['token'];
      $temp_array['order_type'] = $row['order_type'];

      $get_charges = select("food_order_charges", [
        "conditions" => [
          "order_id" => $row['id']
        ]
      ]);

      $get_payment_method = select("payment_methods", [
        "conditions" => [
          "id" => $row['payment_method']
        ]
      ]);

      $temp_array['payment_methods'] = $get_payment_method;

      $temp_array['food_order_charges'] = $get_charges;
      $get_order[] = $temp_array;
    }
  }


  $total_item_sold_amount = 0;
  $total_tax = 0;
  $total_indivisual_discount = 0;
  $total_sales = 0;
  $total_packing_charges = 0;
  $total_no_of_order = count($get_order);



  foreach ($get_order as $data) {
    $total_sales += $data['total'];
    $total_tax += $data['total_charges'];
    $total_indivisual_discount += $data['indivisual_discount'];
    $total_packing_charges += $data['packing_charges'];
  }
}

//*****************************Inventory */
$sql_inventory = "SELECT * FROM food_inventory_add 
WHERE created between '$sdate'
AND '$edate' ORDER BY `food_inventory_add`.`id` DESC ";
$retval_inv = mysqli_query($conn, $sql_inventory);
$totla_inv_add = 0;
if (mysqli_num_rows($retval_inv) > 0) {
  while ($row_inv = mysqli_fetch_assoc($retval_inv)) {

    $totla_inv_add += $row_inv['amount'];
  }
}


$sql_inventory_issue = "SELECT * FROM food_inventory_remove 
WHERE created between '$sdate'
AND '$edate' ORDER BY `food_inventory_remove`.`id` DESC ";
$retval_inv_issue = mysqli_query($conn, $sql_inventory_issue);
$totla_inv_issue = 0;
if (mysqli_num_rows($retval_inv_issue) > 0) {
  while ($row_inv_issue = mysqli_fetch_assoc($retval_inv_issue)) {
    $get_avg_price = select("food_inventory_items", [
      "conditions" => [
        "id" => $row_inv_issue['item']
      ]
    ]);

    $totla_inv_issue += $row_inv_issue['qty'] * $get_avg_price[0]["avarage_price"];
  }
}




$sql_miscellaneous_expance = "SELECT SUM(amount) as totalMiscellaneous_expance FROM miscellaneous_expance  WHERE  created between '$sdate'
                    AND '$edate'";
$retvaliqtytotalItemPrice = mysqli_query($conn, $sql_miscellaneous_expance);
$row_miscellaneous_expance = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
$total_miscellaneous_expance = $row_miscellaneous_expance['totalMiscellaneous_expance'];





?>

<style>
  @page {
    size: 1000pt 1200pt;
    margin: 0;
  }
</style>

</head>




<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Select Date</div>
      <div class="panel-body">
        <form action="" method="post" class="">
          <div class="col-md-12">

            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Start Date:</label>
                <input type="date" class="form-control" max="<?php echo date("Y-m-d"); ?>" name="sdate" value="<?php echo $_POST["sdate"]; ?>" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">End Date:</label>
                <input type="date" class="form-control" max="<?php echo date("Y-m-d"); ?>" name="edate" value="<?php echo $_POST["edate"]; ?>" required>
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg" style="margin-left: 15px;">Submit</button>


        </form>

        <div class="col-md-12">


          <form action="" method="post">
            <input type="hidden" name="sdate" value="<?php echo date("Y-m-d"); ?>">
            <input type="hidden" name="edate" value="<?php echo date("Y-m-d"); ?>">
            <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Today's sales</button>
          </form>

          <form action="" method="post">
            <input type="hidden" name="sdate" value="<?php echo date('Y-m-d', strtotime("-1 days")); ?>">
            <input type="hidden" name="edate" value="<?php echo date('Y-m-d', strtotime("-1 days")); ?>">
            <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Yesterday's sales</button>
          </form>

          <form action="" method="post">
            <input type="hidden" name="sdate" value="<?php echo date('Y-m-d', strtotime("-6 days")); ?>">
            <input type="hidden" name="edate" value="<?php echo date('Y-m-d'); ?>">
            <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Last 7 Days</button>
          </form>

          <form action="" method="post">
            <input type="hidden" name="sdate" value="<?php echo date('Y-m-d', strtotime("-30 days")); ?>">
            <input type="hidden" name="edate" value="<?php echo date('Y-m-d'); ?>">
            <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Last 30 Days</button>
          </form>


        </div>

      </div>
    </div>
  </div>
</div>




<?php if (isset($_POST["sdate"]) && isset($_POST["edate"])) { ?>

  <div class="col-md-12">
    <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Completed Order</span>
            <span class="info-box-number" id="coreder"><?php echo $total_no_of_order; ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><span>₹</span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Sales</span>
            <span class="info-box-number" id="total_stock"><?= "Rs." . number_format($total_sales, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div>


      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
          <span class="info-box-icon bg-red"><span class="glyphicon glyphicon-compressed"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Tax/ Charges</span>
            <span class="info-box-number" id="current_stock_amount"><?= "Rs." . number_format($total_tax, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div><!-- /.col -->


      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
          <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-cutlery"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Discount Given</span>
            <span class="info-box-number"><?php echo "Rs." . number_format($total_indivisual_discount, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div>


      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
          <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-credit-card"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Packing Charges</span>
            <span class="info-box-number" id="total_stock_amount"><?php echo "Rs." . number_format($total_packing_charges, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div>

      



      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
          <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-credit-card"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Purchase Amount</span>
            <span class="info-box-number" id="total_stock_amount"><?php echo "Rs." . number_format($totla_inv_add, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div>



      <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
          <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Item Issue Amount</span>
            <span class="info-box-number" id="total_stock_amount"><?php echo "Rs." . number_format($totla_inv_issue, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div>



      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-green"><span>₹</span></span>
          <div class="info-box-content">
            <span class="info-box-text">Total Miscellaneous Expense </span>
            <span class="info-box-number" id="total_stock"><?= "Rs." . number_format($total_miscellaneous_expance, 2); ?></span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div>



      <div class="clearfix visible-sm-block"></div>
    </div><!-- /.row -->
  </div>


  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Order Details</div>
      <div class="panel-body" >

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Data View</a></li>
          <li><a data-toggle="tab" href="#menu1">Graphical View</a></li>
        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active" >

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Bill No#</th>
                  <th>Date</th>
                  <th>Item Total</th>
                  <th>Add-Ons</th>
                  <th> Tax / Charges</th>
                  <th>Discounts</th>
                  <th>Packing Charges</th>
                  <th>Total</th>
                  <th>Bill</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $item_grand_total = 0;
                $total_charges_grand_total = 0;
                $indivisual_discount_grand_total = 0;
                $packing_charges_grand_total = 0;
                $total_grand_total = 0;
                $total_add_ons = 0;
               
                foreach ($get_order as $data) { ?>
                  <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['date'] ?></td>
                    <td><?= $data['sub_total'] ?></td>
                    <td><?= $data['add_ons_charges'] ?></td>
                    <td><?= $data['total_charges'] ?></td>
                    <td><?= $data['indivisual_discount'] ?></td>
                    <td><?= $data['packing_charges'] ?></td>
                    <td><?= $data['total'] ?></td>
                    <td>
                    
                    <button data-toggle="modal" data-target="#myModalBILL" 
                  type='Button' onclick="Billframe(<?php echo $data['id'] ;?>)"
                   class='btn btn-success'><i class='glyphicon glyphicon-save-file'></i></button>
                    
                    </td>
                  </tr>
                <?php
                  $item_grand_total += $data['sub_total'];
                  $total_charges_grand_total += $data['total_charges'];
                  $indivisual_discount_grand_total += $data['indivisual_discount'];
                  $packing_charges_grand_total += $data['packing_charges'];
                  $total_grand_total += $data['total'];
                  $total_add_ons += $data['add_ons_charges'];
                } ?>
                <tr>
                  <td><span style="font-weight: bold; font-size: 20px;">Grand Total: <span></td>
                  <td>-</td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($item_grand_total, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($total_add_ons, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($total_charges_grand_total, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($indivisual_discount_grand_total, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($packing_charges_grand_total, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;"><?= number_format($total_grand_total, 2) ?></td>
                  <td style="font-weight: bold; font-size: 20px;">
                
                  -
              
                  
                  </td>
                </tr>

              </tbody>
            </table>

<!-- Modal -->
<div id="myModalBILL" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bill</h4>
      </div>
      <div class="modal-body" id="billFrame">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function Billframe(id){
    
    let data=`<iframe src="../../../invoice/download.php?id=${id}" frameborder="0" style="overflow:hidden;height:500px" height="100%" width="100%"></iframe>`;
    $("#billFrame").html(data);
}
</script>


          </div>
          <div id="menu1" class="tab-pane fade">
            <center>
              <?php include('date_sales_bar_chart.php'); ?>
            </center>

          </div>
        </div>




      </div>
    </div>
  </div>




  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Order Types</div>
      <div class="panel-body">


        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#Type_data">Data View</a></li>
          <li><a data-toggle="tab" href="#menu1_graph">Graphical View</a></li>
        </ul>

        <div class="tab-content">
          <div id="Type_data" class="tab-pane fade in active">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Order Type</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $chart_data = [];
                foreach ($get_memu_type as $type) {
                  $temp_chart = [];
                ?>
                  <tr>
                    <td><?= $type['name'] ?></td>
                    <td><?php

                        $totat_amount_value = 0;
                        foreach ($get_order as $c) {
                          if ($c['order_type'] == $type['id']) {
                            $totat_amount_value += $c["total"];
                          }
                        }
                        echo number_format($totat_amount_value, 2);
                        ?></td>
                  </tr>
                <?php
                  $temp_chart["lebel"] = $type['name'];
                  $temp_chart["value"] = $totat_amount_value;

                  $chart_data[] = $temp_chart;
                } ?>
              </tbody>
            </table>
          </div>
          <div id="menu1_graph" class="tab-pane fade">

            <?php include('online_ofline_chart.php'); ?>

          </div>
        </div>



      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-default">
      <div class="panel-heading">Payment Method Types</div>
      <div class="panel-body">


        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home_payment_method">Data View</a></li>
          <li><a data-toggle="tab" href="#menu1payment_method">Graphical View</a></li>
        </ul>

        <div class="tab-content">
          <div id="home_payment_method" class="tab-pane fade in active">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Payment Method</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $graphData_payment_method = [];
                foreach ($get_payment_methods as $types) {
                  $temp_payment_method = [];
                ?>
                  <tr>
                    <td><?= $types['name'] ?></td>
                    <td><?php
                        $totat_method_amount_value = 0;
                        foreach ($get_order as $cp) {
                          if ($cp['payment_method'] == $types['id']) {
                            $totat_method_amount_value += $cp["total"];
                          }
                        }
                        echo number_format($totat_method_amount_value, 2);
                        ?></td>
                  </tr>
                <?php
                  $temp_payment_method["payment_method"] = $types['name'];
                  $temp_payment_method['total'] = (float) $totat_method_amount_value;
                  $graphData_payment_method[] = $temp_payment_method;
                } ?>
              </tbody>
            </table>


          </div>
          <div id="menu1payment_method" class="tab-pane fade">

            <?php include('payment_method_pie.php'); ?>

          </div>
        </div>



      </div>
    </div>
  </div>


  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Stock Details</div>
      <div class="panel-body">


        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#homeStock">Data View</a></li>
          <li><a data-toggle="tab" href="#menu1Stock">Graphical View</a></li>
        </ul>

        <div class="tab-content">
          <div id="homeStock" class="tab-pane fade in active">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Total Added Stock Amount</th>
                  <th>Total Issue Item Amount</th>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td><?= number_format($totla_inv_add, 2) ?></td>
                  <td><?= number_format($totla_inv_issue, 2) ?></td>

                </tr>

              </tbody>
            </table>

          </div>
          <div id="menu1Stock" class="tab-pane fade">
            <?php
            $temp_chartStock = [];
            $temp_chartStock["lebel"] = "Total Added Stock Amount";
            $temp_chartStock["value"] = $totla_inv_add;
            $chart_dataStock[] = $temp_chartStock;
            $temp_chartStock = [];
            $temp_chartStock["lebel"] = "Total Issue Item Amount";
            $temp_chartStock["value"] = $totla_inv_issue;
            $chart_dataStock[] = $temp_chartStock;

            ?>

            <?php include('stockin_stockout_pie_chart.php'); ?>

          </div>
        </div>




      </div>
    </div>
  </div>



  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Print</div>
      <div class="panel-body">

        <button type="button" onclick="window.print()" class="btn btn-success btn-lg">Print</button>

      </div>
    </div>
  </div>


<?php } ?>

</html>




<?php include('../../src/layout/foot.php');

include('../../src/layout/foot_site_content.php');
?>