<script>
    var temps = 0;
    function ajax_check_data_noti() {
        // $.ajax({
        //     url: "../../pages/ajax_api/ajax_check.php",
        //     type: "post",
        //     success: function(d) {
        //         var abcs = JSON.parse(d);
        //         var totals = abcs.data.total;
        //         var lastid = abcs.data.lastid;
        //         if (temps != totals) {
        //             if (temps != 0 || totals == 0) {
        //                 if (temps < totals) {
        //                     ajax_modal_data_noti(lastid);
        //                     temps = totals;
        //                 }
        //             } else {
        //                 temps = totals;
        //             }
        //         } else {}
        //     }
        // });
    }
    var refreshId = setInterval("ajax_check_data_noti()", 2000);
    function ajax_modal_data_noti(id) {
        $.ajax({
            url: "../../pages/ajax_api/ajax_modal_data.php?id=" + id,
            type: "post",
            success: function(d) {
                var abc = JSON.parse(d);
                var modal_data = '';
                $.each(abc.data, function() {
                    var temp_modal_data = `<div class="menu-content">
                            <div class="row" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <div class="dish-img">
                                        <a href="#"><img src="../addNewFood/food_demo_img/` + this.img + `" alt="" class="rounded-circle" style="height: 70px;width: 70px;"></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 title_wraper desc_t" style="margin-left:10px;">
                                    <div class="dish-content">
                                        <h5 class="dish-title">
                                            <a class="title_text"  href="#">` + this.title + `</a>
                                        </h5>
                                        <span class="dish-meta">In ` + this.type + `</span>
                                        <p style="font-size: 12px;" >Rs.` + this.price + `</p>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="padding-right: 0px;padding-left: 5px;">
                                    <div class="dish-price">
                                        <input type="text" class="product_quantity_value field"  value="` + this.order_qnt + `" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    modal_data += temp_modal_data;
                });
                $("#modal_datas").html(modal_data);
                if (abc.cooking_instruction != "") {
                    $("#cooking_inss").html("Cooking Instruction: <b>" + abc.cooking_instruction + "</b>");
                } else {
                    $("#cooking_inss").html("");
                }
                $("#o_noo").html(abc.Order_id);
                $("#order_tab").html(abc.table_no);

                $("#modal_buttons").click();

            }
        });
    }
</script>

<button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="modal_buttons" data-target="#myModals" style="display:none;">Open Modal</button>
<div class="modal" id="myModals" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="padding: 10px 10px;">New Order Placed From Table No: <b id="order_tab"></b> (Order No: <b id="o_noo"></b>)</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="modal_datas"></div>
                    <div id="cooking_inss"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>