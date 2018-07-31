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
<link href='css/opa-icons.css' rel='stylesheet'/>
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

</head>
<body>
 <form  id="contact-form" action="saveStudent.php" name="students" method="post" enctype="multipart/form-data">
      
	 <table class="borders" cellpadding="5" cellspacing="0">
        <tr style="height:30px;">
          <td class="dataListHeader" colspan="4">New Student Information
		  <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="student_addnew.php" class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            
          </tr>
        </table>
      </div>
		  
		  </td>
        </tr>
	   
		  <tr>
		   <td >Admission No.:</td>
            <td><input type="text" size="25" name="adm" class="inputFields" tabindex="1" required autofocus/></td>
			<td>Student Photo</td><td><input type="file" name="userfile" id="file" size="10"></td>
			</tr>
          <tr>
            <td>First Name:</td>
            <td><input type="text" size="35" name="fname" class="inputFields" tabindex="2" required  /></td>
            <td>Middle Name:</td>
            <td><input type="text" size="35" name="mname" class="inputFields" tabindex="3" required  /></td>
          </tr>
          <tr>
            <td>Last Name:</td>
            <td><input type="text" size="35" name="lname" class="inputFields" tabindex="4" required  /></td>
            <td>Gender:</td>
            <td>
			<select name="pick" id="pick" class="select" tabindex="5" required/>
              <option value="Female" >Female</option>
              </select>
            </td>
          </tr>
          <tr>
            <td >Year of Birth</td>
            <td>
			<input type="text" size="35" name="yob" class="inputFields" tabindex="6" required  />
			
			</td>
            <td >Age:</td>
            <td><input type="number" size="25" name="age" class="inputFields" tabindex="7"  /></td>
          </tr>
          <tr>
            <td >Religion:</td>
            <td><input type="text" size="35" name="reli" class="inputFields" tabindex="8" required  /></td>
            <td >Date of Admission:</td>
            <td><input type="text" size="35" name="yearad" class="inputFields" tabindex="9" required  /></td>
          </tr>
          <tr>
            <td >Previous School:</td>
            <td><input type="text" size="35" name="pschool" class="inputFields" tabindex="10" required autofocus/></td>
          </tr>
          <tr>
            <td >KCPE Marks:</td>
            <td><input type="number" size="25" name="kmarks" class="inputFields" tabindex="11" required /></td>
            <td >KCPE Grade:</td>
            <td><input type="text" size="25" name="kgrade" class="inputFields" tabindex="12" required /></td>
          </tr>
          <tr>
           
            <td >Form Admitted In:</td>
            <td><select name="form" class="select" tabindex="13" required>
               <option value="" >--Select Form-- </option>
              <option value="FORM 1" >Form 1 </option>
              <option value="FORM 2" >Form 2</option>
              <option value="FORM 3" >Form 3</option>
              <option value="FORM 4" >Form 4</option>
			    <option value="FORM 5" >Allumni</option>
              </select>
            <!--</td>
          </tr>
          <tr>
            <td>Stream:</td>
            <td align="left">-->
			&nbsp;&nbsp;
              <select name="stream" class="select" tabindex="14" required>
               <option value="" >--Stream-- </option>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
              </select></td>
			
            <td>Student Category:</td>
            <td><select name="cate" class="select" tabindex="15" required>
              <option value="BOARDING" >Boarder </option>
              </select></td>
        </tr>
          <tr>
            <td >House Allocated:</td>
            <td><input type="text" size="35" name="house" class="inputFields" tabindex="16" required autofocus /></td>
          </tr>
          <tr>
            <td colspan="4"><hr /></td>
          </tr>
           <tr>
          <td colspan="4"><strong>Parent Information</strong></td>
        </tr>
          <tr>
            <td >First Name:</td>
            <td><input type="text" size="35" name="pfname" class="inputFields" tabindex="17" required autofocus/></td>
            <td >Middle Name:</td>
            <td><input type="text" size="35" name="pmname" class="inputFields" tabindex="18" required autofocus/></td>
          </tr>
          <tr>
            <td >Last Name:</td>
            <td><input type="text" size="35" name="plname" class="inputFields" tabindex="19" /></td>
            <td >ID/Passport:</td>
            <td><input type="text" size="35" name="idpass" class="inputFields" tabindex="20" required autofocus/></td>
          </tr>
          <tr>
            <td >Address:</td>
            <td><input type="text" size="35" name="address" class="inputFields" tabindex="21" /></td>
            <td >Telephone:</td>
            <td><input type="number" size="35" name="telephone" class="inputFields" tabindex="22" required autofocus/></td>
          </tr>
          <tr>
            <td align="center" colspan="2"><br />
              <input  class="btn btn-primary" type="submit" value="Save Details" onclick="return validateForm();"></td>
            <td>&nbsp;</td>
            <td align="center">
            <input  class="btn btn-warning" type="reset" value="Cancel">
          </td>
          
          </tr>
          
        </table>
        
    </form>

<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
