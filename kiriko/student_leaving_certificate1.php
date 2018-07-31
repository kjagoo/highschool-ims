<?php
 if(isset($_GET['id'])){
//require_once('auth.php');
require('pdfColors.php');



//Connect to database
include('includes/dbconnector.php');
	
	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$date=date("j/F/Y");

$admno=$_GET['id'];	
$ability= $_GET['ability'];		


/*$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Printed Leaving Certificate ".$admno;
$func->addAuditTrail($activity,$username);
*/
$getnames = "SELECT * from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$yradm=$row2['yrofadmn'];
	$forminto=$row2['forminto'];
	$yrleft=$row2['year_finished'];
	$dob=$row2['dob'];
	$currentform=$row2['form'];
}
if($yrleft==0){
$yrleft=date('Y');
}

if($forminto=='FORM 1'){
$forminto='ONE';
}
if($forminto=='FORM 2'){
$forminto='TWO';
}
if($forminto=='FORM 3'){
$forminto='THREE';
}
if($forminto=='FORM 4'){
$forminto='FOUR';
}


if($currentform=='FORM 5'){
$currentform='FOUR';
}
if($currentform=='FORM 4'){
$currentform='FOUR';
}
if($currentform=='FORM 3'){
$currentform='THREE';
}
if($currentform=='FORM 2'){
$currentform='TWO';
}
if($currentform=='FORM 1'){
$currentform='ONE';
}
$studentName=$fname."  ".$mname."  ".$lasname;

/*********************************************************************************/

$logo = "images/k_logo.png";
$pdf=new cmykPDF();
$pdf->AddPage();
$pdf->SetFont('arial', '', 10);
$pdf->Image($logo,90,10,0,0);
$pdf->SetFont('times', '', 8);
$pdf->Text(180, 20, 'REV.');
$pdf->Text(85, 33, 'REPUBLIC OF KENYA');
$pdf->SetFont('times', '', 12);
$pdf->Text(75, 40, 'MINISTRY OF EDUCATION');
$pdf->SetFont('times', 'b', 12);
$pdf->Text(64, 48, 'KENYA SECONDARY SCHOOL LEAVING');
$pdf->Text(85, 54, 'CERTIFICATE');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(95, 68, strtoupper($schoolname));
$pdf->Text(95, 76, strtoupper($po));
$pdf->SetFont('times', '', 12);
$pdf->Text(95, 70, '..........................................................................................');
$pdf->Text(95, 78, '..........................................................................................');
$pdf->Text(20, 90, 'Admission/Serial No -------------');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(60, 88, $admno);
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 98, 'This is to certify that ......................................................................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(90, 96, strtoupper(str_replace('&',"'",$studentName)));
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 106, 'entered this school on ....................................................... and was enrolled in');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(85, 104, strtoupper($yradm));
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 114, 'form ............................................, and left on ....................................................   from  ');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(55, 112, strtoupper($forminto));
$pdf->Text(130, 112, strtoupper($yrleft));
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 122, 'form ............................................, having satisfactorily completed the approved ');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(55, 120, strtoupper($currentform));
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 130, 'course for form ............................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(65, 128, strtoupper("FOUR"));
$pdf->SetFont('times', '', 12);
$pdf->Text(20, 138, 'Date of Birth');
$pdf->SetFont('times', 'i', 10);
$pdf->Text(45, 138, '(in Admission Register) ...............................................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(100, 136, strtoupper($dob));
$pdf->SetFont('times', '', 10);
$pdf->Text(20, 146, "Headteacher's report on the pupils' ability, industry and conduct .........................................................");
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);

$pdf->SetWidths(array(150));
srand(microtime()*1000000);
$pdf->Row(array($ability),25,150);

$pdf->SetFont('times', '', 10);

$pdf->Text(20, 155, "............................................................................................................................................................................");
$pdf->SetFont('times', '', 10);
$pdf->Text(20, 161, "............................................................................................................................................................................");
$pdf->Text(20, 167, "............................................................................................................................................................................");
$pdf->Text(20, 174, "............................................................................................................................................................................");
$pdf->Text(20, 180, "............................................................................................................................................................................");



$pdf->Text(30, 200, "Pupil's Signature.......................................");

$pdf->Text(30, 208, "Date of Issue.............................................");
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(55, 206, strtoupper($date));
$pdf->SetFont('times', '', 12);
$pdf->Text(130, 220, "Signature..................................");
$pdf->Text(150, 226, "Headteacher");



$pdf->SetFont('times', 'b', 8);
$pdf->Text(60, 271, 'This certificate was issued without any erasure or alteration whatsoever.');

$pdf->SetFont('times', '', 9);
$pdf->Text(23, 274, 'GPK(L)');

$pdf->Output();

}else{

}
?>
