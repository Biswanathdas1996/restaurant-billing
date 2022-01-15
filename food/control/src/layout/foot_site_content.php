
     <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="modal_button" data-target="#myModal" style="display:none;">Open Modal</button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="padding-right: 0px !important; ">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="padding: 10px 10px;">Order No - <b class="o_no" id="o_no"></b></h4>
            </div>
            <div class="modal-body">
                 <div class="container-fluid">
                     <div class="row">
                         <div class="col-md-12" style="padding: 0px;">
                        
                            <div  id="modal_data">
                              <div>No Item Added</div>
                            </div>

                            <!--<div id="cooking_ins"></div>-->
        
                             <!--<table class="table table-striped" style="width: 65%;float: right;">-->
                             <!--   <tbody id="charges_data">-->
            
                             <!--   </tbody>-->
                             <!-- </table>-->
                        </div>    
                    </div>    
                </div>    
            </div>
            <div class="modal-footer" style="text-align: center;">
               <!-- <div id="buttons"></div> -->
               <div id="buttonss"></div>
               
            </div>
          </div>
        </div>
      </div>
      
   
   
   
<!-- Modal -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#paymentMethodModal" id="paymentMethodModalButton" style="display:none">Open Modal</button>
<div id="paymentMethodModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment Method</h4>
      </div>
      <div class="modal-body">
        <div id="appendOption">
            
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal" id="paymetMethodSelectedButton">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>   
 <script>
      function ajax_ordered_item(id){
                $.ajax({
                    url: "../ajax_api/ajax_modal_data.php?id=" + id,
                    type: "post",
                    success: function(d) {
                        var abc =JSON.parse(d);
                        // $('#myModal').modal('toggle');
                        // console.log(abc);
                        var modal_data = '';
                        $.each(abc.data, function () {
                            
                            // console.log(this.img);
                          
                            var temp_modal_data=`<div class="menu-content" style="padding-bottom: 20px;">
                            <div class="row" >
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <div class="dish-img">
                                        <a href="#"><img src="../addNewFood/food_demo_img/`+ this.img +`" alt="" class="rounded-circle" style="height: 50px;width: 50px;"></a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4 title_wraper desc_t">
                                    <div class="dish-content">
                                        <span class="dish-title">
                                            <p>`+ this.title +`</p>
                                            <b>Qty: `+ this.order_qnt +`</b>
                                            
                                        </span>
                                      
                                    </div>
                                </div>
                             </div>
                        </div>`;
                           modal_data+=temp_modal_data;
                        });
                        
                        let btnn=`<a href="../../pages/add_new_order/index.php?orderid=${id}" style="float: right;">
                                  <button type="button" class="btn btn-primary btn-lg">View Order</button>
                                </a>`;
                        // console.log(modal_data);

                        $("#modal_data").html(modal_data);
                        $("#buttonss").html(btnn);
                        
                        ///////////////////////////
                        var charge_data=`<tr>
                                            <td style="text-align: justify;">Item-total:</td>
                                            <td style="text-align: end;">₹`+
                                            abc.item_total
                                            +`</td>
                                         </tr>`;
                        $.each(abc.charges, function () {
                            var_tmp_amp="";
                            if(this.charge_or_discount == 0 ){
                                        var_tmp_amp=`₹`+this.amount; 
                                    }else{
                                       var_tmp_amp=`- ₹`+this.amount;  
                                    }
                            var temp_charge_data=`
                                <tr>
                                    <td style="text-align: justify;">`+ this.name +`:</td>
                                    <td style="text-align: end;">`+
                                    var_tmp_amp
                                    +`</td>
                                 </tr>
                            `;
                           charge_data+=temp_charge_data;
                        });
                        charge_data+=`
                        <tr >
                                            <td style="text-align: justify;">Discount:</td>
                                            <td style="text-align: end;">-₹`+
                                            abc.discount
                                            +`</td>
                                         </tr>
                        <tr style="color: #3c8dbc;font-weight: bold;">
                                            <td style="text-align: justify;">`+abc.txt+`</td>
                                            <td style="text-align: end;">₹`+
                                            abc.total
                                            +`</td>
                                         </tr>
                                         
                                         <tr>
                                            <form class="form-inline idForm" id="formd_discount" >
                                                <td >
                                                    <div class="form-group" style="margin-bottom: 0px;">
                                                        <input placeholder="Discount" class="form-control"  type="number" min="0" class="product_quantity_value field"  value="" style="width: 100px;" id="input_discount"/>
                                                    </div>
                                                </td>
                                                <td >
                                                    <button type="button" class="btn btn-success btn-sm applyDiscount" style="padding: 6px 5px;float: right;">
                                                        <span class="glyphicon glyphicon-edit" style="color: white !important;"></span> &nbsp;Apply Discount 
                                                    </button>
                                                </td>
                                            </form>
                                         </tr>`;
                    $("#charges_data").html(charge_data);
                        
                        
                    if(abc.cooking_instruction != ""){
                        $("#cooking_ins").html("Cooking Instruction: <b>"+abc.cooking_instruction+"</b>");
                    }else{
                        $("#cooking_ins").html(""); 
                    }
                     
                    var button ="<button type='button' class='btn btn-success complete' data='"+abc.Order_id+"' table='"+abc.table_no+"' style='margin-bottom: 10px;'>Complete Order</button> <a href='https://menu.scanncatch.com/menu/"+abc.order_token+"' target='_blank'><button type='button' class='btn btn-warning' data='"+abc.Order_id+"' style='margin-bottom: 10px;'>Add More Item</button></a> <button type='button' class='btn btn-danger delete' data='"+abc.Order_id+"' table='"+abc.table_no+"' style='margin-bottom: 10px;'>Delete Order</button> <a href='../../../invoice/download_kitchen_recept.php?id="+abc.Order_id+"' target='_blank'> <button title='Kitchen Copy' type='button' class='btn btn-primary ' style='margin-left: 3px;margin-bottom: 10px;' >Kitchen Copy</button></a>"
                        $("#buttons").html(button);
                        $("#o_no").html(abc.Order_id);
                        $(".o_no").html(abc.Order_id);
                        $( "#modal_button" ).click();
                    }
                });
    } 
     
     
     
     
    function delete_oreder_item(id){
        swal({
          title: "Are you sure?",
          text: "Once deleted, items can not be recovered",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var orderId = $("#o_no").html();
            //  $("#myModal .close").click();
            $.ajax({
                    url: "../ajax_api/delete_order_item.php?id=" + id+"&order_id="+orderId,
                    type: "get",
                    success: function(d) {
                        ajax_ordered_item(orderId);
                        swal("Success !", "Item is deleted", "success")
                        .then((value) => {
                          $( "#modal_button" ).click();
                        });
                    }
            });
          } else {
          }
        });
    }
    
    function update_oreder_item(order_item_id,qty){
        var orderId = $("#o_no").html();
        swal({
          title: "Are you sure?",
          text: "Once deleted, items can not be recovered",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var orderId = $("#o_no").html();
            //  $("#myModal .close").click();
            $.ajax({
                    url: "../ajax_api/update_order_items.php?order_item_id=" + order_item_id+"&qty="+qty+"&order_id="+orderId,
                    type: "get",
                    success: function(d) {
                       
                        ajax_ordered_item(orderId);
                        // $("#myModal").show()
                        swal("Success !", "Item is updated", "success")
                        .then((value) => {
                          $("#modal_button").click();
                        });
                    }
            });
          } else {
            
            
          }
        });

    }
    
    
    function applyDiscount(amount){
        var orderId = $("#o_no").html();
        swal({
          title: "Are you sure?",
          text: "You want to give a discount",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var orderId = $("#o_no").html();
            //  $("#myModal .close").click();
            $.ajax({
                    url: "../ajax_api/give_indivisual_discount.php?amount="+amount+"&order_id="+orderId,
                    type: "get",
                    success: function(d) {
                       
                        ajax_ordered_item(orderId);
                        // $("#myModal").show()
                        swal("Success !", "Discount applied", "success")
                        .then((value) => {
                          $("#modal_button").click();
                        });
                    }
            });
          } else {
            
            
          }
        });

    }
    
    
    $(document).on('click','.subBtn',function(){
           let order_item_id= $(this).attr('order_item_id');

           let qty= $("#input_"+order_item_id).val();
        
            if(qty >0){
                update_oreder_item(order_item_id,qty);
            }else{
                alert("Invalid QTY");
            }
         });
         
    $(document).on('click','.applyDiscount',function(){
           let order_item_id= $(this).attr('order_item_id');

           let discount= $("#input_discount").val();
        
            if(discount >= 0){
                applyDiscount(discount)
            }else{
                alert("Invalid amount");
            }
         });
    
    
    
 $(document).on('click ', '#paymetMethodSelectedButton', function() {
        let paymentMethod = $("#paymetMethodSelected").val();
        let id =$("#finalId").val();
        let table =$("#finalTable").val();
        complete_order(id,table,paymentMethod);
 });
     
     
     
 $(document).on('click ', '.complete', function() {
    let id =$(this).attr('data');
    let table =$(this).attr('table');
    var requestOptions = {
      method: 'GET',
      redirect: 'follow'
    };
    fetch("../ajax_api/get_payment_methods.php", requestOptions)
      .then(response => response.json())
      .then(result => {
            let paymentMethodsOptions=null;
              var paymentMethod = null;
              result.map((item,index)=>{
                    let tempHtml= `<option value="${item.id}">${item.name}</option>`;
                    paymentMethod +=tempHtml;
                });
            paymentMethodsOptions=` <div class="form-group">
                                    <input type="hidden" value="${id}" id="finalId"/>
                                    <input type="hidden" value="${table}" id="finalTable"/>
                                    <label for="sel1">Select list:</label>
                                      <select class="form-control" id="paymetMethodSelected">
                                      
                                        ${paymentMethod}
                                       
                                      </select>
                                    </div> `;
            $("#appendOption").html(paymentMethodsOptions);
            $("#paymentMethodModalButton").click();
      }).catch(error => console.log('error', error));
    });
    
    
    
    
    $(document).on('click ', '.accept_all_device', function() {
      var id =$(this).attr('data');
        swal({
          title: "Are you sure?",
          text: "You want to allow any device for modify order ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              accept_all_device(id);
            swal("Success! Your order is now completed!", {
              icon: "success",
            });
          } else {
            
          }
        });
      
    });

$(document).on('click ', '.delete', function() {
      var id =$(this).attr('data');
      var table =$(this).attr('table');
    
        swal({
          title: "Are you sure?",
          text: "You want to delete this order ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
              
              delete_order(id,table);
            swal("Success!  Order is now deleted!", {
              icon: "success",
            });
          } else {
            
          }
        });
      
    });
    
    
    
    $(document).on('click ', '.tableId', function() {
      var table_no =$(this).attr('data');
    
    
        swal({
          title: "Are you sure?",
          text: "You want to Place a new order ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {


              // let link = "../../../auth.php?data="+data;

              let link = "../../pages/add_new_order/initiate_new_order.php?table_no="+table_no;
            
            localStorage.removeItem("customerId");  
            // window.open(link, '_blank');
         
            window.location.replace(link)
            
          } else {
            
          }
        });
      
    });
    
    
    
    
    
 function complete_order(id,table,paymentMethod){
        $.ajax({
                url: "../ajax_api/complete_order.php?id=" + id+"&table_no="+table+"&payment_method="+paymentMethod,
                type: "post",
                success: function(d) {
                    
                    swal("Success! Your order is now completed!", {
                      icon: "success",
                    }).then((value) => {
                     
                        window.location.reload(); 
                        
                    });

                    
                }
        });                    
    }
    
    function accept_all_device(id){
        $.ajax({
                url: "../ajax_api/bypass_device_auth.php?id=" + id,
                type: "post",
                success: function(d) {
                }
        });                    
    }

function delete_order(id,table){
        $.ajax({
                url: "../ajax_api/delete_order.php?id=" + id+"&table_no="+table,
                type: "post",
                success: function(d) {
                }
        });                    
    }

    
    
    
      
    </script>
    
    <!--****************************Backup code-->
    <!--var temp_modal_data=`<div class="menu-content" style="padding-bottom: 20px;">-->
    <!--                        <div class="row" >-->
    <!--                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">-->
    <!--                                <div class="dish-img">-->
    <!--                                    <a href="#"><img src="../addNewFood/food_demo_img/`+ this.img +`" alt="" class="rounded-circle" style="height: 50px;width: 50px;"></a>-->
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4 title_wraper desc_t">-->
    <!--                                <div class="dish-content">-->
    <!--                                    <span class="dish-title">-->
    <!--                                        <a class="title_text"  href="#">`+ this.title +`</a>-->
                                            
    <!--                                    </span>-->
                                       
                                        
                                       
    <!--                                </div>-->
    <!--                            </div>-->
    <!--                            <div class="col-lg-4 col-md-4 col-sm-3 col-xs-3" style="padding-right: 0px;padding-left: 5px;">-->
    <!--                                <div class="">-->
                                    
                                    
    <!--                                    <form class="form-inline idForm" id="formd_${this.order_item.id}" >-->
    <!--                                        <div class="form-group">-->
    <!--                                            <input  class="form-control"  type="number" min="1" class="product_quantity_value field"  value="${this.order_qnt}" style="width: 63px;" id="input_${this.order_item.id}"/>-->
    <!--                                        </div>-->
    <!--                                            <button type="button" class="btn btn-success btn-sm subBtn" order_item_id="${this.order_item.id}" style="padding: 6px 5px;">-->
    <!--                                              <span class="glyphicon glyphicon-edit" style="color: white !important;"></span> &nbsp;Update -->
    <!--                                            </button>-->
    <!--                                    </form>-->

                                       
    <!--                                </div>-->
    <!--                            </div>-->
                                
    <!--                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="padding-right: 0px;padding-left: 5px;">-->
    <!--                                <div class="">-->
                                       
                                       
    <!--                                    <button type="button" class="btn btn-danger btn-sm" onclick="delete_oreder_item(${this.order_item.id})">-->
    <!--                                      <span class="glyphicon glyphicon-trash"></span> &nbspDelete-->
    <!--                                    </button>-->
                                       
    <!--                                </div>-->
    <!--                            </div>-->
                                
                                
                                
    <!--                        </div>-->
    <!--                    </div>`;-->
    
    
    
    