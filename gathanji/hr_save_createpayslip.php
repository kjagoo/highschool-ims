<?php

	require_once('auth.php');
include('includes/dbconnector.php');
include 'includes/PAYE.php';

// Generate PDF PAYSLIP
require('fpdf.php');
include 'includes/DAO.php';


class PeoplePDF extends FPDF {



//Page header
function Header(){
	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
		$schoolname=$de['schname'];
		$address=$de['box']." , ".$de['place'];
		//$logref=$de['logref'];
		$tele=$de['telphone'];
		$email=$de['email'];
		$web=$de['website'];
	}
	
	//if(!file_exists("images/".$logref)){
 		 $logo="images/logo.JPG";
  		//}else{
 			//$logo = "images/".$logref;
 	// }
	$month=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
	 $payecalc = new PAYECalculator();
	  
		$hcode=$payecalc->getHCode();
 		 $barcode="images/barcode.PNG";
		 
		 $timestamp = strtotime($month);
$formatted = date("F Y", $timestamp);
		 
	$this->SetFont('arial', '', 10);
	$this->Image($logo,20,10,20,20);
	$this->Image($barcode,150,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(154, 25, $hcode);
	$this->SetFont('arial', 'I', 9);
	$this->Text(60, 15, "If undelivered Please return to:");
	$this->SetFont('times', '', 9);
	$this->Text(60, 20, $schoolname);
	$this->Text(60, 25,'P.o.Box  '.$address);
	$this->Text(60, 30,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 9);
	$this->Line(20, 34, 185, 34);//underline
	$this->Text(70, 37, 'Pay Slip for Month of '.$formatted);
  
    //Logo
   // $this->Image('images/KIWASCO_logo.PNG',10,8,33);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
   // $this->Cell(80);
    //Title
   // $this->Cell(30,10,'Title',1,0,'C');
    //Line break
    $this->Ln(20);
}
//Page footer
	function Footer(){
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	
}

$payecalc = new PAYECalculator();
$basic=$_POST['basic'];
	
	$month=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
 // Check if selections were made
if(isset($_POST['allowance'])){
	$allowance = $_POST['allowance'];
	}else{
	$allowance=0;
	}
if(isset($_POST['deductions'])){
	$deductions = $_POST['deductions'];
	}else{
	$deductions=0;
	}
	
	if(isset($_POST['nhif'])){
	$nhif=$payecalc->getNHIF($basic);
	}else{
	$nhif=0;
	}
	if(isset($_POST['nssf'])){
	$nssf=$payecalc->getNSSF($basic);
	}else{
	$nssf=0;
	}
	if(isset($_POST['ptr'])){
	$ptr=$payecalc->getPTR();
	}else{
	$ptr=0;
	}
	
	$numall = count($allowance);
	$totalallowances=0;
	for ($i=0; $i < $numall; $i++){
		//print ("Allowance $allowance[$i]<br > ");
		$totalallowances+=$allowance[$i];
	}
	$numded = count($deductions);
	$totaldeductions=0;
	for ($i=0; $i < $numded; $i++){
		//print ("Deduction $deductions[$i]<br > ");
		$totaldeductions+=$deductions[$i];
	}
	
	$taxablepay=$basic+$totalallowances+$totaldeductions;
	//echo $taxablepay."<br/>";

	$paye=$payecalc->getPAYE($taxablepay);
	//echo "NSSF ".$nssf."<br/>";
	//echo "NHIF ".$nhif."<br/>";
	
	$staffref=$_POST['staffref'];
	//get staff details
	$sdetails = mysql_query("select * from staff where idpass='$staffref'");
	while ($sde = mysql_fetch_array($sdetails)) {// get names
		$staff=str_replace("&","'",$sde['fname'])." ".str_replace("&","'",$sde['mname'])." ".str_replace("&","'",$sde['lname']);
		$category=$sde['category'];
		$staffno=$sde['staffno'];
		$krapin=$sde['kra_pin'];
		$idnumber=$sde['idpass'];
	}
	

$timestamp = strtotime($month);
$formatted = date("F Y", $timestamp);


$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFont('times', '', 10);
$pdf->Text(30, 45, 'Full Name: ');
$pdf->Text(30, 50, 'Job Title: ');
$pdf->Text(30, 55, 'Staff No: ');
$pdf->Text(30, 60, 'KRA PIN No: ');
$pdf->Text(130, 60, 'ID/Passport: ');
$pdf->Text(65, 45, $staff);
$pdf->Text(65, 50, $category);
$pdf->Text(65, 55, $staffno);
$pdf->Text(65, 60, $krapin);
$pdf->Text(150, 60, $idnumber);

$pdf->Line(20, 65, 185, 65);//underline
$pdf->Ln();
$pdf->setXY(25, 66);
$pdf->SetFillColor(255, 255, 255); //WHITE
$pdf->SetDrawColor(255, 255, 255); //WHITE
$pdf->setFont("times","B","9");
$pdf->Cell(160, 5, "KES", 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(25);
$pdf->SetFont('times', '', 10);
$pdf->Cell(80, 7, "Basic Salary", 1, 0, "L", 1);
$pdf->Cell(80, 7, number_format($basic,2), 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(25);

$numall = count($allowance);
if($numall>0){
$pdf->Cell(80, 7, "Allowances", 1, 0, "L", 1);
$pdf->Ln();
$pdf->setX(30);
	for ($i=0; $i < $numall; $i++){
	if($allowance[$i]==0){
	//do not print it on the payslip
	}else{
		$pdf->Cell(75, 7, $_POST['allowancename'][$i], 1, 0, "L", 1);
		$pdf->Cell(80, 7,number_format($allowance[$i],2), 1, 0, "R", 1);
		$pdf->Ln();
		$pdf->setX(30);
		
		$payecalc->saveSlipAllowances($idnumber,$_POST['allowancename'][$i],$allowance[$i],$month,$payecalc->getHCode());
	}
		//print ("Allowance $allowance[$i]<br > ");
	}
}
$pdf->setX(25);
$pdf->Cell(80, 7, "Gross Pay", 1, 0, "L", 1);
$pdf->Cell(80, 7, number_format(($basic+$totalallowances),2), 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(25);
if(isset($_POST['nssf']) || isset($_POST['nhif'])){
$pdf->Cell(80, 7, "Deductions Before Tax:", 1, 0, "L", 1);
$pdf->Ln();
$pdf->setX(30);
}
if(isset($_POST['nssf'])){
	$pdf->Cell(75, 7, 'NSSF', 1, 0, "L", 1);
	$pdf->Cell(80, 7,number_format($payecalc->getNSSF($basic),2), 1, 0, "R", 1);
	$pdf->Ln();
	$pdf->setX(30);
}
if(isset($_POST['nhif'])){
	$pdf->Cell(75, 7, 'NHIF', 1, 0, "L", 1);
	$pdf->Cell(80, 7,number_format($payecalc->getNHIF($basic),2), 1, 0, "R", 1);
	$pdf->Ln();
	$pdf->setX(30);

}
$pdf->setX(25);
if(isset($_POST['nssf']) || isset($_POST['nhif'])){
$pdf->Cell(80, 7, "Total Deductions Before Tax:", 1, 0, "L", 1);
$pdf->Cell(80, 7, number_format(($nssf+$nhif),2), 1, 0, "R", 1);
$pdf->Ln();
}
$pdf->setX(25);
$pdf->Cell(80, 7, "Taxable Pay", 1, 0, "L", 1);

$taxablepay=($basic+$totalallowances)-($nssf+$nhif);

$pdf->Cell(80, 7, number_format($taxablepay,2), 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(30);
$pdf->Cell(75, 7, 'PAYE Before Relief', 1, 0, "L", 1);
$pdf->Cell(80, 7,number_format($payecalc->getPAYE($taxablepay),2), 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(25);
$pdf->Cell(80, 7, "Less Personal Reliefs:", 1, 0, "L", 1);
$pdf->Ln();
$pdf->setX(25);
if(isset($_POST['ptr'])){
	$pdf->setX(30);
	$pdf->Cell(75, 7, 'Personal Tax Relief', 1, 0, "L", 1);
	$pdf->Cell(80, 7,number_format($payecalc->getPTR(),2), 1, 0, "R", 1);
	$pdf->Ln();
	$pdf->setX(25);
	}
$pdf->Cell(80, 7, "P.A.Y.E Due:", 1, 0, "L", 1);

$payebeforerelief=$payecalc->getPAYE($taxablepay);

if($payebeforerelief<=$payecalc->getPTR()){
	$paye=$payebeforerelief;
}else{

$paye=(($payecalc->getPAYE(($basic+$totalallowances)-($nssf+$nhif))-$payecalc->getPTR()));

}
if($paye<0){
$paye=0;
}else{
$paye=$paye;
}
$pdf->Cell(80, 7, number_format($paye,2), 1, 0, "R", 1);
$pdf->Ln();
$pdf->setX(25);

$numded = count($deductions);
if($numded>0){
$pdf->Cell(80, 7, "Deductions after Tax", 1, 0, "L", 1);
$pdf->Ln();
$pdf->setX(30);
	for ($i=0; $i < $numded; $i++){
	if($deductions[$i]==0){
	//do not print it on the payslip
	}else{
		$pdf->Cell(75, 7, $_POST['deductionsname'][$i], 1, 0, "L", 1);
		$pdf->Cell(80, 7,number_format($deductions[$i],2), 1, 0, "R", 1);
		$pdf->Ln();
		$pdf->setX(30);
		
		$payecalc->saveSlipDeductions($idnumber,$_POST['deductionsname'][$i],$deductions[$i],$month,$payecalc->getHCode());
	}
		//print ("Allowance $allowance[$i]<br > ");
	}
$pdf->setX(25);
$pdf->Cell(80, 7, "Total Deductions After Tax", 1, 0, "L", 1);
$pdf->Cell(80, 7, number_format( $totaldeductions,2), 1, 0, "R", 1);
$pdf->Ln();
}
$pdf->setX(25);

$pdf->SetFillColor(255, 255,255); //black
$pdf->SetDrawColor(0, 0,0); //black
$pdf->Cell(80,6,"Net Pay:",'TB',0,'L',1); 
//$pdf->Cell(80, 6, "Net Pay:", 0, 0, "L", 1);
$netpay=(($taxablepay-$paye)-($nssf+$nhif)-($totaldeductions));
$pdf->Cell(80, 6, number_format($netpay,2), "TB", 0, "R", 1);


$pdf->Output();



$payecalc->saveSlipDetails($idnumber,$basic,$nhif,$nssf,$paye,$netpay,$month,$formatted,$payecalc->getHCode());
?>