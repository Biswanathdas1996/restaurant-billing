<?php
  include("../../src/config/includes.php");
  include("../../src/config/connection.php");
  echo Layout::DLayout();

  include("datapicker.php");
  ?>

  <head>
    <meta charset="UTF-8">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

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


  <?php
  include('header_block.php'); ?>




  <div class="row">
    <div class="col-md-12">
      <?php include('sales_chart.php'); ?>
    </div>
    <div class="col-md-6">
      <?php include('graph_chat.php'); ?>
    </div>
    <div class="col-md-6">
      <?php include('income_expance_piechart.php'); ?>
    </div>




    <div class="col-md-6">

      <?php include('online_vs_ofline.php'); ?>

    </div>


    <div class="col-md-6">
      <?php include('payment_method_pie.php'); ?>
    </div>


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
            <table id="example" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>Item </th>
                  <th>Price</th>
                  <th>Stock Value</th>
                  <th>Current Stock</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>

      </div>
    </div>

    <div class="col-md-12">
      <?php include('food_sales_chart.php'); ?>
    </div>





  </div>




  </html>

  <script>
    $(document).ready(function() {
      $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 5,
        "ajax": "../inventory/datatable.php"
      });
    });
  </script>



  <?php include('../../src/layout/foot.php'); ?>