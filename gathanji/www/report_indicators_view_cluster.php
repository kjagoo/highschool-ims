<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
   include 'includes/functions.php';
   include 'includes/DAO.php';
$username=$_SESSION['SESS_MEMBER_ID_'];

$func = new Functions();
$dao = new DAO();
	$activity = "Viewed Cluster Student Performance Indicators";
	$username=$_SESSION['SESS_MEMBER_ID_'];
	$func->addAuditTrail($activity,$username);

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
<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="syntax/shCore.js"></script>
<script type="text/javascript" language="javascript" src="syntax/demo.js"></script>
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

	
	printDivCSS = new String ('<link rel="stylesheet" href="css/tablesorter.css" type="text/css" />')
function printDiv(divId) {
    window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML
	 window.frames["print_frame"].document.body.style.fontSize="11px";
    window.frames["print_frame"].window.focus()
    window.frames["print_frame"].window.print()
}


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
<?php
if(isset($_POST['year']) && isset($_POST['form']) && isset($_POST['stream']) && isset($_POST['term'])){
$year=$_POST['year'];
$form=$_POST['form'];
$stream=$_POST['stream'];
$term=$_POST['term'];
include 'includes/PerformanceIndicator.php';

$pin = new PI();

$pin->getPICluster($form,$term,$stream,$year);
	
	
	
?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Student Information: <?php echo "Form ".$form." ".$stream." Year ". $year." -  Term ".$term?>
      <div style="float:right; margin-right:20px;"><a href="pdf_indicators.php?id=<?php echo $year?>&term=<?php echo $term?>&form=<?php echo $form?>&stream=<?php echo $stream?>"  title="Click to Print" class="noline"><i class="icon icon-orange icon-print"></i>Print</a> </div></td>
  </tr>
  <tr>
    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th> No.</th>
            <th> Adm No</th>
            <th> Student Name </th>
			 <th> KCPE M.S.S</th>
            <th> Previous M.S.S</th>
            <th> Current M.S.S </th>
			 <th> V.A.P </th>
            <th> P.I. </th>
          </tr>
        </thead>
        <tbody>
		<?php
		$resultf = mysql_query("select * from totalmockperformanceindex where year='$year' and form='$form' and term='$term' and classin='$stream' order by pindex desc");
		$num=0;
		$rowscount=mysql_num_rows($resultf);
   		if($rowscount==1 ||$rowscount>1){
		while ($rowf = mysql_fetch_array($resultf)){
			$num++;	
		?>
		<tr>
		<td><?php echo $num?> </td>
		<td><?php echo $rowf['adm']?> </td>
		<td><?php echo $rowf['names']?> </td>
		<td><?php echo $rowf['kcpemean']?> </td>
		<td><?php echo $rowf['previous']?> </td>
		<td><?php echo $rowf['current']?></td>
		<td><?php echo $rowf['vap']?> </td>
		<td><?php echo $rowf['pindex']?> </td>
		</tr>
		<?php
		}
		}else{}
		?>
        </tbody>
      </table></td>
  </tr>
</table>
<?php
 }else{ ?>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Student Performance Indicators</td>
  </tr>
  <tr>
    <td><table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
           <th> No.</th>
            <th> Adm No</th>
            <th> Student Name </th>
			 <th> KCPE M.S.S</th>
            <th> Previous M.S.S</th>
            <th> Current M.S.S </th>
			 <th> V.A.P </th>
            <th> P.I. </th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table></td>
  </tr>
</table>

<?php


 }?>
</body>
</html>
