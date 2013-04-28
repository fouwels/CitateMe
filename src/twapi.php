<?php
	require('lib/Twilio.php');
	include ('apiKeys.php')

	function respond($body)
	{
		header('Content-type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?><Response><Sms>'.$body.'</Sms></Response>';
	}	

    $twilio = new Services_Twilio($AccountSid, $AuthToken);

	// Request
	$from = $_POST['From'];
	$to = $_POST['To'];
	$body = $_POST['Body'];






?>