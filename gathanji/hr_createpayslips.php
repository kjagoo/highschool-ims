<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed HR Create Payslip page";
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


<div class="clear"></div>
<div id="page_tabs">
  <ul>
    <li><a class="active" href="hr_createpayslips.php">Create Payslips</a></li>
  </ul>
</div>
<div id="display_Area">
<div id="page_tabs_content">
<?php
	   $statement = "SELECT * FROM staff where category !='TRAN'  order by salary desc";
    $result = mysql_query($statement);
?>

  <table class="borders" cellpadding="5" cellspacing="0">
    <tr style="height:30px;">
      <td class="dataListHeader">Available Staff</td>
    </tr>
    <tr>
      <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th width="10px"> No.</th>
              <th> FULLNAMES</th>
              <th> ID/ PASSPORT </th>
              <th> TYPE </th>
			  <th> Basic</th>
			 
			  <td></td>
            </tr>
          </thead>
          <tbody>
            <?php
		$num=0;
		while($row = mysql_fetch_array($result)){
		$num++; ?>
            <tr class='record'>
              <?php 
	echo '<td>'.$num.'</td>';
	echo '<td>'.str_replace("&","'",$row['fname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['mname']).'&nbsp;&nbsp;'.str_replace("&","'",$row['lname']).'</td>';
	//echo '<td>'.$row['gender'].'</td>';
	echo '<td>'.$row['idpass'].'</td>';
	echo '<td>'.$row['category'].'</td>';
	echo '<td align="right">'.$row['salary'].'</td>';
	
				?>
				<td><a href="hr_viewcreatepayslips.php?id=<?php echo $row['idpass']?>&sal=<?php echo $row['salary']?>"><i class="icon-check"/></i></a></td>
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
<!--end of display area This area changes when a user searches for an item-->
</body>
</html>
