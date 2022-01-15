<?php include("../../src/config/includes.php");
  echo Layout::DLayout();
  $get_customers = select("food_customers");
   include('header_block.php');

  $get_all_customer=select('food_customers',[
    "conditions"=>[
      "status"=>1
    ],
    "join"=>[
      "food_order"=>"order_id"
    ]
  ]);

      // pr( $get_all_customer);
  ?>

  <div class="row">




    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Customer Info.</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table id="example" class="display table table-striped" style="width:100%">
              <thead>
                <tr>
                  <th>Name </th>
                  <th>Contact No</th>
                  <th>Email</th>

                  <th>Created</th>
                  <th>View Bill</th>
                </tr>
              </thead>
              <tbody>
              <?php 
              foreach($get_all_customer as $val){?>
              <tr>
              <td>
                <?= $val["name"];?>
              </td>
              <td>
                <?= $val["contact"];?>
              </td>
              <td>
                <?= $val["email"];?>
              </td>
              <td>
                <?= $val["created"];?>
              </td>
              <td> 

              <button data-toggle="modal" data-target="#myModalBILL" type='Button' onclick="Billframe(<?php echo $val['food_order']['id'];?>)" class='btn btn-success'><i class='glyphicon glyphicon-save-file'></i></button>
              
              
               
              </td>
              
              
              </tr>


              <?php }
              
              ?>
              
              
              
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer clearfix">
        </div>
      </div>
    </div>










  </div>


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

    $(document).ready(function() {

      $("#sel1").chosen();



    



      $('#example').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        order: [
          [3, 'desc']
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
    


      // $('#example').DataTable({
      //   "processing": true,
      //   "serverSide": true,
      //   "ajax": "datatable.php"
      // });



      $("#pushForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
          type: "POST",
          url: "send_push_notification.php",
          data: form.serialize(), // serializes the form's elements.
          success: function(data) {
            var responce = JSON.parse(data);
            if (responce.success == 1) {
              swal("Send!", "Notification successfully send", "success");
            }
          }
        });
      });

      $("#form2").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        $.ajax({
          type: "POST",
          url: "send_push_notification.php",
          data: form.serialize(), // serializes the form's elements.
          success: function(data) {

            swal("Send!", "Notification successfully send", "success");

          }
        });
      });





    });
  </script>


  <?php include('../../src/layout/foot.php'); ?>

<!-- 
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> -->