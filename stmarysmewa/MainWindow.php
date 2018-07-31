<?php 
require_once("includes/dbconnector.php");  
require_once('auth.php');


$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
	
	$schoolname="-";
	$address=" -";
	//$plac="-";
	$tele="-";
	$email="-";
    $result = mysql_query("SELECT * FROM schoolname");

    while ($row = mysql_fetch_array($result)) {
	$schoolname=$row['schname'];
	$address=$row['box']." ". $row['place'];
	$tele=$row['telphone'];
	}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>

    <title>SMS: | <?php echo ucfirst($schoolname)?></title>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8"/>
   <link href="css/<?php echo $_SESSION['THEME'];?>.css" type="text/css" rel="stylesheet">
	<link href="images/log.png" rel="shortcut icon" type="image/x-icon" />
	
</head>
<frameset rows="90,*,33" frameborder="0" border="0" framespacing="0">
 <frame name="topNav" src="header.php">
  <frame name="main" src="main.php" marginheight="0" marginwidth="0" scrolling="auto" noresize>
   <frame name="footer" scrolling="auto" noresize src="footer.php">
</frameset><noframes></noframes>


</html>