<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Fiscal Yr Setting page";
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
    <li><a  class="active" href="finance_fiscalyear.php">Fiscal Year Setting</a></li>
	<li><a  href="finance_bankact.php">Bank Accounts Setting</a></li>
	<li><a  href="finance_voteheads.php">Votehead Setting</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
    <fieldset>
     <table width="80%">
        <tr>
          <td valign="middle" rowspan="2"><a href="#openModal" class="btn btn-primary noline">Set Fiscal Year</a></td>
        </tr>
      </table>
    </fieldset>
	
    <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <?php
		if($finance->getOpenFiscalYear()==1 ||$finance->getOpenFiscalYear()>1){ ?>
		
		<div class="alert alert-error">
		  <table>
		  <tr>
		  <td width="20%"><i class="icon32 icon-red icon-alert"></i></td>
		  <td><strong>ERROR !</strong><br /><br /> THERE IS AN OPEN FISCAL YEAR <br />PLEASE CLOSE IT FIRST</td>
		  </tr>
		  <tr>
              <td>&nbsp;</td>
              <td><input type="submit" name="submit" value="Cancel" class="btn btn-warning" onclick="window.location='finance_fiscalyear.php'"/></td>
            </tr>
		  </table>
	  </div>
		
		<?php }else{?>
		
		<form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;FISCAL YEAR</td>
            </tr>
            <tr>
              <td class="alterCell" width="25%"><b>YEAR:</b></td>
              <td class="alterCell2"><input type="number" name="name" class="inputFields" autofocus required  tabindex="1"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Settings" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
		<?php } ?>
		
      </div>
    </div>
	 <?php
	if(isset($_POST['name'])){
	require_once("includes/dbconnector.php");
	
	$name=$_POST['name'];
	
	$date=date("Y-m-d H:i:s a");
	$qury="insert into finance_fiscalyr (fiscal_year) values ('$name') on duplicate key update fiscal_year='$name'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Set Fiscal Year ".$name;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Fiscal Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_fiscalyear.php' </script>";
	}
	}
	
?>
    <?php
    $result = mysql_query("SELECT * FROM finance_fiscalyr order by fiscal_year asc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Fiscal Years</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th>Fiscal Year</th>
				<th>Status</th>
                <th width="10px"></th>
				 <th width="10px"></th>
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
                <td><?php echo str_replace("-"," ",$row["fiscal_year"]);?></td>
				<td><?php echo $row["status"];?></td>
 <td align="center"><a href="#" id="<?php echo str_replace("-"," ",$row["fiscal_year"]).",".$row["status"]; ?>"  class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td><td align="center"><a href="#" id="<?php echo str_replace("-"," ",$row["fiscal_year"]).",".$row["status"]; ?>" class="editbutton"><span class="icon icon-orange icon-unlocked"></span> </a></td>
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
var res = del_id.split(",");

if(res[1] == "OPEN"){

alert("ERROR: Cannot Delete An Open Year. Close the Year First Before Deleting");
}else{

 if(confirm("You are about to Delete this fiscal year, do you wish to continue?"))
		  {

   $.ajax({
   type: "GET",
   url: "delete_finance_fiscalyr.php",
   data: info,
   success: function(){
  
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		//alert('Deletion Successful');

 }
 
 }
 

return false;

});

});




$(function() {
$(".editbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
var res = del_id.split(",");

if(res[1] == "OPEN"){
if(confirm("You are about to change status of this financial year. Do you wish to continue?"))
		  {

   $.ajax({
   type: "GET",
   url: "close_finance_fiscalyr.php",
   data: info,
   success: function(){
  
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		//alert('Deletion Successful');

 }

}else{

 alert("ERROR: The year is already closed");
 
 }
 

return false;

});

});



</script>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
