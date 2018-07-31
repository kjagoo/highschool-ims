<?php
require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/fees.php';
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
	 
	$form=$_GET['form'];
	$stream=$_GET['stream'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$val1=$_GET['val1'];
	$val2=$_GET['val2'];
		
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
	$this->Image($barcode,160,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(161, 25, $hcode);
	$this->SetFont('arial', '', 9);
	$this->Text(60, 17, $schoolname);
	$this->Text(60, 22,'P.o.Box  '.$address);
	$this->Text(65, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	
	$this->Text(60, 35, 'Fees Balances Report:-'.$form." ".$stream." ".$term." Year ".$year);
  	
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



	$form=$_GET['form'];
	$stream=$_GET['stream'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$val1=$_GET['val1'];
	$val2=$_GET['val2'];
	

	$nextterm="";
	$nextterm1="";
	$nextyear1="";
		$nextyear="";
		if($term=='TERM 1'){
		$nextterm="TERM 2";
		$nextterm1="TERM 3";
		$nextyear=$year;
		$nextyear1=($year);
		}
		if($term=='TERM 2'){
		$nextterm="TERM 3";
		$nextterm1="TERM 1";
		$nextyear1=($year+1);
		$nextyear=($year);
		}
		if($term=='TERM 3'){
		$nextterm="TERM 1";
		$nextterm1="TERM 1";
		$nextyear1=($year+1);
		$nextyear=($year+1);
		}

$fee = new fees();
		
$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black

 
 
//table header
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","8");
$pdf->setXY(20, 40);
$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
$pdf->Cell(20, 5, "Admno", 1, 0, "C", 1);
$pdf->Cell(60, 5, "Student Name", 1, 0, "C", 1);
$pdf->Cell(20, 5, "B/F", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Fees".$term, 1, 0, "C", 1);
$pdf->Cell(20, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Balance", 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 
$num=0;
		$totals=0;
		$bal=0;
		$over=0;
		$paids=0;
		$payables=0;
		$fill=0;
		$sql="select distinct(fsi.admno),sd.*   from finance_student_invoices  as fsi inner join studentdetails as sd on fsi.admno=sd.admno and sd.form='$form' and sd.class='$stream' ";
		 $result = mysql_query($sql);
		 while($row=mysql_fetch_array($result)){ 
		 $num++;
		 $admno=$row['admno'];

	$lastyearfees=$fee->getInvoiceAmt(($year-1),'TERM 1',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 2',$admno)+$fee->getInvoiceAmt(($year-1),'TERM 3',$admno);
	$totalpaidamountlastyear=$fee->getPaidAmt(($year-1),$admno,'TERM 1')+$fee->getPaidAmt(($year-1),$admno,'TERM 2')+$fee->getPaidAmt(($year-1),$admno,'TERM 3');
	
	
	$bal=$lastyearfees-$totalpaidamountlastyear+$fee->getBF($year,$admno,'TERM 1');
	
	$payable=$fee->getInvoiceAmt(($year),$term,$admno);
	$added=$fee->getAddedAmt($year,$admno,$term);
	
	$paid=$fee->getPaidAmt(($year),$admno,$term);

	
	$T1balan=($fee->getInvoiceAmt(($year),"TERM 1",$admno)+$fee->getAddedAmt($year,$admno,'TERM 1')+$bal)-$fee->getPaidAmt(($year),$admno,"TERM 1");
	$T2balan=($fee->getInvoiceAmt(($year),"TERM 2",$admno)+$fee->getAddedAmt($year,$admno,'TERM 2')+$T1balan)-$fee->getPaidAmt(($year),$admno,"TERM 2");
	$T3balan=($fee->getInvoiceAmt(($year),"TERM 3",$admno)+$fee->getAddedAmt($year,$admno,'TERM 3')+$T2balan)-$fee->getPaidAmt(($year),$admno,"TERM 3");
	if($term=='TERM 1'){
		$balanc=$T1balan;
		$balBF=$bal;
	}
	if($term=='TERM 2'){
		$balanc=$T2balan;
		$balBF=$T1balan;
	}
	if($term=='TERM 3'){
		$balanc=$T3balan;
		$balBF=$T2balan;
	}
	
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(20, 5, $admno,  1, 0, "L", $fill);
	$pdf->Cell(60, 5, $row['fname']." ".$row['sname']." ".$row['lname'], 1, 0, "L", $fill);
	$pdf->Cell(20, 5, number_format($balBF,2), 1, 0, "R", $fill);
	
	$pdf->Cell(20, 5, number_format($payable+$added,2), 1, 0, "R", $fill);
	
	$pdf->Cell(20, 5, number_format($paid,2), 1, 0, "R", $fill);
	
	$pdf->SetTextColor(0,0,0);//bLACK
	$pdf->Cell(20, 5, number_format($balanc,2), 1, 0, "R", $fill);
	
	$payables+=$payable+$added+$balBF;
	$paids+=$paid;
	if($balBF<0){
		$totals+=($payable+$added)-$paid;
	}else{
	$totals+=($payable+$added+$balBF)-$paid;
		 }
	$y += 5;
	$fill=!$fill;
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","8");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
$pdf->Cell(20, 5, "Admno", 1, 0, "C", 1);
$pdf->Cell(60, 5, "Student Name", 1, 0, "C", 1);
$pdf->Cell(20, 5, "B/F", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Fees".$term, 1, 0, "C", 1);
$pdf->Cell(20, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Balance", 1, 0, "C", 1);

		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
 $pdf->Cell(90, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(20, 7, "", 1, 0, "R", 0);
  $pdf->Cell(20, 7, number_format($payables,2), 1, 0, "R", 0);
 $pdf->Cell(20, 7, number_format($paids,2), 1, 0, "R", 0);
 $pdf->Cell(20, 7, number_format($totals,2), 1, 0, "R", 0);
 $pdf->Ln();

$pdf->Output();

?>