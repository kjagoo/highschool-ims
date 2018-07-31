<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href="css/tablesorter_ordinary.css"  type="text/css" rel="stylesheet" >
<link href='css/opa-icons.css' rel='stylesheet'>
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
a{cursor:pointer;
}
</style>
<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {
  evt.keyCode == 9;
  return false;
  }
}

document.onkeypress = stopRKey;

</script> 
<script type="text/javascript" src="fieldclone.txt"></script>
<script type="text/javascript" src="entertotab.txt"></script>
<script type="text/javascript">

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
	window.location='files.xls';
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
    xmlhttp.open("GET","getFileDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}



	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="marks_record.php">Record Marks</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
$year=$_POST['year'];
$term=$_POST['term'];
$category=$_POST['types'];
$form = $_POST['frms'];
$strm = $_POST['stream'];
$subject = $_POST['subjects'];

if($category=="Cat"){
$cats=$_POST['cats'];
}
if($category=="Exam"){
$cats="exams";
}

if($form=='FORM 1'){
$myform=1;
}
if($form=='FORM 2'){
$myform=2;
}
if($form=='FORM 3'){
$myform=3;
}
if($form=='FORM 4'){
$myform=4;
}

include('includes/dbconnector.php');


//check if marks for this subject this term and year are set
$Status=" ";
	
	
if($category=="Cat"){
$check=mysql_query("select * from catoutof  where form='$myform' and term='$term' and year='$year' and subject='$subject' and cat='$cats'");
}
if($category=="Exam"){
$check=mysql_query("select * from examoutof  where years='$year' and subject='$subject'");
}
	while ($rowst = mysql_fetch_array($check)) {
	$Status=$rowst['states'];
	}// end of while status
	//$rowcount=mysql_num_rows($check);
	if($Status==" "){
	echo "<script language=javascript> alert('YOU HAVE NOT SET MARKS FOR THIS TERM, YEAR & FORM');</script>";
	echo "<script language=javascript> window.location='marks_set.php';</script>";
	}else{
	//check if marks have been recorded
	
	if($category=="Exam"){
	$checkr=mysql_query("select * from examstatus where form='$myform' and term='$term' and year='$year' and subject='$subject' and examtype='exams' and stream='$strm'");
	}
	if($category=="Cat"){
	$checkr=mysql_query("select * from examstatus where form='$myform' and term='$term' and year='$year' and subject='$subject' and examtype='$cats' and stream='$strm'");
	}
	$examStatus="";
	while ($rowstatus = mysql_fetch_array($checkr)) {
	$examStatus=$rowstatus['status'];
	}
	if($examStatus=="Recorded"){
	
	
	if($cats==1){
	$marksq = "select m.*, s.fname,s.lname,s.sname from markscats as m
inner join studentdetails as s on m.admno=s.admno and 
m.form='$myform' and m.term='$term' and m.year='$year' and cat='1' and s.class='$strm'";
	
	//SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='1'";//cat 1 query
	}
	if($cats==2){
	$marksq = "select m.*, s.fname,s.lname,s.sname from markscats as m
inner join studentdetails as s on m.admno=s.admno and 
m.form='$myform' and m.term='$term' and m.year='$year' and cat='2' and s.class='$strm'";
	
	//SELECT * FROM markscats where form='$form' and term='$term' and year='$year' and cat='2'";// cat 2 query
	}
	
	if($cats=='exams'){
	$marksq = "select m.*, s.fname,s.lname,s.sname from marksemams as m
inner join studentdetails as s on m.admno=s.admno and 
m.form='$myform' and m.term='$term' and m.year='$year' and s.class='$strm'";
	
	//SELECT * FROM marksemams where form='$form' and term='$term' and year='$year'";// exam query
	
	}
	?>
	<table class='borders table-striped table-bordered' cellpadding='5' cellspacing="0">
      <tr style='height:30px;'>
        <td class='dataListHeader' colspan='4'>Recorded Mark <u><?php echo $form?></u>&nbsp;&nbsp;<u><?php echo $subject?></u> ;<u>Term <?php echo $term?></u>&nbsp;&nbsp;<u>Year  &nbsp;<?php echo $year?></u>
          <div style=" float:right; width:150px; margin-right:5px;">
		  <a href="manage_student_marks.php?id=<?php echo $myform;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $subject;?>&stream=<?php echo $strm;?>">Edit Marks</a>
		  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  <a href="marks_record.php">close<i class="icon icon-red icon-close"></i></a>
		  </div>
		  </td>
      </tr>
      <tr>
        <td>#</td>
        <td >Adm No</td>
        <td >Full Name</td>
        <td align='right'>Recorded Marks</td>
      </tr>
	  <?php
	  $numm=0;
	  $resultmarksq = mysql_query($marksq);
	while ($rowmarks = mysql_fetch_array($resultmarksq)) {// get names
	$numm++;
	?>
	<tr class="record">
       <td><?php echo $numm?></td>
        <td><?php echo  $rowmarks['admno']?></td>
        <td><?php echo $rowmarks['fname']." ".$rowmarks['lname']." ".$rowmarks['sname']?></td>
         <td align="right"><font style="color:#FF0000"><?php echo $rowmarks[strtolower($subject)]?></font></td>
	</tr>
	
	<?php
	}
	  
	  ?>
	</table>
	
	
	<?php
	echo "<script language=javascript> alert('These Marks have already been Recorded');</script>";
	}else{
	

$catoneout=50;
$getCat1out = mysql_query("select outof from catoutof where subject='$subject' and cat=1 and term='$term' and year='$year' and form='$myform'");
while ($rowc1 = mysql_fetch_array($getCat1out)) {
$catoneout=$rowc1['outof'];
}
$cattwoout=50;
$getCat2out = mysql_query("select outof from catoutof where subject='$subject' and cat=2 and term='$term' and year='$year' and form='$myform'");
while ($rowc21 = mysql_fetch_array($getCat2out)) {
$cattwoout=$rowc21['outof'];
}
$examout=100;
$getExamout = mysql_query("select outof from examoutof where subject='$subject' and years='$year' and form='$myform'");
while ($row = mysql_fetch_array($getExamout)) {
$examout=$row['outof'];
}


if($cats==1){
$inputv=$catoneout;
}
if($cats==2){
$inputv=$cattwoout;
}
if($cats=='exams'){
$inputv=$examout;
}

$query = "SELECT * FROM studentdetails where form='$form' and class='$strm'";

// run the query and store the results in the $result variable.
$result = mysql_query($query);
if ($result) {
?>


<script language="javascript">
function checkInput(inputs){
 var tocompareWith=<?php echo $inputv?>;
  if (inputs > tocompareWith) {
   alert("INPUT ERROR!\n\nThe Value Given "+inputs+" is Bigger Than SET OUT OF "+tocompareWith);
   inputs.value="";
   return false;
   
  }
}

</script>
    <form name="demo" method="post" action="saveTrials.php">
      <table class='borders table-striped table-bordered' cellpadding='5' cellspacing="0">
      <tr style='height:30px;'>
        <td class='dataListHeader' colspan='4'>Recording <u><?php echo $form?></u>&nbsp;&nbsp;<u><?php echo $subject?></u> Marks &nbsp;&nbsp;<u>Term <?php echo $term?></u>&nbsp;&nbsp;<u>Year  &nbsp;<?php echo $year?></u>
          <div style="float:right; margin-right:20px;"><a href="marks_record.php">close<i class="icon icon-red icon-close"></i></a></div></td>
      </tr>
      <tr>
        <td>#</td>
        <td >Adm No</td>
        <td >Full Name</td>
        <td align='left'>Marks</td>
      </tr>
      <?php
	$num=0;
	 $index=0;
	
	while ($row = mysql_fetch_array($result)) {
	$num++;
	$index++;
	$adm=$row['admno'];
	$fname=str_replace("&","'",$row['fname']);
	$mname=str_replace("&","'",$row['sname']);
	$lname=str_replace("&","'",$row['lname']);
	?>
      <tr>
        <td><?php echo $num?></td>
        <td><div style='display:none'>
            <input type="text" value="<?php echo $adm?>" name="adms" id="ad" readonly="readonly" size="5" >
          </div>
          <?php echo $adm?></td>
        <td><?php echo $fname." ".$mname." ".$lname?></td>
        <td ><input type="text"  name="subject" id="inputMarks" size="15" tabindex='<?php echo $index?>' onkeyup="return checkInput(this.value)" ></td>
      </tr>
      <?php 	  
}//end of while		
echo" <tr><td colspan=25 align=center>
<input type=submit value='Save Marks' name=save class='btn btn-primary' onClick='getValues()'/></td></tr>
<tr><td colspan=20>&nbsp;&nbsp;</td></tr>
</table>";	

}

}	
}	
echo "<input type=hidden name=ads id=sa value= />
<input type=hidden name=subs id=subjs value= />
<input type=hidden name=form  value= $myform />
<input type=hidden name=term  value=$term />
<input type=hidden name=yr  value= $year />
<input type=hidden name=stream  value=$strm />
<input type=hidden name=cat  value=$cats />
<input type=hidden name=subject  value=$subject />
";		
		
//}
?>
    </form>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
<script type="text/javascript">
function setTIdx( elem )
{
  var str = "";
  
  str += elem.checked ? "tabindex "  : "";
  
  str += EnterToTab.focusAny ? "focusany" : "";
    
  EnterToTab.init(document.forms.demo, str );
}

EnterToTab.init( document.forms.demo );
document.forms.demo.firstElem.focus();


function getValues() {  
        
		var admisions = new Array();//get admision numbers as an array
		var marks = new Array();// get marks as an array
		
        marks = document.getElementsByName('subject');
		admisions = document.getElementsByName('adms');
       
       //alert("total fields = " + marks.length+"  and adms= "+admisions.length);
		
        var toSave= new Array(admisions.length);// create a new array for storing saved combined array
	   var tomarks= new Array(admisions.length);
		   
		for(var a = 0; a < admisions.length; a++){
		
           var objs = document.getElementsByName('adms').item(a);
		   var obj = document.getElementsByName('subject').item(a);
		   if(obj.value==null || obj.value==""){
		   obj.value=0;
		   }
			toSave[a]=objs.value;
			tomarks[a]=obj.value;
			document.demo.subs.value = toSave.toString();
			document.demo.ads.value = tomarks.toString();
			// alert(toSave[a]);
        }
		
		
    }

</script>
</body>
</html>
