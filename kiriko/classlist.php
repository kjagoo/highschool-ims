<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed Class list";
$func->addAuditTrail($activity,$username);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href="css/tablesorter_ordinary.css"  type="text/css" rel="stylesheet" >
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
	window.location='files.xls';
}

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
    xmlhttp.open("GET","search.php?q="+str,true);
    xmlhttp.send();
    }
	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
	 window.frames["print_frame"].document.getElementById('example').border="1px #FF0000 solid";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}



	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="classlist.php">Class Lists</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
  <fieldset>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <table width="80%" class="tablesorter_ordinary">
      <tr>
        <td valign="middle"><strong>Select Form:</strong></td>
        <td valign="middle"><select name="forms" class="select">
            <option value="FORM 1" >FORM 1 </option>
            <option value="FORM 2" >FORM 2 </option>
            <option value="FORM 3" >FORM 3 </option>
            <option value="FORM 4" >FORM 4 </option>
          </select>
        </td>
        <td valign="middle"><strong>Stream:</strong></td>
        <td>&nbsp;&nbsp;
          <select name="stream" id="select" class="select">
            <?php
						include('includes/dbconnector.php');
		 			  	$query=("select distinct (stream) from streams ");

						$result=mysql_query($query) ;

						while($row=mysql_fetch_array($result)){

						echo "<OPTION VALUE=".$row['stream'].">".$row['stream']."</OPTION>"; }?>
          </select>
        </td>
        <td valign="middle"><strong>Select Type</strong></td>
        <td valign="middle"><select name="genders" class="select">
            <option value="Entire" >Entire </option>
            <option value="Girls" >Girls </option>
          </select>
        </td>
        <td align="right"><input class="btn btn-primary" type="submit" value="Get List" onclick="return validateForm();"/></td>
      </tr>
    </table>
  </form>
  </fieldset>
  <div class="clear"></div>
  <?php
	  include('includes/dbconnector.php');
	if (isset ($_POST['forms']) && isset ($_POST['stream']) && isset ($_POST['genders'])){
	
	
	$form=$_REQUEST["forms"];
	$stream=strtoupper($_REQUEST["stream"]);
	$genders=$_REQUEST["genders"];
	
	//echo $form."  ".$stream."  ".$genders;
	
if($genders=="Entire"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' ORDER BY sd.ADMNO ASC";
}
if($genders=="Boys"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Male'  ORDER BY sd.ADMNO ASC";
}
if($genders=="Girls"){
$query = "SELECT sd.*,pd.telephone FROM studentdetails as sd inner join parentdetails pd on sd.admno=pd.admno and sd.form='$form' and sd.class='$stream' and sd.gender='Female'  ORDER BY sd.ADMNO ASC";
}



// run the query and store the results in the $result variable.
$result = mysql_query($query);
if ($result) {


	$details = mysql_query("select * from schoolname");
	while ($de = mysql_fetch_array($details)) {// get names
	$schoolname=$de['schname'];
	$po=$de['box'];
	$plac=$de['place'];
	$tele=$de['telphone'];
}
  
  // create a new form and then put the results
  // indto a table.
  ?>
  <form  method='get' name='subs'>
    <div id=tabledisplay>
      <table class='borders' cellpadding='5' cellspacing="0">
        <tr style='height:30px;'>
          <td class='dataListHeader' colspan='4'>CLASS LIST: <?php echo $form ." ".$stream?>
            <div style="float:right; margin-right:20px; width:60%;">
              <table align="right" width="60%">
                <tr>
				<td><a href="pdf_classlist.php?forms=<?php echo $form?>&stream=<?php echo $stream?>&genders=<?php echo $genders?>" class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print PDF</a></td>
				<td><a href="csv_classlist.php?forms=<?php echo $form?>&stream=<?php echo $stream?>&genders=<?php echo $genders?>" class="noline"><i class='icon icon-orange icon-xls'></i>&nbsp;Export CSV</a></td>
                  <td><a href=javascript:printDiv('tabledisplay') class="noline"><i class='icon icon-orange icon-print'></i>&nbsp;Print List</a></td>
                </tr>
              </table>
            </div></td>
        </tr>
        <tr>
          <td><table id="example" border='0'  align="center" width="98%">
              <tr>
                <td align="center" colspan="11"><?php echo strtoupper($schoolname)?><br/>
                  P.O.Box <?php echo $po.", ".$plac?><br/>
                  TEL: <?php echo $tele?><br/>
                  <u><?php echo $form ." ".$stream ." ".$genders ?> CLASS LIST</u> <br />
                </td>
              </tr>
              <tr>
                <td align='right'> No.</td>
                <td align='center'>Admission No.</td>
                <td>Student Name</td>
				<td>KCPE</td>
				<td>Contact</td>
                <td align="left" width="30px"></td>
                <td align="left" width="30px"></td>
                <td align="left" width="30px"></td>
				<td align="left" width="30px"></td>
                <td align="left" width="30px"></td>
                <td align="left" width="30px"></td>
				<td align="left" width="30px"></td>
                <td align="left" width="30px"></td>
              </tr>
              
              <?php	
		$color="#E8FFFF";
		 $num=0;
		while ($row = mysql_fetch_array($result)) {
		$num++;
		$adm=$row['admno'];
		$fname=strtoupper(str_replace("&","'",$row['fname']));
		$mname=strtoupper(str_replace("&","'",$row['lname']));
		$lname=strtoupper(str_replace("&","'",$row['sname']));
		$formis=$row['form'];
		$telephone=$row['telephone'];
		$kcpe=$row['marks'];


echo " <tr bgcolor=$color>
	  	<td align=right><span id=freetext>$num</span></td>
	  	<td align=center><span id=freetext>$adm</span></td>
		<td><span id=freetext>$fname&nbsp;$mname&nbsp;$lname</span></td> 
		<td align=center><span id=freetext>$kcpe</span></td>
		<td><span id=freetext>$telephone</span></td> 
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>
		<td align=left></td>";
		
	if($color=='white'){
	$color="#E8FFFF";
		}
	else if($color=="#E8FFFF"){
	$color='white';
	}
   
}
?>
            </table></td>
        </tr>
      </table>
    </div>
  </form>
  <iframe name=print_frame width=0 height=0 frameborder=0 src=about:blank></iframe>
  <?php
}

	}


	?>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
