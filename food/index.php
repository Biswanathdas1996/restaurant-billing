<?php 
    session_start();
///////////////////////////////////////auth start////////////////////////    
date_default_timezone_set('Asia/Kolkata');
if(isset( $_SESSION["auth"])){
    $dateFromDatabase = $_SESSION["auth"];

    $dateTwelveHoursAgo = strtotime("-1 hours");

    if ( $dateFromDatabase > (time() - 60*60) ) {
    
    } else {
         echo "<script>window.close();</script>";
         die;
        // give your error message
    }


}

 

    
    
    
    
    
 ///////////////////////////////////////////////////auth end////////////////   
    include('component/head.php');
    // include('../notification/index.php');
    
    $session=base64_encode(date('m/d/Y h:i:s a', time()).$_GET["table_no"]);
    

    
    $_SESSION["process"]=$session;
        
    $tab_no=$_GET["table_no"];
    if(!isset($_GET["table_no"])){ ?>
    <script>
        $( document ).ready(function() {
            $("#notable").click();
        });
    </script> 
    <?php }?>
     <button type="button" class="btn btn-info btn-lg" id="notable" data-toggle="modal" data-target="#myModal" style="display:none;">Open Modal</button>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #e23744;color: white;">
              <h4 class="modal-title">Please select a table</h4>
            </div>
            <div class="modal-body">
              <form action="" method="get">
                <div class="form-group">
                  <label for="usr">Table No</label>
                  <input type="number" class="form-control" name="table_no" required>
                </div>
                <button type="submit" class="btn btn-default">Submit</button> 
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php 
    $get_category=select("food_category");
    $check_free_table=select("food_order",array(
            "conditions"=>array(
                 "table_no"=>$tab_no,
                 "done"=>0
                )
        ));
    if(count($check_free_table)>0 && !isset($_POST["re_order"])){?>
        <script>
             window.location.replace("thank_you.php?order_id="+"<?php echo $check_free_table[0]['id'];?>");
        </script>
    <?php    echo "Currently this table is ocupied ";
        die;
    }
    ?>
<body>
    
    
    <button type="button" class="btn btn-info btn-lg" id="notable" data-toggle="modal" data-target="#myCustomerModal" style="display:none;">Open Modal</button>
      <!-- Modal -->
      <div class="modal fade" id="myCustomerModal" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background-color: #e23744;color: white;">
              <h4 class="modal-title">Customer Details</h4>
            </div>
            <div class="modal-body">
              <form action="component/save_customer.php" method="post" id="idForm">
                  
                  <input type="hidden" name="table_no" value="<?= $_GET["table_no"]?>">
                <center>
                <div class="form-group">
                   <input type="text" name="name" value="" placeholder="Enter Name" 
                          style="width: 90%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">
                </div>
                <div class="form-group">
                   <input type="number" name="contact" value="" placeholder="Enter Contact No" 
                          style="width: 90%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">
                </div>
                <div class="form-group">
                   <input type="email" name="email" value="" placeholder="Enter Email" 
                          style="width: 90%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">
                </div>
                
                <div class="form-group">
                   <input type="text" name="remark" value="" placeholder="Remark" 
                          style="width: 90%;color: black;background-color: white;border: 1px solid #b8b8b8;text-align: left;padding: 10px;">
                </div>
                
                <button type="button" id="cancelModal" class="btn btn-default" style="background-color: #ccc;color: white;border-radius: 0px;padding: 10px 25px;">Cancel</button> 
                <button type="submit"  class="btn btn-default" style="background-color: #e23744;color: white;border-radius: 0px;padding: 10px 25px;">Submit</button> 
               
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
                    
                    <?php include('component/category_view.php'); ?>
                    
                    
          
                	<div class="row" style="padding: 10px 10px;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="search-query form-control" placeholder="What are you looking for?" id="searchData" onkeyup="search()"/>
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button" style="margin-top: -1px;">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                	</div>
                  
                    
                    
                <form action="over_view.php<?php if(isset($_GET['order_id'])){?>?order_id=<?php echo $_GET['order_id']; }?>" method="post" id="order_form">                   
                    <div class="menu-block" id="search_menu_block_id">
                    </div>
                    <div class="menu-block" id="menu_block_id">
                        
                    <center style="min-height: 160px;padding: 29px 0px;">   
                     <img class="img-responsive" src="asact/img/bip.gif" style="width: 100px;" >     
                     </center>
                        
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 "></div>
                <!-- /.starter -->
            </div>
        </div>
        <div id="footer" class="<?php echo $get_settings[0]["order_type"]?>">
            <input type="hidden" name="table_no" value="<?php echo $_GET["table_no"];?>">
            <input type="hidden" name="total"  id="table_total" value="0">
            <h4 style="float: left;color: white;"> ₹<b id="total_price">0.00</b> <b style="font-weight: 500;font-size: 11px;">+ Taxes</b></h4>
            <button type="submit" class="sub_bttn" value="Order Now" style="border: none;width:150px;"> 
            <i id="spin" class="fa fa-spinner fa-spin" style="font-size:24px; display:none"></i> 
            <b id="text_o" style="font-weight: 500;">Order Now <span class="glyphicon glyphicon-chevron-right"></span></b>
            </button>
        </div>
    </form>
    <script>
    
        $(document).on('click','#cancelModal',function(){
            $('#myCustomerModal').modal('hide');
        });
        
        $("#idForm").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
               type: "POST",
               url: url,
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                 localStorage.setItem("customerId", data);
                 $('#myCustomerModal').modal('hide');
               }
             });
        });
        
        
        
        
         
        $( document ).ready(function() {
                if(!localStorage.getItem("customerId")){
                    $('#myCustomerModal').modal('show');
                }
                 ajax_menu();
                calculate_cart();
        });
        
        
        $(document).on('click','.desc_t',function(){
           swal("Ingredients",$(this).attr('data'));
        });
        
        function calculate_cart()
        {
            var total= 0;
            $('.product_quantity_value').each(function(){
                var data_id=$(this).attr('data-id');
                total+=parseInt($(this).val())*parseInt($(this).attr('data-price')); 
            });
            console.log(total);
            $('#total_price').html(total.toFixed(2));
            $('#table_total').val(total.toFixed(2));
        }
        var total;
        // if user changes value in field
        $(document).on('change','.field',function(){
            // maybe update the total here?
        }).trigger('change');

        $(document).on('click','.add',function(){
            var target = $('.field', this.parentNode)[0];
            target.value = +target.value + 1;
            
            calculate_cart();
        });

        $(document).on('click','.sub',function(){
            var target = $('.field', this.parentNode)[0];
            if (target.value > 0) {
                target.value = +target.value - 1;
            }
            calculate_cart();
        });
        $(document).on('click','.sub_bttn',function(){       
          
           
           $("#spin").show(1).delay(1000).hide(1);
           $("#text_o").hide(1).delay(1000).show(1);
           
           $("#order_form").submit();
        });
    
       
       
        function search(){
              let search = $("#searchData").val();
            //   ajax_menu(search);
            
                var display_online="<?php echo $get_settings[0]["order_type"]?>"
                $.ajax({
                    url: "component/api/index_page_menu.php?search="+search,
                    success: function(d) {
                        var menu =JSON.parse(d);
                        var div_data="";
                        $.each(menu.data, function () {
                            var temp_category_data="";
                            temp_category_data=`<h3 class="cat_name_text" id="${this.category}">${this.category}</h3>`;
                                items_data="";
                                
                                if(this.items.length > 0){
                                           $.each(this.items, function () {
                                            temp_items_data="";
                                            temp_items_data=`<div class="menu-content ${this.status}">
                                                                <div class="row" >
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                        <div class="dish-img">
                                                                            <a><img src="control/pages/addNewFood/food_demo_img/${this.img}" data="${this.description}" class="rounded-circle desc_t" style="height: 70px;width: 70px;"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 title_wraper desc_t" data="${this.description}">
                                                                        <div class="dish-content">
                                                                            <h5 class="dish-title">
                                                                                <a class="title_text">${this.title}</a>
                                                                            </h5>
                                                                            
                                                                            <p style="font-size: 12px;" class="price_${this.id}" >Rs.${this.price}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ${display_online}" style="padding-right: 0px;padding-left: 5px;">
                                                                        <div class="dish-price">
                                                                            <button type="button" class="sub qnt_btn" style="black">-</button>
                                                                            <input type="text" class="product_quantity_value field" data-id="${this.id}" data-price="${this.price}" value="0" name="qnt[${this.id}]" readonly>
                                                                            <button type="button" class="add qnt_btn" style="black">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>`;
                                                            items_data+=temp_items_data;
                                        });
                                        
                                }else{
                                    temp_items_data=`<h5 style="font-size: 12px;padding: 5px 0px;letter-spacing: 3px;font-weight: 500;text-align: center;">Sorry no such item available</h5> `;
                                    items_data+=temp_items_data;
                                }
                                temp_category_data+= items_data;  
                                div_data+=temp_category_data; 
                        });
                        if(search != null && search != "" && search !=" "){
                            $("#search_menu_block_id").html(div_data);
                        }else{
                            $("#search_menu_block_id").html("");
                        }
                       
                    }
                });
        }
        
            
        function ajax_menu(search=null){
            $("#menu_block_id").html(`<center style="min-height: 160px;padding: 29px 0px;height:70vh;">   
                     <img class="img-responsive" src="asact/img/bip.gif" style="width: 100px;" >     
                     </center>`);
                     
            let url =null;
                if(search !== null && search !== "" && search !== " "){
                 url= "component/api/index_page_menu.php?search="+search; 
                }else{
                    url="component/api/index_page_menu.php";
                }
                var display_online="<?php echo $get_settings[0]["order_type"]?>"
                $.ajax({
                    url: url,
                    success: function(d) {
                        var menu =JSON.parse(d);
                        var div_data="";
                        $.each(menu.data, function () {
                            var temp_category_data="";
                            temp_category_data=`<h3 class="cat_name_text" id="${this.category}">${this.category}</h3>`;
                                items_data="";
                                
                                if(this.items.length > 0){
                                           $.each(this.items, function () {
                                            temp_items_data="";
                                            temp_items_data=`<div class="menu-content ${this.status}">
                                                                <div class="row" >
                                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                                                        <div class="dish-img">
                                                                            <a><img src="control/pages/addNewFood/food_demo_img/${this.img}" data="${this.description}" class="rounded-circle desc_t" style="height: 70px;width: 70px;"></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 title_wraper desc_t" data="${this.description}">
                                                                        <div class="dish-content">
                                                                            <h5 class="dish-title">
                                                                                <a class="title_text">${this.title}</a>
                                                                            </h5>
                                                                            <span class="dish-meta">In ${this.type}</span>
                                                                            <p style="font-size: 12px;" class="price_${this.id}" >Rs.${this.price}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 ${display_online}" style="padding-right: 0px;padding-left: 5px;">
                                                                        <div class="dish-price">
                                                                            <button type="button" class="sub qnt_btn" style="black">-</button>
                                                                            <input type="text" class="product_quantity_value field" data-id="${this.id}" data-price="${this.price}" value="0" name="qnt[${this.id}]" readonly>
                                                                            <button type="button" class="add qnt_btn" style="black">+</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>`;
                                                            items_data+=temp_items_data;
                                        });
                                        
                                       
                                }else{
                                    temp_items_data=`<h5 style="font-size: 12px;padding: 5px 0px;letter-spacing: 3px;font-weight: 500;text-align: center;">Sorry no such item available</h5> `;
                                    items_data+=temp_items_data;
                                }
                                temp_category_data+= items_data;  
                                div_data+=temp_category_data; 
                                
                        });
                       $("#menu_block_id").html(div_data);
                    }
                });
    }
        
        
        
   
        
        
    </script> 
</body>
</html>