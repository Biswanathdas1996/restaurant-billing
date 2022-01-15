<?php
include('../../src/query/query.php');
$datas = array();
$get_order_data = select(
    'food_order',
    array(
        'conditions' => array(
            "id" => $_GET["id"],
        ),
        'join_many' => array(
            'food_order_item' => 'order_id',
        ),
    )
);



$get_data = [];
$subtotal=0;
foreach ($get_order_data[0]['food_order_item'] as $key => $value) {
    if ($value > 0) {
        $temp_data = [];
        $temp_get_data = select(
            'food_demo',
            array(
                'conditions' => array(
                    "id" => $value['item_id']
                )
            )
        );
        
        $subtotal+=($temp_get_data[0]['price']*$value['qnt']);

        $temp_data["id"] = $temp_get_data[0]['id'];

        if (isset($temp_get_data[0]['cooking_instruction']) && $temp_get_data[0]['cooking_instruction'] != null) {
            $temp_data["cookong_ins"] = $temp_get_data[0]['cooking_instruction'];
        } else {
            $temp_data["cookong_ins"] = null;
        }


        $temp_data["title"] = $temp_get_data[0]['title'];
        $temp_data["type"] = $temp_get_data[0]['type'];
        $temp_data["special"] = $temp_get_data[0]['special'];
        $temp_data["category"] = $temp_get_data[0]['category'];

        if (isset($temp_get_data[0]['non_veg']) && $temp_get_data[0]['non_veg'] != null) {
            $temp_data["non_veg"] = $temp_get_data[0]['non_veg'];
        } else {
            $temp_data["non_veg"] = null;
        }
        $temp_data["price"] = $temp_get_data[0]['price'];
        $temp_data["discounted_price"] = $temp_get_data[0]['discounted_price'];
        $temp_data["status"] = $temp_get_data[0]['status'];
        $temp_data["img"] = $temp_get_data[0]['img'];
        $temp_data["description"] = $temp_get_data[0]['description'];
        $temp_data["order_qnt"] = $value['qnt'];
        $temp_data["order_item"] = $value;
        

        $find_add_ons=select("food_order_item_addones",[
                        "conditions"=>[
                                "order_item_id"=>$value["id"]
                            ],
                            'join' => array(
                                    'food_menu_item_addones'=>'add_ones_id',
                                ),
                    ]);
                    
        $temp_data["add_ons"]= $find_add_ons;


        
        
        
        
        $get_data['data'][] = $temp_data;
    }
}



$get_orrder_amouts = select("food_order", [
    "conditions" => [
        "id" => $_GET["id"]
    ]
]);





    // $s_total_amount = $get_orrder_amouts[0]['sub_total'];
    $s_total_amount = $subtotal;

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
            $balance_amount = number_format($balance_amount, 2);
        } else {
            $balance_amount = number_format($balance_amount, 2);
        }


        $temp_array = array(
            "name" => $charge['name'],
            "amount" => $balance_amount,
            "value" => $ch_value,
            "charge_or_discount" => $charge['charge_or_discount'],
            "type" => $charge['type']
        );
        $final_array["details"][] = $temp_array;
    }
    $get_orrder_charges = $final_array["details"];
    ///////////////////////////////////////////////////////////////////////////////////////
    $get_data["total"] = $total_amount = number_format(($s_total_amount + $s_t_discount - $get_orrder_amouts[0]['indivisual_discount']), 2);
    $get_data["note"]= $get_order_data[0]['orddr_note'];
    
if ($get_order_data[0]["payment_status"] == 0) {    
    $get_data["txt"] = "Payment Due";
   
} else {
    

    $get_data["txt"] = "Paid";
}


$get_data["discount"] = $get_orrder_amouts[0]['indivisual_discount'];

$get_data["Order_id"] = $get_order_data[0]['id'];

$get_data["order_token"] = $get_order_data[0]['token'];

$get_data["cooking_instruction"] = $get_order_data[0]['cooking_instruction'];
$get_data["table_no"] = $get_order_data[0]['table_no'];

$get_data["item_total"] = $subtotal;
$get_data["charges_total"] = $get_orrder_amouts[0]['total_charges'];
$get_data["charges"] = $get_orrder_charges;

$get_data["order_date"] = $get_orrder_amouts[0]['date'] . "-" . $get_orrder_amouts[0]['time'];

$get_data["discount"] = $get_orrder_amouts[0]['indivisual_discount'];






$invoice_address_data = select('food_invoice_info', [
    "conditions" => [
        "status" => 1
    ]
]);
$get_data["invoice_data"] = $invoice_address_data[0];


//   pr($get_data);
//   die;

echo json_encode($get_data);
