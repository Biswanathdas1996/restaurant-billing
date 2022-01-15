<?php include("../../src/config/includes.php"); echo Layout::bodyLayout();
    $table_name='food_table';
    if(isset($_POST["book"])){
        $check_book=select('food_table_book',array(
                "conditions"=>array(
                    "table_no"=> $_POST["table_no"],
                    )
            ));
        $data=array(
        "data"=>array(
                "table_no"=> $_POST["table_no"],
                "remark"=> $_POST["remark"],
                "date"=> $_POST["date"],
                "time"=> $_POST["time"],
                "created"=> date("Y-m-d"),
            ),
        );
    $insert_data = insert('food_table_book',$data);
    }
?>
 <div class="container-fluid">

    <!-- Trigger the modal with a button -->
    <button type="button" id="modal_button_book" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal1" style="display:none;">Open Modal</button>

    <!-- Modal -->
    <div id="myModal1" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" style="background: linear-gradient(to right, #e52d27, #b31217);color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Book Table</h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <input type="hidden" name="table_no" value="" class="table_nos">
                  <div class="form-group">
                    <label for="remark">Remark:</label>
                    <input type="text" class="form-control" name="remark">
                  </div>
                  <div class="form-group">
                    <label for="date">Booking Date:</label>
                    <input type="date" class="form-control" name="date">
                  </div>
                  <div class="form-group">
                    <label for="date">Booking Time:</label>
                    <input type="time" class="form-control" name="time">
                  </div>
                  <button type="submit" class="btn btn-success" name="book">Confirm Booking</button>
                </form> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
     
  <!--////////////////////////////////////////////////////////////////////////////////////////   -->
  
  <button type="button" id="modal_button_past_book" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal2" style="display:none;">Open Modal</button>

    <!-- Modal -->
    <div id="myModal2" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header" >
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Book Table</h4>
          </div>
          <div class="modal-body">
            <form action="" method="post">
                <input type="hidden" name="table_no" value="" class="table_nos">
                  <div class="form-group">
                    <label for="remark">Remark:</label>
                    <input type="text" class="form-control" name="remark">
                  </div>
                  <div class="form-group">
                    <label for="date">Booking Date:</label>
                    <input type="date" class="form-control" name="date">
                  </div>
                  <div class="form-group">
                    <label for="date">Booking Time:</label>
                    <input type="time" class="form-control" name="time">
                  </div>
                  <button type="submit" class="btn btn-success" name="book">Confirm Booking</button>
                </form> 
                
                <h4>Current Booking(s)</h4>
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Booked On</th>
                        <th>Remark</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="book_list">
                      
                    </tbody>
                  </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  <!--////////////////////////////////////////////////////////////////////////////////////////   -->
     <div class="panel panel-default">
     <div class="panel-heading">Table Status</div>
     <div class="panel-body">
    <?php   
            $get_data=select("food_table");
            $no_of_table=$get_data[0]['total_working_no_of_table']; 
    ?>
            <div class="row">
                <?php for($i=1; $i<=$no_of_table;$i++){
                $get_table_data=select("food_order",[
                        "conditions"=>[
                            "table_no"=>$i,
                            "done"=>0
                            ],
                            'join_many' => array(
                                'food_order_item'=>'order_id',
                            ),
                    ]);
                    
                $get_book_status=select("food_table_book",[
                            "conditions"=>[
                            "table_no"=>$i,
                            ],
                    ]);   
                ?>
                <div class="col-md-2 col-sm-4 col-xs-4">
                <?php if(count($get_table_data)>0){?>
                    <button type="button" id="<?= $i ?>" class="btn btn-danger modalltext" title="Free Table" value="<?= $get_table_data[0]['id'] ?>" style="padding: 8px 6px; width:90%; margin:2px;">
               <?php  }else {
                        if(count($get_book_status)>0){?>
                       <button type="button" id="<?= $i ?>"  class="btn btn-warning modal_button_past_book" title="Table is booked" value="<?= $i ?>" style="padding: 8px 6px; width:90%; margin:2px;">
                       <?php }else{?>
                   <button type="button" id="<?= $i ?>" class="btn btn-success table_reserve" title="Ongoing Order" value="<?= $i ?>" style="padding: 8px 6px; width:90%; margin:2px;">
               <?php  }
               }?>
                         <span class="glyphicon glyphicon-text-size" style="font-size: 25px;"></span>
                        <!--<i class="glyphicon glyphicon-qrcode"  ></i> -->
                        <p style="margin: 0px 0px;padding-top: 5px;font-size: 10px;">Table no: <?= $i ?> </p>
                    </button>
                </div>
                <?php
                unset($get_table_data);
                unset($get_book_status);
                }?>
            </div>
       </div>
</div>     
</div>
<script>    
    $(document).on('click ', '.table_reserve', function() {
      var id =$(this).attr('value');
      $(".table_nos").val(id);
      $( "#modal_button_book" ).click();
    });
    $(document).on('click ', '.modalltext', function() {
        var id =$(this).attr('value');
        ajax_ordered_item(id);
    });
    $(document).on('click ', '.del_book', function() {
        swal({
              title: "Are you sure?",
              text: "You want to cancel the booking ?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                var id =$(this).attr('data');
                var table =$(this).attr('table');
                ajax_del_booking(id,table);
              } else {
              }
            });
     });
    $(document).on('click ', '.modal_button_past_book', function() {
      var id =$(this).attr('value');
      $(".table_nos").val(id);
      ajax_booking_list(id);
      $( "#modal_button_past_book" ).click();
    });
 
 
        function ajax_booking_list(id){
            $("#book_list").html("");
                $.ajax({
                    url: "../ajax_api/table_booking_list_ajax.php?table_no=" + id,
                    type: "post",
                    success: function(d) {
                        var abc =JSON.parse(d);
                        var modal_data = '';
                        if((abc.length)>0){
                        $.each(abc, function () {
                            var temp_modal_data=`
                            <tr>
                            <td>`+this.date+`</td>
                            <td>`+this.time+`</td>
                            <td>`+this.created+`</td>
                            <td>`+this.remark+`</td>
                            <td><span class="glyphicon glyphicon-remove del_book" table="`+this.table_no+`" data="`+this.id+`" style="color:red;"></span></td>
                            </tr>
                            `;
                          modal_data+=temp_modal_data;
                        });
                        }else{
                            var temp_modal_data=`
                            <tr>
                            No Data
                            </tr>
                            `;
                          modal_data+=temp_modal_data;
                        }
                        $("#book_list").html(modal_data);
                    }
                });
    }
    
    function ajax_del_booking(id,table){
            $("#book_list").html("");
                $.ajax({
                    url: "../ajax_api/table_booking_list_ajax.php?del_book=" + id,
                    type: "post",
                    success: function(d) {
                        ajax_booking_list(table);
                    }
                });
    }
    $("#example_filter").hide();
    
      var tempss=0;
            function ajax_check_data_tabs(){
                // $.ajax({
                //     url: "../ajax_api/ajax_check.php",
                //     type: "post",
                //     success: function(d) {
                //         var abcs =JSON.parse(d);
                //         var totalss = abcs.data.total;
                //         var lastid = abcs.data.lastid;
                //         var table = abcs.data.table_no;
                //         if(tempss != totalss){
                //              if(tempss!=0 || totalss==0){
                //                  if(tempss < totalss){
                //                   $("#"+table).removeAttr('class');
                //                   $("#"+table).addClass("btn btn-danger modalltext");
                //                    $("#"+table).val(lastid);
                //                     tempss=totalss;
                //                  }else{
                //                  }   
                //              }else{
                //                   tempss=totalss;
                //              }   
                //             }else{
                //             }
                //     }
                // });
            }
    var refreshIds = setInterval("ajax_check_data_tabs()", 2000);
     </script>
<?php include('../../src/layout/foot.php'); ?>