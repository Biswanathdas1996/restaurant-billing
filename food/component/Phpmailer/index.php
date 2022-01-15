<?php
	require 'PhpMailer/PHPMailerAutoload.php';
	
	$mail = new PHPMailer;
	//$mail->isSMTP();
	$mail->Host="scanncatch.com";
	$mail->Port="21513";
	$mail->SMTPAuth=true;
	$mail->SMTPSecure = 'tls';
	
	$mail->Username ="info@scanncatch.com";
	$mail->Password =";-xhFtt)#5M7";

	$mail->setFrom('info@scanncatch.com',"Scan n Catch");
	$mail->addAddress('daspapun22@gmail.com');
	$mail->addReplyTo('info@scanncatch.com');
	$mail->isHtml(true);
	$mail->Subject ="PHP test";
	$mail->Body="<h1>Hiiiiii</h1>";
	$mail->send();
?>