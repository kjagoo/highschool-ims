<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Finance Voteheads Setting page";
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
   <li><a  href="finance_PO.php">Receive Invoice</a></li>
    <li><a  class="active" href="finance_polist.php">Received Invoices</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
 
   <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Received Invoices List
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="finance_polist.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
   			<thead>
             <tr>
			  <th> No.</th>
			  <th> Invoice No</th>
			  <th> Supplier </th>
			  <th> Invoice Date </th>
			  <th> Status </th>
			  <th>Qtny</th>
			  <th>Totals</th>
			  <th><i class=" fa fa-pencil"></i> </th>
			  <th><i class=" fa fa-trash-o"></i></th>
			</tr>
			</thead>
			<tbody>
        <?php
		  $result = mysql_query("SELECT distinct(ri.invoice_ref),ri.supplier,ri.received_date,ri.invoice_payment_status, count(rii.qty) as qty, sum(rii.price) as amount from received_invoices as ri inner join received_invoice_items rii on ri.invoice_ref=rii.invoice_ref group by ri.invoice_ref");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		  $num++;?>
       <tr>
		  <td><?php echo $num?></td>
		  <td><?php echo $row['invoice_ref']?></td>
		 <td><?php echo str_replace("_"," ",$row['supplier'])?></td>
		  <td><?php echo $row['received_date']?></td>
		  <td><?php echo $row['invoice_payment_status']?></td>
		  <td><?php echo $row['qty']?></td>
		  <td align="right"><?php echo number_format($row['amount'],2)?></td>
		  <td align="center"><a href="edit_finance_invoice_received.php?id=<?php echo base64_encode($row['invoice_ref'])?>" title="Click to Edit Invoice"><i class="icon icon-red icon-edit"></i></a> </td>
		  <td align="center"><a href="delete_finance_received_invoice_received.php?id=<?php echo $row['invoice_ref']?>" onClick="return Warn()" id="<?php echo $row['invoice_ref']?>" title="Click to delete Invoice"><i class="icon icon-red icon-trash"></i></a></td>
		</tr>
        <?php 
		
		  	}
			?>
		</tbody>
		
      </table></td>
</table>
	

  </div>
</div>
<!--end of display area. This area changes when a user searches for an item-->

</body>
</html>
