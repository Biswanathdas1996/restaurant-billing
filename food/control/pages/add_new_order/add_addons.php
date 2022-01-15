<?php
include("../../src/config/includes.php");
include("../../src/config/connection.php");
echo Layout::BaseLayout(); 

$order_id = $_GET["order_id"];
$order_item_id = $_GET["itemid"];

$get_item_details = select("food_order_item", [
    "conditions" => [
        "id" => $order_item_id
    ]
]);
$get_addons = select("food_menu_item_addones", [
    "conditions" => [
        "food_item_id" => $get_item_details[0]['item_id']
    ]
]);
$item_id = $get_item_details[0]['item_id'];


////**********************************addd*******************************
if (isset($_POST["add_ones_id"])) {
    $datas = array(
        "data" => array(
            "order_id" => $_POST["order_id"],
            "order_item_id" => $_POST["order_item_id"],
            "item_id" => $_POST["item_id"],
            "add_ones_id" => $_POST["add_ones_id"]
        )
    );
    $insert_data = insert('food_order_item_addones', $datas);
    $get_foot_item_temp = select("food_order_item", [
        "conditions" => [
            "id" => $_POST["order_item_id"]
        ]
    ]);
    $totalAddons = $get_foot_item_temp[0]["addOnesAmout"] + $_POST["amount"];
    $data_update_order_items = array(
        "data" => array(
            "addOnesAmout" => $totalAddons
        )
    );
    $update_data = update('food_order_item', $data_update_order_items, $_POST["order_item_id"]);
    die;
}
///****************************Delete*********************************** */

if (isset($_POST["delete_add_ones_id"])) {
    $delete_data_select = select('food_order_item_addones', [
        "conditions"=>[
            "order_id" => $_POST["order_id"],
            "order_item_id" => $_POST["order_item_id"],
            "item_id" => $_POST["item_id"],
            "add_ones_id" => $_POST["delete_add_ones_id"]
        ]
    ] );
    $delete_data = delete('food_order_item_addones', [
        "id"=>$delete_data_select[0]["id"]
    ]);
    $get_foot_item_temp = select("food_order_item", [
        "conditions" => [
            "id" => $_POST["order_item_id"]
        ]
    ]);
    $getall_data_select = select('food_order_item_addones', [
        "conditions"=>[
            "order_id" => $_POST["order_id"],
            "order_item_id" => $_POST["order_item_id"],
            
        ],
        'join' =>array(
                'food_menu_item_addones'=>'add_ones_id',
            ), 
    ] );
        $qty=$_POST["qty"];
        $current_amount=0;
        foreach($getall_data_select as $count){
            $current_amount+=$qty*$count['food_menu_item_addones']['amount'];
    }
    $data_update_order_items = array(
        "data" => array(
            "addOnesAmout" =>$current_amount
        )
    );
    $update_data = update('food_order_item', $data_update_order_items, $_POST["order_item_id"]);
    
    die;
}
/////////////////*************************************************************** */


$get_added_addons = select("food_order_item_addones", [
    "conditions" => [
        "order_item_id" => $order_item_id
    ]
]);
$validate = [];
foreach ($get_added_addons as $create) {
    array_push($validate, $create["add_ones_id"]);
}


// pr($get_added_addons);
// pr($get_item_details);
// pr($get_addons);
?>
<center>
    <table style="width:100%" class="table">
        <?php foreach ($get_addons as $val) {


        ?>
            <tr style="margin-top:10px">
                <td style="font-weight: bold;padding:10px;margin-top:10px"> <?php echo $val["name"]; ?></td>
                <td style="padding:10px;margin-top:10px">Unit: ₹<?php echo $val["amount"]; ?></td>
                <td style="padding:10px;margin-top:10px">Qnt: <?php echo $get_item_details[0]['qnt']; ?></td>
                <td style="padding:10px;margin-top:10px">Total : ₹<?php echo $amount = $val["amount"] * $get_item_details[0]['qnt']; ?></td>
                <td style="">
                    <?php if (!in_array($val["id"], $validate)) { ?>
                        <button 
                           style="padding: 10px;margin-top: 10px;"
                            title="Add-ons Item" type="submit" name="add-ons" onclick="addOnes(<?php echo $val['id']; ?>,<?php echo $amount; ?>)" data-toggle="modal" data-target="#myModaladdons"
                             class="btn btn-Success btn-sm addbtn">
                            <span class='glyphicon glyphicon-plus' style='color: white !important;'> Add</span> 
                        </button>
                   
                    <?php } else { ?>
                        <button type="button" onclick="deleteAddons(<?php echo $val['id']; ?>,<?php echo $amount; ?>)" class=" btn btn-danger btn-sm addbtn" style="padding: 10px;margin-top: 10px;">
                        <span class='glyphicon glyphicon-trash' style='color: white !important;'> Delete</span> 
                        </button>
                    <?php } ?>

                </td>
            </tr>

        <?php

        } ?>
        <tr>

        </tr>
    </table>

</center>





</div>
</div>

<script>
    function addOnes(id, amount) {
        let order_id = "<?php echo $order_id; ?>"
        let order_item_id = "<?php echo $order_item_id; ?>"
        let item_id = "<?php echo $item_id; ?>"
        $.ajax({
            type: "POST",
            url: "add_addons.php",
            data: {
                add_ones_id: id,
                order_id: order_id,
                order_item_id: order_item_id,
                item_id: item_id,
                amount: amount
            },
            success: function(result) {
                window.location.reload()
            }
        });
    }



    function deleteAddons(id, amount) {
        let order_id = "<?php echo $order_id; ?>"
        let order_item_id = "<?php echo $order_item_id; ?>"
        let item_id = "<?php echo $item_id; ?>";
        let qty = "<?php echo $get_item_details[0]['qnt']; ?>";
        $.ajax({
            type: "POST",
            url: "add_addons.php",
            data: {
                delete_add_ones_id: id,
                order_id: order_id,
                order_item_id: order_item_id,
                item_id: item_id,
                amount: amount,
                qty: qty
            },
            success: function(result) {
                window.location.reload()
            }
        });
    }
</script>