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
<script language="javascript">
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
    <li><a class="active" href="sms_parents.php">SMS to Parents</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
 <div id="page_tabs_content">
  <form id="contact-form" action="send_sms_to_parents.php" name="sendsms" method="post">
                     <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="2">Send Message To Parents</td>
        </tr>
                        <tr>
                          <td>Send to:</td>
                          <td><select name="to" id="to"  class="select" tabindex="1">
                              <option value="parents">Parents</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Select Form</td>
                          <td><select name="form" id="form"  class="select" tabindex="2" >
                              <option value="select" selected="selected">- Select Form -</option>
                              <option value="FORM 1">Form 1</option>
                              <option value="FORM 2">Form 2</option>
                              <option value="FORM 3">Form 3</option>
                              <option value="FORM 4">Form 4</option>
                            </select>
                            &nbsp;&nbsp;
                            <select name="stream" id="stream" class="select" tabindex="3"/>
                            
                            <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
                            <option value="all">Entire Form</option>
                            </select>
                          </td>
                        </tr>
                        <tr>
                          <td>Message</td>
                          <td><textarea name="message" id="message" cols="50" rows="5" class="textFields" onKeyDown="limitText(this.form.message,this.form.countdown1,160);" 
onKeyUp="limitText(this.form.message,this.form.countdown1,160);" placeholder="Type Message Here" tabindex="4" required autofocus></textarea>
                            <br/>
                          </td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><table width="80%">
                              <tr>
                                <td align="left">Chars
                                  <input readonly type="text" name="countdown1" size="3" value="160"></td>
                                <td align="right"><button class="btn btn-success" type="submit"><i class="icon icon-orange icon-redo"></i> Send Message</button></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                    </form>
 </div><!--end of page tabs content.-->
 </div><!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
