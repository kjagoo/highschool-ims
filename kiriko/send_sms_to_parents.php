<?php
ini_set('max_execution_time', 0);

	
if(isset($_POST['to']) && isset($_POST['form']) && isset($_POST['stream'])&& isset($_POST['message']) ){
 require_once('auth.php');
 include("includes/dbconnector.php");
include 'includes/functions.php';
$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Sent SMS to ".$_POST['to'];
$func->addAuditTrail($activity,$username);

include 'includes/SMSConfig.php';
$smsconfig = new SMSConfig();

foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
	
	$to=$_POST['to'];
	$form=$_POST['form'];
	$stream=$_POST['stream'];
	$msg=$_POST['message'];
	
	$numbers=array();
	 $prefix='254';
	 
	 
	if($stream=='all'){
	$query="select admno from studentdetails where form='$form'";
	}else{
	$query="select admno from studentdetails where form='$form' and class='$stream'";
	}
	$resulta = mysql_query($query);
		while ($rowa = mysql_fetch_array($resulta)) {
		$admno=$rowa['admno'];
		
		
		//now get the parent telephone number
			$resulttels = mysql_query("SELECT telephone FROM parentdetails where admno='$admno'");
			while ($rowtel = mysql_fetch_array($resulttels)) {
			$parenttel=$rowtel['telephone'];
			//array_push($numbers, $prefix.$parenttel);
					
		if($parenttel!= 0) {
		// send SMS to the parent
			//for ($key_Number = 0; $key_Number <count($numbers); $key_Number++) {
			//echo $numbers[$key_Number].'<br/>';
			$msisdn=$prefix.$parenttel;//Posted from a developed UI 
			$messages= urlencode(stripslashes($msg));// the message to the recepients
			//parameters		
				//open connection
			//$api_url = 'http://api.bulki.bambika.co.ke:83/send.pl';
			$pass=md5($msisdn.$ekey);
		
		//open connection
			$ch = curl_init();
			 //set the url, number of POST vars, POST data
		//curl_setopt($ch, CURLOPT_URL, $api_url.'?target=22906&msisdn='.$msisdn.'&text='.$messages.'&login=rarakwagirls&pass='.$pass);
		curl_setopt($ch, CURLOPT_URL, $api_url.'target='.$target.'&msisdn='.$msisdn.'&text='.$messages.'&login='.$login.'&pass='.$pass);

			
			//execute post
				$result = curl_exec($ch);
						  
				if($result){
				//echo reminder has been sent
				$activity = "Sent SMS to ".$msisdn;
				$func->addAuditTrail($activity,$username);
				
				$date=date("Y-m-d");
				$query="insert into sent_messages (msg_to,message,date_sent,sender) values('$msisdn','$messages','$date','$username')";
				 $resultin = mysql_query($query);
				 
				 }
			echo "<br/>";
				 //close connection
						  curl_close($ch);
		}//end of number not zero check
		}//end of sending one sms to a parent
		}//end while get admno
	
	?>
 <script language="javascript">alert('Message have been sent')</script>
 <script language="javascript">window.history.go(-1)</script>
 <?php
	
	
	
 }else{//end of ppost check
 ?>
 <script language="javascript">alert('Please provide all the required details')</script>
 <script language="javascript">window.history.go(-1)</script>
 <?php
 }
 
	
	 ?>