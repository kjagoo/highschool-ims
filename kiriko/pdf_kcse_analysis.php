<?php

require('fpdf.php');
include('includes/dbconnector.php');
include 'includes/DAO.php';
include 'includes/SubjectTally.php';

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
	$year=$_GET['year'];
	$stream=$_GET['stream'];
	
 		 $logo="images/logo.JPG";
	 
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
	$this->Image($logo,20,10,30,28);
	$this->Image($barcode,200,10,0,0);
	$this->SetFont('arial', '', 7);
	$this->Text(201, 25, $hcode);
	$this->SetFont('times', '', 12);
	$this->Text(70, 17, $schoolname);
	$this->Text(70, 22,'P.o.Box  '.$address);
	$this->Text(70, 27,'Telephone:  '.$tele);
	$this->Text(75, 35, 'KCSE ANALYSIS  Year '.$year." Class ".$stream);
  
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
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

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
$pdf->SetFillColor(204,255,204); //gray
$pdf->setFont("times","","9");
$pdf->setXY(15, 40);
		$pdf->Cell(10, 5, "Admno", 1, 0, "L", 1);
		$pdf->Cell(20, 5, "Index No", 1, 0, "L", 1);
		$pdf->Cell(50, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Strm", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Eng", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Kisw", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Maths", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Bio", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Phy", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Chem", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "His", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Geo", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Cre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Agr", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "B/st", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Comp", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "H/Sci", 1, 0, "C", 1);
		
		$pdf->Cell(7, 5, "Pts", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Mss", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "GD", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "VAP", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "Pos", 1, 0, "C", 1);
$pdf->Ln();
//gegevens van database
$y = $pdf->GetY();
$x = 15;
$pdf->setXY($x, $y);


	$year=$_GET['year'];
	$stream=$_GET['stream'];

if($stream=="Entire"){
	 $moreq="";
	}else{
	$moreq= "and sd.class='$stream'";
	
	}

//$sql="select * from kcse_final_analysis where form='$form' and strm='$strm'  and year_finished='$year' order by $positionby desc, $alternatepositionby desc";
//$sql="SELECT t2.*, ROWNUM FROM (
    //SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    //(SELECT t1.averagepoints, @rownum:=@rownum + 1 AS rownum
        //FROM kcse_final_analysis t1, (SELECT @rownum:=0) r where  t1.year_finished='$year' 
		// ORDER BY t1.averagepoints desc) q1 
             //GROUP BY q1.averagepoints) 
   // q2,kcse_final_analysis t2 WHERE  t2.averagepoints=q2.averagepoints 
   // and  t2.year_finished='$year' 
   // ORDER BY t2.averagepoints desc;";
$sql="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.averagepoints, @rownum:=@rownum + 1 AS rownum
        FROM kcse_final_analysis t1 inner join studentdetails sd on t1.adm=sd.admno $moreq, (SELECT @rownum:=0) r where  t1.year_finished='$year'  
		 ORDER BY t1.averagepoints desc) q1 
             GROUP BY q1.averagepoints) 
    q2,kcse_final_analysis t2 
    inner join studentdetails sd on t2.adm=sd.admno 
     and  t2.averagepoints=q2.averagepoints 
    and  t2.year_finished='$year' $moreq 
    ORDER BY t2.averagepoints desc";

$result = mysql_query($sql);
if(!$result){
echo "Error ".mysql_error();
}
$num=0;
$fill=0;
while($row = mysql_fetch_array($result)){
$num++;

$pi=0;
$vap=0;
	$adm=$row['adm'];
	$resultSTRM = mysql_query("select class,marks from studentdetails where admno='$adm'");
	while ($rowrstrm = mysql_fetch_array($resultSTRM)) {
	$strm=$rowrstrm['class'];
	$kmarks=$rowrstrm['marks'];
	}
	$kcpepoints=$kmarks/5;
	if ($kcpepoints >= 0 && $kcpepoints <= 29) {
			$kcpepointsgrade = "E";
			$kcpept=1;
			
		} else if ($kcpepoints >= 30 && $kcpepoints <= 34 ){
			$kcpepointsgrade = "D-";
			$kcpept=2;
			
		} else if ($kcpepoints >= 35 && $kcpepoints <= 39) {
			$kcpepointsgrade = "D";
			$kcpept=3;
			
		} else if ($kcpepoints >= 40 && $kcpepoints <= 44) {
			$kcpepointsgrade = "D+";
			$kcpept=4;
			
		} else if ($kcpepoints >= 45 && $kcpepoints <= 49) {
			$kcpepointsgrade = "C-";
			$kcpept=5;
		
		} else if ($kcpepoints >= 50 && $kcpepoints <= 54) {
			$kcpepointsgrade = "C";
			$kcpept=6;
			
		} else if ($kcpepoints >= 55 && $kcpepoints <= 59) {
			$kcpepointsgrade = "C+";
			$kcpept=7;
			
		} else if ($kcpepoints >= 60 && $kcpepoints <= 64) {
			$kcpepointsgrade = "B-";
			$kcpept=8;
			
		} else if ($kcpepoints >= 65 && $kcpepoints <= 69) {
			$kcpepointsgrade = "B";
			$epoint=9;
			
		} else if ($kcpepoints >= 70 && $kcpepoints <= 74) {
			$kcpepointsgrade = "B+";
			$kcpept=10;
			
		} else if ($kcpepoints >= 75 && $kcpepoints <= 79) {
			$kcpepointsgrade = "A-";
			$kcpept=11;
			
		} else if ($kcpepoints >= 80 && $kcpepoints <= 100) {
			$kcpepointsgrade = "A";
			$kcpept=12;
			
		}
		
	$vap=	$row['averagepoints']-$kcpept;
	
	$pdf->SetFillColor(224,235,255);
	$pdf->setFont("times","","8");
	$pdf->Cell(10, 5, $adm, 1, 0, "L", $fill);
	$pdf->Cell(20, 5, $row['indexnumber'], 1, 0, "L", $fill);
    $pdf->Cell(50, 5, str_replace("&","'",$row['names']),  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $strm, 1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['english'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['kiswahili'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['mathematics'],1, 0, "L", $fill);
	
	if($row['biology']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['biology'],  1, 0, "L", $fill);
	}
	if($row['physics']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['physics'],  1, 0, "L", $fill);
	}
	if($row['chemistry']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['chemistry'],  1, 0, "L", $fill);
	}
	if($row['history']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['history'],  1, 0, "L", $fill);
	}
	if($row['geography']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['geography'],  1, 0, "L", $fill);
	}
	if($row['cre']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['cre'],  1, 0, "L", $fill);
	}
	if($row['agriculture']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['agriculture'],  1, 0, "L", $fill);
	}
	if($row['businesStudies']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['businesStudies'],  1, 0, "L", $fill);
	}
	if($row['french']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['french'],  1, 0, "L", $fill);
	}
	if($row['computer']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['computer'],  1, 0, "L", $fill);
	}
	if($row['home']=="0"){
	$pdf->Cell(10, 5, "-"." "."-",  1, 0, "L", $fill);
	}else{
	$pdf->Cell(10, 5, $row['home'],  1, 0, "L", $fill);
	}
	
	
	$pdf->SetTextColor(245,15,61);
	$pdf->Cell(7, 5, $row['points'],  1, 0, "L", $fill);
	$pdf->Cell(10, 5, $row['averagepoints'],  1, 0, "L", $fill);
	$pdf->SetTextColor(25,212,62);
	$pdf->Cell(8, 5, $row['tgrade'],  1, 0, "L", $fill);
	$pdf->SetTextColor(0,0,0);
	$pdf->Cell(10, 5, $vap,  1, 0, "R", $fill);
	$pdf->Cell(8, 5,  $row['ROWNUM'],  1, 0, "R", $fill);
	
	$y += 5;
	$fill=!$fill;
	if ($y > 180){
		$pdf->AddPage('L');
		$pdf->SetFillColor(204,255,204); //gray
		$pdf->setFont("times","","9");
		$pdf->setXY(15, 40);
		$pdf->Cell(10, 5, "Admno", 1, 0, "L", 1);
		$pdf->Cell(20, 5, "Index No", 1, 0, "L", 1);
		$pdf->Cell(50, 5, "Student Full Name", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Strm", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Eng", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Kisw", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Maths", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Bio", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Phy", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Chem", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "His", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Geo", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Cre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Agr", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "B/st", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Fre", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Comp", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "H/Sci", 1, 0, "C", 1);
		
		$pdf->Cell(7, 5, "Pts", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "Mss", 1, 0, "C", 1);
		$pdf->Cell(8, 5, "GD", 1, 0, "C", 1);
		$pdf->Cell(10, 5, "VAP", 1, 0, "R", 1);
		$pdf->Cell(8, 5, "Pos", 1, 0, "R", 1);
		$pdf->Ln();
		$y = 45;
	}
	
	$pdf->setXY($x, $y);
}//end of while



	 $geta = mysql_query("select count(kf.tgrade) as a from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='A' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($geta)) {// get admno
	$as=$rowAS['a'];
	
	}
	$getam = mysql_query("select count(kf.tgrade) as am from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='A-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getam)) {// get admno
	$am=$rowAS['am'];

	}
	$getbp = mysql_query("select count(kf.tgrade) as bp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbp)) {// get admno
	$bp=$rowAS['bp'];
	}
	
	$getbs = mysql_query("select count(kf.tgrade) as bs from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbs)) {// get admno
	$bs=$rowAS['bs'];
	}
	
	$getbm = mysql_query("select count(kf.tgrade) as bm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='B-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getbm)) {// get admno
	$bm=$rowAS['bm'];
	}
	
	$getcp = mysql_query("select count(kf.tgrade) as cp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcp)) {// get admno
	$cp=$rowAS['cp'];
	}
	
	$getcs = mysql_query("select count(kf.tgrade) as cs from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcs)) {// get admno
	$cs=$rowAS['cs'];
	}
	
	$getcm = mysql_query("select count(kf.tgrade) as cm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='C-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getcm)) {// get admno
	$cm=$rowAS['cm'];
	}
	
	$getdp = mysql_query("select count(kf.tgrade) as dp from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D+' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getdp)) {// get admno
	$dp=$rowAS['dp'];
	}
	
	$getds = mysql_query("select count(kf.tgrade) as ds from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getds)) {// get admno
	$ds=$rowAS['ds'];
	}
	
	$getdm = mysql_query("select count(kf.tgrade) as dm from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='D-' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getdm)) {// get admno
	$dm=$rowAS['dm'];
	}
	
	$getes = mysql_query("select count(kf.tgrade) as esd from kcse_final_analysis as kf
inner join studentdetails as sd on kf.adm=sd.admno  and kf.tgrade='E' and kf.year_finished='$year' $moreq");
	while ($rowAS = mysql_fetch_array($getes)) {// get admno
	$es=$rowAS['esd'];
	
	}
	
	$studentsare=0;
	$getstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.english!='X' and km.english !='Y' and km.english!='P' 
and km.biology!='P' and km.biology!='Y' and km.biology!='X' $moreq");
	while ($rowstud = mysql_fetch_array($getstudents)) {// get admno
	$studentsare=$rowstud['adms'];
	}
	
	$ap=$as*12;
	$amp=$am*11;
	$bpp=$bp*10;
	$bsp=$bs*9;
	$bmp=$bm*8;
	$cpp=$cp*7;
	$csp=$cs*6;
	$cmp=$cm*5;
	$dpp=$dp*4;
	$dsp=$ds*3;
	$dmp=$dm*2;
	$esp=$es*1;
	
	
	$classtotalp=$ap+$amp+$bpp+$bsp+$bmp+$cpp+$csp+$cmp+$dpp+$dsp+$dmp+$esp;
	
	
	

	$pdf->AddPage('L');
	$pdf->setXY(25, 40);
	$pdf->setFont("times","B","12");
	$pdf->Cell(150, 7, "Class Mean Score Summary", 1, 0, "L", 1);
	$pdf->Ln(7);
	$pdf->setX(25);
	$pdf->setFont("arial","B","10");
	$pdf->Cell(50, 5, "Class", 1, 0, "C", 1);
	$pdf->Cell(50, 5, "# Students", 1, 0, "C", 1);
	$pdf->Cell(50, 5, "Mean", 1, 0, "C", 1);
	$pdf->Ln();
		
		$overall=0;
		$fms=0;
		$overmean=0.00;
		$stdtotal=0;
		$q="select (sum(kf.averagepoints)) as mean from kcse_final_analysis as kf
inner join studentdetails sd on kf.adm=sd.admno 
and  kf.tgrade!='X' and kf.tgrade!='Y' and kf.tgrade!='P'  and kf.year_finished='$year' $moreq";
	$mes=mysql_query($q);
	$pdf->SetFillColor(204,255,204); //gray
	while ($qs = mysql_fetch_array($mes)) { 
	
		$stdtotal=$qs['mean'];
	}//end of while

	$overmean=round_up (($classtotalp/$studentsare),3);
	$pdf->setX(25);
	$pdf->Cell(50, 7, "Overall Score ", 1, 0, "L", 1);
	$pdf->Cell(50, 7, $studentsare, 1, 0, "L", 1);
	$pdf->Cell(50, 7, $overmean, 1, 0, "L", 1);
	$pdf->Ln(20);
	
	$pdf->setX(25);
	$pdf->setFont("times","B","12");
	$pdf->Cell(218, 7, "Students Mean  Summary", 1, 0, "L", 1);
	$pdf->Ln(7);
	$pdf->setX(25);
	$pdf->setFont("arial","B","10");
	$pdf->Cell(20, 6, "A", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "A-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "B-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "C-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D+", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "D-", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "E", 1, 0, "L", 1);
	 
	$pdf->Ln();
	$pdf->setX(25);
	$pdf->Cell(20, 6, $as, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $am, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bs, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $bm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cs, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $cm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $dp, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $ds, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $dm, 1, 0, "L", 1);
	$pdf->Cell(18, 6, $es, 1, 0, "L", 1);
	
	


$getenglish = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A' and km.year_finished='$year'  $moreq");
	while ($roweng = mysql_fetch_array($getenglish)) {// get admno
	$englishas=$roweng['engas'];
	$engpoA=$englishas*12;
	}
	$getenglishm = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A-' and km.year_finished='$year'  $moreq ");
	while ($rowengm = mysql_fetch_array($getenglishm)) {// get admno
	$englisham=$rowengm['engas'];
	$engpoAm=$englisham*11;
	}
	$getenglishBP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B+' and km.year_finished='$year'  $moreq");
	while ($rowengbp = mysql_fetch_array($getenglishBP)) {// get admno
	$englishabp=$rowengbp['engas'];
	$engpoBP=$englishabp*10;
	}
	$getenglishB = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B' and km.year_finished='$year'  $moreq");
	while ($rowengb = mysql_fetch_array($getenglishB)) {// get admno
	$englishab=$rowengb['engas'];
	$engpoB=$englishab*9;
	}
	$getenglishBM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='B-' and km.year_finished='$year'  $moreq ");
	while ($rowengbm = mysql_fetch_array($getenglishBM)) {// get admno
	$englishabm=$rowengbm['engas'];
	$engpoBm=$englishabm*8;
	}
	$getenglishCP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C+' and km.year_finished='$year'  $moreq ");
	while ($rowengcp = mysql_fetch_array($getenglishCP)) {// get admno
	$englishacp=$rowengcp['engas'];
	$engpoCp=$englishacp*7;
	}
	$getenglishC = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C' and km.year_finished='$year'  $moreq ");
	while ($rowengc = mysql_fetch_array($getenglishC)) {// get admno
	$englishac=$rowengc['engas'];
	$engpoC=$englishac*6;
	}
	$getenglishCM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='C-' and km.year_finished='$year'  $moreq ");
	while ($rowengcm = mysql_fetch_array($getenglishCM)) {// get admno
	$englishacm=$rowengcm['engas'];
	$engpoCm=$englishacm*5;
	}
	$getenglishDP = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D+' and km.year_finished='$year'  $moreq ");
	while ($rowengdp = mysql_fetch_array($getenglishDP)) {// get admno
	$englishadp=$rowengdp['engas'];
	$engpoDp=$englishadp*4;
	}
	$getenglishD = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D' and km.year_finished='$year'  $moreq ");
	while ($rowengd = mysql_fetch_array($getenglishD)) {// get admno
	$englishad=$rowengd['engas'];
	$engpoD=$englishad*3;
	}
	$getenglishDM = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='D-' and km.year_finished='$year'  $moreq ");
	while ($rowengdm = mysql_fetch_array($getenglishDM)) {// get admno
	$englishadm=$rowengdm['engas'];
	$engpoDm=$englishadm*2;
	}
	$getenglishE = mysql_query("select count(km.english) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='E' and km.year_finished='$year'  $moreq ");
	while ($rowengde = mysql_fetch_array($getenglishE)) {// get admno
	$englishade=$rowengde['engas'];
	$engpoE=$englishade*1;
	}
	
	$englishStudents=0;
	$getengstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.english!='X' and km.english !='Y' and km.english!='P'  $moreq");
	while ($rowenglishstud = mysql_fetch_array($getengstudents)) {// get admno
	$englishStudents=$rowenglishstud['adms'];
	}
	
	$getkiswahili = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.english='A' and km.year_finished='$year'  $moreq");
	while ($rowkis = mysql_fetch_array($getkiswahili)) {// get admno
	$kisas=$rowkis['engas'];
	$kisA=$kisas*12;
	}
	$getkiswahilim = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='A-' and km.year_finished='$year'  $moreq ");
	while ($rowkism = mysql_fetch_array($getkiswahilim)) {// get admno
	$kisam=$rowkism['engas'];
	$kisAm=$kisam*11;
	}
	$getkiswahiliBP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B+' and km.year_finished='$year'  $moreq");
	while ($rowkisbp = mysql_fetch_array($getkiswahiliBP)) {// get admno
	$kisbp=$rowkisbp['engas'];
	$kisBP=$kisbp*10;
	}
	$getkiswahiliB = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B' and km.year_finished='$year'  $moreq");
	while ($rowkisb = mysql_fetch_array($getkiswahiliB)) {// get admno
	$kisb=$rowkisb['engas'];
	$kisB=$kisb*9;
	}
	$getkiswahiliBM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='B-' and km.year_finished='$year'  $moreq ");
	while ($rowkisbm = mysql_fetch_array($getkiswahiliBM)) {// get admno
	$kisbm=$rowkisbm['engas'];
	$kisBm=$kisbm*8;
	}
	$getkiswahiliCP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowkiscp = mysql_fetch_array($getkiswahiliCP)) {// get admno
	$kiscp=$rowkiscp['engas'];
	$kisCp=$kiscp*7;
	}
	$getkiswahiliC = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C' and km.year_finished='$year'  $moreq ");
	while ($rowkisc = mysql_fetch_array($getkiswahiliC)) {// get admno
	$kisc=$rowkisc['engas'];
	$kisC=$kisc*6;
	}
	$getkiswahiliCM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='C-' and km.year_finished='$year'  $moreq ");
	while ($rowkiscm = mysql_fetch_array($getkiswahiliCM)) {// get admno
	$kiscm=$rowkiscm['engas'];
	$kisCm=$kiscm*5;
	}
	$getkiswahiliDP = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowkisdp = mysql_fetch_array($getkiswahiliDP)) {// get admno
	$kisdp=$rowkisdp['engas'];
	$kisDp=$kisdp*4;
	}
	$getkiswahiliD = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D' and km.year_finished='$year'  $moreq  ");
	while ($rowkisd = mysql_fetch_array($getkiswahiliD)) {// get admno
	$kisd=$rowkisd['engas'];
	$kisD=$kisd*3;
	}
	$getkiswahiliDM = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowkisdm = mysql_fetch_array($getkiswahiliDM)) {// get admno
	$kisdm=$rowkisdm['engas'];
	$kisDm=$kisdm*2;
	}
	$getkiswahiliE = mysql_query("select count(km.kiswahili) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.kiswahili='E' and km.year_finished='$year'  $moreq  ");
	while ($rowkisde = mysql_fetch_array($getkiswahiliE)) {// get admno
	$kisde=$rowkisde['engas'];
	$kisE=$kisde*1;
	}
	
	$kiswahiliStudents=0;
	$getkiswahilistudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.kiswahili!='X' and km.kiswahili !='Y' and km.kiswahili!='P'  $moreq");
	while ($rowkiswahilistud = mysql_fetch_array($getkiswahilistudents)) {// get admno
	$kiswahiliStudents=$rowkiswahilistud['adms'];
	}
	
	$getmath = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='A' and km.year_finished='$year'  $moreq ");
	while ($rowmath = mysql_fetch_array($getmath)) {// get admno
	$mathas=$rowmath['engas'];
	$mathA=$mathas*12;
	}
	$getmathm = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='A-' and km.year_finished='$year'  $moreq ");
	while ($rowmathm = mysql_fetch_array($getmathm)) {// get admno
	$matham=$rowmathm['engas'];
	$mathAm=$matham*11;
	}
	$getmathBP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B+' and km.year_finished='$year'  $moreq ");
	while ($rowmathbp = mysql_fetch_array($getmathBP)) {// get admno
	$mathbp=$rowmathbp['engas'];
	$mathBP=$mathbp*10;
	}
	$getmathB = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B' and km.year_finished='$year'  $moreq ");
	while ($rowmathb = mysql_fetch_array($getmathB)) {// get admno
	$mathb=$rowmathb['engas'];
	$mathB=$mathb*9;
	}
	$getmathBM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='B-' and km.year_finished='$year' $moreq ");
	while ($rowmathbm = mysql_fetch_array($getmathBM)) {// get admno
	$mathbm=$rowmathbm['engas'];
	$mathBm=$mathbm*8;
	}
	$getmathCP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowmathcp = mysql_fetch_array($getmathCP)) {// get admno
	$mathcp=$rowmathcp['engas'];
	$mathCp=$mathcp*7;
	}
	$getmathC = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C' and km.year_finished='$year'  $moreq  ");
	while ($rowmathc = mysql_fetch_array($getmathC)) {// get admno
	$mathc=$rowmathc['engas'];
	$mathC=$mathc*6;
	}
	$getmathCM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='C-' and km.year_finished='$year'  $moreq   ");
	while ($rowmathcm = mysql_fetch_array($getmathCM)) {// get admno
	$mathcm=$rowmathcm['engas'];
	$mathCm=$mathcm*5;
	}
	$getmathDP = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowmathdp = mysql_fetch_array($getmathDP)) {// get admno
	$mathdp=$rowmathdp['engas'];
	$mathDp=$mathdp*4;
	}
	$getmathD = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D' and km.year_finished='$year'  $moreq  ");
	while ($rowmathd = mysql_fetch_array($getmathD)) {// get admno
	$mathd=$rowmathd['engas'];
	$mathD=$mathd*3;
	}
	$getmathDM = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='D-' and km.year_finished='$year'  $moreq   ");
	while ($rowmathdm = mysql_fetch_array($getmathDM)) {// get admno
	$mathdm=$rowmathdm['engas'];
	$mathDm=$mathdm*2;
	}
	$getmathE = mysql_query("select count(km.math) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.math='E' and km.year_finished='$year'  $moreq   ");
	while ($rowmathde = mysql_fetch_array($getmathE)) {// get admno
	$mathde=$rowmathde['engas'];
	$mathE=$mathde*1;
	}
	$mathStudents=0;
	$getmathstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.math!='X' and km.math !='Y' and km.math!='P'  $moreq");
	while ($rowmathstud = mysql_fetch_array($getmathstudents)) {// get admno
	$mathStudents=$rowmathstud['adms'];
	}
	/*****/
	
	$getbio = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='A' and km.year_finished='$year'  $moreq   ");
	while ($rowbio = mysql_fetch_array($getbio)) {// get admno
	$bioas=$rowbio['engas'];
	$bioA=$bioas*12;
	}
	$getbiom = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='A-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiom = mysql_fetch_array($getbiom)) {// get admno
	$bioam=$rowbiom['engas'];
	$bioAm=$bioam*11;
	}
	$getbioBP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowbiobp = mysql_fetch_array($getbioBP)) {// get admno
	$biobp=$rowbiobp['engas'];
	$bioBP=$biobp*10;
	}
	$getbioB = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B' and km.year_finished='$year'  $moreq  ");
	while ($rowbiob = mysql_fetch_array($getbioB)) {// get admno
	$biob=$rowbiob['engas'];
	$bioB=$biob*9;
	}
	$getbioBM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiobm = mysql_fetch_array($getbioBM)) {// get admno
	$biobm=$rowbiobm['engas'];
	$bioBm=$biobm*8;
	}
	$getbioCP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowbiocp = mysql_fetch_array($getbioCP)) {// get admno
	$biocp=$rowbiocp['engas'];
	$bioCp=$biocp*7;
	}
	$getbioC = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C' and km.year_finished='$year'  $moreq  ");
	while ($rowbioc = mysql_fetch_array($getbioC)) {// get admno
	$bioc=$rowbioc['engas'];
	$bioC=$bioc*6;
	}
	$getbioCM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='C-' and km.year_finished='$year'  $moreq   ");
	while ($rowbiocm = mysql_fetch_array($getbioCM)) {// get admno
	$biocm=$rowbiocm['engas'];
	$bioCm=$biocm*5;
	}
	$getbioDP = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowbiodp = mysql_fetch_array($getbioDP)) {// get admno
	$biodp=$rowbiodp['engas'];
	$bioDp=$biodp*4;
	}
	$getbioD = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D' and km.year_finished='$year'  $moreq   ");
	while ($rowbiod = mysql_fetch_array($getbioD)) {// get admno
	$biod=$rowbiod['engas'];
	$bioD=$biod*3;
	}
	$getbioDM = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowbiodm = mysql_fetch_array($getbioDM)) {// get admno
	$biodm=$rowbiodm['engas'];
	$bioDm=$biodm*2;
	}
	$getbioE = mysql_query("select count(km.biology) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.biology='E' and km.year_finished='$year'  $moreq   ");
	while ($rowbiode = mysql_fetch_array($getbioE)) {// get admno
	$biode=$rowbiode['engas'];
	$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	$getbiostudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.biology!='0' and km.biology!='X' and km.biology !='Y' and km.biology!='P'  $moreq");
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admo
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** chemistry *******************/
	$getchem = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='A' and km.year_finished='$year'  $moreq   ");
	while ($rowchem = mysql_fetch_array($getchem)) {// get admno
	$chemas=$rowchem['engas'];
	$chemA=$chemas*12;
	}
	$getchemm = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowchemm = mysql_fetch_array($getchemm)) {// get admno
	$chemam=$rowchemm['engas'];
	$chemAm=$chemam*11;
	}
	$getchemBP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B+' and km.year_finished='$year'  $moreq   ");
	while ($rowchembp = mysql_fetch_array($getchemBP)) {// get admno
	$chembp=$rowchembp['engas'];
	$chemBP=$chembp*10;
	}
	$getchemB = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B' and km.year_finished='$year'  $moreq    ");
	while ($rowchemb = mysql_fetch_array($getchemB)) {// get admno
	$chemb=$rowchemb['engas'];
	$chemB=$chemb*9;
	}
	$getchemBM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowchembm = mysql_fetch_array($getchemBM)) {// get admno
	$chembm=$rowchembm['engas'];
	$chemBm=$chembm*8;
	}
	$getchemCP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemcp = mysql_fetch_array($getchemCP)) {// get admno
	$chemcp=$rowchemcp['engas'];
	$chemCp=$chemcp*7;
	}
	$getchemC = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C' and km.year_finished='$year'  $moreq   ");
	while ($rowchemc = mysql_fetch_array($getchemC)) {// get admno
	$chemc=$rowchemc['engas'];
	$chemC=$chemc*6;
	}
	$getchemCM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemcm = mysql_fetch_array($getchemCM)) {// get admno
	$chemcm=$rowchemcm['engas'];
	$chemCm=$chemcm*5;
	}
	$getchemDP = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowchemdp = mysql_fetch_array($getchemDP)) {// get admno
	$chemdp=$rowchemdp['engas'];
	$chemDp=$chemdp*4;
	}
	$getchemD = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D' and km.year_finished='$year'  $moreq   ");
	while ($rowchemd = mysql_fetch_array($getchemD)) {// get admno
	$chemd=$rowchemd['engas'];
	$chemD=$chemd*3;
	}
	$getchemDM = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowchemdm = mysql_fetch_array($getchemDM)) {// get admno
	$chemdm=$rowchemdm['engas'];
	$chemDm=$chemdm*2;
	}
	$getchemE = mysql_query("select count(km.chemistry) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.chemistry='E' and km.year_finished='$year'  $moreq    ");
	while ($rowchemde = mysql_fetch_array($getchemE)) {// get admno
	$chemde=$rowchemde['engas'];
	$chemE=$chemde*1;
	}
	
	$chemistryStudents=0;
	$getchemstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.chemistry!='0' and km.chemistry!='X' and km.chemistry !='Y' and km.chemistry!='P'  $moreq");
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}
	/************************ physics *************************************/
	$getphy = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='A' and km.year_finished='$year'  $moreq    ");
	while ($rowphy = mysql_fetch_array($getphy)) {// get admno
	$phyas=$rowphy['engas'];
	$phyA=$phyas*12;
	}
	$getphym = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowphym = mysql_fetch_array($getphym)) {// get admno
	$phyam=$rowphym['engas'];
	$phyAm=$phyam*11;
	}
	$getphyBP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowphybp = mysql_fetch_array($getphyBP)) {// get admno
	$phybp=$rowphybp['engas'];
	$phyBP=$phybp*10;
	}
	$getphyB = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B' and km.year_finished='$year'  $moreq     ");
	while ($rowphyb = mysql_fetch_array($getphyB)) {// get admno
	$phyb=$rowphyb['engas'];
	$phyB=$phyb*9;
	}
	$getphyBM = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='B-' and km.year_finished='$year'  $moreq     ");
	while ($rowphybm = mysql_fetch_array($getphyBM)) {// get admno
	$phybm=$rowphybm['engas'];
	$phyBm=$phybm*8;
	}
	$getphyCP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C+' and km.year_finished='$year'  $moreq    ");
	while ($rowphycp = mysql_fetch_array($getphyCP)) {// get admno
	$phycp=$rowphycp['engas'];
	$phyCp=$phycp*7;
	}
	$getphyC = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C' and km.year_finished='$year'  $moreq    ");
	while ($rowphyc = mysql_fetch_array($getphyC)) {// get admno
	$phyc=$rowphyc['engas'];
	$phyC=$phyc*6;
	}
	$getphyCM = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='C-' and km.year_finished='$year'  $moreq     ");
	while ($rowphycm = mysql_fetch_array($getphyCM)) {// get admno
	$phycm=$rowphycm['engas'];
	$phyCm=$phycm*5;
	}
	$getphyDP = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowphydp = mysql_fetch_array($getphyDP)) {// get admno
	$phydp=$rowphydp['engas'];
	$phyDp=$phydp*4;
	}
	$getphyD = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='D' and km.year_finished='$year'  $moreq    ");
	while ($rowphyd = mysql_fetch_array($getphyD)) {// get admno
	$phyd=$rowphyd['engas'];
	$phyD=$phyd*3;
	}
	$getphyDM = mysql_query("select count(physics) as engas from kcsemarks where physics='D-' and year_finished='$year' ");
	while ($rowphydm = mysql_fetch_array($getphyDM)) {// get admno
	$phydm=$rowphydm['engas'];
	$phyDm=$phydm*2;
	}
	$getphyE = mysql_query("select count(km.physics) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.physics='E' and km.year_finished='$year'  $moreq    ");
	while ($rowphyde = mysql_fetch_array($getphyE)) {// get admno
	$phyde=$rowphyde['engas'];
	$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	$getphystudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.physics!='0' and km.physics!='X' and km.physics !='Y' and km.physics!='P'  $moreq");
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	/*****************************************************************************************************/
	$gethis = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='A' and km.year_finished='$year'  $moreq    ");
	while ($rowhis = mysql_fetch_array($gethis)) {// get admno
	$hisas=$rowhis['engas'];
	$hisA=$hisas*12;
	}
	$gethism = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowhism = mysql_fetch_array($gethism)) {// get admno
	$hisam=$rowhism['engas'];
	$hisAm=$hisam*11;
	}
	$gethisBP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowhisbp = mysql_fetch_array($gethisBP)) {// get admno
	$hisbp=$rowhisbp['engas'];
	$hisBP=$hisbp*10;
	}
	$gethisB = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B' and km.year_finished='$year'  $moreq   ");
	while ($rowhisb = mysql_fetch_array($gethisB)) {// get admno
	$hisb=$rowhisb['engas'];
	$hisB=$hisb*9;
	}
	$gethisBM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowhisbm = mysql_fetch_array($gethisBM)) {// get admno
	$hisbm=$rowhisbm['engas'];
	$hisBm=$hisbm*8;
	}
	$gethisCP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowhiscp = mysql_fetch_array($gethisCP)) {// get admno
	$hiscp=$rowhiscp['engas'];
	$hisCp=$hiscp*7;
	}
	$gethisC = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C' and km.year_finished='$year'  $moreq   ");
	while ($rowhisc = mysql_fetch_array($gethisC)) {// get admno
	$hisc=$rowhisc['engas'];
	$hisC=$hisc*6;
	}
	$gethisCM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowhiscm = mysql_fetch_array($gethisCM)) {// get admno
	$hiscm=$rowhiscm['engas'];
	$hisCm=$hiscm*5;
	}
	$gethisDP = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowhisdp = mysql_fetch_array($gethisDP)) {// get admno
	$hisdp=$rowhisdp['engas'];
	$hisDp=$hisdp*4;
	}
	$gethisD = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D' and km.year_finished='$year'  $moreq   ");
	while ($rowhisd = mysql_fetch_array($gethisD)) {// get admno
	$hisd=$rowhisd['engas'];
	$hisD=$hisd*3;
	}
	$gethisDM = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowhisdm = mysql_fetch_array($gethisDM)) {// get admno
	$hisdm=$rowhisdm['engas'];
	$hisDm=$hisdm*2;
	}
	$gethisE = mysql_query("select count(km.history) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.history='E' and km.year_finished='$year'  $moreq   ");
	while ($rowhisde = mysql_fetch_array($gethisE)) {// get admno
	$hisde=$rowhisde['engas'];
	$hisE=$hisde*1;
	}
	
	$historyStudents=0;
	$gethisstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.history!='0' and km.history!='X' and km.history !='Y' and km.history!='P'  $moreq");
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/**************************************************************************************************/
	$getgeo = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='A' and km.year_finished='$year'  $moreq   ");
	while ($rowgeo = mysql_fetch_array($getgeo)) {// get admno
	$geoas=$rowgeo['engas'];
	$geoA=$geoas*12;
	}
	$getgeom = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='A-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeom = mysql_fetch_array($getgeom)) {// get admno
	$geoam=$rowgeom['engas'];
	$geoAm=$geoam*11;
	}
	$getgeoBP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowgeobp = mysql_fetch_array($getgeoBP)) {// get admno
	$geobp=$rowgeobp['engas'];
	$geoBP=$geobp*10;
	}
	$getgeoB = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B' and km.year_finished='$year'  $moreq    ");
	while ($rowgeob = mysql_fetch_array($getgeoB)) {// get admno
	$geob=$rowgeob['engas'];
	$geoB=$geob*9;
	}
	$getgeoBM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeobm = mysql_fetch_array($getgeoBM)) {// get admno
	$geobm=$rowgeobm['engas'];
	$geoBm=$geobm*8;
	}
	$getgeoCP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowgeocp = mysql_fetch_array($getgeoCP)) {// get admno
	$geocp=$rowgeocp['engas'];
	$geoCp=$geocp*7;
	}
	$getgeoC = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C' and km.year_finished='$year'  $moreq    ");
	while ($rowgeoc = mysql_fetch_array($getgeoC)) {// get admno
	$geoc=$rowgeoc['engas'];
	$geoC=$geoc*6;
	}
	$getgeoCM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeocm = mysql_fetch_array($getgeoCM)) {// get admno
	$geocm=$rowgeocm['engas'];
	$geoCm=$geocm*5;
	}
	$getgeoDP = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowgeodp = mysql_fetch_array($getgeoDP)) {// get admno
	$geodp=$rowgeodp['engas'];
	$geoDp=$geodp*4;
	}
	$getgeoD = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D' and km.year_finished='$year'  $moreq    ");
	while ($rowgeod = mysql_fetch_array($getgeoD)) {// get admno
	$geod=$rowgeod['engas'];
	$geoD=$geod*3;
	}
	$getgeoDM = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowgeodm = mysql_fetch_array($getgeoDM)) {// get admno
	$geodm=$rowgeodm['engas'];
	$geoDm=$geodm*2;
	}
	$getgeoE = mysql_query("select count(km.geography) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.geography='E' and km.year_finished='$year'  $moreq    ");
	while ($rowgeode = mysql_fetch_array($getgeoE)) {// get admno
	$geode=$rowgeode['engas'];
	$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	$getgeostudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.geography!='0' and km.geography!='X' and km.geography !='Y' and km.geography!='P'  $moreq");
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	/*************************************************************************************************/
	$getcre = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='A' and km.year_finished='$year'  $moreq    ");
	while ($rowcre = mysql_fetch_array($getcre)) {// get admno
	$creas=$rowcre['engas'];
	$creA=$creas*12;
	}
	$getcrem = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowcrem = mysql_fetch_array($getcrem)) {// get admno
	$cream=$rowcrem['engas'];
	$creAm=$cream*11;
	}
	$getcreBP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowcrebp = mysql_fetch_array($getcreBP)) {// get admno
	$crebp=$rowcrebp['engas'];
	$creBP=$crebp*10;
	}
	$getcreB = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B' and km.year_finished='$year'  $moreq    ");
	while ($rowcreb = mysql_fetch_array($getcreB)) {// get admno
	$creb=$rowcreb['engas'];
	$creB=$creb*9;
	}
	$getcreBM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowcrebm = mysql_fetch_array($getcreBM)) {// get admno
	$crebm=$rowcrebm['engas'];
	$creBm=$crebm*8;
	}
	$getcreCP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C+' and km.year_finished='$year'  $moreq     ");
	while ($rowcrecp = mysql_fetch_array($getcreCP)) {// get admno
	$crecp=$rowcrecp['engas'];
	$creCp=$crecp*7;
	}
	$getcreC = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C' and km.year_finished='$year'  $moreq     ");
	while ($rowcrec = mysql_fetch_array($getcreC)) {// get admno
	$crec=$rowcrec['engas'];
	$creC=$crec*6;
	}
	$getcreCM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowcrecm = mysql_fetch_array($getcreCM)) {// get admno
	$crecm=$rowcrecm['engas'];
	$creCm=$crecm*5;
	}
	$getcreDP = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D+' and km.year_finished='$year'  $moreq     ");
	while ($rowcredp = mysql_fetch_array($getcreDP)) {// get admno
	$credp=$rowcredp['engas'];
	$creDp=$credp*4;
	}
	$getcreD = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D' and km.year_finished='$year'  $moreq     ");
	while ($rowcred = mysql_fetch_array($getcreD)) {// get admno
	$cred=$rowcred['engas'];
	$creD=$cred*3;
	}
	$getcreDM = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='D-' and km.year_finished='$year'  $moreq     ");
	while ($rowcredm = mysql_fetch_array($getcreDM)) {// get admno
	$credm=$rowcredm['engas'];
	$creDm=$credm*2;
	}
	$getcreE = mysql_query("select count(km.cre) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.cre='E' and km.year_finished='$year'  $moreq    ");
	while ($rowcrede = mysql_fetch_array($getcreE)) {// get admno
	$crede=$rowcrede['engas'];
	$creE=$crede*1;
	}
	
	$creStudents=0;
	$getcrestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.cre!='0' and km.cre!='X' and km.cre !='Y' and km.cre!='P'  $moreq");
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/****************************************************************************************************/
	$getagr = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='A' and km.year_finished='$year'  $moreq    ");
	while ($rowagr = mysql_fetch_array($getagr)) {// get admno
	$agras=$rowagr['engas'];
	$agrA=$agras*12;
	}
	$getagrm = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='A-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrm = mysql_fetch_array($getagrm)) {// get admno
	$agram=$rowagrm['engas'];
	$agrAm=$agram*11;
	}
	$getagrBP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B+' and km.year_finished='$year'  $moreq     ");
	while ($rowagrbp = mysql_fetch_array($getagrBP)) {// get admno
	$agrbp=$rowagrbp['engas'];
	$agrBP=$agrbp*10;
	}
	$getagrB = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B' and km.year_finished='$year'  $moreq    ");
	while ($rowagrb = mysql_fetch_array($getagrB)) {// get admno
	$agrb=$rowagrb['engas'];
	$agrB=$agrb*9;
	}
	$getagrBM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='B-' and km.year_finished='$year'  $moreq    ");
	while ($rowagrbm = mysql_fetch_array($getagrBM)) {// get admno
	$agrbm=$rowagrbm['engas'];
	$agrBm=$agrbm*8;
	}
	$getagrCP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C+' and km.year_finished='$year'  $moreq     ");
	while ($rowagrcp = mysql_fetch_array($getagrCP)) {// get admno
	$agrcp=$rowagrcp['engas'];
	$agrCp=$agrcp*7;
	}
	$getagrC = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C' and km.year_finished='$year'  $moreq    ");
	while ($rowagrc = mysql_fetch_array($getagrC)) {// get admno
	$agrc=$rowagrc['engas'];
	$agrC=$agrc*6;
	}
	$getagrCM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='C-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrcm = mysql_fetch_array($getagrCM)) {// get admno
	$agrcm=$rowagrcm['engas'];
	$agrCm=$agrcm*5;
	}
	$getagrDP = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D+' and km.year_finished='$year'  $moreq    ");
	while ($rowagrdp = mysql_fetch_array($getagrDP)) {// get admno
	$agrdp=$rowagrdp['engas'];
	$agrDp=$agrdp*4;
	}
	$getagrD = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D' and km.year_finished='$year'  $moreq    ");
	while ($rowagrd = mysql_fetch_array($getagrD)) {// get admno
	$agrd=$rowagrd['engas'];
	$agrD=$agrd*3;
	}
	$getagrDM = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='D-' and km.year_finished='$year'  $moreq     ");
	while ($rowagrdm = mysql_fetch_array($getagrDM)) {// get admno
	$agrdm=$rowagrdm['engas'];
	$agrDm=$agrdm*2;
	}
	$getagrE = mysql_query("select count(km.agriculture) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.agriculture='E' and km.year_finished='$year'  $moreq     ");
	while ($rowagrde = mysql_fetch_array($getagrE)) {// get admno
	$agrde=$rowagrde['engas'];
	$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	$getagrstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.agriculture!='0' and km.agriculture!='X' and km.agriculture !='Y' and km.agriculture!='P'  $moreq");
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	/**************************************************************************************************/
	$getbst = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='A' and km.year_finished='$year'  $moreq    ");
	while ($rowbst = mysql_fetch_array($getbst)) {// get admno
	$bstas=$rowbst['engas'];
	$bstA=$bstas*12;
	}
	$getbstm = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='A-' and km.year_finished='$year'  $moreq   ");
	while ($rowbstm = mysql_fetch_array($getbstm)) {// get admno
	$bstam=$rowbstm['engas'];
	$bstAm=$bstam*11;
	}
	$getbstBP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B+' and km.year_finished='$year'  $moreq    ");
	while ($rowbstbp = mysql_fetch_array($getbstBP)) {// get admno
	$bstbp=$rowbstbp['engas'];
	$bstBP=$bstbp*10;
	}
	$getbstB = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B' and km.year_finished='$year'  $moreq    ");
	while ($rowbstb = mysql_fetch_array($getbstB)) {// get admno
	$bstb=$rowbstb['engas'];
	$bstB=$bstb*9;
	}
	$getbstBM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='B-' and km.year_finished='$year'  $moreq   ");
	while ($rowbstbm = mysql_fetch_array($getbstBM)) {// get admno
	$bstbm=$rowbstbm['engas'];
	$bstBm=$bstbm*8;
	}
	$getbstCP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C+' and km.year_finished='$year'  $moreq   ");
	while ($rowbstcp = mysql_fetch_array($getbstCP)) {// get admno
	$bstcp=$rowbstcp['engas'];
	$bstCp=$bstcp*7;
	}
	$getbstC = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C' and km.year_finished='$year'  $moreq   ");
	while ($rowbstc = mysql_fetch_array($getbstC)) {// get admno
	$bstc=$rowbstc['engas'];
	$bstC=$bstc*6;
	}
	$getbstCM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='C-' and km.year_finished='$year'  $moreq    ");
	while ($rowbstcm = mysql_fetch_array($getbstCM)) {// get admno
	$bstcm=$rowbstcm['engas'];
	$bstCm=$bstcm*5;
	}
	$getbstDP = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D+' and km.year_finished='$year'  $moreq   ");
	while ($rowbstdp = mysql_fetch_array($getbstDP)) {// get admno
	$bstdp=$rowbstdp['engas'];
	$bstDp=$bstdp*4;
	}
	$getbstD = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D' and km.year_finished='$year'  $moreq    ");
	while ($rowbstd = mysql_fetch_array($getbstD)) {// get admno
	$bstd=$rowbstd['engas'];
	$bstD=$bstd*3;
	}
	$getbstDM = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='D-' and km.year_finished='$year'  $moreq    ");
	while ($rowbstdm = mysql_fetch_array($getbstDM)) {// get admno
	$bstdm=$rowbstdm['engas'];
	$bstDm=$bstdm*2;
	}
	$getbstE = mysql_query("select count(km.bstudies) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.bstudies='E' and km.year_finished='$year'  $moreq    ");
	while ($rowbstde = mysql_fetch_array($getbstE)) {// get admno
	$bstde=$rowbstde['engas'];
	$bstE=$bstde*1;
	}
	
	$bstStudents=0;
	$getbststudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.bstudies!='0' and km.bstudies!='X' and km.bstudies !='Y' and km.bstudies!='P'  and km.bstudies!=' '   $moreq");
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	/*************************************************************************************************/
	$getfre = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='A' and km.year_finished='$year'  $moreq   ");
	while ($rowfre = mysql_fetch_array($getfre)) {// get admno
	$freas=$rowfre['engas'];
	$freA=$freas*12;
	}
	$getfrem = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='A-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrem = mysql_fetch_array($getfrem)) {// get admno
	$fream=$rowfrem['engas'];
	$freAm=$fream*11;
	}
	$getfreBP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowfrebp = mysql_fetch_array($getfreBP)) {// get admno
	$frebp=$rowfrebp['engas'];
	$freBP=$frebp*10;
	}
	$getfreB = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B' and km.year_finished='$year'  $moreq  ");
	while ($rowfreb = mysql_fetch_array($getfreB)) {// get admno
	$freb=$rowfreb['engas'];
	$freB=$freb*9;
	}
	$getfreBM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='B-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrebm = mysql_fetch_array($getfreBM)) {// get admno
	$frebm=$rowfrebm['engas'];
	$freBm=$frebm*8;
	}
	$getfreCP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowfrecp = mysql_fetch_array($getfreCP)) {// get admno
	$frecp=$rowfrecp['engas'];
	$freCp=$frecp*7;
	}
	$getfreC = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C' and km.year_finished='$year'  $moreq  ");
	while ($rowfrec = mysql_fetch_array($getfreC)) {// get admno
	$frec=$rowfrec['engas'];
	$freC=$frec*6;
	}
	$getfreCM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='C-' and km.year_finished='$year'  $moreq  ");
	while ($rowfrecm = mysql_fetch_array($getfreCM)) {// get admno
	$frecm=$rowfrecm['engas'];
	$freCm=$frecm*5;
	}
	$getfreDP = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowfredp = mysql_fetch_array($getfreDP)) {// get admno
	$fredp=$rowfredp['engas'];
	$freDp=$fredp*4;
	}
	$getfreD = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D' and km.year_finished='$year'  $moreq  ");
	while ($rowfred = mysql_fetch_array($getfreD)) {// get admno
	$fred=$rowfred['engas'];
	$freD=$fred*3;
	}
	$getfreDM = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowfredm = mysql_fetch_array($getfreDM)) {// get admno
	$fredm=$rowfredm['engas'];
	$freDm=$fredm*2;
	}
	$getfreE = mysql_query("select count(km.french) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.french='E' and km.year_finished='$year'  $moreq  ");
	while ($rowfrede = mysql_fetch_array($getfreE)) {// get admno
	$frede=$rowfrede['engas'];
	$freE=$frede*1;
	}
	
	$freStudents=0;
	$getfrestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.french!='0' and km.french!='X' and km.french !='Y' and km.french!='P'  and km.french!=' '   $moreq");
	while ($rowfrestud = mysql_fetch_array($getfrestudents)) {// get admno
	$freStudents=$rowfrestud['adms'];
	}
	
	/*************************************************************************************************/
	$gethome = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='A' and km.year_finished='$year'  $moreq ");
	while ($rowhome = mysql_fetch_array($gethome)) {// get admno
	$homeas=$rowhome['engas'];
	$homeA=$homeas*12;
	}
	$gethomem = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='A-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomem = mysql_fetch_array($gethomem)) {// get admno
	$homeam=$rowhomem['engas'];
	$homeAm=$homeam*11;
	}
	$gethomeBP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomebp = mysql_fetch_array($gethomeBP)) {// get admno
	$homebp=$rowhomebp['engas'];
	$homeBP=$homebp*10;
	}
	$gethomeB = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B' and km.year_finished='$year'  $moreq  ");
	while ($rowhomeb = mysql_fetch_array($gethomeB)) {// get admno
	$homeb=$rowhomeb['engas'];
	$homeB=$homeb*9;
	}
	$gethomeBM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='B-' and km.year_finished='$year'  $moreq ");
	while ($rowhomebm = mysql_fetch_array($gethomeBM)) {// get admno
	$homebm=$rowhomebm['engas'];
	$homeBm=$homebm*8;
	}
	$gethomeCP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomecp = mysql_fetch_array($gethomeCP)) {// get admno
	$homecp=$rowhomecp['engas'];
	$homeCp=$homecp*7;
	}
	$gethomeC = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C' and km.year_finished='$year'  $moreq  ");
	while ($rowhomec = mysql_fetch_array($gethomeC)) {// get admno
	$homec=$rowhomec['engas'];
	$homeC=$homec*6;
	}
	$gethomeCM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='C-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomecm = mysql_fetch_array($gethomeCM)) {// get admno
	$homecm=$rowhomecm['engas'];
	$homeCm=$homecm*5;
	}
	$gethomeDP = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D+' and km.year_finished='$year'  $moreq  ");
	while ($rowhomedp = mysql_fetch_array($gethomeDP)) {// get admno
	$homedp=$rowhomedp['engas'];
	$homeDp=$homedp*4;
	}
	$gethomeD = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D' and km.year_finished='$year'  $moreq  ");
	while ($rowhomed = mysql_fetch_array($gethomeD)) {// get admno
	$homed=$rowhomed['engas'];
	$homeD=$homed*3;
	}
	$gethomeDM = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='D-' and km.year_finished='$year'  $moreq  ");
	while ($rowhomedm = mysql_fetch_array($gethomeDM)) {// get admno
	$homedm=$rowhomedm['engas'];
	$homeDm=$homedm*2;
	}
	$gethomeE = mysql_query("select count(km.home) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.home='E' and km.year_finished='$year'  $moreq ");
	while ($rowhomede = mysql_fetch_array($gethomeE)) {// get admno
	$homede=$rowhomede['engas'];
	$homeE=$homede*1;
	}
	
	$homeStudents=0;
	$gethomestudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.home!='0' and km.home!='X' and km.home !='Y' and km.home!='P' and km.home!=' '  $moreq");
	while ($rowhomestud = mysql_fetch_array($gethomestudents)) {// get admno
	$homeStudents=$rowhomestud['adms'];
	}
	
	
	$getcomputer = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='A' and km.year_finished='$year'  $moreq ");
	while ($rowcomputer = mysql_fetch_array($getcomputer)) {// get admno
	$computeras=$rowcomputer['engas'];
	$computerA=$computeras*12;
	}
	$getcomputerm = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='A-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerm = mysql_fetch_array($getcomputerm)) {// get admno
	$computeram=$rowcomputerm['engas'];
	$computerAm=$computeram*11;
	}
	$getcomputerBP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerbp = mysql_fetch_array($getcomputerBP)) {// get admno
	$computerbp=$rowcomputerbp['engas'];
	$computerBP=$computerbp*10;
	}
	$getcomputerB = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B' and km.year_finished='$year'  $moreq");
	while ($rowcomputerb = mysql_fetch_array($getcomputerB)) {// get admno
	$computerb=$rowcomputerb['engas'];
	$computerB=$computerb*9;
	}
	$getcomputerBM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='B-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerbm = mysql_fetch_array($getcomputerBM)) {// get admno
	$computerbm=$rowcomputerbm['engas'];
	$computerBm=$computerbm*8;
	}
	$getcomputerCP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputercp = mysql_fetch_array($getcomputerCP)) {// get admno
	$computercp=$rowcomputercp['engas'];
	$computerCp=$computercp*7;
	}
	$getcomputerC = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerc = mysql_fetch_array($getcomputerC)) {// get admno
	$computerc=$rowcomputerc['engas'];
	$computerC=$computerc*6;
	}
	$getcomputerCM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='C-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputercm = mysql_fetch_array($getcomputerCM)) {// get admno
	$computercm=$rowcomputercm['engas'];
	$computerCm=$computercm*5;
	}
	$getcomputerDP = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D+' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerdp = mysql_fetch_array($getcomputerDP)) {// get admno
	$computerdp=$rowcomputerdp['engas'];
	$computerDp=$computerdp*4;
	}
	$getcomputerD = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D' and km.year_finished='$year'  $moreq");
	while ($rowcomputerd = mysql_fetch_array($getcomputerD)) {// get admno
	$computerd=$rowcomputerd['engas'];
	$computerD=$computerd*3;
	}
	$getcomputerDM = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='D-' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerdm = mysql_fetch_array($getcomputerDM)) {// get admno
	$computerdm=$rowcomputerdm['engas'];
	$computerDm=$computerdm*2;
	}
	$getcomputerE = mysql_query("select count(km.computer) as engas from kcsemarks as km 
inner join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and km.computer='E' and km.year_finished='$year'  $moreq ");
	while ($rowcomputerde = mysql_fetch_array($getcomputerE)) {// get admno
	$computerde=$rowcomputerde['engas'];
	$computerE=$computerde*1;
	}
	
	$computerStudents=0;
	$getcomputerstudents = mysql_query("select count(km.index_numbers) as adms from kcsemarks as km
join kcseanalysis ka on km.index_numbers=ka.index_numbers inner join studentdetails sd on ka.admno=sd.admno
and  km.year_finished='$year' and km.computer!='0' and km.computer!='X' and km.computer !='Y' and km.computer!='P' and km.computer!=' '  $moreq");
	while ($rowcomputerstud = mysql_fetch_array($getcomputerstudents)) {// get admno
	$computerStudents=$rowcomputerstud['adms'];
	}
	
	/*************************************************************************************************/
	
	$totalEnglishPoints=$engpoA+$engpoAm+$engpoBP+$engpoB+$engpoBm+$engpoCp+$engpoC+$engpoCm+$engpoDp+$engpoD+$engpoDm+$engpoE;
	$totalKiswahiliPoints=$kisA+$kisAm+$kisBP+$kisB+$kisBm+$kisCp+$kisC+$kisCm+$kisDp+$kisD+$kisDm+$kisE;
	$totalMathPoints=$mathA+$mathAm+$mathBP+$mathB+$mathBm+$mathCp+$mathC+$mathCm+$mathDp+$mathD+$mathDm+$mathE;
	$totalBioPoints=$bioA+$bioAm+$bioBP+$bioB+$bioBm+$bioCp+$bioC+$bioCm+$bioDp+$bioD+$bioDm+$bioE;
	$totalChemPoints=$chemA+$chemAm+$chemBP+$chemB+$chemBm+$chemCp+$chemC+$chemCm+$chemDp+$chemD+$chemDm+$chemE;
	$totalPhysPoints=$phyA+$phyAm+$phyBP+$phyB+$phyBm+$phyCp+$phyC+$phyCm+$phyDp+$phyD+$phyDm+$phyE;
	$totalHisPoints=$hisA+$hisAm+$hisBP+$hisB+$hisBm+$hisCp+$hisC+$hisCm+$hisDp+$hisD+$hisDm+$hisE;
	$totalGeoPoints=$geoA+$geoAm+$geoBP+$geoB+$geoBm+$geoCp+$geoC+$geoCm+$geoDp+$geoD+$geoDm+$geoE;
	$totalCrePoints=$creA+$creAm+$creBP+$creB+$creBm+$creCp+$creC+$creCm+$creDp+$creD+$creDm+$creE;
	$totalAgrPoints=$agrA+$agrAm+$agrBP+$agrB+$agrBm+$agrCp+$agrC+$agrCm+$agrDp+$agrD+$agrDm+$agrE;
	$totalBstPoints=$bstA+$bstAm+$bstBP+$bstB+$bstBm+$bstCp+$bstC+$bstCm+$bstDp+$bstD+$bstDm+$bstE;
	$totalFrePoints=$freA+$freAm+$freBP+$freB+$freBm+$freCp+$freC+$freCm+$freDp+$freD+$freDm+$freE;
	$totalHomePoints=$homeA+$homeAm+$homeBP+$homeB+$homeBm+$homeCp+$homeC+$homeCm+$homeDp+$homeD+$homeDm+$homeE;
	$totalCompPoints=$computerA+$computerAm+$computerBP+$computerB+$computerBm+$computerCp+$computerC+$computerCm+$computerDp+$computerD+$computerDm+$computerE;
	
	
	$engmean=round_up ( $totalEnglishPoints/$englishStudents, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$kiswahiliStudents, 3 );
	$mathmean=round_up ( $totalMathPoints/$mathStudents, 3 );
	if($biologyStudents==0){
	$biomean=0;
	}else{
	$biomean=round_up ( $totalBioPoints/$biologyStudents, 3 );
	}
	if($chemistryStudents==0){
	$chemmean=0;
	}else{
	$chemmean=round_up ( $totalChemPoints/$chemistryStudents, 3 );
	}
	if($physicsStudents==0){
	$phymean=0;
	}else{
	$phymean=round_up ( $totalPhysPoints/$physicsStudents, 3 );
	}
	if($historyStudents==0){
	$hismean=0;
	}else{
	$hismean=round_up ( $totalHisPoints/$historyStudents, 3 );
	}
	if($geographyStudents==0){
	$geomean=0;
	}else{
	$geomean=round_up ( $totalGeoPoints/$geographyStudents, 3 );
	}
	if($creStudents==0){
	$cremean=0;
	}else{
	$cremean=round_up ( $totalCrePoints/$creStudents, 3 );
	}
	if($agrStudents==0){
	$agrmean=0;
	}else{
	$agrmean=round_up ( $totalAgrPoints/$agrStudents, 3 );
	}
	if($bstStudents==0){
	$bstmean=0;
	}else{
	$bstmean=round_up ( $totalBstPoints/$bstStudents, 3 );
	}
	if($freStudents==0){
	$fremean=0;
	}else{
	$fremean=round_up ( $totalFrePoints/$freStudents, 3 );
	}
	if($homeStudents==0){
	$homemean=0;
	}else{
	$homemean=round_up ( $totalHomePoints/$homeStudents, 3 );
	}
	if($computerStudents==0){
	$compmean=0;
	}else{
	$compmean=round_up ( $totalCompPoints/$computerStudents, 3 );
	}
	
	/*$engmean=round_up ( $totalEnglishPoints/$studentsare, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$studentsare, 3 );
	$mathmean=round_up ( $totalMathPoints/$studentsare, 3 );
	$biomean=round_up ( $totalBioPoints/$biologyStudents, 3 );
	$chemmean=round_up ( $totalChemPoints/$chemistryStudents, 3 );
	$phymean=round_up ( $totalPhysPoints/$physicsStudents, 3 );
	$hismean=round_up ( $totalHisPoints/$historyStudents, 3 );
	$geomean=round_up ( $totalGeoPoints/$geographyStudents, 3 );
	$cremean=round_up ( $totalCrePoints/$creStudents, 3 );
	$agrmean=round_up ( $totalAgrPoints/$agrStudents, 3 );
	$bstmean=round_up ( $totalBstPoints/$bstStudents, 3 );*/
	
	/*****************************************************************************************/
	if ($engmean > 0 && $engmean <= 1.499) {
			$efinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($engmean >= 1.5 && $engmean <= 2.499) {
			$efinalgrade = "D-";
			// remarks="Improve";
		} else if ($engmean >= 2.5 && $engmean <= 3.499) {
			$efinalgrade = "D";
			// remarks="Improve";
		} else if ($engmean >= 3.5 && $engmean <= 4.499) {
			$efinalgrade = "D+";
			// remarks="Can do better";
		} else if ($engmean >= 4.5 && $engmean <= 5.499) {
			$efinalgrade = "C-";
			// remarks="Fair";
		} else if ($engmean >= 5.5 && $engmean <= 6.499) {
			$efinalgrade = "C";
			// remarks="Fair";
		} else if ($engmean >= 6.5 && $engmean <= 7.499) {
			$efinalgrade = "C+";
			// remarks="Fair";
		} else if ($engmean >= 7.5 && $engmean <= 8.499) {
			$efinalgrade = "B-";
			// remarks="Good";
		} else if ($engmean >= 8.5 && $engmean <= 9.499) {
			$efinalgrade = "B";
			// remarks="Good";
		} else if ($engmean >= 9.5 && $engmean <= 10.499) {
			$efinalgrade = "B+";
			// remarks="Good";
		} else if ($engmean >= 10.5 && $engmean <= 11.499) {
			$efinalgrade = "A-";
			// remarks="V. Good";
		} else if ($engmean >= 11.5 && $engmean <= 12.0) {
			$efinalgrade = "A";
			// remarks="Excellent";
		}else if ($engmean == 0) {
			$efinalgrade = "-";
			
		} 
		
		/***************************************************************************/
		
		if ($kismean > 0 && $kismean <= 1.499) {
			$kfinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($kismean >= 1.5 && $kismean <= 2.499) {
			$kfinalgrade = "D-";
			// remarks="Improve";
		} else if ($kismean >= 2.5 && $kismean <= 3.499) {
			$kfinalgrade = "D";
			// remarks="Improve";
		} else if ($kismean >= 3.5 && $kismean <= 4.499) {
			$kfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($kismean >= 4.5 && $kismean <= 5.499) {
			$kfinalgrade = "C-";
			// remarks="Fair";
		} else if ($kismean >= 5.5 && $kismean <= 6.499) {
			$kfinalgrade = "C";
			// remarks="Fair";
		} else if ($kismean >= 6.5 && $kismean <= 7.499) {
			$kfinalgrade = "C+";
			// remarks="Fair";
		} else if ($kismean >= 7.5 && $kismean <= 8.499) {
			$kfinalgrade = "B-";
			// remarks="Good";
		} else if ($kismean >= 8.5 && $kismean <= 9.499) {
			$kfinalgrade = "B";
			// remarks="Good";
		} else if ($kismean >= 9.5 && $kismean <= 10.499) {
			$kfinalgrade = "B+";
			// remarks="Good";
		} else if ($kismean >= 10.5 && $kismean <= 11.499) {
			$kfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($kismean >= 11.5 && $kismean <= 12.0) {
			$kfinalgrade = "A";
			// remarks="Excellent";
		}else if ($kismean == 0) {
			$kfinalgrade = "-";
			
		} 
		
		/*************************************************************************/
		if ($mathmean > 0 && $mathmean <= 1.499) {
			$mfinalgrade = "E";
			
			// remarks="Work harder";
		} else if ($mathmean >= 1.5 && $mathmean <= 2.499) {
			$mfinalgrade = "D-";
			// remarks="Improve";
		} else if ($mathmean >= 2.5 && $mathmean <= 3.499) {
			$mfinalgrade = "D";
			// remarks="Improve";
		} else if ($mathmean >= 3.5 && $mathmean <= 4.499) {
			$mfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($mathmean >= 4.5 && $mathmean <= 5.499) {
			$mfinalgrade = "C-";
			// remarks="Fair";
		} else if ($mathmean >= 5.5 && $mathmean <= 6.499) {
			$mfinalgrade = "C";
			// remarks="Fair";
		} else if ($mathmean >= 6.5 && $mathmean <= 7.499) {
			$mfinalgrade = "C+";
			// remarks="Fair";
		} else if ($mathmean >= 7.5 && $mathmean <= 8.499) {
			$mfinalgrade = "B-";
			// remarks="Good";
		} else if ($mathmean >= 8.5 && $mathmean <= 9.499) {
			$mfinalgrade = "B";
			// remarks="Good";
		} else if ($mathmean >= 9.5 && $mathmean <= 10.499) {
			$mfinalgrade = "B+";
			// remarks="Good";
		} else if ($mathmean >= 10.5 && $mathmean <= 11.499) {
			$mfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($mathmean >= 11.5 && $mathmean <= 12.0) {
			$mfinalgrade = "A";
			// remarks="Excellent";
		}else if ($mathmean == 0) {
			$mfinalgrade = "-";
			
		} 
		/*********************************************************************************/
		if ($biomean > 0 && $biomean <= 1.499) {
			$bfinalgrade = "E";
			// remarks="Work harder";
		} else if ($biomean >= 1.5 && $biomean <= 2.499) {
			$bfinalgrade = "D-";
			// remarks="Improve";
		} else if ($biomean >= 2.5 && $biomean <= 3.499) {
			$bfinalgrade = "D";
			// remarks="Improve";
		} else if ($biomean >= 3.5 && $biomean <= 4.499) {
			$bfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($biomean >= 4.5 && $biomean <= 5.499) {
			$bfinalgrade = "C-";
			// remarks="Fair";
		} else if ($biomean >= 5.5 && $biomean <= 6.499) {
			$bfinalgrade = "C";
			// remarks="Fair";
		} else if ($biomean >= 6.5 && $biomean <= 7.499) {
			$bfinalgrade = "C+";
			// remarks="Fair";
		} else if ($biomean >= 7.5 && $biomean <= 8.499) {
			$bfinalgrade = "B-";
			// remarks="Good";
		} else if ($biomean >= 8.5 && $biomean <= 9.499) {
			$bfinalgrade = "B";
			// remarks="Good";
		} else if ($biomean >= 9.5 && $biomean <= 10.499) {
			$bfinalgrade = "B+";
			// remarks="Good";
		} else if ($biomean >= 10.5 && $biomean <= 11.499) {
			$bfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($biomean >= 11.5 && $biomean <= 12.0) {
			$bfinalgrade = "A";
			// remarks="Excellent";
		}else if ($biomean == 0) {
			$bfinalgrade = "-";
			
		} 
		/**************************************************************************************/
		if ($chemmean > 0 && $chemmean <= 1.499) {
			$chemfinalgrade = "E";
			// remarks="Work harder";
		} else if ($chemmean >= 1.5 && $chemmean <= 2.499) {
			$chemfinalgrade = "D-";
			// remarks="Improve";
		} else if ($chemmean >= 2.5 && $chemmean <= 3.499) {
			$chemfinalgrade = "D";
			// remarks="Improve";
		} else if ($chemmean >= 3.5 && $chemmean <= 4.499) {
			$chemfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($chemmean >= 4.5 && $chemmean <= 5.499) {
			$chemfinalgrade = "C-";
			// remarks="Fair";
		} else if ($chemmean >= 5.5 && $chemmean <= 6.499) {
			$chemfinalgrade = "C";
			// remarks="Fair";
		} else if ($chemmean >= 6.5 && $chemmean <= 7.499) {
			$chemfinalgrade = "C+";
			// remarks="Fair";
		} else if ($chemmean >= 7.5 && $chemmean <= 8.499) {
			$chemfinalgrade = "B-";
			// remarks="Good";
		} else if ($chemmean >= 8.5 && $chemmean <= 9.499) {
			$chemfinalgrade = "B";
			// remarks="Good";
		} else if ($chemmean >= 9.5 && $chemmean <= 10.499) {
			$chemfinalgrade = "B+";
			// remarks="Good";
		} else if ($chemmean >= 10.5 && $chemmean <= 11.499) {
			$chemfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($chemmean >= 11.5 && $chemmean <= 12.0) {
			$chemfinalgrade = "A";
			// remarks="Excellent";
		}else if ($chemmean == 0) {
			$chemfinalgrade = "-";
			
		} 
	/*****************************************************************************************/
	if ($phymean > 0 && $phymean <= 1.499) {
			$phyfinalgrade = "E";
			// remarks="Work harder";
		} else if ($phymean >= 1.5 && $phymean <= 2.499) {
			$phyfinalgrade = "D-";
			// remarks="Improve";
		} else if ($phymean >= 2.5 && $phymean <= 3.499) {
			$phyfinalgrade = "D";
			// remarks="Improve";
		} else if ($phymean >= 3.5 && $phymean <= 4.499) {
			$phyfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($phymean >= 4.5 && $phymean <= 5.499) {
			$phyfinalgrade = "C-";
			// remarks="Fair";
		} else if ($phymean >= 5.5 && $phymean <= 6.499) {
			$phyfinalgrade = "C";
			// remarks="Fair";
		} else if ($phymean >= 6.5 && $phymean <= 7.499) {
			$phyfinalgrade = "C+";
			// remarks="Fair";
		} else if ($phymean >= 7.5 && $phymean <= 8.499) {
			$phyfinalgrade = "B-";
			// remarks="Good";
		} else if ($phymean >= 8.5 && $phymean <= 9.499) {
			$phyfinalgrade = "B";
			// remarks="Good";
		} else if ($phymean >= 9.5 && $phymean <= 10.499) {
			$phyfinalgrade = "B+";
			// remarks="Good";
		} else if ($phymean >= 10.5 && $phymean <= 11.499) {
			$phyfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($phymean >= 11.5 && $phymean <= 12.0) {
			$phyfinalgrade = "A";
			// remarks="Excellent";
		}else if ($phymean == 0) {
			$phyfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($hismean > 0 && $hismean <= 1.499) {
			$hisfinalgrade = "E";
			// remarks="Work harder";
		} else if ($hismean >= 1.5 && $hismean <= 2.499) {
			$hisfinalgrade = "D-";
			// remarks="Improve";
		} else if ($hismean >= 2.5 && $hismean <= 3.499) {
			$hisfinalgrade = "D";
			// remarks="Improve";
		} else if ($hismean >= 3.5 && $hismean <= 4.499) {
			$hisfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($hismean >= 4.5 && $hismean <= 5.499) {
			$hisfinalgrade = "C-";
			// remarks="Fair";
		} else if ($hismean >= 5.5 && $hismean <= 6.499) {
			$hisfinalgrade = "C";
			// remarks="Fair";
		} else if ($hismean >= 6.5 && $hismean <= 7.499) {
			$hisfinalgrade = "C+";
			// remarks="Fair";
		} else if ($hismean >= 7.5 && $hismean <= 8.499) {
			$hisfinalgrade = "B-";
			// remarks="Good";
		} else if ($hismean >= 8.5 && $hismean <= 9.499) {
			$hisfinalgrade = "B";
			// remarks="Good";
		} else if ($hismean >= 9.5 && $hismean <= 10.499) {
			$hisfinalgrade = "B+";
			// remarks="Good";
		} else if ($hismean >= 10.5 && $hismean <= 11.499) {
			$hisfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($hismean >= 11.5 && $hismean <= 12.0) {
			$hisfinalgrade = "A";
			// remarks="Excellent";
		}else if ($hismean == 0) {
			$hisfinalgrade = "-";
			
		} 
		/****************************************************************************************/
		if ($geomean > 0 && $geomean <= 1.499) {
			$geofinalgrade = "E";
			// remarks="Work harder";
		} else if ($geomean >= 1.5 && $geomean <= 2.499) {
			$geofinalgrade = "D-";
			// remarks="Improve";
		} else if ($geomean >= 2.5 && $geomean <= 3.499) {
			$geofinalgrade = "D";
			// remarks="Improve";
		} else if ($geomean >= 3.5 && $geomean <= 4.499) {
			$geofinalgrade = "D+";
			// remarks="Can do better";
		} else if ($geomean >= 4.5 && $geomean <= 5.499) {
			$geofinalgrade = "C-";
			// remarks="Fair";
		} else if ($geomean >= 5.5 && $geomean <= 6.499) {
			$geofinalgrade = "C";
			// remarks="Fair";
		} else if ($geomean >= 6.5 && $geomean <= 7.499) {
			$geofinalgrade = "C+";
			// remarks="Fair";
		} else if ($geomean >= 7.5 && $geomean <= 8.499) {
			$geofinalgrade = "B-";
			// remarks="Good";
		} else if ($geomean >= 8.5 && $geomean <= 9.499) {
			$geofinalgrade = "B";
			// remarks="Good";
		} else if ($geomean >= 9.5 && $geomean <= 10.499) {
			$geofinalgrade = "B+";
			// remarks="Good";
		} else if ($geomean >= 10.5 && $geomean <= 11.499) {
			$geofinalgrade = "A-";
			// remarks="V. Good";
		} else if ($geomean >= 11.5 && $geomean <= 12.0) {
			$geofinalgrade = "A";
			// remarks="Excellent";
		}else if ($geomean == 0) {
			$geofinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($cremean > 0 && $cremean <= 1.499) {
			$crefinalgrade = "E";
			// remarks="Work harder";
		} else if ($cremean >= 1.5 && $cremean <= 2.499) {
			$crefinalgrade = "D-";
			// remarks="Improve";
		} else if ($cremean >= 2.5 && $cremean <= 3.499) {
			$crefinalgrade = "D";
			// remarks="Improve";
		} else if ($cremean >= 3.5 && $cremean <= 4.499) {
			$crefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($cremean >= 4.5 && $cremean <= 5.499) {
			$crefinalgrade = "C-";
			// remarks="Fair";
		} else if ($cremean >= 5.5 && $cremean <= 6.499) {
			$crefinalgrade = "C";
			// remarks="Fair";
		} else if ($cremean >= 6.5 && $cremean <= 7.499) {
			$crefinalgrade = "C+";
			// remarks="Fair";
		} else if ($cremean >= 7.5 && $cremean <= 8.499) {
			$crefinalgrade = "B-";
			// remarks="Good";
		} else if ($cremean >= 8.5 && $cremean <= 9.499) {
			$crefinalgrade = "B";
			// remarks="Good";
		} else if ($cremean >= 9.5 && $cremean <= 10.499) {
			$crefinalgrade = "B+";
			// remarks="Good";
		} else if ($cremean >= 10.5 && $cremean <= 11.499) {
			$crefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($cremean >= 11.5 && $cremean <= 12.0) {
			$crefinalgrade = "A";
			// remarks="Excellent";
		}else if ($cremean == 0) {
			$crefinalgrade = "-";
			
		} 
		/****************************************************************************************/
		if ($agrmean > 0 && $agrmean <= 1.499) {
			$agrfinalgrade = "E";
			// remarks="Work harder";
		} else if ($agrmean >= 1.5 && $agrmean <= 2.499) {
			$agrfinalgrade = "D-";
			// remarks="Improve";
		} else if ($agrmean >= 2.5 && $agrmean <= 3.499) {
			$agrfinalgrade = "D";
			// remarks="Improve";
		} else if ($agrmean >= 3.5 && $agrmean <= 4.499) {
			$agrfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($agrmean >= 4.5 && $agrmean <= 5.499) {
			$agrfinalgrade = "C-";
			// remarks="Fair";
		} else if ($agrmean >= 5.5 && $agrmean <= 6.499) {
			$agrfinalgrade = "C";
			// remarks="Fair";
		} else if ($agrmean >= 6.5 && $agrmean <= 7.499) {
			$agrfinalgrade = "C+";
			// remarks="Fair";
		} else if ($agrmean >= 7.5 && $agrmean <= 8.499) {
			$agrfinalgrade = "B-";
			// remarks="Good";
		} else if ($agrmean >= 8.5 && $agrmean <= 9.499) {
			$agrfinalgrade = "B";
			// remarks="Good";
		} else if ($agrmean >= 9.5 && $agrmean <= 10.499) {
			$agrfinalgrade = "B+";
			// remarks="Good";
		} else if ($agrmean >= 10.5 && $agrmean <= 11.499) {
			$agrfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($agrmean >= 11.5 && $agrmean <= 12.0) {
			$agrfinalgrade = "A";
			// remarks="Excellent";
		}else if ($agrmean == 0) {
			$agrfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($bstmean > 0 && $bstmean <= 1.499) {
			$bstfinalgrade = "E";
			// remarks="Work harder";
		} else if ($bstmean >= 1.5 && $bstmean <= 2.499) {
			$bstfinalgrade = "D-";
			// remarks="Improve";
		} else if ($bstmean >= 2.5 && $bstmean <= 3.499) {
			$bstfinalgrade = "D";
			// remarks="Improve";
		} else if ($bstmean >= 3.5 && $bstmean <= 4.499) {
			$bstfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($bstmean >= 4.5 && $bstmean <= 5.499) {
			$bstfinalgrade = "C-";
			// remarks="Fair";
		} else if ($bstmean >= 5.5 && $bstmean <= 6.499) {
			$bstfinalgrade = "C";
			// remarks="Fair";
		} else if ($bstmean >= 6.5 && $bstmean <= 7.499) {
			$bstfinalgrade = "C+";
			// remarks="Fair";
		} else if ($bstmean >= 7.5 && $bstmean <= 8.499) {
			$bstfinalgrade = "B-";
			// remarks="Good";
		} else if ($bstmean >= 8.5 && $bstmean <= 9.499) {
			$bstfinalgrade = "B";
			// remarks="Good";
		} else if ($bstmean >= 9.5 && $bstmean <= 10.499) {
			$bstfinalgrade = "B+";
			// remarks="Good";
		} else if ($bstmean >= 10.5 && $bstmean <= 11.499) {
			$bstfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($bstmean >= 11.5 && $bstmean <= 12.0) {
			$bstfinalgrade = "A";
			// remarks="Excellent";
		}else if ($bstmean == 0) {
			$bstfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($fremean > 0 && $fremean <= 1.499) {
			$frefinalgrade = "E";
			// remarks="Work harder";
		} else if ($fremean >= 1.5 && $fremean <= 2.499) {
			$frefinalgrade = "D-";
			// remarks="Improve";
		} else if ($fremean >= 2.5 && $fremean <= 3.499) {
			$frefinalgrade = "D";
			// remarks="Improve";
		} else if ($fremean >= 3.5 && $fremean <= 4.499) {
			$frefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($fremean >= 4.5 && $fremean <= 5.499) {
			$frefinalgrade = "C-";
			// remarks="Fair";
		} else if ($fremean >= 5.5 && $fremean <= 6.499) {
			$frefinalgrade = "C";
			// remarks="Fair";
		} else if ($fremean >= 6.5 && $fremean <= 7.499) {
			$frefinalgrade = "C+";
			// remarks="Fair";
		} else if ($fremean >= 7.5 && $fremean <= 8.499) {
			$frefinalgrade = "B-";
			// remarks="Good";
		} else if ($fremean >= 8.5 && $fremean <= 9.499) {
			$frefinalgrade = "B";
			// remarks="Good";
		} else if ($fremean >= 9.5 && $fremean <= 10.499) {
			$frefinalgrade = "B+";
			// remarks="Good";
		} else if ($fremean >= 10.5 && $fremean <= 11.499) {
			$frefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($fremean >= 11.5 && $fremean <= 12.0) {
			$frefinalgrade = "A";
			// remarks="Excellent";
		}else if ($fremean == 0) {
			$frefinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($homemean > 0 && $homemean <= 1.499) {
			$homefinalgrade = "E";
			// remarks="Work harder";
		} else if ($homemean >= 1.5 && $homemean <= 2.499) {
			$homefinalgrade = "D-";
			// remarks="Improve";
		} else if ($homemean >= 2.5 && $homemean <= 3.499) {
			$homefinalgrade = "D";
			// remarks="Improve";
		} else if ($homemean >= 3.5 && $homemean <= 4.499) {
			$homefinalgrade = "D+";
			// remarks="Can do better";
		} else if ($homemean >= 4.5 && $homemean <= 5.499) {
			$homefinalgrade = "C-";
			// remarks="Fair";
		} else if ($homemean >= 5.5 && $homemean <= 6.499) {
			$homefinalgrade = "C";
			// remarks="Fair";
		} else if ($homemean >= 6.5 && $homemean <= 7.499) {
			$homefinalgrade = "C+";
			// remarks="Fair";
		} else if ($homemean >= 7.5 && $homemean <= 8.499) {
			$homefinalgrade = "B-";
			// remarks="Good";
		} else if ($homemean >= 8.5 && $homemean <= 9.499) {
			$homefinalgrade = "B";
			// remarks="Good";
		} else if ($homemean >= 9.5 && $homemean <= 10.499) {
			$homefinalgrade = "B+";
			// remarks="Good";
		} else if ($homemean >= 10.5 && $homemean <= 11.499) {
			$homefinalgrade = "A-";
			// remarks="V. Good";
		} else if ($homemean >= 11.5 && $homemean <= 12.0) {
			$homefinalgrade = "A";
			// remarks="Excellent";
		}else if ($homemean == 0) {
			$homefinalgrade = "-";
			
		} 
		/***********************************************************************************/
		if ($compmean > 0 && $compmean <= 1.499) {
			$compfinalgrade = "E";
			// remarks="Work harder";
		} else if ($compmean >= 1.5 && $compmean <= 2.499) {
			$compfinalgrade = "D-";
			// remarks="Improve";
		} else if ($compmean >= 2.5 && $compmean <= 3.499) {
			$compfinalgrade = "D";
			// remarks="Improve";
		} else if ($compmean >= 3.5 && $compmean <= 4.499) {
			$compfinalgrade = "D+";
			// remarks="Can do better";
		} else if ($compmean >= 4.5 && $compmean <= 5.499) {
			$compfinalgrade = "C-";
			// remarks="Fair";
		} else if ($compmean >= 5.5 && $compmean <= 6.499) {
			$compfinalgrade = "C";
			// remarks="Fair";
		} else if ($compmean >= 6.5 && $compmean <= 7.499) {
			$compfinalgrade = "C+";
			// remarks="Fair";
		} else if ($compmean >= 7.5 && $compmean <= 8.499) {
			$compfinalgrade = "B-";
			// remarks="Good";
		} else if ($compmean >= 8.5 && $compmean <= 9.499) {
			$compfinalgrade = "B";
			// remarks="Good";
		} else if ($compmean >= 9.5 && $compmean <= 10.499) {
			$compfinalgrade = "B+";
			// remarks="Good";
		} else if ($compmean >= 10.5 && $compmean <= 11.499) {
			$compfinalgrade = "A-";
			// remarks="V. Good";
		} else if ($compmean >= 11.5 && $compmean <= 12.0) {
			$compfinalgrade = "A";
			// remarks="Excellent";
		}else if ($compmean == 0) {
			$compfinalgrade = "-";
			
		} 
		/***********************************************************************************/
		
	

	
$pdf->AddPage('L');
$pdf->setXY(15, 40);
$pdf->setFont("times","","9");
	$pdf->Cell(260, 10, "SUBJECTS MEAN PERFORMANCE SUMMARY", 1, 0, "L", 1);
	$pdf->Ln(10);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "GRADE", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "ENG", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "KIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "MATH", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BIO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "PHY", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CHEM", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "HIS", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "GEO", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "CRE", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "AGR", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "BST", 1, 0, "L", 1);
	$pdf->Cell(17, 6, "H/SCI", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "COMP", 1, 0, "L", 1);
	$pdf->Cell(18, 6, "FRE", 1, 0, "L", 1);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "A", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bioas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geoas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $creas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agras, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstas, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homeas, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computeras, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $freas, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "A-", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englisham, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $matham, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bioam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geoam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $cream, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agram, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstam, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homeam, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computeram, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $fream, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "B+", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishabp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisbp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathbp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biobp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phybp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chembp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisbp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geobp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crebp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrbp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstbp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homebp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerbp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frebp, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "B", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishab, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biob, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geob, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $creb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstb, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homeb, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerb, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $freb, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "B-", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishabm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisbm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathbm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biobm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phybm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chembm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisbm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geobm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crebm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrbm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstbm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homebm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerbm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frebm, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "C+", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishacp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kiscp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathcp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biocp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phycp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemcp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hiscp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geocp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crecp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrcp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstcp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homecp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computercp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frecp, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "C", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishac, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bioc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geoc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crec, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstc, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homec, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerc, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frec, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "C-", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishacm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kiscm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathcm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biocm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phycm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemcm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hiscm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geocm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crecm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrcm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstcm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homecm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computercm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frecm, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "D+", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishadp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biodp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phydp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geodp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $credp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstdp, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homedp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerdp, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $fredp, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "D", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishad, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biod, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geod, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $cred, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstd, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homed, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerd, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $fred, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "D-", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishadm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biodm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phydm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geodm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $credm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstdm, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homedm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerdm, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $fredm, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "E", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kisde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biode, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geode, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crede, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstde, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homede, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerde, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frede, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Total Pts", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalEnglishPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalKiswahiliPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalMathPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalBioPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalPhysPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalChemPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalHisPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalGeoPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalCrePoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalAgrPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalBstPoints, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $totalHomePoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $totalCompPoints, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $totalFrePoints, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Students", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $englishStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kiswahiliStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biologyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $physicsStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemistryStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $historyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geographyStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $creStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstStudents, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homeStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $computerStudents, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $freStudents, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Mean", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $engmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mathmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $biomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phymean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hismean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geomean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $cremean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstmean, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homemean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $compmean, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $fremean, 1, 0, "L", 0);
	$pdf->Ln(6);
	$pdf->setX(15);
	$pdf->Cell(20, 6, "Grade", 1, 0, "L", 0);
	$pdf->Cell(17, 6, $efinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $kfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $mfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $phyfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $chemfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $hisfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $geofinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $crefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $agrfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $bstfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(17, 6, $homefinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $compfinalgrade, 1, 0, "L", 0);
	$pdf->Cell(18, 6, $frefinalgrade, 1, 0, "L", 0);
	
	


	
$pdf->Output();

?>