<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::DLayout();
$get_all_food_inventory_items = select("food_inventory_items", [
  "conditions" => [
    "status" => 1
  ],
  'join' => array(
    'units' => 'unit',
  ),
]);
$totalData = [];


if (isset($_POST["sdate"]) && isset($_POST["edate"])) {
  $sdate = $_POST["sdate"];
  $edate = $_POST["edate"];
}


// pr($get_all_food_inventory_items);
?>


<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">Select Date</div>
      <div class="panel-body">
        <form action="" method="post">
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




        <form action="" method="post">
          <input type="hidden" name="sdate" value="<?php echo date("Y-m-d"); ?>">
          <input type="hidden" name="edate" value="<?php echo date("Y-m-d"); ?>">
          <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Today's </button>
        </form>

        <form action="" method="post">
          <input type="hidden" name="sdate" value="<?php echo date('Y-m-d', strtotime("-1 days")); ?>">
          <input type="hidden" name="edate" value="<?php echo date('Y-m-d', strtotime("-1 days")); ?>">
          <button type="submit" class="btn btn-primary btn-md" style="margin-left: 15px;float: right;margin-top: 21px;">Yesterday's </button>
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








  <?php if (isset($_POST["sdate"]) && isset($_POST["edate"])) { ?>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Stock Report</div>
        <div class="panel-body">
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th style="width: 80px !important;">Item Name</th>
                <th class="text-danger" style="width: 150px !important;">
                  <h5>Opening Stock QTY </h5>
                  <small>(On <?php

                              echo $newDate = date("F j, Y", strtotime($sdate));
                              ?>)</small>
                </th>


                <th style="color:#d86500">Total Purchased QTY</th>
                <th style="color:#d86500">Total Issue QTY</th>
                <th style="color:#d86500;width: 150px !important;">
                  <h5>Closing Stock QTY</h5>
                  <small>(On <?php

                              echo $newDate = date("F j, Y", strtotime($edate));
                              ?>)</small>
                </th>

                <th class="text-success">Avarage Buying Price / Unit (₹)</th>

                <th>Purchased Amount (₹)</th>
                <th>Issue Amount (₹)</th>
                <th>Closing Stock Amount (₹)</th>
                <th style="width: 30px !important;">Transactions</th>

              </tr>
            </thead>
            <tbody>
              <?php

              $total_purchase_amount_for_closing_stock=0;
              $total_issue_amount_for_closing_stock=0;

              $totla_purchase_amount = 0;
              $totla_issue_amount = 0;
              $totla_stock_amount = 0;
              foreach ($get_all_food_inventory_items as $key => $data) { ?>
                <tr id="table_<?php echo $key; ?>">
                  <td><?php echo $data["name"] . " <span style='font-weight: bold;'> ( " . $data["units"]['unit_name'] . ")<span>"; ?></td>


                  <td class="text-danger" title="Measuring Unit  : <?php echo $data["units"]['unit_name']; ?>">
                    <!-- Opening Stock -->
                    <?php
                    $item = $data["id"];
                    $sql_open_qty_add = "SELECT SUM(qty) as tqtyopenadd FROM food_inventory_add  WHERE item = '$item' AND created < '$sdate' GROUP BY item";
                    $retvalqty_open_add = mysqli_query($conn, $sql_open_qty_add);
                    $row_sumqty_open_add = mysqli_fetch_assoc($retvalqty_open_add);
                    $total_open_add = $row_sumqty_open_add['tqtyopenadd'];

                    $sql_open_qty_remove = "SELECT SUM(qty) as tqtyopenremove FROM food_inventory_remove  WHERE item = '$item' AND created < '$sdate' GROUP BY item";
                    $retvalqty_open_remove = mysqli_query($conn, $sql_open_qty_remove);
                    $row_sumqty_open_remove = mysqli_fetch_assoc($retvalqty_open_remove);
                    $total_open_remove = $row_sumqty_open_remove['tqtyopenremove'];

                    echo $opening_stock = $total_open_add - $total_open_remove;


                    ?>

                    <!-- Opening Stock -->
                  </td>




                  <td title="Measuring Unit  : <?php echo $data["units"]['unit_name']; ?>" style="color:#d86500">
                    <?php
                    $item = $data["id"];
                    $sql_qty = "SELECT SUM(qty) as tqty FROM food_inventory_add  WHERE item = '$item' AND created between '$sdate'
                    AND '$edate' GROUP BY item";
                    $retvalqty = mysqli_query($conn, $sql_qty);
                    $row_sumqty = mysqli_fetch_assoc($retvalqty);
                    $purchesed_total_qty = $row_sumqty['tqty'];
                    echo $row_sumqty['tqty'] ? $row_sumqty['tqty']  : "0.00 ";
                    ?>
                  </td>
                  <td title="Measuring Unit  : <?php echo $data["units"]['unit_name']; ?>" style="color:#d86500">
                    <?php
                    $item = $data["id"];
                    $sql_iqty = "SELECT SUM(qty) as iqty FROM food_inventory_remove  WHERE item = '$item' AND created between '$sdate'
                    AND '$edate' GROUP BY item";
                    $retvaliqty = mysqli_query($conn, $sql_iqty);
                    $row_sumiqty = mysqli_fetch_assoc($retvaliqty);
                    $total_issue_qty = $row_sumiqty['iqty'];
                    echo $row_sumiqty['iqty'] ? $row_sumiqty['iqty'] : "0.00 ";
                    ?>
                  </td>

                  <td style="color:#d86500" title="Measuring Unit  : <?php echo $data["units"]['unit_name']; ?>">
                    <?php
                    $balance_qty = $opening_stock + $purchesed_total_qty - $total_issue_qty;
                    echo number_format($balance_qty, 2); ?>
                  </td>


                  <td class="text-success">
                    <?php echo $data["avarage_price"]; ?>
                  </td>



                  <td>
                    <?php
                    $item = $data["id"];
                    $sql_totla_purchased = "SELECT SUM(amount) as sum FROM food_inventory_add  WHERE item = '$item' AND created between '$sdate'
                    AND '$edate' GROUP BY item";
                    $retval = mysqli_query($conn, $sql_totla_purchased);
                    $row_sum = mysqli_fetch_assoc($retval);
                    $total_pur_amount = $row_sum['sum'];

                    $totla_purchase_amount += $row_sum['sum'];
                    echo $row_sum['sum'] ? $row_sum['sum'] : "0.00";

                    ?>
                  </td>



                  <td>
                    <?php
                    $total_issue_amount = $total_issue_qty * $data["avarage_price"];
                    $totla_issue_amount += $total_issue_amount;
                    echo number_format($total_issue_amount, 2); ?>
                  </td>


                  <td>
                    <?php
                    // $totla_stock_amount+=$total_pur_amount - $total_issue_amount;
                    // echo number_format($total_pur_amount - $total_issue_amount, 2); 
                    echo number_format($temp_c_stock_amount=$balance_qty * $data["avarage_price"], 2);
                    $total_issue_amount_for_closing_stock +=$temp_c_stock_amount;
                    ?>
                  </td>
                  <td>

                    <button onclick='catagoryDataView(<?php echo $data["id"]; ?>)' data-toggle="modal" data-target="#myModalItem" class="btn btn-primary">View</button>

                  </td>

                </tr>
                <?php
                if (!$row_sumqty['tqty']  && !$row_sumiqty['iqty']) { ?>
                  <script>
                    $('#table_<?php echo $key; ?>').remove();
                  </script>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>



    <!-- Modal -->
    <div id="myModalItem" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"> Items Transction </h4>
          </div>
          <div class="modal-body" id="frame">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>

      </div>
    </div>


    <script>
      function catagoryDataView(id) {

        let data = `<iframe src="transction.php?sdate=<?php echo $sdate; ?>&enddate=<?php echo $edate; ?>&item=${id}" frameborder="0" style="overflow:hidden;height:500px;" height="100%" width="100%"></iframe>`;
        $("#frame").html(data);
      }
    </script>


    <div class="col-md-3 col-sm-6 col-xs-12">

      <div class="info-box">
        <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Purchased Amount</span>
          <span class="info-box-number">₹<?php echo number_format($totla_purchase_amount, 2); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">

      <div class="info-box">
        <span class="info-box-icon bg-red"><span class="glyphicon glyphicon-time"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Issue Amount</span>
          <span class="info-box-number">₹<?php echo number_format($totla_issue_amount, 2); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->


    <div class="col-md-4 col-sm-6 col-xs-12">

      <div class="info-box">
        <span class="info-box-icon bg-success"><span class="glyphicon glyphicon-time"></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Available Stock Amount On <?php echo $edate;?></span>
          <span class="info-box-number">₹<?php echo number_format($total_issue_amount_for_closing_stock, 2); ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->

    </div><!-- /.col -->

    <!-- fix for small devices only -->

    <!-- <div class="col-md-3 col-sm-6 col-xs-12">
     
        <div class="info-box">
          <span class="info-box-icon bg-green">₹</span>
          <div class="info-box-content">
            <span class="info-box-text">Balance Amount</span>
            <span class="info-box-number" id="tatal_sales">₹<?php echo number_format($totla_stock_amount, 2); ?></span>
          </div>
        </div>
      
    </div> -->



  










  <?php } ?>


















  </html>

  <script>
    $(document).ready(function() {




      $('#example').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [{
            responsivePriority: 1,
            targets: 0
          },
          {
            responsivePriority: 2,
            targets: -1
          }
        ]
      });

      $('.buttons-excel').html('<span class="glyphicon glyphicon-copy" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5></span>  ');

      $('.buttons-pdf').html('<span class="glyphicon glyphicon-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5></span> ');

      $('.buttons-csv').html('<span class="glyphicon glyphicon-save-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5></span> ');

      $('.buttons-copy').html('<span class="glyphicon glyphicon-duplicate" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5></span> ');

      $('.buttons-print').html('<span class="glyphicon glyphicon-print" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5></span> ');




    });
  </script>



  <?php
  include('../../src/layout/foot.php');

  include('../../src/layout/foot_site_content.php');

  ?>