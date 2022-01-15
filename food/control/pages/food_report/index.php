<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::DLayout();
$get_all_category = select("food_category");
$get_all_food_item = select("food_demo");



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








  <?php if (isset($_POST["sdate"]) && isset($_POST["edate"])) {

    $sdate = $_POST["sdate"];
    $edate = $_POST["edate"];
  ?>



    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Category Report</div>
        <div class="panel-body">
          <table id="example" class="display" style="width:100%">
            <thead>
              <tr>
                <th>Name</th>
                <th>No of Sales</th>
                <th>Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>


              <?php
              foreach ($get_all_category as $cat) {
              ?>
                <tr >
                  <td>
                    <?= $cat['name']; ?></td>
                  <td><?php
                      $item_category = $cat["id"];
                      $sql_iqty = "SELECT SUM(qnt) as iqty FROM food_order_item  WHERE item_category_id = '$item_category' AND date between '$sdate' AND '$edate'";
                      $retvaliqty = mysqli_query($conn, $sql_iqty);
                      $row_sumiqty = mysqli_fetch_assoc($retvaliqty);
                      echo $row_sumiqty['iqty'];
                      ?></td>
                  <td><?php
                  
                      $item = $row['item_id'];
                      $sql_iqtytotalItemPrice = "SELECT SUM(totalItemPrice*qnt) as totalItemPrice FROM food_order_item  WHERE item_category_id = '$item_category' AND date between '$sdate' AND '$edate'";
                      $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                      $row_sumiqtytotalItemPrice = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                      echo $row_sumiqtytotalItemPrice['totalItemPrice'] ? "₹".$row_sumiqtytotalItemPrice['totalItemPrice'] : "₹0.00";

                      ?></td>
                  <td>
                    <!-- <a href="../categoty_sales/index.php?sdate=<?php echo $sdate; ?>&enddate=<?php echo $edate; ?>&category=<?php echo $cat["id"]; ?>" target="_blank"> -->
                    <button onclick='catagoryDataView(<?php echo $cat["id"]; ?>)' data-toggle="modal" data-target="#myModalItem" class="btn btn-primary">View Items</button>
                    <!-- <button 
                     
                      class="btn btn-primary">View Items</button> -->
                    <!-- </a> -->
                  </td>
                </tr>
              <?php  } ?>
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
            <h4 class="modal-title">Food Items</h4>
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

        let data = `<iframe src="../categoty_sales/index.php?sdate=<?php echo $sdate; ?>&enddate=<?php echo $edate; ?>&category=${id}" frameborder="0" style="overflow:hidden;height:500px;" height="100%" width="100%"></iframe>`;
        $("#frame").html(data);
      }
    </script>


    <!-- ////////************************************* */ -->




    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Item Sales Report</div>
        <div class="panel-body">
          <table id="example2" class="display" style="width:100%">
            <thead>
              <tr>

                <th>Title</th>
                <th>Available On</th>
                <th>Total Order</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // pr($get_all_food_item);
              foreach ($get_all_food_item as $key => $data) { ?>
                <tr id="table_<?php echo $key; ?>">
                  <td><?= $data['title'] ?></td>
                  <td><?= $data['menu_type'] ==1 ? "<p class='text-warning'>OFFLINE</p>" :"<p class='text-aqua'>ONLINE</p>" ?></td>
                  <td><?php
                      $item_id = $data["id"];
                      $sql_iqtys = "SELECT SUM(qnt) as iqtys FROM food_order_item  WHERE item_id = '$item_id' AND date between '$sdate' AND '$edate'";
                      $retvaliqtys = mysqli_query($conn, $sql_iqtys);
                      $row_sumiqtys = mysqli_fetch_assoc($retvaliqtys);
                      echo $row_sumiqtys['iqtys'];
                  
                  ?></td>
                </tr>
              <?php
            if(!$row_sumiqtys['iqtys']){
              ?>
              <script>$("#table_<?php echo $key; ?>").remove();</script>
              <?php
            }
            
            
            } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <?php } ?>

  </html>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        order: [
          [1, 'desc']
        ]
      });
      $('#example2').DataTable({
        order: [
          [2, 'desc']
        ]
      });
    });
  </script>



  <?php
  include('../../src/layout/foot.php');

  include('../../src/layout/foot_site_content.php');

  ?>