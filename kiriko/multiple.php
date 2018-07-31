<?php
//define('FPDF_FONTPATH','font/');
require('fpdf.php');
include('includes/dbconnector.php');
 include 'includes/Grading.php';
   include 'includes/PreviousPerformances.php';
 
if (isset($_GET['id'])) {
$form=$_GET['id'];
$term=$_GET['term'];
$year=$_GET['yr'];
$strm=$_GET['classin'];
}
class PDF extends FPDF
{


//Page header
/*function Header(){
	$details = mysql_query("select * from schoolname");
	mysql_query($details);
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$date=date("j, F, Y");
	$term='1';
	$year='2013';
	$form='2';
    //Logo
   // $this->Image('logo.jpg',10,2,0,0);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
   // $this->Cell(30,10,'Title',1,0,'C');
	$this->SetFont('arial', '', 12);
	$this->Text(75, 10, $schoolname);
	$this->Text(75, 15,'P.o.Box  '.$po.',  '.$plac);
	$this->Text(75, 20,'Telephone:  '.$tele);
	$this->Text(75, 30,'Date:  '.$date);
	$this->Text(75, 38, 'Report Form: Term'.$term.'  Year   '.$year);

	 //image
   // $this->Image('logo.jpg',170,2,0,0);
    //Line break
   // $this->Ln(20);
}*/

//Page footer
/*function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Email:myschoolmyschool.com, Website:myschool.com ',0,0,'C');
}*/
function SetDash($black=false, $white=false)
    {
        if($black and $white)
            $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
}
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

}
function getPayableFeesTerm($term,$year,$form){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_fees where fiscal_yr='$year' and term='$term' and form='$form'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}

function getAddedFeesTerm($term,$year,$admno){
$payable=0;
 $sql="select COALESCE(sum(amount),0) as total from finance_added_fees where fiscal_year='$year' and term='$term' and admno='$admno'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $payable=$row['total'];

	return $payable;
}

function getPaidAmounts($admno,$year,$term){
	
	$paidAmount=0;
	$paid = mysql_query("SELECT COALESCE(sum(votehead_amt),0) as amount from finance_feestructures  where admno='$admno' and  year='$year' and term='$term'  and votehead !='Overpayments' and votehead!='Arrears'");
	while ($rowpai = mysql_fetch_array($paid)) {
	$paidAmount=$rowpai['amount'];
 	}
	return $paidAmount;
}
function getBalance($admno,$year,$term){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
}
	
function getLastYrBalance($admno,$year,$term,$updated){
	
	$bal=0;
	$balance = mysql_query("SELECT balance as amount from finance_balances where admno='$admno' and  year='$year' and term='$term' and updated='$updated'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
}
	
function checkArrearsPaid($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Arrears'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
}
function checkOverpaymentsUsed($admno,$year){
	
	$bal=0;
	$balance = mysql_query("SELECT COALESCE(SUM(votehead_amt),0) as amount from finance_feestructures where admno='$admno' and  year='$year' and votehead='Overpayments'");
	while ($rowpai = mysql_fetch_array($balance)) {
	$bal=$rowpai['amount'];
 	}
	return $bal;
}
//Instanciation of inherited class
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('arial', '', 12);
$grading = new Grading();	
$p_performances = new PreviousPerformances();

	$Numbers = mysql_query("select count(adm) as total from totalygradedmarks  where form='$form' and term='$term' and year='$year' and classin='$strm'");
	while ($to = mysql_fetch_array($Numbers)) {// get names
	$totals=$to['total'];
	
	}
	for($i=1;$i<=$totals; $i++)
	
	$myqueryis="select * from totalygradedmarks where  term='$term' and year='$year' and form='$form' and classin='$strm' order by averagepoints desc";
	$toexecute=mysql_query($myqueryis);
	while ($rowr = mysql_fetch_array($toexecute)) {
	$admno=$rowr['adm'];
	
	
	$house="___";
	$kcpe="_";
	$grade="-";
	
	$getnames = "SELECT fname,sname,lname,house,marks,grade,class from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$house=$row2['house'];
	$kcpe=$row2['marks'];
	$grade=$row2['grade'];
	$class=$row2['class'];
	$strm=$class;
	
	/*********************************************************************************/
	$term1vap="-";
	$term1vap=$grading->getVAP(1,1,$admno);//form, term, admno
	
	$term2vap="-";
	$term2vap=$grading->getVAP(1,2,$admno);
	
	$term3vap="-";
	$term3vap=$grading->getVAP(1,3,$admno);
	
	/*************************/
	$term12vap="-";
	$term12vap=$grading->getVAP(2,1,$admno);//form, term, admno
	
	$term22vap="-";
	$term22vap=$grading->getVAP(2,2,$admno);
	
	$term32vap="-";
	$term32vap=$grading->getVAP(2,3,$admno);
	/*************************/
	$term13vap="-";
	$term13vap=$grading->getVAP(3,1,$admno);//form, term, admno
	
	$term23vap="-";
	$term23vap=$grading->getVAP(3,2,$admno);
	
	$term33vap="-";
	$term33vap=$grading->getVAP(3,3,$admno);
	/*************************/
	$term14vap="-";
	$term14vap=$grading->getVAP(4,1,$admno);//form, term, admno
	
	$term24vap="-";
	$term24vap=$grading->getVAP(4,2,$admno);

//get Form1  Mean
	$formonemean=0.0;
	$forgraphone=0;
	$formonemean=$p_performances->getGraphMeans($admno,1,1);
	$forgraphone=($formonemean*5)."px";
	
	$formone2mean=0.0;
	$forgraphone2=0;
	$formone2mean=$p_performances->getGraphMeans($admno,1,2);
	$forgraphone2=($formone2mean*5)."px";
	
	$formone3mean=0.0;
	$forgraphone3=0;
	$formone3mean=$p_performances->getGraphMeans($admno,1,3);
	$forgraphone3=($formone3mean*5)."px";
	
	//get Form2 Mean
	$formtwomean=0.0;
	$forgraph=0;
	$formtwomean=$p_performances->getGraphMeans($admno,2,1);
	$forgraph=($formtwomean*5)."px";
	
	$formtwo2mean=0.0;
	$for2graph=0;
	$formtwo2mean=$p_performances->getGraphMeans($admno,2,2);
	$for2graph=($formtwo2mean*5)."px";
	
	$formtwo3mean=0.0;
	$for23graph=0;
	$formtwo3mean=$p_performances->getGraphMeans($admno,2,3);
	$for23graph=($formtwo3mean*5)."px";
	
	//get Form3 Mean
	$forms3mean=0.0;
	$for3graph=0;
	$forms3mean=$p_performances->getGraphMeans($admno,3,1);
	$for3graph=($forms3mean*5)."px";
	
	$forms32mean=0.0;
	$for32graph=0;
	$forms32mean=$p_performances->getGraphMeans($admno,3,2);
	$for32graph=($forms32mean*5)."px";
	
	$forms33mean=0.0;
	$for33graph=0;
	$forms33mean=$p_performances->getGraphMeans($admno,3,3);
	$for33graph=($forms33mean*5)."px";
	
	//get Form4 Mean
	$forms4mean=0.0;
	$for4graph=0;
	$forms4mean=$p_performances->getGraphMeans($admno,4,1);
	$for4graph=($forms4mean*5)."px";
	
	$forms42mean=0.0;
	$for42graph=0;
	$forms42mean=$p_performances->getGraphMeans($admno,4,2);
	$for42graph=($forms42mean*5)."px";

	/***************** get positioning ***********************************************/
	$term1posi="-";
	$term1posi=$p_performances->getPositioning(1,1,$admno);
	
	$term2posi="-";
	$term2posi=$p_performances->getPositioning(1,2,$admno);
	
	$term3posi="-";
	$term3posi=$p_performances->getPositioning(1,3,$admno);

	$term12posi="-";
	$term12posi=$p_performances->getPositioning(2,1,$admno);
	
	$term22posi="-";
	$term22posi=$p_performances->getPositioning(2,2,$admno);
	
	$term32posi="-";
	$term32posi=$p_performances->getPositioning(2,3,$admno);
	
	$term13posi="-";
	$term13posi=$p_performances->getPositioning(3,1,$admno);
	
	$term23posi="-";
	$term23posi=$p_performances->getPositioning(3,2,$admno);
	
	$term33posi="-";
	$term33posi=$p_performances->getPositioning(3,3,$admno);
	
	$term14posi="-";
	$term14posi=$p_performances->getPositioning(4,1,$admno);
	
	$term24posi="-";
	$term24posi=$p_performances->getPositioning(4,2,$admno);
	
	/***************** get positioning out of  ***********************************************/
	$term1outof="-";
	$term1outof= $p_performances->getPositionOutOf(1,1,$year);
	
	$term2outof="-";
	$term2outof=$p_performances->getPositionOutOf(1,2,$year);
	
	$term3outof="-";
	$term3outof=$p_performances->getPositionOutOf(1,3,$year);

	$term12outof="-";
	$term12outof=$p_performances->getPositionOutOf(2,1,$year);
	
	$term22outof="-";
	$term22outof=$p_performances->getPositionOutOf(2,2,$year);
	
	$term32outof="-";
	$term32outof=$p_performances->getPositionOutOf(2,3,$year);
	
	$term13outof="-";
	$term13outof=$p_performances->getPositionOutOf(3,1,$year);
	
	$term23outof="-";
	$term23outof=$p_performances->getPositionOutOf(3,2,$year);
	
	$term33outof="-";
	$term33outof=$p_performances->getPositionOutOf(3,3,$year);

	$term14outof="-";
	$term14outof=$p_performances->getPositionOutOf(4,1,$year);

	$term24outof="-";
	$term24outof=$p_performances->getPositionOutOf(4,2,$year);
	
	/*********************************************************************************/
	
	$getPosition = mysql_query("Select * from positions where admno='$admno' and form='$form' and term='$term' and year='$year'");
	while ($rowPos = mysql_fetch_array($getPosition)) {// get admno
	$studentPos=$rowPos['position'];
	$engPos=$rowPos['english'];
	$kisPos=$rowPos['kiswahili'];
	$mathPos=$rowPos['math'];
	$bioPos=$rowPos['biology'];
	$chemPos=$rowPos['chemistry'];
	$phyPos=$rowPos['physics'];
	$hisPos=$rowPos['history'];
	$geoPos=$rowPos['geography'];
	$crePos=$rowPos['cre'];
	$agrPos=$rowPos['agriculture'];
	$bstPos=$rowPos['bstudies'];
	$compPos=$rowPos['computer'];
	$frePos=$rowPos['french'];
	$homePos=$rowPos['home'];
	$kcpepos=$rowPos['kcpe'];
	}
	
	$getPositionClass = mysql_query("Select positionclass from positions where admno='$admno' and form='$form' and stream='$strm' and term='$term' and year='$year'");
	while ($rowPosc = mysql_fetch_array($getPositionClass)) {
	$studentPosClass=$rowPosc['positionclass'];
	}
	
	/***********************************************************************************/
	$totalStudents=0;
	$getTotalstudents = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form'");
	while ($rowstuden = mysql_fetch_array($getTotalstudents)) {// get admno
	$totalStudents=$rowstuden['adms'];
	}
	$totalStudentsClass=0;
	$getTotalstudentsClass = mysql_query("select count(adm) as adms from totalygradedmarks where term='$term' and year='$year' and form='$form' and classin='$strm'");
	while ($rowstudenc= mysql_fetch_array($getTotalstudentsClass)) {// get admno
	$totalStudentsClass=$rowstudenc['adms'];
	}
	
	if($form==1 || $form==2){
	$subsDone=11;
	}else if($form==3 ||$form==4){
	$subsDone=8;
	}
	$getDone = mysql_query("Select * from subjectsforstudent where admno='$admno' and form='$form'");
	while ($rowDone = mysql_fetch_array($getDone)) {// get admno
	$subsDone=$rowDone['subjects'];
	}
	$totalOutOf=$subsDone*100;
	/**************************************************************/
	/****************** get grade ********************************/
	//$cat1 = "SELECT distinct(admno) FROM markscats where form='$form' and term='$term' and year='$year'";//admno query
	$getgrades="select * from totalygradedmarks where term='$term' and year='$year' and adm='$admno'";
	$resultgrades = mysql_query($getgrades);
	while ($rowg = mysql_fetch_array($resultgrades)) {// get admno
	//$admno=$rowg['adm'];
	$kmrks=$rowg['marks'];
	$fullnames=$rowg['names'];
	$engfinal=$rowg['english'];
	$enggrade=$rowg['englishgrade'];
	$kisfinal=$rowg['kiswahili'];
	$kisgrade=$rowg['kiswahiligrade'];
	$mathfinal=$rowg['mathematics'];
	$mathgrade=$rowg['mathimaticsgrade'];
	$biofinal=$rowg['biology'];
	$biograde=$rowg['biologygrade'];
	$chemfinal=$rowg['chemistry'];
	$chemgrade=$rowg['chemistrygrade'];
	$phyfinal=$rowg['physics'];
	$phygrade=$rowg['physicsgrade'];
	$hisfinal=$rowg['history'];
	$hisgrade=$rowg['historygrade'];
	$geofinal=$rowg['geography'];
	$geograde=$rowg['geographygrade'];
	$crefinal=$rowg['cre'];
	$cregrade=$rowg['cregrade'];
	$agrfinal=$rowg['agriculture'];
	$agrgrade=$rowg['agriculturegrade'];
	$bstfinal=$rowg['businesStudies'];
	$bstgrade=$rowg['businesStudiesgrade'];
	$compfinal=$rowg['computer'];
	$compgrade=$rowg['computergrade'];
	$frefinal=$rowg['french'];
	$fregrade=$rowg['frenchgrade'];
	$homefinal=$rowg['home'];
	$homegrade=$rowg['homegrade'];
	$gradepoints=$rowg['tgrade'];
	$meangrade=$rowg['averagepoints'];
	$totalpoints=$rowg['points'];
	
	$engremarks=$rowg['engremarks'];
	$kisremarks=$rowg['kisremarks'];
	$mathremarks=$rowg['mathremarks'];
	$bioremarks=$rowg['bioremarks'];
	$chemremarks=$rowg['chemremarks'];
	$phyremarks=$rowg['phyremarks'];
	$hisremarks=$rowg['hisremarks'];
	$georemarks=$rowg['georemarks'];
	$creremarks=$rowg['creremarks'];
	$agrremarks=$rowg['agrremarks'];
	$bstremarks=$rowg['bstremarks'];
	$compremarks=$rowg['computerremarks'];
	$freremarks=$rowg['frenchremarks'];
	$homeremarks=$rowg['homeremarks'];
	$htremarks=$rowg['htremarks'];
	
	}
	if($biofinal==0){
	$biofinal="-";
	$bioPos="-";
		}else{
	  $biofinal=$biofinal;
	 }
	 if($chemfinal==0){
	$chemfinal="-";
	$chemPos="-";
		}else{
	  $chemfinal=$chemfinal;
	 }
	 if($phyfinal==0){
	$phyfinal="-";
	$phyPos="-";
		}else{
	  $phyfinal=$phyfinal;
	 }
	 if($hisfinal==0){
	$hisfinal="-";
	$hisPos="-";
		}else{
	  $hisfinal=$hisfinal;
	 }
	if($geofinal==0){
	$geofinal="-";
	$geoPos="-";
		}else{
	  $geofinal=$geofinal;
	 }
	 if($crefinal==0){
	$crefinal="-";
	$crePos="-";
		}else{
	  $crefinal=$crefinal;
	 } 
	 if($homefinal==0){
	$homefinal="-";
	$homePos="-";
		}else{
	  $homefinal=$homefinal;
	 }
	  if($agrfinal==0){
	$agrfinal="-";
	$agrPos="-";
		}else{
	  $agrfinal=$agrfinal;
	 }
	 if($compfinal==0){
	$compfinal="-";
	$compPos="-";
		}else{
	  $compfinal=$compfinal;
	 }
	  if($frefinal==0){
	$frefinal="-";
	$frePos="-";
		}else{
	  $frefinal=$frefinal;
	 }
	  if($bstfinal==0){
	$bstfinal="-";
	$bstPos="-";
		}else{
	  $bstfinal=$bstfinal;
	 }
	/****************************************************************************/
	$eng=0;
	$kis=0;
	$math=0;
	$bio=0;
	$chem=0;
	$phy=0;
	$his=0;
	$geo=0;
	$cre=0;
	$agr=0;
	$bst=0;
	$comp=0;
	$fre=0;
	$home=0;
	$catis = "SELECT * FROM markscats where form='$form' and term='$term' 
	and year='$year' and cat='1' and admno='$admno'";
	$result0 = mysql_query($catis);
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=$row0['english'];
	$kis=$row0['kiswahili'];
	$math=$row0['math'];
	$bio=$row0['biology'];
	$chem=$row0['chemistry'];
	$phy=$row0['physics'];
	$his=$row0['history'];
	$geo=$row0['geography'];
	$cre=$row0['cre'];
	$agr=$row0['agriculture'];
	$bst=$row0['bstudies'];
	$comp=$row0['computer'];
	$fre=$row0['french'];
	$home=$row0['home'];
	}
	$cat1totals=0;
	$cat1totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$comp+$fre+$home;
	
	if($bio==0){
	$bio="-";
		}else{
	  $bio=$bio;
	 }
	 if($chem==0){
	$chem="-";
		}else{
	  $chem=$chem;
	 }
	 if($phy==0){
	$phy="-";
		}else{
	  $phy=$phy;
	 }
	 if($his==0){
	$his="-";
		}else{
	  $his=$his;
	 }
	if($geo==0){
	$geo="-";
		}else{
	  $geo=$geo;
	 }
	 if($cre==0){
	$cre="-";
		}else{
	  $cre=$cre;
	 } 
	 if($home==0){
	$home="-";
		}else{
	  $home=$home;
	 }
	  if($agr==0){
	$agr="-";
		}else{
	  $agr=$agr;
	 }
	 if($comp==0){
	$comp="-";
		}else{
	  $comp=$comp;
	 }
	  if($fre==0){
	$fre="-";
		}else{
	  $fre=$fre;
	 }
	  if($bst==0){
	$bst="-";
		}else{
	  $bst=$bst;
	 }
	$eng2=0;
	$kis2=0;
	$math2=0;
	$bio2=0;
	$chem2=0;
	$phy2=0;
	$his2=0;
	$geo2=0;
	$cre2=0;
	$agr2=0;
	$bst2=0;
	$comp2=0;
	$fre2=0;
	$home2=0;
	$cat2 = "SELECT * FROM markscats where form='$form' and term='$term' 
	and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	
	$eng2=$row3['english'];
	$kis2=$row3['kiswahili'];
	$math2=$row3['math'];
	$bio2=$row3['biology'];
	$chem2=$row3['chemistry'];
	$phy2=$row3['physics'];
	$his2=$row3['history'];
	$geo2=$row3['geography'];
	$cre2=$row3['cre'];
	$agr2=$row3['agriculture'];
	$bst2=$row3['bstudies'];
	$comp2=$row3['computer'];
	$fre2=$row3['french'];
	$home2=$row3['home'];
	}
	$cat2totals=0;
	$cat2totals=$eng2+$kis2+$math2+$bio2+$chem2+$phy2+$his2+$geo2+$cre2+$agr2+$bst2+$comp2+$fre2+$home2;
	
	if($bio2==0){
	$bio2="-";
		}else{
	  $bio2=$bio2;
	 }
	 if($chem2==0){
	$chem2="-";
		}else{
	  $chem2=$chem2;
	 }
	 if($phy2==0){
	$phy2="-";
		}else{
	  $phy2=$phy2;
	 }
	 if($his2==0){
	$his2="-";
		}else{
	  $his2=$his2;
	 }
	if($geo2==0){
	$geo2="-";
		}else{
	  $geo2=$geo2;
	 }
	 if($cre2==0){
	$cre2="-";
		}else{
	  $cre2=$cre2;
	 } 
	 if($home2==0){
	$home2="-";
		}else{
	  $home2=$home2;
	 }
	  if($agr2==0){
	$agr2="-";
		}else{
	  $agr2=$agr2;
	 }
	 if($comp2==0){
	$comp2="-";
		}else{
	  $comp2=$comp2;
	 }
	  if($fre2==0){
	$fre2="-";
		}else{
	  $fre2=$fre2;
	 }
	  if($bst2==0){
	$bst2="-";
		}else{
	  $bst2=$bst2;
	 }
	//echo($admno."  ".$fname. "  ".$eng."  ". $eng2.'<br/>');
	$enge=0;
	$kise=0;
	$mathe=0;
	$bioe=0;
	$cheme=0;
	$phye=0;
	$hise=0;
	$geoe=0;
	$cree=0;
	$agre=0;
	$bste=0;
	$compe=0;
	$free=0;
	$homee=0;
	$exam = "SELECT * FROM marksemams where form='$form' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	//$exams=$row4[$subje];
	$enge=$row4['english'];
	$kise=$row4['kiswahili'];
	$mathe=$row4['math'];
	$bioe=$row4['biology'];
	$cheme=$row4['chemistry'];
	$phye=$row4['physics'];
	$hise=$row4['history'];
	$geoe=$row4['geography'];
	$cree=$row4['cre'];
	$agre=$row4['agriculture'];
	$bste=$row4['bstudies'];
	$compe=$row4['computer'];
	$free=$row4['french'];
	$homee=$row4['home'];
	}
	$examtotals=0;
	$examtotals=$enge+$kise+$mathe+$bioe+$cheme+$phye+$hise+$geoe+$cree+$agre+$bste+$compe+$free+$homee;
	
	if($bioe==0){
	$bioe="-";
		}else{
	  $bioe=$bioe;
	 }
	 if($cheme==0){
	$cheme="-";
		}else{
	  $cheme=$cheme;
	 }
	 if($phye==0){
	$phye="-";
		}else{
	  $phye=$phye;
	 }
	 if($hise==0){
	$hise="-";
		}else{
	  $hise=$hise;
	 }
	if($geoe==0){
	$geoe="-";
		}else{
	  $geoe=$geoe;
	 }
	 if($cree==0){
	$cree="-";
		}else{
	  $cree=$cree;
	 } 
	 if($homee==0){
	$homee="-";
		}else{
	  $homee=$homee;
	 }
	  if($agre==0){
	$agre="-";
		}else{
	  $agre=$agre;
	 }
	 if($compe==0){
	$compe="-";
		}else{
	  $compe=$compe;
	 }
	  if($free==0){
	$free="-";
		}else{
	  $free=$free;
	 }
	  if($bste==0){
	$bste="-";
		}else{
	  $bste=$bste;
	 }
	/*$engt=$eng+$eng2+$enge;
	$kist=$kis+$kis2+$kise;
	$matht=$math+$math2+$mathe;
	$biot=$bio+$bio2+$bioe;
	$chemt=$chem+$chem2+$cheme;
	$phyt=$phy+$phy2+$phye;
	$hist=$his+$his2+$hise;
	$geot=$geo+$geo2+$geoe;
	$cret=$cre+$cre2+$cree;
	$agrt=$agr+$agr2+$agre;
	$bstt=$bst+$bst2+$bste;*/
	
	$tmarks=$engfinal+$kisfinal+$mathfinal+$biofinal+$chemfinal+$phyfinal+$hisfinal+$geofinal+$crefinal+$agrfinal+$bstfinal+$compfinal+$frefinal+$homefinal;
	/*****************************************************************************************/
	if($form==1){
$myform='Form 1';
}
if($form==2){
$myform='Form 2';
}
if($form==3){
$myform='Form 3';
}
if($form==4){
$myform='Form 4';
}
if($term==1){
$myterm="TERM 1";
$nextterm=2;
$nextyear=$year;
}
if($term==2){
$myterm="TERM 2";
$nextterm=3;
$nextyear=$year;
}
if($term==3){
$myterm="TERM 3";
$nextterm=1;
$nextyear=($year+1);
}

$nexttermopens="";
	$nxtter=mysql_query("Select  DATE_FORMAT(begins,'%W %D %M %Y') as begins from tbl_terms where term='$nextterm' and year='$nextyear'");
	while ($rownxtop = mysql_fetch_array($nxtter)) {// get net term begins
	$nexttermopens=$rownxtop['begins'];
	}
	
	$adm=$admno;
	$T1arrear=(getLastYrBalance($adm,$year,"TERM 1",($year-1)))-(checkArrearsPaid($adm,$year))-checkOverpaymentsUsed($adm,$year);
	
	$T2arrear=(getPayableFeesTerm("TERM 1",$year,$myform))-(getPaidAmounts($adm,$year,"TERM 1"))+getAddedFeesTerm("TERM 1",$year,$adm)+(getLastYrBalance($adm,$year,"TERM 1",($year-1)))-(checkArrearsPaid($adm,$year))-checkOverpaymentsUsed($adm,$year);
	
	$T3arrear=(getPayableFeesTerm("TERM 2",$year,$myform))-(getPaidAmounts($adm,$year,"TERM 2"))+getAddedFeesTerm("TERM 2",$year,$adm)+(getPayableFeesTerm("TERM 1",$year,$myform))-(getPaidAmounts($adm,$year,"TERM 1"))+getAddedFeesTerm("TERM 1",$year,$adm)+(getLastYrBalance($adm,$year,"TERM 1",($year-1)))-(checkArrearsPaid($adm,$year))-checkOverpaymentsUsed($adm,$year);
	
	$feesbal=0;
	
	if($myterm=="TERM 1"){

	$feesbal=	$T1arrear+(getPayableFeesTerm("TERM 1",$year,$myform) +getAddedFeesTerm("TERM 1",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 1"));
	}
	
	if($myterm=="TERM 2"){
		$feesbal=$T2arrear+(getPayableFeesTerm("TERM 2",$year,$myform) +getAddedFeesTerm("TERM 2",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 2"));
	}
	
	if($myterm=="TERM 3"){
		$feesbal=	($T3arrear)+(getPayableFeesTerm("TERM 3",$year,$myform) +getAddedFeesTerm("TERM 3",$year,$adm))-(getPaidAmounts($adm,$year,"TERM 3"));
	}
	
	//echo  $admno."   t1=".$T1arrear."   t2=".$T2arrear."   t3=".$T3arrear." bal=".$feesbal."<br/>";
	//echo $admno."   t3=".$T3arrear." payable ".(getPayableFeesTerm("TERM 3",$year,$myform) +getAddedFeesTerm("TERM 3",$year,$adm))." Paid".getPaidAmounts($adm,$year,"TERM 3")." bal=".$feesbal."<br/>";
	//$feesbal=(getBalance($admno,($year-1),$myterm)+$feepayable+getAddedFees($year,$myterm,$admno))-$feepaid;
	
	
	if($form==1 && $term==1){
	$frm="Form 1";
	$trm="Term 2";
	$yr=$year;
	}
	if($form==1 && $term==2){
	$frm="Form 1";
	$trm="Term 3";
	$yr=$year;
	}
	if($form==1 && $term==3){
	$frm="Form 2";
	$trm="Term 1";
	$yr=($year+1);
	}
	
	if($form==2 && $term==1){
	$frm="Form 2";
	$trm="Term 2";
	$yr=$year;
	}
	if($form==2 && $term==2){
	$frm="Form 2";
	$trm="Term 3";
	$yr=$year;
	}
	if($form==2 && $term==3){
	$frm="Form 3";
	$trm="Term 1";
	$yr=($year+1);
	}
	
	if($form==3 && $term==1){
	$frm="Form 3";
	$trm="Term 2";
	$yr=$year;
	}
	if($form==3 && $term==2){
	$frm="Form 3";
	$trm="Term 3";
	$yr=$year;
	}
	if($form==3 && $term==3){
	$frm="Form 4";
	$trm="Term 1";
	$yr=($year+1);
	}
	
	if($form==4 && $term==1){
	$frm="Form 4";
	$trm="Term 2";
	$yr=$year;
	}
	if($form==4 && $term==2){
	$frm="Form 4";
	$trm="Term 3";
	$yr=$year;
	}
	if($form==4 && $term==3){
	$frm="Form 4";
	$trm="Term 3";
	$yr=$year;
	}
	
	$nextterm=0;
	$feenxt=mysql_query("Select SUM(amount) as payable from finance_fees where form='$frm' and term='$trm' and fiscal_yr='$yr'");
	while ($rownxt = mysql_fetch_array($feenxt)) {// get admno
	$nextterm=$rownxt['payable'];
	}
	
	$tobepaid=0;
	$tobepaid=$feesbal+$nextterm;
	/*****************************************************************************************/
/*****************************************************************************************/
	$enginitials="-";
	$engint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='English'");
	while ($roweng = mysql_fetch_array($engint)) {// get admno
	$enginitials=$roweng['initials'];
	}
	$kisinitials="-";
	$kisint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='kiswahili'");
	while ($rowkis = mysql_fetch_array($kisint)) {// get admno
	$kisinitials=$rowkis['initials'];
	}
	$mathinitials="-";
	$mathint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='math'");
	while ($rowmath = mysql_fetch_array($mathint)) {// get admno
	$mathinitials=$rowmath['initials'];
	}
	$bioinitials="-";
	$bioint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='biology'");
	while ($rowbio = mysql_fetch_array($bioint)) {// get admno
	$bioinitials=$rowbio['initials'];
	}
	$cheminitials="-";
	$chemint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='chemistry'");
	while ($rowchem = mysql_fetch_array($chemint)) {// get admno
	$cheminitials=$rowchem['initials'];
	}
	$phyinitials="-";
	$phyint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='physics'");
	while ($rowphy = mysql_fetch_array($phyint)) {// get admno
	$phyinitials=$rowphy['initials'];
	}
	$hisinitials="-";
	$hisint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='History'");
	while ($rowhis = mysql_fetch_array($hisint)) {// get admno
	$hisinitials=$rowhis['initials'];
	}
	
	$geoinitials="-";
	$geoint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='geography'");
	while ($rowgeo = mysql_fetch_array($geoint)) {// get admno
	$geoinitials=$rowgeo['initials'];
	}
	$creinitials="-";
	$creint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='cre'");
	while ($rowcre = mysql_fetch_array($creint)) {// get admno
	$creinitials=$rowcre['initials'];
	}
	$agrinitials="-";
	$agrint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='agriculture'");
	while ($rowagr = mysql_fetch_array($agrint)) {// get admno
	$agrinitials=$rowagr['initials'];
	}
	$bstinitials="-";
	$bstint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='bstudies'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$bstinitials=$rowbst['initials'];
	}
	$homeinitials="-";
	$homeint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='Homescience'");
	while ($rowhome = mysql_fetch_array($homeint)) {// get admno
	$homeinitials=$rowhome['initials'];
	}
	
	$compinitials="-";
	$compint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='Computer'");
	while ($rowcomp = mysql_fetch_array($compint)) {// get admno
	$compinitials=$rowcomp['initials'];
	}
	$freinitials="-";
	$freint=mysql_query("select initials from initials where  form='$myform' and stream='$strm' and subject='French'");
	while ($rowfre = mysql_fetch_array($freint)) {// get admno
	$freinitials=$rowfre['initials'];
	}
	/*********************************************************************************/
	

	$kcpemean=round($kmrks/5);
	if ($kcpemean >= 0 && $kcpemean <= 24) {
			$kcpemeangrade = "E";
			$graphpoint=(1*5)."px";
			$graphpoints=1;
		} else if ($kcpemean >= 25 && $kcpemean <= 29 ){
			$kcpemeangrade = "D-";
			$graphpoint=(2*5)."px";
			$graphpoints=2;
		} else if ($kcpemean >= 30 && $kcpemean <= 34) {
			$kcpemeangrade = "D";
			$graphpoint=(3*5)."px";
			$graphpoints=3;
		} else if ($kcpemean >= 35 && $kcpemean <= 39) {
			$kcpemeangrade = "D+";
			$graphpoint=(4*5)."px";
			$graphpoints=4;
		} else if ($kcpemean >= 40 && $kcpemean <= 44) {
			$kcpemeangrade = "C-";
			$graphpoint=(5*5)."px";
			$graphpoints=5;
		} else if ($kcpemean >= 45 && $kcpemean <= 49) {
			$kcpemeangrade = "C";
			$graphpoint=(6*5)."px";
			$graphpoints=6;
		} else if ($kcpemean >= 50 && $kcpemean <= 54) {
			$kcpemeangrade = "C+";
			$graphpoint=(7*5)."px";
			$graphpoints=7;
		} else if ($kcpemean >= 55 && $kcpemean <= 59) {
			$kcpemeangrade = "B-";
			$graphpoint=(8*5)."px";
			$graphpoints=8;
		} else if ($kcpemean >= 60 && $kcpemean <= 64) {
			$kcpemeangrade = "B";
			$graphpoint=(9*5)."px";
			$graphpoints=9;
		} else if ($kcpemean >= 65 && $kcpemean <= 69) {
			$kcpemeangrade = "B+";
			$graphpoint=(10*5)."px";
			$graphpoints=10;
		} else if ($kcpemean >= 70 && $kcpemean <= 74) {
			$kcpemeangrade = "A-";
			$graphpoint=(11*5)."px";
			$graphpoints=11;
		} else if ($kcpemean >= 75 && $kcpemean <= 100) {
			$kcpemeangrade = "A";
			$graphpoint=(12*5)."px";
			$graphpoints=12;
		}
//$image1="images/blur.png";

if(!file_exists("Image/".$admno.".jpg"))
  {
  $image1="images/blur.png";
  }
else
  {
 $image1 = "Image/".$admno.".jpg";
  }

$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	$email=$de['email'];
	$web=$de['website'];
	}
	$date=date("j, F, Y");
	//$term='1';
	//$year='2013';
	//$form='2';
	
//$form='1';
//$kcpepos='';
$logo = "images/logo.jpg";

$pdf->Cell(0,300,
	
	
$pdf->Image($image1,170,5,30,30).
$pdf->Image($logo,18,5,32,30).

$pdf->SetFont('times', '', 10).
$pdf->Text(70, 10, $schoolname).
$pdf->Text(75, 15,'P.o.Box  '.$po.',  '.$plac).
$pdf->Text(75, 20,'Telephone:  '.$tele).
$pdf->Text(75, 25,'Date:  '.$date).
$pdf->Text(70, 30, 'Report Form: 		TERM:'.$term.'  Year:  '.$year).


$pdf->SetFont('times', '', 9).
$pdf->Text(45, 35, 'Name: '.$fname.'   '.$mname.'    '.$lasname.'   Adm No:   '.$admno.'  FORM: '.$form.' '.$strm.'  House:'.$house).
$pdf->Line(45, 36, 170, 36).//underline the student names 
$pdf->Text(45, 41, 'KCPE Marks:- '.$kcpe.'  Grade:-   '.$kcpemeangrade.'    KCPE Entry Position:-   '.$kcpepos).

$pdf->Rect(15, 42, 180, 75).// the rectangle left,top,width, height

$pdf->SetFont('times', 'B', 9).

$pdf->Text(22, 46, 'Subject').
$pdf->Line(15, 47, 195,47).
$pdf->Text(17, 51, '101-English').
$pdf->Line(15, 52, 195, 52).
$pdf->Text(17, 56, '102-Kiswahili').
$pdf->Line(15, 57, 195, 57).
$pdf->Text(17, 61, '121-Maths').
$pdf->Line(15, 62, 195, 62).
$pdf->Text(17, 66, '231-Biology').
$pdf->Line(15, 67, 195, 67).
$pdf->Text(17, 71, '232-Physics').
$pdf->Line(15, 72, 195, 72).
$pdf->Text(17, 76, '233-Chemistry').
$pdf->Line(15, 77, 195, 77).
$pdf->Text(17, 81, '311-History').
$pdf->Line(15, 82, 195,82).
$pdf->Text(17, 86, '312-Geography').
$pdf->Line(15, 87, 195, 87).
$pdf->Text(17, 91, '313-CRE').
$pdf->Line(15, 92, 195, 92).
$pdf->Text(17, 96, '441-H/Science').
$pdf->Line(15, 97, 195, 97).
$pdf->Text(17, 101, '443-Agriculture').
$pdf->Line(15, 102, 195, 102).
$pdf->Text(17, 106, '451-Computer').
$pdf->Line(15, 107, 195, 107).
$pdf->Text(17, 111, '501-French').
$pdf->Line(15, 112, 195, 112).
$pdf->Text(17, 116, '565-B/Studies').
$pdf->Line(15, 117, 195, 117).

$pdf->SetFont('times', '', 10).
$pdf->Line(45, 42, 45, 117).//create next collumn
$pdf->Text(47, 46, 'WAT1').
$pdf->Text(47, 51, $eng).
$pdf->Text(47, 56, $kis).
$pdf->Text(47, 61, $math).
$pdf->Text(47, 66, $bio).
$pdf->Text(47, 71, $phy).
$pdf->Text(47, 76, $chem).
$pdf->Text(47, 81, $his).
$pdf->Text(47, 86, $geo).
$pdf->Text(47, 91, $cre).
$pdf->Text(47, 96, $home).
$pdf->Text(47, 101, $agr).
$pdf->Text(47, 106, $comp).
$pdf->Text(47, 111, $fre).
$pdf->Text(47, 116, $bst).

$pdf->Line(60, 42, 60, 117).//Next Column
$pdf->Text(62, 46, 'WAT2').
$pdf->Text(62, 51, $eng2).
$pdf->Text(62, 56, $kis2).
$pdf->Text(62, 61, $math2).
$pdf->Text(62, 66, $bio2).
$pdf->Text(62, 71, $phy2).
$pdf->Text(62, 76, $chem2).
$pdf->Text(62, 81, $his2).
$pdf->Text(62, 86, $geo2).
$pdf->Text(62, 91, $cre2).
$pdf->Text(62, 96, $home2).
$pdf->Text(62, 101, $agr2).
$pdf->Text(62, 106, $comp2).
$pdf->Text(62, 111, $fre2).
$pdf->Text(62, 116, $bst2).

$pdf->Line(75, 42, 75, 117).
$pdf->Text(77, 46, 'Final').
$pdf->Text(77, 51, $enge).
$pdf->Text(77, 56, $kise).
$pdf->Text(77, 61, $mathe).
$pdf->Text(77, 66, $bioe).
$pdf->Text(77, 71, $phye).
$pdf->Text(77, 76, $cheme).
$pdf->Text(77, 81, $hise).
$pdf->Text(77, 86, $geoe).
$pdf->Text(77, 91, $cree).
$pdf->Text(77, 96, $homee).
$pdf->Text(77, 101, $agre).
$pdf->Text(77, 106, $compe).
$pdf->Text(77, 111, $free).
$pdf->Text(77, 116, $bste).


$pdf->Line(90, 42, 90, 117).

$pdf->Text(92, 46, 'Avg %').
$pdf->Text(95, 51, $engfinal).
$pdf->Text(95, 56, $kisfinal).
$pdf->Text(95, 61, $mathfinal).
$pdf->Text(95, 66, $biofinal).
$pdf->Text(95, 71, $phyfinal).
$pdf->Text(95, 76, $chemfinal).
$pdf->Text(95, 81, $hisfinal).
$pdf->Text(95, 86, $geofinal).
$pdf->Text(95, 91, $crefinal).
$pdf->Text(95, 96, $homefinal).
$pdf->Text(95, 101, $agrfinal).
$pdf->Text(95, 106, $compfinal).
$pdf->Text(95, 111, $frefinal).
$pdf->Text(95, 116, $bstfinal).


$pdf->Line(105, 42, 105, 117).

$pdf->Text(107, 46, 'Grade').
$pdf->Text(107, 51, $enggrade).
$pdf->Text(107, 56, $kisgrade).
$pdf->Text(107, 61, $mathgrade).
$pdf->Text(107, 66, $biograde).
$pdf->Text(107, 71, $phygrade).
$pdf->Text(107, 76, $chemgrade).
$pdf->Text(107, 81, $hisgrade).
$pdf->Text(107, 86, $geograde).
$pdf->Text(107, 91, $cregrade).
$pdf->Text(107, 96, $homegrade).
$pdf->Text(107, 101, $agrgrade).
$pdf->Text(107, 106, $compgrade).
$pdf->Text(107, 111, $fregrade).
$pdf->Text(107, 116, $bstgrade).

$pdf->Line(120, 42, 120, 117).

$pdf->Text(122, 46, 'Sb.Pos').
$pdf->Text(125, 51, $engPos).
$pdf->Text(125, 56, $kisPos).
$pdf->Text(125, 61, $mathPos).
$pdf->Text(125, 66, $bioPos).
$pdf->Text(125, 71, $phyPos).
$pdf->Text(125, 76, $chemPos).
$pdf->Text(125, 81, $hisPos).
$pdf->Text(125, 86, $geoPos).
$pdf->Text(125, 91, $crePos).
$pdf->Text(125, 96, $homePos).
$pdf->Text(125, 101, $agrPos).
$pdf->Text(125, 106, $compPos).
$pdf->Text(125, 111, $frePos).
$pdf->Text(125, 116, $bstPos).

$pdf->Line(135, 42, 135, 117).

$pdf->Text(137, 46, 'Remarks').
$pdf->Text(137, 51, $engremarks).
$pdf->Text(137, 56, $kisremarks).
$pdf->Text(137, 61, $mathremarks).
$pdf->Text(137, 66, $bioremarks).
$pdf->Text(137, 71, $phyremarks).
$pdf->Text(137, 76, $chemremarks).
$pdf->Text(137, 81, $hisremarks).
$pdf->Text(137, 86, $georemarks).
$pdf->Text(137, 91, $creremarks).
$pdf->Text(137, 96, $homeremarks).
$pdf->Text(137, 101, $agrremarks).
$pdf->Text(137, 106, $compremarks).
$pdf->Text(137, 111, $freremarks).
$pdf->Text(137, 116, $bstremarks).

$pdf->Line(165, 42, 165, 117).

$pdf->Text(172, 46, 'Sign').
$pdf->Text(172, 51, $enginitials).
$pdf->Text(172, 56, $kisinitials).
$pdf->Text(172, 61, $mathinitials).
$pdf->Text(172, 66, $bioinitials).
$pdf->Text(172, 71, $phyinitials).
$pdf->Text(172, 76, $cheminitials).
$pdf->Text(172, 81, $hisinitials).
$pdf->Text(172, 86, $geoinitials).
$pdf->Text(172, 91, $creinitials).
$pdf->Text(172, 96, $homeinitials).
$pdf->Text(172, 101, $agrinitials).
$pdf->Text(172, 106, $compinitials).
$pdf->Text(172, 111, $freinitials).
$pdf->Text(172, 116, $bstinitials).



$pdf->SetFont('times', 'b', 9).
$pdf->Text(17, 121, 'TOTALS MARKS').
$pdf->Text(47, 121, $cat1totals).
$pdf->Text(62, 121, $cat2totals).
$pdf->Text(77, 121, $examtotals).
$pdf->Text(95, 121, $tmarks.'    Out of:  '  .$totalOutOf).
$pdf->SetFont('times', '', 9).
$pdf->Text(20, 126, 'Mean: 	   '.$meangrade.'   Total Points  '.$totalpoints.'        Grade:	 '.$gradepoints.'     Overall Position:	      '.$studentPos .'       Out of:  '.$totalStudents).
$pdf->Text(80, 130, 'Position in Class:	     '.$studentPosClass.'       Out of:  '.$totalStudentsClass).

$pdf->SetFont('arial', 'I', 9).
$pdf->SetTextColor(255, 100, 100).
$pdf->Text(70, 135, 'Performance Analysis').
$pdf->Line(20, 200, 20, 140).//y axis
$pdf->Line(18, 200, 100, 200).//x axis


$pdf->Text(14, 135, 'mean').
$pdf->SetFont('times', '', 7).
$pdf->SetTextColor(0,0,0).
//$pdf->SetDrawColor(232,232,232).
$pdf->SetLineWidth(0.2).
$pdf->SetDash(1, 0.5). //1mm on, 0.5mm off
$pdf->SetDrawColor(0, 0, 0, 100).
$pdf->Text(16, 140, '12').
$pdf->Line(18, 140, 98, 140).//y indicator
$pdf->Text(16, 145, '11').
$pdf->Line(18, 145, 98, 145).//y indicator
$pdf->Text(16, 150, '10').
$pdf->Line(18, 150, 98, 150).//y indicator
$pdf->Text(16, 155, '9').
$pdf->Line(18, 155, 98, 155).//y indicator
$pdf->Text(16, 160, '8').
$pdf->Line(18, 160, 98, 160).//y indicator
$pdf->Text(16, 165, '7').
$pdf->Line(18, 165, 98, 165).//y indicator
$pdf->Text(16, 170, '6').
$pdf->Line(18, 170, 98, 170).//y indicator
$pdf->Text(16, 175, '5').
$pdf->Line(18, 175, 98, 175).//y indicator
$pdf->Text(16, 180, '4').
$pdf->Line(18, 180, 98, 180).//y indicator
$pdf->Text(16, 185, '3').
$pdf->Line(18, 185, 98, 185).//y indicator
$pdf->Text(16, 190, '2').
$pdf->Line(18, 190, 98, 190).//y indicator
$pdf->Text(16, 195, '1').
$pdf->Line(18, 195, 98, 195).//y indicator
$pdf->Text(16, 200, '0').
$pdf->SetDash().
$pdf->SetDrawColor(0, 0, 0, 100).
$pdf->SetFillColor(0, 0, 0, 100).//black
$pdf->Rect(21, 200-$graphpoint, 3, $graphpoint, 'DF').//kcpe graph

//Draw the graphs
$pdf->SetFillColor(255, 0, 0).//red
$pdf->Rect(28, 200-$forgraphone, 3, $forgraphone, 'DF').//Form 1 T1 graph
$pdf->SetFillColor(0, 0, 255).//blue
$pdf->Rect(33, 200-$forgraphone2, 3, $forgraphone2, 'DF').//Form 1 T1 graph
$pdf->SetFillColor(0, 255, 0).//green
$pdf->Rect(38, 200-$forgraphone3, 3, $forgraphone3, 'DF').//Form 1 T1 graph

$pdf->SetFillColor(255, 0, 0).//red
$pdf->Rect(48, 200-$forgraph, 3, $forgraph, 'DF').//Form 2 T1 graph
$pdf->SetFillColor(0, 0, 255).//blue
$pdf->Rect(53, 200-$for2graph, 3, $for2graph, 'DF').//Form 2 T2 graph
$pdf->SetFillColor(0, 255, 0).//green
$pdf->Rect(58, 200-$for23graph, 3, $for23graph, 'DF').//Form 2 T3 graph

$pdf->SetFillColor(255, 0, 0).//red
$pdf->Rect(67, 200-$for3graph, 3, $for3graph, 'DF').//Form 3 T1 graph
$pdf->SetFillColor(0, 0, 255).//blue
$pdf->Rect(72, 200-$for32graph, 3, $for32graph, 'DF').//Form 3 T2 graph
$pdf->SetFillColor(0, 255, 0).//green
$pdf->Rect(77, 200-$for33graph, 3, $for33graph, 'DF').//Form 3 T3 graph

$pdf->SetFillColor(0, 0, 255).//blue
$pdf->Rect(87, 200-$for4graph, 3, $for4graph, 'DF').//Form 1 T1 graph
$pdf->SetFillColor(0, 255, 0).//green
$pdf->Rect(92, 200-$for42graph, 3, $for42graph, 'DF').//Form 1 T1 graph



$pdf->Text(103, 147, 'V.A.P=Value Added Progress             V.A.P= (Current Mean Grade - KCPE Mean Grade)').

$pdf->SetFont('times', '', 7).
$pdf->Rect(100, 150, 100, 25).// the left rectangle
$pdf->Line(100, 155, 200, 155).//x dividers
$pdf->Text(103, 159, 'Mean').
$pdf->Text(120, 153, 'Form 1').
$pdf->Text(140, 153, 'Form 2').
$pdf->Text(163, 153, 'Form 3').
$pdf->Text(185, 153, 'Form 4').

$pdf->SetFont('arial', '', 6).
$pdf->Text(113, 159, $formonemean).
$pdf->Text(120, 159, $formone2mean).
$pdf->Text(127, 159, $formone3mean).
$pdf->Text(135, 159, $formtwomean).
$pdf->Text(142, 159, $formtwo2mean).
$pdf->Text(149, 159, $formtwo3mean).
$pdf->Text(158, 159, $forms3mean).
$pdf->Text(165, 159, $forms32mean).
$pdf->Text(172, 159, $forms33mean).
$pdf->Text(181, 159, $forms4mean).
$pdf->Text(190, 159, $forms42mean).
$pdf->Line(100, 160, 200, 160).//x end of mean column dividers

$pdf->SetFont('arial', '', 6).
$pdf->Text(103, 164, 'VAP').
$pdf->Text(113, 164, $term1vap).
$pdf->Text(120, 164, $term2vap).
$pdf->Text(127, 164, $term3vap).
$pdf->Text(135, 164, $term12vap).
$pdf->Text(142, 164, $term22vap).
$pdf->Text(149, 164, $term32vap).
$pdf->Text(158, 164, $term13vap).
$pdf->Text(165, 164, $term23vap).
$pdf->Text(172, 164, $term33vap).
$pdf->Text(181, 164, $term14vap).
$pdf->Text(190, 164, $term24vap).
$pdf->Line(100, 165, 200, 165).//x end of position dividers

$pdf->SetFont('times', '', 7).
$pdf->Text(103, 169, 'Pos.').
$pdf->Text(113, 169, $term1posi).
$pdf->Text(120, 169, $term2posi).
$pdf->Text(127, 169, $term3posi).
$pdf->Text(135, 169, $term12posi).
$pdf->Text(142, 169, $term22posi).
$pdf->Text(149, 169, $term32posi).
$pdf->Text(158, 169, $term13posi).
$pdf->Text(165, 169, $term23posi).
$pdf->Text(172, 169, $term33posi).
$pdf->Text(181, 169, $term14posi).
$pdf->Text(190, 169, $term24posi).
$pdf->Line(100, 170, 200, 170).//x end of position dividers


$pdf->Text(101, 174, 'Out Of').
$pdf->Text(113, 174, $term1outof).
$pdf->Text(120, 174, $term2outof).
$pdf->Text(127, 174, $term3outof).
$pdf->Text(135, 174, $term12outof).
$pdf->Text(142, 174, $term22outof).
$pdf->Text(149, 174, $term32outof).
$pdf->Text(158, 174, $term13outof).
$pdf->Text(165, 174, $term23outof).
$pdf->Text(172, 174, $term33outof).
$pdf->Text(181, 174, $term14outof).
$pdf->Text(190, 174, $term24outof).

$pdf->Line(112, 150, 112, 175).//y divider
$pdf->Line(134, 150, 134, 175).//y divider
$pdf->Line(157, 150, 157, 175).//y divider
$pdf->Line(180, 150, 180, 175).//y divider


$pdf->Text(125, 200, 'Official School Stamp _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _').



$pdf->SetFont('arial', '', 7).
$pdf->Text(23, 207, 'KCPE').
$pdf->Text(28, 203, 'T1').
$pdf->Text(33, 203, 'T2').
$pdf->Text(38, 203, 'T3').
$pdf->Text(35, 207, 'Form 1').
$pdf->Text(48, 203, 'T1').
$pdf->Text(53, 203, 'T2').
$pdf->Text(58, 203, 'T3').
$pdf->Text(53, 207, 'Form 2').
$pdf->Text(67, 203, 'T1').
$pdf->Text(72, 203, 'T2').
$pdf->Text(77, 203, 'T3').
$pdf->Text(73, 207, 'Form 3').
$pdf->Text(87, 203, 'T1').
$pdf->Text(92, 203, 'T2').
$pdf->Text(88, 207, 'Form 4').

$pdf->SetFont('times', 'b', 9).

$pdf->Rect(20, 215, 180, 8).// the left rectangle
$pdf->Text(23, 220, 'Fee Arrears Ksh:                '.number_format($feesbal,2)).
$pdf->Text(80, 220, 'Next Terms Fee Ksh:             '.number_format($nextterm,2)).
$pdf->Text(150, 220, 'Total Fee Ksh:                 '.number_format($tobepaid,2)).
$pdf->SetFont('times', '', 9).
$pdf->Text(23, 230, 'Class Teacher Comments ___________________________________________________________________________________').
$pdf->Text(23, 237, 'Date __________________________________ Signature __________________________________').
$pdf->Text(23, 244, 'Head Teacher/Deputy  Comment ________________________________________________________________________').
$pdf->Text(23, 251, '______________________________________________________________________________________________________').
$pdf->Text(23, 258, 'Date __________________________________ Signature __________________________________').
$pdf->Text(23, 265, 'Report Seen By Parent/Guardian Sign _______________________________ 	Date____________________________').
$pdf->Text(23, 271, 'Next Term Begins On: __________________________________').
$pdf->SetFont('times', 'BU', 9).
$pdf->Text(60, 270, $nexttermopens).
$pdf->SetFont('times', '', 6).
$pdf->Text(130,290,'Generated using Chrimoska LTD School Management System on '. $date,0,0,'R').
$pdf->SetFont('times', '', 7).
$pdf->Text(50,285,'Email:'.$email.', Website:'.$web.'',0,0,'C').' ','',1);

	
}
}
$pdf->Output();

?>
