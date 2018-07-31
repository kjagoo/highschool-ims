<?php
require_once('auth.php');

	include('includes/dbconnector.php');
	
if (isset($_GET['id'])) {

$id = $_GET['id'];

$result = mysql_query("SELECT * from staff where idpass='$id'");
if ($result) {
while ($row = mysql_fetch_array($result)) {
	$firstn=$row['fname'];
	$midname=$row['mname'];
	$lasname=$row['lname'];
	$idp=$row['idpass'];
	$telephone=$row['telephone'];
	$cate=$row['category'];
	$staffn=$row['staffno'];
	$imgref=$row['imgref'];
	$employement_type=$row['employement_type'];
	$kra_pin=$row['kra_pin'];
	$salary=$row['salary'];
	$address=$row['address'];
	$qualification=$row['qualification'];
 }
  if(!file_exists("Staff/".$imgref)){
  $image1="Staff/blur.png";
  }
else
  {
 $image1 = "Staff/".$imgref;
  }
 
}
}else{
 header("Location: hr_stafflist.php");
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" >
	

String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}


	</script>
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
    <li><a class="active" href="hr_stafflist.php"><i class="icon icon-green icon-contacts"></i>Staff List</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <form  action="saveUpdatedStaff.php" name="students" method="post">
      <table class="borders" cellpadding="5" cellspacing="0" width="100%">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="4">Editing Staff Information: <?php echo $id?>
            <div style="float:right; margin-right:20px">
              <table width="150px;">
                <tr>
                  <td align="center"><a href="hr_editStaff.php?id=<?php echo $id?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
                  <td align="right"><a href="hr_stafflist.php" title="Previous Page"><i class="icon icon-red icon-undo"></i>Back</a></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
           <td align="left"><table width="100%">
              <tr>
                <td><span id="freetext">First Name:</span></td>
                <td><input type="text" size="35" name="fname" class="inputFields" tabindex="1" required autofocus value="<?php echo $firstn; ?>" /></td>
				 <td></td><td rowspan="3" align="right"><img src="<?php echo $image1?>" height="105" width="100" border="1"/></td>
				</tr>
				<tr>
                <td><span id="freetext">Middle Name:</span></td>
                <td><input type="text" size="35" name="mname" class="inputFields" tabindex="2" required value="<?php echo $midname; ?>" /></td>
              </tr>
              <tr>
                <td><span id="freetext">Last Name:</span></td>
                <td><input type="text" size="35" name="lname"class="inputFields" tabindex="3" required value="<?php echo $lasname; ?>" /></td>
				
				</tr>
			<tr>
                <td ><span id="freetext">ID or Passport:</span></td>
                <td><input type="text" readonly="readonly" size="35" name="idpassp" class="inputFields" tabindex="4" required value="<?php echo $id; ?>" style="background:#FFFFCC;" /></td>
				<td>Update Photo</td><td><input type="file" name="userfile" id="file" size="10"></td>
				
              </tr>
              <tr>
               
                <td ><span id="freetext">Staff Category:</span></td>
                <td><select name="cates" class="select" tabindex="6" required>
				 <option value="<?php echo $cate; ?>" ><?php echo $cate; ?></option>
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
                <td><input type="text" size="35" name="staffn" class="inputFields" tabindex="7" required  value="<?php echo $staffn; ?>" /></td>
				</tr>
			<tr>
			 <td ><span id="freetext">Employment Status:</span></td>
                <td><select name="estatus" class="select" tabindex="8" required>
				 <option value="<?php echo $employement_type; ?>" ><?php echo $employement_type; ?></option>
                    <option value="" >-- Select Employment Type --</option>
                    <option value="Contract" >Contract</option>
					<option value="Full-Time" >Full Time</option>
					<option value="Part-Time" >Part Time</option>
					<option value="Permanent" >Permanent</option>
                  </select></td>
				 <td><span id="freetext">KRA PIN NO:</span></td>
                <td><input type="text" size="35" name="pinnumber"class="inputFields" tabindex="10"  required value="<?php echo $kra_pin; ?>" /></td>
              </tr>
			  <tr>
                <td><span id="freetext">Basic Salary:</span></td>
                <td><input type="number" size="35" name="salary"class="inputFields" tabindex="11" placeholder="0.00" required value="<?php echo $salary; ?>"  /></td>
               
              </tr>
			   <tr>
                <td><span id="freetext">Qualifications:</span></td>
                <td><input type="text" size="35" name="qualification"class="inputFields" tabindex="12" required  value="<?php echo $qualification; ?>" /></td>
                <td>Update CV</td><td><input type="file" name="cvfile" id="file" size="13"></td>
              </tr>
			  <tr>
			 
			  </tr>
			  <tr>
			   <td ><span id="freetext">Telephone:</span></td>
                <td><input type="text" size="35" name="tele" class="inputFields" tabindex="14" required  value="<?php echo $telephone; ?>" /></td>
				<td>Address:</td>
				<td><textarea name="address" cols="30" rows="2" tabindex="15"><?php echo $address; ?> </textarea></td>
				</tr>
              <tr>
                <td align="center" colspan="2"><input  class="btn btn-success" type="submit" value="Update Staff Details" onclick="return validateForm();"></td>
                <td align="center"></td>
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
</body>
</html>
