<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Deans Exams Grade Settings page";
$func->addAuditTrail($activity,$username);
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

	</script>
</head>
<body>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a href="dean_exam.php">Standard Marks</a></li>
    <li><a class="active" href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a href="dean_position_by.php">Positioning</a></li>
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
  <form id="contact-form" action="dean_edit_grades.php" name="catsform" method="post">
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Grades Setting</font></td>
            </tr>
        <tr>
          <td class="alterCell" width="20%">Select Subject</td>
          <td class="alterCell3" ><select name="subject" class="select" tabindex="1" required>
		  <option value="">-Select Subject- </option>
              <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATHS" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
                  <option value="B/STUDIES" >565-B/STUDIES</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
            </select>
			<select name="form" class="select" tabindex="2" required>
		  <option value="">-Select Form- </option>
		 	 <option value="1-2" >FORM 1 & Form 2</option>
			 <option value="3-4" >FORM 3 & Form 4</option>
              
            </select></td>
        </tr>
      
        
      </table>
    <input name="h" type="submit" class="btn btn-primary" value="Edit Grading Scheme"/>
	</form>
 
  
    </div></fieldset> 
	
	<iframe name="reportView" src="grades_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
  </div>
</div>
<!--end of display area-->

</body>
</html>
