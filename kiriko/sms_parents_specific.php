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
<script>
function getParents(str) {
    if (str == "") {
        document.getElementById("txtList").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtList").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","fetch_Parent_Details.php?q="+str,true);
        xmlhttp.send();
    }
}
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
function selectAll(source) {
		checkboxes = document.getElementsByName('checkbox[]');
		for(var i in checkboxes)
			checkboxes[i].checked = source.checked;
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
    <li><a  href="sms_parents.php">SMS to Specific Parents</a></li>
	 <li><a class="active" href="sms_parents_specific.php">SMS to Specific Parents</a></li>
	
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
 <div id="page_tabs_content">
  <form id="contact-form" action="send_sms_to_specific_parents.php" name="sendsms" method="post">
                     <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="3">Send Message To Parents</td>
        </tr>
		<tr>
		  <td>Select Form</td>
		  <td align='left'><select name="form" id="form"  class="select" tabindex="2" onchange="getParents(this.value)">
			  <option value="select" selected="selected">- Select Form -</option>
			  <option value="FORM 1">Form 1</option>
			  <option value="FORM 2">Form 2</option>
			  <option value="FORM 3">Form 3</option>
			  <option value="FORM 4">Form 4</option>
			</select>
			&nbsp;&nbsp;
			
		  </td>
		  <td rowspan="2" valign='top'>Message<br/><textarea name="message" id="message" cols="60" rows="20" class="textFields" placeholder="Type Message Here" tabindex="4" required autofocus></textarea>
			<br/>
			
		  </td>
		</tr>
		<tr>
		<td colspan="2"><div  id="txtList" style="height:300px;overflow: scroll;"></div></td>
		
		<tr>
		<td></td>
		<td></td>
		<td align="left"><button class="btn btn-success" type="submit" name="delete"><i class="icon icon-orange icon-redo"></i> Send Message</button></td>
	  </tr>
	  </table>
	</form>
 </div><!--end of page tabs content.-->
 </div><!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
