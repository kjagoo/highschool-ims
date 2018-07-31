<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  

 include 'includes/functions.php';
$func = new Functions();
$activity = "KCSE ANALYSIS";
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
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
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

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function commonFunction(id){
loadXMLDoc(id,function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("new_Area").innerHTML=xmlhttp.responseText;
    }
  });
}


	</script>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" src="fieldclone.txt"></script>
<script type="text/javascript" src="entertotab.txt"></script>
</head>
<body>
<div class="clear"></div>
<div id="new_Area">
  <div id="page_tabs">
    <ul>
      <li><a  href="KCSE.php">Manage Index No</a></li>
      <li><a href="KCSE_Records.php">Record Entries</a></li>
      <li><a class="active"  href="KCSE_Manage.php">Manage Entries</a></li>
      <li><a  href="KCSE_Analysis.php">Generate Analysis</a></li>
    </ul>
  </div>
  <div class="clear"></div>
  <div id="display_Area">
    <div id="page_tabs_content">
      <form action="KCSE_Manage_View.php" method="get" target="reportView">
        <table class="borders" width="100%">
          <tr>
            <td class="alterCell" width="20%">Select Subject:</td>
            <td class="alterCell3" ><select name="subjects" id="select" class="select" required tabindex="1">
                <option value="" >-- Select Subject -- </option>
               <option value="ENGLISH" >101-ENGLISH </option>
                  <option value="KISWAHILI" >102-KISWAHILI</option>
                  <option value="MATH" >121-MATHEMATICS</option>
                  <option value="BIOLOGY" >231-BIOLOGY</option>
                  <option value="PHYSICS" >232-PHYSICS</option>
                  <option value="CHEMISTRY" >233-CHEMISTRY</option>
                  <option value="HISTORY" >311-HISTORY</option>
                  <option value="GEOGRAPHY" >312-GEOGRAPHY</option>
                  <option value="CRE" >313-CRE</option>
				   <option value="HOME" >441-HOMESCIENCE</option>
                  <option value="AGRICULTURE" >443-AGRICULTURE</option>
				  <option value="COMPUTER" >451-COMPUTER</option>
				  <option value="FRENCH">501-FRENCH</option>
				   <option value="B/STUDIES" >565-B/STUDIES</option>
              </select></td>
            <td class="alterCell" width="20%">Select Year:</td>
            <td class="alterCell3" ><select name="year" class="select" tabindex="2" required>
                <option value="" >-- Select Year -- </option>
                <?php
				include('includes/dbconnector.php');
		 			  	$query=("select distinct (year_finished) from studentdetails where year_finished>0");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['year_finished'].">".$row['year_finished']."</OPTION>"; }
						?>
              </select></td>
            <td colspan="2" ><input class="btn btn-primary" type="submit" value="Manage Entries" /></td>
          </tr>
        </table>
      </form>
      <div class="spacer"></div>
	  <iframe name="reportView" src="KCSE_edit_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
	 
    </div>
  </div>
</div>
</body>
</html>
