<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Deans Exams Settings page";
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
  <li><a href="dean_exam_papers.php">Exam Papers</a></li>
     <!--<li><a href="dean_exam.php">Standard Marks</a></li>-->
    <li><a class="active" href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <!--<li><a href="dean_position_by.php">Positioning</a></li>-->
	
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
  <a href="#openModal" title="Click to Add Grades" class="btn btn-primary noline"><i class="icon icon-blue icon-plus"></i>&nbsp; Set Grades</a></fieldset>
  <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
    <form id="contact-form" action="save_Grading.php" name="catsform" method="post">
     <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp; <font color="#FFFFFF">Grades Setting</font></td>
            </tr>
        <tr>
          <td class="alterCell" width="20%">Select Subject</td>
          <td class="alterCell3" ><select name="subs" class="select" tabindex="1" required>
		  <option value="">-Select Subject- </option>
              <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-SCIENCE</option>
                  <option value="CRE" >313-SOCIAL</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
            </select>
			<select name="form" class="select" tabindex="2" required>
		  <option value="">-Select Class- </option>
             <option value="1-2">Form 1 & 2</option>
			 <option value="3-4">Form 3 & 4</option>
            </select></td>
        </tr>
       <tr>
	   <td class="alterCell" width="20%">Select Grade</td>
	 	<td class="alterCell3" > 
	 		<select name="grades" class="select" tabindex="3" required>
	 		<option value="">-Select Grade- </option>
              <option value="E">E</option>
              <option value="D-">D-</option>
              <option value="D">D</option>
              <option value="D+">D+</option>
			  <option value="C-">C-</option>
			  <option value="C">C</option>
			  <option value="C+">C+</option>
			  <option value="B-">B-</option>
			  <option value="B">B</option>
			  <option value="B+">B+</option>
			  <option value="A-">A-</option>
			  <option value="A">A</option>
            </select> 
			
			</td>
		</tr>
        <tr>
          <td class="alterCell" width="20%">Minimum:</td>
          <td class="alterCell3" ><input type="text" name="min" class="inputFields" tabindex="5" required autofocus /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Maximum</td>
          <td class="alterCell3"><input type="text" name="max" class="inputFields" tabindex="6" required /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Points</td>
          <td class="alterCell3"><input type="text" name="points" class="inputFields" tabindex="7" required /> </td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Remarks</td>
          <td class="alterCell3"><input type="text" name="remarks" class="inputFields" tabindex="8" required /> </td>
        </tr>
        
        <tr>
          <td class="alterCell">&nbsp&nbsp;</td>
          <td  class="alterCell2"><input class="btn btn-primary" type="submit" value="Save Settings"/></td>
        </tr>
      </table>
    </form>
    </div>
    </div>
	
	<iframe name="reportView" src="grades_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
  </div>
</div>
<!--end of display area-->

</body>
</html>
