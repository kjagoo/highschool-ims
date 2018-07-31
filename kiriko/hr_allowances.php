<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed HR Allowances page";
$func->addAuditTrail($activity,$username);

function getLoggedUser($user_id){
$user=0;
 $sql="select * from staff where idpass='$user_id'";
$result = mysql_query($sql);
 $row=mysql_fetch_array($result);
    $user=str_replace("&","'",$row['fname'])."  ".str_replace("&","'",$row['lname']);

	return $user;
}
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
    <li><a class="active" href="hr_allowances.php">Employee Allowances</a></li>
	<li><a href="hr_allowances_relief.php">Employee Reliefs</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="display_Area">
   <div id="page_tabs_content">
    <fieldset>
     <table width="80%">
        <tr>
          <td valign="middle" rowspan="2"><a href="#openModal" class="btn btn-primary noline"><span class="icon icon-green icon-plus"></span> New Allowance</a></td>
        </tr>
      </table>
    </fieldset>
    <div id="openModal" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;New Allowance Type</td>
            </tr>
            <tr>
              <td class="alterCell" width="25%"><b>Allowance:</b></td>
              <td class="alterCell2"><input type="text" name="name" class="inputFields" autofocus required  tabindex="1"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Amount:</b></td>
              <td class="alterCell2"><input type="number" name="minv" class="inputFields"  required  tabindex="2"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Applies To %:</b></td>
              <td class="alterCell2">
			  <select name="staffno" class="select"  tabindex="1" required>
						   <option value=""  selected="selected">-- Select Employees  -- </option>
							   <option value="All"> All Employees</option>
						  <?php
				  $sql = "select * from  staff where category!='TRAN'";
							$result=mysql_query($sql) ;
	
							while($row=mysql_fetch_array($result)){
							
							 echo "<OPTION VALUE=".$row['idpass'].">".str_replace("_"," ",$row['fname'])." ".str_replace("_"," ",$row['mname'])."</OPTION>"; 
							 }
							 
							?>
						   </select>
			  </td>
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
	if(isset($_POST['name'])&& isset($_POST['minv'])){
	require_once("includes/dbconnector.php");
	
	$name=$_POST['name'];
	$name=str_replace(" ","-",$name);
	$min=$_POST['minv'];
	$staffno=$_POST['staffno'];
	$date=date("Y-m-d H:i:s a");
	$qury="insert into tbl_hrallowances (name,rate,applies_to) values ('$name','$min','$staffno')";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Added HR Allowance ".$name;
	$func->addAuditTrail($activity,$username);
		echo "<script language=javascript>alert('Allowance has been Added Successfuly') </script>";
		 echo "<script language=javascript>window.location='hr_allowances.php' </script>";
	}
	}
	
?>
    <?php
    $result = mysql_query("SELECT * FROM tbl_hrallowances order by name desc");
	
		?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Available Employee Allowances</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="10%">#</th>
                <th>Allowance</th>
				<th>Rate</th>
				<th>Applies to</th>
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
                <td><?php echo str_replace("-"," ",$row["name"]);?></td>
				<td align="right"><?php echo number_format($row["rate"],2);?></td>
				<td align="right"><?php echo getLoggedUser($row["applies_to"]);?></td>
                <td align="center"><a href="#" id="<?php echo $row["name"]; ?>" class="delbutton"><span class="icon icon-orange icon-trash"></span> </a></td>
                <td><a href="#openModal<?php echo $num?>" title="Click to Edit Class Details"><span class="icon icon-orange icon-edit"></span></a>
				
				
				<div id="openModal<?php echo $num?>" class="modalDialog">
      <div> <a href="#close" title="Close" class="close">X</a>
        <form name="subjectform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
          <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
            <tr style='height:30px;'>
              <td class='dataListHeader' colspan='4'><i class="icon icon-green icon-info"></i>&nbsp;<font color="#FFFFFF">Edit Allowance Type</font></td>
            </tr>
            <tr>
              <td class="alterCell" width="25%"><b>Deduction:</b></td>
              <td class="alterCell2"><input readonly="readonly" type="text" name="nameu" class="inputFields" autofocus required  tabindex="1" value="<?php echo str_replace("-"," ",$row["name"]);?>" style="background-color:#999999"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Rate:</b></td>
              <td class="alterCell2"><input type="number" name="minvu" class="inputFields"  required  tabindex="2" value="<?php echo $row["rate"];?>" style="background-color:#FFFF00"/></td>
            </tr>
			<tr>
              <td class="alterCell" width="20%"><b>Applies to:</b></td>
              <td class="alterCell2"><input readonly="readonly" type="text" name="percentvd" class="inputFields"   tabindex="2" value="<?php echo getLoggedUser($row["applies_to"]);?>" style="background-color:#FFFF00"/>
			  <input type="hidden" name="percentv" class="inputFields"  required  tabindex="2" value="<?php echo $row["applies_to"];?>" style="background-color:#FFFF00"/></td>
            </tr>
			
            <tr>
              <td class="alterCell" width="20%">&nbsp;</td>
              <td class="alterCell3"><input type="submit" name="submit" value="Update Record" class="btn btn-primary"/></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
				
		<?php
	if(isset($_POST['nameu'])&& isset($_POST['minvu'])){
	require_once("includes/dbconnector.php");
	
	$name=$_POST['nameu'];
	$name=str_replace(" ","-",$name);
	$min=$_POST['minvu'];
	$percentv=$_POST['percentv'];
	$date=date("Y-m-d H:i:s a");
	$qury="update tbl_hrallowances set rate='$min' where name='$name' and applies_to='$percentv'";
	$resultq = mysql_query($qury);
	if(!$resultq){
	die('Invalid query: ' . mysql_error());
	}else{
	$activity = "Updated HR Allowances ".$name;
	$func->addAuditTrail($activity,$username);

		echo "<script language=javascript>alert('Allowances Has Been Updated Successfuly') </script>";
		 echo "<script language=javascript>window.location='hr_allowances.php' </script>";
	}
	}
	
?>		
				
				
				
				
				</td>
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
 if(confirm("You are about to delete this Subject from the List.\n\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_allowance.php",
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
