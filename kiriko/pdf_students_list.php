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
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->SetFont('arial', 'B', 10);
	if($_GET['id']=="available"){
	$this->Text(75, 35, 'School Enrollment Report '.$y);
  	}else{
	$this->Text(75, 35, 'School Alumni Report '.$y);
	}
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
		 $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');
	}
	
	

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
$pdf->setFont("times","","9");
$pdf->setXY(20, 40);
$pdf->Cell(10, 5, "No.", 1, 0, "L", 1);
$pdf->Cell(70, 5, "Student Name", 1, 0, "C", 1);
$pdf->Cell(20, 5, "ADM N0", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Gender", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Form", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Yr of Adm", 1, 0, "C", 1);
$pdf->Cell(20, 5, "Contact", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 20;
$pdf->setXY($x, $y);
 
 if($_GET['id']=="available"){
$sql ="select sd.*,pd.telephone from studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form in('FORM 1','FORM 2','FORM 3','FORM 4')  order by sd.form asc, sd.class asc, sd.fname asc";
}else{
$sql ="select sd.*,pd.telephone from studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and  pd.form='FORM 5' order by sd.year_finished asc, sd.class asc, sd.fname asc";
}
$result = mysql_query($sql);
$num=0;
while($row = mysql_fetch_array($result)){
$num++;

	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $num, 1);
    $pdf->Cell(70, 5, str_replace("&","'", $row['fname'])." ".str_replace("&","'",$row['sname'])." ".str_replace("&","'",$row['lname']), 1);
	$pdf->Cell(20, 5, $row['admno'], 1);
	$pdf->Cell(20, 5, $row['gender'], 1);
	$pdf->Cell(20, 5, $row['form']." ".$row['class'],1);
	$pdf->Cell(20, 5, $row['yrofadmn'], 1, 0, "R", 0);
	$pdf->Cell(20, 5, $row['telephone'], 1, 0, "R", 0);
	
	$y += 5;
	
	if ($y > 275)
	{
		$pdf->AddPage();
		$pdf->SetFillColor(128,128,128); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(20, 40);
		$pdf->Cell(10, 5, "#", 1, 0, "L", 1);
		$pdf->Cell(70, 5, "Student Name", 1, 0, "C", 1);
		$pdf->Cell(20, 5, "ADM N0", 1, 0, "C", 1);
		$pdf->Cell(20, 5, "Gender", 1, 0, "C", 1);
		$pdf->Cell(20, 5, "Form", 1, 0, "C", 1);
		$pdf->Cell(20, 5, "Yr of Adm", 1, 0, "C", 1);
		$pdf->Cell(20, 5, "Contact", 1, 0, "C", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}
 
$pdf->Output();