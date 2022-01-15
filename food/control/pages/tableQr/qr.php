<?php
// include('../../../db/query.php');


$id=$_GET["qr_id"];
$links=base64_decode($_GET["link"]);

$link=$links."/food/auth.php";

$encrypteddata=base64_encode(base64_encode(base64_encode(base64_encode($id))));


 

// $processdata=str_replace(' ',"`","$id");
// $encrypteddata = file_get_contents("https://developerspoint.in/e/?user=admin&value=$processdata");



$data = $link.'?data='.$encrypteddata;


$size = '500x500';
// Path to image (web or local)
$logo = 'in_qr_logo.jpg';

// Get QR Code image from Google Chart API
// http://code.google.com/apis/chart/infographics/docs/qr_codes.html
$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));

// START TO DRAW THE IMAGE ON THE QR CODE
$logo = imagecreatefromstring(file_get_contents($logo));
$QR_width = imagesx($QR);
$QR_height = imagesy($QR);

$logo_width = imagesx($logo);
$logo_height = imagesy($logo);

// Scale logo to fit in the QR Code
$logo_qr_width = $QR_width/3;
$scale = $logo_width/$logo_qr_width;
$logo_qr_height = $logo_height/$scale;

imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);


header('Content-type: image/png');
imagepng($QR);
imagedestroy($QR);


?>
