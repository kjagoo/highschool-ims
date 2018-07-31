<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Message Settings page";
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
<?php

	 	$apiurl="";
		$ekey="";
		$senderid="";
		$pass="";
	$qry="select * from messages_settings";
	 $result = mysql_query($qry);
	 $count=mysql_num_rows($result);
	 while ($row = mysql_fetch_array($result)) {
	    $apiurl=$row['api_url'];
		$ekey=$row['ekey'];
		$senderid=$row['senderid'];
		$pass=$row['passwrd'];
	}

?>
  
    <form id="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="msgsets" method="post">
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">Messages Settings</td>
        </tr>
		<tr>
		<td>
	  <table class="borders" width="100%">
        <tr>
          <td class="alterCell" width="20%">API URL</td>
          <td class="alterCell3" ><input type="text" name="apiurl" class="inputFields" tabindex="1" required autofocus value="<?php echo $apiurl?>" /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Encryption KEY</td>
          <td class="alterCell3"><input type="text" name="key" class="inputFields" tabindex="2" required value="<?php echo $ekey?>"/></td>
		  <td rowspan="3"><img src="images/airtouch.png" alt="Air Touch Ltd" align="right" /></td>
        </tr>
        <tr>
          <td class="alterCell" width="20%">Sender ID</td>
          <td class="alterCell3"><input type="text" name="sid" class="inputFields" tabindex="3" required value="<?php echo $senderid?>"/> </td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">API Password</td>
          <td class="alterCell3"><input type="text" name="pass" class="inputFields" tabindex="3" required value="<?php echo $pass?>"/> </td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Messages Length</td>
          <td class="alterCell3"><input type="text" disabled="disabled" class="inputFields" tabindex="3" required value="160"/> </td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Notify the following when SMS is Sent</td>
          <td class="alterCell3"><input type="text" name='no1' class="inputFields" tabindex="3" required placeholder="07...."/> </td>
        </tr>
		<tr>
          <td class="alterCell" width="20%">Notify the following when SMS is Sent</td>
          <td class="alterCell3"><input type="text" name='no2' class="inputFields" tabindex="3" required placeholder="07...."/> </td>
        </tr>
		
        <tr>
		<td class="alterCell">&nbsp&nbsp;</td>
      <td  class="alterCell2"><input class="btn btn-success" type="submit" value="Save Settings"/></td>
      </tr>
      </table>
	  </td>
	 </tr>
	</table>
	<input type="hidden" name="count" class="inputFields" tabindex="3" required value="<?php echo $count?>"/>
    </form>
<?php
if(isset($_POST['apiurl']) && isset($_POST['key'])&& isset($_POST['sid']) && isset($_POST['pass']) ){ 
$api = $_POST['apiurl'];  // Retrieve POST data
$key = $_POST['key'];
$sid = $_POST['sid'];
$passw= $_POST['pass'];
$count = $_POST['count'];

$no1 = $_POST['no1'];
$no2 = $_POST['no2'];

include('includes/dbconnector.php');
// Check if selections were made
if($count==0){
$query="insert into messages_settings (api_url,ekey,senderid,passwrd,notify1,notify2) 
	values('$api','$key','$sid','$passw','$no1','$no1') 
	on duplicate key update api_url='$api', ekey='$key', senderid='$sid',passwrd='$passw', notify1='$no1',notify2='$no2'";
}else{
	$query=" update messages_settings set api_url='$api', ekey='$key', senderid='$sid',passwrd='$passw', notify1='$no1',notify2='$no2'";
}
	
	 $result = mysql_query($query);

		if (!$result) {
		die('Invalid query: ' . mysql_error());
   		 }else{
		echo "<script language=javascript>alert('Messages Settings Successful');</script>";
		echo "<script language=javascript>window.location='communication_setting.php';</script>";
	 }
}
?>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
