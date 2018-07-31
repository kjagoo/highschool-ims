<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/Grading.php';
	
// require_once("inc/db_Connector.php");  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>


<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );

function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}
function download(){
	window.location='licenses.xls';
}

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getLicenseDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}


 
</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <div class="clear"></div>
    <!--*********************************************************************************-->
    <!-----************************************************************************************-->
    <?php
/*if(isset($_GET['id'])){
$form=$_GET['id'];
$term=$_GET['trm'];
$year=$_GET['yr'];
$strm=$_GET['strm'];
}else{
*/
$mode=$_GET['amode'];
$form=$_GET['form'];
$term=$_GET['term'];
$year=$_GET['year'];
$strm=$_GET['stream'];
//}

$myformis=$form;


include('includes/dbconnector.php');

if($form==1){
$myform='Form 1';
$subjectsDone=11;
}
if($form==2){
$myform='Form 2';
$subjectsDone=11;
}
if($form==3){
$myform='Form 3';
$subjectsDone=8;
}
if($form==4){
$myform='Form 4';
$subjectsDone=8;
}


  function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}

// run the query and store the results in the $result variable.
$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
}
$date=date("j, F, Y");

$positionby="averagepoints";
$alternatepositionby="average";

	$amode=$_GET['gradeby'];
	
	if($_GET['gradeby']=="marks"){
		$positionby="average";
		$alternatepositionby="averagepoints";
	}
	if($_GET['gradeby']=="points"){
		$positionby="averagepoints";
		$alternatepositionby="average";
	}

	$getstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
	while ($rowsrd = mysql_fetch_array($getstandard)) {
	$examstandard=$rowsrd['exam'];
	$cat1standard=$rowsrd['cat1'];
	$cat2standard=$rowsrd['cat2'];
	$cat1per=$rowsrd['cat1percent'];
	$cat2per=$rowsrd['cat2percent'];
	$examper=$rowsrd['exampercent'];
	}
	
	
	
//if ($result) {
  // create a new form and then put the results
  // in to a table.
  ?>
    <div class="clear"></div>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">General Report Forms Generation:- Form <?php echo $form." ". $strm?>  - Term <?php echo $term?> - Year <?php echo $year?>
		
          <div style="float:right; margin-right:20px;"><?php echo '<a href="multiple.php?id='.$form.'&term='.$term.'&yr='.$year.'&classin='.$strm.'&amode='.$amode.'"><i class="icon icon-green icon-print"></i>Print All</a>'?></div>
		   <div style="float:right; margin-right:20px;"><?php echo '<a href="send_sms_Reports.php?id='.$form.'&term='.$term.'&yr='.$year.'&classin='.$strm.'&amode='.$amode.'"><i class="icon icon-green icon-mail-closed"></i>SMS All</a>'?></div>
		   </td>
      </tr>
      <tr>
        <td>
		<form action="removeselected_fromreport_g.php" method="post">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
			  <th></th>
			  	<th>Admno</th>
                <th>Student Name</th>
                <th align='center'>Eng</th>
                <th align='center'>Kisw</th>
                <th align='center'>Maths</th>
                <th align='center'>Bio</th>
                <th align='center'>Phy</th>
                <th align='center'>Chem</th>
                <th align='center'>His</th>
                <th align='center'>Geo</th>
                <th align='center'>Cre</th>
                <th align='center'>Agr</th>
                <th align='center'>B/st</th>
				<th align="center">Fre</th>
				<th align="center">Comp</th>
				<th align="center">H/Sci</th>
                <th align='center'>Ttl</th>
				<th align='center'>Grd</th>
				<th align='center'>Pos</th>
				<th colspan="2"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
	include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$strm,$year,"Exam");
	
	$num=0;
	$cat1 = "SELECT distinct(admno) FROM tbleperformancetrack where form='$form' and year='$year' and term='$term' and s_status='0' ";//admno query
	$result = mysql_query($cat1);
	if(!$result){
	die('tbl performancetrack: Invalid query: ' . mysql_error());
	}
	while ($row = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$row['admno'];
	
	
	$getnames = "SELECT * from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	if(!$result3){
	die('students query: Invalid query: ' . mysql_error());
	}
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$strmis=$row2['class'];
	$kcpema=$row2['marks'];
	$kcpegrad=$row2['grade'];
	
	//}

	$getsubsdone = "SELECT * from subjectsforstudent where admno='$admno' and year='$year' and term='$term'";// get names
	$Subjectsresult = mysql_query($getsubsdone);
	if(!$Subjectsresult){
	die('Subjects query: Invalid query: ' . mysql_error());
	}
	while ($rowsub = mysql_fetch_array($Subjectsresult)) {// get names
	$subjectsDone=$rowsub['subjects'];	
	}
	
	
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
	$fre=0;
	$comp=0;
	$home=0;
	$catis = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='1' and admno='$admno'";
	$result0 = mysql_query($catis);
	if(!$result0){
	die('Cat 1 Marks query: Invalid query: ' . mysql_error());
	}
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=($row0['english']/$cat1standard)*$cat1per;
	$kis=($row0['kiswahili']/$cat1standard)*$cat1per;
	$math=($row0['math']/$cat1standard)*$cat1per;
	$bio=($row0['biology']/$cat1standard)*$cat1per;
	$chem=($row0['chemistry']/$cat1standard)*$cat1per;
	$phy=($row0['physics']/$cat1standard)*$cat1per;
	$his=($row0['history']/$cat1standard)*$cat1per;
	$geo=($row0['geography']/$cat1standard)*$cat1per;
	$cre=($row0['cre']/$cat1standard)*$cat1per;
	$agr=($row0['agriculture']/$cat1standard)*$cat1per;
	$bst=($row0['bstudies']/$cat1standard)*$cat1per;
	$fre=($row0['french']/$cat1standard)*$cat1per;
	$comp=($row0['computer']/$cat1standard)*$cat1per;
	$home=($row0['home']/$cat1standard)*$cat1per;
	}
	
	$kis2=0;
	$eng2=0;
	$math2=0;
	$bio2=0;
	$chem2=0;
	$phy2=0;
	$his2=0;
	$geo2=0;
	$cre2=0;
	$agr2=0;
	$bst2=0;
	$fre2=0;
	$comp2=0;
	$home2=0;
	$cat2 = "SELECT * FROM markscats where form='$form' and term='$term' 
	and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	if(!$result2){
	die('Cat2 Marks query: Invalid query: ' . mysql_error());
	}
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	
	$eng2=($row3['english']/$cat2standard)*$cat2per;
	$kis2=($row3['kiswahili']/$cat2standard)*$cat2per;
	$math2=($row3['math']/$cat2standard)*$cat2per;
	$bio2=($row3['biology']/$cat2standard)*$cat2per;
	$chem2=($row3['chemistry']/$cat2standard)*$cat2per;
	$phy2=($row3['physics']/$cat2standard)*$cat2per;
	$his2=($row3['history']/$cat2standard)*$cat2per;
	$geo2=($row3['geography']/$cat2standard)*$cat2per;
	$cre2=($row3['cre']/$cat2standard)*$cat2per;
	$agr2=($row3['agriculture']/$cat2standard)*$cat2per;
	$bst2=($row3['bstudies']/$cat2standard)*$cat2per;
	$fre2=($row3['french']/$cat2standard)*$cat2per;
	$comp2=($row3['computer']/$cat2standard)*$cat2per;
	$home2=($row3['home']/$cat2standard)*$cat2per;
	
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
	$free=0;
	$compe=0;
	$homee=0;
	$exam = "SELECT * FROM marksemams where form='$form' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = mysql_query($exam);
	if(!$result4){
	die('Exam Marks query: Invalid query: ' . mysql_error());
	}
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	//$exams=$row4[$subje];
	$enge=($row4['english']/$examstandard)*$examper;
	$kise=($row4['kiswahili']/$examstandard)*$examper;
	$mathe=($row4['math']/$examstandard)*$examper;
	$bioe=($row4['biology']/$examstandard)*$examper;
	$cheme=($row4['chemistry']/$examstandard)*$examper;
	$phye=($row4['physics']/$examstandard)*$examper;
	$hise=($row4['history']/$examstandard)*$examper;
	$geoe=($row4['geography']/$examstandard)*$examper;
	$cree=($row4['cre']/$examstandard)*$examper;
	$agre=($row4['agriculture']/$examstandard)*$examper;
	$bste=($row4['bstudies']/$examstandard)*$examper;
	$free=($row4['french']/$examstandard)*$examper;
	$compe=($row4['computer']/$examstandard)*$examper;
	$homee=($row4['home']/$examstandard)*$examper;
	}
	//$standard=170;
	//$getstandard = mysql_query("select * from standards ");
	//while ($rowsrd = mysql_fetch_array($getstandard)) {
	//$standard=$rowsrd['total'];
	//}
	

	$eng=round((($eng+$eng2))+$enge);
	$kis=round((($kis+$kis2))+$kise);
	$math=round((($math+$math2))+$mathe);
	$bio=round((($bio+$bio2))+$bioe);
	$chem=round((($chem+$chem2))+$cheme);
	$phy=round((($phy+$phy2))+$phye);
	$his=round((($his+$his2))+$hise);
	$geo=round((($geo+$geo2))+$geoe);
	$cre=round((($cre+$cre2))+$cree);
	$agr=round((($agr+$agr2))+$agre);
	$bst=round((($bst+$bst2))+$bste);
	$fre=round((($fre+$fre2))+$free);
	$comp=round((($comp+$comp2))+$compe);
	$home=round((($home+$home2))+$homee);
	
	$kcpemean=round($kcpema/5);
	
	
	if($mode=='custom'){
	
	$totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$fre+$comp+$home;
	$average=round_up ( $totals/$subjectsDone, 3 ); // float(499.945) 
	}else{
	$numbers1=array($bio,$chem,$phy);//get two sciences
	rsort($numbers1);
	
	//$numbers2=array($his,$geo,$cre); // get one humanity
	//rsort($numbers2);
	
	$numbers3=array($agr,$bst,$fre,$comp,$home,$numbers1[2],$his,$geo,$cre);//get one from either
	rsort($numbers3);

	$totals=$eng+$kis+$math+$numbers1[0]+$numbers1[1]+$numbers3[0]+$numbers3[1];
	$average=round_up ( $totals/7, 3 ); // float(499.945) 	
	}
	
	
	
	$grading = new Grading();
	$bstpoint=0;
	if($form==1 || $form==2){
	$myf="1-2";
	}else{
	$myf="3-4";
	}
	$engdetails=$grading->getSubjectGrade('ENGLISH',$eng,$myf);
	$enggrade=$engdetails['grade'];
	$epoint=$engdetails['point'];
	$engremarks=$engdetails['remark'];
	
	$kisdetails=$grading->getSubjectGrade('KISWAHILI',$kis,$myf);
	$kiswahiligrade=$kisdetails['grade'];
	$kipoint=$kisdetails['point'];
	$kisremarks=$kisdetails['remark'];
	
	$mathdetails=$grading->getSciencesGrade('MATHS',$math,$myf);
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	$mathremarks=$mathdetails['remark'];
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',$bio,$myf);
	if($bio==0){
	$biograde="-";
	$biopoint=0;
	$bioremarks="-";
	}else{
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	$bioremarks=$biodetails['remark'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',$chem,$myf);
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	$chemremarks="-";
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	$chemremarks=$chemdetails['remark'];
	}
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',$phy,$myf);
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	$phyremarks="-";
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	$phyremarks=$phydetails['remark'];
	}
	
	$hisdetails=$grading->getSubjectGrade('HISTORY',$his,$myf);
	if($his==0){
	$hisgrade="-";
	$hispoint=0;
	$hisremarks="-";
	}else{
	$hisgrade=$hisdetails['grade'];
	$hispoint=$hisdetails['point'];
	$hisremarks=$hisdetails['remark'];
	}
	
	$geodetails=$grading->getSubjectGrade('GEOGRAPHY',$geo,$myf);
	if($geo==0){
	$geograde="-";
	$geopoint=0;
	$georemarks="-";
	}else{
	$geograde=$geodetails['grade'];
	$geopoint=$geodetails['point'];
	$georemarks=$geodetails['remark'];
	}
	
	$credetails=$grading->getSubjectGrade('CRE',$cre,$myf);
	if($cre==0){
	$cregrade="-";
	$crepoint=0;
	$creremarks="-";
	}else{
	$cregrade=$credetails['grade'];
	$crepoint=$credetails['point'];
	$creremarks=$credetails['remark'];
	}
	$agrdetails=$grading->getSubjectGrade('AGRICULTURE',$agr,$myf);
	
	if($agr==0){
	$agrgrade="-";
	$agrpoint=0;
	$agrremarks="-";
	}else{
	$agrgrade=$agrdetails['grade'];
	$agrpoint=$agrdetails['point'];
	$agrremarks=$agrdetails['remark'];
	}
	
	$bstdetails=$grading->getSubjectGrade('B/STUDIES',$bst,$myf);
	
	if($bst==0){
	$bstgrade="-";
	$bstpoint=0;
	$bstremarks="-";
	}else{
	$bstgrade=$bstdetails['grade'];
	$bstpoint=$bstdetails['point'];
	$bstremarks=$bstdetails['remark'];
	}
	
	$fredetails=$grading->getSubjectGrade('FRENCH',(($fre)),$myf);
	if($fre==0){
	$fregrade="-";
	$frepoint=0;
	$freremarks="-";
	}else{
	$fregrade=$fredetails['grade'];
	$frepoint=$fredetails['point'];
	$freremarks=$fredetails['remark'];
	}
	
	$compdetails=$grading->getSubjectGrade('COMPUTER',(($comp)),$myf);
	if($comp==0){
	$compgrade="-";
	$comppoint=0;
	$compremarks="-";
	}else{
	$compgrade=$compdetails['grade'];
	$comppoint=$compdetails['point'];
	$compremarks=$compdetails['remark'];
	}
	
	$homedetails=$grading->getSubjectGrade('HOME',(($home)),$myf);
	if($home==0){
	$homegrade="-";
	$homepoint=0;
	$homeremarks="-";
	}else{
	$homegrade=$homedetails['grade'];
	$homepoint=$homedetails['point'];
	$homeremarks=$homedetails['remark'];
	}
	
		
		if($mode=='custom'){
	
		$totalpoints=$epoint+$kipoint+$mathpoint+$biopoint+$chempoint+$phypoint+$hispoint+$geopoint+$crepoint+$agrpoint+$bstpoint+$frepoint+$comppoint+$homepoint;	
		
		//echo $admno."--:".$totalpoints."<br/>";	
		$averagepoints=round_up ( $totalpoints/$subjectsDone, 3 ); 
	}else{
		$points1=array($biopoint,$chempoint,$phypoint);//get two sciences
		rsort($points1);
	
		//$points2=array($hispoint,$geopoint,$crepoint);//get one humanity
		//rsort($points2);
		
		$points3=array($agrpoint,$bstpoint,$frepoint,$comppoint,$homepoint,$points1[2],$hispoint,$geopoint,$crepoint);
		rsort($points3);
		
	$totalpoints=$epoint+$kipoint+$mathpoint+$points1[0]+$points1[1]+$points3[0]+$points3[1];
	$averagepoints=round_up ( $totalpoints/7, 3 ); // float(499.945) 	
	}
	
		
		
		
		//echo $averagepoints.'<br/>';
		//$tfgrade = "-";
		
		if ($averagepoints > 0.00 && $averagepoints <= 1.499) {
			$tfgrade = "E";
			$htremarks="Work harder";
		} else if ($averagepoints >= 1.50 && $averagepoints <= 2.499) {
			$tfgrade = "D-";
			$htremarks="Improve";
		} else if ($averagepoints >= 2.50 && $averagepoints <= 3.499) {
			$tfgrade = "D";
			$htremarks="Improve";
		} else if ($averagepoints >= 3.50 && $averagepoints <= 4.499) {
			$tfgrade = "D+";
			$htremarks="Can do better";
		} else if ($averagepoints >= 4.50 && $averagepoints <= 5.499) {
			$tfgrade = "C-";
			$htremarks="Fair";
		} else if ($averagepoints >= 5.50 && $averagepoints <= 6.499) {
			$tfgrade = "C";
			$htremarks="Fair";
		} else if ($averagepoints >= 6.50 && $averagepoints <= 7.499) {
			$tfgrade = "C+";
			$htremarks="Fair";
		} else if ($averagepoints >= 7.50 && $averagepoints <= 8.499) {
			$tfgrade = "B-";
			$htremarks="Good";
		} else if ($averagepoints >= 8.50 && $averagepoints <= 9.499) {
			$tfgrade = "B";
			$htremarks="Good";
		} else if ($averagepoints >= 9.50 && $averagepoints <= 10.499) {
			$tfgrade = "B+";
			$htremarks="Good";
		} else if ($averagepoints >= 10.50 && $averagepoints <= 11.499) {
			$tfgrade = "A-";
			$htremarks="V. Good";
		} else if ($averagepoints >= 11.50 && $averagepoints <= 12.00) {
			$tfgrade = "A";
			$htremarks="Excellent";
		}else if ($averagepoints == 0.00) {
			$tfgrade = "E";
			
		}
		
		
	$insert="insert into totalygradedmarks (marks,grade,adm,names
	,english,englishgrade,engremarks,kiswahili,kiswahiligrade
	,kisremarks,mathematics,mathimaticsgrade,mathremarks
	,biology,biologygrade,bioremarks,chemistry,chemistrygrade,chemremarks
	,physics,physicsgrade,phyremarks,history,historygrade,hisremarks
	,geography,geographygrade,georemarks,cre,cregrade,creremarks,agriculture,agriculturegrade,agrremarks
	,businesStudies,businesStudiesgrade,bstremarks,french,frenchgrade,frenchremarks,computer,computergrade,computerremarks,home,homegrade,homeremarks
	,points,tgrade,totalmarks,average,averagepoints,htremarks
	,term,year,form,classin)
	
		values('$kcpema','$kcpegrad','$admno','$fname $mname $lasname'
	,'$eng','$enggrade','$engremarks','$kis','$kiswahiligrade'
	,'$kisremarks','$math','$mathgrade','$mathremarks'
	,'$bio','$biograde','$bioremarks','$chem','$chemgrade','$chemremarks',
	'$phy','$phygrade','$phyremarks','$his','$hisgrade','$hisremarks'
	,'$geo','$geograde','$georemarks','$cre','$cregrade','$creremarks','$agr','$agrgrade','$agrremarks'
	,'$bst','$bstgrade','$bstremarks','$fre','$fregrade','$freremarks','$comp','$compgrade','$compremarks','$home','$homegrade','$homeremarks'
	,'$totalpoints','$tfgrade','$totals','$average','$averagepoints','$htremarks'
	,'$term','$year','$form','$strmis')
			
		on duplicate key update marks='$kcpema', english='$eng', englishgrade='$enggrade', engremarks='$engremarks', kiswahili='$kis', kiswahiligrade='$kiswahiligrade', kisremarks='$kisremarks', mathematics='$math', mathimaticsgrade='$mathgrade', mathremarks='$mathremarks', biology='$bio', biologygrade='$biograde', bioremarks='$bioremarks', chemistry='$chem', chemistrygrade='$chemgrade',chemremarks='$chemremarks', physics='$phy', physicsgrade='$phygrade',phyremarks='$phyremarks', history='$his', historygrade='$hisgrade',hisremarks='$hisremarks', geography='$geo', geographygrade='$geograde',georemarks='$georemarks', cre='$cre', cregrade='$cregrade',creremarks='$creremarks',agriculture='$agr', agriculturegrade='$agrgrade',agrremarks='$agrremarks', businesStudies='$bst', businesStudiesgrade='$bstgrade',bstremarks='$bstremarks',french='$fre', frenchgrade='$fregrade',frenchremarks='$freremarks',computer='$comp',computergrade='$compgrade',computerremarks='$compremarks',home='$home',homegrade='$homegrade',homeremarks='$homeremarks',points='$totalpoints',tgrade='$tfgrade',totalmarks='$totals', average='$average',averagepoints='$averagepoints', htremarks='$htremarks'";
		
		$querynow=mysql_query($insert);
	if(!$querynow){
	echo"failed". mysql_error();
	}
}
}


	/*********************************************************************/ 
	$posq="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmarks` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmarks` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";
	$details=mysql_query($posq);	
	$num=0;
	
	
	while ($row = mysql_fetch_array($details)) {
	$adm=$row['adm'];
	$classin=$row['classin'];
	$num=$row['ROWNUM'];

		$insert="insert into positions(admno,position,form,stream,term,year)
		values('$adm','$num','$form','$classin','$term','$year')
		 on duplicate key update position='$num'";
		$querynow=mysql_query($insert);
		if(!$querynow){
		echo"failed". mysql_error();
		}
}

$posq2="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmarks` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.classin='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmarks` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year' and t2.classin='$strm' 
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";
	$details2=mysql_query($posq2);	
	$num2=0;
	
	
	while ($row2 = mysql_fetch_array($details2)) {
	$adm2=$row2['adm'];
	$classin=$row['classin'];
	$num2=$row2['ROWNUM'];

		$insert2="insert into positions(admno,positionclass,form,stream,term,year)
		values('$adm2','$num2','$form','$classin','$term','$year')
		 on duplicate key update positionclass='$num2'";
		$querynow2=mysql_query($insert2);
		if(!$querynow2){
		echo"failed". mysql_error();
		}
}




/**line 652 english******************************************************************/
	//GRADE ENGLISH
	
	$grading->getSubjectPosition("english",$form,$term,$year);
	//GRADE KISWAHILI
	$grading->getSubjectPosition("kiswahili",$form,$term,$year);
	//GRADE MATHEMATICS
	$grading->getSubjectPosition("mathematics",$form,$term,$year);
	//GRADE BIOLOGY
	$grading->getSubjectPosition("biology",$form,$term,$year);
	//GRADE CHEMISTRY
	$grading->getSubjectPosition("chemistry",$form,$term,$year);
	//PHYSICS
	$grading->getSubjectPosition("physics",$form,$term,$year);
	//GRADE HISTORY
	$grading->getSubjectPosition("history",$form,$term,$year);
	//geography
	$grading->getSubjectPosition("geography",$form,$term,$year);
	//cre
	$grading->getSubjectPosition("cre",$form,$term,$year);
	//agriculture
	$grading->getSubjectPosition("agriculture",$form,$term,$year);
	//BUSINESS STUDIES
	$grading->getSubjectPosition("businesStudies",$form,$term,$year);
	//HOME
	$grading->getSubjectPosition("home",$form,$term,$year);
	//COMPUTER
	$grading->getSubjectPosition("computer",$form,$term,$year);
	//FRENCH
	$grading->getSubjectPosition("french",$form,$term,$year);
/********************************************************************/

$kcpepo=0;
	$kcpepos=mysql_query("SELECT admno,class,marks FROM studentdetails where form='$myform' order by marks desc");
	while ($rowbs = mysql_fetch_array($kcpepos)) {
	$admkcpe=$rowbs['admno'];
	$class=$rowbs['class'];
	$kcpepo++;
		
	$inserte="insert into positions(admno,kcpe,form,stream,term,year)
		values('$admkcpe','$kcpepo','$form','$class','$term','$year') on duplicate key update kcpe='$kcpepo'";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
	//mysql_query("update positions set kcpe='$kcpepo' where admno='$admkcpe' and form='$form' and stream='$strm' and term='$term' and year='$year' ");
		echo"failed". mysql_error();
		}
	}
	
/*******************************************************************/

$num=0;
	
	//$myqueryis="select * from totalygradedmarks where  term='$term' and year='$year' and classin='$strm' and form='$form' order by $positionby desc, $alternatepositionby desc";
	$myqueryis= "select t.*,p.position from totalygradedmarks t join positions p on t.adm = p.admno 
	and t.term ='$term' and t.year= '$year' and t.classin='$strm' and t.form='$form'  and p.term ='$term' and p.year= '$year' and p.stream='$strm' and p.form='$form'
order by p.position asc";
	 
	 
	 
	$toexecute=mysql_query($myqueryis);
	while ($rowr = mysql_fetch_array($toexecute)) {
	
	$num++;
	$ads=$rowr['adm'];
	$nameis=$rowr['names'];
	$engfi=$rowr['english'];
	$kisfi=$rowr['kiswahili'];
	$mathfi=$rowr['mathematics'];
	$biofi=$rowr['biology'];
	$chemfi=$rowr['chemistry'];
	$phyfi=$rowr['physics'];
	$hisfi=$rowr['history'];
	$geofi=$rowr['geography'];
	$crefi=$rowr['cre'];
	$agrfi=$rowr['agriculture'];
	$bstfi=$rowr['businesStudies'];
	$frefi=$rowr['french'];
	$compfi=$rowr['computer'];
	$homefi=$rowr['home'];
	$totalmarks=$rowr['totalmarks'];
	$tgrade=$rowr['tgrade'];
	$posi=$rowr['position'];
	
?>
	  <tr>
	  <td><input type="checkbox"  name="checkbox[]" value="<?php echo $ads?>"></td>
	  <td><span id=reportText><?php echo $ads?></span></td>
		<td><span id=reportText><?php echo $nameis?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $engfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $kisfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $mathfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $biofi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $phyfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $chemfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $hisfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $geofi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $crefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $agrfi?></span></td>
	  	<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $bstfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $frefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $compfi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><?php echo $homefi?></span></td>
		<td align="right" bgcolor="#E1FFFF"><span id=reportText><font color="#FF0000"><?php echo $totalmarks?></font></span></td>
		<td align="left" bgcolor="#E1FFFF"><span id=reportText><font color="#FF0000"><?php echo $tgrade?></font></span></td>
		<td align="left" bgcolor="#E1FFFF"><span id=reportText><font color="#FF0000"><?php echo $posi?></font></span></td>
	  
		<td align="center">
				<a href="my_report_form.php?id=<?php echo $ads?>&forms=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&classin=<?php echo $strm?>" target="-blank"><i class="icon icon-green icon-print"></i></a></td>
		<td align="right">
		<a href="send_sms_single_Reports.php?id=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&adm=<?php echo $ads?>&strm=<?php echo $strm?>&mode=<?php echo $mode?>">
		<i class="icon icon-green icon-envelope-closed"></i> </a></td>
 		
	 </tr>
	
	<?php
	  	 
	}// end of loop for report forms
	
	
?>
          <tr>
<td colspan="5"><input type="submit" name="delete" value="Exclude Selected Students" class="btn" onclick="return confirmdelete();" /></td>
</tr>


            </tbody>
          </table>
		  <input type="hidden" name="yrtodelete" value="<?php echo $year?>" />
		   <input type="hidden" name="termtodelete" value="<?php echo $term?>" />
		    <input type="hidden" name="modetodelete" value="<?php echo $mode?>" />
			 <input type="hidden" name="formtodelete" value="<?php echo $form?>" />
			  <input type="hidden" name="streamtodelete" value="<?php echo $strm?>" />
			   <input type="hidden" name="gradebytodelete" value="<?php echo $amode?>" />
		 </form>
		 </td>
      </tr>
    </table>
    
  </div>
  <!-- end of login form-->
</div>
</div>
<script>

function confirmdelete(){

doIt=confirm('This Student will be Excluded From the Reportforms\n\nDo you wish to Continue?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}

</script>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
