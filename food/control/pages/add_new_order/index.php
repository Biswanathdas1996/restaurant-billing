<?php include("../../src/config/includes.php");
echo Layout::bodyLayout();

$order_id = $_GET["orderid"];
$get_settings = select("food_settings");
$food_customers = select("food_customers");
$get_order = select("food_order", [
    "conditions" => [
        "id" => $order_id
    ],
    'join_many' => array(
        'food_order_item' => 'order_id',
    ),
]);


// pr($get_order);
if (empty($get_order)) { ?>
    <script>
        window.location.replace("../new_table_view")
    </script>

<?php }

///*******************get customer **************************???///
$get_Customer = select("food_customers", [
    "conditions" => [
        "order_id" => $order_id
    ]
]);

///***************************Complete Order start***********************??////
if (isset($_POST["complete_order"])) {
    $cahrges = json_decode(base64_decode($_POST["charges"]), true);
    foreach ($cahrges as $chargeData) {
        $data1 = array(
            "data" => array(
                "order_id" => $order_id,
                "name" => $chargeData['name'],
                "amount" => $chargeData['value'],
                "charge_or_discount" => $chargeData['charge=0_&_discount=1'],
                "created" => date("Y-m-d"),
            )
        );
        $insert_data = insert('food_order_charges', $data1);
    }
    $id = $_POST["order_id"];
    $payment_method = $_POST["payment_method"];
    $data = array(
        "data" => array(
            "done" => 1,
            "payment_method" => $payment_method,
        ),
    );
    $update_data = update('food_order', $data, $id);

    $get_scan_token = select("food_scan_report", [
        "conditions" => [
            "token" => $get_order[0]['token']
        ]
    ]);
    $sdata = array(
        "data" => array(
            "token" => "",
            "status" => 0,
        ),
    );
    $update_data = update('food_scan_report', $sdata, $get_scan_token[0]["id"]);

    //////////////************************Issue of ready to serve item************ */
    $get_order_items = select("food_order_item", [
        "conditions" => [
            "order_id" => $order_id
        ]
    ]);
    foreach ($get_order_items as $dataissue) {
        $check_if_ready_to_serve = select("ready_to_serve_item", [
            "conditions" => [
                "food_demo_id" => $dataissue["item_id"]
            ]
        ]);
        if (!empty($check_if_ready_to_serve)) {
            foreach ($check_if_ready_to_serve as $val) {
                $idata = array(
                    "data" => array(
                        "item" => $val['food_inventory_item_id'],
                        "qty" => ($val['qty_issue_per_order'] * $dataissue["qnt"]),
                        "remark" => "With Bill no# " . $order_id,
                        "created" => date("Y-m-d"),
                    )
                );
                $insert_data = insert('food_inventory_remove', $idata);
            }
        }
    }
    ///////////////////////////***************************//////////////////// */
?>
    <script>
        window.location.replace("../new_table_view")
    </script>
<?php
}

///***************************update qty***********************??////
if (isset($_POST["update"])) {
    $id = $_POST["order_item_id"];
    $data = array(
        "data" => array(
            "qnt" => $_POST['updateQty'],
            "totalItemPrice" => $_POST['updateQty'] * $_POST['item_unit_price']
        )
    );
    $update_data = update('food_order_item', $data, $id);
    update_order_table_with_latest_data($order_id);
}

///***************************Apply Indivisual Discount***********************??////
// if (isset($_POST["indivisual_discount"])) {

//     $discount_percent = $_POST['indivisual_discount_amount'];
//     $discount_item_total = $_POST['item_total'];
//     $discount_amount = ($discount_item_total / 100) * $discount_percent;
//     $data = array(
//         "data" => array(
//             "indivisual_discount" => $discount_amount,
//             "indivisual_discount_percent" => $discount_percent,
//         )
//     );
//     $update_data = update('food_order', $data, $order_id);
//     update_order_table_with_latest_data($order_id);
// }

///***************************Apply Packing Charges***********************??////
if (isset($_POST["packing_charges"])) {
    $data = array(
        "data" => array(
            "packing_charges" => $_POST['packing_charges_amount'],
        )
    );
    $update_datas = update('food_order', $data, $order_id);
    update_order_table_with_latest_data($order_id);
}
//??**********************************************Get Charges / TAX********************
$get_payment_method = select("payment_methods", [
    "conditions" => [
        "status" => 1
    ]
]);
///////*************Get total tax and charges***************** */

function get_total_tax_charges($total_amount)
{
    $s_total_amount = $total_amount;
    $s_t_discount = 0;
    $get_all_charges = select('food_tax_charges', [
        "conditions" => [
            "status" => 1
        ]
    ]);
    $final_array = [];
    foreach ($get_all_charges as $charge) {
        $temp_array = [];
        $temp_total_charge_amount = 0;
        if ($charge['type'] == 0) {
            $temp_balance_amount = ($s_total_amount * $charge['amount']);
            $balance_amount = ($temp_balance_amount / 100);
        } else {
            $balance_amount = $charge['amount'];
        }
        $ch_value = $balance_amount;
        if ($charge['charge_or_discount'] == 0) {
            $temp_total_charge_amount += $balance_amount;
        } else {
            $temp_total_charge_amount -= $balance_amount;
        }
        $s_t_discount += $temp_total_charge_amount;
        if ($charge['charge_or_discount'] == 0) {
            $balance_amount = "₹" . number_format($balance_amount, 2);
        } else {
            $balance_amount = "-₹" . number_format($balance_amount, 2);
        }
        $temp_array = array(
            "name" => $charge['name'],
            "amount" => $balance_amount,
            "value" => $ch_value,
            "charge=0_&_discount=1" => $charge['charge_or_discount'],
            "%=0_&_fixed=1" => $charge['type']
        );
        $final_array["details"][] = $temp_array;
    }
    $final_array["total"] = $s_t_discount;
    return $final_array;
}




function update_order_table_with_latest_data($order_id)
{
    $get_latest_order = select("food_order", [
        "conditions" => [
            "id" => $order_id
        ],
        'join_many' => array(
            'food_order_item' => 'order_id',
        ),
    ]);
    $cahageable_item_total = $get_latest_order[0]["sub_total"];
    $item_total = 0;
    if (count($get_latest_order[0]['food_order_item']) > 0) {
        foreach ($get_latest_order[0]['food_order_item'] as $item) {
            $get_item = select("food_demo", [
                "conditions" => [
                    "id" => $item["item_id"]
                ]
            ]);
            $item_total += ($get_item[0]['price'] * $item["qnt"]);
        }
        $current_discount = 0;
        if ($get_latest_order[0]['indivisual_discount_percent'] > 0) {
            $percent_discout = $get_latest_order[0]['indivisual_discount_percent'];
            $current_discount = ($item_total / 100) * $percent_discout;
            $claculated_cahageable_item_total = $item_total - $current_discount;
        } else {
            $claculated_cahageable_item_total = $item_total;
            $current_discount = 0;
        }
        $tax_charges = get_total_tax_charges($claculated_cahageable_item_total);
        $total_amount = ($claculated_cahageable_item_total + $tax_charges['total']);
        $update_orderdata = array(
            "data" => array(
                "sub_total" => $item_total,
                "total_charges" => $tax_charges['total'],
                "indivisual_discount_percent" => $get_latest_order[0]['indivisual_discount_percent'],
                "indivisual_discount" => $current_discount,
                "total" => (round($total_amount + $get_latest_order[0]['packing_charges'])),
            ),
        );
        $update_data_order_data = update('food_order', $update_orderdata, $order_id);
    }
}
?>
<!--Write your code here-->

<style>
input[type='text'],
input[type='number'],
textarea {
  font-size: 16px;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4" >
            <?php include("View_order_details.php"); ?>
        </div>
        <div class="col-md-4">
            <?php include('customer_details.php'); ?>
        </div>  
        <div class="col-md-4">
            <?php include('view_order_note.php'); ?>
        </div>
        


        <div class="col-md-12 delete_on_bill_print" style="padding: 0px;">
            <div class="panel panel-default">
                <div class="panel-heading">Search Food-Item </div>
                <div class="panel-body">
                    <div class="row" style="padding: 10px 10px;">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="search-query form-control" placeholder="What are you looking for?" id="searchData" onkeyup="search()" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger btn-lg" type="button" style="margin-top: -1px;" id='start' value='Start'>
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                    <!-- <button class="btn btn-success btn-lg" type="button" style="margin-top: -1px;margin-left: 10px;" id='start' value='Start' onclick='startRecording();'>
                                            <span class=" glyphicon glyphicon-volume-up"></span>
                                        </button> -->
                                </span>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row" class="menu-block" style="margin-bottom:10px;" id="search_menu_block_id">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12" style="padding: 0px;">
            <div class="panel panel-default">
                <div class="panel-body" style="overflow-x: auto;">

                    <div id="render_order_items">

                    </div>

                </div>
            </div>
        </div>


        <div class="col-md-12" style="padding: 0px;">
            <div class="panel panel-default">
                <div class="panel-heading">Billing</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($get_order[0]['done'] != 1) { ?>




                                <?php include('add_discount.php'); ?>
                                <br />
                                <?php include('add_packing_charges.php'); ?>






                            <?php } ?>
                            <?php
                            $get_settings_ip = base64_encode($get_settings[0]["connect_ip"]);
                            ?>
                            <!-- <div class="panel panel-default" style="margin-top: 20px;width: 365px;">
                                <div class="panel-heading">Invoice
                                </div>
                                <div class="panel-body">
                                    <center> -->
                            <!-- <img class="img-responsive" src="qr.php?order_id=<?php //echo $order_id; 
                                                                                    ?>&ip=<?php //echo $get_settings_ip; 
                                                                                            ?>" style="height: 100px;" />
                                        <b>Scan The QR to Get Invoive</b>
                                        <br> -->
                            <!-- </center>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-md-6">
                            <div id="payment_details_div"></div>
                            <center>
                                <div id="invoice_div">
                                    <table>
                                        <tr>
                                            <td>
                                                <!-- <a href='../../../invoice/download.php?id=<?php echo $order_id; ?>' target="_blank"> -->
                                                <button onclick="Billframe()" data-toggle="modal" data-target="#myModalBILL" type="button" class="btn btn-info btn-lg print_the_bill" style="">
                                                    <span class='glyphicon glyphicon-file' style='color: white !important;'></span>
                                                    &nbsp;View Bill
                                                </button>
                                                <!-- </a> -->
                                            </td>
                                            <td>
                                                <a href='../../../invoice/index.php?id=<?php echo $order_id; ?>' target="_blank">
                                                    <button type="button" class="btn btn-info btn-lg print_the_bill" style="">
                                                        <span class='glyphicon glyphicon-print' style='color: white !important;'></span>
                                                        &nbsp;Print Bill
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                    <table style="margin-top:10px">
                                        <tr>
                                            <td>
                                                <!-- <a href='../../../invoice/download_kitchen_recept.php?id=<?php echo $order_id; ?>' target='_blank'> -->
                                                <button onclick="Kotframe()" data-toggle="modal" data-target="#myModalKOT" type="button" class="btn btn-primary btn-lg" style="margin-top:0px;"><span class='glyphicon glyphicon-file' style='color: white !important;'></span>&nbsp;&nbsp;View Kitchen Copy</button>
                                                <!-- </a> -->
                                            </td>
                                            <td>
                                                <a href='../../../invoice/kictchen_recept.php?id=<?php echo $order_id; ?>' target='_blank'>
                                                    <button type="button" class="btn btn-primary btn-lg" style="margin-top:0px;">
                                                        <span class='glyphicon glyphicon-print' style='color: white !important;'></span>&nbsp;&nbsp;Print Kitchen Copy
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <?php include('print_bill_again.php'); ?>

                                <script>
                                    function Kotframe() {
                                        let data = `<iframe src="../../../invoice/download_kitchen_recept.php?id=<?php echo $order_id; ?>" frameborder="0" style="overflow:hidden;height:500px;" height="100%" width="100%"></iframe>`;
                                        $("#frame").html(data);
                                    }

                                    function Billframe() {
                                        let data = `<iframe src="../../../invoice/download.php?id=<?php echo $order_id; ?>" frameborder="0" style="overflow:hidden;height:500px" height="100%" width="100%"></iframe>`;
                                        $("#billFrame").html(data);
                                    }
                                </script>
                                <!-- Modal -->
                                <div id="myModalKOT" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Kitchen Copy</h4>
                                            </div>
                                            <div class="modal-body" id="frame">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            </center>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <?php if ($get_order[0]['done'] != 1) { ?>
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#paymentMethodModalbtn" style="float:right;margin-right:15px">
                            <span class='glyphicon glyphicon-ok-sign' style='color: white !important;'></span> Complete Order
                        <?php } ?>
                        <!--<button type="button" class="btn btn-info">Info</button>-->
                        <a href='../new_table_view'>
                            <button type="button" class="btn btn-warning btn-lg" style="float:right;margin-right:15px"><span class='glyphicon glyphicon-arrow-left' style='color: white !important;'></span> Back</button>
                        </a>
                        <button type="button" class="btn btn-danger btn-lg" id="delete_order" data="<?php echo $order_id; ?>" style=""><span class='glyphicon glyphicon-trash' style='color: white !important;'></span> Delete Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<div id="paymentMethodModalbtn" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form class="" method="post" action="index.php?orderid=<?php echo $order_id; ?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Payment Method</h4>
                </div>
                <div class="modal-body">
                    <!--$get_payment_method-->
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $order_id; ?>" name="order_id" />
                        <input type="hidden" value="<?php echo base64_encode(json_encode($total_charge_data['charges'])); ?>" name="charges" />
                        <label for="sel1">Select list:</label>
                        <select class="form-control" name="payment_method">
                            <?php foreach ($get_payment_method as $method) { ?>
                                <option value="<?php echo $method['id'] ?>"><?php echo $method['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg" name="complete_order">Submit</button>
                    <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>




<!-- Modal -->
<div id="myModaladdons" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add ons</h4>
            </div>
            <div class="modal-body">

                <div id="addonsDiv">

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" data-dismiss="modal">Add to bill</button>
            </div>
        </div>

    </div>
</div>



<script type='text/javascript'>

    
   
  
$(document).on('click', '[data-dismiss="modal"]', function(){
    
    render_amounts();
})


    function addOnsView(id) {
        let order_id = "<?php echo $order_id; ?>";
        let data = `<iframe src="add_addons.php?itemid=${id}&order_id=${order_id}" frameborder="0" style="overflow:hidden;height:500px;" height="100%" width="100%"></iframe>`;
        $("#addonsDiv").html(data);
    }


    // let recognition = new webkitSpeechRecognition();
    // recognition.onresult = function(event) {
    //     console.log('result');
    //     let saidText = "";
    //     for (let i = event.resultIndex; i < event.results.length; i++) {
    //         if (event.results[i].isFinal) {
    //             saidText = event.results[i][0].transcript;
    //         } else {
    //             saidText += event.results[i][0].transcript;
    //         }
    //     }
    //     document.getElementById('searchData').value = saidText;
    //     search()
    // }
    // function startRecording() {
    //     recognition.start();
    // }

    // Search Posts
    function searchPosts(saidText) {
        $.ajax({
            url: 'getData.php',
            type: 'post',
            data: {
                searchData: saidText
            },
            success: function(response) {
                $('.container').empty();
                $('.container').append(response);
            }
        });
    }

    $(document).on('click', '.print_the_bill', function(e) {
        // e.preventDefault();
        AccessProntBill(1);
        $("#print_bill_again_div").show();
        $(".delete_on_bill_print").hide();
    });

    function AccessProntBill(data) {
        $.ajax({
            type: "POST",
            url: "restrict_next_bill_print.php?data=" + data + "&order_id=<?php echo $order_id; ?>",
            success: function(result) {}
        });
    }

    $(document).on('click ', '#delete_order', function() {
        let id = $(this).attr('data');
        let table = $(this).attr('table');
        swal({
                title: "Are you sure?",
                text: "You want to delete this order ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    delete_order(id, table);
                    swal("Success!  Order is now deleted!", {
                        icon: "success",
                    }).then((value) => {
                        window.location.replace("../new_table_view")
                    });
                } else {}
            });
    });



    function addCustomer(name, value) {
        $.ajax({
            type: "POST",
            url: "add_customer.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                fieldName: name,
                fieldValue: value
            },
            success: function(result) {
                $("#somewhere").html(result);
            }
        });
    };

    $(document).on('keyup', '.addCustomercontact', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "add_customer.php?order_id=" + "<?php echo $order_id; ?>",
            data: {
                fieldName: e.target.name,
                fieldValue: e.target.value
            },
            success: function(result) {
                $("#somewhere").html(result);
            }
        });
    });

    $(document).on('keyup', '.addCookingIns', function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "add_cooking_instruction.php",
            data: {
                itemId: e.target.name,
                fieldValue: e.target.value
            },
            success: function(result) {
                $("#somewhere").html(result);
            }
        });
    });

    function search() {
        let search = $("#searchData").val();
        //   ajax_menu(search);
        let menu_type = "<?php echo $get_order[0]['order_type'] ?>"
        $.ajax({
            url: "menu_api.php?menu_type=" + menu_type + "&search=" + search,
            success: function(d) {
                let menu = JSON.parse(d);
                let div_data = "";
                $.each(menu.data, function() {
                    let temp_category_data = "";
                    // temp_category_data = `<h3 class="cat_name_text" id="${this.category}">${this.category}</h3>`;
                    items_data = "";

                    if (this.items.length > 0) {
                        $.each(this.items, function() {
                            temp_items_data = "";
                            temp_items_data = `
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 title_wraper desc_t" style="border: 1px solid #c6c6c6;padding: 0px 5px;margin: 0px 0px;height: 200px;">
                                <div class="dish-content">
                                    <h5 class="dish-title" style="margin-bottom: 0px;">
                                        <a class="title_text" style="font-size: 14px;font-weight: 600;color: black;">${this.title}</a>
                                    </h5>
                                    <p style="font-size: 13px;margin-bottom: 0px;color: #e12b26;font-weight: 600;">Rs.${this.price}</p>
                                    <a href='../addNewFood/edit.php?id=${this.id}' target='_blank'> 
                                        Edit Details
                                    </a>
                                </div>
                                <div class="dish-price">
                                    <form class="form-inline" action="" method="post" id="item_add_form_${this.id}">
                                        <input type="hidden" name="item_id" value="${this.id}"/>
                                        <input type="hidden" name="table_no" value="<?php echo $get_order[0]['table_no']; ?>"/>
                                        <div class="form-group">
                                        <input class="form-control" style="width: 90px;height: 40px;" type="number" min="1" name="qty" placeholder="Enter QTY" required>
                                        </div >
                                        <button type="submit" name="add" class="btn btn-danger btn-sm" onclick="add_new_item(${this.id})" style="font-size:20px">Add Item</button>
                                    </form>
                                </div>
                            </div>`;
                            items_data += temp_items_data;
                        });
                    } else {
                        temp_items_data = `<h5 style="font-size: 12px;padding: 5px 0px;letter-spacing: 3px;font-weight: 500;text-align: center;">Sorry no such item available</h5> `;
                        items_data += temp_items_data;
                    }
                    temp_category_data += items_data;
                    div_data += temp_category_data;
                });
                if (search != null && search != "" && search != " ") {
                    $("#search_menu_block_id").html(div_data);
                } else {
                    $("#search_menu_block_id").html("");
                }
            }
        });
    }

    render_amounts();

    async function render_amounts() {
        let orderid = "<?php echo $_GET['orderid'] ?>"
        await $.ajax({
            url: "get_amount_details.php?orderid=" + orderid,
            success: function(d) {
                console.log("----->",d);
                let data = JSON.parse(d);
                console.log("-----",data);
                let div_data = "";
                let other_tax_charges = "";
                if (data.charges.length > 0) {
                    $.each(data.charges, function() {
                        let temp = "";
                        temp = `<tr>
                                    <td>${this.name}</td>
                                    <td>${this.amount}</td>
                                </tr>
                            `;
                        other_tax_charges += temp;
                    });
                }
                div_data = `<table class="table table-striped" style="font-size: 18px;">
                                <tbody>
                                    <tr>
                                        <td>Item Total</td>
                                        <td>₹${data.item_total} ${data.add_ons_charges !==0 ? "+ ₹"+data.add_ons_charges :""}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount <b class="text-success">(${data.indivisual_discount_percent}%)</b> </td>
                                        <td>
                                            - ₹${data.discount}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>₹${data.sub_total}</td>
                                    </tr>
                                    
                                    ${other_tax_charges}

                                    <tr>
                                        <td>Packing Charges</td>
                                        <td>₹${data.packing_charges}</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>₹${data.total}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Round Of</td>
                                        <td>₹${data.round_of}</td>
                                    </tr>
                                    <tr style="font-weight:bold">
                                        <td>Today's Total</td>
                                        <td>₹${data.today_total}</td>
                                    </tr>
                                </tbody>
                            </table>`;
                $("#payment_details_div").html(div_data);
            }
        });
    }

    function delete_item(id) {
        event.preventDefault();
        let order_id = "<?php echo $_GET['orderid'] ?>";
        $.ajax({
            url: "delete_order_item.php?orderid=" + order_id,
            type: "POST",
            data: {
                "order_item_id": id
            },
            success: function(d) {
                render_order_items();
            }
        }).done(function() {});
    }

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && !isNaN(n - 0)
    }

    function add_new_item(id) {
        event.preventDefault();
        let data = $('#item_add_form_' + id).serializeArray();
        if (isNumber(data[2].value)) {
            let order_id = "<?php echo $_GET['orderid'] ?>";
            $.ajax({
                url: "add_new_item_to_order.php?orderid=" + order_id,
                type: "POST",
                data: data,
                success: function(d) {
                    console.log(d)
                    if (d == 1) {
                        render_order_items();
                    }
                    $("#searchData").val("");
                    $("#search_menu_block_id").html("");
                }
            }).done(function() {});
        } else {
            swal("Please Enter Number")
        }
    }

    function restrict_midification_after_bill_print() {
        let test = "<?php echo $get_order[0]['is_bill_printed'] ?>";
        if (test == 1) {
            $(".delete_on_bill_print").hide();
        }
    }

    render_order_items();

    function render_order_items() {
        let order_id = "<?php echo $_GET['orderid'] ?>"
        $.ajax({
            url: "ordered_item_api.php?orderid=" + order_id,
            success: function(d) {
                let menu = JSON.parse(d);
                console.log(menu)
                let div_data = "";
                let items_data = `<table class="table table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>QTY</th>
                            <th>Item Total</th>
                            <th>Cooking Instruction</th>
                            <th>Add Ons</th>
                            <th>Update QTY</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>`;
                if (menu.length > 0) {
                    $.each(menu, function() {
                        temp_items_data = ``;
                        temp_items_data = ` <tr>
                                                <td >
                                                    <h5 class="text-danger">${this.item_name}</h5>
                                                </td>
                                                <td>
                                                    <h5> ₹${this.price}</h5>
                                                </td>
                                                <td>
                                                    <h5> ${this.qnt}</h5>
                                                </td>
                                               <td>
                                                    <h5>₹${this.item_total}</h5>
                                               </td>
                                                <td>
                                                    <input type="text" class="form-control addCookingIns" name="${this.item_id}" placeholder="Cooking Instruction" value="${this.cooking_instruction}" style="width: 200px;height: 30px;">
                                                </td>
                                                <td>
                                                    <button 
                                                    style="${this.add_ons === 1 ? "display:black":"display:none"}"
                                                    title="Add-ons Item" type="submit" name="add-ons" onclick="addOnsView(${this.item_id})" data-toggle="modal" data-target="#myModaladdons" class="btn btn-danger btn-sm"><span class='glyphicon glyphicon-plus' style='color: white !important;'></span> </button>
                                                </td>
                                                <td>
                                                    <form class="form-inline delete_on_bill_print" method="post" action="index.php?orderid=${order_id}" style="float: right;margin-top:15px;">
                                                        <input type="hidden" name="order_item_id" value="${this.item_id}" >
                                                        <input type="hidden" name="item_unit_price" value="${this.price}" >
                                                        <div class="form-group">
                                                            <input type="number" min="1" name="updateQty" class="form-control" value="${this.qnt}" style="width: 90px;height: 30px;">
                                                        </div>
                                                        <button type="submit" name="update" class="btn btn-primary btn-sm">Update</button>
                                                    </form>
                                                </td>
                                                <td   class="">
                                                    <form onclick="delete_item(${this.item_id})" class="form-inline delete_on_bill_print" method="post" action="index.php?orderid=${order_id}" style="float: right;margin-top:15px;">
                                                        <input type="hidden" name="order_item_id" value="${this.item_id}">
                                                        <button title="Delete Item" type="submit" name="delete" class="btn btn-danger btn-sm"><span class='glyphicon glyphicon-trash' style='color: white !important;'></span> </button>
                                                    </form>
                                                </td>
                                            </tr>
                                       `;
                        items_data += temp_items_data;
                    });
                } else {
                    temp_items_data = `<h5 style="font-size: 12px;padding: 5px 0px;letter-spacing: 3px;font-weight: 500;text-align: center;">Please add some item in the order</h5> `;
                    items_data += temp_items_data;
                }
                let table_foot = `
                        </tbody>
                    </table>`;
                $("#render_order_items").html(items_data);
                render_amounts();
                restrict_midification_after_bill_print();
            }
        });
    }
</script>
<?php include('../../src/layout/foot.php'); ?>