<?php
include('includes/dbconnector.php');
if ($_GET['id']) {

$id = $_GET['id'];

$result = mysql_query("SELECT * from studentdetails where admno='$id'");


if ($result) {
while ($row = mysql_fetch_array($result)) {
$adm=$row['admno'];
$fname=$row['fname'];
$mname=$row['sname'];
$lname=$row['lname'];
$gender=$row['gender'];
$dob=$row['dob'];
$age=$row['age'];
$form=$row['form'];
$class=$row['class'];
$reli=$row['religion'];
$house=$row['house'];
$admnyear=$row['yrofadmn'];
$previous=$row['previouschool'];
$marks=$row['marks'];
$grade=$row['grade'];
$catego=$row['category'];
 }
 
 
}// end of results check

}
 
$res = mysql_query("SELECT * from parentdetails  where admno='$adm'");
$pfname="Not Available";
$pmname="Not Available";
$plname="Not Available";
$paddress="Not Available";
$ptele="Not Available";
$pids="Not Available";
if ($res) {
while ($rows = mysql_fetch_array($res)) {

$pfname=$rows['fname'];
$pmname=$rows['sname'];
$plname=$rows['lname'];
$pids=$rows['idpass'];
$paddress=$rows['address'];
$ptele=$rows['telephone'];


 }
 
 
}// end of results check
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
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset>
    <form  action="saveEditedStudent.php" name="students" method="post" enctype="multipart/form-data">
      <table class="borders" cellpadding="5" cellspacing="0" width="100%">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="4">Editing Student Information 
		  <div style="float:right; margin-right:20px">
		  <table width="150px;"><tr><td align="center"><a href="edit_student.php?id=<?php echo $id?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td><td align="right"><a href="student_list_view.php" title="Previous Page"><i class="icon icon-red icon-undo"></i>Back</a></td></tr></table></div></td>
        </tr>
        <tr>
          <td align="left"><table width="100%">
              <tr>
                <td>First Name:</td>
                <td><input type="text" size="35" name="fname" value="<?php echo $fname; ?>" class="inputFields" /></td>
                <td>Middle Name:</td>
                <td><input type="txt" size="35" name="mname" value="<?php echo $mname; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td>Last Name:</td>
                <td><input type="text" size="35" name="lname" value="<?php echo $lname; ?>" class="inputFields" /></td>
                <td>Gender:</td>
                <td><select name="pick" class="inputFields" />
                  
                  <option value="<?php echo $gender; ?>" ><?php echo $gender; ?> </option>
                  <option value="Male" >Male</option>
                  <option value="female" >Female</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td >D.O.B:</td>
                <td><input type="text" size="25" name="dob" value="<?php echo $dob; ?>" class="inputFields" /></td>
                <td >AGE:</td>
                <td><input type="text" size="25" name="age" value="<?php echo $age; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td >Religion:</td>
                <td><input type="text" size="35" name="reli" value="<?php echo $reli; ?>" class="inputFields" /></td>
                <td >Year Admitted:</td>
                <td><input type="text" size="25" name="yearad" value="<?php echo $admnyear; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td >Previous School:</td>
                <td><input type="text" size="35" name="pschool" value="<?php echo $previous; ?>"class="inputFields" /></td>
              </tr>
              <tr>
                <td >KCPE Marks:</td>
                <td><input type="text" size="25" name="kmarks" value="<?php echo $marks; ?>"class="inputFields" /></td>
                <td >KCPE Grade:</td>
                <td><input type="text" size="25" name="kgrade" value="<?php echo $grade; ?>"class="inputFields" /></td>
              </tr>
              <tr>
                <td >ADM No.:</td>
                <td><input type="text" size="25" name="adm" readonly="readonly" value="<?php echo $adm; ?>" class="inputFields" /></td>
                <td >Form:</td>
                <td><select name="form" class="inputFields" />
                  
                  <option value="<?php echo $form; ?>" ><?php echo $form; ?> </option>
                  <option value="FORM 1" >FORM 1</option>
                  <option value="FORM 2" >FORM 2</option>
                  <option value="FORM 3" >FORM 3</option>
                  <option value="FORM 4" >FORM 4</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td >Stream:</td>
                <td><input type="text" size="25" name="stream" value="<?php echo $class; ?>" class="inputFields" /></td>
                <td >Student Category:</td>
                <td><select name="cate" class="inputFields" />
                  
                  <option value="<?php echo $catego; ?>" ><?php echo $catego; ?> </option>
                  <option value="BOARDING" >BOARDING </option>
                  <option value="DAY" >DAY</option>
                  </select></td>
              </tr>
              <tr>
                <td >House Allocated:</td>
                <td><input type="text" size="35" name="house" value="<?php echo $house; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td colspan="4"><hr /></td>
              </tr>
              <tr>
                <td colspan="4"><div align="center">Parent Details</div>
                  <br /></td>
              </tr>
              <tr>
                <td >First Name:</td>
                <td><input type="text" size="35" name="prfname" value="<?php echo $pfname; ?>" class="inputFields" /></td>
                <td >Middle Name:</td>
                <td><input type="text" size="35" name="pmname" value="<?php echo $pmname; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td >Last Name:</td>
                <td><input type="text" size="35" name="plname" value="<?php echo $plname; ?>" class="inputFields" /></td>
                <td >ID/Passport:</td>
                <td><input type="text" size="35" name="idpass" value="<?php echo $pids; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td >Address:</td>
                <td><input type="text" size="35" name="address" value="<?php echo $paddress; ?>" class="inputFields" /></td>
                <td >Telephone:</td>
                <td><input type="text" size="35" name="telephone" value="<?php echo $ptele; ?>" class="inputFields" /></td>
              </tr>
              <tr>
                <td align="center" colspan="2">
                  <input  class="btn btn-primary" type="submit" value="Save Updated Details" onclick="return validateForm();"></td>
                <td>&nbsp;</td>
                <td align="center"><input  class="btn btn-primary" type="reset" value="Cancel" onclick="window.location='student_list_view.php'" >
                </td>
              </tr>
            </table></td>
          <td valign="top" width="120px" align="right">
            <fieldset style="width:120px; float:right; height:130px;">
            <?php echo "<img src=Image/$adm.jpg width=120 height=130  align=middle  border=0/>"; ?>
            </fieldset>
            <br />
            <input type="file" style="width:150px;" name="userfile" id="file" size="10">
            <br />
            Change Photo <br />
          </td>
        </tr>
      </table>
    </form>
    </fieldset>
  </div>
</div>
</body>
</html>
