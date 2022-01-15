<?php include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::bodyLayout();

$get_items = select("food_inventory_items", [
  'conditions' => array(
    "status" => 1,
  ),
  'join' => array(
    'units' => 'unit',
  )
]);




if (isset($_POST["item"])) {


  if ($_POST["qty"] <= $_POST["current_stock"]) {

    $itemId = $_POST["item"];
    $qty = $_POST["qty"];
    $remark = $_POST["remark"];
    $date = $_POST["date"];


    $check_if_added = select("food_inventory_add", [
      "conditions" => [
        "item" => $itemId
      ]
    ]);

    if (count($check_if_added) > 0) {
      $data = array(
        "data" => array(
          "item" => $itemId,
          "qty" => $qty,
          "remark" => $remark,
          "created" => $date,
        )
      );
      $insert_data = insert('food_inventory_remove', $data);

      pr("Item Issues successfully!");
?>

      <script>
        //swal("Success!", "Item Issues successfully!", "success");
      </script>

    <?php
    } else {
      // pr("Please Add the stock - before Issueing");
    ?>

      <script>
        swal("Sorry!", "Please Add the stock - before Issueing!", "error");
      </script>

    <?php
    }
  } else {
    // pr("Please Add the more stock - before Issueing");
    ?>

    <script>
      swal("Sorry!", "Please Add the more stock - before Issueing!", "error");
    </script>

  <?php
  }






  ?>


<?php

}


?>
<!--Write your code here-->

<div class="container-fluid">
  <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading">Issue a stock item</div>

        <div class="panel-body">
          <form action="" method="post">
            <div class="form-group">
              <label for="sel1">Select Item:</label>
              <select class="form-control" id="sel1" name="item" required>
                <option class="itemval" unit="..." value="">Select Item</option>
                <?php foreach ($get_items as $items) {

                  $item = $items["id"];
                  $sql_iqtytotalItemPrice = "SELECT SUM(qty) as totalItemqty FROM food_inventory_add  WHERE item = '$item' ";
                  $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                  $total_purchase_QTY_row = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                  $total_purchase_QTY = $total_purchase_QTY_row['totalItemqty'];


                  $sql_total_issue = "SELECT SUM(qty) as totalItemqtyissue FROM food_inventory_remove  WHERE item = '$item' ";
                  $retvatotalissue = mysqli_query($conn, $sql_total_issue);
                  $total_issue_QTY_row = mysqli_fetch_assoc($retvatotalissue);
                  $total_issue_QTY = $total_issue_QTY_row['totalItemqtyissue'];

                  $balance = ($total_purchase_QTY - $total_issue_QTY);

                ?>
                  <option class="itemval" balance="<?= $balance ?>" unit="<?php echo $items['units']['unit_name'] ?>" value="<?php echo $items["id"] ?>"><?php echo $items["name"] ?> </option>
                <?php } ?>
              </select>
            </div>

            <br>
            <label for="Quantity">Current Stock</label>
            <div class="from-group">

              <input type="text" class="form-control current_stock" disabled>
              <input type="hidden" class="form-control current_stock1" name="current_stock">

            </div>
            <br>






            <label for="Quantity">Quantity</label>
            <div class="input-group">

              <input type="number" class="form-control" placeholder="Quantity" name="qty" step=".01" required>
              <div class="input-group-btn">
                <button class="btn btn-default" type="button" style="width: 150px;" id="unit">...</button>
              </div>
            </div>

            <br>

            <label for="Price">Issue Date</label>
            <div class="form-group">
              <input type="date" class="form-control" placeholder="Price" name="date" value="<?php echo date("Y-m-d"); ?>">
            </div>

            <br>
            <label for="Remark">Remark</label>
            <div class="from-group">

              <input type="text" class="form-control" placeholder="Remark" name="remark">

            </div>
            <br>
            <a href="../issue">
              <button type="button" class="btn btn-primary btn-lg">Back</button>
            </a>
            <button type="submit" class="btn btn-success btn-lg">Issue Stock</button>
          </form>

        </div>
      </div>


    </div>
    <div class="col-md-1"></div>
  </div>
</div>



<script>
  $("#sel1").chosen();


  $(document).on('change', '#sel1', function() {
    var option = $('option:selected', this).attr('unit');
    var balance = $('option:selected', this).attr('balance') + " " + option;
    $("#unit").html(option);
    $(".current_stock").val(balance);
    $(".current_stock1").val($('option:selected', this).attr('balance'));

  });
</script>





<?php include('../../src/layout/foot.php'); ?>