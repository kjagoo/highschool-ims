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
	 $form=$_GET['id'];
	$term=$_GET['term'];
	$year=$_GET['year'];
	$subje=$_GET['subject'];
	$subject=$_GET['subject'];
	$stream=$_GET['stream'];
	
 }else{
$form=$_POST['cates'];
$term=$_POST['term'];
$year=$_POST['year'];
$subject=$_POST['subjects'];
$stream=$_POST['stream'];
}
$myformis=$form;


if($form==1){
$myform='FORM 1';

}
if($form==2){
$myform='FORM 2';
}
if($form==3){
$myform='FORM 3';
}
if($form==4){
$myform='FORM 4';
}




	if($subject=='English'){
	$subje='english';
	}
	if($subject=='Kiswahili'){
	$subje='kiswahili';
	}
	if($subject=='Maths'){
	$subje='math';
	}
	if($subject=='Biology'){
	$subje='biology';
	}
	if($subject=='Physics'){
	$subje='physics';
	}
	if($subject=='Chemistry'){
	$subje='chemistry';
	}
	if($subject=='History'){
	$subje='history';
	}
	if($subject=='Geography'){
	$subje='geography';
	}
	if($subject=='CRE'){
	$subje='cre';
	}
	if($subject=='Agriculture'){
	$subje='agriculture';
	}
	if($subject=='B/Studies'){
	$subje='bstudies';
	}




// run the query and store the results in the $result variable.



//if ($result) {
  // create a new form and then put the results
  // in to a table.
  ?>
   <div class="clear"></div>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'><u>Managing Mock <font style="color:#FF0000;"><?php echo $subject?></font> Marks&nbsp;&nbsp;Term <?php echo $term?> &nbsp;&nbsp;Year <?php echo $year?>&nbsp;&nbsp; <?php echo $myform?></u>
		  
		  <div style="float:right; margin-right:5px;">
		  <table width="150px"><tr><td align="left"><a href="manage_mock_marks.php?id=<?php echo $form;?>&term=<?php echo $term;?>&year=<?php echo $year;?>&subject=<?php echo $subject;?>&stream=<?php echo $stream;?>">refresh<i class="icon icon-green icon-refresh"></i></a></td><td align="right"><a href="marks_manage.php">close<i class="icon icon-red icon-close"></i></a></td></tr></table></div>
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
                <th align='righ't>Paper 1</th>
                <th align='right'>Paper 2</th>
                <th align='right'>Paper 3</th>
              </tr>
			</thead>
             <tbody>
              <?php	
	
	$num=0;
	$sub=0;
	
	$ads = "SELECT admno FROM studentdetails where form='$myform' and class='$stream'";//admno query
	$resultad = mysql_query($ads);
	while ($rowad = mysql_fetch_array($resultad)) {// get admno
	$num++;
	$admno=$rowad['admno'];
	
	$getnames = "SELECT fname,sname,lname from studentdetails where admno='$admno'";// get names
	$result3 = mysql_query($getnames);
	while ($row2 = mysql_fetch_array($result3)) {// get names
	$fname=$row2['fname'];
	$mname=$row2['sname'];
	$lasname=$row2['lname'];
	
	}
	
	$paper1=0;
	$paper2=0;
	$paper3=0;
	
	$subject1=$subject."1";
	$subject2=$subject."2";
	$subject3=$subject."3";
	
	$exam = "SELECT $subject1,$subject2,$subject3 FROM mockexams where form='$form' and term='$term' 
	and year='$year' and admno='$admno'";// exam query
	$result4 = mysql_query($exam);
	while ($row4 = mysql_fetch_array($result4)) {// get exam marks
	$paper1=$row4[$subject1];
	$paper2=$row4[$subject2];
	$paper3=$row4[$subject3];
	}
	?>
	  <tr>
	  <td><?php echo $num?></td>
		<td><?php echo $admno?></td> 
		<td><?php echo $fname." ".$mname." ".$lasname?></td>
	   <td align='right' bgcolor='#E4FAFC'><font style="color:#FF0000;"><?php echo $paper1?></font></td>
	   <td align='right' bgcolor='#E4FAFC'><font style="color:#FF0000"><?php echo $paper2?></font></td>
	   <td align='right' bgcolor='#E4FAFC'><font style="color:#FF0000"><?php echo $paper3?></font></td>
	  	<td align='right' width='15%'>
		<a href="#openModal<?php echo $num?>" title="Click to Edit Marks"><i class="icon icon-blue icon-edit"></i>&nbsp; Edit</a>
		<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="updateMockMarks.php" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Editing Mock Marks <?php echo $admno?></font></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%"><b>PAPER 1:</b></td>
              <td class="alterCell2"><input type="text" name="c1" class="inputFields" autofocus required  tabindex="1" value="<?php echo $paper1 ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>PAPER 2:</b></td>
              <td class="alterCell2"><input type="text" name="c2" class="inputFields" autofocus required  tabindex="2" value="<?php echo $paper2 ?>"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>PAPER 3:</b></td>
              <td class="alterCell2"><input type="text" name="ex" class="inputFields" autofocus required  tabindex="3" value="<?php echo $paper3 ?>"/></td>
            </tr>
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
		  <input type="hidden" name="id" value="<?php echo $admno; ?>">
		  <input type="hidden" name="frm" value="<?php echo $form; ?>">
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
</table>
</fieldset>
   
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->

</body>
</html>
