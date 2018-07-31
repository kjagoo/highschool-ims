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
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>
<div id="blocker">
  <div><img src="images/loading.gif" />Loading...</div>
</div>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="students_promote.php">Promote Students</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader" colspan="3">Promote Students</td>
      </tr>
      <tr>
	  <td><img src="images/dialog_warning.png" /></td>
        <td><strong>By Pressing Continue<br />
          All students will be Promoted to the Next Level<br />
          That is:<br />
          Form 1===>Form 2<br />
          Form 2===>Form 3<br />
		  Form 3===>Form 4<br />
          Form 4===>Alumini (Awaiting Clearance)</strong></td>
        <td valign="middle" align="left">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" name="lock" method="post">
          <input class="btn btn-warning" type="submit" name="submit" value="Continue"  />
		  </form></td>
      </tr>
    </table>
	<?php
	if(isset($_POST['submit'])){
	$curr_year=date('Y');
	mysql_query("update studentdetails set form='FORM 5',age=age+1, year_finished='$curr_year' where form = 'FORM 4'")or die(mysql_error()); 

	mysql_query("update studentdetails set form='FORM 4',age=age+1 where form = 'FORM 3'")or die(mysql_error()); 
 
	mysql_query("update studentdetails set form='FORM 3',age=age+1 where form = 'FORM 2'")or die(mysql_error()); 
 
 	mysql_query("update studentdetails set form='FORM 2',age=age+1 where form = 'FORM 1'")or die(mysql_error());
	
	include 'includes/functions.php';
	$func = new Functions();
	$activity = "Promoted Students";
	$func->addAuditTrail($activity,$username);

		 ?>
		<script language=javascript>alert('Promotion is Successfull');</script>
		<script language=javascript>window.location='student_list.php';</script>
	<?php
	
	}
	?>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
