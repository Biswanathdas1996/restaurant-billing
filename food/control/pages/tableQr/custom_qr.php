<?php
// include('../../../db/query.php');





$link="https://www.google.com/search?q=scoop+of+happiness&oq=scoop+of+happ&aqs=chrome.0.0j69i57j0i22i30.3392j0j9&client=ms-android-oneplus-rvo3&sourceid=chrome-mobile&ie=UTF-8#wptab=s:H4sIAAAAAAAAAONgVuLVT9c3NEzLzSgoME0ufsTozS3w8sc9YSmnSWtOXmO04eIKzsgvd80rySypFNLjYoOyVLgEpVB1ajBI8XOhCvHsYuL3yU9OzAnIzwxKLctMLS9exCpVnJyfX6CQn6aQkVhQkJmXWlysUASRBABUTsTcjgAAAA";



$data = $link;


$size = '500x500';
// Path to image (web or local)
$logo = 'websiteQRCode_noFrame.png';

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
