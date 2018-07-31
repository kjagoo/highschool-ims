<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$userid=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
$username=$_SESSION['SESS_NAME_'];

$query="SELECT * FROM staff where idpass='$userid'";
	$result = @mysql_query($query);
	while ($row = mysql_fetch_array($result)) {
	$fname=$row['fname'];
	$mname=$row['mname'];
	$lname=$row['lname'];
	$tele=$row['telephone'];
	$staffno=$row['staffno'];
	$dated=$row['dateJoined'];
	$oldpas=$row['passwrd'];
			
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet' />
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
<!-- Initiate tablesorter script -->
<script language='JavaScript'>
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function showCustom(){
var selected=document.getElementById("types").value;

if(selected=='others'){
	document.getElementById('other_no').style.display = "block";

}else{
	document.getElementById('other_no').style.display = "none";

}
}

</script>
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

<div id="page_tabs">
  <ul>
    <li><a  class="active" href="sms_group.php">SMS to Imported Contacts</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <table width="100%">
      <tr>
        <td><form id="sms" name="sms" method="post" action="send_sms_UnregGroup.php">
            <table class="borders" cellpadding="5" cellspacing="0">
              <tr style="height:30px;">
                <td class="dataListHeader" colspan="2">Select Imported Contact Group</td>
              </tr>
              <tr>
                <td align="right">Recipient:</td>
                <td align="left"><select name="unreg_group" id="unreg_group" class="inputFields" required>
                    <option value="">Select Group</option>
                    <?php
	include('includes/dbconnector.php');
	$query=("select distinct(group_name) from contacts_groups ");
	$result=mysql_query($query);
	
	while($row=mysql_fetch_array($result)){
	echo "<OPTION VALUE=".$row['group_name'].">".str_replace("_"," ",$row['group_name'])."</OPTION>"; 
	
 }
?>
                  </select>
                </td>
              </tr>
              <tr>
                <td align="right">Message:</td>
                <td align="left"><textarea name="message" id="message" cols="40" rows="5" class="inputFields_message" onKeyDown="limitText(this.form.message,this.form.countdown1,320);" 
onKeyUp="limitText(this.form.message,this.form.countdown1,320);" required></textarea>
                  <br/>
                  Chars
                  <input readonly type="text" name="countdown1" size="3" value="320">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="right"><button class="btn btn-success" type="submit"><i class="icon icon-orange icon-redo"></i> Send Message</button></td>
              </tr>
            </table>
          </form></td>
        <td id="horizontal_line">&nbsp;</td>
        <td width="40%" align="center" valign="top"><form name="feedback_form" method="post" action="sms_import_contacts.php" enctype="multipart/form-data" onSubmit="return validateForm();">
            <table class="borders" cellpadding="5" cellspacing="0">
              <tr style="height:30px;">
                <td class="dataListHeader" colspan="2">Import Contacts List</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>Import Contacts</td>
                <td valign="top"><input type="file" name="cover_image" id="file" size="10">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center"><input type="submit" name="save" value="Upload and Send" class="button_ black" />
                </td>
              </tr>
            </table>
          </form>
          Only .csv or xls Files are allowed. </td>
      </tr>
    </table>
  </div>
  <!--end of page tabs content.-->
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
