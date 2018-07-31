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
	$this->Image($barcode,200,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(201, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	$this->Text(75, 35, 'Master Payslip Report:- From '.$from." To ".$to);
  
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
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
	
}


$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
$pdf->open();
$pdf->addPage('L');
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black
 
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(10, 40);
$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
$pdf->Cell(40, 7, "Employee", 1, 0, "C", 1);
$pdf->Cell(30, 7, "Payrall Ref#", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Basic", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Allow", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Gross Pay", 1, 0, "C", 1);
$pdf->Cell(20, 7, "NHIF", 1, 0, "C", 1);
$pdf->Cell(20, 7, "NSSF", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Statutory", 1, 0, "C", 1);
$pdf->Cell(20, 7, "PAYE", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Gross Bal", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Deductions", 1, 0, "C", 1);
$pdf->Cell(20, 7, "Net Pay", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 10;
$pdf->setXY($x, $y);


if($_GET['frm']=="all"){
		$from="*";
		$to="*";
		$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic, p.payrollref,p.month_ref,
	(select sum(allowance) as allaws from tbl_hr_payslips_all pa where pa.month_ref=p.date_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref";
	}else{
	$from=$_GET['frm'];
	$to=$_GET['to'];
	$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic, p.payrollref,p.month_ref,
	(select sum(allowance) as allaws from tbl_hr_payslips_all pa where pa.month_ref=p.date_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref and p.date_ref between '$from' and '$to'";
	
	}

$result = mysql_query($query);
$num=0;
$btotal=0;
$atotal=0;
$gtotal=0;
$nhtotal=0;
$nstotal=0;
$stotal=0;
$ptotal=0;
$grtotal=0;
$dtotal=0;
$netotal=0;
while($row = mysql_fetch_array($result)){
$num++;

	$pdf->setFont("times","","9");
	$pdf->Cell(10, 7, $num, 1);
   $pdf->Cell(40, 7, str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['mname']),  1);
	$pdf->Cell(30, 7, $row['payrollref'], 1);
	$pdf->Cell(20, 7, number_format($row['basic'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format($row['allaws'],2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format(($row['allaws']+$row['basic']),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['nhif'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['nssf'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['statutory'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['paye'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((((($row['allaws'])+($row['basic']))-($row['statutory']))),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['deds'])),2), 1, 0, "R", 0);
	$pdf->Cell(20, 7, number_format((($row['netpay'])),2), 1, 0, "R", 0);
	
	$y += 7;
	$btotal+=($row['basic']);
	$atotal+=($row['allaws']);
	$gtotal+=($row['allaws']+$row['basic']);
	$nhtotal+=($row['nhif']);
	$nstotal+=($row['nssf']);
	$stotal+=($row['statutory']);
	$ptotal+=($row['paye']);
	$grtotal+=((($row['allaws'])+($row['basic']))-($row['statutory']));
	$dtotal+=($row['deds']);
	$netotal+=($row['netpay']);
	if ($y > 180)
	{
		$pdf->AddPage('L');
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(10, 40);
		$pdf->Cell(10, 7, "#", 1, 0, "L", 1);
		$pdf->Cell(40, 7, "Employee", 1, 0, "C", 1);
		$pdf->Cell(30, 7, "Payroll Ref#", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Basic", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Allow", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Gross Pay", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "NHIF", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "NSSF", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Statutory", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "PAYE", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Gross Bal", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Deductions", 1, 0, "C", 1);
		$pdf->Cell(20, 7, "Net Pay", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 47;
	}
	
	$pdf->setXY($x, $y);
}
  $pdf->Cell(80, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($btotal,2), 1, 0, "R", 0);
   $pdf->Cell(20, 7, number_format($atotal,2), 1, 0, "R", 0);
    $pdf->Cell(20, 7, number_format($gtotal,2), 1, 0, "R", 0);
	 $pdf->Cell(20, 7, number_format($nhtotal,2), 1, 0, "R", 0);
	  $pdf->Cell(20, 7, number_format($nstotal,2), 1, 0, "R", 0);
	   $pdf->Cell(20, 7, number_format($stotal,2), 1, 0, "R", 0);
	    $pdf->Cell(20, 7, number_format($ptotal,2), 1, 0, "R", 0);
		 $pdf->Cell(20, 7, number_format($grtotal,2), 1, 0, "R", 0);
		  $pdf->Cell(20, 7, number_format($dtotal,2), 1, 0, "R", 0);
		   $pdf->Cell(20, 7, number_format($netotal,2), 1, 0, "R", 0);
		   
  $pdf->Output();

?>