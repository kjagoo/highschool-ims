<?php
ini_set('max_execution_time', 0);

	
if(isset($_POST['unreg_group']) && isset($_POST['message']) ){
require_once('auth.php');
 include("includes/dbconnector.php");
include 'includes/functions.php';
$username=$_SESSION['SESS_MEMBER_ID_'];
$func = new Functions();
 include 'includes/SMSConfig.php';
$smsconfig = new SMSConfig();

foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
	$party =$_POST['unreg_group'];
	$msg=$_POST['message'];
	
	$numbers=array();
	 $prefix='254';
	 
	  if($party!=" "){
	  
	$query=("select telephones  from contacts_groups where group_name='$party'");
	$resulta = mysql_query($query);
		while ($rowa = mysql_fetch_array($resulta)) {
		$telephone=$rowa['telephones'];
					
		if($telephone!= 0) {
			$msisdn=$prefix.$telephone;//Posted from a developed UI 
			$messages= urlencode(stripslashes($msg));// the message to the recepients
			//parameters		
				//open connection
			//$api_url = 'http://api.bulki.bambika.co.ke:83/send.pl';
			//$pass=md5($msisdn.'w2r5oyNHEldN');
			$pass=md5($msisdn.$ekey);
			//$messages=$messages." -Rarakwa Girls";
		
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
		
	}//end of while
	
	?>
 <script language="javascript">alert('Message have been sent')</script>
 <script language="javascript">window.history.go(-1)</script>
 <?php
}else{
?>
 <script language="javascript">alert('You did not select Recepients')</script>
 <script language="javascript">window.history.go(-1)</script>
 <?php
}
 }else{//end of ppost check
 ?>
 <script language="javascript">alert('Please provide all the required details')</script>
 <script language="javascript">window.history.go(-1)</script>
 <?php
 }

















?>