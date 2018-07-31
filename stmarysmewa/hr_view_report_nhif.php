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
				.column( 4 )
				.data()
				.reduce( function (a, b) {
					return intVal(a) + intVal(b);
				} );
				
			// Update footer
			$( api.column( 4).footer() ).html(
				''+numberWithCommas(Number(totalbasic).toFixed(2)) 
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

<div id="display_Area">
  <div id="page_tabs_content">
    <?php
	if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){
	  	$from=isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "";
		$to=isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "";
		$query="select p.nhif, p.month_ref, p.payrollref,p.staff_ref, s.fname,s.mname,s.lname,s.idpass from tbl_hr_payslips as p inner join staff s on p.staff_ref=s.idpass where p.date_ref between '$from' and '$to' and p.nhif>0";
		
		$ref=$from ."  to ". $to;
		
	}else{
	$query="select p.nhif, p.date_ref, p.payrollref,p.staff_ref, s.fname,s.mname,s.lname,s.idpass from tbl_hr_payslips as p inner join staff s on p.staff_ref=s.idpass where p.nhif>0";
	$ref="*";
	}
	?>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">NHIF Report:: <?php echo $ref?>
		<div style="float:right; margin-right:20px;">
		<?php 
		if( (isset($_REQUEST["date4"]) ? $_REQUEST["date4"] : "") || (isset($_REQUEST["date5"]) ? $_REQUEST["date5"] : "") ){ ?>
		<a href="pdf_hr_nhifreport.php?frm=<?php echo $from?>&to=<?php echo $to?>"  title="Click to Print" class="noline"><i class="icon icon-orange icon-print"></i>Print </a>
		<?php
		}else{ ?>
		<a href="pdf_hr_nhifreport.php?frm=all&to=all"  title="Click to Print" class="noline"><i class="icon icon-orange icon-print"></i>Print </a>
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
			   <th width="5%">#</th>
                <th>Employee</th>
				<th>ID/Passport #</th>
				 <th>Payrol Ref</th>
                <th align="right">NHIF</th>
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
			   <td width="5%"><?php echo $num?></td>
                <  <td><?php echo str_replace("&","'",$row['fname'])." ".str_replace("&","'",$row['mname'])." ".str_replace("&","'",$row['lname'])?></td>
				<td><?php echo $row['idpass']?></td>
				 <td><?php echo $row['payrollref']?></td>
                <td align="right"><?php echo $row['nhif']?></td>
              </tr>
			<?php
  			}
			 
			 
			 ?>
            </tbody>
			<tfoot>
		   <tr>
		    <th colspan="4" align="right" style="font-weight:bold;">Summary:</th>
            <th style="font-size:11px;"></th>
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
