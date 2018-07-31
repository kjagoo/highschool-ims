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

 function validateForm() {
var strea=document.forms["marksform"]["initials"].value;

if (strea==null || strea=="")
  {
  alert("Provide Teachers Initials");
 document.forms["marksform"]["initials"].focus();
  
  return false;
  } 
  }
function loading(){
document.forms["catsform"]["cat1"].focus();
}  

	</script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a href="dean_exam.php">Standard Marks</a></li>
    <li><a href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a  href="dean_position_by.php">Positioning</a></li>
    <li><a class="active" href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  
    <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="marksform" method="post">
      <table class="borders" width="100%">
        <tr>
		<td class="alterCell" width="20%">Select Teacher:</td>
          <td class="alterCell3" ><select name="teacher" class="select" tabindex="1" required>
		  <option value="" >-- Select Teacher --</option>
              <?php
				include('includes/dbconnector.php');
				$querys=("select * from staff ");

				$results=mysql_query($querys) ;

				while($rows=mysql_fetch_array($results)){
				$Fname=$rows['fname'];
				$Fname2=$rows['mname'];
				$Fname3=$rows['lname'];
				$full=$Fname.'&nbsp;'.$Fname2.'&nbsp;'.$Fname3;

				echo "
				<OPTION VALUE=".$full.">".$full."</OPTION>"; }?>
            </select>
          </td>
		 </tr>
		 <tr>
		 <td class="alterCell" width="20%">Select Form:</td>
          <td  class="alterCell3"><select name="frms"  class="select" tabindex="2" required>
		  <option value="" >-- Select Form --</option>
              <option value="FORM 1" >FORM 1 </option>
              <option value="FORM 2" >FORM 2 </option>
              <option value="FORM 3" >FORM 3 </option>
              <option value="FORM 4" >FORM 4 </option>
            </select>
          
         <select name="stream"  class="select" >
		 <option value="" >-- Select Stream --</option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select></td>
		</tr>
		<tr>
		<td class="alterCell" width="20%">Select Subject:</td>
          <td  class="alterCell3"><select name="subjects"  class="select" tabindex="3" required>
		  <option value="" >-- Select Subject --</option>
              <option value="English" >English </option>
              <option value="Kiswahili" >Kiswahili </option>
              <option value="Math" >Math </option>
              <option value="Biology" >Biology </option>
              <option value="Physics" >Physics </option>
              <option value="Chemistry" >Chemistry </option>
              <option value="History" >History </option>
              <option value="Geography" >Geography </option>
              <option value="CRE" >C.R.E </option>
              <option value="Agriculture" >Agriculture </option>
              <option value="bstudies" >B/Studies </option>
            </select>
          </td>
		 </tr>
		 <tr>
		 <td class="alterCell" width="20%" valign="middle">Enter  Initials:</td>
          <td   class="alterCell3"><input type="text" name="initials" class="inputFields" tabindex="4" required autofocus/></td>
		 </tr>
		 <tr>
		 <td class="alterCell" width="20%"></td>
          <td class="alterCell2"><input class="btn btn-primary" type="submit" value="Save Initials" /></td>
        </tr>
      </table>
    </form>
	
	
<?php

if(isset($_POST['initials']) && isset($_POST['subjects']) && isset($_POST['stream']) && isset($_POST['frms']) && isset($_POST['teacher']) ){
	include('includes/dbconnector.php');
	$teacher = $_POST['teacher'];  // Retrieve POST data
$form = $_POST['frms'];
$stream = $_POST['stream'];
$subjects = $_POST['subjects'];
$initials = $_POST['initials'];
$query="insert into initials (fullname,form,stream,subject,initials) 
	values('$teacher','$form','$stream','$subjects','$initials') 
	on duplicate key update initials='$initials'";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Initials saved Successfully');</script>";
		echo "<script language=javascript>window.location='dean_teachers_initials.php';</script>";
		 }

}
?>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
