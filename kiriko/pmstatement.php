<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];

 include 'includes/functions.php';
 include("includes/fees.php");
	$fees = new Fees();

$admno=$_GET['ref'];	

$func = new Functions();
$activity = "Viewed Finance finance pocketmoney report page";
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
     <li><a href="finance_pocketmoney.php">Pocket Money Management</a></li>
	 <li><a class="active" href="finance_pocketmoney_list.php">Pocket Money Reports</a></li>
  </ul>
</div>
<div id="display_Area">
  <div id="page_tabs_content">
 
   <table class="borders" style="margin-bottom: 5px;" cellpadding="5" cellspacing="0" width="100%">
  <tr style='height:30px;'>
    <td class='dataListHeader' colspan='4'>Pocket Money Statement for <?php echo $admno?>
      <div style="float:right; margin-right:20px; width:60%;">
        <table width="80%" align="right">
          <tr>
		  <td align="right"><a href="finance_pocketmoney_list.php" title="Refresh Page"><i class="icon icon-green icon-undo"></i>Back</a></td>
            <td align="right"><a href="pmstatement.php?ref=<?php echo $admno?>" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_pmstatement.php?ref=<?php echo $admno?>" title="Refresh Page"><i class="icon icon-green icon-print"></i>Print PDF</a></td>
          </tr>
        </table>
      </div></td>
  </tr>
  <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
   			<thead>
              <tr> 
			  <th width="10px"></th>
               <th>Transaction</th>
			  <th>Date</th>
			  <th>Deposit</th>
			  <th>Withdraw</th>
			</tr>
			</thead>
			<tbody>
        <?php
		$totals=0;
		  $result = mysql_query("select * from pocket_money_transactions where admno='$admno' order by t_date asc");
		$num=0;
		  while($row = mysql_fetch_array($result)){ 
		  
		  
			  $num++;
		  ?>
        <tr class='record'>
		  <td><?php echo $num?> </td>
          <td><?php echo $row['transaction']?></td>
         <td><?php echo $row['t_date']?></td>
		  <td align='right'><?php echo number_format($row['deposit_amount'],2)?></td>
		  <td align='right'><?php echo number_format($row['withdraw_amount'],2)?></td>
        </tr>
        <?php 
		
		  	
		  }
			?>
		</tbody>
		 <tfoot>
                        <tr>
                          <th colspan="3">Available Balance</th>
                          <th align="right"><div style="float:right;"><?php echo  number_format($fees->pocketMoneyBal($admno),2)?></div></th>
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
