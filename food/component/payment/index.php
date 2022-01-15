<?php
// include('../../db/query.php');;
// include('../head_includes.php');
// $get_order_data=select('food_order' 
//                         ,array(
//                         'conditions'=>array(
//                                 "id"=>6,
//                             )
//                     )
//                     );
// $amount=$get_order_data[0]['total'];


if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';	
	if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);
	
	}
	exit(0);
}
 
function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return 'https://www.scanncatch.com/food/component/payment/response.php?order_id='.$_GET["order_id"];
}

?>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>-->

<!-- BOLT Sandbox/test //-->
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e23744" bolt-logo="https://www.scanncatch.com/food/component/payment/images/icon.png"></script>
<!-- BOLT Production/Live //-->
<!--<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>-->
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
    <div class="main">
    	<form action="#" id="payment_form">
        <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
        <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
        <div class="dv">
        <span><input type="hidden" id="key" name="key" placeholder="Merchant Key" value="3ixb5KLn" /></span>
        </div>
        <div class="dv">
        <span><input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="D4geUBBAEm" /></span>
        </div>
        <div class="dv">
        <span><input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
        </div>
        <div class="dv">
        <!--<span class="text"><label>Amount:</label></span>-->
        <span><input type="hidden" id="amount" name="amount" placeholder="Amount" value="<?= $total_amount ?>" /></span>    
        </div>
        <div class="dv">
        <!--<span class="text"><label>Product Info:</label></span>-->
        <span><input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="food" /></span>
        </div>
        <div class="dv">
        <!--<span class="text"><label>First Name:</label></span>-->
        <span><input type="hidden" id="fname" name="fname" placeholder="First Name" value="Biswanath" /></span>
        </div>
        <div class="dv">
        <!--<span class="text"><label>Email ID:</label></span>-->
        <span><input type="hidden" id="email" name="email" placeholder="Email ID" value="daspapun22@gmail.com" /></span>
        </div>
        <div class="dv">
        <!--<span class="text"><label>Mobile/Cell Number:</label></span>-->
        <span><input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="8001691299" /></span>
        </div>
        <div class="dv">
        <!--<span class="text"><label>Hash:</label></span>-->
        <span><input type="hidden" id="hash" name="hash" placeholder="Hash" value="" /></span>
        </div>
        
            <button 
             style="float: right;padding: 8px 15px;background-color: white;border-color: #e23744;border-radius: 0px;color: #515050;"
             type="button" 
             class="btn btn-info" 
             onclick="launchBOLT(); return false;"
             >Pay Online</button> 
             
          
            
            
    	</form>
    </div>
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
          url: 'component/payment/index.php',
          type: 'post',
          data: JSON.stringify({ 
            key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
		    pinfo: $('#pinfo').val(),
            fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val()
          }),
		  contentType: "application/json",
          dataType: 'json',
          success: function(json) {
            if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
            }
			else if (json['success']) {	
				$('#hash').val(json['success']);
            }
          }
        });
});
//-->
</script>
<script type="text/javascript"><!--
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(), 
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'	
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );		
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);								
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
</script>	


	
