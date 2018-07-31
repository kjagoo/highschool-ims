<?php
ini_set('max_execution_time', 0);
if(isset($_GET['id']) && isset($_GET['term']) && isset($_GET['yr'])  && isset($_GET['adm'])  && isset($_GET['strm']) ){

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
$admnos=$_GET['adm'];
$form=$_GET['id'];
$term=$_GET['term'];
$year=$_GET['yr'];
$stream=$_GET['strm'];
$mode=$_GET['mode'];

$getgrades="select * from totalygradedmarks where term='$term' and year='$year' and adm='$admnos'";
	$resultgrades = @mysql_query($getgrades);
	while ($rowg = mysql_fetch_array($resultgrades)) {// get admno
	//$admno=$rowg['adm'];
	$kmrks=$rowg['marks'];
	$fullnames=$rowg['names'];
	$engfinal=$rowg['english'];
	$enggrade=$rowg['englishgrade'];
	$kisfinal=$rowg['kiswahili'];
	$kisgrade=$rowg['kiswahiligrade'];
	$mathfinal=$rowg['mathematics'];
	$mathgrade=$rowg['mathimaticsgrade'];
	$biofinal=$rowg['biology'];
	$biograde=$rowg['biologygrade'];
	$chemfinal=$rowg['chemistry'];
	$chemgrade=$rowg['chemistrygrade'];
	$phyfinal=$rowg['physics'];
	$phygrade=$rowg['physicsgrade'];
	$hisfinal=$rowg['history'];
	$hisgrade=$rowg['historygrade'];
	$geofinal=$rowg['geography'];
	$geograde=$rowg['geographygrade'];
	$crefinal=$rowg['cre'];
	$cregrade=$rowg['cregrade'];
	$agrfinal=$rowg['agriculture'];
	$agrgrade=$rowg['agriculturegrade'];
	$bstfinal=$rowg['businesStudies'];
	$bstgrade=$rowg['businesStudiesgrade'];
	$compfinal=$rowg['computer'];
	$compgrade=$rowg['computergrade'];
	$frefinal=$rowg['french'];
	$fregrade=$rowg['frenchgrade'];
	$homefinal=$rowg['home'];
	$homegrade=$rowg['homegrade'];
	$gradepoints=$rowg['tgrade'];
	$meangrade=$rowg['averagepoints'];

	}
	if($biofinal==0){
	$biofinal="-";
	}
	if($phyfinal==0){
	$phyfinal="-";
	}
	if($hisfinal==0){
	$hisfinal="-";
	}
	if($geofinal==0){
	$geofinal="-";
	}
	if($bstfinal==0){
	$bstfinal="-";
	}
	if($agrfinal==0){
	$agrfinal="-";
	}
	if($compfinal==0){
	$compfinal="-";
	}
	if($frefinal==0){
	$frefinal="-";
	}
	if($homefinal==0){
	$homefinal="-";
	}
	
$msg=$fullnames." Report term ".$term." ".$year." Eng ".$engfinal.$enggrade.",Kis ".$kisfinal.$kisgrade.",Math ".$mathfinal.$mathgrade.",Bio ".$biofinal.$biograde.",Chem ".$chemfinal.$chemgrade.",Phy ".$phyfinal.$phygrade.",His ".$hisfinal.$hisgrade.",Geo ".$geofinal.$geograde.",CRE ".$crefinal.$cregrade.",AGR ".$agrfinal.$agrgrade.",BST ".$bstfinal.$bstgrade.",Comp ".$compfinal.$compgrade.",French ".$frefinal.$fregrade.",H.Sci ".$homefinal.$homegrade.",Pts ".$meangrade.",Mean ".$gradepoints;
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
				 <script language="javascript">alert('Report Form have been sent')</script>
				 <script language="javascript">window.location='report_forms_view_general.php?form=<?php echo $form?>&term=<?php echo $term?>&year=<?php echo $year?>&stream=<?php echo $stream?>&amode=<?php echo $mode?>';</script>
				 <?php
				 }
			
				 //close connection
						  curl_close($ch);
		}//end of number not zero check	
			
		}

}
	
	 ?>