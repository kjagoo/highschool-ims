<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Parents Cashbook Finance Voteheads Setting page";
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
<!-- Initiate table sorter script -->
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
        <li><a  class="active" href="finance_voteheads.php">Parents Cashbook Setting</a></li>
        <li><a  href="finance_operationalcashbooksettings.php">Operational Cashbook Setting</a></li>
        <li><a  href="finance_tuitioncashbooksettings.php">Tuition Cashbook Setting</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
  
    <fieldset>
     <table width="80%">
        <tr>
          <td valign="middle" rowspan="2"><a href="#openModal" class="btn btn-primary noline">Add Votehead</a></td>
        </tr>
      </table>
    </fieldset>
	
    <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
		<form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;FISCAL YEAR</td>
            </tr>
            <tr>
              <td class="alterCell" width="25%"><b>YEAR:</b></td>
              <td class="alterCell2">
			  <select name="year" class="select" tabindex="1" required>
			   <option value="">--Select Year--</option>
			<?php for($i = 2010; $i <= 2050; $i++) 
             		 printf('<option value="%d">%d</option>', $i, $i);
   					 ?>
					 </select>
			  </td>
            </tr>
			 <tr>
              <td class="alterCell" width="25%"><b>Term:</b></td>
              <td class="alterCell2">
			  <select name="term" class="select" required tabindex="2">
			  <option value="">--Select Term--</option>
			  <option value="TERM 1">Term 1</option>
			  <option value="TERM 2">Term 2</option>
			  <option value="TERM 3">Term 3</option>
			  
			  </select>
			  
			  </td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Votehead:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="votehead" class="inputFields" tabindex="3" required/></td>
            </tr>
			<tr>
              <td class="alterCell" width="25%"><b>Votehead Code:</b></td>
              <td class="alterCell2"><input type="text" size="35" name="code" class="inputFields" tabindex="4" required/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Save Settings" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
		
		
      </div>
    </div>
	 <?php
	if( isset($_POST['year']) && isset($_POST['term']) && isset($_POST['votehead']) && isset($_POST['code'])){
	require_once("includes/dbconnector.php");
	
	$year=$_POST['year'];
	$term=$_POST['term'];
	$votehead=str_replace(" ","_",$_POST['votehead']);
	$votehead=str_replace("/","&",$votehead);
	$code=$_POST['code'];
	
	
	$qury="insert into finance_voteheads (fiscal_year,term,votehead,code) values ('$year','$term','$votehead','$code') on duplicate key update fiscal_year='$year', term='$term', votehead='$votehead', code='$code'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "New Votehead ".$votehead;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Votehead Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='finance_voteheads.php' </script>";
	}
	}
	
?>
    <?php
    $result = mysql_query("SELECT * FROM finance_voteheads order by fiscal_year asc,term asc, votehead asc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Operational Voteheads:</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th>Fiscal Year</th>
				<th>Term</th>
				<th>Votehead</th>
				<th>Votehead Code</th>
				
				<th>Delete</th>
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
				<td><?php echo $row["term"];?></td>
				<td><?php echo $row["votehead"];?></td>
				<td><?php echo $row["code"];?></td>
				
               <!--<td><a href="edit_votehead.php?id=" title="Click to Edit Student Details"><i class="icon icon-orange icon-edit"></i></a></td>-->
			   <td align="center"><a href="#" id=<?php echo str_replace("-"," ",$row["fiscal_year"]).",".$row["votehead"].",".$row["term"] ?> class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td>
			   
			  
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
 if(confirm("Your are about to delete this Votehead, do you want to continue"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_finance_votehead.php",
   data: info,
   success: function(){
    alert("Vote Head Deleted");
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");
		//alert('Deletion Successful');

 }

return false;

});

$(".editbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("WARNING !!\n\nYou are about to Edit.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_finance_fiscalyr.php",
   data: info,
   success: function(){
   
   }
 });

 }

return false;

});

});
</script>
<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
