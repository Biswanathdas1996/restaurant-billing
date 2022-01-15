<?php include("../../src/config/includes.php"); 
  echo Layout::DLayout();
    $get_payment_methods=select("payment_methods");
  ?>
 
          <div class="row">
            <div class="col-md-12">
              <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-aqua"><span class="glyphicon glyphicon-th"></span></span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Completed Order</span>
                      <span class="info-box-number" id="coreder"></span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
            </div><!-- /.col -->
            
            
            <div class="col-md-3 col-sm-6 col-xs-12">
               
                  <div class="info-box">
                    <span class="info-box-icon bg-green">₹</span>
                    <div class="info-box-content">
                      <span class="info-box-text">Total Sales</span>
                      <span class="info-box-number" id="total_stock">..</span>
                    </div><!-- /.info-box-content -->
                  </div><!-- /.info-box -->
           
            </div>
           <!--<div class="col-md-3 col-sm-6 col-xs-12">-->
              
           <!--       <div class="info-box">-->
           <!--         <span class="info-box-icon bg-yellow"><span class="glyphicon glyphicon-cutlery"></span></span>-->
           <!--         <div class="info-box-content">-->
           <!--           <span class="info-box-text">Total Items </span>-->
           <!--           <span class="info-box-number"><?php echo count($unique_arr1);?></span>-->
           <!--         </div>-->
           <!--       </div>-->
              
           <!-- </div>-->
            <div class="clearfix visible-sm-block"></div>

           
          
          </div><!-- /.row -->  
            </div> 
            
            
            
            
            <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-heading">Filter Options</div>
                      <div class="panel-body">
                          <div class="form-group">
                
                          <select class="form-control" id="payment_method">
                            <option >---Select Payment Method---</option>
                            <option value="all" >View All</option>
                            <?php 
                                foreach($get_payment_methods as $data){?>
                                
                                    <option value="<?= $data["id"];?>"><?= $data["name"];?></option>
                                    
                               <?php }
                            ?>
                          </select>
                        </div>
                        
                      </div>
                    </div>
                       
                         
            </div>    
                
                
            <div class="col-md-12">
              <!-- TABLE: LATEST ORDERS -->
              <div class="box box-info">
                <div class="box-header with-border">
                 <div class="row">
                        <div class="col-md-6"><h3 class="box-title">Completed Order</h3></div>
                        
                        <div class="col-md-6">
                            <div class="input-group" style="width: 250px;float: right;">
                                <input type="text" name="daterange" value=""  class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                  <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                  </button>
                                </div>
                              </div>
                        </div>
                        
                    </div>
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="stockIn" class="table table-hover dataTable no-footer dtr-inline" style="width: 98%; border: 1px solid rgb(232, 231, 231); margin-bottom: 5px;">
                    <thead>
                        <tr>
                            <th style="width: 60px !important;">Order ID# </th>
                            <!-- <th>Rating</th> -->
                            <!-- <th>Table No</th> -->
                            <th style="width: 60px !important;">Discount</th>
                            <th style="width: 60px !important;">Packing Charges</th>
                            <th style="width: 100px !important;">Tax/Other Charges</th>
                            <th style="width: 60px !important;">Amount</th>
                            <th style="width: 120px !important;" >Payment Method</th>
                            <th style="width: 120px !important;">Created</th>
                            <th style="width: 300px !important;">Action</th>
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

     

  
</html>


<script>





$(document).ready(function() {
   

   
   
   stockIn();
   calculateTotal();
    
    function calculateTotal(startDate=null,endDate=null){
        let url =null;
        if(startDate !=null && endDate !=null){
            url ="total_order_amount.php?startDate="+startDate+"&endDate="+endDate;
        }else{
            url ="total_order_amount.php";
        }
        $.ajax(url,{
                    success: function (data, status, xhr) {// success callback function
                    var responce =JSON.parse(data);
                    $("#total_stock").html("₹"+responce.total_sales.toFixed(2));
                    $("#coreder").html(responce.total_order);
                    }
                });
    }
    
    
    function stockIn(startDate=null,endDate=null,filter=null){
        let url =null;
        if(startDate !=null && endDate !=null){
            url ="datatable.php?startDate="+startDate+"&endDate="+endDate;
        }else{
            url ="datatable.php";
        }
        $('#stockIn').DataTable( {
            "processing": false,
            "serverSide": true,
            "searching": false,
            "ajax": url,
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
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
          
          let startDate=start.format('YYYY-MM-DD');
          let endDate = end.format('YYYY-MM-DD');
         
          $('#stockIn').DataTable().clear().destroy();
          stockIn(startDate,endDate);
          calculateTotal(startDate,endDate,null);

      });
    });  
} );





$('#payment_method').on('change', function() {
//   alert( this.value );
        
        let urls =null;
        urls ="total_order_amount.php?filter="+this.value;
        
        $.ajax(urls,{
            success: function (data, status, xhr) {// success callback function
            var responce =JSON.parse(data);
            $("#total_stock").html("₹"+responce.total_sales.toFixed(2));
            $("#coreder").html(responce.total_order);
            }
        });
        
        
        $('#stockIn').DataTable().clear().destroy();
        let url =null;
        url ="datatable.php?filter="+this.value;
        
        $('#stockIn').DataTable( {
            "processing": false,
            "serverSide": true,
            "searching": false,
            "ajax": url,
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
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

