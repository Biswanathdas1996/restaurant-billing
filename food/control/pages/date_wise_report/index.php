<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::DLayout();


function getDatesFromRange($start, $end, $format = 'Y-m-d')
{
  $array = array();
  $interval = new DateInterval('P1D');

  $realEnd = new DateTime($end);
  $realEnd->add($interval);

  $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

  foreach ($period as $date) {
    $array[] = $date->format($format);
  }

  return $array;
}




if (isset($_POST["sdate"])) {




  $date_array = getDatesFromRange($_POST["sdate"], $_POST["edate"]);
}


?>

<style>
  @page {
    size: 1000pt 1200pt;
    margin: 0;
  }
</style>

</head>




<div class="container-fluid">
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


  <div class="row">

    <?php

    if (isset($_POST["sdate"])) {


      foreach ($date_array as $key => $value) { ?>

        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading"><?php echo $value; ?></div>
            <div class="panel-body">



              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Total Order</th>
                    <th>Item Total</th>
                    <th>Total Tax/ Charges</th>
                    <th>Total Packing Charges</th>
                    <th>Total Discount Given</th>
                    <th>Total Sales</th>
                    <!-- <th>Error</th> -->
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>ON-LINE</td>
                    <td>
                      <?php
                      $sql_inventory_issue = "SELECT * FROM food_order 
                      WHERE date = '$value' AND order_type = 2";
                      $retval_inv_issue = mysqli_query($conn, $sql_inventory_issue);
                      echo mysqli_num_rows($retval_inv_issue);
                      ?>
                    </td>
                    <td>
                      <?php
                      $sub_total = "SELECT SUM(sub_total+add_ons_charges) as sub_total FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $sub_total_d = mysqli_query($conn, $sub_total);
                      $sub_total_d = mysqli_fetch_assoc($sub_total_d);
                      echo $sub_total_d['sub_total'] ? "₹" . number_format($sub_total_d['sub_total'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $total_charges = "SELECT SUM(total_charges) as total_charges FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $total_charges_d = mysqli_query($conn, $total_charges);
                      $total_charges_d = mysqli_fetch_assoc($total_charges_d);
                      echo $total_charges_d['total_charges'] ? "₹" . number_format($total_charges_d['total_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $packing_charges = "SELECT SUM(packing_charges) as packing_charges FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $packing_charges_d = mysqli_query($conn, $packing_charges);
                      $packing_charges_d = mysqli_fetch_assoc($packing_charges_d);
                      echo $packing_charges_d['packing_charges'] ? "₹" . number_format($packing_charges_d['packing_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $indivisual_discount = "SELECT SUM(indivisual_discount) as indivisual_discount FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $indivisual_discount_d = mysqli_query($conn, $indivisual_discount);
                      $indivisual_discount_d = mysqli_fetch_assoc($indivisual_discount_d);
                      echo $indivisual_discount_d['indivisual_discount'] ? "₹" . number_format($indivisual_discount_d['indivisual_discount'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $sql_iqtytotalItemPrice = "SELECT SUM(total) as totalsales FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                      $row_sumiqtytotalItemPrice = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                      echo $row_sumiqtytotalItemPrice['totalsales'] ? "₹" . number_format($row_sumiqtytotalItemPrice['totalsales'], 2) : "₹0.00";

                      ?>
                    </td>
                    
                  </tr>


                  <tr>
                    <td>OFF-LINE</td>
                    <td>
                      <?php
                      $sql_inventory_issue = "SELECT * FROM food_order 
                      WHERE date = '$value' AND order_type = 1";
                      $retval_inv_issue = mysqli_query($conn, $sql_inventory_issue);
                      echo mysqli_num_rows($retval_inv_issue);
                      ?>
                    </td>
                    <td>
                      <?php
                      $sub_total = "SELECT SUM(sub_total+add_ons_charges) as sub_total FROM food_order  WHERE  date = '$value' AND order_type = 1";
                      $sub_total_d = mysqli_query($conn, $sub_total);
                      $sub_total_d = mysqli_fetch_assoc($sub_total_d);
                      echo $sub_total_d['sub_total'] ? "₹" . number_format($sub_total_d['sub_total'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $total_charges = "SELECT SUM(total_charges) as total_charges FROM food_order  WHERE  date = '$value' AND order_type =1";
                      $total_charges_d = mysqli_query($conn, $total_charges);
                      $total_charges_d = mysqli_fetch_assoc($total_charges_d);
                      echo $total_charges_d['total_charges'] ? "₹" . number_format($total_charges_d['total_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $packing_charges = "SELECT SUM(packing_charges) as packing_charges FROM food_order  WHERE  date = '$value' AND order_type =1";
                      $packing_charges_d = mysqli_query($conn, $packing_charges);
                      $packing_charges_d = mysqli_fetch_assoc($packing_charges_d);
                      echo $packing_charges_d['packing_charges'] ? "₹" . number_format($packing_charges_d['packing_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $indivisual_discount = "SELECT SUM(indivisual_discount) as indivisual_discount FROM food_order  WHERE  date = '$value' AND order_type =1";
                      $indivisual_discount_d = mysqli_query($conn, $indivisual_discount);
                      $indivisual_discount_d = mysqli_fetch_assoc($indivisual_discount_d);
                      echo $indivisual_discount_d['indivisual_discount'] ? "₹" . number_format($indivisual_discount_d['indivisual_discount'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php
                      $sql_iqtytotalItemPrice = "SELECT SUM(total) as totalsales FROM food_order  WHERE  date = '$value' AND order_type =1";
                      $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                      $row_sumiqtytotalItemPrice = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                      echo $row_sumiqtytotalItemPrice['totalsales'] ? "₹" . number_format($row_sumiqtytotalItemPrice['totalsales'], 2) : "₹0.00";

                      ?>
                    </td>
                    
                  </tr>



                  <tr>
                    <td style="font-weight: bold">TOTAL</td>
                    <td style="font-weight: bold">
                      <?php
                      $sql_inventory_issue = "SELECT * FROM food_order 
                      WHERE date = '$value'";
                      $retval_inv_issue = mysqli_query($conn, $sql_inventory_issue);
                      echo mysqli_num_rows($retval_inv_issue);
                      ?>
                    </td>
                    <td style="font-weight: bold">
                      <?php
                      $sub_total = "SELECT SUM(sub_total+add_ons_charges) as sub_total FROM food_order  WHERE  date = '$value' ";
                      $sub_total_d = mysqli_query($conn, $sub_total);
                      $sub_total_d = mysqli_fetch_assoc($sub_total_d);
                      echo $sub_total_d['sub_total'] ? "₹" . number_format($sub_total_d['sub_total'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td style="font-weight: bold">
                      <?php
                      $total_charges = "SELECT SUM(total_charges) as total_charges FROM food_order  WHERE  date = '$value' ";
                      $total_charges_d = mysqli_query($conn, $total_charges);
                      $total_charges_d = mysqli_fetch_assoc($total_charges_d);
                      echo $total_charges_d['total_charges'] ? "₹" . number_format($total_charges_d['total_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td style="font-weight: bold">
                      <?php
                      $packing_charges = "SELECT SUM(packing_charges) as packing_charges FROM food_order  WHERE  date = '$value' ";
                      $packing_charges_d = mysqli_query($conn, $packing_charges);
                      $packing_charges_d = mysqli_fetch_assoc($packing_charges_d);
                      echo $packing_charges_d['packing_charges'] ? "₹" . number_format($packing_charges_d['packing_charges'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td style="font-weight: bold">
                      <?php
                      $indivisual_discount = "SELECT SUM(indivisual_discount) as indivisual_discount FROM food_order  WHERE  date = '$value' ";
                      $indivisual_discount_d = mysqli_query($conn, $indivisual_discount);
                      $indivisual_discount_d = mysqli_fetch_assoc($indivisual_discount_d);
                      echo $indivisual_discount_d['indivisual_discount'] ? "₹" . number_format($indivisual_discount_d['indivisual_discount'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td style="font-weight: bold">
                      <?php
                      $sql_iqtytotalItemPrice = "SELECT SUM(total) as totalsales FROM food_order  WHERE  date = '$value' ";
                      $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                      $row_sumiqtytotalItemPrice = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                      echo $row_sumiqtytotalItemPrice['totalsales'] ? "₹" . number_format($row_sumiqtytotalItemPrice['totalsales'], 2) : "₹0.00";

                      ?>
                    </td>
                    
                  </tr>
                </tbody>
              </table>


              <?php $get_payment_methods = select("payment_methods");
              // pr($get_payment_methods);
              ?>

              <table class="table table-bordered">

                <tbody>
                  <?php
                  $total_check = 0;
                  foreach ($get_payment_methods as $payment) { ?>
                    <tr>

                      <td>
                        <?php
                        echo $payment['name'];
                        $pay_id = $payment['id'];
                        ?>
                      </td>
                      <td>
                        <?php

                        $payment_method = "SELECT SUM(total) as payment_method FROM food_order  WHERE  date = '$value' AND payment_method = '$pay_id'";
                        $payment_method_d = mysqli_query($conn, $payment_method);
                        $payment_method_d = mysqli_fetch_assoc($payment_method_d);
                        echo $payment_method_d['payment_method'] ? "₹" . number_format($payment_method_d['payment_method'], 2) : "₹0.00";
                        $total_check += $payment_method_d['payment_method'];
                        ?>
                      </td>


                    </tr>

                  <?php } ?>
                  <tr>
                    <td><b>Total</b> </td>
                    <td><b><?php echo number_format($total_check, 2); ?><b> </td>
                  </tr>
                </tbody>
              </table>



              <!-- <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Online</th>
                    <th>Offline</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <?php

                      $order_type = "SELECT SUM(total) as order_type FROM food_order  WHERE  date = '$value' AND order_type = 2";
                      $order_type_d = mysqli_query($conn, $order_type);
                      $order_type_d = mysqli_fetch_assoc($order_type_d);
                      echo $order_type_d['order_type'] ? "₹" . number_format($order_type_d['order_type'], 2) : "₹0.00";

                      ?>
                    </td>
                    <td>
                      <?php

                      $order_typeo = "SELECT SUM(total) as order_type FROM food_order  WHERE  date = '$value' AND order_type = 1";
                      $order_type_do = mysqli_query($conn, $order_typeo);
                      $order_type_do = mysqli_fetch_assoc($order_type_do);
                      echo $order_type_do['order_type'] ? "₹" . number_format($order_type_do['order_type'], 2) : "₹0.00";

                      ?>
                    </td>


                  </tr>

                </tbody>
              </table> -->



              <!-- <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Total Purchase Amount</th>
                    <th>Lastname</th>

                  </tr>
                </thead>
                <tbody>
                  <tr>
                    
                    <td>
                      <?php

                      // $sql_totla_purchased = "SELECT SUM(amount) as sumdata FROM food_inventory_add  WHERE created = '$value'";
                      // $retval_p = mysqli_query($conn, $sql_totla_purchased);
                      // $row_sum_p = mysqli_fetch_assoc($retval_p);
                      // echo $row_sum_p['sumdata'];
                      ?>
                    </td>
                  
                    <td>
                    <?php

                    // $sql_totla_purchased = "SELECT SUM(amount) as sumdata FROM food_inventory_remove  WHERE created = '$value'";
                    // $retval_p = mysqli_query($conn, $sql_totla_purchased);
                    // $row_sum_p = mysqli_fetch_assoc($retval_p);
                    // echo $row_sum_p['sumdata'];
                    ?>
                    </td>

                  </tr>

                </tbody>
              </table> -->


            </div>
          </div>
        </div>



    <?php

      }
    }
    ?>

  </div>
</div>


</html>




<?php include('../../src/layout/foot.php');

include('../../src/layout/foot_site_content.php');
?>