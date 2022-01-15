<?php include("../../src/config/includes.php"); 
echo Layout::bodyLayout(); ?>

<div class="preloader" id="preloader" style="display:none;"></div>
 <div class="container-fluid" >
    <div class="panel panel-default">
     <div class="panel-heading">Completed Order</div>
        <div class="panel-body">
           <div class="row">
               <div class="col-md-12"> 
                <table id="example" class="table table-striped" >
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Rating</th>
                            <th>Table No</th>
                            <!--<th>Items</th>-->
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Time</th>
                            <th>Invoice</th>
                        </tr>
                    </thead>
                </table>
              </div>  
            </div> 
        </div>
    </div>
</div>


<script>
var link ="../ajax_api/ajax_done_data_order.php"
    var table = $('#example').DataTable( {
        ajax: link,
        deferRender: true,
        //bPaginate: false,
        columns: [
            { "data": "order_id" },
            { "data": "rating" },
            { "data": "table_no" },
            { "data": "amount" },
            { "data": "payment" },
            { "data": "time" },
            { "data": "invoice" },
        ],
        rowId: 'extn',
        select: true,
        dom: 'Bfrtip',
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
        
    table
        .order( [ 0, 'desc' ] )
        .draw();

      $(document).on('keyup','#search',function(){
        $('#example').DataTable().search( this.value ).draw();
      });

    $(document).on('click ', '.modalltext', function() {
      var id =$(this).attr('value');
    //   alert(id);
      ajax_ordered_item(id);
    //   $('#preloader').show();
      
    });
  

</script>
<?php include('../../src/layout/foot.php'); ?>