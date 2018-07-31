 <?php


	
if(isset($_POST['to']) && isset($_POST['category']) && isset($_POST['message']) ){
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
	
	$to=$_POST['to'];
	$category=$_POST['category'];
	$msg=$_POST['message'];
	
	$numbers=array();
	 $prefix='254';
	 
	 
	if($category=='bog'){
	$query="select telephone from staff where category='Board Teacher'";
	}
	if($category=='tsc'){
	$query="select telephone from staff where category='Government Teacher'";
	}
	if($category=='all'){
	$query="select telephone from staff where category !='TRAN'";
	}
	$resulta = mysql_query($query);
		while ($rowa = mysql_fetch_array($resulta)) {
		$teachertel=$rowa['telephone'];
		
					
		if($teachertel!= 0) {
		// send SMS to the parent
			//for ($key_Number = 0; $key_Number <count($numbers); $key_Number++) {
			//echo $numbers[$key_Number].'<br/>';
			$msisdn=$prefix.$teachertel;//Posted from a developed UI 
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
				 }
			echo "<br/>";
				 //close connection
						  curl_close($ch);
		}//end of number not zero check
	}//end of sending one sms to a parent
		
	
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