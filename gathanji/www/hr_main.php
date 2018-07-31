<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/functions.php';
require_once("includes/dbconnector.php"); 

$func = new Functions();
$activity = "View HR Dashboard";
$func->addAuditTrail($activity,$username);

include 'includes/DAO.php';
$dao = new DAO();

	
	
 $gk_teachers=0;
    $result_count = mysql_query("SELECT count(fname) as gk from staff where category='Government Teacher' or category='Dean' or category='Administrator'");
	while($row_c = mysql_fetch_array($result_count)){
	$gk_teachers=$row_c['gk'];
	}

 $board_teachers=0;
    $result_count = mysql_query("SELECT count(fname) as brd from staff where category='Board Teacher'");
	while($row_c = mysql_fetch_array($result_count)){
	$board_teachers=$row_c['brd'];
	}
 $non_teachers=0;
 $total_staff=0;
    $result_count = mysql_query("SELECT count(fname) as non_t from staff");
	while($row_c = mysql_fetch_array($result_count)){
	$total_staff=$row_c['non_t'];
	}
	$total_teachers=0;
	
	
	
	$total_teachers=($gk_teachers+$board_teachers);
	$non_teachers=($total_staff-$total_teachers);	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Portal</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<style type="text/css">
html {
border: 2px solid #FFFF00; 
min-height: 99%;
	}
body{
margin:0;
padding:0;
}
</style>
<script type="text/javascript">

///////////////////////////////////// teachers enrollment //////////////////////////////
$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                type: 'pie',
                name: 'Staff Stat',
                data: [
                    ['BOG Teachers',   <?php echo $board_teachers?>],
                    {
                        name: 'GOK Teachers',
                        y: <?php echo $gk_teachers?>,
                        sliced: true,
                        selected: true
                    },
                    ['Non Teaching Staff',    <?php echo $non_teachers?>]
                ]
            }]
        });
    });

});



</script>
</head>
<body>
<div style="clear: both;"></div>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">HR DASHBOARD</td>
  </tr>
  <tr>
    <td><div class="sortable">
       
          
         
            <div id="container"  style="height: 350px;  margin: 0 auto"></div>
            <ul class="dashboard-list">
              <li><a href="#"><i class="icon-user"></i> <span class="yellow"><?php echo $gk_teachers?></span> Government Teachers </a> </li>
              <li><a href="#"><i class="icon-user"></i> <span class="yellow"><?php echo $board_teachers?></span> Board Teachers (BOG) </a> </li>
              <li><a href="#"><i class="icon-user"></i> <span class="yellow"><?php echo $non_teachers?></span> Non Teaching Staff </a> </li>
            </ul>
         
      
       
      </div></td>
  </tr>
</table>
<div style="clear: both;"></div>
</div>
</body>
</html>
