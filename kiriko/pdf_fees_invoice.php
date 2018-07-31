<?php

require('fpdf.php');
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/Accounting.php';

class PeoplePDF extends FPDF {

//Page header
function Header(){
		$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
		$schoolname=$de['schname'];
		$address=$de['box'];
		$tele=$de['telphone'];
		$email=$de['email'];
		$web=$de['website'];
	}
	
	
	
	$form = $_GET['form'];
	$term = $_GET['term'];
	$yr = $_GET['yr'];
	$admno = $_GET['admno'];
	 
	
	//if(!file_exists("images/".$logref)){
 		 $logo="images/logo.JPG";
  		//}else{
 			//$logo = "images/".$logref;
 	// }
	 $snames = mysql_query("select sd.*,pd.* from studentdetails as sd inner join  parentdetails pd on  sd.admno=pd.admno and sd.admno='$admno'");
	while ($des = mysql_fetch_array($snames)) {// get names
		$studentname=$des['fname']." ".$des['lname'];
		//$parentname=$des['father']."    OR ".$des['mother'];
		$tele=$des['telephone'];
		$paddress=$des['address'];
		
	}
	
	 
		//$hcode=$_GET['hbar'];
 		 $barcode="images/barcode.PNG";
		 
	$this->SetFont('arial', '', 10);
	$this->Image($barcode,130,10,30,0);
	//$this->SetFont('arial', '', 7);
	//$this->Text(131, 10, "ponumber");
	$this->SetFont('arial', '', 8);
	$this->Text(20, 17, $schoolname);
	$this->Text(20, 22,'P.o.Box  '.$address);
	$this->Text(20, 27,'Telephone:  '.$tele);
	$this->Text(20, 32,'Website:  '.$web);
	$this->Text(20, 37,'Email:  '.$email);
	$this->SetFont('arial', 'B', 12);
	$this->Text(130, 25, 'School Fees Invoice');
	$this->SetFont('arial', '', 8);
	$this->Text(130, 30, 'Dated  ');
	$this->SetFont('arial', 'U', 9);
	$this->Text(140, 30,  date('Y-m-d'));
	$this->SetFont('arial', '', 8);
	$this->Text(130, 35, 'Admno #:   ');
	$this->Text(130, 39, 'Student Name:  ');
	$this->SetFont('arial', '', 9);
	$this->Text(155, 35, $admno);
	$this->Text(155, 39,  $studentname);
	
	$this->SetDrawColor(0, 0, 0);
	$this->SetFillColor(0, 0, 0);
	$this->Rect(20, 41, 170, 0);// the rectangle left,top,width, height
	$this->SetFont('arial', 'B', 12);
	$this->Text(20, 45, 'Parent Information');
	$this->SetFont('arial', '', 9);
	$this->Text(20, 50, 'Name: ');
	$this->Text(20, 55, 'Address: ');
	$this->Text(20, 60, 'Telephone: ');
	
	//$this->SetFont('arial', 'U', 9);
	$this->Text(40, 50,  "");
	$this->Text(40, 55,  $paddress);
  	$this->Text(40, 60,  $tele);
	
    $this->Ln(20);
	
	
}
//Page footer
	function Footer(){
		//Position at 1.5 cm from bottom
		$this->SetY(-15);
		//Arial italic 8
		$this->SetFont('Arial','I',8);
		//Page number
		 $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	}
	
	

}
$acc = new Accounting();
	
	$form = $_GET['form'];
	$term = $_GET['term'];
	$year = $_GET['yr'];
	$admno = $_GET['admno'];



$pdf = new FPDF();
$pdf = new PeoplePDF();
$pdf->AliasNbPages();//for page numbers
//$pdf->open();
$pdf->addPage();
$pdf->SetAutoPageBreak(false);
$pdf->SetFillColor(128,128,128); //gray
$pdf->setFont("times","","11");
$pdf->setXY(25, 70);
$pdf->Cell(120, 7, "Votehead Description", 1, 0, "L", 1);
$pdf->Cell(40, 7, "Amount", 1, 0, "R", 1);
$pdf->Ln();
$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);

		$fill=0;
		$totalitems=0;
		
		$sqlqulys = "select fv.votehead,fv.code,ff.amount from finance_voteheads as fv inner join finance_fees ff
on fv.votehead=ff.votehead  and ff.term=fv.term and fv.fiscal_year=ff.fiscal_yr and fv.fiscal_year ='$year' and fv.term='$term' and ff.form='$form' and ff.amount>0 order by fv.code asc ";
				 $getStd1s = mysql_query($sqlqulys);
				 
		
		while ($rows= mysql_fetch_array($getStd1s )) {
		$pdf->SetFillColor(224,235,255);
		$pdf->setFont("times","","9");
		$pdf->Cell(120, 7,  str_replace("_"," ",$rows['votehead']),  1, 0, "L", $fill);
		$pdf->Cell(40, 7,  number_format($rows['amount'],2),  1, 0, "R", $fill);
		
		
		
		$totalitems+=$rows['amount'];
		$y += 7;
	   	$fill=!$fill;
		if ($y > 275){
		$pdf->addPage();
		$pdf->SetAutoPageBreak(false);
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 70);
		$pdf->Cell(120, 7, "Votehead Description", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 70;
		}
		
	$pdf->setXY($x, $y);
		}
		
		
		
		$sqlqulys = "select * from finance_added_fees  where  fiscal_year ='$year' and term='$term' and admno='$admno'  and amount>0 order by votehead asc ";
				 $getStd1s = mysql_query($sqlqulys);
				 
		
		while ($rows= mysql_fetch_array($getStd1s )) {
		$pdf->SetFillColor(224,235,255);
		$pdf->setFont("times","","9");
		$pdf->Cell(120, 7,  str_replace("_"," ",$rows['votehead']),  1, 0, "L", $fill);
		$pdf->Cell(40, 7,  number_format($rows['amount'],2),  1, 0, "R", $fill);
		
		
		
		$totalitems+=$rows['amount'];
		$y += 7;
	   	$fill=!$fill;
		if ($y > 275){
		$pdf->addPage();
		$pdf->SetAutoPageBreak(false);
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","11");
		$pdf->setXY(25, 70);
		$pdf->Cell(120, 7, "Votehead Description", 1, 0, "C", 1);
		$pdf->Cell(40, 7, "Amount", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 70;
		}
		
	$pdf->setXY($x, $y);
		}
		
		
		
		
		
				


  
   $pdf->setX(115);
 $pdf->Cell(30, 5, "Total:", 1, 0, "R", 0);
 $pdf->Cell(40, 5, number_format($totalitems,2), 1, 0, "R", 0);
 $pdf->Ln(10);

 $y = $pdf->GetY();
  $pdf->setXY(25, $y);
  $pdf->Text(25, $y-1, "Additional Notes");
  $pdf->SetFont('arial', '', 8);
   $pdf->Text(25, $pdf->GetY()+3, "Cheques are addressed to");
 	$pdf->Ln();
 	$pdf->setX(25);
 	$y = $pdf->GetY();
	$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("arial","","9");
		$pdf->setXY(25, $y);
		$pdf->Cell(40, 5, "Account Number", 1, 0, "C", 0);
		$pdf->Cell(40, 5, "Bank", 1, 0, "C", 0);
		$pdf->Cell(40, 5, "Branch", 1, 0, "C", 0);
		$pdf->Ln();
	$y = $pdf->GetY();
$x = 25;
$pdf->setXY($x, $y);	
	 $getStd1s = mysql_query("select * from bank_accounts");
	while ($rows= mysql_fetch_array($getStd1s )) {
		$pdf->SetFillColor(224,235,255);
		$pdf->setFont("arial","","8");
		$pdf->Cell(40, 5, $rows['account_number'],  1, 0, "L",0);
		$pdf->Cell(40, 5,  $rows['bank_name'],  1, 0, "L", 0);
		$pdf->Cell(40, 5,  $rows['branch'],  1, 0, "L", 0);
		
		$y += 5;
		$pdf->setXY($x, $y);
		}
		

 
$pdf->Output();

