<?php include("../../src/config/includes.php");
echo Layout::DLayout();

?>



<div class="row">


  <?php include("../inventory/nav_menu.php") ?>


  <div class="col-md-12">
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
      <div class="box-header with-border">

        <div class="row">
          <div class="col-md-2">
            <h3 class="box-title">Issue Items From Stock</h3>
          </div>

          <div class="col-md-2">
            <div class="input-group" style="width: 250px;float: none;">
              <input type="text" name="daterange" value="" class="form-control" placeholder="Search">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-calendar"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="col-md-6">

            <button type="button" class="btn btn-info btn-lg" style="float: right;border-radius: 0px; " id="todays_stock">
              <span class="glyphicon glyphicon-equalizer"></span> Today's Issue stock </button>


            <button type="button" class="btn btn-info btn-lg" style="float: right;border-radius: 0px;margin-right:10px" id="view_all">
              <span class="glyphicon glyphicon-equalizer"></span> View All </button>

          </div>

          <div class="col-md-2">
            <a href="../issue_stock">
              <button type="button" class="btn btn-primary btn-lg" style="float: right;border-radius: 0px;"><span class="glyphicon glyphicon-plus"></span> Issue a Item</button>
            </a>
          </div>
        </div>









      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table id="stockIn" class="table table-hover dataTable no-footer dtr-inline" style="width: 98%; border: 1px solid rgb(232, 231, 231); margin-bottom: 5px;">
            <thead>
              <tr>
                <th>Item </th>
                <th>Stock</th>
                <th>Remark</th>

                <th>Created</th>
                <th>Actions</th>

              </tr>
            </thead>
          </table>
        </div><!-- /.table-responsive -->
      </div><!-- /.box-body -->
      <div class="box-footer clearfix">

      </div><!-- /.box-footer -->
    </div><!-- /.box -->
  </div><!-- /.col -->

</div><!-- /.row -->






<script>
  $(document).ready(function() {


    $(document).on('click', '.delete', function() {
      var id = $(this).attr('data');


      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {

            $.ajax('delete.php?id=' + id, // request url
              {
                success: function(data, status, xhr) { // success callback function

                  swal("Deleted!", "Item deleted successfully!", "success");
                  $('#stockIn').DataTable().clear().destroy();
                  stockIn();

                }
              });

          } else {

          }
        });






    });


    stockIn();

    function stockIn(startDate = null, endDate = null) {
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

      });
    });

    $(document).on('click', '#todays_stock', function() {
      let startDate = "<?php echo date("Y-m-d"); ?>";
      let endDate = "<?php echo date("Y-m-d"); ?>";
      $('#stockIn').DataTable().clear().destroy();
      stockIn(startDate, endDate);
    });


    $(document).on('click', '#view_all', function() {

      $('#stockIn').DataTable().clear().destroy();
      stockIn();
    });

  });
</script>


<?php include('../../src/layout/foot.php'); ?>

