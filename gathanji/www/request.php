<?php
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
 require_once("includes/dbconnector.php");
 include 'includes/functions.php';
 $func = new Functions();
 
/**
*Get Payable fees for a given form, year and term
*
*/
function getPayableFees($form,$term,$year){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}

/**
*
*Get Paid fees for a givne admno, year and term
*
*/
function getPaidFees($term,$year,$admno){
	$paid=0;
	
	$sql="select sum(votehead_amt) as total from finance_feestructures where year='$year' and term='$term' and admno='$admno'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $paid=$row['total'];

	return $paid;
}

/**
*
*Calculate Fees Balance
*/
function getFeesBalance($form,$term,$year,$admno){
$bal=0;

	$bal=getPayableFees($form,$term,$year)-getPaidFees($term,$year,$admno);
	
return $bal;

}

function getFeesMTMessage($form,$term,$year,$admno){
$message="No Fees Report Available";

$message="ADMNO ".$admno." Fees Structure Year ".$year." Form ".$form. " ".$term." Payable Amount: ".getPayableFees($form,$term,$year).", Paid Amount is: ".number_format(getPaidFees($term,$year,$admno),2).", Balance is: ".number_format(getFeesBalance($form,$term,$year,$admno),2)." Thank you for your Continued Support.";


return $message;
}
/**
*
*Get Student report form for a given year and term
*
*/

function getReportForm($admno,$year,$term){
$report="No Report Forms Available";
	
	//get report form for general exams
	$getgrades="select * from totalygradedmarks where term='$term' and year='$year' and adm='$admno'";
	$resultgrades = mysql_query($getgrades);
	if(mysql_num_rows($resultgrades)){
	
	while ($rowg = mysql_fetch_array($resultgrades)) {
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
	$report=$fullnames." Report term ".$term." ".$year." Eng ".$engfinal.$enggrade.",Kis ".$kisfinal.$kisgrade.",Math ".$mathfinal.$mathgrade.",Bio ".$biofinal.$biograde.",Chem ".$chemfinal.$chemgrade.",Phy ".$phyfinal.$phygrade.",His ".$hisfinal.$hisgrade.",Geo ".$geofinal.$geograde.",CRE ".$crefinal.$cregrade.",AGR ".$agrfinal.$agrgrade.",BST ".$bstfinal.$bstgrade.",Comp ".$compfinal.$compgrade.",French ".$frefinal.$fregrade.",H.Sci ".$homefinal.$homegrade.",Mean ".$meangrade.",Grade ".$gradepoints;
	
	
	}else{
	//check if student did Cluster Exams
	$getgradesm="select * from totalygradedmockmarks where term='$term' and year='$year' and adm='$admno'";
	$resultgradesm = mysql_query($getgradesm);
	if(mysql_num_rows($resultgradesm)){
	
	while ($rowg = mysql_fetch_array($resultgradesm)) {
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
	$report=$fullnames." Report term ".$term." ".$year." Eng ".$engfinal.$enggrade.",Kis ".$kisfinal.$kisgrade.",Math ".$mathfinal.$mathgrade.",Bio ".$biofinal.$biograde.",Chem ".$chemfinal.$chemgrade.",Phy ".$phyfinal.$phygrade.",His ".$hisfinal.$hisgrade.",Geo ".$geofinal.$geograde.",CRE ".$crefinal.$cregrade.",AGR ".$agrfinal.$agrgrade.",BST ".$bstfinal.$bstgrade.",Comp ".$compfinal.$compgrade.",French ".$frefinal.$fregrade.",H.Sci ".$homefinal.$homegrade.",Mean ".$meangrade.",Grade ".$gradepoints;
	
	
	}else{
	
	$report="No Results Available";
	}
	
	}
	
return $report;
}



if(isset($_GET['from']) && isset($_GET['text']) ){
	//$message= json_encode($_GET);
	//$url = "http://app.domainkenya.co.ke/bambika?from=254728355429&message=".urlencode($message); 
	//file_get_contents($url);	
	$from = trim($_GET['from']);
	$text = trim($_GET['text']);
	
	$pieces = explode(",", $text);
	$request= trim($pieces[0]); // piece1
	$admno= trim($pieces[1]); // piece2
	$yr= trim($pieces[2]); // piece2
	$term= trim($pieces[3]); // piece2.
	
	 $ekey="ntsdssLs5A2e";
	 $pass=md5($from.$ekey);
	 
		//if request if fees
	if($request=="fees" || $request=="Fees" || $request=="FEES"  || $request=="fee" || $request=="FEE"){
	//Query fees report
	//check if the student exists in our database
	
	$queryis="select form from studentdetails where admno='$admno'";
	$resultqs = mysql_query($queryis);
	if(!mysql_num_rows($resultqs)){
	$feedbackmessage="Wrong ADMNO";
	}else{
	
	//get student form in
	while ($rowqs = mysql_fetch_array($resultqs)) {
	$form=$rowqs['form'];
	}
	
	
	if($term==1){
	$myterm="TERM 1";
	}
	if($term==2){
	$myterm="TERM 2";
	}
	if($term==3){
	$myterm="TERM 3";
	}
	
	$feedbackmessage=getFeesMTMessage($form,$myterm,$yr,$admno);
	}
	// create a new cURL resource
		$ch = curl_init();
		//automatically execute send sms by calling Airtouch sms api
		// Prepare data for POST request
		//$data = "target=MaryLeakey&msisdn=" . $from . "&text=" . urlencode($feedbackmessage) . "&login=maryleakey&pass=" . $pass;
		// Send the GET request with cURL
		$url = "http://app.domainkenya.co.ke/bambika?from=".$from."&message=".urlencode($feedbackmessage); 
	
		//$url = "http://domainkenya.co.ke/sms/smsapi.php?to=".$from."&message=".urlencode($feedbackmessage);
		//$url="http://api.sms.bambika.co.ke:8555/?target=MaryLeakey&msisdn=" . $from . "&text=" . urlencode($feedbackmessage) . "&login=maryleakey&pass=" . $pass;
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						
		// grab URL and pass it to the browser
		$response = curl_exec($ch);
	
		//save the request to database
		$activity = $feedbackmessage;
	 	$usename=$from.":".$text;
        	$func->addAuditTrail($activity,$usename);
		
		// close cURL resource, and free up system resources
		curl_close($ch);
		
		return $response;	
	
		
	}
	
	if($request=="Report" || $request=="Reports" || $request=="report"  || $request=="reports"){
	//else if the request is not fees, the request is alsways reportforms
	
        	
	$queryis="select form from studentdetails where admno='$admno'";
	$resultqs = mysql_query($queryis);
	if(!mysql_num_rows($resultqs)){
	$fmessage="Wrong ADMNO";
	}else{
	$fmessage=getReportForm($admno,$yr,$term);
	}
	
	$ch = curl_init();
		//$url='http://api.sms.bambika.co.ke:8555/?target=MaryLeakey&msisdn='.$from.'&text='.$request.'&login=maryleakey&pass='.$pass;
		
		//automatically execute send sms by calling Airtouch sms api
		// Prepare data for POST request
		//$data = "target=MaryLeakey&msisdn=" . $from . "&text=" . urlencode($fmessage) . "&login=maryleakey&pass=" . $pass;
		// Send the GET request with cURL
		//$url="http://api.sms.bambika.co.ke:8555/?target=MaryLeakey&msisdn=" . $from . "&text=" . urlencode($fmessage) . "&login=maryleakey&pass=" . $pass;
		$url = "http://app.domainkenya.co.ke/bambika?from=".$from."&message=".urlencode($fmessage); 
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						
		// grab URL and pass it to the browser
		$response = curl_exec($ch);
	
		//save the request to database
		$activity = $fmessage;
	 	$usename=$from.":".$text;
        $func->addAuditTrail($activity,$usename);
		
		// close cURL resource, and free up system resources
		curl_close($ch);
		
		return $response;	
		
		}
	

}
?>
