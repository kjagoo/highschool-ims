<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Record Balances page";
$func->addAuditTrail($activity,$username);
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
<script type="text/javascript" src="js/jquery.min_vtab.js"></script>
<script type="text/javascript" src="js/script_vtab.js"></script>
<link rel="stylesheet" href="css/styles_vtab.css" />
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a  class="active"  href="finance_recordbal.php">Record Balances</a></li>
	<li><a href="finance_uploadbal.php">Upload Balances</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
   <form action="recordBalances.php" name="marksform" method="post">
            <table class="borders" width="100%">
             
              <tr>
                <td><select name="frms" id="inputMarks" class="select" required>
				<option value="" >-- Select Form --</option>
                    <option value="FORM 1">FORM 1 </option>
                    <option value="FORM 2">FORM 2 </option>
                    <option value="FORM 3">FORM 3 </option>
                    <option value="FORM 4">FORM 4 </option>
                  </select>
                <select name="stream" id="select" class="select" >
				<option value="" >-- Class --</option>
				 <option value="Entire" >Entire Form</option>
                    <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
                  </select></td>
              
                <td><select name="term" id="inputMarks" class="select" required>
				<option value="" >-- Select Term --</option>
                    <option value="TERM 1" >TERM 1 </option>
                    <option value="TERM 2" >TERM 2 </option>
                    <option value="TERM 3" >TERM 3 </option>
                  </select>
                </td>
				
                <td><select name="year" id="inputMarks" class="select" required>
				<option value="" selected="selected">-- Select Year --</option>
                    <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
                  </select>
                </td>
              
                <td align="left"><input class="btn btn-primary" type="submit" value="Continue"/></td>
              </tr>
            </table>
          </form>
  
    
</div>
</div>	
   
<!--end of display area. This area changes when a user searches for an item-->
</body>
</html>
