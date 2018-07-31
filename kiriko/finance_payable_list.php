<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance expenses list page";
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
</head>
<body>
<div id="page_tabs">
  <ul>
     <li><a  href="finance_payables.php">Expenses</a></li>
	<li><a  class="active" href="finance_payable_list.php">Expenses Report </a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
 
   <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Expenses Report
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="finance_payable_list.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
   			<thead>
              <tr> 
			  <th width="10px"></th>
			   <th>Transitional Date</th>
               <th>Votehead A/c</th>
			  <th>Mode</th>
			  <th>Expenses Naration</th>
			  <th>Amount</th>
			  <th></th>
			   <th></th>
			</tr>
			</thead>
			<tbody>
        <?php
		$totals=0;
		  $result = mysql_query("SELECT * FROM expenses order by t_date asc");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		  $num++;?>
        <tr class='record'>
		  <td><?php echo $num?> </td>
          <td><?php echo $row['t_date']?></td>
          <td><?php echo $row['account']?> </td>
		  <td><?php echo $row['e_mode']?> </td>
		  <td><?php echo $row['expense_on']?> </td>
		   <td align='right'><?php echo number_format($row['amount'],2)?> </td>
		  <td><a href="" title="Edit Details"><i class="icon icon-red icon-edit"></i></a></td>
		  <td><i class="icon icon-red icon-trash"></i></td>
        </tr>
        <?php 
		 $totals+=$row['amount'];
		  	}
			?>
		</tbody>
		 <tfoot>
                        <tr>
                          <th colspan="5">Summary</th>
                          <th align="right"><div style="float:right;"><?php echo  number_format($totals,2)?></div></th>
                        </tr>
                      </tfoot>
      </table></td>
</table>
	

  </div>
</div>
<!--end of display area. This area changes when a user searches for an item-->
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("WARNING !\n\nYou are about to delete this LPO record.\n Do you Want to Continue?"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_LPO.php",
   data: info,
   success: function(){
   	alert('LPO has been Deleted');
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
