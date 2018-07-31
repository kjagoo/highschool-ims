<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  
 include 'includes/SubjectTally.php';
 
 include 'includes/Grading.php';
 $grading = new Grading();
 
 function save_subject_final_analysis($subject,$form,$stream,$term,$year,$mean,$A, $A_m, $B_p, $B, $B_m, $C_p, $C, $C_m, $D_p, $D, $D_m, $E,$points, $students, $grade){

 $query="insert into totalygradedcatsubjectsanalysis 
	(subject, form,stream, term, year, meanscore, A, A_m, B_p, B, B_m, C_p, C, C_m, D_p, D, D_m, E,points, students, grade)
	values
	('$subject', '$form','$stream', '$term', '$year', '$mean', '$A', '$A_m', '$B_p', '$B', '$B_m', '$C_p', '$C', '$C_m', '$D_p', '$D', '$D_m', '$E','$points', '$students', '$grade') on duplicate key update meanscore='$mean', A='$A', A_m='$A_m' ,B_p='$B_p', B='$B', B_m='$B_m', C_p='$C_p', C='$C', C_m='$C_m', D_p='$D_p', D='$D', D_m='$D_m', E='$E', points='$points', students='$students', grade='$grade'";

$result = mysql_query($query);
if (!$result) {
    echo 'Invalid query: Cannot Save Analysis. ' . mysql_error();
}

}

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
		   <option value="" >-Form-</option>
              <option value="1" >FORM 1 </option>
              <option value="2" >FORM 2 </option>
              <option value="3" >FORM 3 </option>
              <option value="4" >FORM 4 </option>
            </select>
			<select name="stream" id="select" class="select" >
			<option value="" >-Stream-</option>
			<option value="Entire" >Entire</option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select>
			</td>
          <td><select name="term" class="select" required>
		  <option value="" >-Term-</option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select>
          </td>
          <td><select name="year" class="select" required>
		  <option value="" >-Year-</option>
              <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
          <td><select name="wat" class="select" required>
		  <option value="" >-CAT-</option>
              <option value="1">Tune up</option>
              <option value="2">Mid-Term</option>
			  <option value="12">Tune up & Mid-Term </option>
            </select>
          </td>
		  <td><select name="gradeby" class="select" required>
		  <option value="" >-Grade Using-</option>
              <option value="marks">Total Marks</option>
              <option value="points">Total Points</option>
            </select>
          </td>
		  <td><select name="mode" class="select" required>
		  <option value="" >-Analysis Mode-</option>
              <option value="normal">Normal</option>
              <option value="knec">Cluster</option>
            </select>
          </td>
          <td align="center"><input type="submit" name="Record" value="View Report" class="btn btn-primary"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
    <?php
if (isset ($_POST['form']) && isset ($_POST['term']) && isset ($_POST['year'])){
$form = $_POST['form'];
$strm=$_POST['stream'];
$year=$_POST['year'];
$term=$_POST['term'];
$wat=$_POST['wat'];
$positionby=$_POST['gradeby'];
$mode=$_POST['mode'];
//$adm=$_REQUEST['adm'];
$strmpassed=$strm;
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

$getExamstandard = mysql_query("select * from standards where year='$year' and term='$term' and form='$form'");
while ($rows = mysql_fetch_array($getExamstandard)) {
$examstandard=$rows['exam'];
$cat1standard=$rows['cat1'];
$cat2standard=$rows['cat2'];
}

	


	$num=0;
	$cat1 = "SELECT admno FROM tbleperformancetrack where form='$form' and year='$year' and term='$term' AND s_status='0'";
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get admno
	$num++;
	$admno=$row['admno'];
	
	
	$getnames = "SELECT fname,sname,lname,class,marks from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	$stream=$row2['class'];
	$kcpe=$row2['marks'];
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
	$catstand=$cat1standard;
	if($wat==1){
	$catis = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='1' and admno='$admno'";
	$catstand=$cat1standard;
	
	$result0 = mysql_query($catis);
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=($row0['english']/$catstand)*100;
	$kis=($row0['kiswahili']/$catstand)*100;
	$math=($row0['math']/$catstand)*100;
	$bio=($row0['biology']/$catstand)*100;
	$chem=($row0['chemistry']/$catstand)*100;
	$phy=($row0['physics']/$catstand)*100;
	$his=($row0['history']/$catstand)*100;
	$geo=($row0['geography']/$catstand)*100;
	$cre=($row0['cre']/$catstand)*100;
	$agr=($row0['agriculture']/$catstand)*100;
	$bst=($row0['bstudies']/$catstand)*100;
	$fre=($row0['french']/$catstand)*100;
	$comp=($row0['computer']/$catstand)*100;
	$home=($row0['home']/$catstand)*100;
	}
	}
	if($wat==2){
	$catis  = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='2' and admno='$admno'";
	$catstand=$cat2standard;
	
	$result0 = mysql_query($catis);
	while ($row0=mysql_fetch_array($result0)) {// get cat1
	
	$eng=($row0['english']/$catstand)*100;
	$kis=($row0['kiswahili']/$catstand)*100;
	$math=($row0['math']/$catstand)*100;
	$bio=($row0['biology']/$catstand)*100;
	$chem=($row0['chemistry']/$catstand)*100;
	$phy=($row0['physics']/$catstand)*100;
	$his=($row0['history']/$catstand)*100;
	$geo=($row0['geography']/$catstand)*100;
	$cre=($row0['cre']/$catstand)*100;
	$agr=($row0['agriculture']/$catstand)*100;
	$bst=($row0['bstudies']/$catstand)*100;
	$fre=($row0['french']/$catstand)*100;
	$comp=($row0['computer']/$catstand)*100;
	$home=($row0['home']/$catstand)*100;
	}
	}
	
	
	
	if($wat==12){
	$eng1=0;
	$kis1=0;
	$eng1=0;
	$math1=0;
	$bio1=0;
	$chem1=0;
	$phy1=0;
	$his1=0;
	$geo1=0;
	$cre1=0;
	$agr1=0;
	$bst1=0;
	$fre1=0;
	$comp1=0;
	$home1=0;
	$cat1 = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='1' and admno='$admno'";
	$resultc1 = mysql_query($cat1);
	while ($rowc1=mysql_fetch_array($resultc1)) {// get cat1
	$eng1=$rowc1['english'];
	$kis1=$rowc1['kiswahili'];
	$math1=$rowc1['math'];
	$bio1=$rowc1['biology'];
	$chem1=$rowc1['chemistry'];
	$phy1=$rowc1['physics'];
	$his1=$rowc1['history'];
	$geo1=$rowc1['geography'];
	$cre1=$rowc1['cre'];
	$agr1=$rowc1['agriculture'];
	$bst1=$rowc1['bstudies'];
	$fre1=$rowc1['french'];
	$comp1=$rowc1['computer'];
	$home1=$rowc1['home'];
	}
	$eng2=0;
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
	$cat2 = "SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='2' and admno='$admno'";
	$resultc2 = mysql_query($cat2);
	while ($rowc2=mysql_fetch_array($resultc2)) {// get cat1
	$eng2=$rowc2['english'];
	$kis2=$rowc2['kiswahili'];
	$math2=$rowc2['math'];
	$bio2=$rowc2['biology'];
	$chem2=$rowc2['chemistry'];
	$phy2=$rowc2['physics'];
	$his2=$rowc2['history'];
	$geo2=$rowc2['geography'];
	$cre2=$rowc2['cre'];
	$agr2=$rowc2['agriculture'];
	$bst2=$rowc2['bstudies'];
	$fre2=$rowc2['french'];
	$comp2=$rowc2['computer'];
	$home2=$rowc2['home'];
	}
	$eng=(($eng1+$eng2)/($cat1standard+$cat2standard))*100;
	$kis=(($kis1+$kis2)/($cat1standard+$cat2standard))*100;
	$math=(($math1+$math2)/($cat1standard+$cat2standard))*100;
	$bio=(($bio1+$bio2)/($cat1standard+$cat2standard))*100;
	$chem=(($chem1+$chem2)/($cat1standard+$cat2standard))*100;
	$phy=(($phy1+$phy2)/($cat1standard+$cat2standard))*100;
	$his=(($his1+$his2)/($cat1standard+$cat2standard))*100;
	$geo=(($geo1+$geo2)/($cat1standard+$cat2standard))*100;
	$cre=(($cre1+$cre2)/($cat1standard+$cat2standard))*100;
	$agr=(($agr1+$agr2)/($cat1standard+$cat2standard))*100;
	$bst=(($bst1+$bst2)/($cat1standard+$cat2standard))*100;
	$fre=(($fre1+$fre2)/($cat1standard+$cat2standard))*100;
	$comp=(($comp1+$comp2)/($cat1standard+$cat2standard))*100;
	$home=(($home1+$home2)/($cat1standard+$cat2standard))*100;
	
	
	}
	if($form==1 || $form==2){
	$myf="1-2";
	}else{
	$myf="3-4";
	}
	$engdetails=$grading->getSubjectGrade('ENGLISH',(($eng)),$myf);
	if($eng==0){
	$enggrade="F";
	$epoint=0;
	}else{
	$enggrade=$engdetails['grade'];
	$epoint=$engdetails['point'];
	$engremarks=$engdetails['remark'];
	}

	$kisdetails=$grading->getSubjectGrade('KISWAHILI',(($kis)),$myf);
	if($kis==0){
	$kisgrade="F";
	$kipoint=0;
	}else{
	$kisgrade=$kisdetails['grade'];
	$kipoint=$kisdetails['point'];
	$kisremarks=$kisdetails['remark'];
	}
	
	$mathdetails=$grading->getSciencesGrade('MATHS',(($math)),$myf);
	if($math==0){
	$mathgrade="F";
	$mathpoint=0;
	}else{
	$mathgrade=$mathdetails['grade'];
	$mathpoint=$mathdetails['point'];
	$mathremarks=$mathdetails['remark'];
	}
	
	$biodetails=$grading->getSciencesGrade('BIOLOGY',(($bio)),$myf);
	if($bio==0){
	$biograde="-";
	$biopoint=0;
	$bioremarks="-";
	}else{
	$biograde=$biodetails['grade'];
	$biopoint=$biodetails['point'];
	$bioremarks=$biodetails['remark'];
	}
	
	$phydetails=$grading->getSciencesGrade('PHYSICS',(($phy)),$myf);
	if($phy==0){
	$phygrade="-";
	$phypoint=0;
	$phyremarks="-";
	}else{
	$phygrade=$phydetails['grade'];
	$phypoint=$phydetails['point'];
	$phyremarks=$phydetails['remark'];
	}
	
	$chemdetails=$grading->getSciencesGrade('CHEMISTRY',(($chem)),$myf);
	if($chem==0){
	$chemgrade="-";
	$chempoint=0;
	$chemremarks="-";
	}else{
	$chemgrade=$chemdetails['grade'];
	$chempoint=$chemdetails['point'];
	$chemremarks=$chemdetails['remark'];
	}
	
	$hisdetails=$grading->getSubjectGrade('HISTORY',(($his)),$myf);
	if($his==0){
	$hisgrade="-";
	$hispoint=0;
	$hisremarks="-";
	}else{
	$hisgrade=$hisdetails['grade'];
	$hispoint=$hisdetails['point'];
	$hisremarks=$hisdetails['remark'];
	}
	
	$geodetails=$grading->getSubjectGrade('GEOGRAPHY',(($geo)),$myf);
	if($geo==0){
	$geograde="-";
	$geopoint=0;
	$georemarks="-";
	}else{
	$geograde=$geodetails['grade'];
	$geopoint=$geodetails['point'];
	$georemarks=$geodetails['remark'];
	}
	
	$credetails=$grading->getSubjectGrade('CRE',(($cre)),$myf);
	if($cre==0){
	$cregrade="-";
	$crepoint=0;
	$creremarks="-";
	}else{
	$cregrade=$credetails['grade'];
	$crepoint=$credetails['point'];
	$creremarks=$credetails['remark'];
	}
	
	$agrdetails=$grading->getSubjectGrade('AGRICULTURE',(($agr)),$myf);
	if($agr==0){
	$agrgrade="-";
	$agrpoint=0;
	$agrremarks="-";
	}else{
	$agrgrade=$agrdetails['grade'];
	$agrpoint=$agrdetails['point'];
	$agrremarks=$agrdetails['remark'];
	}
	
	$bstdetails=$grading->getSubjectGrade('B/STUDIES',(($bst)),$myf);
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
	
	
	if($form==1){
	$subjectsDone=11;
	}
	if($form==2){
	$subjectsDone=11;
	}
	if($form==3){
	$subjectsDone=8;
	}
	if($form==4){
	$subjectsDone=8;
	}

	$getsubsdone = "SELECT * from subjectsforstudent where admno='$admno' and year='$year' and term='$term'";// get names
	$Subjectsresult = mysql_query($getsubsdone);
	while ($rowsub = mysql_fetch_array($Subjectsresult)) {// get names
	$subjectsDone=$rowsub['subjects'];	
	}

	if($mode=='normal'){
	$totalpoints1=$epoint+$kipoint+$mathpoint+$biopoint+$chempoint+$phypoint+$hispoint+$geopoint+$crepoint+$agrpoint+$bstpoint+$frepoint+$comppoint+$homepoint;
	$wat1totals=$eng+$kis+$math+$bio+$chem+$phy+$his+$geo+$cre+$agr+$bst+$fre+$comp+$home;
	$averagepoints=round_up ($totalpoints1/$subjectsDone,3);
	$averagemarks=round_up ( $wat1totals/$subjectsDone, 3 ); // 
	}else{
	
	$numbers1=array($bio,$chem,$phy); //get two sciences
	rsort($numbers1);
	
	$numbers2=array($his,$geo,$cre);//get one humanity
	rsort($numbers2);
	
	$numbers3=array($agr,$bst,$home,$comp,$fre,$numbers1[2],$numbers2[1],$numbers2[2]);//get one from either
	rsort($numbers3);
	
	$points1=array($biopoint,$chempoint,$phypoint);
		rsort($points1);
	$points2=array($hispoint,$geopoint,$crepoint);
		rsort($points2);
	$points3=array($agrpoint,$bstpoint,$homepoint,$comppoint,$frepoint,$points1[2],$points2[1],$points2[2]);
		rsort($points3);
		
	$totalpoints1=$epoint+$kipoint+$mathpoint+$points1[0]+$points1[1]+$points2[0]+$points3[0];
	
	$wat1totals=$eng+$kis+$math+$numbers1[0]+$numbers1[1]+$numbers2[0]+$numbers3[0];
	
	$averagepoints=round_up ( $totalpoints1/7, 3 ); // 	
	$averagemarks=round_up ( $wat1totals/7, 3 ); // 	
	}






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
			$tfgrade = "F";
			
		}

$insert="insert into totalygradedmidterm (adm,names,kcpe
	,eng1,eng1grade,engremarks,kis1,kis1grade,kisremarks,math1,math1grade,mathremarks,bio1,bio1grade,bioremarks,chem1,chem1grade,chemremarks,phy1,phy1grade,phyremarks,his1,his1grade,hisremarks,geo1,geo1grade,georemarks,cre1,cre1grade,creremarks,agr1,agr1grade,agrremarks,bst1,bst1grade,bstremarks,fre1,fre1grade,frenchremarks,comp1,comp1grade,computerremarks,home1,home1grade,homeremarks,wat1totals,totalmarks,totalpoints1,averagepoints,average,fgrade,htremarks,term,year,form,stream)
	values('$admno','$fname $mname $lasname','$kcpe'
	,'$eng','$enggrade','$engremarks','$kis','$kisgrade','$kisremarks','$math','$mathgrade','$mathremarks','$bio','$biograde','$bioremarks','$chem','$chemgrade','$chemremarks',
	'$phy','$phygrade','$phyremarks','$his','$hisgrade','$hisremarks','$geo','$geograde','$georemarks','$cre','$cregrade','$creremarks','$agr','$agrgrade','$agrremarks','$bst','$bstgrade','$bstremarks','$fre','$fregrade','$freremarks','$comp','$compgrade','$compremarks','$home','$homegrade','$homeremarks','$wat1totals','$wat1totals','$totalpoints1','$averagepoints','$averagemarks','$tfgrade','$htremarks','$term','$year','$form','$stream')

on duplicate key update  kcpe='$kcpe',eng1='$eng', eng1grade='$enggrade',engremarks='$engremarks', kis1='$kis',kis1grade='$kisgrade', kisremarks='$kisremarks',math1='$math',math1grade='$mathgrade', mathremarks='$mathremarks', bio1='$bio',bio1grade='$biograde', bioremarks='$bioremarks',chem1='$chem',chem1grade='$chemgrade',chemremarks='$chemremarks', phy1='$phy',phy1grade='$phygrade',phyremarks='$phyremarks',  his1='$his',his1grade='$hisgrade',hisremarks='$hisremarks',geo1='$geo',geo1grade='$geograde',georemarks='$georemarks',cre1='$cre',cre1grade='$cregrade',creremarks='$creremarks',agr1='$agr',agr1grade='$agrgrade',agrremarks='$agrremarks', bst1='$bst',bst1grade='$bstgrade',bstremarks='$bstremarks',fre1='$fre',fre1grade='$fregrade',frenchremarks='$freremarks',comp1='$comp',comp1grade='$compgrade',computerremarks='$compremarks',home1='$home',home1grade='$homegrade',homeremarks='$homeremarks',totalmarks='$wat1totals',wat1totals='$wat1totals',totalpoints1='$totalpoints1',averagepoints='$averagepoints',average='$averagemarks',fgrade='$tfgrade',stream='$stream' , htremarks='$htremarks'";
		
		$querynow=mysql_query($insert);
	if(!$querynow){
	echo"failed". mysql_error();
	}
   }
 }
 
 $numb=0;
 

 
  if($strm=='Entire'){
		$geta = mysql_query("select count(fgrade) as a from totalygradedmidterm where fgrade='A' and term='$term' and year='$year' and form='$form'");
	}else{
		$geta = mysql_query("select count(fgrade) as a from totalygradedmidterm where fgrade='A' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($geta)) {// get admno
	$as=$rowAS['a'];
	
	}
	
	 if($strm=='Entire'){
	$getam = mysql_query("select count(fgrade) as am from totalygradedmidterm where fgrade='A-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getam = mysql_query("select count(fgrade) as am from totalygradedmidterm where fgrade='A-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getam)) {// get admno
	$am=$rowAS['am'];

	}
	if($strm=='Entire'){
	$getbp = mysql_query("select count(fgrade) as bp from totalygradedmidterm where fgrade='B+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbp = mysql_query("select count(fgrade) as bp from totalygradedmidterm where fgrade='B+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbp)) {// get admno
	$bp=$rowAS['bp'];
	}
	
	if($strm=='Entire'){
	$getbs = mysql_query("select count(fgrade) as bs from totalygradedmidterm where fgrade='B' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbs = mysql_query("select count(fgrade) as bs from totalygradedmidterm where fgrade='B' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbs)) {// get admno
	$bs=$rowAS['bs'];
	}
	
	if($strm=='Entire'){
	$getbm = mysql_query("select count(fgrade) as bm from totalygradedmidterm where fgrade='B-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getbm = mysql_query("select count(fgrade) as bm from totalygradedmidterm where fgrade='B-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getbm)) {// get admno
	$bm=$rowAS['bm'];
	}
	
	
	if($strm=='Entire'){
	$getcp = mysql_query("select count(fgrade) as cp from totalygradedmidterm where fgrade='C+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcp = mysql_query("select count(fgrade) as cp from totalygradedmidterm where fgrade='C+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcp)) {// get admno
	$cp=$rowAS['cp'];
	}
	
	if($strm=='Entire'){
	$getcs = mysql_query("select count(fgrade) as cs from totalygradedmidterm where fgrade='C' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcs = mysql_query("select count(fgrade) as cs from totalygradedmidterm where fgrade='C' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcs)) {// get admno
	$cs=$rowAS['cs'];
	}
	
	if($strm=='Entire'){
	$getcm = mysql_query("select count(fgrade) as cm from totalygradedmidterm where fgrade='C-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getcm = mysql_query("select count(fgrade) as cm from totalygradedmidterm where fgrade='C-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getcm)) {// get admno
	$cm=$rowAS['cm'];
	}
	
	if($strm=='Entire'){
	$getdp = mysql_query("select count(fgrade) as dp from totalygradedmidterm where fgrade='D+' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdp = mysql_query("select count(fgrade) as dp from totalygradedmidterm where fgrade='D+' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getdp)) {// get admno
	$dp=$rowAS['dp'];
	}
	
	if($strm=='Entire'){
	$getds = mysql_query("select count(fgrade) as ds from totalygradedmidterm where fgrade='D' and term='$term' and year='$year' and form='$form'");
	}else{
	$getds = mysql_query("select count(fgrade) as ds from totalygradedmidterm where fgrade='D' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getds)) {// get admno
	$ds=$rowAS['ds'];
	}
	
	
	if($strm=='Entire'){
	$getdm = mysql_query("select count(fgrade) as dm from totalygradedmidterm where fgrade='D-' and term='$term' and year='$year' and form='$form'");
	}else{
	$getdm = mysql_query("select count(fgrade) as dm from totalygradedmidterm where fgrade='D-' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getdm)) {// get admno
	$dm=$rowAS['dm'];
	}
	
	
	if($strm=='Entire'){
	$getes = mysql_query("select count(fgrade) as esd from totalygradedmidterm where fgrade='E' and term='$term' and year='$year' and form='$form'");
	}else{
	$getes = mysql_query("select count(fgrade) as esd from totalygradedmidterm where fgrade='E' and term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
	while ($rowAS = mysql_fetch_array($getes)) {// get admno
	$es=$rowAS['esd'];
	
	}
	
	$studentsare=0;
	if($strm=='Entire'){
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form'");
	}else{
	$getstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm'");
	}
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
	
	$cms=round_up ( $classtotalp/$studentsare, 3 ); 
	
	if ($cms > 0 && $cms <= 1.499) {
			$finalgrade = "E";
			
			// remarks="Work harder";
		} else if ($cms >= 1.5 && $cms <= 2.499) {
			$finalgrade = "D-";
			// remarks="Improve";
		} else if ($cms >= 2.5 && $cms <= 3.499) {
			$finalgrade = "D";
			// remarks="Improve";
		} else if ($cms >= 3.5 && $cms <= 4.499) {
			$finalgrade = "D+";
			// remarks="Can do better";
		} else if ($cms >= 4.5 && $cms <= 5.499) {
			$finalgrade = "C-";
			// remarks="Fair";
		} else if ($cms >= 5.5 && $cms <= 6.499) {
			$finalgrade = "C";
			// remarks="Fair";
		} else if ($cms >= 6.5 && $cms <= 7.499) {
			$finalgrade = "C+";
			// remarks="Fair";
		} else if ($cms >= 7.5 && $cms <= 8.499) {
			$finalgrade = "B-";
			// remarks="Good";
		} else if ($cms >= 8.5 && $cms <= 9.499) {
			$finalgrade = "B";
			// remarks="Good";
		} else if ($cms >= 9.5 && $cms <= 10.499) {
			$finalgrade = "B+";
			// remarks="Good";
		} else if ($cms >= 10.5 && $cms <= 11.499) {
			$finalgrade = "A-";
			// remarks="V. Good";
		} else if ($cms >= 11.5 && $cms <= 12.0) {
			$finalgrade = "A";
			// remarks="Excellent";
		}else if ($cms == 0) {
			$finalgrade = "-";
			
		}
		
	$stally = new SubjectTally();
	
	 $englishas = 0; 
	 $englishabp = 0; 
	 $englisham = 0;                            
	 $englishab = 0;                           
	 $englishabm = 0;                             
	 $englishacp = 0;                             
	 $englishac  = 0;                           
	 $englishacm = 0;                          
	 $englishadp = 0;                             
	 $englishad  = 0;                            
	 $englishadm = 0;                           
	 $englishade = 0;  
 
    $engpoas = 0; 
	$engpoam = 0;
	$engpobp = 0;
	$engpob =   0;
	$engpobm = 0;
	$engpocp = 0;
	$engpoc = 0;
	$engpocm = 0;
	$engpodp = 0;
	$engpod = 0;
	$engpodm = 0;
	$engpoe = 0;
    $engpoa =0;
	
	//*****************************************************************************************************************************
	$englishtallys=0;
	
	if($strm=='Entire'){
	
	$englishtallys = $stally -> getGradesPerSubjectEntireMID("eng1","eng1grade", $term,$year,$form); 
	
	}
	else{
	
	$englishtallys = $stally -> getGradesPerSubjectMID("eng1","eng1grade", $term,$year,$form,$strm); 
	
	}
	
	
	
	
	
	
	
	
	//echo " *****************************************".$englishtallys[0][0]."           ".$englishtallys[0][1];
	
	foreach($englishtallys as $key=>$values){
	//echo " ****".$englishtallys[$key][0]."   **  ".$englishtallys[$key][1] ."</br>";
	
	if($englishtallys[$key][0]=='A')  { $englishas = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='A-') { $englisham = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='B+') { $englishabp = $englishtallys[$key][1];}
	if($englishtallys[$key][0]=='B')  { $englishab = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='B-') { $englishabm = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C+') { $englishacp = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C')  { $englishac = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='C-') { $englishacm = $englishtallys[$key][1]; }
	if($englishtallys[$key][0]=='D+') { $englishadp = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='D')  { $englishad = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='D-') { $englishadm = $englishtallys[$key][1] ;}
	if($englishtallys[$key][0]=='E')  { $englishade = $englishtallys[$key][1] ;}
	}
                           

	$engpoA = $englishas * 12; 
	$engpoAm = $englisham * 11;
	$engpoBP = $englishabp * 10;
	$engpoB =   $englishab * 9;
	$engpoBm = $englishabm * 8;
	$engpoCp = $englishacp * 7;
	$engpoC = $englishac * 6;
	$engpoCm = $englishacm * 5;
	$engpoDp = $englishadp *4;
	$engpoD = $englishad * 3;
	$engpoDm = $englishadm * 2;
	$engpoE = $englishade * 1;
	
	
	
	
	//************************************************** french **************************************************************************
	
 $frenchas = 0; 
 $frencham = 0;
 $frenchbp = 0;                     
 $frenchb = 0;                           
 $frenchbm = 0;                             
 $frenchcp = 0;                             
 $frenchc  = 0;                           
 $frenchcm = 0;                          
 $frenchdp = 0;                             
 $frenchd  = 0;                            
 $frenchdm = 0;                           
 $frenchde = 0;  
 
    
	
	//*****************************************************************************************************************************
	$frenchtallys = 0;
	if($strm=='Entire'){
	
	$frenchtallys = $stally -> getGradesPerSubjectEntireMID("fre1","fre1grade", $term,$year,$form); 
	}else{
	$frenchtallys = $stally -> getGradesPerSubjectMID("fre1","fre1grade", $term,$year,$form,$strm); 
	                           //getGradesPerSubjectMID("frenchgrade", $term,$year,$form,$stream);
	}
	//echo " *****************************************".$frenchtallys[0][0]."           ".$frenchtallys[0][1];
	
	foreach($frenchtallys as $key=>$values){
	//echo " ****".$frenchtallys[$key][0]."   **  ".$frenchtallys[$key][1] ."</br>";
	
	if($frenchtallys[$key][0]=='A')  { $frenchas = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='A-') { $frencham = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='B+') { $frenchbp = $frenchtallys[$key][1];}
	if($frenchtallys[$key][0]=='B')  { $frenchb = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='B-') { $frenchbm = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C+') { $frenchcp = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C')  { $frenchc = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='C-') { $frenchcm = $frenchtallys[$key][1]; }
	if($frenchtallys[$key][0]=='D+') { $frenchdp = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='D')  { $frenchd = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='D-') { $frenchdm = $frenchtallys[$key][1] ;}
	if($frenchtallys[$key][0]=='E')  { $frenchde = $frenchtallys[$key][1] ;}
	}
                           

	$frenchpoA = $frenchas * 12; 
	$frenchpoAm = $frencham * 11;
	$frenchpoBP = $frenchbp * 10;
	$frenchpoB =   $frenchb * 9;
	$frenchpoBm = $frenchbm * 8;
	$frenchpoCp = $frenchcp * 7;
	$frenchpoC = $frenchc * 6;
	$frenchpoCm = $frenchcm * 5;
	$frenchpoDp = $frenchdp *4;
	$frenchpoD = $frenchd * 3;
	$frenchpoDm = $frenchdm * 2;
	$frenchpoE = $frenchde * 1;

	
	
	
	//************************************************** french **************************************************************************
	
	//******************************************************HOME SCIENCE******************************************************************
 $homeas = 0; 
 $homebp = 0; 
 $homeam = 0;                            
 $homeb = 0;                           
 $homebm = 0;                             
 $homecp = 0;                             
 $homec  = 0;                           
 $homecm = 0;                          
 $homedp = 0;                             
 $homed  = 0;                            
 $homedm = 0;                           
 $homede = 0;  

    
	
	//*****************************************************************************************************************************
	$hometallys = 0;
	if($strm=='Entire'){
	
	$hometallys = $stally -> getGradesPerSubjectEntireMID("home1","home1grade", $term,$year,$form); 
	}else{
	$hometallys = $stally -> getGradesPerSubjectMID("home1","home1grade", $term,$year,$form,$strm); 
	
	}
	//echo " *****************************************".$hometallys[0][0]."           ".$hometallys[0][1];
	
	foreach($hometallys as $key=>$values){
	//echo " ****".$hometallys[$key][0]."   **  ".$hometallys[$key][1] ."</br>";
	
	if($hometallys[$key][0]=='A')  { $homeas = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='A-') { $homeam = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='B+') { $homebp = $hometallys[$key][1];}
	if($hometallys[$key][0]=='B')  { $homeb = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='B-') { $homebm = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C+') { $homecp = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C')  { $homec = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='C-') { $homecm = $hometallys[$key][1]; }
	if($hometallys[$key][0]=='D+') { $homedp = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='D')  { $homed = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='D-') { $homedm = $hometallys[$key][1] ;}
	if($hometallys[$key][0]=='E')  { $homede = $hometallys[$key][1] ;}
	}
                           

	$homepoA = $homeas * 12; 
	$homepoAm = $homeam * 11;
	$homepoBP = $homebp * 10;
	$homepoB =   $homeb * 9;
	$homepoBm = $homebm * 8;
	$homepoCp = $homecp * 7;
	$homepoC = $homec * 6;
	$homepoCm = $homecm * 5;
	$homepoDp = $homedp *4;
	$homepoD = $homed * 3;
	$homepoDm = $homedm * 2;
	$homepoE = $homede * 1;
	
//***************************************************************************************************

 $computeras = 0; 
 $computerbp = 0; 
 $computeram = 0;                            
 $computerb = 0;                           
 $computerbm = 0;                             
 $computercp = 0;                             
 $computerc  = 0;                           
 $computercm = 0;                          
 $computerdp = 0;                             
 $computerd  = 0;                            
 $computerdm = 0;                           
 $computerde = 0;  
 
    
	
	//*****************************************************************************************************************************
	
	$computertallys = 0;
	if($strm=='Entire'){
	
	$computertallys = $stally -> getGradesPerSubjectEntireMID("comp1","comp1grade", $term,$year,$form); 
	}else{
	$computertallys = $stally -> getGradesPerSubjectMID("comp1","comp1grade", $term,$year,$form,$strm); 
	
	}
	//echo " *****************************************".$computertallys[0][0]."           ".$computertallys[0][1];
	
	foreach($computertallys as $key=>$values){
	//echo " ****".$computertallys[$key][0]."   **  ".$computertallys[$key][1] ."</br>";
	
	if($computertallys[$key][0]=='A')  { $computeras = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='A-') { $computeram = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='B+') { $computerbp = $computertallys[$key][1];}
	if($computertallys[$key][0]=='B')  { $computerb = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='B-') { $computerbm = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C+') { $computercp = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C')  { $computerc = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='C-') { $computercm = $computertallys[$key][1]; }
	if($computertallys[$key][0]=='D+') { $computerdp = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='D')  { $computerd = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='D-') { $computerdm = $computertallys[$key][1] ;}
	if($computertallys[$key][0]=='E')  { $computerde = $computertallys[$key][1] ;}
	}
                       
			

	$computerpoA = $computeras * 12; 
	$computerpoAm = $computeram * 11;
	$computerpoBP = $computerbp * 10;
	$computerpoB =   $computerb * 9;
	$computerpoBm = $computerbm * 8;
	$computerpoCp = $computercp * 7;
	$computerpoC = $computerc * 6;
	$computerpoCm = $computercm * 5;
	$computerpoDp = $computerdp *4;
	$computerpoD = $computerd * 3;
	$computerpoDm = $computerdm * 2;
	$computerpoE = $computerde * 1;
	

//***********************************************************************************************************8



	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','A',$term,$year,$form,"");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','A',$term,$year,$form," and stream='$strm'");
		$kisas=$kistally['tally'];
		$kisA=$kisas*12;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','A-',$term,$year,$form,"");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','A-',$term,$year,$form," and stream='$strm'");
		$kisam=$kistally['tally'];
		$kisAm=$kisam*11;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B+',$term,$year,$form,"");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B+',$term,$year,$form," and stream='$strm'");
		$kisbp=$kistally['tally'];
		$kisBP=$kisbp*10;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B',$term,$year,$form,"");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B',$term,$year,$form," and stream='$strm'");
		$kisb=$kistally['tally'];
		$kisB=$kisb*9;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','B-',$term,$year,$form,"");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','B-',$term,$year,$form," and stream='$strm'");
		$kisbm=$kistally['tally'];
		$kisBm=$kisbm*8;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C+',$term,$year,$form,"");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C+',$term,$year,$form," and stream='$strm'");
		$kiscp=$kistally['tally'];
		$kisCp=$kiscp*7;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C',$term,$year,$form,"");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C',$term,$year,$form," and stream='$strm'");
		$kisc=$kistally['tally'];
		$kisC=$kisc*6;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','C-',$term,$year,$form,"");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','C-',$term,$year,$form," and stream='$strm'");
		$kiscm=$kistally['tally'];
		$kisCm=$kiscm*5;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D+',$term,$year,$form,"");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D+',$term,$year,$form," and stream='$strm'");
		$kisdp=$kistally['tally'];
		$kisDp=$kisdp*4;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D',$term,$year,$form,"");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D',$term,$year,$form," and stream='$strm'");
		$kisd=$kistally['tally'];
		$kisD=$kisd*3;
	}
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','D-',$term,$year,$form,"");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','D-',$term,$year,$form," and stream='$strm'");
		$kisdm=$kistally['tally'];
		$kisDm=$kisdm*2;
	}
	
	if($strm=='Entire'){
		$kistally=$stally->getSubjectTallyMID('kis1grade','E',$term,$year,$form,"");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}else{
		$kistally=$stally->getSubjectTallyMID('kis1grade','E',$term,$year,$form," and stream='$strm'");
		$kisde=$kistally['tally'];
		$kisE=$kisde*1;
	}
	
	
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','A',$term,$year,$form,"");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','A',$term,$year,$form," and stream='$strm'");
		$mathas=$mathtally['tally'];
		$mathA=$mathas*12;
	}
	
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','A-',$term,$year,$form,"");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','A-',$term,$year,$form," and stream='$strm'");
		$matham=$mathtally['tally'];
		$mathAm=$matham*11;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B+',$term,$year,$form,"");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B+',$term,$year,$form," and stream='$strm'");
		$mathbp=$mathtally['tally'];
		$mathBP=$mathbp*10;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B',$term,$year,$form,"");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B',$term,$year,$form," and stream='$strm'");
		$mathb=$mathtally['tally'];
		$mathB=$mathb*9;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','B-',$term,$year,$form,"");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','B-',$term,$year,$form," and stream='$strm'");
		$mathbm=$mathtally['tally'];
		$mathBm=$mathbm*8;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C+',$term,$year,$form,"");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C+',$term,$year,$form," and stream='$strm'");
		$mathcp=$mathtally['tally'];
		$mathCp=$mathcp*7;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C',$term,$year,$form,"");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C',$term,$year,$form," and stream='$strm'");
		$mathc=$mathtally['tally'];
		$mathC=$mathc*6;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','C-',$term,$year,$form,"");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','C-',$term,$year,$form," and stream='$strm'");
		$mathcm=$mathtally['tally'];
		$mathCm=$mathcm*5;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D+',$term,$year,$form,"");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D+',$term,$year,$form," and stream='$strm'");
		$mathdp=$mathtally['tally'];
		$mathDp=$mathdp*4;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D',$term,$year,$form,"");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D',$term,$year,$form," and stream='$strm'");
		$mathd=$mathtally['tally'];
		$mathD=$mathd*3;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','D-',$term,$year,$form,"");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','D-',$term,$year,$form," and stream='$strm'");
		$mathdm=$mathtally['tally'];
		$mathDm=$mathdm*2;
	}
	if($strm=='Entire'){
		$mathtally=$stally->getSubjectTallyMID('math1grade','E',$term,$year,$form,"");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}else{
		$mathtally=$stally->getSubjectTallyMID('math1grade','E',$term,$year,$form," and stream='$strm'");
		$mathde=$mathtally['tally'];
		$mathE=$mathde*1;
	}
	
	/*** GET BIOLOGY GRADES AND POINTS **/
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','A',$term,$year,$form,"");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','A',$term,$year,$form," and stream='$strm'");
		$bioas=$biotally['tally'];
		$bioA=$bioas*12;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','A-',$term,$year,$form,"");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','A-',$term,$year,$form," and stream='$strm'");
		$bioam=$biotally['tally'];
		$bioAm=$bioam*11;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B+',$term,$year,$form,"");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B+',$term,$year,$form," and stream='$strm'");
		$biobp=$biotally['tally'];
		$bioBP=$biobp*10;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B',$term,$year,$form,"");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B',$term,$year,$form," and stream='$strm'");
		$biob=$biotally['tally'];
		$bioB=$biob*9;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','B-',$term,$year,$form,"");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','B-',$term,$year,$form," and stream='$strm'");
		$biobm=$biotally['tally'];
		$bioBm=$biobm*8;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C+',$term,$year,$form,"");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C+',$term,$year,$form," and stream='$strm'");
		$biocp=$biotally['tally'];
		$bioCp=$biocp*7;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C',$term,$year,$form,"");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C',$term,$year,$form," and stream='$strm'");
		$bioc=$biotally['tally'];
		$bioC=$bioc*6;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','C-',$term,$year,$form,"");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','C-',$term,$year,$form," and stream='$strm'");
		$biocm=$biotally['tally'];
		$bioCm=$biocm*5;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D+',$term,$year,$form,"");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D+',$term,$year,$form," and stream='$strm'");
		$biodp=$biotally['tally'];
		$bioDp=$biodp*4;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D',$term,$year,$form,"");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D',$term,$year,$form," and stream='$strm'");
		$biod=$biotally['tally'];
		$bioD=$biod*3;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','D-',$term,$year,$form,"");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','D-',$term,$year,$form," and stream='$strm'");
		$biodm=$biotally['tally'];
		$bioDm=$biodm*2;
	}
	if($strm=='Entire'){
		$biotally=$stally->getSubjectTallyMID('bio1grade','E',$term,$year,$form,"");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}else{
		$biotally=$stally->getSubjectTallyMID('bio1grade','E',$term,$year,$form," and stream='$strm'");
		$biode=$biotally['tally'];
		$bioE=$biode*1;
	}
	
	$biologyStudents=0;
	if($strm=='Entire'){
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and bio1>0");
	}else{
	$getbiostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and bio1>0");
	}
	while ($rowbiostud = mysql_fetch_array($getbiostudents)) {// get admno
	$biologyStudents=$rowbiostud['adms'];
	}
	
	/***************** GET CHEMISTRY GRADES *******************/
	
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A',$term,$year,$form,"");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A',$term,$year,$form," and stream='$strm'");
		$chemas=$chemtally['tally'];
		$chemA=$chemas*12;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A-',$term,$year,$form,"");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','A-',$term,$year,$form," and stream='$strm'");
		$chemam=$chemtally['tally'];
		$chemAm=$chemam*11;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B+',$term,$year,$form,"");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B+',$term,$year,$form," and stream='$strm'");
		$chembp=$chemtally['tally'];
		$chemBP=$chembp*10;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B',$term,$year,$form,"");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B',$term,$year,$form," and stream='$strm'");
		$chemb=$chemtally['tally'];
		$chemB=$chemb*9;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B-',$term,$year,$form,"");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','B-',$term,$year,$form," and stream='$strm'");
		$chembm=$chemtally['tally'];
		$chemBm=$chembm*8;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C+',$term,$year,$form,"");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C+',$term,$year,$form," and stream='$strm'");
		$chemcp=$chemtally['tally'];
		$chemCp=$chemcp*7;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C',$term,$year,$form,"");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C',$term,$year,$form," and stream='$strm'");
		$chemc=$chemtally['tally'];
		$chemC=$chemc*6;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C-',$term,$year,$form,"");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','C-',$term,$year,$form," and stream='$strm'");
		$chemcm=$chemtally['tally'];
		$chemCm=$chemcm*5;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D+',$term,$year,$form,"");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D+',$term,$year,$form," and stream='$strm'");
		$chemdp=$chemtally['tally'];
		$chemDp=$chemdp*4;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D',$term,$year,$form,"");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D',$term,$year,$form," and stream='$strm'");
		$chemd=$chemtally['tally'];
		$chemD=$chemd*3;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D-',$term,$year,$form,"");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','D-',$term,$year,$form," and stream='$strm'");
		$chemdm=$chemtally['tally'];
		$chemDm=$chemdm*2;
	}
	if($strm=='Entire'){
		$chemtally=$stally->getSubjectTallyMID('chem1grade','E',$term,$year,$form,"");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}else{
		$chemtally=$stally->getSubjectTallyMID('chem1grade','E',$term,$year,$form," and stream='$strm'");
		$chemde=$chemtally['tally'];
		$chemE=$chemde*1;
	}
	
	
	$chemistryStudents=0;
	if($strm=='Entire'){
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and chem1>0");
	}else{
	$getchemstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and chem1>0");
	}
	while ($rowchemstud = mysql_fetch_array($getchemstudents)) {// get admno
	$chemistryStudents=$rowchemstud['adms'];
	}

	/************************ GET PHYSICS GRADES *************************************/
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','A',$term,$year,$form,"");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','A',$term,$year,$form," and stream='$strm'");
		$phyas=$phytally['tally'];
		$phyA=$phyas*12;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','A-',$term,$year,$form,"");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','A-',$term,$year,$form," and stream='$strm'");
		$phyam=$phytally['tally'];
		$phyAm=$phyam*11;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B+',$term,$year,$form,"");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B+',$term,$year,$form," and stream='$strm'");
		$phybp=$phytally['tally'];
		$phyBP=$phybp*10;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B',$term,$year,$form,"");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B',$term,$year,$form," and stream='$strm'");
		$phyb=$phytally['tally'];
		$phyB=$phyb*9;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','B-',$term,$year,$form,"");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','B-',$term,$year,$form," and stream='$strm'");
		$phybm=$phytally['tally'];
		$phyBm=$phybm*8;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C+',$term,$year,$form,"");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C+',$term,$year,$form," and stream='$strm'");
		$phycp=$phytally['tally'];
		$phyCp=$phycp*7;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C',$term,$year,$form,"");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C',$term,$year,$form," and stream='$strm'");
		$phyc=$phytally['tally'];
		$phyC=$phyc*6;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','C-',$term,$year,$form,"");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','C-',$term,$year,$form," and stream='$strm'");
		$phycm=$phytally['tally'];
		$phyCm=$phycm*5;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D+',$term,$year,$form,"");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D+',$term,$year,$form," and stream='$strm'");
		$phydp=$phytally['tally'];
		$phyDp=$phydp*4;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D',$term,$year,$form,"");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D',$term,$year,$form," and stream='$strm'");
		$phyd=$phytally['tally'];
		$phyD=$phyd*3;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','D-',$term,$year,$form,"");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','D-',$term,$year,$form," and stream='$strm'");
		$phydm=$phytally['tally'];
		$phyDm=$phydm*2;
	}
	if($strm=='Entire'){
		$phytally=$stally->getSubjectTallyMID('phy1grade','E',$term,$year,$form,"");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}else{
		$phytally=$stally->getSubjectTallyMID('phy1grade','E',$term,$year,$form," and stream='$strm'");
		$phyde=$phytally['tally'];
		$phyE=$phyde*1;
	}
	
	$physicsStudents=0;
	if($strm=='Entire'){
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and phy1>0");
	}else{
	$getphystudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and phy1>0");
	}
	while ($rowphystud = mysql_fetch_array($getphystudents)) {// get admno
	$physicsStudents=$rowphystud['adms'];
	}
	
	/************************* GET HISTORY GRADES ***************************************/
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','A',$term,$year,$form,"");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','A',$term,$year,$form," and stream='$strm'");
		$hisas=$histally['tally'];
		$hisA=$hisas*12;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','A-',$term,$year,$form,"");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','A-',$term,$year,$form," and stream='$strm'");
		$hisam=$histally['tally'];
		$hisAm=$hisam*11;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B+',$term,$year,$form,"");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B+',$term,$year,$form," and stream='$strm'");
		$hisbp=$histally['tally'];
		$hisBP=$hisbp*10;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B',$term,$year,$form,"");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B',$term,$year,$form," and stream='$strm'");
		$hisb=$histally['tally'];
		$hisB=$hisb*9;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','B-',$term,$year,$form,"");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','B-',$term,$year,$form," and stream='$strm'");
		$hisbm=$histally['tally'];
		$hisBm=$hisbm*8;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C+',$term,$year,$form,"");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C+',$term,$year,$form," and stream='$strm'");
		$hiscp=$histally['tally'];
		$hisCp=$hiscp*7;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C',$term,$year,$form,"");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C',$term,$year,$form," and stream='$strm'");
		$hisc=$histally['tally'];
		$hisC=$hisc*6;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','C-',$term,$year,$form,"");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','C-',$term,$year,$form," and stream='$strm'");
		$hiscm=$histally['tally'];
		$hisCm=$hiscm*5;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D+',$term,$year,$form,"");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D+',$term,$year,$form," and stream='$strm'");
		$hisdp=$histally['tally'];
		$hisDp=$hisdp*4;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D',$term,$year,$form,"");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D',$term,$year,$form," and stream='$strm'");
		$hisd=$histally['tally'];
		$hisD=$hisd*3;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','D-',$term,$year,$form,"");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','D-',$term,$year,$form," and stream='$strm'");
		$hisdm=$histally['tally'];
		$hisDm=$hisdm*2;
	}
	if($strm=='Entire'){
		$histally=$stally->getSubjectTallyMID('his1grade','E',$term,$year,$form,"");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}else{
		$histally=$stally->getSubjectTallyMID('his1grade','E',$term,$year,$form," and stream='$strm'");
		$hisde=$histally['tally'];
		$hisE=$hisde*1;
	}
	
	
	$historyStudents=0;
	if($strm=='Entire'){
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and his1>0");
	}else{
	$gethisstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and his1>0");
	}
	while ($rowhisstud = mysql_fetch_array($gethisstudents)) {// get admno
	$historyStudents=$rowhisstud['adms'];
	}
	/*************************** GET GEOGRAPHY GRADES *****************************/
	
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','A',$term,$year,$form,"");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','A',$term,$year,$form," and stream='$strm'");
		$geoas=$geotally['tally'];
		$geoA=$geoas*12;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','A-',$term,$year,$form,"");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','A-',$term,$year,$form," and stream='$strm'");
		$geoam=$geotally['tally'];
		$geoAm=$geoam*11;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B+',$term,$year,$form,"");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B+',$term,$year,$form," and stream='$strm'");
		$geobp=$geotally['tally'];
		$geoBP=$geobp*10;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B',$term,$year,$form,"");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B',$term,$year,$form," and stream='$strm'");
		$geob=$geotally['tally'];
		$geoB=$geob*9;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','B-',$term,$year,$form,"");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','B-',$term,$year,$form," and stream='$strm'");
		$geobm=$geotally['tally'];
		$geoBm=$geobm*8;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C+',$term,$year,$form,"");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C+',$term,$year,$form," and stream='$strm'");
		$geocp=$geotally['tally'];
		$geoCp=$geocp*7;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C',$term,$year,$form,"");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C',$term,$year,$form," and stream='$strm'");
		$geoc=$geotally['tally'];
		$geoC=$geoc*6;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','C-',$term,$year,$form,"");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','C-',$term,$year,$form," and stream='$strm'");
		$geocm=$geotally['tally'];
		$geoCm=$geocm*5;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D+',$term,$year,$form,"");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D+',$term,$year,$form," and stream='$strm'");
		$geodp=$geotally['tally'];
		$geoDp=$geodp*4;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D',$term,$year,$form,"");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D',$term,$year,$form," and stream='$strm'");
		$geod=$geotally['tally'];
		$geoD=$geod*3;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','D-',$term,$year,$form,"");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','D-',$term,$year,$form," and stream='$strm'");
		$geodm=$geotally['tally'];
		$geoDm=$geodm*2;
	}
	if($strm=='Entire'){
		$geotally=$stally->getSubjectTallyMID('geo1grade','E',$term,$year,$form,"");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}else{
		$geotally=$stally->getSubjectTallyMID('geo1grade','E',$term,$year,$form," and stream='$strm'");
		$geode=$geotally['tally'];
		$geoE=$geode*1;
	}
	
	$geographyStudents=0;
	if($strm=='Entire'){
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and geo1>0");
	}else{
	$getgeostudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and geo1>0");
	}
	while ($rowgeostud = mysql_fetch_array($getgeostudents)) {// get admno
	$geographyStudents=$rowgeostud['adms'];
	}
	
	/************************* GET CRE GRADES  *****************************/
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','A',$term,$year,$form,"");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','A',$term,$year,$form," and stream='$strm'");
		$creas=$cretally['tally'];
		$creA=$creas*12;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','A-',$term,$year,$form,"");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','A-',$term,$year,$form," and stream='$strm'");
		$cream=$cretally['tally'];
		$creAm=$cream*11;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B+',$term,$year,$form,"");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B+',$term,$year,$form," and stream='$strm'");
		$crebp=$cretally['tally'];
		$creBP=$crebp*10;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B',$term,$year,$form,"");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B',$term,$year,$form," and stream='$strm'");
		$creb=$cretally['tally'];
		$creB=$creb*9;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','B-',$term,$year,$form,"");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','B-',$term,$year,$form," and stream='$strm'");
		$crebm=$cretally['tally'];
		$creBm=$crebm*8;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C+',$term,$year,$form,"");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C+',$term,$year,$form," and stream='$strm'");
		$crecp=$cretally['tally'];
		$creCp=$crecp*7;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C',$term,$year,$form,"");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C',$term,$year,$form," and stream='$strm'");
		$crec=$cretally['tally'];
		$creC=$crec*6;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','C-',$term,$year,$form,"");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','C-',$term,$year,$form," and stream='$strm'");
		$crecm=$cretally['tally'];
		$creCm=$crecm*5;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D+',$term,$year,$form,"");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D+',$term,$year,$form," and stream='$strm'");
		$credp=$cretally['tally'];
		$creDp=$credp*4;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D',$term,$year,$form,"");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D',$term,$year,$form," and stream='$strm'");
		$cred=$cretally['tally'];
		$creD=$cred*3;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','D-',$term,$year,$form,"");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','D-',$term,$year,$form," and stream='$strm'");
		$credm=$cretally['tally'];
		$creDm=$credm*2;
	}
	if($strm=='Entire'){
		$cretally=$stally->getSubjectTallyMID('cre1grade','E',$term,$year,$form,"");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}else{
		$cretally=$stally->getSubjectTallyMID('cre1grade','E',$term,$year,$form," and stream='$strm'");
		$crede=$cretally['tally'];
		$creE=$crede*1;
	}
	
	$creStudents=0;
	if($strm=='Entire'){
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and cre1>0");
	}else{
	$getcrestudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and cre1>0");
	}
	while ($rowcrestud = mysql_fetch_array($getcrestudents)) {// get admno
	$creStudents=$rowcrestud['adms'];
	}
	/*********************** GET AGRICULTURE GRADES *******************************/
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A',$term,$year,$form,"");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A',$term,$year,$form," and stream='$strm'");
		$agras=$agrtally['tally'];
		$agrA=$agras*12;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A-',$term,$year,$form,"");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','A-',$term,$year,$form," and stream='$strm'");
		$agram=$agrtally['tally'];
		$agrAm=$agram*11;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B+',$term,$year,$form,"");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B+',$term,$year,$form," and stream='$strm'");
		$agrbp=$agrtally['tally'];
		$agrBP=$agrbp*10;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B',$term,$year,$form,"");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B',$term,$year,$form," and stream='$strm'");
		$agrb=$agrtally['tally'];
		$agrB=$agrb*9;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B-',$term,$year,$form,"");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','B-',$term,$year,$form," and stream='$strm'");
		$agrbm=$agrtally['tally'];
		$agrBm=$agrbm*8;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C+',$term,$year,$form,"");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C+',$term,$year,$form," and stream='$strm'");
		$agrcp=$agrtally['tally'];
		$agrCp=$agrcp*7;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C',$term,$year,$form,"");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C',$term,$year,$form," and stream='$strm'");
		$agrc=$agrtally['tally'];
		$agrC=$agrc*6;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C-',$term,$year,$form,"");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','C-',$term,$year,$form," and stream='$strm'");
		$agrcm=$agrtally['tally'];
		$agrCm=$agrcm*5;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D+',$term,$year,$form,"");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D+',$term,$year,$form," and stream='$strm'");
		$agrdp=$agrtally['tally'];
		$agrDp=$agrdp*4;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D',$term,$year,$form,"");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D',$term,$year,$form," and stream='$strm'");
		$agrd=$agrtally['tally'];
		$agrD=$agrd*3;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D-',$term,$year,$form,"");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','D-',$term,$year,$form," and stream='$strm'");
		$agrdm=$agrtally['tally'];
		$agrDm=$agrdm*2;
	}
	if($strm=='Entire'){
		$agrtally=$stally->getSubjectTallyMID('agr1grade','E',$term,$year,$form,"");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}else{
		$agrtally=$stally->getSubjectTallyMID('agr1grade','E',$term,$year,$form," and stream='$strm'");
		$agrde=$agrtally['tally'];
		$agrE=$agrde*1;
	}
	
	$agrStudents=0;
	if($strm=='Entire'){
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and agr1>0");
	}else{
	$getagrstudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and agr1>0");
	}
	while ($rowagrstud = mysql_fetch_array($getagrstudents)) {// get admno
	$agrStudents=$rowagrstud['adms'];
	}
	
	/*********************** GET BUSINESS GRADES****************************/
	
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A',$term,$year,$form,"");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A',$term,$year,$form," and stream='$strm'");
		$bstas=$bsttally['tally'];
		$bstA=$bstas*12;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A-',$term,$year,$form,"");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','A-',$term,$year,$form," and stream='$strm'");
		$bstam=$bsttally['tally'];
		$bstAm=$bstam*11;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B+',$term,$year,$form,"");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B+',$term,$year,$form," and stream='$strm'");
		$bstbp=$bsttally['tally'];
		$bstBP=$bstbp*10;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B',$term,$year,$form,"");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B',$term,$year,$form," and stream='$strm'");
		$bstb=$bsttally['tally'];
		$bstB=$bstb*9;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B-',$term,$year,$form,"");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','B-',$term,$year,$form," and stream='$strm'");
		$bstbm=$bsttally['tally'];
		$bstBm=$bstbm*8;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C+',$term,$year,$form,"");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C+',$term,$year,$form," and stream='$strm'");
		$bstcp=$bsttally['tally'];
		$bstCp=$bstcp*7;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C',$term,$year,$form,"");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C',$term,$year,$form," and stream='$strm'");
		$bstc=$bsttally['tally'];
		$bstC=$bstc*6;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C-',$term,$year,$form,"");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','C-',$term,$year,$form," and stream='$strm'");
		$bstcm=$bsttally['tally'];
		$bstCm=$bstcm*5;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D+',$term,$year,$form,"");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D+',$term,$year,$form," and stream='$strm'");
		$bstdp=$bsttally['tally'];
		$bstDp=$bstdp*4;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D',$term,$year,$form,"");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D',$term,$year,$form," and stream='$strm'");
		$bstd=$bsttally['tally'];
		$bstD=$bstd*3;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D-',$term,$year,$form,"");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','D-',$term,$year,$form," and stream='$strm'");
		$bstdm=$bsttally['tally'];
		$bstDm=$bstdm*2;
	}
	if($strm=='Entire'){
		$bsttally=$stally->getSubjectTallyMID('bst1grade','E',$term,$year,$form,"");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}else{
		$bsttally=$stally->getSubjectTallyMID('bst1grade','E',$term,$year,$form," and stream='$strm'");
		$bstde=$bsttally['tally'];
		$bstE=$bstde*1;
	}
	
	
	
	$bstStudents=0;
	if($strm=='Entire'){
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and bst1>0");
	}else{
	$getbststudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and bst1>0");
	}
	while ($rowbststud = mysql_fetch_array($getbststudents)) {// get admno
	$bstStudents=$rowbststud['adms'];
	}
	
	
	$frenchStudents=0;
	if($strm=='Entire'){
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and fre1 > 0");
	}else{
	$getfrenchStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and fre1 > 0");
	}
	while ($rowbststud = mysql_fetch_array($getfrenchStudents)) {// get admno
	$frenchStudents=$rowbststud['adms'];
	}
	
	
	$homeStudents=0;
	if($strm=='Entire'){
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and home1>0");
	}else{
	$gethomeStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and home1>0");
	}
	while ($rowbststud = mysql_fetch_array($gethomeStudents)) {// get admno
	$homeStudents=$rowbststud['adms'];
	}
	
	
	$computerStudents=0;
	if($strm=='Entire'){
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and comp1>0");
	}else{
	$getcomputerStudents = mysql_query("select count(adm) as adms from totalygradedmidterm where term='$term' and year='$year' and form='$form' and stream='$strm' and comp1>0");
	}
	while ($rowbststud = mysql_fetch_array($getcomputerStudents)) {// get admno
	$computerStudents=$rowbststud['adms'];
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
	
	//echo "$agrA+$agrAm+$agrBP+$agrB+$agrBm+$agrCp+$agrC+$agrCm+$agrDp+$agrD+$agrDm+$agrE=".$totalAgrPoints;
	$totalfrenchPoints=$frenchpoA+$frenchpoAm+$frenchpoBP+$frenchpoB+$frenchpoBm+$frenchpoCp+$frenchpoC+$frenchpoCm+$frenchpoDp+$frenchpoD+$frenchpoDm+$frenchpoE;
	
	$totalhomePoints=$homepoA+$homepoAm+$homepoBP+$homepoB+$homepoBm+$homepoCp+$homepoC+$homepoCm+$homepoDp+$homepoD+$homepoDm+$homepoE;
	
	$totalcomputerPoints=$computerpoA+$computerpoAm+$computerpoBP+$computerpoB+$computerpoBm+$computerpoCp+$computerpoC+$computerpoCm+$computerpoDp+$computerpoD+$computerpoDm+$computerpoE;
	
	
	
	if ($frenchStudents == 0){
	     $frenchmean = "-";
	}else{
	      $frenchmean = round_up ( $totalfrenchPoints/$frenchStudents, 3 );
	}
	
	if($homeStudents == 0 ){
	$homemean = "-";
	
	}else {
	
	$homemean = round_up ( $totalhomePoints/$homeStudents, 3 );
	}
	
	if($computerStudents == 0) {
	$computermean = "-";
	
	}else{
	$computermean = round_up ( $totalcomputerPoints/$computerStudents, 3 );
	
	
	}
	
	
	
	$engmean=round_up ( $totalEnglishPoints/$studentsare, 3 );
	$kismean=round_up ( $totalKiswahiliPoints/$studentsare, 3 );
	$mathmean=round_up ( $totalMathPoints/$studentsare, 3 );
	
	
	
	
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
	 
	    $efinalgrade = $stally -> getFinalGrate($engmean);
		$kfinalgrade = $stally -> getFinalGrate($kismean);
		$mfinalgrade = $stally -> getFinalGrate($mathmean);
		$bfinalgrade = $stally -> getFinalGrate($biomean); 
		$chemfinalgrade = $stally -> getFinalGrate($chemmean);
		$phyfinalgrade = $stally -> getFinalGrate($phymean);
	    $hisfinalgrade = $stally -> getFinalGrate($hismean);
	    $geofinalgrade  = $stally -> getFinalGrate($geomean);
	    $crefinalgrade = $stally -> getFinalGrate($cremean);
		$agrfinalgrade = $stally -> getFinalGrate($agrmean);
		$bstfinalgrade = $stally -> getFinalGrate($bstmean);
		
		$frenchfinalgrade = $stally -> getFinalGrate($frenchmean);
		$homefinalgrade = $stally -> getFinalGrate($homemean);
		$computerfinalgrade = $stally -> getFinalGrate($computermean);
	
			
	save_subject_final_analysis('ENGLISH',$form,$strm,$term,$year,$engmean,$englishas, $englisham, $englishabp, $englishab, $englishabm, $englishacp, $englishac, $englishacm, $englishadp, $englishad, $englishadm, $englishade,$totalEnglishPoints, $studentsare, $efinalgrade);
	
	save_subject_final_analysis('KISWAHILI',$form,$strm,$term,$year,$kismean,$kisas, $kisam, $kisbp, $kisb, $kisbm, $kiscp, $kisc, $kiscm, $kisdp, $kisd, $kisdm, $kisde,$totalKiswahiliPoints, $studentsare, $kfinalgrade);
	
	save_subject_final_analysis('MATHEMATICS',$form,$strm,$term,$year,$mathmean,$mathas, $matham, $mathbp, $mathb, $mathbm, $mathcp, $mathc, $mathcm, $mathdp, $mathd, $mathdm, $mathde,$totalMathPoints, $studentsare, $mfinalgrade);
	
	save_subject_final_analysis('BIOLOGY',$form,$strm,$term,$year,$biomean,$bioas, $bioam, $biobp, $biob, $biobm, $biocp, $bioc, $biocm, $biodp, $biod, $biodm, $biode,$totalBioPoints, $biologyStudents, $bfinalgrade);
	
	save_subject_final_analysis('CHEMISTRY',$form,$strm,$term,$year,$chemmean,$chemas, $chemam, $chembp, $chemb, $chembm, $chemcp, $chemc, $chemcm, $chemdp, $chemd, $chemdm, $chemde,$totalChemPoints, $chemistryStudents, $chemfinalgrade);
	
	save_subject_final_analysis('PHYSICS',$form,$strm,$term,$year,$phymean,$phyam, $phyas, $phybp, $phyb, $phybm, $phycp, $phyc, $phycm, $phydp, $phyd, $phydm, $phyde,$totalPhysPoints, $physicsStudents, $phyfinalgrade);
	
	save_subject_final_analysis('HISTORY',$form,$strm,$term,$year,$hismean,$hisam, $hisas, $hisbp, $hisb, $hisbm, $hiscp, $hisc, $hiscm, $hisdp, $hisd, $hisdm, $hisde,$totalHisPoints, $historyStudents, $hisfinalgrade);
	
	save_subject_final_analysis('GEOGRAPHY',$form,$strm,$term,$year,$geomean, $geoas,$geoam, $geobp, $geob, $geobm, $geocp, $geoc, $geocm, $geodp, $geod, $geodm, $geode,$totalGeoPoints, $geographyStudents, $geofinalgrade);
	
	save_subject_final_analysis('CRE',$form,$strm,$term,$year,$cremean,$creas, $cream, $crebp, $creb, $crebm, $crecp, $crec, $crecm, $credp, $cred, $credm, $crede,$totalCrePoints, $creStudents, $crefinalgrade);
	
	save_subject_final_analysis('AGRICULTURE',$form,$strm,$term,$year,$agrmean,$agras, $agram, $agrbp, $agrb, $agrbm, $agrcp, $agrc, $agrcm, $agrdp, $agrd, $agrdm, $agrde,$totalAgrPoints, $agrStudents, $agrfinalgrade);
	
	save_subject_final_analysis('BUSINESS_STUDIES',$form,$strm,$term,$year,$bstmean,$bstas, $bstam, $bstbp, $bstb, $bstbm, $bstcp, $bstc, $bstcm, $bstdp, $bstd, $bstdm, $bstde,$totalBstPoints, $bstStudents, $bstfinalgrade);
	
	save_subject_final_analysis('FRENCH',$form,$strm,$term,$year,$frenchmean,$frenchas, $frencham, $frenchbp, $frenchb, $frenchbm, $frenchcp, $frenchc, $frenchcm, $frenchdp, $frenchd, $frenchdm, $frenchde,$totalfrenchPoints, $frenchStudents, $frenchfinalgrade);
	
	save_subject_final_analysis('HOMESCIENCE',$form,$strm,$term,$year,$homemean,$homeas, $homeam, $homebp, $homeb, $homebm, $homecp, $homec, $homecm, $homedp, $homed, $homedm, $homede,$totalhomePoints, $homeStudents, $homefinalgrade);
	
	save_subject_final_analysis('COMPUTER',$form,$strm,$term,$year,$computermean,$computeras, $computeram, $computerbp, $computerb, $computerbm, $computercp, $computerc, $computercm, $computerdp, $computerd, $computerdm, $computerde,$totalcomputerPoints, $computerStudents, $computerfinalgrade);
	
		
 
 
 

?>
<div class="clear"></div>
<form  method='get' name='pdiv'>
		 <div id="div_print" style="width:100%">
  <table class="borders" cellpadding="5" cellspacing="0" width="100%">
      <tr style="height:30px;">
        <td class="dataListHeader">Half-Term Exams Analysis: <?php echo $myform." ".$strm." Term: ".$term." Position By: ".$positionby?>
		<div style=" width:55%; float:right; margin-right:10px;">
		<table width="100%">
		<tr>
		<td align="left"><a href=javascript:printDiv('div_print') title="Print Report"><i class="icon icon-green icon-print"></i>&nbsp;Print Analysis</a></td>
		<td align="right"><a href="pdf_midterm.php?form=<?php echo $form?>&class=<?php echo $strm?>&term=<?php echo $term?>&year=<?php echo $year?>&wat=<?php echo $wat?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Print in PDF" target="_blank"><i class="icon icon-green icon-pdf"></i>&nbsp;Print PDF</a></td>
		<td align="right"><a href="csv_midterm.php?form=<?php echo $form?>&class=<?php echo $strm?>&term=<?php echo $term?>&year=<?php echo $year?>&wat=<?php echo $wat?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Print in PDF" target="_blank"><i class="icon icon-green icon-xls"></i>&nbsp;Export CSV</a></td>
		<td align="right"><a href="send_sms_watreports.php?form=<?php echo $form?>&class=<?php echo $strm?>&term=<?php echo $term?>&year=<?php echo $year?>&wat=<?php echo $wat?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Print in PDF" target="_blank"><i class="icon icon-green icon-envelope-closed"></i>&nbsp;SEND AS SMS</a></td>
		<td align="right"><a href="multiple_mid.php?id=<?php echo $form?>&classin=<?php echo $strm?>&term=<?php echo $term?>&yr=<?php echo $year?>&wat=<?php echo $wat?>&by=<?php echo $positionby?>&mode=<?php echo $mode?>" title="Print in PDF" target="_blank"><i class="icon icon-green icon-pdf"></i>&nbsp;Print All</a></td>
		</tr>
		</table>
		</div>
		 </td>
      </tr>
      <tr>
        <td>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Admno</th>
                <th>Student Full Name</th>
				<th align="left">Cls</th>
                <th align="center" colspan="2">Eng</th>
                <th align="center" colspan="2">Kisw</th>
                <th align="center" colspan="2">Maths</th>
                <th align="center" colspan="2">Bio</th>
                <th align="center" colspan="2">Phy</th>
                <th align="center" colspan="2">Chem</th>
                <th align="center" colspan="2">His</th>
                <th align="center" colspan="2">Geo</th>
                <th align="center" colspan="2">Cre</th>
                <th align="center" colspan="2">Agr</th>
                <th align="center" colspan="2">B/st</th>
				<th align="center" colspan="2">Fre</th>
				<th align="center" colspan="2">Comp</th>
				<th align="center" colspan="2">H/Sci</th>
                <th align="center">Mks</th>
				<th align="center">Pts</th>
				<th align="center">Mss</th>
				<th align="center">GD</th>
				<th align="center">VAP</th>
				<th align="center">P.I</th>
                <th align="right">Pos</th>
				<th align="right"></th>
				<th align="right"></th>
              </tr>
            </thead>
            <tbody>
              <?php
include 'includes/PerformanceIndicator.php';
	$pin = new PI();
	$pin->getPI($form,$term,$strm,$year,$wat);

	if($positionby=="marks"){
		$positionby="wat1totals";
		$alternatepositionby="averagepoints";
	}
	if($positionby=='points'){
		$positionby="averagepoints";
		$alternatepositionby="wat1totals";
	}
	

$myquerydisE="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and term='$term' and year='$year'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc";

	$toexecutedisE=mysql_query($myquerydisE);
	while ($rowdisE = mysql_fetch_array($toexecutedisE)) {
	$posssE=$rowdisE['ROWNUM'];
	$adm=$rowdisE['adm'];
	
	$updatesposE="update totalygradedmidterm set position='$posssE' where adm='$adm' and  year='$year' and form='$form' and term='$term'";
	$Eres=mysql_query($updatesposE);
	if(!$Eres){
		echo "Entire ".mysql_error();
	}
	}
//$myquerydis="select * from totalygradedmidterm where form='$form' and term='$term' and year='$year' order by $positionby desc,$alternatepositionby desc";

$myquerydisS="SELECT t2.*, ROWNUM FROM (
    SELECT q1.*, MIN(q1.rownum) AS rownum FROM 
    (SELECT t1.".$positionby.",t1.".$alternatepositionby.", @rownum:=@rownum + 1 AS rownum
        FROM `totalygradedmidterm` t1, (SELECT @rownum:=0) r  where  t1.form = '$form' and t1.term='$term' and t1.year='$year' and t1.stream='$strm' ORDER BY t1.".$positionby." desc,t1.".$alternatepositionby." desc) q1 
             GROUP BY q1.".$positionby.",q1.".$alternatepositionby.") 
    q2,`totalygradedmidterm` t2 WHERE  t2.".$positionby."=q2.".$positionby." and t2.".$alternatepositionby."= q2.".$alternatepositionby." 
    and t2.form = '$form' and t2.term='$term' and t2.year='$year' and t2.stream='$strm'
    ORDER BY t2.".$positionby." desc,t2.".$alternatepositionby." desc;";
	
	$toexecutedisS=mysql_query($myquerydisS);
	while ($rowdisS = mysql_fetch_array($toexecutedisS)) {
	$posssS=$rowdisS['ROWNUM'];
	$admn=$rowdisS['adm'];
	
	$updatesposS="update totalygradedmidterm set positionclass='$posssS' where adm='$admn' and  year='$year' and form='$form' and term='$term'";
	$Cres=mysql_query($updatesposS);
	if(!$Cres){
		echo "Class ".mysql_error();
	}
	}
	
	$kcpepo=0;
	$kcpepos=mysql_query("SELECT admno,class,marks FROM studentdetails where form='$myform' order by marks desc");
	while ($rowbs = mysql_fetch_array($kcpepos)) {
	$admkcpe=$rowbs['admno'];
	$kcpepo++;
		
	$inserte="update totalygradedmidterm set kcpeposition='$kcpepo' where adm='$admkcpe' and  year='$year' and form='$form' and term='$term'";
		$querynowe=mysql_query($inserte);
		if(!$querynowe){
		echo"failed". mysql_error();
		}
	}
//$myquerydis="select * from totalygradedmidterm where form='$form' and strm='$strm' and term='$term' and year='$year' order by $positionby desc,$alternatepositionby desc";

if($strm=="Entire"){
	$toexecutedis=mysql_query($myquerydisE);
}else{
	$toexecutedis=mysql_query($myquerydisS);
}
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
$cre1grade=$rowdis['cre1grade'];
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
$mean=$rowdis['averagepoints'];
$grade=$rowdis['fgrade'];
$strmin=$rowdis['stream'];
$posss=$rowdis['positionclass'];
$possC=$rowdis['position'];
$kcpem=$rowdis['kcpe'];
$kcpeposition=$rowdis['kcpeposition'];




$pi=0;
$vap=0;
	$resultf = mysql_query("select * from totalperformanceindex where adm='$admno' and  year='$year' and form='$form' and term='$term' and exam='$wat'");
	while ($rowf = mysql_fetch_array($resultf)){
	$pi=$rowf['pindex'];
	$vap=$rowf['vap'];
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
?>
<tr>
	
		<td><?php echo $admno?></td> 
		<td><?php echo $namesare?></td>
		<td align='left'><span id=freetext ><?php echo $strmin?></td>
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
		<td align="left"  bgcolor="#E1FFFF"><strong><?php echo $cre1grade?></strong></td>
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
		<td align='right'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $mean?></font></td>
		<td align='left'  bgcolor='#E1FFFF'><font color=#FF0000><?php echo $grade?></font></td>
		<td align='right'><?php echo number_format(($vap-$mean),3)?></td>
		<td align='right'><?php echo $pi?></td>
		<td align='right'><?php echo $rowdis['position'];  ?></td>
		<td align="center">
		<a href="mid_report_form.php?id=<?php echo $admno?>&forms=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&classin=<?php echo $strm?>&wat=<?php echo $wat?>" target="-blank"><i class="icon icon-green icon-print"></i></a></td>
		<td align="right">
		<a href="send_sms_single_watreport.php?id=<?php echo $form?>&term=<?php echo $term?>&yr=<?php echo $year?>&adm=<?php echo $admno?>&strm=<?php echo $strm?>&mode=<?php echo $mode?>&wat=<?php echo $wat?>&by=<?php echo $positionby?>">
		<i class="icon icon-green icon-envelope-closed"></i> </a></td>
</tr>
<?php
	  	 // }// end of exam
	     //}//end of getting cat2 marks
	   //}//end of getting cat1 marks
	  //}// end of geting  names
	 }// end of geting admno



?>
            </tbody>
			<tfoot>
			
                             <tr>
              <td colspan="31" align='center'><table width="400" border="1">
                  <tr>
                    <td class="dataListHeader" align="center" colspan="12"><font color="#FF00FF">Mean Grade Summary</font></td>
                  </tr>
                  <tr>
                    <td>A</td>
                    <td>A-</td>
                    <td>B+</td>
                    <td>B</td>
                    <td>B-</td>
                    <td>C+</td>
                    <td>C</td>
                    <td>C-</td>
                    <td>D+</td>
                    <td>D</td>
                    <td>D-</td>
                    <td>E</td>
                  </tr>
                  <tr>
                    <td><?php echo $as?></td>
                    <td><?php echo $am ?></td>
                    <td><?php echo $bp?></td>
                    <td><?php echo $bs?></td>
                    <td><?php echo $bm?></td>
                    <td><?php echo $cp?></td>
                    <td><?php echo $cs?></td>
                    <td><?php echo $cm?></td>
                    <td><?php echo $dp?></td>
                    <td><?php echo $ds?></td>
                    <td><?php echo $dm?></td>
                    <td><?php echo $es?></td>
                  </tr>
                </table></td>
            </tr>
             <tr>
              <td colspan=31 align=center>
          <form  method='get' name='pdiv'>
            <div id="div_print_analysis"> 
	<table align=center width='80%' class='bordered_table'>
 		<tr>
		<td align=center colspan=31 class='dataListHeader' >
		<font color=#FF00FF>Subjects Mean Score Summary</font></td>
		</tr>
		
		<tr>
		   <td>SUBJECTS</td>
		   <td align=center colspan=2>A</td>
		    <td align=center colspan=2>A-</td>
			<td align=center colspan=2>B+</td>
                        <td align=center colspan=2>B</td>
			<td align=center colspan=2>B-</td>
			<td align=center colspan=2>C+</td>
			<td align=center colspan=2>C</td>
			<td align=center colspan=2>C-</td>
			<td align=center colspan=2>D+</td>
			<td align=center colspan=2>D</td>
			<td align=center colspan=2>D-</td>
			<td align=center colspan=2>E</td>
			<td align=center colspan=2>Points</td>
			<td align=center colspan=2>Students</td>
			<td align=center colspan=2>Mean</td>
			<td align=center colspan=2>Grade</td>
			</tr
			<?php
			
			$analysis="select * from  totalygradedcatsubjectsanalysis where form='$form' and stream='$strmpassed' and term='$term' and year='$year' order by meanscore desc";
			$resultanalysis = mysql_query($analysis);
			while ($rowan = mysql_fetch_array($resultanalysis)) {
			
			?>
			
			<tr>
		   <td><?php echo $rowan['subject']?> </td>
		   <td align=center colspan=2><?php echo $rowan['A']?></td>
		    <td align=center colspan=2><?php echo $rowan['A_m']?></td>
			<td align=center colspan=2><?php echo $rowan['B_p']?></td>
                        <td align=center colspan=2><?php echo $rowan['B']?></td>
			<td align=center colspan=2><?php echo $rowan['B_m']?></td>
			
			<td align=center colspan=2><?php echo $rowan['C_p']?></td>
			<td align=center colspan=2><?php echo $rowan['C']?></td>
			<td align=center colspan=2><?php echo $rowan['C_m']?></td>
			<td align=center colspan=2><?php echo $rowan['D_p']?></td>
			<td align=center colspan=2><?php echo $rowan['D']?></td>
			<td align=center colspan=2><?php echo $rowan['D_m']?></td>
			<td align=center colspan=2><?php echo $rowan['E']?></td>
			<td align=center colspan=2><?php echo $rowan['points']?></td>
			<td align=center colspan=2><?php echo $rowan['students']?></td>
			<td align=center colspan=2><?php echo $rowan['meanscore']?></td>
			<td align=center colspan=2><?php echo $rowan['grade']?></td>
			</tr
			<?php
			}
			?>
			
		</table>	
			
  </td>
 </tr>           
                            <tr>
			<th colspan="36">Class Mean Scores Summary</th>
			</tr>
			<tr>
			<th colspan="10" align="right">Class</th>
			<th colspan="6" align="center"># Students</th>
			<th colspan="20" align="left">Mean</th>
			</tr>
		<?php
		$overall=0;
		$fms=0;
		$studs=0;
		$overmean=0.00;
		$qsmean=0.00;
		$q="select distinct stream, (sum(averagepoints)/ count(adm)) as mean,  count(adm) as stds from totalygradedmidterm where fgrade!='F' and form='$form' and term='$term' and year='$year' group by stream desc";

		//$q="select distinct strm, (sum(averagepoints)/ count(adm)) as mean from totalygradedmidterm where form='$form' and term='$term' and year='$year' group by strm desc";
		
	$mes=mysql_query($q);
	while ($qs = mysql_fetch_array($mes)) { 
	$fms++;
	$qsmean=$qs['mean'];
	?>
	
		<tr>
		<th colspan="10" align="right">Form <?php echo $form." ".$qs['stream']?></th>
		<th colspan="6" align="center"><?php echo $qs['stds']?></th>
		<th colspan="20" align="left"><?php echo round_up ($qs['mean'],3)?></th>
		</tr>
	
	<?php
	$studs+=$qs['stds'];
	$overall+=round_up ($qsmean,3);
	}
	if($overall==0){
	$overmean=0.00;
	}else{
	$overmean=round_up (($overall/$fms),3);
	}
?>
			<tr>
		<th colspan="10" align="right">Overall Form <?php echo $form?> </th>
		<th colspan="6" align="center"><?php echo $studs?></th>
		<th colspan="20" align="left"><?php echo $overmean?></th>
		</tr>
			</tfoot>
<?php

}
?>
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
