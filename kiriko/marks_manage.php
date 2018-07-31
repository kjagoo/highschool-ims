<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Manage Marks Window ";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href="css/tablesorter_ordinary.css"  type="text/css" rel="stylesheet" >
<script type="text/javascript" src="js/jquery.min_vtab.js"></script>
<script type="text/javascript" src="js/script_vtab.js"></script>
<link rel="stylesheet" href="css/styles_vtab.css" />

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


function changeDisplay(){
var selected=document.getElementById("types").value;
if(selected=='general'){
	document.getElementById('individual').style.display = "block";
	document.getElementById('groups').style.display = "none";
}
if(selected=='mocks'){
	document.getElementById('individual').style.display = "none";
	document.getElementById('groups').style.display = "block";
}
if(selected=='select'){
	document.getElementById('individual').style.display = "none";
	document.getElementById('groups').style.display = "none";
}
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

 <div class="wrapper">
      <div id="v-nav">
        <ul>
          <li tab="tab1" class="first current">General Exams</li>
          <li tab="tab4" class="last">Mock Exams</li>
        </ul>
		
		<div class="tab-content">
		<form action="manage_student_marks.php" name="marksform" method="post">
       <table class="borders" width="100%">
         
          <tr>
            <td  class="alterCell" width="20%"><strong>Select Form:</strong></td>
            <td  class="alterCell3"><select name="cates" id="inputMarks" class="select" required>
			<option value="" >-- Select Form --</option>
                <?php
		 			if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryf=("select distinct (form) from initials order by form asc");
				 }else{
		 			  	$queryf=("select distinct (form) from initials where fullname='$username' order by form asc");
				 }

						$resultf=mysql_query($queryf) ;

						while($rowf=mysql_fetch_array($resultf)){

						echo "<OPTION VALUE=".str_replace(" ","_",$rowf['form']).">".$rowf['form']."</OPTION>"; 
						}
					?>
              </select>
            <select name="stream" id="select" class="select" required>
			<option value="" selected="selected">-- Select Class --</option>
               <?php
		 			  if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryst=("select distinct (stream) from initials order by form asc");
				 }else{
		 			  	$queryst=("select distinct (stream) from initials where fullname='$username' order by form asc");
				 }

						$resultst=mysql_query($queryst) ;

						while($rowst=mysql_fetch_array($resultst)){

						echo "<OPTION VALUE=".$rowst['stream'].">".$rowst['stream']."</OPTION>"; 
						}
					?>
              </select></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><strong>Select Term:</strong></td>
            <td class="alterCell3"><select name="term" id="inputMarks" class="select" required>
			<option value="" >-- Select Term --</option>
                <option value="1" >TERM 1 </option>
                <option value="2" >TERM 2 </option>
                <option value="3" >TERM 3 </option>
              </select>
            </td>
		</tr>
		<tr>
            <td class="alterCell" width="20%"><strong>Select Year:</strong></td>
            <td class="alterCell3"><select name="year" id="inputMarks" class="select" required>
			<option value="" selected="selected">-- Select Year --</option>
			<?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
              </select>
            </td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><strong>Select Subject:</strong></td>
            <td class="alterCell3"><select name="subjects" id="inputMarks" class="select" required>
			<option value="" >-- Select Subject --</option>
        		<?php
				 if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $querys=("select distinct (subject) from initials");
				 }else{
		 			  	$querys=("select distinct (subject) from initials where fullname='$username' ");
				 }
						$results=mysql_query($querys) ;

						while($rows=mysql_fetch_array($results)){

						echo "<OPTION VALUE=".$rows['subject'].">".$rows['subject']."</OPTION>"; 
						}
					?>
              </select>
            </td>
          </tr>
          <tr>
		  <td class="alterCell" width="20%"></td>
            <td class="alterCell2" align="center"><input class="btn btn-primary" type="submit" value="Manage Marks"/></td>
            
          </tr>
        </table>
      </form>
		</div>
		
		<div class="tab-content">
		
		<form action="manage_mock_marks.php" name="marksform" method="post">
        <table class="borders" width="100%">
          <tr>
            <td class="alterCell" width="20%"><strong>Select Form:</strong></td>
            <td class="alterCell3"><select name="cates" class="select" required>
			<option value="" >-- Select Form --</option>
               <?php
		 			if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryf=("select distinct (form) from initials");
				 }else{
		 			  	$queryf=("select distinct (form) from initials where fullname='$username' ");
				 }

						$resultf=mysql_query($queryf) ;

						while($rowf=mysql_fetch_array($resultf)){

						echo "<OPTION VALUE=".str_replace(" ","_",$rowf['form']).">".$rowf['form']."</OPTION>"; 
						}
					?>
              </select>
            <select name="stream" id="select" required class="select">
			<option value="" >-- Select Stream --</option>
               <?php
		 			  if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $queryst=("select distinct (stream) from initials");
				 }else{
		 			  	$queryst=("select distinct (stream) from initials where fullname='$username' ");
				 }

						$resultst=mysql_query($queryst) ;

						while($rowst=mysql_fetch_array($resultst)){

						echo "<OPTION VALUE=".$rowst['stream'].">".$rowst['stream']."</OPTION>"; 
						}
					?>
              </select></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><strong>Select Term:</strong></td>
            <td class="alterCell3"><select name="term" class="select" required>
			<option value="" >-- Select Term --</option>
                <option value="1" >TERM 1 </option>
                <option value="2" >TERM 2 </option>
                <option value="3" >TERM 3 </option>
              </select>
            </td>
			</tr>
			<tr>
            <td class="alterCell" width="20%"><strong>Select Year:</strong></td>
            <td class="alterCell3"><select name="year" class="select" required>
			<option value="" selected="selected">-- Select Year --</option>
			<?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
              </select>
            </td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><strong>Select Subject:</strong></td>
            <td vaclass="alterCell3"><select name="subjects" class="select" required>
			<option value="" >-- Select Subject --</option>
       			<option value="ENGLISH" >101-ENGLISH </option>
                  <?php
				 if($_SESSION['SESS_CATEGORY_']=='Administrator' || $_SESSION['SESS_CATEGORY_']=='Dean'){
					 $querys=("select distinct (subject) from initials");
				 }else{
		 			  	$querys=("select distinct (subject) from initials where fullname='$username' ");
				 }
						$results=mysql_query($querys) ;

						while($rows=mysql_fetch_array($results)){

						echo "<OPTION VALUE=".$rows['subject'].">".$rows['subject']."</OPTION>"; 
						}
					?>
              </select>
            </td>
           
          </tr>
          <tr>
		  <td class="alterCell" width="20%"></td>
           <td class="alterCell2" align="center"><input class="btn btn-primary" type="submit" value="Manage Marks"/></td>
          </tr>
        </table>
      </form>
		</div>
		
		
	</div>
</div>



</div> 
</div>
<!--end of display area. 
This area changes when a user searches for an item-->

</body>
</html>
