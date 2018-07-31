<?php
 
require_once('auth.php');
//require('pdfColors.php');
require('rotation.php');
include 'includes/Grading.php';




$grading = new Grading();


class PDF extends PDF_Rotate{
	function Header(){
		//Put the watermark
	$admno=$_GET['id'];
	$getnames = "SELECT * from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$house=$row2['house'];
	$kcpe=$row2['marks'];
	$grade=$row2['grade'];
	
	}
	
		$this->SetFont('times','B',30);
		$this->SetTextColor(204,255,204);
		$this->RotatedText(30,100,$fname." ".$mname." ".$lasname,10);
		$this->RotatedText(30,250,$fname." ".$mname." ".$lasname,10);
	}

	function RotatedText($x, $y, $txt, $angle){
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
	
	function SetDash($black=false, $white=false)
    {
        if($black and $white)
            $s=sprintf('[%.3f %.3f] 0 d', $black*$this->k, $white*$this->k);
        else
            $s='[] 0 d';
        $this->_out($s);
    }
}//end of class





        

if (isset($_GET['id'])) {
$admno=$_GET['id'];
$form=$_GET['forms'];
$term=$_GET['term'];
$year=$_GET['yr'];
$strm=$_GET['classin'];

$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Printed ".$admno." Mock report form ".$year." trm ".$term;
$func->addAuditTrail($activity,$username);



	

$title="Exam Report Form";
if($term=="1"){
$title="Exam Report Form";
}
if($term=="2" && $form=="4"){
$title="Cluster Report Form";
}
if($term=="3"){
$title="Cluster Report Form";
}

//Connect to database
include('includes/dbconnector.php');
	
	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
	}
	$date=date("j, F, Y");
	

	$house="___";
	$kcpe="_";
	$grade="-";
	$getnames = "SELECT fname,sname,lname,house,marks,grade from studentdetails where admno='$admno'";// get names
	$result3 = @mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$house=$row2['house'];
	$kcpe=$row2['marks'];
	$grade=$row2['grade'];
	
	}
/*********************************************************************************/
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
	
	
	
	
	//get Form1 Term1 Mean
	$formonemean=0.0;
	$forgraphone=0;
	$form1mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='1' and term='1'");
	while ($rowf1m = mysql_fetch_array($form1mean)) {// get admno
	$formonemean=$rowf1m['averagepoints'];
	$forgraphone=($formonemean*5)."px";
	}
	
	$formone2mean=0.0;
	$forgraphone2=0;
	$form12mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='1' and term='2'");
	while ($rowf12m = mysql_fetch_array($form12mean)) {// get adm
	$formone2mean=$rowf12m['averagepoints'];
	$forgraphone2=($formone2mean*5)."px";
	}
	
	$formone3mean=0.0;
	$forgraphone3=0;
	$form13mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='1' and term='3'");
	while ($rowf13m = mysql_fetch_array($form13mean)) {// get admno
	$formone3mean=$rowf13m['averagepoints'];
	$forgraphone3=($formone3mean*5)."px";
	}
	/***************** get positioning ***********************************************/
	$term1outof="-";
	$f1t1=@mysql_query("Select count(admno) as admn  from mockpositions where  form='1' and term='1' and year='$year'");
	while ($rowf1t1 = mysql_fetch_array($f1t1)) {// get admno
	$term1outof=$rowf1t1['admn'];
	
	if($term1outof==0){
	$term1outof="-";
	}
	}
	$term1posi="-";
	$f1t1pos=@mysql_query("Select position   from mockpositions where  form='1' and term='1' and admno='$admno'");
	while ($rowf1t1p = mysql_fetch_array($f1t1pos)) {// get admno
	$term1posi=$rowf1t1p['position'];
	}
	
	$term2outof="-";
	$f1t2=@mysql_query("Select count(admno) as admn  from mockpositions where  form='1' and term='2' and year='$year'");
	while ($rowf1t2 = mysql_fetch_array($f1t2)) {// get admno
	$term2outof=$rowf1t2['admn'];
	
	if($term2outof==0){
	$term2outof="-";
	}
	}
	$term2posi="-";
	$f1t2pos=@mysql_query("Select position   from mockpositions where  form='1' and term='2' and admno='$admno'");
	while ($rowf1t2p = mysql_fetch_array($f1t2pos)) {// get admno
	$term2posi=$rowf1t2p['position'];
	}
	
	$term3outof="-";
	$f1t3=@mysql_query("Select count(admno) as admn  from mockpositions where  form='1' and term='3' and year='$year'");
	while ($rowf1t3 = mysql_fetch_array($f1t3)) {// get admno
	$term3outof=$rowf1t3['admn'];
	
	if($term3outof==0){
	$term3outof="-";
	}
	}
	$term3posi="-";
	$f1t3pos=@mysql_query("Select position   from mockpositions where  form='1' and term='3' and admno='$admno'");
	while ($rowf1t3p = mysql_fetch_array($f1t3pos)) {// get admno
	$term3posi=$rowf1t3p['position'];
	}
	/*********************************************************************************/
	
	//get Form2 Mean
	$formtwomean=0.0;
	$forgraph=0;
	$form2mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='2' and term='1'");
	while ($rowf2m = mysql_fetch_array($form2mean)) {// get admno
	$formtwomean=$rowf2m['averagepoints'];
	$forgraph=($formtwomean*5)."px";
	}
	
	$formtwo2mean=0.0;
	$for2graph=0;
	$form22mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='2' and term='2'");
	while ($rowf22m = mysql_fetch_array($form22mean)) {// get admno
	$formtwo2mean=$rowf22m['averagepoints'];
	$for2graph=($formtwo2mean*5)."px";
	}
	
	$formtwo3mean=0.0;
	$for23graph=0;
	$form23mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='2' and term='3'");
	while ($rowf23m = mysql_fetch_array($form23mean)) {// get admno
	$formtwo3mean=$rowf23m['averagepoints'];
	$for23graph=($formtwo3mean*5)."px";
	}
	/*********************************************************************************/
	/***************** get positioning ***********************************************/
	$term12outof="-";
	$f2t1=@mysql_query("Select count(admno) as admn  from mockpositions where  form='2' and term='1' and year='$year'");
	while ($rowf2t1 = mysql_fetch_array($f2t1)) {// get admno
	$term12outof=$rowf2t1['admn'];
	
	if($term12outof==0){
	$term12outof="-";
	}
	}
	$term12posi="-";
	$f2t1pos=@mysql_query("Select position   from mockpositions where  form='2' and term='1' and admno='$admno'");
	while ($rowf2t1p = mysql_fetch_array($f2t1pos)) {// get admno
	$term12posi=$rowf2t1p['position'];
	}
	
	$term22outof="-";
	$f2t2=@mysql_query("Select count(admno) as admn  from mockpositions where  form='2' and term='2' and year='$year'");
	while ($rowf2t2 = mysql_fetch_array($f2t2)) {// get admno
	$term22outof=$rowf2t2['admn'];
	
	if($term22outof==0){
	$term22outof="-";
	}
	}
	$term22posi="-";
	$f2t2pos=@mysql_query("Select position   from mockpositions where  form='2' and term='2' and admno='$admno'");
	while ($rowf2t2p = mysql_fetch_array($f2t2pos)) {// get admno
	$term22posi=$rowf2t2p['position'];
	}
	
	$term32outof="-";
	$f2t3=@mysql_query("Select count(admno) as admn  from mockpositions where  form='2' and term='3' and year='$year'");
	while ($rowf2t3 = mysql_fetch_array($f2t3)) {// get admno
	$term32outof=$rowf2t3['admn'];
	
	if($term32outof==0){
	$term32outof="-";
	}
	}
	$term32posi="-";
	$f2t3pos=@mysql_query("Select position   from mockpositions where  form='2' and term='2' and admno='$admno'");
	while ($rowf2t3p = mysql_fetch_array($f2t3pos)) {// get admno
	$term32posi=$rowf2t3p['position'];
	}
	/*********************************************************************************/
	//get Form3 Mean
	$forms3mean=0.0;
	$for3graph=0;
	$form3mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='3' and term='1'");
	while ($rowf3m = mysql_fetch_array($form3mean)) {// get admno
	$forms3mean=$rowf3m['averagepoints'];
	$for3graph=($forms3mean*5)."px";
	}
	
	$forms32mean=0.0;
	$for32graph=0;
	$form32mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='3' and term='2'");
	while ($rowf32m = mysql_fetch_array($form32mean)) {// get admno
	$forms32mean=$rowf32m['averagepoints'];
	$for32graph=($forms32mean*5)."px";
	}
	
	$forms33mean=0.0;
	$for33graph=0;
	$form33mean=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='3' and term='3'");
	while ($rowf33m = mysql_fetch_array($form33mean)) {// get admno
	$forms33mean=$rowf33m['averagepoints'];
	$for33graph=($forms33mean*5)."px";
	}
	
	/***************** get positioning ***********************************************/
	$term13outof="-";
	$f3t1=@mysql_query("Select count(admno) as admn  from mockpositions where  form='3' and term='1' and year='$year'");
	while ($rowf3t1 = mysql_fetch_array($f3t1)) {// get admno
	$term13outof=$rowf3t1['admn'];
	
	if($term13outof==0){
	$term13outof="-";
	}
	}
	$term13posi="-";
	$f3t1pos=@mysql_query("Select position   from mockpositions where  form='3' and term='1' and admno='$admno'");
	while ($rowf3t1p = mysql_fetch_array($f3t1pos)) {// get admno
	$term13posi=$rowf3t1p['position'];
	}
	
	$term23outof="-";
	$f3t2=@mysql_query("Select count(admno) as admn  from mockpositions where  form='3' and term='2' and year='$year'");
	while ($rowf3t2 = mysql_fetch_array($f3t2)) {// get admno
	$term23outof=$rowf3t2['admn'];
	
	if($term23outof==0){
	$term23outof="-";
	}
	}
	$term23posi="-";
	$f3t2pos=@mysql_query("Select position   from mockpositions where  form='3' and term='2' and admno='$admno'");
	while ($rowf3t2p = mysql_fetch_array($f3t2pos)) {// get admno
	$term23posi=$rowf3t2p['position'];
	}
	
	$term33outof="-";
	$f3t3=@mysql_query("Select count(admno) as admn  from mockpositions where  form='3' and term='3' and year='$year'");
	while ($rowf3t3 = mysql_fetch_array($f3t3)) {// get admno
	$term33outof=$rowf3t3['admn'];
	
	if($term33outof==0){
	$term33outof="-";
	}
	}
	$term33posi="-";
	$f3t3pos=@mysql_query("Select position   from mockpositions where  form='3' and term='2' and admno='$admno'");
	while ($rowf3t3p = mysql_fetch_array($f3t3pos)) {// get admno
	$term33posi=$rowf3t3p['position'];
	}
	/*********************************************************************************/
	
	//get Form4 Mean
	$forms4mean=0.0;
	$for4graph=0;
	
	$form4m1=@mysql_query("Select averagepoints from totalygradedmarks where adm='$admno'
	 and form='4' and term='1'");
	while ($rowf4m = mysql_fetch_array($form4m1)) {// get admno
	$forms4mean=$rowf4m['averagepoints'];
	$for4graph=($forms4mean*5)."px";
	}
	
	$form4mean=@mysql_query("Select averagepoints from totalygradedmockmarks where adm='$admno'
	 and form='4' and term='1'");
	while ($rowf4m = mysql_fetch_array($form4mean)) {// get admno
	$forms4mean=$rowf4m['averagepoints'];
	$for4graph=($forms4mean*5)."px";
	}
	
	$forms42mean=0.0;
	$for42graph=0;
	$form42mean=@mysql_query("Select averagepoints from totalygradedmockmarks where adm='$admno'
	 and form='4' and term='2'");
	while ($rowf42m = mysql_fetch_array($form42mean)) {// get admno
	$forms42mean=$rowf42m['averagepoints'];

	$for42graph=($forms42mean*5)."px";
	}
	/********************************************************************************/
	$term14outof="-";
	$f4t1=@mysql_query("Select count(admno) as admn  from mockpositions where  form='4' and term='1' and year='$year'");
	while ($rowf4t1 = mysql_fetch_array($f4t1)) {// get admno
	$term14outof=$rowf4t1['admn'];
	
	if($term14outof==0){
	$term14outof="-";
	}
	}
	$term14posi="-";
	$f4t1pos=@mysql_query("Select position   from mockpositions where  form='4' and term='1' and admno='$admno'");
	while ($rowf4t1p = mysql_fetch_array($f4t1pos)) {// get admno
	$term14posi=$rowf4t1p['position'];
	}
	
	$term24outof="-";
	$f4t2=@mysql_query("Select count(admno) as admn  from mockpositions where  form='4' and term='2' and year='$year'");
	while ($rowf4t2 = mysql_fetch_array($f4t2)) {// get admno
	$term24outof=$rowf4t2['admn'];
	
	if($term24outof==0){
	$term24outof="-";
	}
	}
	$term24posi="-";
	$f4t2pos=@mysql_query("Select position   from mockpositions where  form='4' and term='2' and admno='$admno'");
	while ($rowf4t2p = mysql_fetch_array($f4t2pos)) {// get admno
	$term24posi=$rowf4t2p['position'];
	}
	/*********************************************************************************/
	
	$getPosition = @mysql_query("Select * from mockpositions where admno='$admno' and form='$form' and term='$term' and year='$year'");
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
	/***********************************************************************************/
	$totalStudents=0;
	$getTotalstudents = @mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form'");
	while ($rowstuden = mysql_fetch_array($getTotalstudents)) {// get admno
	$totalStudents=$rowstuden['adms'];
	}
	
	if($form==1 || $form==2){
	$subsDone=11;
	}else if($form==3 ||$form==4){
	$subsDone=8;
	}
	$getDone = @mysql_query("Select * from subjectsforstudent where admno='$admno' and form='$form'");
	while ($rowDone = mysql_fetch_array($getDone)) {// get admno
	$subsDone=$rowDone['subjects'];
	}
	$totalOutOf=$subsDone*100;
	/**************************************************************/
	/****************** get grade ********************************/
	//$cat1 = "SELECT distinct(admno) FROM markscats where form='$form' and term='$term' and year='$year'";//admno query
	$getgrades="select * from totalygradedmockmarks where term='$term' and year='$year' and adm='$admno'";
	$resultgrades = @mysql_query($getgrades);
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
	$eng2=0;
	$math=0;
	$bio=0;
	$chem=0;
	$phy=0;
	$his=0;
	$geo=0;
	$cre=0;
	$agr=0;
	$bst=0;
	$fre=0;
	$comp=0;
	$home=0;
	
	
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
	
	$home=0;
	$fre=0;
	$comp=0;
	
	
	
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
	
	$home2=0;
	$fre2=0;
	$comp2=0;
	
	
	
	
$tmarks=$engfinal+$kisfinal+$mathfinal+$biofinal+$chemfinal+$phyfinal+$hisfinal+$geofinal+$crefinal+$agrfinal+$bstfinal + $frefinal + $compfinal + $homefinal;


	$exam = "SELECT * FROM mockexams where form='$form' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = @mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	//$exams=$row4[$subje];
	$eng=$row4['english1'];
	$eng2=$row4['english2'];
	$enge=$row4['english3'];
	$kis=$row4['kiswahili1'];
	$kis2=$row4['kiswahili2'];
	$kise=$row4['kiswahili3'];
	$math=$row4['math1'];
	$math2=$row4['math2'];
	$mathe=$row4['math3'];
	$bio=$row4['biology1'];
	$bio2=$row4['biology2'];
	$bioe=$row4['biology3'];
	$chem=$row4['chemistry1'];
	$chem2=$row4['chemistry2'];
	$cheme=$row4['chemistry3'];
	$phy=$row4['physics1'];
	$phy2=$row4['physics2'];
	$phye=$row4['physics3'];
	$his=$row4['history1'];
	$his2=$row4['history2'];
	$hise=$row4['history3'];
	$geo=$row4['geography1'];
	$geo2=$row4['geography2'];
	$geoe=$row4['geography3'];
	$cre=$row4['cre1'];
	$cre2=$row4['cre2'];
	$cree=$row4['cre3'];
	$agr=$row4['agriculture1'];
	$agr2=$row4['agriculture2'];
	$agre=$row4['agriculture3'];
	
	$bst=$row4['bstudies1'];
	$bst2=$row4['bstudies2'];
	$bste=$row4['bstudies3'];
	
	$comp=$row4['computer1'];
	$comp2=$row4['computer2'];
	$compe=$row4['computer3'];
	
	$fre=$row4['french1'];
	$fre2=$row4['french2'];
	$free=$row4['french3'];
	
	$home=$row4['home1'];
	$home2=$row4['home2'];
	$homee=$row4['home3'];
	
	
	}
	
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
	$bstt=$bst+$bst2+$bste;
	
	$tmarks=$engt+$kist+$matht+$biot+$chemt+$phyt+$hist+$geot+$cret+$agrt+$bstt;*/
	/******************************************************************/
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
$myterm="Term 1";
}
if($term==2){
$myterm="Term 2";
}
if($term==3){
$myterm="Term 3";
}
	$feepayable="0";
	$feearrq=@mysql_query("select * from fees where form='$myform' and term='$myterm' and year='$year'");
	while ($rowfr = mysql_fetch_array($feearrq)) {// get admno
	$feepayable=$rowfr['payable'];
	}
	
	$feepaid=0;
   $feepaidq=@mysql_query("SELECT sum(amount) as paid  FROM feestructures where admno='$admno' and term='$term' and year='$year'");
	while ($rowp = mysql_fetch_array($feepaidq)) {// get admno
	$feepaid=$rowp['paid'];
	}
	$feesbal=0;
	$feesbal=$feepayable-$feepaid;
	
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
	
	$nextterm=0;
	$feenxt=@mysql_query("Select * from fees where form='$frm' and term='$trm' and year='$yr'");
	while ($rownxt = mysql_fetch_array($feenxt)) {// get admno
	$nextterm=$rownxt['payable'];
	}
	
	$tobepaid=0;
	$tobepaid=$feesbal+$nextterm;
	
    $enginitials="-";
	$engint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='English'");
	while ($roweng = mysql_fetch_array($engint)) {// get admno
	$enginitials=$roweng['initials'];
	}
	$kisinitials="-";
	$kisint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='kiswahili'");
	while ($rowkis = mysql_fetch_array($kisint)) {// get admno
	$kisinitials=$rowkis['initials'];
	}
	$mathinitials="-";
	$mathint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='math'");
	while ($rowmath = mysql_fetch_array($mathint)) {// get admno
	$mathinitials=$rowmath['initials'];
	}
	$bioinitials="-";
	$bioint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='biology'");
	while ($rowbio = mysql_fetch_array($bioint)) {// get admno
	$bioinitials=$rowbio['initials'];
	}
	$cheminitials="-";
	$chemint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='chemistry'");
	while ($rowchem = mysql_fetch_array($chemint)) {// get admno
	$cheminitials=$rowchem['initials'];
	}
	$phyinitials="-";
	$phyint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='physics'");
	while ($rowphy = mysql_fetch_array($phyint)) {// get admno
	$phyinitials=$rowphy['initials'];
	}
	$hisinitials="-";
	$hisint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='History'");
	while ($rowhis = mysql_fetch_array($hisint)) {// get admno
	$hisinitials=$rowhis['initials'];
	}
	
	$geoinitials="-";
	$geoint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='geography'");
	while ($rowgeo = mysql_fetch_array($geoint)) {// get admno
	$geoinitials=$rowgeo['initials'];
	}
	$creinitials="-";
	$creint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='cre'");
	while ($rowcre = mysql_fetch_array($creint)) {// get admno
	$creinitials=$rowcre['initials'];
	}
	$agrinitials="-";
	$agrint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='agriculture'");
	while ($rowagr = mysql_fetch_array($agrint)) {// get admno
	$agrinitials=$rowagr['initials'];
	}
	$bstinitials="-";
	$bstint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='bstudies'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$bstinitials=$rowbst['initials'];
	}
	
    $homeinitials="-";
	$bstint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='home'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$homeinitials=$rowbst['initials'];
	}

	$compinitials="-";
	$bstint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='computer'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$compinitials=$rowbst['initials'];
	}
	
	
	$freinitials="-";
	$bstint=@mysql_query("select initials from initials where  form='$frm' and stream='$strm' and subject='french'");
	while ($rowbst = mysql_fetch_array($bstint)) {// get admno
	$freinitials=$rowbst['initials'];
	}
	
	
	// *************************************************CATS MARKS QUERY *************************************************************8
	
	
	$getstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
	while ($rowsrd = mysql_fetch_array($getstandard)) {
	$examstandard=$rowsrd['exam'];
	$cat1standard=$rowsrd['cat1'];
	$cat2standard=$rowsrd['cat2'];
	$cat1per=$rowsrd['cat1percent'];
	$cat2per=$rowsrd['cat2percent'];
	$examper=$rowsrd['exampercent'];
	}
	
	
	$engcat1=0;
	$kiscat1=0;
	$mathcat1=0;
	$biocat1=0;
	$chemcat1=0;
	$phycat1=0;
	$hiscat1=0;
	$geocat1=0;
	$crecat1=0;
	$agrcat1=0;
	$bstcat1=0;
	$frecat1=0;
	$compcat1=0;
	$homecat1=0;
	$catis = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='1' and admno='$admno'";
	$result0 = mysql_query($catis);
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	
	$cat1per = 100;
	$engcat1=($row0['english']/$cat1standard)*$cat1per;
	$kiscat1=($row0['kiswahili']/$cat1standard)*$cat1per;
	$mathcat1=($row0['math']/$cat1standard)*$cat1per;
	$biocat1=($row0['biology']/$cat1standard)*$cat1per;
	$chemcat1=($row0['chemistry']/$cat1standard)*$cat1per;
	$phycat1=($row0['physics']/$cat1standard)*$cat1per;
	$hiscat1=($row0['history']/$cat1standard)*$cat1per;
	$geocat1=($row0['geography']/$cat1standard)*$cat1per;
	$crecat1=($row0['cre']/$cat1standard)*$cat1per;
	$agrcat1=($row0['agriculture']/$cat1standard)*$cat1per;
	$bstcat1=($row0['bstudies']/$cat1standard)*$cat1per;
	$frecat1=($row0['french']/$cat1standard)*$cat1per;
	$compcat1=($row0['computer']/$cat1standard)*$cat1per;
	$homecat1=($row0['home']/$cat1standard)*$cat1per;
	}
	
	if($biocat1==0){
	$biocat1="-";
		}else{
	  $biocat1=$biocat1;
	 }
	 if($chemcat1==0){
	$chemcat1="-";
		}else{
	  $chemcat1=$chemcat1;
	 }
	 if($phycat1==0){
	$phycat1="-";
		}else{
	  $phycat1=$phycat1;
	 }
	 if($hiscat1==0){
	$hiscat1="-";
		}else{
	  $hiscat1=$hiscat1;
	 }
	if($geocat1==0){
	$geocat1="-";
		}else{
	  $geocat1=$geocat1;
	 }
	 if($crecat1==0){
	$crecat1="-";
		}else{
	  $crecat1=$crecat1;
	 } 
	 if($homecat1==0){
	$homecat1="-";
		}else{
	  $homecat1=$homecat1;
	 }
	  if($agrcat1==0){
	$agrcat1="-";
		}else{
	  $agrcat1=$agrcat1;
	 }
	 if($compcat1==0){
	$compcat1="-";
		}else{
	  $compcat1=$compcat1;
	 }
	  if($frecat1==0){
	$frecat1="-";
		}else{
	  $frecat1=$frecat1;
	 }
	  if($bstcat1==0){
	$bstcat1="-";
		}else{
	  $bstcat1=$bstcat1;
	 }
	 
	$kiscat2=0;
	$engcat2=0;
	$mathcat2=0;
	$biocat2=0;
	$chemcat2=0;
	$phycat2=0;
	$hiscat2=0;
	$geocat2=0;
	$crecat2=0;
	$agrcat2=0;
	$bstcat2=0;
	$frecat2=0;
	$compcat2=0;
	$homecat2=0;
	$cat2 = "SELECT * FROM markscats where form='$form' and term='$term' 
	and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	
	$cat2per = 100;
	$engcat2=($row3['english']/$cat2standard)*$cat2per;
	$kiscat2=($row3['kiswahili']/$cat2standard)*$cat2per;
	$mathcat2=($row3['math']/$cat2standard)*$cat2per;
	$biocat2=($row3['biology']/$cat2standard)*$cat2per;
	$chemcat2=($row3['chemistry']/$cat2standard)*$cat2per;
	$phycat2=($row3['physics']/$cat2standard)*$cat2per;
	$hiscat2=($row3['history']/$cat2standard)*$cat2per;
	$geocat2=($row3['geography']/$cat2standard)*$cat2per;
	$crecat2=($row3['cre']/$cat2standard)*$cat2per;
	$agrcat2=($row3['agriculture']/$cat2standard)*$cat2per;
	$bstcat2=($row3['bstudies']/$cat2standard)*$cat2per;
	$frecat2=($row3['french']/$cat2standard)*$cat2per;
	$compcat2=($row3['computer']/$cat2standard)*$cat2per;
	$homecat2=($row3['home']/$cat2standard)*$cat2per;
	
	}
	
	if($biocat2==0){
	$biocat2="-";
		}else{
	  $biocat2=$biocat2;
	 }
	 if($chemcat2==0){
	$chemcat2="-";
		}else{
	  $chemcat2=$chemcat2;
	 }
	 if($phycat2==0){
	$phycat2="-";
		}else{
	  $phycat2=$phycat2;
	 }
	 if($hiscat2==0){
	$hiscat2="-";
		}else{
	  $hiscat2=$hiscat2;
	 }
	if($geocat2==0){
	$geocat2="-";
		}else{
	  $geocat2=$geocat2;
	 }
	 if($crecat2==0){
	$crecat2="-";
		}else{
	  $crecat2=$crecat2;
	 } 
	 if($homecat2==0){
	$homecat2="-";
		}else{
	  $homecat2=$homecat2;
	 }
	  if($agrcat2==0){
	$agrcat2="-";
		}else{
	  $agrcat2=$agrcat2;
	 }
	 if($compcat2==0){
	$compcat2="-";
		}else{
	  $compcat2=$compcat2;
	 }
	  if($frecat2==0){
	$frecat2="-";
		}else{
	  $frecat2=$frecat2;
	 }
	  if($bstcat2==0){
	$bstcat2="-";
		}else{
	  $bstcat2=$bstcat2;
	 }
	
	//************************************************END OF CAT MARKS QURY***********************************************************************************
	
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
	
	$studentPosClass =0;
	$getPositionClass = mysql_query("Select * from mockpositions where admno='$admno' and form='$form' and stream='$strm' and term='$term' and year='$year'");
	while ($rowPosc = mysql_fetch_array($getPositionClass)) {
	$studentPosClass=$rowPosc['positionclass'];
	}
	
	$totalStudentsClass=0;
	$getTotalstudentsClass = mysql_query("select count(adm) as adms from totalygradedmockmarks where term='$term' and year='$year' and form='$form' and classin='$strm'");
	while ($rowstudenc= mysql_fetch_array($getTotalstudentsClass)) {// get admno
	$totalStudentsClass=$rowstudenc['adms'];
	}
	
	
	$nexttermopens="";
	$nxtter=mysql_query("Select  DATE_FORMAT(begins,'%W %D %M %Y') as begins from tbl_terms where term='$nextterm' and year='$nextyear'");
	while ($rownxtop = mysql_fetch_array($nxtter)) {// get net term begins
	$nexttermopens=$rownxtop['begins'];
	}
	
//$image1 = "Image/".$admno.".jpg";
if(!file_exists("Image/".$admno.".jpg"))
  {
  $image1="images/blur.png";
  }
else
  {
 $image1 = "Image/".$admno.".jpg";
  }
  
$logo = "images/logo.jpg";
$pdf=new PDF();
$pdf->AddPage();

$pdf->SetFont('arial', '', 10);
$pdf->Image($image1,170,5,30,30);
$pdf->Image($logo,18,5,32,30);

$pdf->SetFont('times', '', 12);
$pdf->Text(70, 10, $schoolname);
$pdf->Text(75, 15,'P.o.Box  '.$po.',  '.$plac);
$pdf->Text(75, 20,'Telephone:  '.$tele);
$pdf->Text(75, 25,'Date:  '.$date);
$pdf->Text(70, 30, 'Report Form: 		TERM:'.$term.'  Year:  '.$year);
$pdf->SetFont('times', '', 11);
$pdf->Text(45, 35, 'Name: '.$fname.'   '.$mname.'    '.$lasname.'   Adm No:   '.$admno.'  FORM: '.$form.' '.$strm.'  House:'.$house);
$pdf->Line(45, 36, 170, 36);//underline the student names 
$pdf->Text(45, 41, 'KCPE Marks:- '.$kcpe.'  Grade:-   '.$kcpemeangrade.'    KCPE Entry Position:-   '.$kcpepos);

$pdf->Rect(15, 42, 180, 75);// the rectangle left,top,width, height

$pdf->SetFont('times', '', 9);
$pdf->Line(45, 42, 45, 117);//create next collumn
$pdf->Text(47, 46, 'WAT1');
$pdf->SetFont('times', '', 11);
$pdf->Text(47, 51, $engcat1);
$pdf->Text(47, 56, $kiscat1);
$pdf->Text(47, 61, $mathcat1);
$pdf->Text(47, 66, $biocat1);
$pdf->Text(47, 76, $chemcat1);
$pdf->Text(47, 71, $phycat1);
$pdf->Text(47, 81, $hiscat1);
$pdf->Text(47, 86, $geocat1);
$pdf->Text(47, 91, $crecat1);
$pdf->Text(47, 96, $homecat1);
$pdf->Text(47, 101, $agrcat1);
$pdf->Text(47, 106, $compcat1);
$pdf->Text(47, 111, $frecat1);
$pdf->Text(47, 116, $bstcat1);

$pdf->SetFont('times', '', 9);
$pdf->Line(57, 42, 57, 117);//Next Column
$pdf->Text(59, 46, 'WAT2');
$pdf->SetFont('times', '', 11);
$pdf->Text(62, 51, $engcat2);
$pdf->Text(62, 56, $kiscat2);
$pdf->Text(62, 61, $mathcat2);
$pdf->Text(62, 66, $biocat2);
$pdf->Text(62, 71, $phycat2);
$pdf->Text(62, 76, $chemcat2);
$pdf->Text(62, 81, $hiscat2);
$pdf->Text(62, 86, $geocat2);
$pdf->Text(62, 91, $crecat2);
$pdf->Text(62, 96, $homecat2);
$pdf->Text(62, 101, $agrcat2);
$pdf->Text(62, 106, $compcat2);
$pdf->Text(62, 111, $frecat2);
$pdf->Text(62, 116, $bstcat2);

$pdf->SetFont('times', '', 10);
$pdf->Line(69, 42, 69, 117);//Next Column
$pdf->Text(74, 46, 'Pr 1');
$pdf->SetFont('times', '', 11);
$pdf->Text(74, 51, $eng);
$pdf->Text(74, 56, $kis);
$pdf->Text(74, 61, $math);
$pdf->Text(74, 66, $bio);
$pdf->Text(74, 71, $phy);
$pdf->Text(74, 76, $chem);
$pdf->Text(74, 81, $his);
$pdf->Text(74, 86, $geo);
$pdf->Text(74, 91, $cre);
$pdf->Text(74, 96, $home);
$pdf->Text(74, 101, $agr);
$pdf->Text(74, 106, $comp);
$pdf->Text(74, 111, $fre);
$pdf->Text(74, 116, $bst);

$pdf->Line(81, 42, 81, 117);//Next Column
$pdf->SetFont('times', '', 10);
$pdf->Text(82, 46, 'Pr 2');
$pdf->SetFont('times', '', 11);
$pdf->Text(86, 51, $eng2);
$pdf->Text(86, 56, $kis2);
$pdf->Text(86, 61, $math2);
$pdf->Text(86, 66, $bio2);
$pdf->Text(86, 71, $phy2);
$pdf->Text(86, 76, $chem2);
$pdf->Text(86, 81, $his2);
$pdf->Text(86, 86, $geo2);
$pdf->Text(86, 91, $cre2);
$pdf->Text(86, 96, $home2);
$pdf->Text(86, 101, $agr2);
$pdf->Text(86, 106, $comp2);
$pdf->Text(86, 111, $fre2);
$pdf->Text(86, 116, $bst2);

$pdf->SetFont('times', '', 10);
$pdf->Line(93, 42, 93, 117);//Next Column
$pdf->Text(96, 46, 'Pr 3');
$pdf->SetFont('times', '', 11);
$pdf->Text(98, 51, $enge);
$pdf->Text(98, 56, $kise);
$pdf->Text(98, 61, $mathe);
$pdf->Text(98, 66, $bioe);
$pdf->Text(98, 71, $phye);
$pdf->Text(98, 76, $cheme);
$pdf->Text(98, 81, $hise);
$pdf->Text(98, 86, $geoe);
$pdf->Text(98, 91, $cree);
$pdf->Text(98, 96, $homee);
$pdf->Text(98, 101, $agre);
$pdf->Text(98, 106, $compe);
$pdf->Text(98, 111, $free);
$pdf->Text(98, 116, $bste);

$pdf->SetFont('times', '', 10);
$pdf->Line(105, 42, 105, 117);//Next Column
$pdf->Text(108, 46, 'Ttl');
$pdf->SetFont('times', '', 11);
$pdf->Text(110, 51, $engfinal);
$pdf->Text(110, 56, $kisfinal);
$pdf->Text(110, 61, $mathfinal);
$pdf->Text(110, 66, $biofinal);
$pdf->Text(110, 71, $phyfinal);
$pdf->Text(110, 76, $chemfinal);
$pdf->Text(110, 81, $hisfinal);
$pdf->Text(110, 86, $geofinal);
$pdf->Text(110, 91, $crefinal);
$pdf->Text(110, 96, $homefinal);
$pdf->Text(110, 101, $agrfinal);
$pdf->Text(110, 106, $compfinal);
$pdf->Text(110, 111, $frefinal);
$pdf->Text(110, 116, $bstfinal);

$pdf->SetFont('times', '', 10);
$pdf->Line(117, 42, 117, 117);//Next Column																																		`
$pdf->Text(120, 46, 'Grade');
$pdf->SetFont('times', '', 11);
$pdf->Text(122, 51, $enggrade);
$pdf->Text(122, 56, $kisgrade);
$pdf->Text(122, 61, $mathgrade);
$pdf->Text(122, 67, $biograde);
$pdf->Text(122, 71, $phygrade);
$pdf->Text(122, 76, $chemgrade);
$pdf->Text(122, 81, $hisgrade);
$pdf->Text(122, 86, $geograde);
$pdf->Text(122, 91, $cregrade);
$pdf->Text(122, 96, $homegrade);
$pdf->Text(122, 101, $agrgrade);
$pdf->Text(122, 106, $compgrade);
$pdf->Text(122, 111, $fregrade);
$pdf->Text(122, 116, $bstgrade);

$pdf->SetFont('times', '', 10);
$pdf->Line(129, 42, 129, 117);//Next Column	
$pdf->Text(130, 46, 'Sb.Ps');
$pdf->SetFont('times', '', 11);
$pdf->Text(134, 51, $engPos);
$pdf->Text(134, 56, $kisPos);
$pdf->Text(134, 61, $mathPos);
$pdf->Text(134, 66, $bioPos);
$pdf->Text(134, 71, $phyPos);
$pdf->Text(134, 76, $chemPos);
$pdf->Text(134, 81, $hisPos);
$pdf->Text(134, 86, $geoPos);
$pdf->Text(134, 91, $crePos);
$pdf->Text(134, 96, $homePos);
$pdf->Text(134, 101, $agrPos);
$pdf->Text(134, 106, $compPos);
$pdf->Text(134, 111, $frePos);
$pdf->Text(134, 116, $bstPos);

$pdf->SetFont('times', '', 10);
$pdf->Line(141, 42, 141, 117);//Next Column	
$pdf->Text(142, 46, 'Remarks');
$pdf->SetFont('times', '', 11);
$pdf->Text(146, 51, $engremarks);
$pdf->Text(146, 56, $kisremarks);
$pdf->Text(146, 61, $mathremarks);
$pdf->Text(146, 66, $bioremarks);
$pdf->Text(146, 71, $phyremarks);
$pdf->Text(146, 76, $chemremarks);
$pdf->Text(146, 81, $hisremarks);
$pdf->Text(146, 86, $georemarks);
$pdf->Text(146, 91, $creremarks);
$pdf->Text(146, 96, $homeremarks);
$pdf->Text(146, 106, $agrremarks);
$pdf->Text(146, 106, $compremarks);
$pdf->Text(146, 111, $freremarks);
$pdf->Text(146, 116, $bstremarks);

$pdf->SetFont('times', '', 10);
$pdf->Line(141, 42, 141, 117);//Next Column	
$pdf->Text(172, 46, 'Sign');
$pdf->SetFont('times', '', 11);
$pdf->Text(172, 51, $enginitials);
$pdf->Text(172, 56, $kisinitials);
$pdf->Text(172, 61, $mathinitials);
if($biofinal==0){
$pdf->Text(172, 66, "-");
}else{
$pdf->Text(172, 66, $bioinitials);
}
if($phyfinal==0){
$pdf->Text(172, 71, "-");
}else{
$pdf->Text(172, 71, $phyinitials);
}
if($chemfinal==0){
$pdf->Text(172, 76, "-");
}else{
$pdf->Text(172, 76, $cheminitials);
}
if($hisfinal==0){
$pdf->Text(172, 81, "-");
}else{
$pdf->Text(172, 81, $hisinitials);
}
if($geofinal==0){
$pdf->Text(172, 86, "-");
}else{
$pdf->Text(172, 86, $geoinitials);
}
if($crefinal==0){
$pdf->Text(172, 91, "-");
}else{
$pdf->Text(172, 91, $creinitials);
}
if($homefinal==0){
$pdf->Text(172, 96, "-");
}else{
$pdf->Text(172, 96, $homeinitials);
}
if($agrfinal==0){
$pdf->Text(172, 101, "-");
}else{
$pdf->Text(172, 101, $agrinitials);
}
if($compfinal==0){
$pdf->Text(172, 106, "-");
}else{
$pdf->Text(172, 106, $compinitials);
}
if($frefinal==0){
$pdf->Text(172, 111, "-");
}else{
$pdf->Text(172, 111, $freinitials);
}
if($bstfinal==0){
$pdf->Text(172, 116, "-");
}else{
$pdf->Text(172, 116, $bstinitials);
}



$pdf->SetFont('times', '', 10);
$pdf->Line(167, 42, 167, 117);//Next Column	
$pdf->Text(22, 46, 'Subject');
$pdf->SetFont('times', '', 11);
$pdf->Line(15, 47, 195,47);
$pdf->Text(17, 51, '101-English');
$pdf->Line(15, 52, 195, 52);
$pdf->Text(17, 56, '102-Kiswahili');
$pdf->Line(15, 57, 195, 57);
$pdf->Text(17, 61, '121-Maths');
$pdf->Line(15, 62, 195, 62);
$pdf->Text(17, 66, '231-Biology');
$pdf->Line(15, 67, 195, 67);
$pdf->Text(17, 71, '232-Physics');
$pdf->Line(15, 72, 195, 72);
$pdf->Text(17, 76, '233-Chemistry');
$pdf->Line(15, 77, 195, 77);
$pdf->Text(17, 81, '311-History');
$pdf->Line(15, 82, 195,82);
$pdf->Text(17, 86, '312-Geography');
$pdf->Line(15, 87, 195, 87);
$pdf->Text(17, 91, '313-CRE');
$pdf->Line(15, 92, 195, 92);
$pdf->Text(17, 96, '441-H/Science');
$pdf->Line(15, 97, 195, 97);
$pdf->Text(17, 101, '443-Agriculture');
$pdf->Line(15, 102, 195, 102);
$pdf->Text(17, 106, '451-Computer');
$pdf->Line(15, 107, 195, 107);
$pdf->Text(17, 111, '501-French');
$pdf->Line(15, 112, 195, 112);
$pdf->Text(17, 116, '565-B/Studies');
$pdf->Line(15, 117, 195, 117);
$pdf->Text(62, 121, 'TOTALS MARKS');
$pdf->Text(95, 121, $tmarks.'    Out of  :'  .$totalOutOf);
$pdf->SetFont('times', '', 9);
//$pdf->Text(20, 126, 'Mean: 	   '.$meangrade.'         Grade:	 '.$gradepoints.'       Overall Position:	      '.$studentPos .'       Out of:  '.$totalStudents);
//$pdf->Text(62, 130, 'Position in Class:	     '.$studentPosClass.'       Out of:  '.$totalStudentsClass);

$pdf->Text(20, 126, 'Mean: 	   '.$meangrade.'   Total Points  '.$totalpoints.'        Grade:	 '.$gradepoints.'     Overall Position:	      '.$studentPos .'       Out of:  '.$totalStudents);
$pdf->Text(80, 130, 'Position in Class:	     '.$studentPosClass.'       Out of:  '.$totalStudentsClass);

$pdf->SetFont('arial', 'I', 9);
$pdf->SetTextColor(255, 100, 100);
$pdf->Text(70, 135, 'Performance Analysis');
$pdf->Line(20, 200, 20, 140);//y axis
$pdf->Line(18, 200, 100, 200);//x axis


$pdf->Text(14, 135, 'mean');
$pdf->SetFont('times', '', 7);
$pdf->SetTextColor(0,0,0);
//$pdf->SetDrawColor(232,232,232);
$pdf->SetLineWidth(0.2);
$pdf->SetDash(1, 0.5); //1mm on, 0.5mm off
$pdf->SetDrawColor(0, 0, 0, 100);
$pdf->Text(16, 140, '12');
$pdf->Line(18, 140, 98, 140);//y indicator
$pdf->Text(16, 145, '11');
$pdf->Line(18, 145, 98, 145);//y indicator
$pdf->Text(16, 150, '10');
$pdf->Line(18, 150, 98, 150);//y indicator
$pdf->Text(16, 155, '9');
$pdf->Line(18, 155, 98, 155);//y indicator
$pdf->Text(16, 160, '8');
$pdf->Line(18, 160, 98, 160);//y indicator
$pdf->Text(16, 165, '7');
$pdf->Line(18, 165, 98, 165);//y indicator
$pdf->Text(16, 170, '6');
$pdf->Line(18, 170, 98, 170);//y indicator
$pdf->Text(16, 175, '5');
$pdf->Line(18, 175, 98, 175);//y indicator
$pdf->Text(16, 180, '4');
$pdf->Line(18, 180, 98, 180);//y indicator
$pdf->Text(16, 185, '3');
$pdf->Line(18, 185, 98, 185);//y indicator
$pdf->Text(16, 190, '2');
$pdf->Line(18, 190, 98, 190);//y indicator
$pdf->Text(16, 195, '1');
$pdf->Line(18, 195, 98, 195);//y indicator
$pdf->Text(16, 200, '0');
$pdf->SetDash();
$pdf->SetDrawColor(0, 0, 0, 100);
$pdf->SetFillColor(0, 0, 0, 100);//black
$pdf->Rect(21, 200-$graphpoint, 3, $graphpoint, 'DF');//kcpe graph

//Draw the graphs
$pdf->SetFillColor(255, 0, 0);//red
$pdf->Rect(28, 200-$forgraphone, 3, $forgraphone, 'DF');//Form 1 T1 graph
$pdf->SetFillColor(0, 0, 255);//blue
$pdf->Rect(33, 200-$forgraphone2, 3, $forgraphone2, 'DF');//Form 1 T1 graph
$pdf->SetFillColor(0, 255, 0);//green
$pdf->Rect(38, 200-$forgraphone3, 3, $forgraphone3, 'DF');//Form 1 T1 graph

$pdf->SetFillColor(255, 0, 0);//red
$pdf->Rect(48, 200-$forgraph, 3, $forgraph, 'DF');//Form 2 T1 graph
$pdf->SetFillColor(0, 0, 255);//blue
$pdf->Rect(53, 200-$for2graph, 3, $for2graph, 'DF');//Form 2 T2 graph
$pdf->SetFillColor(0, 255, 0);//green
$pdf->Rect(58, 200-$for23graph, 3, $for23graph, 'DF');//Form 2 T3 graph

$pdf->SetFillColor(255, 0, 0);//red
$pdf->Rect(67, 200-$for3graph, 3, $for3graph, 'DF');//Form 3 T1 graph
$pdf->SetFillColor(0, 0, 255);//blue
$pdf->Rect(72, 200-$for32graph, 3, $for32graph, 'DF');//Form 3 T2 graph
$pdf->SetFillColor(0, 255, 0);//green
$pdf->Rect(77, 200-$for33graph, 3, $for33graph, 'DF');//Form 3 T3 graph

$pdf->SetFillColor(0, 0, 255);//blue
$pdf->Rect(87, 200-$for4graph, 3, $for4graph, 'DF');//Form 1 T1 graph
$pdf->SetFillColor(0, 255, 0);//green
$pdf->Rect(92, 200-$for42graph, 3, $for42graph, 'DF');//Form 1 T1 graph



$pdf->Text(103, 147, 'V.A.P=Value Added Progress             V.A.P= (Current Mean Grade - KCPE Mean Grade)');

$pdf->SetFont('times', '', 7);
$pdf->Rect(100, 150, 100, 25);// the left rectangle
$pdf->Line(100, 155, 200, 155);//x dividers
$pdf->Text(103, 159, 'Mean');
$pdf->Text(120, 153, 'Form 1');
$pdf->Text(140, 153, 'Form 2');
$pdf->Text(163, 153, 'Form 3');
$pdf->Text(185, 153, 'Form 4');

$pdf->SetFont('arial', '', 6);
$pdf->Text(113, 159, $formonemean);
$pdf->Text(120, 159, $formone2mean);
$pdf->Text(127, 159, $formone3mean);
$pdf->Text(135, 159, $formtwomean);
$pdf->Text(142, 159, $formtwo2mean);
$pdf->Text(149, 159, $formtwo3mean);
$pdf->Text(158, 159, $forms3mean);
$pdf->Text(165, 159, $forms32mean);
$pdf->Text(172, 159, $forms33mean);
$pdf->Text(181, 159, $forms4mean);
$pdf->Text(190, 159, $forms42mean);
$pdf->Line(100, 160, 200, 160);//x end of mean column dividers

$pdf->SetFont('arial', '', 6);
$pdf->Text(103, 164, 'VAP');
$pdf->Text(113, 164, $term1vap);
$pdf->Text(120, 164, $term2vap);
$pdf->Text(127, 164, $term3vap);
$pdf->Text(135, 164, $term12vap);
$pdf->Text(142, 164, $term22vap);
$pdf->Text(149, 164, $term32vap);
$pdf->Text(158, 164, $term13vap);
$pdf->Text(165, 164, $term23vap);
$pdf->Text(172, 164, $term33vap);
$pdf->Text(181, 164, $term14vap);
$pdf->Text(190, 164, $term24vap);
$pdf->Line(100, 165, 200, 165);//x end of position dividers

$pdf->SetFont('times', '', 7);
$pdf->Text(103, 169, 'Pos.');
$pdf->Text(113, 169, $term1posi);
$pdf->Text(120, 169, $term2posi);
$pdf->Text(127, 169, $term3posi);
$pdf->Text(135, 169, $term12posi);
$pdf->Text(142, 169, $term22posi);
$pdf->Text(149, 169, $term32posi);
$pdf->Text(158, 169, $term13posi);
$pdf->Text(165, 169, $term23posi);
$pdf->Text(172, 169, $term33posi);
$pdf->Text(181, 169, $term14posi);
$pdf->Text(190, 169, $term24posi);
$pdf->Line(100, 170, 200, 170);//x end of position dividers


$pdf->Text(101, 174, 'Out Of');
$pdf->Text(113, 174, $term1outof);
$pdf->Text(120, 174, $term2outof);
$pdf->Text(127, 174, $term3outof);
$pdf->Text(135, 174, $term12outof);
$pdf->Text(142, 174, $term22outof);
$pdf->Text(149, 174, $term32outof);
$pdf->Text(158, 174, $term13outof);
$pdf->Text(165, 174, $term23outof);
$pdf->Text(172, 174, $term33outof);
$pdf->Text(181, 174, $term14outof);
$pdf->Text(190, 174, $term24outof);

$pdf->Line(112, 150, 112, 175);//y divider
$pdf->Line(134, 150, 134, 175);//y divider
$pdf->Line(157, 150, 157, 175);//y divider
$pdf->Line(180, 150, 180, 175);//y divider


$pdf->Text(125, 200, 'Official School Stamp _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _');



$pdf->SetFont('arial', '', 7);
$pdf->Text(23, 207, 'KCPE');
$pdf->Text(28, 203, 'T1');
$pdf->Text(33, 203, 'T2');
$pdf->Text(38, 203, 'T3');
$pdf->Text(35, 207, 'Form 1');
$pdf->Text(48, 203, 'T1');
$pdf->Text(53, 203, 'T2');
$pdf->Text(58, 203, 'T3');
$pdf->Text(53, 207, 'Form 2');
$pdf->Text(67, 203, 'T1');
$pdf->Text(72, 203, 'T2');
$pdf->Text(77, 203, 'T3');
$pdf->Text(73, 207, 'Form 3');
$pdf->Text(87, 203, 'T1');
$pdf->Text(92, 203, 'T2');
$pdf->Text(88, 207, 'Form 4');

$pdf->SetFont('times', 'b', 9);

$pdf->Rect(20, 215, 180, 8);// the left rectangle
$pdf->Text(23, 220, 'Fee Arrears Ksh:                '.$feesbal);
$pdf->Text(80, 220, 'Next Terms Fee Ksh:             '.$nextterm);
$pdf->Text(150, 220, 'Total Fee Ksh:                 '.$tobepaid);
$pdf->SetFont('times', '', 9);
$pdf->Text(23, 230, 'Class Teacher Comments ___________________________________________________________________________________');
$pdf->Text(23, 237, 'Date __________________________________ Signature __________________________________');
$pdf->Text(23, 244, 'Head Teacher/Deputy  Comment ________________________________________________________________________');
$pdf->Text(23, 251, '______________________________________________________________________________________________________');
$pdf->Text(23, 258, 'Date __________________________________ Signature __________________________________');
$pdf->Text(23, 265, 'Report Seen By Parent/Guardian Sign _______________________________ 	Date____________________________');
$pdf->Text(23, 271, 'Next Term Begins On: __________________________________');
$pdf->SetFont('times', 'BU', 9);
$pdf->Text(60, 264, $nexttermopens);
$pdf->SetFont('times', '', 6);
$pdf->Text(130,290,'Generated using Chrimoska LTD School Management System on '. $date,0,0,'R');
$pdf->Output();

}
?>
