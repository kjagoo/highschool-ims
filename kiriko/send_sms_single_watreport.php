 <?php
if(isset($_GET['id'])&& isset($_GET['term']) && isset($_GET['yr']) && isset($_GET['strm']) && isset($_GET['wat']) && isset($_GET['mode']) && isset($_GET['adm']) && isset($_GET['by'])){

include('includes/dbconnector.php');
include 'includes/SMSConfig.php';
$smsconfig = new SMSConfig();
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
foreach($smsconfig->getSMSDetails() as $row0){
	$api_url=$row0['api_url'];
	$ekey=$row0['ekey'];
	$target=$row0['senderid'];
	$login=$row0['passwrd'];
}
$form=$_GET['id'];
	$strm=$_GET['strm'];
	$term=$_GET['term'];
	$year=$_GET['yr'];
	$admn=$_GET['adm'];
	$wat=$_GET['wat'];
	$positionby=$_GET['by'];
	$mode=$_GET['mode'];

if($positionby=="marks"){
		$positionby="wat1totals";
		$alternatepositionby="averagepoints";
	}
	if($positionby=="points"){
		$positionby="averagepoints";
		$alternatepositionby="wat1totals";
	}
	
$date=date("Y-m-d");
if($strm=='Entire'){
	$getgrades="select * from totalygradedmidterm where form='$form'  and term='$term' and year='$year' and adm='$admn'";
}else{
	$getgrades="select * from totalygradedmidterm where form='$form' and stream='$strm' and term='$term' and year='$year' and adm='$admn'";
}


	$resultgrades = mysql_query($getgrades);
	if(!$resultgrades){
		echo "Error getting sms details: ".mysql_error();
	}
	while ($rowdis = mysql_fetch_array($resultgrades)) {// get admno
	//$admno=$rowg['adm'];
	$admno=$rowdis['adm'];
$namesare=str_replace("&","'",$rowdis['names']);
$eng=$rowdis['eng1'];
$enggrade=$rowdis['eng1grade'];
$kis=$rowdis['kis1'];
$kisgrade=$rowdis['kis1grade'];
$math=$rowdis['math1'];
$mathgrade=$rowdis['math1grade'];
$bio=$rowdis['bio1'];
$biograde=$rowdis['bio1grade'];
$phy=$rowdis['phy1'];
$phygrade=$rowdis['phy1grade'];
$chem=$rowdis['chem1'];
$chemgrade=$rowdis['chem1grade'];
$his=$rowdis['his1'];
$hisgrade=$rowdis['his1grade'];
$geo=$rowdis['geo1'];
$geograde=$rowdis['geo1grade'];
$cre=$rowdis['cre1'];
$cregrade=$rowdis['cre1grade'];
$agr=$rowdis['agr1'];
$agrgrade=$rowdis['agr1grade'];
$bst=$rowdis['bst1'];
$bstgrade=$rowdis['bst1grade'];
$fre=$rowdis['fre1'];
$fregrade=$rowdis['fre1grade'];
$comp=$rowdis['comp1'];
$compgrade=$rowdis['comp1grade'];
$home=$rowdis['home1'];
$homegrade=$rowdis['home1grade'];
$totals=$rowdis['wat1totals'];
$totalpoints=$rowdis['totalpoints1'];
$mean=$rowdis['averagepoints'];
$grade=$rowdis['fgrade'];
$classin=$rowdis['stream'];
$POS=$rowdis['position'];

}

	if($bio==0){
	$bio="-";
	}
	if($phy==0){
	$phy="-";
	}
	if($his==0){
	$his="-";
	}
	if($geo==0){
	$geo="-";
	}
	if($bst==0){
	$bst="-";
	}
	if($agr==0){
	$agr="-";
	}
	if($comp==0){
	$comp="-";
	}
	if($fre==0){
	$fre="-";
	}
	if($home==0){
	$home="-";
	}
	
	
$msg=$namesare." CAT ".$wat." Report Term ".$term." ".$year." ENG ".$eng.$enggrade.",KIS ".$kis.$kisgrade.",MATH ".$math.$mathgrade.",BIO ".$bio.$biograde.",CHEM ".$chem.$chemgrade.",PHY ".$phy.$phygrade.",HIS ".$his.$hisgrade.",GEO ".$geo.$geograde.",CRE ".$cre.$cregrade.",AGR ".$agr.$agrgrade.",BST ".$bst.$bstgrade.",FRE ".$fre.$fregrade.",COMP ".$comp.$compgrade.",H/SC ".$home.$homegrade.",Pts ".$totalpoints.",Mean ".$mean." POS ".$POS;

	
	
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
		curl_setopt($ch, CURLOPT_URL, $api_url.'user='.$ekey.'&password='.$login.'&mobiles='.$msisdn.'&sms='.$messages.'&senderid='.$target);//'target='.$target.'&msisdn='.$msisdn.'&text='.$messages.'&login='.$login.'&pass='.$pass);
			
			//execute post
				$result = curl_exec($ch);
						  
				if($result){
				//echo reminder has been sent
				$query="insert into sent_messages (msg_to,message,date_sent,sender) values('$msisdn','$messages','$date','$username')";
				 $resultin = mysql_query($query);
				?>
				 <script language="javascript">alert('Report Form have been sent')</script>
				 <script language="javascript">window.location='reports_halfterm.php';</script>
				 <?php
				 }
			
				 //close connection
						  curl_close($ch);
		
		}//end of number not zero check	
			
		}

}
	
	 ?>