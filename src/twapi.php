<?php
	require('lib/Twilio.php');
	include ('apiKeys.php');

	function respond($responseBody)
	{
		header('Content-type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8"?><Response><Sms>'.$responseBody.'</Sms></Response>';
	}	

    $twilio = new Services_Twilio($AccountSid, $AuthToken);

	// Request
	$from = $_POST['From'];
	$to = $_POST['To'];
	$body = $_POST['Body'];

	if (strpos($body,"--ECHO") !== false || strpos($body,"--echo") !== false) {

		respond("Echo..."."$body");
	}

	$curl = curl_init();
	$url = "https://www.googleapis.com/books/v1/volumes?q=intitle="$Body."&key=".$GbooksApiKey;

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');

	$output = curl_exec($curl);
	$outputDecoded = json_decode($output, 1);

	$author = $outputDecoded["items"][0]["volumeInfo"]["authors"][0];
	$authorsFirst;
	$authorsMiddle;
	$authorsLast;
	$title = $outputDecoded["items"][0]["volumeInfo"]["title"];
	$subtitle = $outputDecoded["items"][0]["volumeInfo"]["subtitle"];
	$publisher = $outputDecoded["items"][0]["volumeInfo"]["publisher"];
	$yearPub = $outputDecoded["items"][0]["volumeInfo"]["publishedDate"];
	$authorExploded = explode(" ", $author);

	if(sizeof($authorExploded) == 3){
		$authorsFirst = $authorExploded[0];
		$authorsMiddle = $authorExploded[1];
		$authorsLast = $authorExploded[2];
	}
	elseif(sizeof($authorExploded) == 2){
		$authorsFirst = $authorExploded[0];
		$authorsMiddle = "";
		$authorsLast = $authorExploded[1];
	}
	else{
		$authorsFirst = $authorExploded[0];
		$authorsMiddle = "";
		$authorsLast = "";
	}	

	if (strpos($body,"--MLA") !== false || strpos($body,"--apa") !== false) {
		respond($authorsLast.", ".$authorsFirst." ".substr($authorsMiddle, 0, 1).". ".$title.". ".$publisher.", ".$yearPub.".");
	}
	elseif (strpos($body,"--APA") !== false || strpos($body,"--mla") !== false){		
		respond($authorsLast.", ".substr($authorsFirst, 0, 1).". ".substr($authorsMiddle, 0, 1)." (".$yearPub.") ".$title.". ".$publisher.".");
	}
	else{
		respond("**** You must specify a format by including either --MLA or --APA in the message. [Default is --MLA] ****");
	}	

?>