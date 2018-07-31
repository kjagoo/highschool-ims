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
    <li><a class="active" href="dean_exam.php">Standard Marks</a></li>
    <li><a href="dean_grading.php">Grade Settings</a></li>
    <li><a href="dean_subjects_done.php">Subjects Done</a></li>
    <li><a href="dean_position_by.php">Positioning</a></li>
    <li><a href="dean_teachers_initials.php">Teachers Initials</a></li>
    <li><a href="dean_report_forms.php">Report Form Lock</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <?php
  $cat1standard=0;
	$cat2standard=0;
	$examstandard=0;
	$cat1percent=0;
	$cat2percent=0;
	$exampercent=0;
  $getExamstandard = mysql_query("select * from standards ");
	while ($rowstand = mysql_fetch_array($getExamstandard)) {
	$cat1standard=$rowstand['cat1'];
	$cat2standard=$rowstand['cat2'];
	$examstandard=$rowstand['exam'];
	$cat1percent=$rowstand['cat1percent'];
	$cat2percent=$rowstand['cat2percent'];
	$exampercent=$rowstand['exampercent'];
}
  ?>
  
  
    <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="catsform" method="post">
      <table class="borders" width="100%">
	  <tr>
	  <td class="alterCell" width="20%"></td>
	  <td class="alterCell2">EXAM OUT OF:&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;% CONVERSION:</td>
	  </tr>
        <tr>
          <td class="alterCell" width="20%">Openner (Weight):</td>
          <td class="alterCell3" ><input type="text" name="cat1" class="inputFields" tabindex="1" required autofocus  /><input type="text" name="cat1per" class="inputFields" tabindex="1" required   /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Mid-Term (Weight):</td>
          <td class="alterCell3"><input type="text" name="cat2" class="inputFields" tabindex="2" required  /><input type="text" name="cat2per" class="inputFields" tabindex="1" required   /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">End of Term EXAM (Weight):</td>
          <td class="alterCell3"><input type="text" name="exam" class="inputFields" tabindex="3" required /> <input type="text" name="examper" class="inputFields" tabindex="1" required  /></td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Form</td>
          <td class="alterCell3"><select name="form" class="select" required>
		   <option value="" >-Form-</option>
              <option value="1" >FORM 1 </option>
              <option value="2" >FORM 2 </option>
              <option value="3" >FORM 3 </option>
              <option value="4" >FORM 4 </option>
            </select>Term
          <select name="term" class="select" required>
		   <option value="" >-TERM-</option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select>Year<select name="year" class="select" required>
		   <option value="" >-YEAR-</option>
             <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
        </tr>
        <tr>
		<td class="alterCell">&nbsp&nbsp;</td>
      <td><input class="btn btn-primary" type="submit" value="Save Standard Marks"/></td>
	 
      </tr>
      </table>
    </form>
    </fieldset>
	
	<table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Student Information</td>
      </tr>
      <tr>
        <td>
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Form</th>
                <th>Term</th>
				<th>Year</th>
				<th colspan="2">OPENNER</th>
                <th colspan="2">MID-TERM</th>
                <th colspan="2">END OF TERM EXAM </th>
              </tr>
            </thead>
            <tbody>
              <?php
		$num=0;
		$result = mysql_query("select * from standards ");
		while($row = mysql_fetch_array($result)){
		$num++;
	?>
              <tr class='record'>
                <td width="5%"><?php echo $num;?></td>
                <td>FORM <?php echo $row['form'] ?></td>
                <td>TERM <?php echo $row['term'];?></td>
                <td><?php echo $row['year'];?></td>
                <td align="center"><?php echo $row['cat1']?></td><td><?php echo $row['cat1percent'] ?>%</td>
				 <td align="center"><?php echo $row['cat2']?></td><td><?php echo $row['cat2percent'] ?>%</td>
				 <td align="center"><?php echo $row['exam']?></td><td><?php echo $row['exampercent'] ?>%</td>
              </tr>
              <?php
			}
		?>
            </tbody>
          </table></td>
      </tr>
    </table>
	
  </div>
  
  <?php
  
if(isset($_POST['cat1']) && isset($_POST['cat2']) && isset($_POST['exam'])){ 
  $cat1 = $_POST['cat1'];  // Retrieve POST data
$cat2 = $_POST['cat2'];
$exam = $_POST['exam'];
$c1per = $_POST['cat1per'];
$c2per = $_POST['cat2per'];
$examper = $_POST['examper'];
$yr = $_POST['year'];
$term = $_POST['term'];
$form = $_POST['form'];

include('includes/dbconnector.php');
 // Check if selections were made
$total=$cat1+$cat2+$exam;

	$query="insert into standards (cat1,cat2,exam,cat1percent,cat2percent,exampercent,year,term,form) 
	values('$cat1','$cat2','$exam','$c1per','$c2per','$examper','$yr','$term','$form') 
	on duplicate key update cat1='$cat1', cat2='$cat2', exam='$exam' ,cat1percent='$c1per', cat2percent='$c2per', exampercent='$examper' ";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Setting has been Successful');</script>";
		echo "<script language=javascript>window.location='dean_exam.php';</script>";
		 }
}
  
  ?>
  
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
