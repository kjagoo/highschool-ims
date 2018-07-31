<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  
 
 
 include 'includes/Grading.php';
 $grading = new Grading();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
</style>
<link href='css/opa-icons.css' rel='stylesheet'>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
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
	
	printDivCSS = new String ('<link rel="stylesheet" href="media/css/jquery.dataTables.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	window.frames["print_frame"].document.getElementById('example').border="1px #FF0000 solid";
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
<div id="page_tabs">
  <ul>
    <li><a class="active" href="reports_halfterm.php">Mid-Term Reports</a></li>
  </ul>
</div>

<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form name="pays" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <table width="100%">
        <tr>
          <td><select name="form" class="select" required>
		   <option value="" >-- Form --</option>
              <option value="1" >FORM 1 </option>
              <option value="2" >FORM 2 </option>
              <option value="3" >FORM 3 </option>
              <option value="4" >FORM 4 </option>
            </select>
			<select name="stream" id="select" class="select" >
			<option value="" >-- Class --</option>
			<option value="Entire" >Entire Form</option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select>
			</td>
          <td><select name="term" class="select" required>
		  <option value="" >-- Term --</option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select>
          </td>
          <td><select name="year" class="select" required>
		  <option value="" >-- Year --</option>
              <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
          <td><select name="wat" class="select" required>
		  <option value="" >-- WAT --</option>
              <option value="1">1</option>
              <option value="2">2</option>
			  <option value="12">1 & 2 </option>
            </select>
          </td>
          <td align="center"><input type="submit" name="Record" value="View Report" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
    <?php
if (isset ($_POST['form']) && isset ($_POST['term']) && isset ($_POST['year'])){
$form = $_REQUEST['form'];
$strm=$_REQUEST['stream'];
$year=$_REQUEST['year'];
$term=$_REQUEST['term'];
$wat=$_REQUEST['wat'];
//$adm=$_REQUEST['adm'];

//$form=2;
//$term=2;
//$year=2013;
function round_up ( $value, $precision ) {

    $pow = pow ( 10, $precision );

    return ( ceil ( $pow * $value ) + ceil ( $pow * $value - ceil ( $pow * $value ) ) ) / $pow;

	}

//$myformis=$form;

//include('dbConnector.php');

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
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Generated ".$myform." Yr ".$year."  Trm ".$term." Midterm Reports";
$func->addAuditTrail($activity,$username);

$date=date("j, F, Y");

$getExamstandard = mysql_query("select * from standards ");
while ($rowstand = mysql_fetch_array($getExamstandard)) {
$cat1standard=$rowstand['cat1'];
$cat2standard=$rowstand['cat2'];
}
$positionby="averagepoints";
$alternatepositionby="average";

	$posby="select * from positionby ";
	$resultposby = mysql_query($posby);
	while ($rowby = mysql_fetch_array($resultposby)) {// get admno
	$bymarks=$rowby['marks'];
	$bypoints=$rowby['point'];
	}
	
	


	$num=0;
	$cat1 = "SELECT distinct(admno) FROM tbleperformancetrack where form='$form' and year='$year' and term='$term'";
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$row['admno'];
	
	
	$getnames = "SELECT fname,sname,lname,class from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$stream=$row2['class'];
	
	//}
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
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=($row0['english']/$cat1standard)*100;
	$kis=($row0['kiswahili']/$cat1standard)*100;
	$math=($row0['math']/$cat1standard)*100;
	$bio=($row0['biology']/$cat1standard)*100;
	$chem=($row0['chemistry']/$cat1standard)*100;
	$phy=($row0['physics']/$cat1standard)*100;
	$his=($row0['history']/$cat1standard)*100;
	$geo=($row0['geography']/$cat1standard)*100;
	$cre=($row0['cre']/$cat1standard)*100;
	$agr=($row0['agriculture']/$cat1standard)*100;
	$bst=($row0['bstudies']/$cat1standard)*100;
	$fre=($row0['french']/$cat1standard)*100;
	$comp=($row0['computer']/$cat1standard)*100;
	$home=($row0['home']/$cat1standard)*100;
	
	}
	$engdetails=$grading->getSubjectGrade('ENGLISH',(($eng)));
	$enggrade=$engdetails['grade'];
	$epoint=$engdetails['point'];
$kisdetails=$grading->getSubjectGrade('KISWAHILI',(($kis)));
	$kisgrade=$kisdetails['grade'];
	$kipoint=$kisdetails['point'];
	if($form=='1' || $form=='2'){
	$mathdetails=$grading->getSciencesGrade('MATHS',(($math)),"1-2");
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',(($bio)),"1-2");
	if($bio==0){
	$biograde="-";
	$biopoint=0;
	}else{
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	}
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',(($phy)),"1-2");
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',(($chem)),"1-2");
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	}
	}else{
	$mathdetails=$grading->getSciencesGrade('MATHS',(($math)),"3-4");
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',(($bio)),"3-4");
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',(($phy)),"3-4");
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',(($chem)),"3-4");
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	}
	}
	$hisdetails=$grading->getSubjectGrade('HISTORY',(($his)));
	if($his==0){
	$hisgrade="-";
	$hispoint=0;
	}else{
	$hisgrade=$hisdetails['grade'];
	$hispoint=$hisdetails['point'];
	}
	
	$geodetails=$grading->getSubjectGrade('GEOGRAPHY',(($geo)));
	if($geo==0){
	$geograde="-";
	$geopoint=0;
	}else{
	$geograde=$geodetails['grade'];
	$geopoint=$geodetails['point'];
	}
	
	$credetails=$grading->getSubjectGrade('CRE',(($cre)));
	if($cre==0){
	$cregrade="-";
	$crepoint=0;
	}else{
	$cregrade=$credetails['grade'];
	$crepoint=$credetails['point'];
	}
	
	$agrdetails=$grading->getSubjectGrade('AGRICULTURE',(($agr)));
	if($agr==0){
	$agrgrade="-";
	$agrpoint=0;
	}else{
	$agrgrade=$agrdetails['grade'];
	$agrpoint=$agrdetails['point'];
	}
	
	$bstdetails=$grading->getSubjectGrade('B/STUDIES',(($bst)));
	if($bst==0){
	$bstgrade="-";
	$bstpoint=0;
	}else{
	$bstgrade=$bstdetails['grade'];
	$bstpoint=$bstdetails['point'];
	}
	
	$fredetails=$grading->getSubjectGrade('FRENCH',(($fre)));
	if($fre==0){
	$fregrade="-";
	$frepoint=0;
	}else{
	$fregrade=$fredetails['grade'];
	$frepoint=$fredetails['point'];
	}
	
	$compdetails=$grading->getSubjectGrade('COMPUTER',(($comp)));
	if($comp==0){
	$compgrade="-";
	$comppoint=0;
	}else{
	$compgrade=$compdetails['grade'];
	$comppoint=$compdetails['point'];
	}
	
	$homedetails=$grading->getSubjectGrade('HOME',(($home)));
	if($home==0){
	$homegrade="-";
	$homepoint=0;
	}else{
	$homegrade=$homedetails['grade'];
	$homepoint=$homedetails['point'];
	}
	
	$totalpoints1=$epoint+$kipoint+$mathpoint+$biopoint+$chempoint+$phypoint+$hispoint+$geopoint+$crepoint+$agrpoint+$bstpoint+$frepoint+$comppoint+$homepoint;

	
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
	$fre2=0;
	$comp2=0;
	$home2=0;

	$cat2 = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	
	$eng2=($row3['english']/$cat2standard)*100;
	$kis2=($row3['kiswahili']/$cat2standard)*100;
	$math2=($row3['math']/$cat2standard)*100;
	$bio2=($row3['biology']/$cat2standard)*100;
	$chem2=($row3['chemistry']/$cat2standard)*100;
	$phy2=($row3['physics']/$cat2standard)*100;
	$his2=($row3['history']/$cat2standard)*100;
	$geo2=($row3['geography']/$cat2standard)*100;
	$cre2=($row3['cre']/$cat2standard)*100;
	$agr2=($row3['agriculture']/$cat2standard)*100;
	$bst2=($row3['bstudies']/$cat2standard)*100;
	$fre2=($row3['french']/$cat2standard)*100;
	$comp2=($row3['computer']/$cat2standard)*100;
	$home2=($row3['home']/$cat2standard)*100;
	}
	
	$engdetails2=$grading->getSubjectGrade('ENGLISH',(($eng2)));
	$enggrade2=$engdetails2['grade'];
	$epoint2=$engdetails2['point'];
	
$kisdetails2=$grading->getSubjectGrade('KISWAHILI',(($kis2)));
	$kisgrade2=$kisdetails2['grade'];
	$kipoint2=$kisdetails2['point'];
	
	if($form=='1' || $form=='2'){
	$mathdetails2=$grading->getSciencesGrade('MATHS',(($math2)),"1-2");
	$mathgrade2=$mathdetails2['grade'];
	$mathpoint2=$mathdetails2['point'];
	
	$biodetails2=$grading->getSciencesGrade('BIOLOGY',(($bio)),"1-2");
	$biograde2=$biodetails2['grade'];
	$biopoint2=$biodetails2['point'];
	
	$phydetails2=$grading->getSciencesGrade('PHYSICS',(($phy2)),"1-2");
	$phygrade2=$phydetails2['grade'];
	$phypoint2=$phydetails2['point'];
	
	$chemdetails2=$grading->getSciencesGrade('CHEMISTRY',(($chem2)),"1-2");
	$chemgrade2=$chemdetails2['grade'];
	$chempoint2=$chemdetails2['point'];
	}else{
	$mathdetails2=$grading->getSciencesGrade('MATHS',(($math2)),"3-4");
	$mathgrade2=$mathdetails2['grade'];
	$mathpoint2=$mathdetails2['point'];
	
	$biodetails2=$grading->getSciencesGrade('BIOLOGY',(($bio2)),"3-4");
	$biograde2=$biodetails2['grade'];
	$biopoint2=$biodetails2['point'];
	
	$phydetails2=$grading->getSciencesGrade('PHYSICS',(($phy2)),"3-4");
	$phygrade2=$phydetails2['grade'];
	$phypoint2=$phydetails2['point'];
	
	$chemdetails2=$grading->getSciencesGrade('CHEMISTRY',(($chem2)),"3-4");
	$chemgrade2=$chemdetails2['grade'];
	$chempoint2=$chemdetails2['point'];
	}
	$hisdetails2=$grading->getSubjectGrade('HISTORY',(($his2)));
	$hisgrade2=$hisdetails2['grade'];
	$hispoint2=$hisdetails2['point'];
	
	$geodetails2=$grading->getSubjectGrade('GEOGRAPHY',(($geo2)));
	$geograde2=$geodetails2['grade'];
	$geopoint2=$geodetails2['point'];
	
	$credetails2=$grading->getSubjectGrade('CRE',(($cre2)));
	$cregrade2=$credetails2['grade'];
	$crepoint2=$credetails2['point'];
	
	$agrdetails2=$grading->getSubjectGrade('AGRICULTURE',(($agr2)));
	$agrgrade2=$agrdetails2['grade'];
	$agrpoint2=$agrdetails2['point'];
	
	$bstdetails2=$grading->getSubjectGrade('B/STUDIES',(($bst2)));
	$bstgrade2=$bstdetails2['grade'];
	$bstpoint2=$bstdetails2['point'];
	
	$fredetails2=$grading->getSubjectGrade('FRENCH',(($fre2)));
	$fregrade2=$fredetails2['grade'];
	$frepoint2=$fredetails2['point'];
	
	$compdetails2=$grading->getSubjectGrade('COMPUTER',(($comp2)));
	$compgrade2=$compdetails2['grade'];
	$comppoint2=$compdetails2['point'];
	
	$homedetails2=$grading->getSubjectGrade('HOME',(($home2)));
	$homegrade2=$homedetails2['grade'];
	$homepoint2=$homedetails2['point'];
	
	$totalpoints2=$epoint2+$kipoint2+$mathpoint2+$biopoint2+$chempoint2+$phypoint2+$hispoint2+$geopoint2+$crepoint2+$agrpoint2+$bstpoint2;

	
	
	$enga=$eng+$eng2;
	$kisa=$kis+$kis2;
	$matha=$math+$math2;
	$bioa=$bio+$bio2;
	$chema=$chem+$chem2;
	$phya=$phy+$phy2;
	$hisa=$his+$his2;
	$geoa=$geo+$geo2;
	$crea=$cre+$cre2;
	$agra=$agr+$agr2;
	$bsta=$bst+$bst2;
	$frea=$bst+$bst2;
	$compa=$bst+$bst2;
	$homea=$bst+$bst2;
	
	$totals=$enga+$kisa+$matha+$bioa+$chema+$phya+$hisa+$geoa+$crea+$agra+$bsta+$frea+$compa+$homea;
	$wat2totals=$eng2+$kis2+$math2+$bio2+$chem2+$phy2+$his2+$geo2+$cre2+$agr2+$bst2+$fre2+$comp2+$home2;
	$wat1totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$fre+$comp+$home;

$insert="insert into totalygradedmidterm (adm,names
	,eng1,eng1grade,eng2,eng2grade,kis1,kis1grade,kis2,kis2grade
	,math1,math1grade,math2,math2grade
	,bio1,bio1grade,bio2,bio2grade,chem1,chem1grade,chem2,chem2grade
	,phy1,phy1grade,phy2,phy2grade,his1,his1grade,his2,his2grade
	,geo1,geo1grade,geo2,geo2grade,cre1,cre1grade,cre2,cre2grade,agr1,agr1grade,agr2,agr2grade
	,bst1,bst1grade,bst2,bst2grade,fre1,fre1grade,fre2,fre2grade,comp1,comp1grade,comp2,comp2grade,home1,home1grade,home2,home2grade,wat1totals,wat2totals
	,totalmarks,totalpoints1,totalpoints2,totalpoints
	,term,year,form,stream)

	values('$admno','$fname $mname $lasname'
	,'$eng','$enggrade','$eng2','$enggrade2','$kis','$kisgrade','$kis2','$kisgrade2'
	,'$math','$mathgrade','$math2','$mathgrade2'
	,'$bio','$biograde','$bio2','$biograde2','$chem','$chemgrade','$chem2','$chemgrade2',
	'$phy','$phygrade','$phy2','$phygrade2','$his','$hisgrade','$his2','$hisgrade2'
	,'$geo','$geograde','$geo2','$geograde2','$cre','$cregrade','$cre2','$cregrade2','$agr','$agrgrade','$agr2','$agrgrade2'
	,'$bst','$bstgrade','$bst2','$bstgrade2','$fre','$fregrade','$fre2','$fregrade2','$comp','$compgrade','$comp2','$compgrade2','$home','$homegrade','$home2','$homegrade2'
	,'$wat1totals','$wat2totals','$totals','$totalpoints1','$totalpoints2',''
	,'$term','$year','$form','$stream')

on duplicate key update  eng1='$eng', eng1grade='$enggrade', eng2='$eng2', eng2grade='$enggrade2', kis1='$kis',kis1grade='$kisgrade', kis2='$kis2',kis2grade='$kisgrade2',
 math1='$math',math1grade='$mathgrade', math2='$math2',math2grade='$mathgrade2', bio1='$bio',bio1grade='$biograde', bio2='$bio2',bio2grade='$biograde2', chem1='$chem',chem1grade='$chemgrade', 
chem2='$chem2',chem2grade='$chemgrade2', phy1='$phy',phy1grade='$phygrade', phy2='$phy2',phy2grade='$phygrade2', his1='$his',his1grade='$hisgrade', his2='$his2',his2grade='$hisgrade2',
 geo1='$geo',geo1grade='$geograde', geo2='$geo2',geo2grade='$geograde2', cre1='$cre',cre1grade='$cregrade', cre2='$cre2',cre2grade='$cregrade2',agr1='$agr',agr1grade='$agrgrade', agr2='$agr2',agr2grade='$agrgrade2', 
bst1='$bst',bst1grade='$bstgrade', bst2='$bst2',bst2grade='$bstgrade2',fre1='$fre',fre1grade='$fregrade', fre2='$fre2',fre2grade='$fregrade2',comp1='$comp',comp1grade='$compgrade', comp2='$comp2',comp2grade='$compgrade2',home1='$home',home1grade='$homegrade', home2='$home2',home2grade='$homegrade2',totalmarks='$totals',wat1totals='$wat1totals',wat2totals='$wat2totals',totalpoints1='$totalpoints1',totalpoints2='$totalpoints2',totalpoints='',stream='$stream'";
		
		$querynow=mysql_query($insert);
	if(!$querynow){
	echo"failed". mysql_error();
	}
   }
 }
 
 $numb=0;
 


?>
<div class="clear"></div>
<form  method='get' name='pdiv'>
		 <div id="div_print" style="width:100%">
  <table class="borders" cellpadding="5" cellspacing="0" width="100%">
      <tr style="height:30px;">
        <td class="dataListHeader">Half-Term Exams Analysis: <?php echo $myform." ".$strm." Term: ".$term?><div style="float:right; margin-right:20px;"><a href=javascript:printDiv('div_print') title="Print Report"><i class="icon icon-green icon-print"></i>&nbsp;Print Analysis</a></div> </td>
      </tr>
      <tr>
        <td>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Admno</th>
                <th>Student Full Name</th>
                <th align=center colspan=2>Eng</th>
                <th align=center colspan=2>Kisw</th>
                <th align=center colspan=2>Maths</th>
                <th align=center colspan=2>Bio</th>
                <th align=center colspan=2>Phy</th>
                <th align=center colspan=2>Chem</th>
                <th align=center colspan=2>His</th>
                <th align=center colspan=2>Geo</th>
                <th align=center colspan=2>Cre</th>
                <th align=center colspan=2>Agr</th>
                <th align=center colspan=2>B/st</th>
				<th align=center colspan=2>Fre</th>
				<th align=center colspan=2>Comp</th>
				<th align=center colspan=2>H/Sci</th>
                <th align=center >Mks</th>
				<th align=center >Pts</th>
				<th align=center >Mss</th>
				<th align=center >GD</th>
                <th align=right >Pos</th>
              </tr>
            </thead>
            <tbody>
              <?php
if($wat==1){

if($bymarks==1){
		$positionby="wat1totals";
		$alternatepositionby="totalpoints1";
	}
	if($bypoints==1){
		$positionby="totalpoints1";
		$alternatepositionby="wat1totals";
	}
	
if($strm=="Entire"){
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' order by $positionby desc, $alternatepositionby desc";
}else{
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' and stream='$strm' order by $positionby desc, $alternatepositionby desc";
}
	$toexecutedis=mysql_query($myquerydis);
	while ($rowdis = mysql_fetch_array($toexecutedis)) {
	$numb++;

$admno=$rowdis['adm'];
$namesare=str_replace("&","'",$rowdis['names']);
$eng=$rowdis['eng1'];
$enggrade=$rowdis['eng1grade'];
$kis=$rowdis['kis1'];
$kisgrade=$rowdis['kis1grade'];
$math=$rowdis['math1'];
$mathgrade=$rowdis['math1grade'];
$bio=$rowdis['bio1'];
$biograde=$rowdis['bio1grade'];
$phy=$rowdis['phy1'];
$phygrade=$rowdis['phy1grade'];
$chem=$rowdis['chem1'];
$chemgrade=$rowdis['chem1grade'];
$his=$rowdis['his1'];
$hisgrade=$rowdis['his1grade'];
$geo=$rowdis['geo1'];
$geograde=$rowdis['geo1grade'];
$cre=$rowdis['cre1'];
$cregrade=$rowdis['cre1grade'];
$agr=$rowdis['agr1'];
$agrgrade=$rowdis['agr1grade'];
$bst=$rowdis['bst1'];
$bstgrade=$rowdis['bst1grade'];
$fre=$rowdis['fre1'];
$fregrade=$rowdis['fre1grade'];
$comp=$rowdis['comp1'];
$compgrade=$rowdis['comp1grade'];
$home=$rowdis['home1'];
$homegrade=$rowdis['home1grade'];
$totals=$rowdis['wat1totals'];
$totalpoints=$rowdis['totalpoints1'];

$averagepoints=round_up ($totalpoints/11,3);


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

?>
<tr>
	
		<td><?php echo $admno?></td> 
		<td><?php echo $namesare?></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $eng?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $enggrade?></strong></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $kis?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $kisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $math?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $mathgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $bio?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $biograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $phy?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $phygrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $chem?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $chemgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $his?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $hisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $geo?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $geograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $cre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $cregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $agr?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $agrgrade?></strong></td>
	  	<td align='right'  bgcolor='#E1FFFF'><?php echo $bst?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $bstgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $fre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $fregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $comp?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $compgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $home?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $homegrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totals?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totalpoints?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $averagepoints?></font></td>
		<td align='left'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $tfgrade?></font></td>
		<td align='right'><span id=freetext ><?php echo $numb?></td>
</tr>
<?php
	  	 // }// end of exam
	     //}//end of getting cat2 marks
	   //}//end of getting cat1 marks
	  //}// end of geting  names
	 }// end of geting admno

}//end of if post


if($wat==2){

if($bymarks==1){
		$positionby="wat1totals";
		$alternatepositionby="totalpoints1";
	}
	if($bypoints==1){
		$positionby="totalpoints1";
		$alternatepositionby="wat1totals";
	}
	
if($strm=="Entire"){
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' order by $positionby desc, $alternatepositionby desc";
}else{
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' and stream='$strm' order by $positionby desc, $alternatepositionby desc";
}
	$toexecutedis=mysql_query($myquerydis);
	while ($rowdis = mysql_fetch_array($toexecutedis)) {
	$numb++;

$admno=$rowdis['adm'];
$namesare=str_replace("&","'",$rowdis['names']);
$eng=$rowdis['eng2'];
$enggrade=$rowdis['eng2grade'];
$kis=$rowdis['kis2'];
$kisgrade=$rowdis['kis2grade'];
$math=$rowdis['math2'];
$mathgrade=$rowdis['math2grade'];
$bio=$rowdis['bio2'];
$biograde=$rowdis['bio2grade'];
$phy=$rowdis['phy2'];
$phygrade=$rowdis['phy2grade'];
$chem=$rowdis['chem2'];
$chemgrade=$rowdis['chem2grade'];
$his=$rowdis['his2'];
$hisgrade=$rowdis['his2grade'];
$geo=$rowdis['geo2'];
$geograde=$rowdis['geo2grade'];
$cre=$rowdis['cre2'];
$cregrade=$rowdis['cre2grade'];
$agr=$rowdis['agr2'];
$agrgrade=$rowdis['agr2grade'];
$bst=$rowdis['bst2'];
$bstgrade=$rowdis['bst2grade'];
$fre=$rowdis['fre2'];
$fregrade=$rowdis['fre2grade'];
$comp=$rowdis['comp2'];
$compgrade=$rowdis['comp2grade'];
$home=$rowdis['home2'];
$homegrade=$rowdis['home2grade'];
$totals=$rowdis['wat2totals'];
$totalpoints=$rowdis['totalpoints2'];

?>
<tr>
	
		<td><?php echo $admno?></td> 
		<td><?php echo $namesare?></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $eng?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $enggrade?></strong></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $kis?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $kisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $math?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $mathgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $bio?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $biograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $phy?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $phygrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $chem?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $chemgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $his?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $hisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $geo?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $geograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $cre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $cregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $agr?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $agrgrade?></strong></td>
	  	<td align='right'  bgcolor='#E1FFFF'><?php echo $bst?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $bstgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $fre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $fregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $comp?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $compgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $home?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $homegrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totals?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totalpoints?></font></td>
		<td align='right'><span id=freetext ><?php echo $numb?></td>
</tr>
<?php
	  	 // }// end of exam
	     //}//end of getting cat2 marks
	   //}//end of getting cat1 marks
	  //}// end of geting  names
	 }// end of geting admno

}//end of if post


if($wat==12){

if($bymarks==1){
		$positionby="wat1totals";
		$alternatepositionby="totalpoints1";
	}
	if($bypoints==1){
		$positionby="totalpoints1";
		$alternatepositionby="wat1totals";
	}

if($strm=="Entire"){
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' order by $positionby desc, $alternatepositionby desc";
}else{
$myquerydis="select * from totalygradedmidterm where  term='$term' and year='$year' and form='$form' and stream='$strm' order by $positionby desc, $alternatepositionby desc";
}
	$toexecutedis=mysql_query($myquerydis);
	while ($rowdis = mysql_fetch_array($toexecutedis)) {
	$numb++;

$admno=$rowdis['adm'];
$namesare=str_replace("&","'",$rowdis['names']);
$eng=($rowdis['eng1']+$rowdis['eng2'])/2;
$enggrade=$rowdis['eng2grade'];
$kis=($rowdis['kis1']+$rowdis['kis2'])/2;
$kisgrade=$rowdis['kis2grade'];
$math=$rowdis['math2'];
$mathgrade=$rowdis['math2grade'];
$bio=$rowdis['bio2'];
$biograde=$rowdis['bio2grade'];
$phy=$rowdis['phy2'];
$phygrade=$rowdis['phy2grade'];
$chem=$rowdis['chem2'];
$chemgrade=$rowdis['chem2grade'];
$his=$rowdis['his2'];
$hisgrade=$rowdis['his2grade'];
$geo=$rowdis['geo2'];
$geograde=$rowdis['geo2grade'];
$cre=$rowdis['cre2'];
$cregrade=$rowdis['cre2grade'];
$agr=$rowdis['agr2'];
$agrgrade=$rowdis['agr2grade'];
$bst=$rowdis['bst2'];
$bstgrade=$rowdis['bst2grade'];
$fre=$rowdis['fre2'];
$fregrade=$rowdis['fre2grade'];
$comp=$rowdis['comp2'];
$compgrade=$rowdis['comp2grade'];
$home=$rowdis['home2'];
$homegrade=$rowdis['home2grade'];
$totals=$rowdis['wat2totals'];
$totalpoints=$rowdis['totalpoints2'];
?>
	<tr>
	
		<td><?php echo $admno?></td> 
		<td><?php echo $namesare?></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $eng?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $enggrade?></strong></td>
		<td align='right' bgcolor='#E1FFFF'><?php echo $kis?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $kisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $math?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $mathgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $bio?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $biograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $phy?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $phygrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $chem?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $chemgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $his?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $hisgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $geo?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $geograde?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $cre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $cregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $agr?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $agrgrade?></strong></td>
	  	<td align='right'  bgcolor='#E1FFFF'><?php echo $bst?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $bstgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $fre?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $fregrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $comp?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $compgrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><?php echo $home?></td>
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $homegrade?></strong></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totals?></font></td>
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $totalpoints?></font></td>
		<td align='right'><span id=freetext ><?php echo $numb?></td>
	</tr>
<?php	  
	 
	  	 // }// end of exam
	     //}//end of getting cat2 marks
	   //}//end of getting cat1 marks
	  //}// end of geting  names
	 }// end of geting admno

}//end of if post

}

?>
            </tbody>
          </table>
		  
		  </td>
      </tr>
    </table>
	</div>
		  </form>
		  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
