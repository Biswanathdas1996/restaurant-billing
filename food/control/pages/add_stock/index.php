<?php include("../../src/config/includes.php");
echo Layout::bodyLayout();

$get_items = select("food_inventory_items", [
    'conditions' => array(
        "status" => 1,
    ),
    'join' => array(
        'units' => 'unit',
    )
]);




if (isset($_POST["item"])) {




    foreach ($_POST['item'] as $key => $val) {

        if(isset($_POST['item'][$key]) && $_POST['item'][$key] != null && $_POST['item'][$key] !==""){

            $itemId = $_POST['item'][$key];
            $qty = $_POST['qty'][$key];
            $price = $_POST['price'][$key];
            $date = $_POST['date'][$key];
    
            $get_previous_items = select('food_inventory_add', [
                "conditions" => [
                    "item" => $itemId
                ]
            ]);
            $total_prev_price = 0;
            $total_prev_qty = 0;
            foreach ($get_previous_items as $data) {
    
                $total_prev_price += $data['amount'];
                $total_prev_qty += $data['qty'];
            }
            $avg_price = ($total_prev_price + $price) / ($total_prev_qty + $qty);
            $data = array(
                "data" => array(
                    "item" => $itemId,
                    "qty" => $qty,
                    "amount" => $price,
                    "created" => $date,
                )
            );
            $insert_data = insert('food_inventory_add', $data);
    
    
            $id = $itemId;
            $data = array(
                "data" => array(
                    "avarage_price" => $avg_price,
                )
            );
            $update_data = update('food_inventory_items', $data, $id);
        }

        
    }






?>

    <script>
        swal("Success!", "Item Added successfully!", "success").then((value) => {
            window.location.replace('../stocks');
        });
    </script>
<?php

}


?>
<!--Write your code here-->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Add stock</div>

                <div class="panel-body">
                    <form action="" method="post">


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sel1">Select Item:</label>
                                    <select class="form-control sel1" id="sel1" name="item[]" >
                                        <option class="itemval" unit="..." value="">Select Item</option>
                                        <?php foreach ($get_items as $items) { ?>
                                            <option class="itemval" unit="<?php echo $items['units']['unit_name'] ?>" value="<?php echo $items["id"] ?>"><?php echo $items["name"] . " (" . $items['units']['unit_name'] . ")"  ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="Quantity">Quantity</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" step=".01" placeholder="Quantity" name="qty[]" >
                                    <!-- <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" style="width: 150px;" id="unit">...</button>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="Price">Total Price</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" style='width: 50px;box-shadow: none !important;padding: 10px;'>₹</button>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Price" name="price[]" step=".01" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="Price">Purchase Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Price" name="date[]" value="<?php echo date("Y-m-d");?>">
                                </div>
                            </div>
                        </div>


                        <div id="addons">


                        </div>



                        <br>
                        <button id="btn2" type="button" class="btn btn-info btn-lg"> <span class="glyphicon glyphicon-plus"></span>
                            &nbsp;&nbsp;Add More</button>
                        <br>
                        <br>
                        <div style="float: right">
                            <a href="../stocks">
                                <button type="button" class="btn btn-primary btn-lg"> Back</button>
                            </a>
                            <button type="submit" class="btn btn-success btn-lg"> Save </button>
                        </div>

                    </form>

                </div>
            </div>


        </div>
        <div class="col-md-1"></div>
    </div>
</div>



<script>
    $(".sel1").chosen();
    // $("#sel1").chosen();


    $(document).on('change', '.sel1', function() {
        var option = $('option:selected', this).attr('unit');
        $("#unit").html(option);

    });


    $(document).ready(function() {
        function addDiv() {
            let div = `<div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sel1">Select Item:</label>
                                    <select class="form-control sel1"  name="item[]" >
                                        <option class="itemval" unit="..." value="">Select Item</option>
                                        <?php foreach ($get_items as $items) { ?>
                                            <option class="itemval" unit="<?php echo $items['units']['unit_name'] ?>" value="<?php echo $items["id"] ?>"><?php echo $items["name"] . " (" . $items['units']['unit_name'] . ")" ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="Quantity">Quantity</label>
                                <div class="form-group">
                                    <input type="number" class="form-control" step=".01" placeholder="Quantity" name="qty[]" >
                                    
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="Price">Total Price</label>
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" style='width: 50px;box-shadow: none !important;padding: 10px;'>₹</button>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Price" name="price[]" step=".01" >
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="Price">Purchase Date</label>
                                <div class="form-group">
                                    <input type="date" class="form-control" placeholder="Price" name="date[]" value="<?php echo date("Y-m-d");?>">
                                </div>
                            </div>
                        </div>
                      `;

            $("#addons").append(div);
            $(".sel1").chosen();
        }


        $("#btn2").click(function() {
            addDiv();
        });

    });
</script>





<?php include('../../src/layout/foot.php'); ?>