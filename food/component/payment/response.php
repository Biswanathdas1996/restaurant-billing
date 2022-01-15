<?php
include('../../db/query.php');;
include('../head_includes.php');

$postdata = $_POST;
// $msg = '';
if (isset($postdata ['key'])) {
	$key				=   $postdata['key'];
	// $salt				=   $postdata['salt'];
	$txnid 				= 	$postdata['txnid'];
    $amount      		= 	$postdata['amount'];
	$productInfo  		= 	$postdata['productinfo'];
	$firstname    		= 	$postdata['firstname'];
	$email        		=	$postdata['email'];
	$udf5				=   $postdata['udf5'];
	$mihpayid			=	$postdata['mihpayid'];
	$status				= 	$postdata['status'];
	$resphash				= 	$postdata['hash'];
	//Calculate response hash to verify	
	$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
	$keyArray 	  		= 	explode("|",$keyString);
	$reverseKeyArray 	= 	array_reverse($keyArray);
	$reverseKeyString	=	implode("|",$reverseKeyArray);
	// $CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
	
	
	// if ($status == 'success'  && $resphash == $CalcHashString) {
	// 	$msg = "Transaction Successful and Hash Verified...";
	// 	//Do success order processing here...
	// }
	// else {
	// 	//tampered or failed
	// 	$msg = "Payment failed for Hasn not verified...";
	// } 
}
// else exit(0);
?>

<?php 
if(isset($_GET["order_id"]) && $_GET["order_id"] !=null){
        $id=$_GET["order_id"];
        $data=array(
        "data"=>array(
                "payment_status"=>1,
                "txn_id"=>$txnid,
            ),
        );
        $update_payment_status=update('food_order',$data,$id);
        
        
        $s_total_amount=get_order_items_total_amount($id);//function is in head_include.php
        $tax=tax_calculation($s_total_amount);
                          foreach($tax['details'] as $charge){
                            $data_charge=[];  
                             $data_charge=array(
                                "data"=>array(
                                        "order_id"=>$id,
                                        "name"=>$charge['name'],
                                        "amount"=> $charge['amount'],
                                        "charge_or_discount"=>$charge['charge_or_discount'],
                                        "created"=>date("Y-m-d"),
                                    ),
                                );
                            $insert_charge_datas = insert('food_order_charges',$data_charge);
                          }
        
        
        
        
        $get_order_data=select('food_order',[
                "conditions"=>[
                    "id"=>$_GET["order_id"]
                    ]
                ]);
                
                
                
            $get_emails=select('food_email_notification',[
            "conditions"=>[
                "event"=>"Online Paid"
                ]
            ]);
            
               
        foreach($get_emails as $mail){
                $to = $mail['email'];
                $subject="Online Paid - Order Id: ".$_GET["order_id"];
                
                $link=getenv('HTTP_BASE_PATH')."food/invoice/index.php?id=".$_GET["order_id"];
                
                $message =file_get_contents($link);;
                
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                
                // More headers
                $headers .= 'From: <webmaster@scanncatch.com>' . "\r\n";
                $headers .= 'Cc: myboss@scanncatch.com' . "\r\n";
                
                send_mail($to,$subject,$message,$headers);
                
                $text="Paid Online (Id: ".$_GET["order_id"]."), Time: ".date("Y-m-d")." :: ".date ('H:i:s', time())." Invoice: ".$link;
                send_sms($mail['phone_no'],$text);
                
          }
        
}
    
?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
	}
</style>
<body>
<div class="main">
	<div>
    	<img src="images/payumoney.png" />
    </div>
    <div>
    	<h3>PHP7 BOLT Kit Response</h3>
    </div>


<script>
    $(document).ready(function(){
     window.location.replace("../../thank_you.php?order_id="+<?php echo $id;?>);
    });
 
</script>

</body>
</html>
	