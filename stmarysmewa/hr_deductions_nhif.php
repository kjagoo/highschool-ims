<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed HR NHIF page";
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
<!-- Initiate tablesorter script -->
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
 
String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};

	</script>
</head>
<body>
<div id="page_tabs">
  <ul>
    <li><a href="hr_deductions.php">Income Tax (P.A.Y.E.)</a></li>
	 <li><a class="active" href="hr_deductions_nhif.php">NHIF</a></li>
	 <li><a href="hr_deductions_nssf.php">NSSF</a></li>
	 <li><a href="hr_deductions_loans.php">Loans Setup</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
   <div id="page_tabs_content">
    <fieldset>
     <table width="80%">
        <tr>
          <td valign="middle" rowspan="2"><a href="#openModal" class="btn btn-primary noline"><span class="icon icon-green icon-plus"></span> New NHIF Setting</a></td>
        </tr>
      </table>
    </fieldset>
    <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;NHIF Settings</td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Min Salary:</b></td>
              <td class="alterCell2"><input type="number" name="minv" class="inputFields"  required  tabindex="2"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Max Salary:</b></td>
              <td class="alterCell2"><input type="number" name="maxv" class="inputFields"  required  tabindex="3"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Amount:</b></td>
              <td class="alterCell2"><input type="number" name="amount" class="inputFields"  required  tabindex="4"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Record" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
	 <?php
	if(isset($_POST['amount'])&& isset($_POST['minv'])&& isset($_POST['maxv'])){
	require_once("includes/dbconnector.php");
	
	
	$min=$_POST['minv'];
	$max=$_POST['maxv'];
	$tax=$_POST['amount'];
	$date=date("Y-m-d H:i:s a");
	$qury="insert into tbl_hr_nhif (minv,maxv,amount) values ('$min','$max','$tax')";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
		echo "<script language=javascript>alert('NHIF Setting Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='hr_deductions_nhif.php' </script>";
	}
	}
	
?>
    <?php
    $result = mysql_query("SELECT * FROM tbl_hr_nhif order by minv asc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Default NHIF Settings</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
				<th>Min Salary</th>
				<th>Max Salary</th>
				<th>Deduction</th>
				<th>Percent %</th>
                <th width="10%"></th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody>
              <?php
			  $num=0;
			while($row = mysql_fetch_array($result)){
			$num++;
			?>
              <tr class="record">
                <td><?php echo $num?></td>
				<td align="right"><?php echo number_format($row["minv"],2);?></td>
				<td align="right"><?php echo number_format($row["maxv"],2);?></td>
				<td align="right"><?php echo number_format($row["amount"],2);?></td>
				<td align="right"><?php echo number_format($row["percent"],2);?></td>
                <td align="center"><a href="#" id="<?php echo $row["minv"]; ?>" class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td>
                <td><a href="#" title="Click to Edit Class Details"><span class="icon icon-orange icon-edit"></span></a></td>
              </tr>
              <?php
			}
		?>
            </tbody>
          </table></td>
      </tr>
    </table>
  </div>
</div>
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("WARNING !\n\nYou are about to delete this Deduction Type.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_deduction.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		//alert('Deletion Successful');

 }

return false;

});

});
</script>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
