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

<div id="page_tabs">
  <ul>
    <li><a class="active" href="marks_students.php">Students Per Subject</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
  <fieldset>
    <form name="pays" action="marks_subjects_studentview.php" method="get" target="reportView">
      <table width="100%">
	  <tr> <td><select name="subs" class="select" tabindex="1">
		<option value="" >-- SELECT SUBJECT --</option>
                  <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
				  <option value="HOME" >441-HOME SCIENCE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
                  <option value="BSTUDIES" >565-B/STUDIES</option>
				  
				  
                </select>
              </td>
          <td><select name="form" class="select" required>
		  <option value="" >-- Select Form -- </option>
              <option value="FORM 1" >FORM 1 </option>
              <option value="FORM 2" >FORM 2 </option>
              <option value="FORM 3" >FORM 3 </option>
              <option value="FORM 4" >FORM 4 </option>
            </select>
            <select name="stream" id="select" class="select" required>
              <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
            </select>
          </td>
       
          <td><select name="term" class="select" required>
		  <option value="" >-- Select Term -- </option>
              <option value="1" >TERM 1 </option>
              <option value="2" >TERM 2 </option>
              <option value="3" >TERM 3 </option>
            </select>
          </td>
          <td><select name="year" class="select" required>
		  <option value="" >-- Select Year -- </option>
              <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
            </select>
			
          </td>
          <td align="center"><input type="submit" name="Record" value="Continue" class="btn btn-primary" onclick="return validateForm();"/></td>
        </tr>
      </table>
    </form>
    </fieldset>
    <iframe name="reportView" src="marks_subjects_studentview.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
