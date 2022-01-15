<?php
include("../../src/query/query.php");
include("../../src/config/connection.php");


$order_id = $_GET["orderid"];



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

///////////********Get order data*********** */
$get_order = select("food_order", [
    "conditions" => [
        "id" => $order_id
    ],
    'join_many' => array(
        'food_order_item' => 'order_id',
    ),
    'join'=>[
        "food_menu_type"=>'order_type'
    ]
]);


/***********************Find add ons amount */
$total_add_ons_amount=0;
foreach($get_order[0]['food_order_item'] as $addons){
    $total_add_ons_amount+= $addons['addOnesAmout'];
}


//********************Find Discount amount(id any) */
$current_discount = 0;
if ($get_order[0]['indivisual_discount_percent'] > 0) {
    $percent_discout = $get_order[0]['indivisual_discount_percent'];
    $current_discount = ($get_order[0]['sub_total'] / 100) * $percent_discout;
    // $claculated_item_total = $get_order[0]['sub_total'] - $current_discount;
 } else {
    // $claculated_item_total = $get_order[0]['sub_total'];
    $current_discount = 0;
}


/***************Find Taxable amount***************** */
$taxable_amount=0;
if($get_order[0]['food_menu_type']['tax_applied_after_discount'] == 1){  // 1=Tax Applied after discount
    $taxable_amount=($get_order[0]['sub_total']+$total_add_ons_amount)-$current_discount;
    
}else{
    $taxable_amount=$get_order[0]['sub_total']+$total_add_ons_amount;
}





$tmp_tax_charges = get_total_tax_charges($taxable_amount);


$total_charge_data = [];
$total_charge_data["charges"] = $tmp_tax_charges['details'];
$total_charge_data["item_total"] = $get_order[0]['sub_total'];
$total_charge_data["total_charges"] = $tmp_tax_charges['total'];
$total_charge_data["discount"] = $current_discount;
/////************Calculate Todays Total************* */
$total_charge_data["total"] = ($get_order[0]['sub_total'] + $total_add_ons_amount + $tmp_tax_charges['total'] + $get_order[0]['packing_charges'])-$current_discount;

$final_subtotal=($get_order[0]['sub_total']+ $total_add_ons_amount )-$current_discount;

$responce = [];
$responce["item_total"] = number_format($get_order[0]['sub_total'], 2);
$responce["add_ons_charges"] = number_format($total_add_ons_amount, 2);
$responce["discount"] = number_format($total_charge_data["discount"], 2);
$responce["indivisual_discount_percent"] = number_format($get_order[0]['indivisual_discount_percent'], 2);
$responce["sub_total"] = number_format($final_subtotal, 2);
$responce["charges"] = $total_charge_data["charges"];
$responce["packing_charges"] = number_format($get_order[0]['packing_charges'], 2);

$responce["total"] = number_format($total_charge_data["total"] , 2);
$actual_total = ($total_charge_data["total"] );
$round_balance = round($actual_total) - $actual_total;
$responce["round_of"] = number_format($round_balance, 2);
$responce["today_total"] = number_format(round($total_charge_data["total"]), 2);
$order_data = array(
    "data" => array(
        "sub_total" => $get_order[0]['sub_total'],
        "add_ons_charges" => $total_add_ons_amount,
        "total_charges" => $total_charge_data["total_charges"],
        "indivisual_discount_percent" => $get_order[0]['indivisual_discount_percent'],
        "indivisual_discount" => $total_charge_data['discount'],
        "total" => round($total_charge_data["total"]),
    ),
);
$update_data_order_data = update('food_order', $order_data, $order_id);
echo json_encode($responce);