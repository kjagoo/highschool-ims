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
<link href='css/opa-icons.css' rel='stylesheet'/>
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />

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
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
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
    <li><a class="active" href="marks_manage.php">Manage Marks</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
  $subje="";
  
 if(isset($_GET['id'])){
	 $form=str_replace("_"," ",$_GET['id']);
	$term=$_GET['term'];
	$year=$_GET['year'];
	$subje=$_GET['subject'];
	$subject=$_GET['subject'];
	$stream=$_GET['stream'];
	
 }else{
$form=str_replace("_"," ",$_POST['cates']);
$term=$_POST['term'];
$year=$_POST['year'];
$subject=$_POST['subjects'];
$stream=$_POST['stream'];
}
$myformis=$form;

include('includes/dbconnector.php');

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




	if($subject=='ENGLISH'){
	$subje='english';
	}
	if($subject=='KISWAHILI'){
	$subje='kiswahili';
	}
	if($subject=='MATH'){
	$subje='math';
	}
	if($subject=='BIOLOGY'){
	$subje='biology';
	}
	if($subject=='PHYSICS'){
	$subje='physics';
	}
	if($subject=='CHEMISTRY'){
	$subje='chemistry';
	}
	if($subject=='HISTORY'){
	$subje='history';
	}
	if($subject=='GEOGRAPHY'){
	$subje='geography';
	}
	if($subject=='CRE'){
	$subje='cre';
	}
	if($subject=='AGRICULTURE'){
	$subje='agriculture';
	}
	if($subject=='BSTUDIES'){
	$subje='bstudies';
	}
	if($subject=='COMPUTER'){
	$subje='computer';
	}
	if($subject=='HOME'){
	$subje='home';
	}
if($subject=='FRENCH'){
	$subje='french';
	}


// run the query and store the results in the $result variable.



//if ($result) {
  // create a new form and then put the results
  // in to a table.
  ?>
      <div class="clear"></div>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'><u>Managing <?php echo $form." ".$subject?> Marks&nbsp;&nbsp;Term <?php echo $term?> &nbsp;&nbsp;Year <?php echo $year?>&nbsp;&nbsp; <?php echo $myform?></u>
		  <div style="float:right; margin-right:5px;">
		  <table width="300px">
		  <tr>
		  <td align="left"><a href="manage_student_marks.php?id=<?php echo $form;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $subject;?>&stream=<?php echo $stream;?>">refresh<i class="icon icon-green icon-refresh"></i></a></td>
		  <td align="left"><a href="csv_student_marks.php?id=<?php echo $form;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $subje;?>&stream=<?php echo $stream;?>">Export CSV<i class="icon icon-green icon-xls"></i></a></td>
		  
		  <td align="right"><a href="marks_manage.php">close<i class="icon icon-red icon-close"></i></a></td></tr></table></div>
		  </td>
        </tr>
        <tr>
          <td>
		  <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
		  <thead>
              <tr>
                <th>#</th>
                <th >Admno</th>
                <th >Full Name</th>
                <th align='righ't>Tune-Up</th>
                <th align='right'>Mid-Term</th>
                <th align='right'>End of Term</th>
              </tr>
			</thead>
             <tbody>
              <?php	
	$num=0;
	$sub=0;
	
	$ads = "SELECT distinct(admno) FROM tbleperformancetrack where form='$myform' and year='$year' and term='$term' and stream='$stream' and s_status=0 order by admno asc";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	
	$sub=0;
	$cat1 = "SELECT * FROM markscats where form='$myform' and term='$term' and year='$year' and cat='1' and admno='$admno'";//cat 1 query
	$result = mysql_query($cat1);
	while ($row = mysql_fetch_array($result)) {// get cat1 marks
	$sub=$row[$subje];
	
	}
	$fname="";
	$mname="";
	$lasname="";
	$getnames = "SELECT fname,sname,lname from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	
	}
	$ca2=0;
	
	$cat2 = "SELECT * FROM markscats where form='$myform' and term='$term' and year='$year' and cat='2' and admno='$admno'";// cat 2 query
	$result2 = mysql_query($cat2);
	while ($row3= mysql_fetch_array($result2)) {// get cat 2 marks
	$ca2=$row3[$subje];
	
	}
	$exams=0;
	$exam = "SELECT * FROM marksemams where form='$myform' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	$exams=$row4[$subje];
	}
?>
              <tr class="record">
                <td><?php echo $num?></td>
                <td><?php echo  $admno?></td>
                <td><?php echo str_replace("&","'",$fname)." ".str_replace("&","'",$mname)." ".str_replace("&","'",$lasname)?></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $sub ?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $ca2?></font></td>
                <td align="right" bgcolor="#E4FAFC"><font style="color:#FF0000"><?php echo $exams?></font></td>
                <td align="right" width="15%">
				<a href="#openModal<?php echo $num?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i>&nbsp; Edit</a>
				
				
	<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateMarks.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Marks Record <?php echo $admno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>Tune-Up:</b></td>
              <td class="alterCell2"><input type="text" name="c1" class="inputFields" autofocus required  tabindex="1" value="<?php echo $sub ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Mid-Term:</b></td>
              <td class="alterCell2"><input type="text" name="c2" class="inputFields" autofocus required  tabindex="1" value="<?php echo $ca2 ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>End of Term:</b></td>
              <td class="alterCell2"><input type="text" name="ex" class="inputFields" autofocus required  tabindex="1" value="<?php echo $exams ?>"/></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $admno; ?>">
		  <input type="hidden" name="frm" value="<?php echo $myform; ?>">
		  <input type="hidden" name="trm" value="<?php echo $term; ?>">
		  <input type="hidden" name="yr" value="<?php echo $year; ?>">
		  <input type="hidden" name="subjectis" value="<?php echo $subject; ?>">
		   <input type="hidden" name="strm" value="<?php echo $stream; ?>">
        </form>
      </div>
    </div>
	 	
				
				</td>
              </tr>
              
              <?php
	  	 // }// end of exam marks
	  	//}//end of getting cat2 marks
	 // }// end of geting  names
	 }// end of geting cat 1 marks
?>

            </tbody>
			</table></td>
        </tr>
      </table>

  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
