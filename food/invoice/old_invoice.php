<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, getenv('HTTP_BASE_PATH').'food/control/pages/ajax_api/ajax_modal_data.php?id='.$_GET["id"]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$result=json_decode($result,true);

// echo "<pre>";
// print_r($result);
// echo "</pre>";

?>



<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
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
    
    .invoice-box table tr.item td{
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

<body style="min-width: 350px; font-size: 1px; line-height: normal;"> 
    <div class="invoice-box" style="background-color: white;">
        <table cellpadding="0" cellspacing="0" style="padding: 20px;">
            <tr class="top">
                <td colspan="2">
                    <table >
                        <tr>
                            <td class="title">
                                <center>
                                    <?php
                                    $image_base64 = base64_encode(file_get_contents(getenv('HTTP_BASE_PATH')."food/control/pages/invoice/food_invoice_info_logo/".$result['invoice_data']['logo']) );
                                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                                    
                                    ?>
                                    
                                    
                                    <img src="<?= $image?>" 
                                         style="width:100%; max-width:130px;">
                                </center>
                            </td>
                            
                            <td style="padding-bottom: 0px;">
                                <div>
                                    Invoice #: <?php echo $result['Order_id']; ?><br>
                                    Created: <?php echo $result['order_date']; ?><br>
                                    Table No: <?php echo $result['table_no']; ?>
                                </div>
                                <br>
                                <div>
                                    <?php echo $result['invoice_data']['address'];?><br>
                                    <?php echo $result['invoice_data']['city'];?>,<?php echo $result['invoice_data']['state'];?><br>
                                    <?php echo $result['invoice_data']['country'];?>,<?php echo $result['invoice_data']['pin'];?><br>
                                    Contact: <?php echo $result['invoice_data']['contact_no'];?>
                                </div>
                                
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
           
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Status
                </td>
                
                <td>
                    <?php echo $result['txt']; ?>
                </td>
            </tr>
            
            
            <tr class="heading">
                <td>
                    Item
                </td>
               
                <td>
                    Price
                </td>
            </tr>
            
            
             <?php foreach($result['data'] as $results){?> 
             
             <tr class="item">
                <td>
                <table style="width: 50%;">
                    <tr>
                        <!--<td style="border-bottom: none;">-->
                        <!--</td>-->
                        <td style="text-align: justify;border-bottom: none;">  
                            <p style="margin-bottom: 0px;margin-top: 0px;text-align: justify;font-weight: bold;font-size: 13px;"><?php echo $results['title'];?></p>
                            <!--<span style="margin-bottom: 0px;margin-top: 0px;text-align: justify;font-size: 10px;" class="dish-meta">In <?php echo $results['type']?></span>-->
                            
                        </td>
                    </tr>
                    
                </table>
                </td>
                 
                <td>
                   Rs. <?php echo $results['price']?> <b> X </b><?php echo $results['order_item']['qnt'];?>
                </td>
            </tr>
            
            <?php } ?> 
            
            
            
            
            <tr class="heading">
                <td>
                    Item
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    Item Total
                </td>
                
                <td>
                    Rs. <?php echo $result['item_total']; ?>
                </td>
            </tr>
            
            <?php
            if(!empty($result['charges'])){
            foreach ($result['charges'] as $charges){?>
            
            <tr class="item">
                <td>
                  <?php echo   $charges['name'];?>
                </td>
                
                <td>
                    Rs. <?php echo   number_format($charges['amount'],2);?>
                </td>
            </tr>
            
            <?php }
            }
            ?>
            <tr class="item">
                <td>
                  Discount
                </td>
                
                <td>
                    Rs. <?php echo   $result['discount'];?>
                </td>
            </tr>
            
          
            <tr class="total">
                <td></td>
                
                <td>
                   Total: Rs. <?php echo $result['total']-$result['discount']; ?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
