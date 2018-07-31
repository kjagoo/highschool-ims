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

<link href='css/opa-icons.css' rel='stylesheet'/>
<!-- Load jQuery, SimpleModal and Basic JS files -->
<script type='text/javascript' src='js/jquery_d.js'></script>
<script type='text/javascript' src='js/basic.js'></script>
<SCRIPT LANGUAGE="JavaScript" src="js/script.js"></SCRIPT>
<script language="javascript" src="scripts/calendar.js"></script>

<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
<style type="text/css" class="init">

	</style>
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" class="init">
	$(document).ready(function() {
	$('#example').dataTable( {
		"columnDefs": [ 
			{
				// The `data` parameter refers to the data for the cell (defined by the
				// `data` option, which defaults to the column being worked with, in
				// this case `data: 0`.
				//"render": function ( data, type, row ) {
				//	return data +' ('+ row[3]+')';
				//},
				//"targets": 0
			},
			//{ "visible": false,  "targets": [ 3 ] }
		]
	} );
} );


	</script>
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
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}

function changeDisplay(){
	document.getElementById('temp').style.display = "none";
}
function reverseDisplay(){
	document.getElementById('temp').style.display = "block";
}

	</script>
</head>
<body>
<div class="upper_area_small">
  <table width="70%">
    
    <tr>
      <td><form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <div id="holder">
            <div style="float:left;">Student Name/ Admno:</div>
            <div style="float:left;">
              <input type="text" class="input" name="keyword" id="keyword" tabindex="0" required>
            </div>
            <input type="submit" name="submit" value="Get Student" class="btn btn-primary" />
          </div>
          <div style="float:left;"><img src="images/loading.gif" id="loading" align="right"></div>
          <div id="ajax_response"></div>
        </form></td>
    </tr>
  </table>
</div>
<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="displine.php"><span class="icon icon-green icon-flag"></span>Displine</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
  <div id="display_Area">
    <div id="temp">
      <fieldset>
      <table class="border" width="100%">
        <tbody>
          <tr>
            <td class="alterCell" width="20%"><b>Student Name</b></td>
            <td class="alterCell2" colspan="3">-</td>
            <td class="alterCell2" rowspan="3" valign="top" align="right"><img src="Image/blur.png" border="1" /></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Admission #</b></td>
            <td class="alterCell2">-</td>
          
            <td class="alterCell" width="20%"><b>Current Form</b></td>
            <td class="alterCell2" colspan="2">-</td>
          </tr>
          <tr>
            <td class="alterCell" width="20%" rowspan="2" valign="middle"><b>Comments</b></td>
            <td colspan="3"><textarea cols="50" rows="5" name="comment"   tabindex="13" disabled="disabled"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input disabled="disabled" type="submit" name="Record" value="Save Record" class="btn"/></td>
            <td align="center"><input disabled="disabled" type="button" name="edit" value="Cancel" class="btn" onClick="window.location='displine.php'"/></td>
          </tr>
        </tbody>
      </table>
      </fieldset>
    </div>
    <div class="clear"></div>
    <?php
	if(isset($_POST['keyword']) ){
	include('includes/dbconnector.php');
	$keyword=$_POST['keyword'];
	?>
    <script language="javascript">changeDisplay();</script>
    <?php
	//if (is_numeric($keyword)){
   		//$sql = "select * from studentdetails where admno = '".$keyword."'";
	//}else{
	$arr=explode(" ",$keyword);
	$sql = "select * from studentdetails where admno = '".$arr[0]."'";
	//}
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$nameis=$row['fname'];
		$snames=$row['sname'];
		$lnam=$row['lname'];
		$admno=$row['admno'];
		$form=$row['form'];
		$stream=$row['class'];
		//$imageref=$row['picture'];
	}
	$fullname=$nameis." ".$snames." ".$lnam;
	
	
	
	?>
    <form action="saveDisplineRecord.php" method="post">
      <fieldset>
      <table class="border" width="100%">
        <tbody>
          <tr>
            <td class="alterCell" width="20%"><b>Student Name</b></td>
            <td class="alterCell2" colspan="3"><?php echo $fullname;?></td>
            <td class="alterCell2" rowspan="3" valign="top" align="right"><img src="Image/<?php echo $admno?>.jpg" width="120" height="130" border="1" /></td>
          </tr>
          <tr>
            <td class="alterCell" width="20%"><b>Admission #</b></td>
            <td class="alterCell2"><?php echo $admno;?></td>
          
            <td class="alterCell" width="20%"><b>Current Form</b></td>
            <td class="alterCell2" ><?php echo $form. " ".$stream;?></td>
          </tr>
         
          <tr>
            <td class="alterCell" width="20%" rowspan="2" valign="middle"><b>Comments</b></td>
            <td colspan="4"><textarea cols="50" rows="5" name="comment"   tabindex="13"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="Record" value="Save Record" class="btn btn-primary"/></td>
            <td align="center"><input type="button" name="edit" value="Cancel" class="btn btn-primary" onClick="window.location='displine.php'"/></td>
          </tr>
        </tbody>
      </table>
      <input type="hidden" name="userid" value="<?php echo $admno;?>"  />
      </fieldset>
    </form>
    <?php
	// get other displine records associated with this stydent
	?>
<table class="borders" cellpadding="5" cellspacing="0">
	 <tr style="height:30px;">
	 <td class="dataListHeader">Previous Bookings Summary</td>
	  </tr>
	<tr>
	<td>
	<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Row #</th>
          <th>Date Booked</th>
          <th>Booked By</th>
          <th>Comments</th>
        </tr>
      </thead>
      <tbody>
	<?php
		$num=0;
		$resultd = mysql_query("SELECT * FROM tbldispline where admno='$admno'");
		while($rowd = mysql_fetch_array($resultd)){
		$num++;
		?>
        <tr>
          <td><?php echo $num;?></td>
          <td><?php echo $rowd['date_added'] ?></td>
          <td><?php echo $rowd['comment_by'];?></td>
          <td><?php echo $rowd['comments'];?></td>
        </tr>
        <?php
			}
		?>
      </tbody>
    </table>
	</td>
</tr>
</table>
	<?php
	}
	
	?>
  </div>
</div>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
