<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Printed Estimates Setting page";
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
    <li><a  class="active" href="finance_estimates.php">Printed Estimates Setting</a></li>
	<li><a  href="finance_setfees.php">Fees Setting</a></li>
	<li><a  href="finance_viewalreadyset_fees.php">View Fees</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
    <fieldset> 
	 <form method="get" action="finance_view_estimates.php" target="reportView">
     <table width="70%">
        <tr>
		 <td valign="middle" rowspan="2">Check for Previous Years</td>
          <td valign="middle" rowspan="2">
		  <select name="previousyrs" class="select" required>
		  <option value="">-- Select Year--</option>
		  <?php
		  $query=("select distinct(fiscal_yr) from finance_estimates ");
			$result=mysql_query($query) ;
				while($row=mysql_fetch_array($result)){
				echo "<OPTION VALUE=".$row['fiscal_yr'].">".$row['fiscal_yr']."</OPTION>"; }
			?>
		  </select>
		  </td>
		  <td><input type="submit" name="submit" value="View Estimates" class="btn btn-primary"/></td>
        </tr>
      </table>
	  </form>
  </fieldset>
 <?php
	if($finance->checkPrintedEstimates()==1 ||$finance->checkPrintedEstimates()>1){ ?>
	
	 <iframe name="reportView" src="finance_view_estimates.php?previousyrs=<?php echo $finance->getFiscalYear()?>" style="width: 100%; height: 500px;" frameborder="0"></iframe>
	
	<?php }else{?>
	
	 <iframe name="reportView" src="finance_set_estimates.php" style="width: 100%; height: 500px;" frameborder="0"></iframe>
	<?php }
 ?>
		

   
  </div>
</div>

<!--end of display area. This area changes when a user searches for an item-->
</body>
</html>
