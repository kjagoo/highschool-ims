<?php
ini_set('max_execution_time', 0);
if(isset($_GET['form']) && isset($_GET['term']) && isset($_GET['year']) ){

include('includes/dbconnector.php');
include 'includes/SMSConfig.php';
require_once('auth.php');
include 'includes/fees.php';
$fee = new fees();
$username=$_SESSION['SESS_MEMBER_ID_'];

$smsconfig = new SMSConfig();

foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
$year=$_GET['year'];
$form=$_GET['form'];
$stream=$_GET['stream'];
$term=$_GET['term'];
$val1=$_GET['val1'];
$val2=$_GET['val2'];
$num=0;
$sql="select distinct(fsi.admno),sd.* from finance_student_invoices as fsi inner join studentdetails as sd on fsi.admno=sd.admno and sd.form='$form' and sd.class='$stream';";

		 $resultbal = mysql_query($sql);
		 if(!$resultbal){
			echo "Error ".mysql_error(); 
		 }
		 while($row=mysql_fetch_array($resultbal)){ 
		 $num++;
		 $admno=$row['admno'];

	$lastyearfees=$fee->getInvoiceAmt(($year-1),'TERM 1',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 2',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 3',$admno);
	$totalpaidamountlastyear=$fee->getPaidAmt(($year-1),$admno,'TERM 1')+$fee->getPaidAmt(($year-1),$admno,'TERM 2')+$fee->getPaidAmt(($year-1),$admno,'TERM 3');
	
	
	$bal=$lastyearfees-$totalpaidamountlastyear;
	$payable=$fee->getInvoiceAmt(($year),$term,$admno);
	$added=$fee->getAddedAmt($year,$admno,$term);
	
	$paid=$fee->getPaidAmt(($year),$admno,$term);
	
	$bal=number_format(($payable+$added+$bal)-$paid,2);
	
	if((($payable+$added+$bal)-$paid)<=0){
	}else{
	$msg="Dear parent, Kindly settle your daughter's outstanding Fees balance of KES $bal for $term $year";
		

	


$prefix='254';
	$resulttels = mysql_query("SELECT telephone FROM parentdetails where admno='$admno'");
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
				 
				
				 }
			
				 //close connection
						  curl_close($ch);
		}//end of number not zero check	
			}	
		}
 }
 ?>
	 <script language="javascript">alert('Balance Notice have been sent')</script>
	 <script language="javascript">window.location='finance_report_view_feesbalances.php?form=<?php echo $form?>&term=<?php echo $term?>&year=<?php echo $year?>&stream=<?php echo $stream?>&val1=<?php echo $val1?>&val2=<?php echo $val2?>';</script>
	 <?php
 
}
	
	 ?>