<?php
error_reporting(0);

include("../db/query.php");

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

// pr($get_order);
?>



<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice</title>

    <style>
        @page {
            size: 211pt 600pt;
            margin: 0;
        }

        body {
            font: Georgia, "Times New Roman", Times, serif;
            background: #fff;
            font-size: 11pt;
            letter-spacing: 1px;
        }

        .invoice-box {
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
            font-weight: bold;
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
            font-weight: bold;
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

        /** RTL **/
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

<body style="max-width: 100%;margin:0px;padding-bottom: 5px;">
    <div class="invoice-box" style="background-color: white;width: 100%;padding-top: 0px;padding-bottom: 0px;">


        <hr style="border: 1px dashed black;margin: 0;" />
        <div style="text-align:center;letter-spacing: 3px;">
            <?php echo $result['note']; ?>
        </div>
        <hr style="border: 1px dashed black;margin-top: 0;" />


        <table cellpadding="0" cellspacing="0" style="width: 100%;">
            <tr>
                <td colspan="2">
                    <table>
                        <tr>
                            <td style="padding-bottom: 0px;">
                                <div>
                                    Bill No #: <?php echo $get_order[0]["id"]; ?><br>
                                    Table: <?php echo $get_order[0]["table_no"]; ?><br>
                                    Date: <?php echo $get_order[0]["date"]; ?><br>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading" style="text-align: center;">
                <td style="font-size: 12px;text-align: justify;">
                    Item
                </td>
                <td style="text-align: center;">
                    QTY
                </td>
            </tr>
            <?php foreach ($get_order[0]["food_order_item"] as $results) { 
                
                $get_item=select("food_demo",[
                    "conditions"=>[
                        "id"=>$results['item_id']
                    ]
                ]);

                $get_add_ons=select('food_order_item_addones',[
                    "conditions"=>[
                        "order_item_id"=>$results["id"]
                    ],
                    'join'=>[
                        "food_menu_item_addones"=>'add_ones_id'
                    ]
                ]);

                // pr($get_add_ons);
                
                ?>
                <tr class="item">
                    <td>
                        <table >
                            <tr>
                                <td style="text-align: justify;border-bottom: none;padding: 0px;">
                                    <div style="font-size: 13px;text-align: justify;"><?php echo $get_item[0]['title']; ?></div>
                                    <?php if ($results['cooking_instruction'] != null) { ?>
                                        <div style="font-size: 10px;text-align: justify;font-weight: bold;">(<?php echo $results['cooking_instruction']; ?>)</div>
                                    <?php } ?>
                                    <?php if (count($get_add_ons)>0) { 
                                        echo "Add-ons: <ol>";
                                        foreach($get_add_ons as $add_ons){ 
                                            echo "<li>".$add_ons['food_menu_item_addones']['name']."</li>";

                                        }
                                        echo "</ol>";
                                        ?>
                                        
                                    <?php } ?>


                                    
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="font-size: 10px;text-align: center;">
                        <?php echo $results['qnt']; ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <hr />
        <hr />
    </div>


    <script>
        window.print();
        setTimeout(function() {
            window.close()
        }, 2000);
    </script>

    
</body>

</html>