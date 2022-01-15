<?php
$id=10;
// $link=base64_decode($_GET["ip"])."/food/invoice/index.php";
$link=base64_decode($_GET["ip"])."/food/invoice/download.php";
// 
$order_id=$_GET["order_id"];

// $link="http://192.168.0.108:3000/OflineResturent/food/invoice/index.php?id=8";
$encrypteddata=base64_encode(base64_encode(base64_encode(base64_encode(10))));
$data = $link.'?id='.$order_id;
$size = '500x500';
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

header('Content-type: image/png');
imagepng($QR);
imagedestroy($QR);
?>
