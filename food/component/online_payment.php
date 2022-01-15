<?php 
session_start();?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">

<?php
include('../db/query.php');;
include('head_includes.php');
$get_order_data=select('food_order' 
                        ,array(
                        'conditions'=>array(
                                "id"=>$_GET["order_id"],
                            )
                    )
                    );
    
    $amount=$get_order_data[0]['total'];
                   

// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$str = 'ASDFGHJKLPIUYTREWQZXCVBNM23456789';
$shuffled = str_shuffle($str);
$sub=substr($shuffled,0,5);
$_SESSION["capcha"]=$sub;

// Merchant key here as provided by Payu
$MERCHANT_KEY = "3ixb5KLn";

// Merchant Salt as provided by Payu
$SALT = "D4geUBBAEm";

// End point - change to https://secure.payu.in for LIVE mode
// $PAYU_BASE_URL = "https://secure.payu.in";
$PAYU_BASE_URL ="https://sandboxsecure.payu.in/_payment";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
  }
}
$formError = 0;
if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
</script>
<style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #65d1ac;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<body onload="submitPayuForm()">
<?php if($formError) { ?>
<span style="color:red">Please fill all mandatory fields.</span>
<?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payufrm">
        <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
        <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
        <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
        <input type="hidden" name="amount" value="<?php echo $amount; ?>" />
        <input type="hidden" name="firstname" id="firstname" value="john doe"/>
        <input type="hidden" name="email" id="email" value="daspapun22@gmail.com" />
        <input type="hidden" name="phone" id="contact_number" value="8001691299" />
        <input type="hidden" name="productinfo" id="proinfo" value="Food"/>
        
        <input type="hidden" name="surl" value="https://www.scanncatch.com/food/thank_you.php?order_id=<?php echo $get_order_data[0]['id']; ?>" size="64" />
        <input type="hidden" name="furl" value="https://www.scanncatch.com/food/thank_you.php?order_id=<?php echo $get_order_data[0]['id']; ?>" size="64" />
        <input type="hidden" name="service_provider" value="payu_paisa" size="64" />
<?php if(!$hash) { ?>
          <?php } ?>  
<button type="submit" class="btn btn-primary btn-lg pull-right" style="display:none; " value="Make Payment" >Pay Online</button>
</form>

<center style="margin-top: 20px;">
<div class="loader"></div>
<h2>Please Wait...</h2>
</center>
<script>
    $(document).ready(function(){
    $("#payufrm").submit();
});
</script>
