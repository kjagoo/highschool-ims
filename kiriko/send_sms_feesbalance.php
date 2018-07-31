<?php
ini_set('max_execution_time', 0);
if(isset($_GET['ref']) && isset($_GET['term']) && isset($_GET['year']) ){

include('includes/dbconnector.php');
include 'includes/SMSConfig.php';
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];

$smsconfig = new SMSConfig();

foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
$admnos=$_GET['ref'];
$term=$_GET['term'];
$year=$_GET['year'];
$bal=number_format($_GET['bal'],2);
$val1=$_GET['val1'];
$val2=$_GET['val2'];

	
$msg="Dear parent, Kindly settle your daughter's outstanding Fees balance of KES $bal for $term $year";

$prefix='254';
	$resulttels = mysql_query("SELECT telephone FROM parentdetails where admno='$admnos'");
			while ($rowtel = mysql_fetch_array($resulttels)) {
			$parenttel=$rowtel['telephone'];
		
		if($parenttel!= 0) {
		
		
			$msisdn=$prefix.$parenttel;//Posted from a developed UI 
			$messages= urlencode(stripslashes($msg));// the message to the recepients
			//parameters		
				//open connection
			//$api_url = 'http://api.bulki.bambika.co.ke:83/send.pl';
			$pass=md5($msisdn.$ekey);
		
		
		//open connection
			$ch = curl_init();
			 //set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $api_url.'target='.$target.'&msisdn='.$msisdn.'&text='.$messages.'&login='.$login.'&pass='.$pass);
			
			//execute post
				$result = curl_exec($ch);
						  
				if($result){
				//echo reminder has been sent
				
				$date=date("Y-m-d");
				$query="insert into sent_messages (msg_to,message,date_sent,sender) values('$msisdn','$messages','$date','$username')";
				 $resultin = mysql_query($query);
				 
				?>
				 <script language="javascript">alert('Balance Notice have been sent')</script>
				 <script language="javascript">window.location='finance_report_view_feesbalances.php?form=<?php echo $form?>&term=<?php echo $term?>&year=<?php echo $year?>&stream=<?php echo $stream?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>';</script>
				 <?php
				 }
			
				 //close connection
						  curl_close($ch);
		}//end of number not zero check	
			
		}

}
	
	 ?>