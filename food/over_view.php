<?php
///////////////////////////////////////auth start////////////////////////  
session_start();
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
    include('component/add_order.php');
?>
<style>
   .well_de{ 
        border-radius: 0px;
        margin-top: 0px;
        padding: 12px;
       
   }
</style>
    <body>
        <!--<div class="well well_de">-->
        <!--    <button type="button" class="btn btn-default" onclick="goBack()" style="padding: 10px 20px;">-->
        <!--        <span class="glyphicon glyphicon-chevron-left"></span>-->
        <!--        <b>Back</b>-->
        <!--    </button>-->
        <!--</div>-->
        <p id="tal"></p>
    <form action="" method="post">
            <div class="container" style="margin-bottom: 70px;">
            <div class="row">
                <div class="col-lg-2 col-md-4  "></div>
                <div class="col-lg-8 col-md-4 col-sm-12 col-xs-12 mb40 div_wraps">
                    <div class="menu-block">
                        
                        
                     <button type="button" class="btn btn-default" onclick="goBack()" 
                     style="padding: 8px 30px;margin-top: 7px;margin-bottom: -6px;border-radius: 0px;background-color: #e237447d;border: none;color: white;">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <b>Back</b>
                    </button>  
                        
                    <h3 style="font-size: 18px;padding: 5px 0px;">Order Summery</h3>
                    <!--////////////////////////////////////////////////-->
                    <div id="overview">
                     
                     <center style="min-height: 160px;padding: 29px 0px;">   
                     <img class="img-responsive" src="asact/img/bip.gif" style="width: 100px;" >     
                     </center>   
                        
                    </div>                   
                    <table class="table table-striped">
                        <tbody>
                          <tr style="text-align: right;color: #e23744;">
                            <td><b>Item-Total:</b></td>
                            <td>₹<b class="total_price"></b></td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                      <label for="comment" style="color: #b8b5cd;font-size: 12px;">Cooking Instruction (Optional):</label>
                      <textarea class="form-control" rows="3" id="comment" name="instruction"></textarea>
                    </div> 
                </div>
            </div>
            <div class="col-lg-2 col-md-4 "></div>
            </div>
        </div>
        <div id="footer">
            <input type="hidden" name="table_no" class="table_nos" value="">
            <input type="hidden" name="subtotal" class="total_amounts" value="">
            <input type="hidden" name="total" class="total_amounts" value="">
            <h4 style="float: left;color: white;"> ₹<b class="total_price"></b><b style="font-weight: 500;font-size: 11px;">+ Taxes</b></h4>
            <button type="submit" style="border: none;width:160px;" class="sub_bttn" value="Confirm Orde" name="confirm_order"> 
            <i id="spin" class="fa fa-spinner fa-spin" style="font-size:24px; display:none"></i> 
            <b id="text_o" style="font-weight: 500;">Confirm Order <span class="glyphicon glyphicon-chevron-right"></span></b>
            </button>
        </div>
    </form>
    <script>
    $('.desc_t').click(function(){
       swal("Ingredients",$(this).attr('data'));
    });
    
    function goBack() {
        window.history.back();
    }
    
        $('.sub_bttn').click(function() {
           $("#spin").show();
           $("#text_o").hide();
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
            $('.total_price').html(total.toFixed(2));
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
            if (target.value > 1) {
                target.value = +target.value - 1;
            }
            calculate_cart();
        });
        $(document).on('click','.sub_bttn',function(){       
           $("#spin").show();
           $("#text_o").hide();
           $("#order_form").submit();
        });
        
        
        $(document).on('click','.del',function(){
            swal({
              title: "Are you sure?",
              text: "You want to remove this item..!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                  
                var data_id=$(this).attr('data-id');
                $("#del_"+data_id).remove();
                calculate_cart();
              }
            });
            
        });
        
    
         $( document ).ready(function() {
               var post_data = <?php echo json_encode($_POST); ?>;
               console.log("----",post_data);
               if (post_data.length === 0) {
                    window.history.back();
               }else{
                    ajax_menu(post_data);
               }
        });
       
                function ajax_menu(data){
                $.ajax({
                    type: 'POST',
                    url: "component/api/over_view_page_data.php",
                    data: data,
                    beforeSend: function (xhr) {
                      xhr.setRequestHeader('Authorization', 'Basic ' + btoa("papun" + ":" + "111111"));
                    },
                    success: function(d) {
                        var overview =JSON.parse(d);
                        console.log(overview);
                        $(".table_nos").val(overview.table_no);
                        $(".total_amounts").val(overview.total);
                        $(".total_price").html(overview.total);
                        var div_data="";
                        $.each(overview.data, function () {
                            var temp_category_data="";
                            temp_category_data=`<div class="menu-content" id="del_${this.id}">
                            <div class="row" >
                                <div class="col-lg-2 col-md-4 col-sm-3 col-xs-3">
                                    <div class="dish-img">
                                        <a href="#"><img src="control/pages/addNewFood/food_demo_img/${this.img}" alt="" class="rounded-circle" style="height: 70px;width: 70px;"></a>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-4 col-sm-5 col-xs-5 title_wraper desc_t" data="${this.description}">
                                    <div class="dish-content">
                                        <h5 class="dish-title">
                                            <a class="title_text"  href="#">${this.title}</a>
                                        </h5>
                                        <span class="dish-meta">In ${this.type}</span>
                                        <p style="font-size: 12px;" class="price_${this.id}" >Rs.${this.price}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4" style="padding-right: 0px;padding-left: 5px;">
                                
                                    <div>
                                        <button type="button" data-id="${this.id}" class="del qnt_btn" style="line-height: 28px;background: none;">
                                            <span class="glyphicon glyphicon-remove" style="font-size: 13px; padding-left: 77px;margin-bottom: 13px;color:#e237447d;"></span>
                                        </button>
                                    </div>
                               
                                    <div class="dish-price" style="position: initial;">
                                        <button type="button" class="sub qnt_btn">-</button>
                                        <input type="text" id="del_val_${this.id}" class="product_quantity_value field" data-id="${this.id}" data-price="${this.price}" value="${this.order_qnt}" name="qnt[${this.id}]" readonly>
                                        <button type="button" class="add qnt_btn">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>`;    
                        div_data+=temp_category_data;
                        });
                       $("#overview").html(div_data);
                    }
                });
    }
</script>
    
</body>

</html>