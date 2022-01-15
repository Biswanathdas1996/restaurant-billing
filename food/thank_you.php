<?php
        include('component/head.php');
        include('notification/add_notification.php');
        
        // pr($_COOKIE);
        
        if(isset($_POST['paymentId'])){
                $id=$_GET["order_id"];
                $data=array(
                "data"=>array(
                        "payment_status"=>1,
                        "txn_id"=>$_POST['paymentId'],
                    ),
                );
                $update_payment_status=update('food_order',$data,$id);
        }
        $get_order_data=select('food_order' 
                        ,array(
                        'conditions'=>array(
                                "id"=>$_GET["order_id"],
                            ),
                        'join_many' => array(
                                'food_order_item'=>'order_id',
                            ),
                    )
                    );
      $get_data=order_data($_GET["order_id"]); //function is in head_include.php
      $sub_total=get_order_items_total_amount($_GET["order_id"]);
      $tmp_charges=get_total_tax_charges($_GET["order_id"]);
      $total_amount=($sub_total+$tmp_charges['total']);
?>
<style>
    .sub_bttn {
    width: 160px;
    float: right;
    color:white;
    background:#e23744cc;
    padding: 7px;
    border: none;
    word-spacing: -5px;
    letter-spacing: 1px;
    
}
</style>
<body>
      <button type="button" class="btn btn-info btn-lg" id="notable" data-toggle="modal" data-target="#myModal" style="display:none;">Open Modal</button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #e23744;color: white;">
              <h4 class="modal-title">Please Rate Us</h4>
            </div>
            <div class="modal-body">
              <form action="component/feedback.php" method="post" id="rateform">
                  <input type="hidden" name="order_id" value="<?= $_GET['order_id']?>">
                  <input type="hidden" name="table_no" value="<?= $get_order_data[0]['table_no']?>">
                  <input type="hidden" id="FireBaseToken" name="FireBaseToken" value="">
                <div class="form-group">
                   <?php include("component/rate.php");?> 
                </div>
                <center>
                <!--<div class="form-group">-->
                <!--   <input type="text" name="name" value="" placeholder="Enter Name" -->
                <!--          style="width: 60%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--   <input type="number" name="contact" value="" placeholder="Enter Contact No" -->
                <!--          style="width: 60%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">-->
                <!--</div>-->
                <!--<div class="form-group">-->
                <!--   <input type="email" name="email" value="" placeholder="Enter Email" -->
                <!--          style="width: 60%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">-->
                <!--</div>-->
                <button type="submit" class="btn btn-default" style="background-color: #e23744;color: white;border-radius: 0px;padding: 10px 25px;">Submit</button> 
                </center>
              </form>
            </div>
          </div>
        </div>
      </div>  
      
    <p id="tal"></p>
        <div class="container" style="margin-bottom: 40px;">
            <div class="row">
                <div class="col-lg-2 col-md-4  "></div>
                <!-- starter -->
                <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12 mb40 div_wraps">
                    <div class="menu-block">
                        <center>
                          <?php if($get_order_data[0]['payment_status']==1){?>
                         <h3 style="border: 1px solid #32c671;width: 100%;padding: 4px 0px;margin: 25px -78px;color: #f4f7f5;background-color: #38c173;">ONLINE PAID</h3>
                         <?php }else if($get_order_data[0]['payment_status']==2){?>  
                         <h3 style="border: 1px solid #eebc5e;width: 100%;padding: 4px 0px;margin: 25px -78px;color: #f4f7f5;background-color: #eebc5e;">
                             PLEASE WAIT 
                         </h3>
                         <?php }?>
                         <img src="asact/tick.png" class="img-rounded" alt="Cinque Terre" style="width: 75px;">
                         <h3 style="color: #32c671;font-weight: 500;margin-top: 10px;letter-spacing: 1px;">Success</h3>
                         <h5 style="color: green;">Your Order Placed Successfully</h5>
                         <h4 style="border: 1px solid;width: 28%;padding: 4px 0px;">Order Id: <?= $_GET['order_id']?></h4>
                        </center>
                        <?php if($get_order_data[0]['cooking_instruction'] != NULL){?>
                        <p style="font-size: 11px;color: #9d9c9c;"><b>Cooking Instruction: </b> <?php echo $get_order_data[0]['cooking_instruction'];?></p>
                        <?php }?>
                                <h3 style="font-size: 18px;padding: 5px 0px;"> 
                                    <a class="callHotel" href="tel:+918001691299" style="font-size: 15px;letter-spacing: 0px;font-weight: 500;text-decoration: none;float: right;margin-top: 12px;">
                                        <b style="font-size:12px; color:black;">Need Help? &nbsp;&nbsp;</b><span><span class="glyphicon glyphicon-earphone"></span> Call waiter</span>
                                    </a>
                                </h3>
            
            
            <h3 style="font-size: 18px;padding: 5px 0px;">Order Details</h3>
            
            
            
                <div id="thank_you">
                    
                    <center style="min-height: 160px;padding: 29px 0px;">   
                     <img class="img-responsive" src="asact/img/bip.gif" style="width: 100px;" >     
                    </center>
                    
                    
                </div>
        <?php 
        $current_clint_ip=get_client_ip();
        $order_ip=base64_decode($get_order_data[0]['process_session']);
        
        if($get_order_data[0]['payment_status']==0 && ($current_clint_ip == $order_ip )){?>            
                <form action="index.php?order_id=<?= $_GET['order_id']?>&table_no=<?= $get_order_data[0]['table_no']?>&uid=<?= $_GET['uid']?>" method="post" style="margin-bottom: 30px;">     
                    <button 
                    type="submit" 
                    class="sub_bttn" 
                    value="Add Item" 
                    name="re_order"><span class="glyphicon glyphicon-plus">&nbsp;Add Item</span> </button>
                    <br>
                </form>
        <?php }?>
        <table class="table table-striped">
            <tbody id="charges_tr">
             
            </tbody>
        </table>

                <!-- Modal -->
                <div id="myModal2" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Please Select Payment Method</h4>
                      </div>
                      <div class="modal-body">
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <center> 
                                        
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <form action="component/online_payment.php" method="get">
                                            <input type="hidden" name="order_id" value="<?= $_GET['order_id']?>">
                                          <button 
                                          style="border-radius: 0px;padding: 9px;background-color: #32c671;border: none;"
                                          type="submit" 
                                          class="btn btn-success"
                                          >Online Pay</button> 
                                        </form> 
                                    </center>
                                </td>
                            </tr>
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
    </div>
</div>
<div class="col-lg-2 col-md-4  "></div>
            </div>
        </div>
        <div id="footer">
            <?php if($get_order_data[0]['payment_status']==0){?>
            
            <?php //include('component/payment/index.php'); #ONLINE PAYMENT ?>
            
            <form action="component/cash_payment.php" method="post">
                <input type="hidden" name="order_id" value="<?= $_GET['order_id']?>">
                <input type="hidden" name="table_no" value="<?= $get_order_data[0]['table_no']?>">
                <input type="hidden" id="total_amount_in_cash" name="total_amoun" value="">
                <button 
                style="border-radius: 0px;padding: 9px;background-color: white;border: none;color: black;float: right;margin-right: 10px;"
                type="submit"
                class="btn btn-primary"
                >Request Payment</button>
            </form>
          
            <?php }?>
        </div>
    <script>
    $('.desc_t').click(function(){
       swal("Ingredients",$(this).attr('data'));
    });
    var o_id=<?php echo  $_GET['order_id'];?>; 
    var temp=0;
    function ajax_check_data(){
                $.ajax({
                    url: "component/api/check_if_order_is_complete.php?order_id="+o_id,
                    success: function(d) {
                        var abc =JSON.parse(d);
                        
                        // console.log(abc.data.total);
                        if(abc.data.total == 0){
                            var table_nos ="<?php echo $get_order_data[0]['table_no'];?>";
                            var link="index.php?table_no="+table_nos;
                            $(".container").remove();
                            $('#myModal').modal('show'); 
                            
                            localStorage.removeItem("customerId"); 
                            
                            var FireBaseToken = localStorage.getItem("FireBaseToken"); 
                            $("#FireBaseToken").val(FireBaseToken);
                            
                            
                        }
                    }
                });
    }
var refreshId = setInterval("ajax_check_data()", 1000);

                $( document ).ready(function() {
                            var data =<?php echo $_GET["order_id"];?>;
                            ajax_menu(data);
                            ajax_charges(data);
                });
            function ajax_menu(datas){
                $.ajax({
                    type: 'POST',
                    url: "component/api/thank_you_page_items_data.php",
                    data: {
                        data:datas,
                    },
                    beforeSend: function (xhr) {
                      xhr.setRequestHeader('Authorization', 'Basic ' + btoa("papun" + ":" + "111111"));
                    },
                    success: function(d) {
                        var overview =JSON.parse(d);
                        $(".table_nos").val(overview.table_no);
                        $(".total_amounts").val(overview.total);
                        $(".total_price").html(overview.total);
                        var div_data="";
                        $.each(overview.data, function () {
                            var temp_category_data="";
                            temp_category_data=`<div class="menu-content" id="del_${this.id}">
                            <div class="row" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="dish-img">
                                        <a href="#"><img src="control/pages/addNewFood/food_demo_img/${this.img}" alt="" class="rounded-circle" style="height: 70px;width: 70px;"></a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 title_wraper desc_t" data="${this.description}">
                                    <div class="dish-content">
                                        <h5 class="dish-title">
                                            <a class="title_text"  href="#">${this.title}</a>
                                        </h5>
                                        <span class="dish-meta">In ${this.type}</span>
                                        <p style="font-size: 12px;" class="price_${this.id}" >Rs.${this.price}</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <div class="dish-price" style="position: initial;">
                                        <input type="text" id="del_val_${this.id}" class="product_quantity_value field" data-id="${this.id}" data-price="${this.price}" value="${this.order_qnt}" name="qnt[${this.id}]" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>`;    
                        div_data+=temp_category_data;
                        });
                       $("#thank_you").html(div_data);
                    }
                });
            }
            
            function ajax_charges(datas){
                $.ajax({
                    type: 'POST',
                    url: "component/api/current_charges_api.php",
                    data: {
                        data:datas,
                    },
                    success: function(d) {
                        var chages =JSON.parse(d);
                        
                        // console.log(chages);
                        var tr_data=`<tr style="text-align: right;">
                                        <td>Sub-Total:</td>
                                        <td>₹`+chages.item_total.toFixed(2)+`</td>
                                      </tr>`;
                        $.each(chages.charges, function () {
                            var temp_category_data="";
                            temp_category_data=`
                             <tr style="text-align: right;">
                                <td>${this.name}:</td>
                                <td>
                                    ${this.amount}
                                </td>
                              </tr>
                            `;    
                        tr_data+=temp_category_data;
                        });
                        
                        tr_data+=`<tr style="text-align: right;">
                                        <td>Discount:</td>
                                        <td>- ₹`+chages.discount+`</td>
                                      </tr><tr style="text-align: right;color: #e23744; font-weight:bold;">
                                        <td>Today's Total:</td>
                                        <td>₹`+chages.amount_paid.toFixed(2)+`</td>
                                      </tr>`;
                                      
                                      
                       $("#charges_tr").html(tr_data);
                       
                       $("#total_amount_in_cash").val(chages.amount_paid);
                    }
                });
            } 
    </script>
</body>
</html>