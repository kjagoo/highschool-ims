<?php
ini_set('max_execution_time', 0);
if(isset($_GET['form'])&& isset($_GET['term']) && isset($_GET['year']) && isset($_GET['class']) && isset($_GET['wat']) && isset($_GET['mode'])){
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
$form=$_GET['form'];
	$strm=$_GET['class'];
	$term=$_GET['term'];
	$year=$_GET['year'];
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
//$numbers=array();
$prefix='254';

if($strm=="Entire"){
//$sql="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
//$sql="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
$getgrades="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
}else{
//$sql="select * from totalygradedmidterm where form='$form' and stream='$strm' and term='$term' and year='$year' order by $positionby desc, $alternatepositionby desc";
$getgrades="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year' and stream='$strm'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
}
//$getgrades="select * from totalygradedmarks where  term='$term' and year='$year' and classin='$stream' and form='$form'";



	$resultgrades = @mysql_query($getgrades);
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
$POS=$rowdis['ROWNUM'];

$pi=0;
$vap=0;
	$resultf = mysql_query("select * from totalperformanceindex where adm='$admno' and  year='$year' and form='$form' and term='$term' and exam='$wat'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
	}
    $exm = 'Tune-Up';
	if($wat == 1){
	$exm = 'Tune-Up';
	}
	if($wat == 2){
	 $exm = 'Mid-Term';
	}
	if($wat == 12){
	 $exm = 'Tune-Up and Mid-Term';
	}
	
	if($bio==0){
	$bio="";
	$biograde="";
	}else{
	$bio=",BIO ".$bio.$biograde;
	}
	if($chem==0){
	$chem="";
	$chemgrade="";
	}else{
	$chem=",CHEM ".$chem.$chemgrade;
	}
	if($phy==0){
	$phy="";
	$phygrade="";
	}else{
	$phy=",PHY ".$phy.$phygrade;
	
	}
	if($his==0){
	$his="";
	$hisgrade="";
	}else{
	$his=",HIS ".$his.$hisgrade;
	}
	if($geo==0){
	$geo="";
	$geograde="";
	}else{
	$geo=",GEO ".$geo.$geograde;
	}
	if($cre==0){
	$cre="";
	$cregrade="";
	}else{
	$cre=",CRE ".$cre.$cregrade;
	}
	if($agr==0){
	$agr="";
	$agrgrade="";
	}else{
	$agr=",AGR ".$agr.$agrgrade;
	}
	if($bst==0){
	$bst="";
	$bstgrade="";
	}else{
	$bst=",BST ".$bst.$bstgrade;
	}
	if($comp==0){
	$comp="";
	$compgrade="";
	}else{
	$comp=",COMP ".$comp.$compgrade;
	}
	
	 
$msg=$namesare." ".$exm." Report Term ".$term." ".$year." ENG ".$eng.$enggrade.",KIS ".$kis.$kisgrade.",MATH ".$math.$mathgrade.$bio.$chem.$phy.$his.$geo.$cre.$agr.$bst.$comp.",Pts ".$totalpoints.",Mean:".$mean." Grade:".$grade." POS:".$POS;


if($grade=='F'){

}else{
	$resulttels = mysql_query("SELECT telephone FROM parentdetails where admno='$admno' and telephone is not null");
			while ($rowtel = mysql_fetch_array($resulttels)) {
			$parenttel=$rowtel['telephone'];
				if($parenttel!= 0) {
				//array_push($numbers, $prefix.$parenttel);
				//}
	
	 //for ($key_Number = 0; $key_Number <count($numbers); $key_Number++) {
	//echo $numbers[$key_Number].'<br/>';
	$msisdn=$prefix.$parenttel;//Posted from a developed 
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
		}//end of for loop				  curl_close($ch);
	  }
	}//end of checking is grade is F
	}//end of get totallygraded
	?>
				 <script language="javascript">alert('Report Form have been sent')</script>
				
				 <?php
}
	
	 ?>