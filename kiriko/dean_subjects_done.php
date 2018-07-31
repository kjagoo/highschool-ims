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
<script language="javascript">
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


	</script>
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
   <li><a href="dean_exam.php">Standard Marks</a></li>
    <li><a href="dean_grading.php">Grade Settings</a></li>
    <li><a class="active" href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a href="dean_position_by.php">Positioning</a></li>
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form id="contact-form" method="get" action="view_subjects_done.php" target="reportView" name="position">
      <table class="tablesorter">
        <tr>
          <td valign="middle">Select Form:</td>
          <td valign="middle"><select name="forms" class="select" tabindex="1" required>
		  <option value="" >-- Select Form --</option>
              <option value="FORM 1" >FORM 1 </option>
              <option value="FORM 2" >FORM 2 </option>
              <option value="FORM 3" >FORM 3 </option>
              <option value="FORM 4" >FORM 4 </option>
            </select>
          </td>
          <td valign="middle">Select Year:</td>
          <td valign="middle"><select name="term" class="select" tabindex="2" required>
		  <option value="" >-- Select Term --</option>
              <option value="1" >Term 1 </option>
              <option value="2" >Term 2 </option>
              <option value="3" >Term 3 </option>
            </select>
          </td>
          <td valign="middle">Select Year:</td>
          <td valign="middle">
		  <select name="years" class="select" tabindex="3" required>
		  <option value="" >-- Select Year --</option>
		  <?php for($i = date('Y'); $i >= 1990; --$i) 
             		 printf('<option value="%d">%d</option>', $i, $i);
   					 ?>
            </select>
          </td>
        </tr>
        <tr>
          <td valign="middle">Subjects Done:</td>
          <td valign="middle"><input type="text" name="subjects" class="inputFields" tabindex="4" required />
          </td>
          <td valign="middle"><input class="btn btn-primary" type="submit" value="Manage"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
    <iframe name="reportView" src="view_subjects_done.php" style="width: 100%; height: 450px;" frameborder="0"></iframe>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
