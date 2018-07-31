<?php
 if(isset($_GET['id'])){
require_once('auth.php');
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

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Printed Leaving Certificate ".$admno;
$func->addAuditTrail($activity,$username);

$getnames = "SELECT * from studentdetails where admno='$admno'";// get names
	$result3 = @mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$yradm=$row2['yrofadmn'];
	$yrleft=$row2['year_finished'];
	$dob=$row2['dob'];
	$currentform=$row2['form'];
}
if($currentform=='FORM 5'){
$currentform='FORM 4';
}else{
$currentform=$currentform;
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
$pdf->Text(105, 68, strtoupper($schoolname));
$pdf->SetFont('times', '', 12);
$pdf->Text(105, 70, '.....................................................................');
$pdf->Text(105, 78, '.....................................................................');
$pdf->Text(30, 90, 'Admission/Serial No -------------');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(70, 88, $admno);
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 98, 'THIS IS TO CERTIFY THAT ......................................................................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(90, 96, strtoupper($studentName));
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 106, 'entered this school on ....................................................... and was enrolled in');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(85, 104, strtoupper($yradm));
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 114, 'Form ............................................, and left on ....................................................   from  ');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(55, 112, strtoupper("Form 1"));
$pdf->Text(130, 112, strtoupper($yrleft));
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 122, 'Form ............................................, having satisfactorily completed the approved ');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(55, 120, strtoupper($currentform));
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 130, 'course for Form ............................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(75, 128, strtoupper("Form 4"));
$pdf->SetFont('times', '', 12);
$pdf->Text(30, 138, 'Date of Birth');
$pdf->SetFont('times', 'i', 10);
$pdf->Text(55, 138, '(in Admission Register) ...............................................................');
$pdf->AddFont('msmincho','','msmincho.php');
$pdf->SetFont('msmincho', '', 10);
$pdf->Text(100, 136, strtoupper($dob));
$pdf->SetFont('times', '', 10);
$pdf->Text(40, 146, "Headteacher's report on the pupils' ability, industry and conduct .........................................................");


$pdf->SetWidths(array(150));
srand(microtime()*1000000);
$pdf->Row(array($ability),30,150);

$pdf->SetFont('times', '', 10);

$pdf->Text(30, 154, "............................................................................................................................................................................");
$pdf->SetFont('times', '', 10);
$pdf->Text(30, 159, "............................................................................................................................................................................");
$pdf->Text(30, 164, "............................................................................................................................................................................");
$pdf->Text(30, 169, "............................................................................................................................................................................");
$pdf->Text(30, 174, "............................................................................................................................................................................");




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
