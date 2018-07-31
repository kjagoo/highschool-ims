<?php
require_once('auth.php');
  require_once("includes/dbconnector.php"); 
  include 'includes/DAO.php';
	$dao = new DAO();
	
$username=$_SESSION['SESS_MEMBER_ID_'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>content</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
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
<link href='css/opa-icons.css' rel='stylesheet'>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<script type='text/javascript'>//<![CDATA[ 
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
                name: 'Inventory Stat',
                data: [
                    ['Available Books', <?php echo $dao->getBooksQty()?>],
                    {
                        name: 'Issued Books',
                        y: <?php echo $dao->getBooksIssuedOut()?>,
                        sliced: true,
                        selected: true
                    },
					{
                        name: 'Lost Books',
                        y: <?php echo $dao->getLostBooks()?>,
                        sliced: true,
                        selected: true
                    }
                ]
            }]
        });
    });

});


$(window).load(function(){
setTimeout(function(){
    $("#blocker").hide();
}, 1000);

});//]]>  

</script>
</head>
<body>
    <table class="borders" cellpadding="5" cellspacing="0">
      <tr style="height:30px;">
        <td class="dataListHeader">Library Dashboard</td>
      </tr>
      <tr>
        <td><div class="sortable">
            <div class="box span4">
              <div class="box-header well" data-original-title>
                <h2><i class="icon-list"></i> Books Availability Statistics</h2>
              </div>
              <div class="box-content">
                <ul class="dashboard-list">
                  <?php
					$querysubs = "select distinct (subject) from subjects";
					$resultsubs=mysql_query($querysubs) ;
					while($rowsubs=mysql_fetch_array($resultsubs)){?>
                  <li><a href="#"><i class="icon-book"></i> <span class="yellow"><?php echo $dao->getBooksByCategory($rowsubs['subject'])?></span> <?php echo str_replace("-"," ",$rowsubs['subject'])?> </a> </li>
                  <?php 
					}
					?>
                </ul>
              </div>
            </div>
            <!--/span-->
            <div class="box span7">
              <div class="box-header well" data-original-title>
                <h2><i class="icon-signal"></i> Library Inventory Statistics</h2>
              </div>
              <div class="box-content">
                <div id="container"  style="height:300px;  margin: 0 auto"></div>
                <ul class="dashboard-list">
                  <li><a href="#"><i class="icon-book"></i> <span class="yellow"><?php echo $dao->getBooksQty()?></span> Available Books </a> </li>
                  <li><a href="#"><i class="icon-book"></i> <span class="yellow"><?php echo $dao->getBooksIssuedOut()?></span> Issued Books </a> </li>
                  <li><a href="#"><i class="icon-book"></i> <span class="yellow"><?php echo $dao->getLostBooks()?></span> Lost Books </a> </li>
                </ul>
              </div>
            </div>
            <!--/span-->
          </div>
          <!--/row-->
        </td>
      </tr>
    </table>
  </div>

<!--end of display area. 
This area changes when a user searches for an item-->
</body>
</html>
