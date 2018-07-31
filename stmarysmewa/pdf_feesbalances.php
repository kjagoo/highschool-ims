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
	 
	$form=$_GET['form'];
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
	if($val1=="" || $val2==""){
	$this->Text(60, 35, 'Fees Balances Report:-'.$form." ".$term." Year ".$year);
  	}else{
	$this->Text(60, 35, 'Fees Balances Report:-'.$form." ".$term." Year ".$year." Range:".$val1."-".$val2);
	}
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
	$term=$_GET['term'];
	$year=$_GET['year'];
	$val1=$_GET['val1'];
	$val2=$_GET['val2'];
	
function getBalance($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  updated='$year' and term='$term'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}	

function getPaidAmountNextTerm($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT sum(votehead_amt) as amount from finance_feestructures where admno='$admno' and  year='$year' and term='$term' and statusis='OK'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}

	return $bal;
	}	
	
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
$pdf->Cell(15, 5, "Admno", 1, 0, "C", 1);
$pdf->Cell(50, 5, "Student Name", 1, 0, "C", 1);
$pdf->Cell(15, 5, "B/F", 1, 0, "C", 1);
$pdf->Cell(18, 5, "Fees".$term, 1, 0, "C", 1);
$pdf->Cell(18, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(18, 5, "Balance", 1, 0, "C", 1);
$pdf->Cell(18, 5, $nextterm." ".$nextyear, 1, 0, "C", 1);
$pdf->Cell(18, 5, $nextterm1." ".$nextyear1, 1, 0, "C", 1);

$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 

	
	if($term=="TERM 1"){
$myterm=1;
}
if($term=="TERM 2"){
$myterm=2;
}
if($term=="TERM 3"){
$myterm=3;
}
	
	if($val1=="" || $val2==""){
	$sql="select s.admno,s.fname,s.sname,s.lname, 
(select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form') as payable,
(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno) as paid,
   ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno)) as bal
	 from studentdetails as s 
 inner join finance_fees  as ff on ff.form=s.form 
	where s.form='$form' and ff.fiscal_yr='$year' group by s.admno";
	}else{
	
	$sql="select s.admno,s.fname,s.sname,s.lname, 
(select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form') as payable,
(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno) as paid,
   
   ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno)) as bal
	 
 from studentdetails as s 
 inner join finance_fees  as ff on ff.form=s.form 
	where s.form='$form' and ff.fiscal_yr='$year'  group by admno
	having 
	((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno))>=$val1
    and ((select sum(amount)as total from finance_fees 
	where fiscal_yr='$year' and term='$term' and form='$form')-
	(SELECT CAST(sum(votehead_amt) as DECIMAL) as total
   FROM finance_feestructures where year='$year' and term='$term' and admno=s.admno))
	 <=$val2";
	
	}
	
$result = mysql_query($sql);
$num=0;
$totalpayable=0;
$totalpaid=0;
$totalbal=0;
$totalnextt=0;
$totalnextterm=0;
$totalblbf=0;
$totalblbfo=0;
$over=0;
$fill=0;
while($row = mysql_fetch_array($result)){
$num++;
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1, 0, "L", $fill);
	$pdf->Cell(15, 5, $row['admno'],  1, 0, "L", $fill);
	$pdf->Cell(50, 5, $row['fname']." ".$row['lname']." ".$row['sname'], 1, 0, "L", $fill);
	
	$pdf->Cell(15, 5, number_format( getBalance( $row['admno'],($year-1),$term),2), 1, 0, "R", $fill);
	$pdf->SetTextColor(0,0,255);//bLUE
	$pdf->Cell(18, 5, number_format($row['payable'],2), 1, 0, "R", $fill);
	$pdf->SetTextColor(0,128,0);//gREEN
	$pdf->Cell(18, 5, number_format($row['paid'],2), 1, 0, "R", $fill);
	$pdf->SetTextColor(255,0,0);//RED
	
	$pdf->SetTextColor(0,0,0);//bLACK
	
	$bal=((getBalance($row['admno'],($year-1),$term))+$row['payable'])-$row['paid'];
	if($bal>$row['payable']){ 
	$pdf->Cell(18, 5, number_format($bal,2), 1, 0, "R", $fill);
	$over+=$bal;
	}else{
	$pdf->Cell(18, 5, number_format($bal,2), 1, 0, "R", $fill);
	$totalbal+=$bal;
	}
	$pdf->Cell(18, 5, number_format( (getPaidAmountNextTerm($row['admno'],$nextyear,$nextterm)),2), 1, 0, "R", $fill);
	$pdf->Cell(18, 5, number_format( (getPaidAmountNextTerm($row['admno'],$nextyear1,$nextterm1)),2), 1, 0, "R", $fill);
	
	$totalpayable+=$row['payable'];
	$totalpaid+=$row['paid'];
	$totalnextt+=getPaidAmountNextTerm($row['admno'],$nextyear,$nextterm);
	$totalnextterm+=getPaidAmountNextTerm($row['admno'],$nextyear1,$nextterm1);
	
	if(getBalance( $row['admno'],($year-1),$term)<0){
	$totalblbfo+=getBalance( $row['admno'],($year-1),$term);
	}else{
	$totalblbf+=getBalance( $row['admno'],($year-1),$term);
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
$pdf->Cell(15, 5, "Admno", 1, 0, "C", 1);
$pdf->Cell(50, 5, "Student Name", 1, 0, "C", 1);
$pdf->Cell(15, 5, "B/F", 1, 0, "C", 1);
$pdf->Cell(18, 5, "Fees".$term, 1, 0, "C", 1);
$pdf->Cell(18, 5, "Paid", 1, 0, "C", 1);
$pdf->Cell(18, 5, "Balance", 1, 0, "C", 1);
$pdf->Cell(18, 5, $nextterm." ".$nextyear, 1, 0, "C", 1);
$pdf->Cell(18, 5, $nextterm1." ".$nextyear1, 1, 0, "C", 1);

		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
 $pdf->Cell(75, 7, "Summary:", 1, 0, "R", 0);
  $pdf->Cell(15, 7, "", 1, 0, "R", 0);
  $pdf->Cell(18, 7, number_format($totalpayable,2), 1, 0, "R", 0);
 $pdf->Cell(18, 7, number_format($totalpaid,2), 1, 0, "R", 0);
 $pdf->Cell(18, 7, number_format($totalbal,2), 1, 0, "R", 0);
  $pdf->Cell(18, 7, number_format($totalnextt,2), 1, 0, "R", 0);
   $pdf->Cell(18, 7, number_format($totalnextterm,2), 1, 0, "R", 0);
 $pdf->Ln();
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 $pdf->Cell(75, 7, "Arrears ".($year-1).":", 1, 0, "R", 0);
  $pdf->Cell(15, 7, number_format($totalblbf,2), 1, 0, "R", 0);
  $pdf->Ln();
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
  $pdf->Cell(75, 7, "Overpayments ".($year-1).":", 1, 0, "R", 0);
  $pdf->Cell(15, 7, number_format($totalblbfo,2), 1, 0, "R", 0);
  $pdf->Ln();
$pdf->Output();

?>