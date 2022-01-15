<?php
include("../db/query.php");
error_reporting(0);
$get_food_invoice_info = select("food_invoice_info");
$get_order = select("food_order", [
    "conditions" => [
        "id" => $_GET["id"]
    ],
    'join' => array(
        // 'payment_methods' => 'payment_method',
        "food_menu_type"=>'order_type'
    ),
    'join_many' => array(
        'food_order_item' => 'order_id',
        // 'food_order_item_addones'=>'order_id',
    ),
]);

// pr($get_order );

 ?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @page {
            size: 350pt 600pt;
            margin: 0;
        }

        body {
            font: Georgia, "Times New Roman", Times, serif;
            background: #fff;
            font-size: 11pt;
            letter-spacing: 1px;
        }

        .invoice-box {
            /* max-width: 800px; */
            max-width: 100%;
            margin: auto;
            padding: 30px;
            padding-left: 0px;
            padding-right: 0px;
            /*border: 1px solid #eee;*/
            /*box-shadow: 0 0 10px rgba(0, 0, 0, .15);*/
            font-size: 12px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #101010;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            /* font-weight: bold; */
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            /* font-weight: bold; */
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body style="max-width: 100%;margin:10px;padding-bottom: 5px;">
    <div class="invoice-box" style="background-color: white;width: 100%;margin-left: 0px;margin-right: 0px;padding-top: 0px;max-width: 100%;padding-bottom: 0px;">
        <div style="text-align: center;">
            <h4 style="margin-top: 0px;margin-bottom: 0px;font-size:12px;letter-spacing: 3px;"><?php echo $get_food_invoice_info[0]["name"]; ?></h4>
            <div style="font-size:10px; letter-spacing: 1px;margin-bottom: -10px;">
                <?php echo $get_food_invoice_info[0]["address"] . ", " . $get_food_invoice_info[0]["city"]; ?>,
                <?php echo $get_food_invoice_info[0]["state"] . "-" . $get_food_invoice_info[0]["pin"]; ?>
            </div>
            <span style="font-size:12px">Contact No: <?php echo $get_food_invoice_info[0]["contact_no"] ?></span>
            <div style="font-size: 13px;letter-spacing: 3px;margin-left:5px;text-align: center;">
                GST: <?php echo $get_food_invoice_info[0]["GST"]; ?>
            </div>
        </div>
        <div style="padding-bottom: 0px;font-size:13px;float: left;text-align: justify;margin-left:5px; font-weight:400">
            Bill No #: <?php echo $get_order[0]['id']; ?><br>
            <?php if ($get_order[0]['table_no'] != null || $get_order[0]['table_no'] != "") { ?>
                Table No #: <?php echo $get_order[0]['table_no']; ?><br>
            <?php } ?>
            Date: <?php echo $get_order[0]['date'] . " " . $get_order[0]['time']; ?><br>
        </div>
        <br><br>
        <?php if ($get_order[0]['orddr_note'] != "") { ?>
            <hr style="border: 1px dashed black;margin: 0;" />
            <div style="text-align:center;letter-spacing: 3px;">
                <?php echo $get_order[0]['orddr_note']; ?>
            </div>
            <hr style="border: 1px dashed black;margin-top: 0;" />
        <?php } ?>
        <table cellpadding="0" cellspacing="0" style="width: 100%;text-align: center;margin-top:25px;">
            <tr class="heading" style="font-size: 13px;">
                <td>
                    Item
                </td>
                <td>
                    QTY
                </td>
                <td>
                    Rate
                </td>
                <td>
                    Amount
                </td>
            </tr>
            <?php
            $subtotal = 0;
            foreach ($get_order[0]['food_order_item'] as $results) {
                $get_pro = select("food_demo", [
                    "conditions" => [
                        "id" => $results['item_id']
                    ]
                ])
            ?>
                <tr class="item" style="font-size: 13x;">
                    <td style="font-size: 12px;text-align: justify;">
                        <?php echo $get_pro[0]["title"]; ?>
                    </td>
                    <td style="text-align: center;width: 25px;">
                        <?php echo $results['qnt']; ?>
                    </td>
                    <td style="width: 25px;">
                        <?php echo $get_pro[0]["price"]; ?>
                    </td>
                    <td style="text-align: center;width: 25px;">
                        <?php
                        $tempsubtotal = ($get_pro[0]["price"] * $results['qnt']);
                        echo number_format($tempsubtotal, 2);
                        $subtotal += $tempsubtotal;
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
        ////****************************--Start of charges calculation-------/////     
        $get_all_charges = select('food_tax_charges', [
            "conditions" => [
                "status" => 1
            ]
        ]);
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
                    "referance" => $charge['amount'],
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
        $item_total = $subtotal;


        $taxable_amount = 0;
        if ($get_order[0]['food_menu_type']['tax_applied_after_discount'] == 1) {  // 1=Tax Applied after discount
            $taxable_amount = ($get_order[0]['sub_total'] + $get_order[0]['add_ons_charges']) - $get_order[0]['indivisual_discount'];
        } else {
            $taxable_amount = $get_order[0]['sub_total'] + $get_order[0]['add_ons_charges'];
        }


       


        $tmp_charges = get_total_tax_charges($taxable_amount);
        $total_amount = ($item_total + $tmp_charges['total']);
        $total_charge_data = [];
        $total_charge_data["charges"] = $tmp_charges['details'];
        $total_charge_data["item_total"] = $item_total;
        $total_charge_data["total_charges"] = $tmp_charges['total'];
        $total_charge_data["total"] = $total_amount;

        // pr($total_charge_data);
        /////////////////-------------------------end of charges calculation-------/////
        ?>
        <hr>
        <table style="line-height: 12px;margin-top: 5px; width: 100%;font-size: 13px;font-weight:400">
            <tr>
                <td>Item Total</td>
                <td><?php echo number_format($get_order[0]['sub_total'], 2) ?></td>
            </tr>
        </table>
        <hr>
        <table style="line-height: 12px;margin-top: 5px; width: 100%;font-size: 13px;font-weight:400">
            <tr>
                <td>Add-ons </td>
                <td><?php echo number_format($get_order[0]['add_ons_charges'], 2) ?></td>
            </tr>
            <tr>
                <td>Discount (<?php echo $get_order[0]['indivisual_discount_percent']; ?>%)</td>
                <td>-<?php echo number_format($get_order[0]['indivisual_discount'], 2); ?></td>
            </tr>
            <tr>
                <td>Sub Total</td>
                <td><?php echo number_format((($get_order[0]['sub_total']+$get_order[0]['add_ons_charges']) - $get_order[0]['indivisual_discount']), 2); ?></td>
            </tr>
            <?php
            foreach ($total_charge_data['charges'] as $charge) { ?>
                <tr>
                    <td>
                        <?php echo $charge['name'] . " (" . $charge['referance'] . "%)" ?>
                    </td>
                    <td>
                        <?php echo number_format($charge['value'], 2) ?>
                    </td>
                </tr>
            <?php }
            ?>
            <tr>
                <td>Pcking Charges</td>
                <td><?php echo number_format($get_order[0]['packing_charges'], 2); ?></td>
            </tr>
        </table>
        <hr style="border: 1px dashed black;" />
        <table style="font-size: 13px;letter-spacing: 2px;">
            <tr>
                <td>Today's Total</td>
                <td>Rs.<?php echo number_format($get_order[0]['total'], 2); ?></td>
            </tr>
        </table>
    </div>
    <hr />
    <center>
        <span style="text-align:center">Thank You, Visit Again !</span>
    </center>
    <hr />
    <script>
        window.print();
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>
</body>

</html>