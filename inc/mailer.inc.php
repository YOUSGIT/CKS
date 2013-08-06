<?php

$out = ob_get_contents();

ob_end_clean();

//echo '<!--'.$out.'-->';


//error_reporting(E_ALL);
//error_reporting(E_STRICT);

//date_default_timezone_set('America/Toronto');
$hostname	='CKS Stationery Corporation';
$hostemail	='cksgp@cksgroup.com';

include_once(_ROOT.'inc/PHPMailer_v5.1/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

//$body           = file_get_contents('./mail/mail_contact_server.php?');

$body			  = $out;
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "smtpout.secureserver.net";		// SMTP server
//$mail->SMTPDebug  = 2;                     	// enables SMTP debug information (for testing)
											// 1 = errors and messages
$mail->CharSet 	  = "utf-8"; //設定郵件編碼 											// 2 = messages only
$mail->SMTPAuth   = true;                  	// enable SMTP authentication
$mail->SMTPSecure = "http";
$mail->Host       = "smtpout.secureserver.net"; 		// sets the SMTP server
$mail->Port 	  = 80;                   // set the SMTP port for the GMAIL server

$mail->Username   = "cksgp@cksgroup.com"; // SMTP account username
$mail->Password   = "O92dgm9y";        		// SMTP account password

$mail->SetFrom($hostemail	, $hostname	);

$mail->AddReplyTo($hostemail,	$hostname);

$mail->Subject    = $_POST['Subject'];

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

// $address = $_POST['email'];
$address = "sales@cks.com.tw";
$mail->AddAddress($address, $_POST['name']);

//$mail->AddAttachment("images/phpmailer.gif");      // attachment
//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
	$title="Error: Please try again later!";
//	echo $title . $mail->ErrorInfo;
} else {
	$title="Thanks for Your Comment!";
//	echo $title;
}
