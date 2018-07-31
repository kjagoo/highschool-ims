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
<link href='css/opa-icons.css' rel='stylesheet'>

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
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript">

 function searchFunction(str)
    {
    if (str=="")
    {
    document.getElementById("display_Area").innerHTML="";
    return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display_Area").innerHTML=xmlhttp.responseText;
    }
    }
    xmlhttp.open("GET","getFileDetailsSearch.php?q="+str,true);
    xmlhttp.send();
    }
	
	



	</script>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>
<div id="page_tabs">
  <ul>
    <li><a class="active"  href="hr_newstaff.php"><i class="icon icon-green icon-plus"></i>New Staff</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
   
    <form id="contact-form"  action="save_NewStaff.php" name="students" method="post"  enctype="multipart/form-data">
      <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader">New Staff Information</td>
        </tr>
		<tr>
        <td>
		<table width="100%">
        <tr>
          <td align="left"><table width="100%">
              <tr>
                <td><span id="freetext">First Name:</span></td>
                <td><input type="text" size="35" name="fname" class="inputFields" tabindex="1" required autofocus /></td>
                <td><span id="freetext">Middle Name:</span></td>
                <td><input type="text" size="35" name="mname" class="inputFields" tabindex="2" required/></td>
              </tr>
              <tr>
                <td><span id="freetext">Last Name:</span></td>
                <td><input type="text" size="35" name="lname"class="inputFields" tabindex="3" required  /></td>
				 <td>Staff Photo</td><td><input type="file" name="userfile" id="file" size="10"></td>
				</tr>
			<tr>
                <td ><span id="freetext">ID or Passport:</span></td>
                <td><input type="text" size="35" name="idpassp" class="inputFields" tabindex="4" required  /></td>
				
              </tr>
              <tr>
               
                <td ><span id="freetext">Staff Category:</span></td>
                <td><select name="cates" class="select" tabindex="6" required>
				 <option value="" >-- Select Staff Category --</option>
                    <option value="Administrator" >Head Teacher </option>
                    <option value="Government Teacher" >Government Teacher </option>
                    <option value="Board Teacher" >Board Teacher</option>
					<option value="Dean" >Dean of Studies</option>
                    <option value="Accountant" >Accountant</option>
                    <option value="Secretary" >Secretary</option>
                    <option value="Non-Teacher" >Non-Teacher</option>
                  </select></td>
              
                <td ><span id="freetext">Staff No:</span></td>
                <td><input type="text" size="35" name="staffn" class="inputFields" tabindex="7" required  /></td>
				</tr>
			<tr>
			 <td ><span id="freetext">Employment Status:</span></td>
                <td><select name="estatus" class="select" tabindex="8" required>
                    <option value="" >-- Select Employment Type --</option>
                    <option value="Contract" >Contract</option>
					<option value="Full-Time" >Full Time</option>
					<option value="Part-Time" >Part Time</option>
					<option value="Permanent" >Permanent</option>
                  </select></td>
				 <td><span id="freetext">KRA PIN NO:</span></td>
                <td><input type="text" size="35" name="pinnumber"class="inputFields" tabindex="10"  required  /></td>
              </tr>
			  <tr>
                <td><span id="freetext">Basic Salary:</span></td>
                <td><input type="number" size="35" name="salary"class="inputFields" tabindex="11" placeholder="0.00" required  /></td>
               
              </tr>
			   <tr>
                <td><span id="freetext">Qualifications:</span></td>
                <td><input type="text" size="35" name="qualification"class="inputFields" tabindex="12" required  /></td>
                <td>Upload CV</td><td><input type="file" name="cvfile" id="file" size="13"></td>
              </tr>
			  <tr>
			 
			  </tr>
			  <tr>
			   <td ><span id="freetext">Telephone:</span></td>
                <td><input type="text" size="35" name="tele" class="inputFields" tabindex="14" required  /></td>
				<td>Address:</td>
				<td><textarea name="address" cols="30" rows="2" tabindex="15"></textarea></td>
				</tr>
              <tr>
                <td align="center" colspan="2"><input  class="btn btn-primary" type="submit" value="Save Staff Details" onclick="return validateForm();"></td>
                <td align="center"><input  class="btn btn-primary" type="reset" value="Cancel" onclick="window.location='hr_newstaff.php'" >
                </td>
                <td >&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
	 </td>
	</tr>
</table>
    </form>

  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
