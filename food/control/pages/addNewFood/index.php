<?php include("../../src/config/includes.php");
echo Layout::DLayout();
$get_payment_methods = select("payment_methods");
?>





<div class="row">
  <div class="col-md-12">




    <div class="panel panel-default">
      <div class="panel-heading">
        <div style="padding: 10px;">
          <span>Food</span>
          <a href="add.php">
            <button type="button" style="float: right;margin-top: -12px;margin-right: -16px;" class="btn btn-primary btn-lg">Add New Food</button>
          </a>
        </div>




      </div>
      <div class="panel-body">

        <div class="table-responsive">
          <table id="stockIn" class="table table-hover dataTable no-footer dtr-inline" style="width: 98%; border: 1px solid rgb(232, 231, 231); margin-bottom: 5px;">
            <thead>
              <tr>

                <th>Img </th>
                <th>Name </th>
                <th>Category</th>
                <th>Price</th>
                <th>Menu Type</th>
                <!-- <th>Status</th> -->
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div><!-- /.table-responsive -->

      </div>
    </div>

  </div>


</div><!-- /.row -->







<script>
  $(document).ready(function() {




    stockIn();
    calculateTotal();

    function calculateTotal(startDate = null, endDate = null) {
      let url = null;
      if (startDate != null && endDate != null) {
        url = "total_order_amount.php?startDate=" + startDate + "&endDate=" + endDate;
      } else {
        url = "total_order_amount.php";
      }
      $.ajax(url, {
        success: function(data, status, xhr) { // success callback function
          var responce = JSON.parse(data);
          $("#total_stock").html("₹" + responce.total_sales.toFixed(2));
          $("#coreder").html(responce.total_order);
        }
      });
    }


    function stockIn(startDate = null, endDate = null, filter = null) {
      let url = null;
      if (startDate != null && endDate != null) {
        url = "datatable.php?startDate=" + startDate + "&endDate=" + endDate;
      } else {
        url = "datatable.php";
      }
      $('#stockIn').DataTable({
        "processing": false,
        "serverSide": true,
        "searching": true,
        "ajax": url,
        "responsive": true,
        "dom": 'Bfrtip',
        "buttons": [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ]
      });
      $('.buttons-excel').html('<span class="glyphicon glyphicon-copy" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5></span>  ');
      $('.buttons-pdf').html('<span class="glyphicon glyphicon-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5></span> ');
      $('.buttons-csv').html('<span class="glyphicon glyphicon-save-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5></span> ');
      $('.buttons-copy').html('<span class="glyphicon glyphicon-duplicate" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5></span> ');
      $('.buttons-print').html('<span class="glyphicon glyphicon-print" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5></span> ');
    }








    $(function() {
      $('input[name="daterange"]').daterangepicker({
        opens: 'left'
      }, function(start, end, label) {

        let startDate = start.format('YYYY-MM-DD');
        let endDate = end.format('YYYY-MM-DD');

        $('#stockIn').DataTable().clear().destroy();
        stockIn(startDate, endDate);
        calculateTotal(startDate, endDate, null);

      });
    });
  });





  $('#payment_method').on('change', function() {
    //   alert( this.value );

    let urls = null;
    urls = "total_order_amount.php?filter=" + this.value;

    $.ajax(urls, {
      success: function(data, status, xhr) { // success callback function
        var responce = JSON.parse(data);
        $("#total_stock").html("₹" + responce.total_sales.toFixed(2));
        $("#coreder").html(responce.total_order);
      }
    });


    $('#stockIn').DataTable().clear().destroy();
    let url = null;
    url = "datatable.php?filter=" + this.value;

    $('#stockIn').DataTable({
      "processing": false,
      "serverSide": true,
      "searching": false,
      "ajax": url,
      "responsive": true,
      "dom": 'Bfrtip',
      "buttons": [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ]
    });
    $('.buttons-excel').html('<span class="glyphicon glyphicon-copy" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Excel</h5></span>  ');
    $('.buttons-pdf').html('<span class="glyphicon glyphicon-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Pdf</h5></span> ');
    $('.buttons-csv').html('<span class="glyphicon glyphicon-save-file" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">CSV</h5></span> ');
    $('.buttons-copy').html('<span class="glyphicon glyphicon-duplicate" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Copy</h5></span> ');
    $('.buttons-print').html('<span class="glyphicon glyphicon-print" style="color: black;font-size: 20px;color: #337ab7;"><h5 style="margin: 2px 0px;font-size: 10px;color: black;">Print</h5></span> ');

  });
</script>


<?php include('../../src/layout/foot.php');

include('../../src/layout/foot_site_content.php');
?>