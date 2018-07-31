<?php
ini_set('max_execution_time', 0);

	
if(isset($_POST['delete'])){//CHECK IF THE DELETE BUTTON WAS CLICKED
 require_once('auth.php');
 include("includes/dbconnector.php");
include 'includes/functions.php';
$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
$activity = "Sent SMS to specific parents";
$func->addAuditTrail($activity,$username);

include 'includes/SMSConfig.php';
$smsconfig = new SMSConfig();

foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
	
	if(isset($_POST['checkbox'])){//CHECK IF THE ANYBOX WAS CLICKED
	
	$checkbox=$_POST['checkbox'];//STORE THE VALUE OF THE CHECKBOX IN A VARIABLE
	$numbers=array();
	$prefix='254';
	$msg=$_POST['message'];
	
	$count=count($_POST['checkbox']);//COUNT THE NO OF VALUES STORED(NO OF CHECKBOXES CLICKED)
	
	
	for($i=0;$i<$count;$i++){//LOOP THROUGH ALL THE VALUES and send message
	
		$parenttel = $checkbox[$i]; //STORE EACH ONE IN A VARIABLE
	if($parenttel!= 0) {
		$msisdn=$prefix.$parenttel;//Posted from a developed UI 
		$messages= urlencode(stripslashes($msg));// the message to the recepients
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
		
	}
	
	
	}//end of for loop
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
}
 
	
	 ?>