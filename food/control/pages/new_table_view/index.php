<?php include("../../src/config/includes.php"); echo Layout::bodyLayout();


$get_otder_type=select("food_menu_type");


?>
 <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Place Online Order</div>
                <div class="panel-body">
                

              
          <?php 
            foreach($get_otder_type as $type){
                
                if($type['name']== "OFFLINE"){ }else{
                ?>
             
                <a href="../add_new_order/initiate_new_order.php?type=<?php echo $type['id']?>">
                    <button type="button" class="btn btn-success btn-lg" style="padding: 23px 33px;">
                    
                              <span style="font-size: 16px;font-weight: bold;"><?php echo $type['name']?> ORDER</span>
                       
                    </button>
                </a>
                <?php }?>
           <?php } 
          ?>
           


                  
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> Table Status</div>
                <div class="panel-body">
                
                    <div class="append"></div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Parcel Order</div>
                <div class="panel-body">
                
                  <div class="appendParcel"></div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>










<script>    




        // $( document ).ready(function() {
             ajax_check_data_tabs();
             parcelTab();
        // });

        $(document).on('click ', '.modalltext', function() {
            var id =$(this).attr('value');
            ajax_ordered_item(id);
        });

        window.setInterval(function(){
            ajax_check_data_tabs()
        }, 2000);
        
        window.setInterval(function(){
            parcelTab()
        }, 2000);



        function ajax_check_data_tabs(){
            $.ajax({
                url: "../ajax_api/table_view_data.php",
                type: "post",
                success: function(d) {
                    $(".append").html(d);
                }
            });
        }
        
        
        function parcelTab(){
            $.ajax({
                url: "../ajax_api/parcel_data.php",
                type: "post",
                success: function(d) {
                    $(".appendParcel").html(d);
                }
            });
        }




            
    // var refreshIds = setInterval("ajax_check_data_tabs()", 2000);
     </script>
<?php include('../../src/layout/foot.php'); ?>