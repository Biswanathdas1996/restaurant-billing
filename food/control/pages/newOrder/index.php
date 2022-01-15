<?php include("../../src/config/includes.php"); echo Layout::bodyLayout();

$get_otder_type=select("food_menu_type");
?>

<style>
    .panel_classs{
    border: 0px;
    border-radius: 0px !important;
    margin: 2px 2px;
    }
    .td_icon{
    text-align: center;
    width: auto;
    height:50px;
    }
    .td_name{
        padding: 0px 20px;
    }
   
   
    .img_design {
    width: auto !important;
    height: 50px !important;
    }
    
     .img_design2 {
    width: auto !important;
    height: 60px !important;
    }
    
    
.modal.fade .modal-dialog {
    -webkit-transform: scale(0.1);
    -moz-transform: scale(0.1);
    -ms-transform: scale(0.1);
    transform: scale(0.1);
    top: 300px;
    opacity: 0;
    -webkit-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.modal.fade.in .modal-dialog {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    -webkit-transform: translate3d(0, -300px, 0);
    transform: translate3d(0, -300px, 0);
    opacity: 1;
}
.modal-header {
    padding: 2px 10px;
    border-bottom: 1px solid #e5e5e5;
}
.modal-header .close {
    margin-top: 2px;
}
.close_btn{
    border-radius: 0px;
    background: linear-gradient(to bottom, #fdaaa1, #e74c3c);
    color: white;
    border: none;
}
table.dataTable tbody tr {
    background-color: #d6dbdf;
}
table.dataTable tbody th, table.dataTable tbody td {
    padding: 0px 3px;
}
.dataTables_info{
    display:none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
    cursor: default;
    color: #f9f1f1 !important;
    border: none;
    background: #5d6d7e;
    box-shadow: none;
}
table.dataTable th.dt-center, table.dataTable td.dt-center, table.dataTable td.dataTables_empty {
    text-align: center;
    background-color: white;
    padding: 18px 10px;
    font-size: 17px;
    font-weight:bold;
}
table.dataTable.display tbody tr.odd > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 {
    background-color: #fffefe;
    text-align: center;
}
table.dataTable.row-border tbody tr:first-child th, table.dataTable.row-border tbody tr:first-child td, table.dataTable.display tbody tr:first-child th, table.dataTable.display tbody tr:first-child td {
    border-top: none;
    padding: 10px;
    background: white;
}
table.dataTable tbody tr {
    background-color: #fff;
}
table.dataTable.row-border tbody th, table.dataTable.row-border tbody td, table.dataTable.display tbody th, table.dataTable.display tbody td {
    border-top: 2px solid #ddd;
    padding: 10px;
    background: white;
    
}
table.dataTable.display tbody tr.even > .sorting_1, table.dataTable.order-column.stripe tbody tr.even > .sorting_1 {
    background-color: #fff;
}

.modalltext {
    cursor: pointer;
}
.modallo{
    cursor: pointer;
}

.img_design_shoplogo{
  width: auto !important;
  height: 30px !important;  
}
.preloader {
   position: fixed;
   top: 0;
   left: 0;
   width: 100%;
   height: 100%;
   z-index: 9999;
   background-image: url('user_Data/bip.gif');
   background-size: 100px 100px;
   background-repeat: no-repeat; 
   background-color: #00000070;
   background-position: center;
}


table.dataTable.display tbody tr.odd > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 {
    background-color: 
    #fffefe;
    text-align: inherit !important;
}

tbody td {
    padding: 11px 5px !important;
    vertical-align: inherit !important;
}

tbody td {
    padding: 10px 5px !important;
    vertical-align: inherit !important;
    text-align: center;
}
th {
    text-align: center;
}
table.dataTable.display tbody tr.odd > .sorting_1, table.dataTable.order-column.stripe tbody tr.odd > .sorting_1 {
    background-color: #fffefe;
    text-align: center !important;
}
table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid 
#c1bfbf2e;
background-color:
    #c1bfbf2e;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #1110;
}
table.dataTable.no-footer {
    border: 1px solid #c6c4c4;
}
.glyphicon {
    font-family: "Glyphicons Halflings";
    font-style: normal;
    font-weight: 402;
    line-height: 1.5;
    color:#C60 !important;
    word-spacing: -4px;
}

.swal-icon {
    width: 70px;
    height: 70px;
    border-width: 4px;
    border-style: solid;
    border-radius: 50%;
    padding: 0;
    position: relative;
    box-sizing: content-box;
    margin: 15px auto;
        margin-top: 20px;
}
.swal-icon--warning__body {
    width: 5px;
    height: 39px;
    top: 10px;
    border-radius: 2px;
    margin-left: -2px;
}
.swal-icon--success__line--tip {
    width: 24px;
    left: 3px;
    top: 44px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    -webkit-animation: animateSuccessTip .75s;
    animation: animateSuccessTip .75s;
}
.swal-icon--success__ring {
    width: 70px;
    height: 70px;
    border: 4px solid 
    hsla(98,55%,69%,.2);
    border-radius: 50%;
    box-sizing: content-box;
    position: absolute;
    left: -7px;
    top: 0px;
    z-index: 2;
}
</style>

<div class="preloader" id="preloader" style="display:none;"></div>


<div class="panel panel-default">


            <div class="panel-heading" style="padding: 20px 20px;">
                <b >New Order</b>
                <!--<a href="../add_new_order">-->
                       <button 
                       type="button" class="btn btn-primary btn-lg" 
                       style="float: right;margin: -14px;border-radius: 5px;"
                       data-toggle="modal" data-target="#myModalOrderType"
                       ><span class="glyphicon glyphicon-plus" style="color:white !important;"></span> Add New Order</button>
             
                <!--</a>-->
            </div>
 
    <div class="container-fluid" style="padding-bottom: 20px;margin: 10px;">
        <table id="example" class="display table table-striped" style="width:98%">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Table No</th>
                    <th>Order Type</th>
                    <th>Items</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    
    
    
</div>

 
 
 <!-- Modal -->
<div id="myModalOrderType" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Order Type</h4>
      </div>
      <div class="modal-body">
        <p>
            
            <center>
          <?php 
            foreach($get_otder_type as $type){
                
                ?>

           
                <a href="../add_new_order/initiate_new_order.php?type=<?php echo $type['id']?>">
                    <button type="button" class="btn btn-success btn-lg" style="width:70%;margin: 15px 0px;">
                    <!--    <div class="panel panel-default">-->
                            <!--<div class="panel-body" style="text-align: center;">-->
                              <span style="font-size: 16px;font-weight: bold;"><?php echo $type['name']?></span>
                        <!--    </div>-->
                        <!--</div>-->
                    </button>
                </a>
               
           <?php } 
          ?>
            </center>
            
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 
 
 
 
 
<script>


var link ="../ajax_api/ajax_data_order.php"
    var table = $('#example').DataTable( {
        
        ajax: link,
        deferRender: true,
        bPaginate: false,
        columns: [
            { "data": "order_id" },
            { "data": "table_no" },
            { "data": "customer" },
            { "data": "qty" },
            { "data": "amount" },
            { "data": "payment" },
            { "data": "time" },
            { "data": "action" }
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
      ajax_ordered_item(id);
      $("#show_loader_"+id).show().delay(4000).fadeOut(10);
      $(".s_hide_"+id).hide().delay(4000).fadeIn(10);
   
      
    });
  
 

    

    var temp=0;
    function ajax_check_data(){
                // $.ajax({
                //     url: "../ajax_api/ajax_check.php",
                //     type: "post",
                //     success: function(d) {
                //         var abc =JSON.parse(d);
                //         var total = abc.data.total;
                //         // if(temp!=total || typeof total == "undefined"){
                //         // $('#example').DataTable().ajax.reload();
                //         //   console.log('Reload table');
                //         //   temp=total;
                //         // }else{
                //         //      $('#example').DataTable().ajax.reload();
                //         // }
                        
                //         if(total==0){
                //              $("tbody").html(`<table style='width: 100% !important;'>
                //     <tr style='background-color: white;'>
                       
                //         <td class='td_name2' style='text-align: center; padding: 7px;'>No Order Placed</td>
                //     </tr>
                // </table> `)
                //         }
                        
                //     }
                // });
                
    }
var refreshId = setInterval("ajax_check_data()", 5000);
var refreshId = setInterval("$('#example').DataTable().ajax.reload();", 5000);
</script>
<?php include('../../src/layout/foot.php'); ?>