<?php
/**
* SMS FEEDBASCK TEST SCRIPT
*
*/

//check if from and text are provided by the push url
if(isset($_GET['from']) && isset($_GET['text']) ){
	$from = $_GET['from'];
	$text = $_GET['text'];
	
	//split the text to get request, admno, year and term
	$pieces = explode(",", $text);
	$request= $pieces[0]; // request either fees or report forms
	$admno= $pieces[1]; // admno no
	$yr= $pieces[2]; // year
	$term= $pieces[3]; // term.
	
	 $ekey="ntsdssLs5A2e";// SMS API ecryption key >> provided by Airtouch
	 $pass=md5($from.$ekey);
	 
	 
	 $testFeedbackMessage="SMS REQUEST ".$text;
		//automatically execute send sms by calling Airtouch sms api
		// Prepare data for POST request
		$data = "target=MaryLeakey&msisdn=" . $from . "&text=" . urlencode($testFeedbackMessage) . "&login=maryleakey&pass=" . $pass;
 
		// Send the GET request with cURL
		$ch = curl_init('http://api.sms.bambika.co.ke:8555/?' . $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
	
		//save the request to database
		//$activity = "SMS REQUEST";
	 	//$usename=$from."-Admno not found".$admno;
       // $func->addAuditTrail($activity,$usename);
		
		curl_close ($ch);
		
}

?>
