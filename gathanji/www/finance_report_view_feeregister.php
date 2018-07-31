<?php
require_once('auth.php');
require_once("includes/dbconnector.php"); 
include 'includes/functions.php';
include 'includes/Finance.php';

$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$finance = new Financials();

$activity = "Viewed fees register";
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
<!-- Initiate tablesorter script -->
<link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css" />
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
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script></head>
<body>
<div id="blocker">
       <div><img src="images/loading.gif" />Loading...</div>
   </div>
<?php
if(isset($_GET['year']) && isset($_GET['term'])){
$year=$_GET['year'];
$term=$_GET['term'];
$votehead=$_GET['votehead'];

$finance->getVoteheadCodesCreateTable($term,$year);


$result = mysql_query("select * from finance_voteheads where fiscal_year='".$finance->getFiscalYear()."' order by votehead asc");
$rowscounts=mysql_num_rows($result);
  

?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Fees Register: <?php echo $year." :-".$term."  Votehead:-".$votehead?>
	
	<div style="float:right; margin-right:20px">
        <table width="250px;">
          <tr>
		   <td align="center"><a href="finance_report_view_feeregister.php?year=<?php echo $year?>&term=<?php echo $term?>&votehead=<?php echo $votehead?>"  class="noline" title="Refresh Page"><i class="icon icon-green icon-refresh"></i>Refresh</a></td>
			<td align="right"><a href="pdf_feesregister.php?year=<?php echo $year?>&term=<?php echo $term?>&votehead=<?php echo $votehead?>" class="noline" title="Click to Print"><i class="icon icon-orange icon-print"></i>Print</a></td>
            <td align="right"><a href="finance_report_feeregister.php"  class="noline" title="Previous Page" target="content"><i class="icon icon-red icon-close"></i>Back</a></td>
          </tr>
        </table>
      </div>
	</td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>#</th>
		   <th>Admno</th>
		  <th>Receipt</th>
		  <th align="right">Amount</th>
            <?php
			$heads=array();
			$votes=array();
			while($row = mysql_fetch_array($result)){ ?>
           
            <?php	
			array_push($heads,$row['code']);
			array_push($votes,$row['votehead']);
			$finance->getRegisterVotehead($year,$term,$row['votehead'],$row['code']);
			}
          ?>
          </tr>
        </thead>
        <tbody>
		<?php
		$resultreg = mysql_query("select * from feeregisterreport_".$year."_".str_replace(" ","_",$term)." where year='$year' and term='$term' and $votehead >0 order by receipt_no asc");
			$num=0;
			$totalsum=0;
			while($rowreg = mysql_fetch_array($resultreg)){ 
			$num++;
			?>
			<tr>
			 <td><?php echo $num?></td>
			 <td><?php echo $rowreg['admno']?></td>
			 <td><?php echo $rowreg['receipt_no']?></td>
			
            <td align="right"><?php echo $rowreg[$votehead]?></td>
			 
			</tr>
            <?php
			$totalsum+=$rowreg[$votehead];
			}//end of while loop
			
		?> 
        
        </tbody>
        <tfoot>
          <tr>
		  <td colspan="3"><?php echo $votehead?> Total Paid:</td>
            
            <td align="right" style="font-weight:bold;"><?php echo number_format($finance->getVoteheadTotals($year,$term,$votehead),2)?></td>
            
          </tr>
        </tfoot>
      </table></td>
  </tr>
</table>

<?php
}else{ 
$result = mysql_query("select * from finance_voteheads where fiscal_year='".$finance->getFiscalYear()."' order by votehead asc");
$rowscounts=mysql_num_rows($result);
?>

<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Fees Register:<?php echo $finance->getFiscalYear()?></td>
  </tr>
  <tr>
    <td colspan="2"><table id="example" class="table table-bordered table-striped">
        <thead>
          <tr>
          <th>Receipt</th>
            <?php
			$heads=array();
			while($row = mysql_fetch_array($result)){ ?>
            <th><?php echo $row['code']?></th>
            <?php	
			array_push($heads,$row['votehead']);
			}
          ?>
          </tr>
        </thead>
        <tbody>
		
        </tbody>
        <tfoot>
          <tr>
		  <td>Summary:</td>
            <?php
			for($i=0; $i<$rowscounts; $i++){ ?>
            <th align="right" style="font-weight:bold;"></th>
            <?php	
			}
          ?>
          </tr>
        </tfoot>
      </table></td>
  </tr>
</table>
<?php
}
?>
</body>
</html>
