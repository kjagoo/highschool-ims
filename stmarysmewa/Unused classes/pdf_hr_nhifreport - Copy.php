<?php

require('fpdf.php');
include('includes/dbconnector.php');

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
	if($_GET['frm']=="all"){
		$from="*";
		$to="*";
	}else{
	$from=$_GET['frm'];
	$to=$_GET['to'];
	}
		
	  $date=date("Y-m-d H:i:s");
		 $y=date("Y");
		 $m=date("m");
		 $d=date("d");
		 $hr=date("H");
		 $min=date("i");
		$sec=date("s");
		$hcodes=$y.$m.$d.$hr;
			$mins=$min.$sec;
	
			$hcode=$hcodes.$mins;
		//$hcode=$_GET['hbar'];
 		 $barcode="images/barcode.PNG";
		 
	$this->SetFont('arial', '', 10);
	$this->Image($logo,20,10,20,20);
	$this->Image($barcode,210,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(211, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(60, 35, 'MASTER Payslip Report:- From '.$from." To ".$to);
  	
    $this->Ln(20);
}
//Page footer
	function Footer(){
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
	
}
include 'includes/Finance.php';
	$finacial= new Financials();

$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage("L");
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 

//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(15, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(60, 7, "Employee", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Basic", 1, 0, "L", 1);
$pdf->Cell(20, 7, "Allowances", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Gross Pay", 1, 0, "C", 1);
$pdf->Cell(15, 7, "NHIF", 1, 0, "C", 1);
$pdf->Cell(15, 7, "NSSF", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Statutory", 1, 0, "C", 1);
$pdf->Cell(20, 7, "PAYE", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Gross Bal", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Deductions", 1, 0, "C", 1);
$pdf->Cell(23, 7, "Net Pay", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 15;
$pdf->setXY($x, $y);
 
	if($_GET['frm']=="all"){
		$from="*";
		$to="*";
		$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic,
	(select sum(allowance) as allw from tbl_hr_payslips_all pa where pa.month_ref=p.date_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref and p.date_ref between '$from' and '$to'";
	}else{
	$from=$_GET['frm'];
	$to=$_GET['to'];
	$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic,
	(select sum(allowance) as allw from tbl_hr_payslips_all pa where pa.month_ref=p.month_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref";
	
	}
		
	
	
	
	
	
$result = mysql_query($query);
$num=0;

$basictotal=0;
$allowastotal=0;
$grosstotal=0;
$nhiftotal=0;
$nssftotal=0;
$statutorytotal=0;
$payetotal=0;
$grossbaltotal=0;
$deductionstotal=0;
$netpaytotal=0;

while($row = mysql_fetch_array($result)){
$num++;
	$pdf->setFont("times","","9");
	$pdf->Cell(10, 7, $num, 1);
	$pdf->Cell(60, 7, str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['mname'])." ".str_replace("&","'",$row['lname']),  1);
	$pdf->Cell(20, 7, number_format($row['basic'],2),  1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format($row['allaws'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format( ($row['allaws']+$row['basic']),2), 1, 0, "R", 0);
	$pdf->Cell(15, 7, number_format($row['nhif'],2), 1, 0, "R", 0);
	$pdf->Cell(15, 7, number_format($row['nssf'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format($row['statutory'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format($row['paye'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format(((($row['allaws'])+($row['basic']))-($row['statutory'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format($row['deds'],2), 1, 0, "R", 0);
	$pdf->Cell(23, 7, number_format($row['netpay'],2), 1, 0, "R", 0);
	
	
	$basictotal+=$row['basic'];
	$allowastotal+=$row['allaws'];
	$grosstotal+=($row['allaws']+$row['basic']);
	$nhiftotal+=$row['nhif'];
	$nssftotal+=$row['nssf'];
	$statutorytotal+=$row['statutory'];
	$payetotal+=$row['paye'];
	$grossbaltotal+=((($row['allaws'])+($row['basic']))-($row['statutory']));
	$deductionstotal+=$row['deds'];
	$netpaytotal+=$row['netpay'];
	
	$y += 7;
	
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(15, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(60, 7, "Employee", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Basic", 1, 0, "L", 1);
		$pdf->Cell(20, 7, "Allowances", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Gross Pay", 1, 0, "C", 1);
		$pdf->Cell(15, 7, "NHIF", 1, 0, "C", 1);
		$pdf->Cell(15, 7, "NSSF", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Statutory", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "PAYE", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Gross Bal", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Deductions", 1, 0, "C", 1);
		$pdf->Cell(23, 7, "Net Pay", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(70, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($basictotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($allowastotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($grosstotal,2), 1, 0, "R", 0);
  $pdf->Cell(15, 7, number_format($nhiftotal,2), 1, 0, "R", 0);
  $pdf->Cell(15, 7, number_format($nssftotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($statutorytotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($payetotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($grossbaltotal,2), 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($deductionstotal,2), 1, 0, "R", 0);
  $pdf->Cell(23, 7, number_format($netpaytotal,2), 1, 0, "R", 0);
  
  $pdf->Output();

?>