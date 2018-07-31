<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "Viewed Received LPOs page";
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
   <li><a  href="finance_inventory.php">Receive Purchase Order</a></li>
    <li><a  class="active" href="finance_inventory_received.php">Received Purchase Orders</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
 
   <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Received Purchase Orders List
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
            <td align="right"><a href="finance_inventory_received.php" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
   			<thead>
              <tr> 
			  <th width="10px"></th>
			  <th>L.P.O #</th>
			  <th>Deliverly Date</th>
			  <th>Supplier</th>
			  <th>Qty Ordered</th>
			  <th>Qty Received</th>
			  <th>Total Price</th>
			  <th>Received By</th>
			 
			</tr>
			</thead>
			<tbody>
        <?php
		  $result = mysql_query("SELECT p.*, 
       		(SELECT COUNT(po.item) FROM purchase_orderitems_received po WHERE po.po_number = p.po_number) AS totalitems,
			(SELECT COUNT(ip.item) FROM purchase_orderitems ip WHERE ip.po_number = p.po_number) AS totalitemsordered,
			(SELECT sum(po.total_price) FROM purchase_orderitems_received po WHERE po.po_number = p.po_number) AS totalprice,
			ipo.supplier 
			FROM purchase_orders_received p join purchase_orders ipo on p.po_number=ipo.po_number  GROUP BY p.po_number order by p.delivery desc");
		$num=0;
		$totalv=0;
		$qtyo=0;
		$qtyd=0;
		  while($row = mysql_fetch_array($result)){ 
		  $num++;?>
        <tr class='record'>
		  <td><?php echo $num?> </td>
          <td><?php echo $row['po_number']?></td>
		  <td><?php echo $row['d_date']?> </td>
		  <td><?php echo $row['supplier']?> </td>
		  <td align="right"><?php echo $row['totalitemsordered']?> </td>
		    <td align="right"><?php echo $row['totalitems']?> </td>
		  <td align="right"><strong><?php echo $row['totalprice']?></strong> </td>
		   <td><?php echo $row['received_by']?> </td>
		  
		  
        </tr>
        <?php 
		$qtyo+=$row['totalitemsordered'];
		$qtyd+=$row['totalitems'];
		$totalv+=$row['totalprice'];
		
		  	}
			?>
		</tbody>
		<tfoot>
          <tr>
            <th colspan="4" align="right" style="font-weight:bold; margin-right:20px;">Summary:</th>
			<th align="right" style="font-weight:bold;"><?php echo $qtyo?></th>
			<th align="right" style="font-weight:bold;"><?php echo $qtyd?></th>
            <th align="right" style="font-weight:bold;"><?php echo number_format($totalv,2)?></th>
            <th></th>
          </tr>
        </tfoot>
		
      </table></td>
</table>
	

  </div>
</div>
<!--end of display area. This area changes when a user searches for an item-->
</body>
</html>
