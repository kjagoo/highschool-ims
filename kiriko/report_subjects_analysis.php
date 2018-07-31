<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
 require_once("includes/dbconnector.php");  
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
a{
cursor:pointer;
}
</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
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
function download(){
	window.location='licenses.xls';
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

 
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}


function hideHelpDiv(){
  document.getElementById('notice_area').style.display = "none";
 }
 function showHelpDiv(){
  document.getElementById('notice_area').style.display = "block";
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
    <li><a  class="active"  href="report_subjects_analysis.php">General Exams Subjects Analysis</a></li>
    <li><a  href="report_subjects_analysis_cluster.php">Cluster Exams Subjects Analysis</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
  $query="SELECT * FROM d_locks";
  $result = mysql_query($query);
  while($row = mysql_fetch_array($result)){
  $status=$row['d_lock'];
  }
  
  if($status=="open"){
  $image='lock_open.png';
  }
if($status=="locked"){
   $image='lock_closed.png';
  
  }
  
 if($status=="locked"){
 ?>
    <fieldset>
    <table width="80%">
      <tr>
        <td><img src="images/<?php echo $image?>" align="absmiddle" /></td>
        <td>Report Forms Generation is currently &nbsp;<strong><?php echo  $status?></strong> by the Dean<br/>
          <div class="spacer"></div>
          Kindly contact the Dean, Principal or Deputy Principal for more info</td>
      </tr>
    </table>
    <div style="float:right; margin-right:20%;"><a  onclick="showHelpDiv();">Why is this?</a></div>
    </fieldset>
    <div class="clear"></div>
    <!--*********************************************************************************-->
    <div id="notice_area" style="display:none;">
      <div id="tooltip_full_backup" class="tooltip module width_3_quarters">
        <div class="tooltip_header clearfix">
          <table>
            <tr>
              <td><h4>&nbsp;Why is Report Form  Generation Locked?</h4></td>
              <td><a onClick="hideHelpDiv();">Close Note</a> </td>
            </tr>
          </table>
          <div style="clear: both;"></div>
        </div>
        <div class="tooltip_body"> Report forms generation is limited to the dean or the Principal Administrators.<br/>
          Hiding report form generation makes sure that:
          <ul>
            <li>Report forms are ONLY generated at the right time</li>
            <li>Report form generation does not result into errors due to incomplete marks analysis</li>
            <li>The dean is aware that the process is ongoing</li>
          </ul>
          <br/>
        </div>
      </div>
      <!-----************************************************************************************-->
      <?php 
  }else{
  ?>
      <fieldset>
      <form name="pays" action="report_general_subject_analysis_view.php" method="get" target="reportView">
        <table width="100%">
          <tr>
            <td>Select Form:</td>
            <td><select name="form" class="select" required>
                <option value="" >-- Select Form -- </option>
                <option value="1" >FORM 1 </option>
                <option value="2" >FORM 2 </option>
                <option value="3" >FORM 3 </option>
                <option value="4" >FORM 4 </option>
              </select>
			  </td>
			  <td>Select Exam:</td>
			 <td>
              <select name="exam" id="select" class="select" required>
			  <option value="" >-- Select Exam -- </option>
			  <option value="totalygradedmidterm-CAT1" >CAT 1</option>
			  <option value="totalygradedmidterm-CAT2" >CAT 2</option>
			  <option value="totalygradedmidterm-CAT12" >CAT 1 & 2</option>
              <option value="totalygradedmarks" >End of Term</option>
               
              </select>
            </td>
          <tr>
            <td>Select Term</td>
            <td><select name="term" class="select" required>
                <option value="" >-- Select Term -- </option>
                <option value="1" >TERM 1 </option>
                <option value="2" >TERM 2 </option>
                <option value="3" >TERM 3 </option>
              </select>
            </td>
            <td>Select Year:</td>
            <td><select name="year" class="select" required>
                <option value="" >-- Select Year -- </option>
                <?php for($i = 2010; $i <= 2050; ++$i) 
              printf('<option value="%d">%d</option>', $i, $i);
   			 ?>
              </select></td>
			   
          </td>
            <td align="center"><input type="submit" name="Record" value="View Analysis" class="btn btn-primary" onclick="return validateForm();"/></td>
          </tr>
        </table>
      </form>
      </fieldset>
      <iframe name="reportView" src="report_analysis_view.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
      <?php


}
?>
    </div>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
