<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
$username=$_SESSION['SESS_MEMBER_ID_'];
 include 'includes/functions.php';
$func = new Functions();
$activity = "Viewed HR Master Payslip page";
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
<!--<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.min.js"></script>-->
<script type="text/javascript" language="javascript" class="init">
	function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

$(document).ready(function() {
	$('#example').dataTable( {
		"footerCallback": function ( row, data, start, end, display ) {
			var api = this.api(), data;

			// Remove the formatting to get integer data for summation
			var intVal = function ( i ) {
				return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
						i : 0;
			};

			// Total over all pages
			totalbasic = api
				.column( 2 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
				
			totalgross = api
				.column( 3 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalnhif = api
				.column( 4 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalnssf = api
				.column( 5 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalpaye = api
				.column( 6)
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalStatutory = api
				.column( 7 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalGrossBal = api
				.column( 8 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalAllowances = api
				.column( 9)
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalDeductions = api
				.column( 10 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
			totalNet = api
				.column( 11 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );

			
			// Update footer
			$( api.column( 2).footer() ).html(
				''+numberWithCommas(Number(totalbasic).toFixed(2)) 
			);
			$( api.column( 3).footer() ).html(
				''+numberWithCommas(Number(totalgross).toFixed(2)) 
			);
			$( api.column( 4).footer() ).html(
				''+numberWithCommas(Number(totalnhif).toFixed(2)) 
			);
			$( api.column( 5).footer() ).html(
				''+numberWithCommas(Number(totalnssf).toFixed(2)) 
			);
			$( api.column( 6).footer() ).html(
				''+numberWithCommas(Number(totalpaye).toFixed(2)) 
			);
			$( api.column( 7).footer() ).html(
				''+numberWithCommas(Number(totalStatutory).toFixed(2)) 
			);
			$( api.column( 8).footer() ).html(
				''+numberWithCommas(Number(totalGrossBal).toFixed(2)) 
			);
			$( api.column(9).footer() ).html(
				''+numberWithCommas(Number(totalAllowances).toFixed(2)) 
			);
			$( api.column(10).footer() ).html(
				''+numberWithCommas(Number(totalDeductions).toFixed(2)) 
			);
			$( api.column( 11).footer() ).html(
				''+numberWithCommas(Number(totalNet).toFixed(2)) 
			);
		}
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
<div id="display_Area">
  <div id="page_tabs_content">
    <?php
	if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){
	  	$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
		$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
		$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic, p.payrollref,p.month_ref,
	(select sum(allowance) as allw from tbl_hr_payslips_all pa where pa.month_ref=p.date_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref and p.date_ref between '$from' and '$to'";
	
	$ref=$from ."  to ". $to;
	
	}else{
		$query="select s.fname,s.mname,s.lname, p.staff_ref, p.basic, p.payrollref,p.month_ref,
	(select sum(allowance) as allw from tbl_hr_payslips_all pa where pa.month_ref=p.date_ref and pa.staff_ref=p.staff_ref) as allaws, p.nhif, p.nssf,p.paye, (p.nhif+p.nssf) as statutory, (select sum(deduction) as ded from tbl_hr_payslips_ded pd where  pd.month_ref=p.date_ref and pd.staff_ref=p.staff_ref) as deds ,p.netpay from tbl_hr_payslips as p inner join staff s on s.idpass=p.staff_ref";
	
	$ref="*";
	}
	?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Master Payrolls List:: <?php echo $ref?>
		<div style="float:right; margin-right:20px;">
		<?php 
		if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){ ?>
		<a href="pdf_hr_masterslip.php?frm=<?php echo $from?>&to=<?php echo $to?>"  title="Click to Print" class="noline"><i class="icon icon-orange icon-print"></i>Print </a>
		<?php
		}else{ ?>
		<a href="pdf_hr_masterslip.php?frm=all&to=all"  title="Click to Print" class="noline"><i class="icon icon-orange icon-print"></i>Print </a>
		<?php
		}
		?>		
		 </div>
		</td>
      </tr>
      <tr>
        <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Employee</th>
				 <th>PRef#</th>
                <th>Basic</th>
				<th>Allow.</th>
                <th>Gross Pay</th>
                <th>NHIF</th>
                <th>NSSF</th>
				  <th>PAYE</th>
                <th>Gross Bal</th>
                <th>Deductions</th>
                <th>Net Pay</th>
				<th></th>
              </tr>
            </thead>
            <tbody>
			 <?php
          $result = mysql_query($query);
		  $num=0;
  			while($row = mysql_fetch_array($result)){
			$num++;
			?>
  			<tr>
                <td><?php echo str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['mname'])." ".str_replace("&","'",$row['lname'])?></td>
				<td align="right"><?php echo $row['payrollref']?></td>
				<td align="right"><?php echo number_format($row['basic'],2)?></td>
				 <td align="right"><?php echo number_format($row['allaws'],2)?></td> 
				   <td align="right"><?php echo number_format(($row['allaws']+$row['basic']),2)?></td> 
                <td align="right"><?php echo number_format($row['nhif'],2)?></td>
				 <td align="right"><?php echo number_format($row['nssf'],2)?></td>
				  <td align="right"><?php echo number_format($row['paye'],2)?></td>
				  <td align="right"><?php echo number_format(((($row['allaws'])+($row['basic']))-($row['nssf'])),2)?></td>
				 <td align="right"><?php echo number_format(($row['deds']+$row['nhif']+$row['nssf']+$row['paye']),2)?></td> 
				 <td align="right"><?php echo number_format($row['netpay'],2)?></td>
				 <td><a href="pdf_reprint_payroll.php?id=<?php echo $row['payrollref']?>&month=<?php echo $row['month_ref']?>" title="Reprint Payroll" target="_blank"><i class="icon icon-orange icon-copy"></i></a></td>
              </tr>
			<?php
  			}
			 
			 
			 ?>
             
			  
            </tbody>
			<tfoot>
		   <tr>
		    <th align="right" style="font-weight:bold;">Summary:</th>
			<th style="font-size:11px;"></th>
            <th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th style="font-size:11px;"></th>
			<th></th>
          </tr>
	</tfoot>
          </table></td>
      </tr>
    </table>
  </div>
</div>
<!--end of display area This area changes when a user searches for an item-->
</body>
</html>
