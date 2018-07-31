<?php
require_once('auth.php');
$usercat=$_SESSION['SESS_CATEGORY_'];
$username=$_SESSION['SESS_MEMBER_ID_'];


 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
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
<script language="javascript">
function deleteConfirm(){
	doIt=confirm('You are about to delete this record\n\nDo you wish to proceed?');
	if(doIt){
  return true
	//window.location="deleteEmployee.php?id="+id;//redirect the users to the home page
	}else{
	return false
	}

}

String.prototype.parseURL = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(url) {
		
		
		return url.link(url);
		
			});
};
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
    <li><a class="active" href="system_logfile.php">System Log Files</a></li>
  </ul>
</div>
<div class="clear"></div>
<div id="page_tabs_content">
<?php

include('includes/dbconnector.php');
 $statement = "tblaudittrail order by auditDate desc";
 $result = mysql_query("SELECT * FROM $statement");

 $rowscount=mysql_num_rows($result);
 
 if($rowscount==1 ||$rowscount>1){
 ?>
<table class="borders" cellpadding="5" cellspacing="0">
<tr style="height:30px;">
  <td class="dataListHeader">System Log file: Track User Activities
  <div style="float:right; margin-right:20px">
  
        <table width="250px;">
          <tr>
		  <td align="center"><a href="system_logfile.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
            <td align="right">
			<form name="form" action="<?php echo $_SERVER['PHP_SELF'] ?>"  method="post">
			<a href="finance_viewalreadyset_fees.php" class="noline" title="Previous Page" target="content"><button type="submit" name="submit"><i class="icon icon-red icon-archive"></i>Archive</button></a>
			</form>
			</td>
          </tr>
        </table>
		

      </div>
  </td>
</tr>
<tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th width="16%">Activity Date</th>
          <th>Username</th>
          <th>Access Level</th>
          <th>Access Location</th>
          <th>Activity</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php	
 	$num=0;
	while ($row = mysql_fetch_array($result)) {
	$num++;
	$auditdate=$row['auditDate'];
	$activity=$row['activity'];
	
	$uname=$row['uname'];
	$ipaddress=$row['ipaddress'];
	
	
	$user = mysql_query("SELECT * FROM staff where idpass='$uname'");
	while ($rowu = mysql_fetch_array($user)) {
	$category=$rowu['category'];
	$fname=$rowu['fname'];
	$mname=$rowu['mname'];
	$lname=$rowu['lname'];
	}
	$uname=$fname." ".$mname." ".$lname;
?>
        <tr class='record'>
          <td><?php echo $num; ?></td>
          <td align=left><?php echo $auditdate;?></td>
          <td><?php echo $uname;?></td>
          <td><?php echo $category?> </td>
          <td><?php echo $ipaddress?></td>
          <td><script type="text/javascript">
			var test = "<?php echo $activity; ?>";
			document.write(test.parseURL());
			</script></td>
          <td><a href="#" id="<?php echo $row["id"]; ?>" class="delbutton"><img src="sys_images/delete.png" align="absmiddle"/></a></td>
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
		if(isset($_POST['submit']) ){
		include("includes/dbconnector.php");
		$dbhost="localhost";
		$dbuser="root";
		$dbpass="";
		$dbname="maryleaky";
		$table="tblaudittrail";
		$date = date("Y-m-d__H-i-s");
		$time=date("H:i:s a");
		$directory="Database/";
		$backupFile=$directory.$table.'_'.$date.'.sql';
		$command = "mysqldump -u root maryleaky tblaudittrail >".$backupFile;
		
		
		system($command);
		
		
	
			 $sql = "delete from tblaudittrail";
 		 	 if (!mysql_query($sql)) {
			 die('Invalid query: ' . mysql_error());
			 }else{
		?>
		<script language=javascript> alert('Record Archived Successfuly');</script>
		 <script type='text/javascript'>window.open('system_logfile.php','content');</script>
		 
		<?php
		}
		}
		?>	

    <?php
}else{
?>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Audit Trail</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td align="center"><h3>Sorry There are no audit trails</h3></td>
        </tr>
      </tbody>
    </table>
    <?php
}
//mysqli_close($con);
?>
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
 if(confirm("You are about to delete this audit record.\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_log.php",
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
</body>
</html>