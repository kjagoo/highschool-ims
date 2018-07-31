<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/functions.php';
require_once("includes/dbconnector.php"); 

$func = new Functions();
$activity = "View school enrollment page";
$func->addAuditTrail($activity,$username);

include 'includes/DAO.php';
$dao = new DAO();

		
	$f1_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 1'");
	while($row_c = mysql_fetch_array($result_count)){
	$f1_boys_count=$row_c['boys'];
	}
	$f2_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 2'");
	while($row_c = mysql_fetch_array($result_count)){
	$f2_boys_count=$row_c['boys'];
	}
	$f3_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 3'");
	while($row_c = mysql_fetch_array($result_count)){
	$f3_boys_count=$row_c['boys'];
	}
	$f4_boys_count=0;
    $result_count = mysql_query("SELECT count(admno) as boys from studentdetails where gender='Male' and form='FORM 4'");
	while($row_c = mysql_fetch_array($result_count)){
	$f4_boys_count=$row_c['boys'];
	}
	
	
	$f1_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 1'");
	while($row_c = mysql_fetch_array($result_count)){
	$f1_girls_count=$row_c['girls'];
	}
	$f2_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 2'");
	while($row_c = mysql_fetch_array($result_count)){
	$f2_girls_count=$row_c['girls'];
	}
	$f3_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 3'");
	while($row_c = mysql_fetch_array($result_count)){
	$f3_girls_count=$row_c['girls'];
	}
	$f4_girls_count=0;
    $result_count = mysql_query("SELECT count(admno) as girls from studentdetails where gender='female' and form='FORM 4'");
	while($row_c = mysql_fetch_array($result_count)){
	$f4_girls_count=$row_c['girls'];
	}
	
	$f1_total_count=0;
	$f2_total_count=0;
	$f3_total_count=0;
	$f4_total_count=0;
	$total_boys_count=0;
	$total_girls_count=0;
	
	$f1_total_count=($f1_boys_count+$f1_girls_count);
	$f2_total_count=($f2_boys_count+$f2_girls_count);
	$f3_total_count=($f3_boys_count+$f3_girls_count);
	$f4_total_count=($f4_boys_count+$f4_girls_count);
	$total_boys_count=($f1_boys_count+$f2_boys_count+$f3_boys_count+$f4_boys_count);
	$total_girls_count=($f1_girls_count+$f2_girls_count+$f3_girls_count+$f4_girls_count);
	
	
	$total_counts=($f1_total_count+$f2_total_count+$f3_total_count+$f4_total_count);
	
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
$(function () {

    var colors = Highcharts.getOptions().colors,
        categories = ['FORM 1', 'FORM 2', 'FORM 3', 'FORM 4'],
        data = [{
            y:<?php echo $f1_total_count?>,
            color: colors[0],
            drilldown: {
                name: 'FORM 1 enrollment',
                categories: ['Boys', 'Girls'],
                data: [<?php echo $f1_boys_count?>, <?php echo $f1_girls_count?>],
                color: colors[0]
            }
        }, {
            y: <?php echo $f2_total_count?>,
            color: colors[1],
            drilldown: {
                name: 'FORM 2 enrollment',
                categories: ['Boys', 'Girls'],
                data: [<?php echo $f2_boys_count?>, <?php echo $f2_girls_count?>],
                color: colors[1]
            }
        }, {
            y: <?php echo $f3_total_count?>,
            color: colors[2],
            drilldown: {
                name: 'FORM 3 enrollment',
                categories: ['Boys', 'Girls'],
                data: [<?php echo $f3_boys_count?>, <?php echo $f3_girls_count?>],
                color: colors[2]
            }
        }, {
            y:<?php echo $f4_total_count?>,
            color: colors[3],
            drilldown: {
                name: 'FORM 4 enrollment',
                categories: ['Boys', 'Girls'],
                data: [<?php echo $f4_boys_count?>, <?php echo $f4_girls_count?>],
                color: colors[3]
            }
        }],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
           text: 'Student Enrollment'
        },
        //yAxis: {
           // title: {
                //text: 'Total percent market share'
           // }
        //},
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
            name: 'Enrollment',
            data: browserData,
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -30
            }
        }, {
            name: 'Enrollment',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%'  : null;
                }
            }
        }]
    });
});
///////////////////////////////////// teachers enrollment //////////////////////////////
$(function () {

    // Radialize the colors
    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
            stops: [
                [0, color],
                [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    });

    // Build the chart
    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Staff Enrollment'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    },
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Staffs',
            data: [
                ['Baord Teachers',       <?php echo $board_teachers?>],
                {
                    name: 'GoK Teachers',
                    y: <?php echo $gk_teachers?>,
                    sliced: true,
                    selected: true
                },
                ['Non-Teaching',    <?php echo $non_teachers?>]
                
            ]
        }]
    });
});
</script>
</head>
<body>
  
 <div style="clear: both;"></div>
 <table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader" colspan="2">School Enrollment</td>
  </tr>
  <tr>
  <td width="65%"><div id="container"  style="height: 400px;  margin: 0 auto"></div></td>
  <td>
      <table width="100%" class="tablesorter">
        <tr>
          <td>&nbsp;</td>
          <td><strong>Boys</strong></td>
          <td><strong>Girls</strong></td>
          <td><strong>Total</strong></td>
        </tr>
        <tr>
          <td><strong>Form 1</strong> </td>
          <td><?php echo $f1_boys_count?></td>
          <td><?php echo $f1_girls_count?></td>
          <td><?php echo $f1_total_count?></td>
        </tr>
        <tr>
          <td><strong>Form 2</strong></td>
          <td><?php echo $f2_boys_count?></td>
          <td><?php echo $f2_girls_count?></td>
          <td><?php echo $f2_total_count?></td>
        </tr>
        <tr>
          <td><strong>Form 3</strong></td>
          <td><?php echo $f3_boys_count?></td>
          <td><?php echo $f3_girls_count?></td>
          <td><?php echo $f3_total_count?></td>
        </tr>
        <tr>
          <td><strong>Form 4</strong></td>
          <td><?php echo $f4_boys_count?></td>
          <td><?php echo $f4_girls_count?></td>
          <td><?php echo $f4_total_count?></td>
        </tr>
        <tr>
          <td><strong>Totals</strong></td>
          <td><strong><?php echo $total_boys_count?></strong></td>
          <td><strong><?php echo $total_girls_count?></strong></td>
          <td><strong><?php echo $total_counts?></strong></td>
        </tr>
      </table>
	 </td>
	</tr>
	<tr>
	<td width="65%"><div id="container2"  style="height: 400px;  margin: 0 auto"></div></td>
	<td>
	<table width="100%" class="tablesorter">
        <tr>
          <td><strong>Govenrment Teachers</strong> </td>
          <td><?php echo  $gk_teachers?></td>
        </tr>
        <tr>
          <td><strong>Board Teachers</strong> </td>
          <td><?php echo  $board_teachers?></td>
        </tr>
        <tr>
          <td><strong>Non Teaching Staff</strong> </td>
          <td><?php echo  $non_teachers?></td>
        </tr>
        <tr>
          <td><strong>Totals Staffs</strong> </td>
          <td><strong><?php echo $total_staff?></strong></td>
        </tr>
      </table>
	</td>
	</tr>
</table>
      <div style="clear: both;"></div>
 
 
</div>
</body>
</html>
