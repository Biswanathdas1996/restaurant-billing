<?php include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::DLayout();

?>

<head>



  <style>
    table.dataTable thead th,
    table.dataTable thead td {
      padding: 10px 18px;
      border-bottom: 1px solid #fffcfc !important;
      background-color: #edeaea !important;
    }

    tbody td {
      padding: 0px 10px !important;
      vertical-align: inherit !important;
    }

    table.dataTable.no-footer {
      border-bottom: 1px solid #fffcfc;
    }
  </style>

</head>

<div class="row">
  <?php include("nav_menu.php") ?>
</div>


<?php
include('header_block.php');
?>




<?php

$get_all_item = select(
  "food_inventory_items",
  [
    "conditions" => [
      "status" => 1
    ],
    'join' => array(
      'units' => 'unit',
    )

  ]

);

// pr($get_all_item);
?>



<div class="row">




  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Current Stocks</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="display" id="stock_table" style="width:100%">
            <thead>
              <tr>
                <th>Item </th>
                <th>Avg. Price</th>

                <th>Current Stock</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($get_all_item as $val) { ?>
                <tr>
                  <td><?php echo $val['name'] ?></td>
                  <td>₹<?php echo number_format($val['avarage_price'],2) ?></td>
                  <td>
                    <?php
                    $item = $val['id'];
                    $sql_iqtytotalItemPrice = "SELECT SUM(qty) as totalItemqty FROM food_inventory_add  WHERE item = '$item' ";
                    $retvaliqtytotalItemPrice = mysqli_query($conn, $sql_iqtytotalItemPrice);
                    $total_purchase_QTY_row = mysqli_fetch_assoc($retvaliqtytotalItemPrice);
                    $total_purchase_QTY = $total_purchase_QTY_row['totalItemqty'];


                    $sql_total_issue = "SELECT SUM(qty) as totalItemqtyissue FROM food_inventory_remove  WHERE item = '$item' ";
                    $retvatotalissue = mysqli_query($conn, $sql_total_issue);
                    $total_issue_QTY_row = mysqli_fetch_assoc($retvatotalissue);
                    $total_issue_QTY = $total_issue_QTY_row['totalItemqtyissue'];

                    $balance = ($total_purchase_QTY - $total_issue_QTY);
                    if ($total_issue_QTY != 0) {
                      $percent = 100 - ((100 / $total_purchase_QTY) * $total_issue_QTY);
                    } else {
                      if ($balance == 0) {
                        $percent = 0;
                      } else {
                        $percent = 100;
                      }
                    }
                    ?>
                    <div class="progress-group">
                      <span class="progress-text"><?= $balance ?> <?= $val['units']['unit_name']?></span>

                      <div class="progress sm" style="background: #80808030;">
                        <div class="progress-bar progress-bar-aqua" style="width: <?= $percent ?>%"></div>
                      </div>
                    </div>
                  </td>

                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="box-footer clearfix">
      </div>
    </div>
  </div>


</div>







<script>

    $(document).ready(function() {  
      



      $('#stock_table').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ]
        });
        
        $('.buttons-excel').html('<span class="glyphicon glyphicon-copy" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5></span>  ');
        
        $('.buttons-pdf').html('<span class="glyphicon glyphicon-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5></span> ');
        
        $('.buttons-csv').html('<span class="glyphicon glyphicon-save-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5></span> ');
        
        $('.buttons-copy').html('<span class="glyphicon glyphicon-duplicate" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5></span> ');
        
        $('.buttons-print').html('<span class="glyphicon glyphicon-print" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5></span> ');
    


      
    });
  

  $.ajax('api_inventory_out.php', {
    success: function(data, status, xhr) {
      var responce = JSON.parse(data);
      console.log(responce);
    }
  });
</script>


<?php include('../../src/layout/foot.php'); ?>