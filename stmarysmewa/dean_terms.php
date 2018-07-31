<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Terms Settings page";
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
	<script language="javascript" src="scripts/calendar.js"></script>
</head>
<body>

<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="dean_terms.php">Terms Settings</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  
  
    <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="catsform" method="post">
      <table class="borders" width="100%">
	  
		<tr>
          <td class="alterCell" width="20%">Select Term</td>
          <td class="alterCell3"><select name="term" class="select" required>
		   <option value="" >-TERM-</option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select></td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Select Year</td>
          <td class="alterCell3"><select name="year" class="select" required>
		   <option value="" >-YEAR-</option>
             <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select></td>
        </tr>
		 <tr>
          <td class="alterCell" width="20%">Term Begins On:</td>
          <td class="alterCell3"> <?php
					require_once('classes/tc_calendar.php');
					  $myCalendar = new tc_calendar("date4", true, false);
					  $myCalendar->setIcon("images/iconCalendar.gif");
					  $myCalendar->setDate(date('d'), date('m'), date('Y'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(2050, 2010);
					//  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
					  $myCalendar->setDateFormat('j F Y');
					  $myCalendar->setAlignment('right', 'bottom');
					  $myCalendar->getDate();
					  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
					  //$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
					  //$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
					  $myCalendar->writeScript();
					?></td>
        </tr>
        <tr>
		<td class="alterCell">&nbsp&nbsp;</td>
      <td  class="alterCell2"><input class="btn btn-primary" type="submit" value="Save"/></td>

      </tr>
      </table>
    </form>
    </fieldset>
  </div>
  
  <?php
  
if(isset($_POST['term']) && isset($_POST['year']) ){ 
 
$yr = $_POST['year'];
$term = $_POST['term'];
$begins = isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";

include('includes/dbconnector.php');


	$query="insert into tbl_terms (year,term,begins) 
	values('$yr','$term','$begins') 
	on duplicate key update begins='$begins'";
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Setting has been Successful');</script>";
		echo "<script language=javascript>window.location='dean_terms.php';</script>";
		 }
}
  
  ?>
  
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
