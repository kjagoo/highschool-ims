<?php
require_once('auth.php');
$username=$_SESSION['SESS_MEMBER_ID_'];
$usercat=$_SESSION['SESS_CATEGORY_'];
include 'includes/functions.php';
require_once("includes/dbconnector.php");
include 'includes/Finance.php';
$finance = new Financials(); 

$func = new Functions();
$activity = "View Finance Dashboard";
$func->addAuditTrail($activity,$username);


$year=$finance->getFiscalYear();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Portal</title>
<link href="css/style_blue.css" type="text/css" rel="stylesheet">
<link href="css/pages_layout.css" type="text/css" rel="stylesheet">
<link href='css/opa-icons.css' rel='stylesheet'>
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
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<script>
$(function () {

    var colors = Highcharts.getOptions().colors,
        categories = ['FORM 1', 'FORM 2', 'FORM 3', 'FORM 4'],
        data = [{
            y:<?php echo  $finance->getPayableFeesPerform("FORM 1",$year)?>,
            color: colors[0],
            drilldown: {
                name: 'FORM 1 Payable',
                categories: ['Paid', 'Balance'],
                data: [<?php echo $finance->getFeesPaidByForm("FORM 1",$year)?>, <?php echo $finance->getFessBalancesperClass("FORM 1",$year)?>],
                color: colors[0]
            }
        }, {
            y:<?php echo  $finance->getPayableFeesPerform("FORM 2",$year)?>,
            color: colors[1],
            drilldown: {
                name: 'FORM 2 Payable',
                categories: ['Paid', 'Balance'],
                data: [<?php echo $finance->getFeesPaidByForm("FORM 2",$year)?>, <?php echo $finance->getFessBalancesperClass(2,$year)?>],
                color: colors[1]
            }
        }, {
            y:<?php echo  $finance->getPayableFeesPerform("FORM 3",$year)?>,
            color: colors[2],
            drilldown: {
                name: 'FORM 3 Payable',
                categories: ['Paid', 'Balance'],
                 data: [<?php echo $finance->getFeesPaidByForm("FORM 3",$year)?>, <?php echo $finance->getFessBalancesperClass("FORM 3",$year)?>],
                color: colors[2]
            }
        }, {
            y:<?php echo  $finance->getPayableFeesPerform("FORM 4",$year)?>,
            color: colors[3],
            drilldown: {
                name: 'FORM 4 Payable',
                categories: ['Paid', 'Balance'],
                 data: [<?php echo $finance->getFeesPaidByForm("FORM 4",$year)?>, <?php echo $finance->getFessBalancesperClass("FORM 4",$year)?>],
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
           text: 'Fees Payment Analysis'
        },
        subtitle: {
            text: 'Source: <?php echo $year?>'
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
            valueSuffix: 'Kes'
        },
        series: [{
            name: 'Payable Amount',
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
            name: 'Amount',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    // display only if larger than 1
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + ''  : null;
                }
            }
        }]
    });
});

$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Debit & Credit Snap Shot'
        },
        subtitle: {
            text: 'Source: <?php echo $year?>'
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Amount (Kes)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0;font-size:10px"><b>{point.y:.1f} Kes</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Debit',
            data: [<?php echo $finance->getDebit($year,'01')?>, <?php echo $finance->getDebit($year,'02')?>, <?php echo $finance->getDebit($year,'03')?>, <?php echo $finance->getDebit($year,'04')?>, <?php echo $finance->getDebit($year,'05')?>, <?php echo $finance->getDebit($year,'06')?>, <?php echo $finance->getDebit($year,'07')?>, <?php echo $finance->getDebit($year,'08')?>, <?php echo $finance->getDebit($year,'09')?>, <?php echo $finance->getDebit($year,'10')?>, <?php echo $finance->getDebit($year,'11')?>, <?php echo $finance->getDebit($year,'12')?>]

        }, {
            name: 'Credit',
            data: [<?php echo $finance->getCredit($year,'01')?>, <?php echo $finance->getCredit($year,'02')?>, <?php echo $finance->getCredit($year,'03')?>, <?php echo $finance->getCredit($year,'04')?>, <?php echo $finance->getCredit($year,'05')?>, <?php echo $finance->getCredit($year,'06')?>, <?php echo $finance->getCredit($year,'07')?>, <?php echo $finance->getCredit($year,'08')?>, <?php echo $finance->getCredit($year,'09')?>, <?php echo $finance->getCredit($year,'10')?>, <?php echo $finance->getCredit($year,'11')?>, <?php echo $finance->getCredit($year,'12')?>]

        }]
    });
});





</script>
</head>
<body>
<div style="clear: both;"></div>
<table class="borders" cellpadding="5" cellspacing="0">
  <tr style="height:30px;">
    <td class="dataListHeader">Finance Dashboard</td>
  </tr>
  <tr>
    <td><?php
	//$result = mysql_query("select * from finance_fiscalyr where status='OPEN'") or die(mysql_error());
	//$rowscount=mysql_num_rows($result);
	if($finance->getOpenFiscalYear()==1 ||$finance->getOpenFiscalYear()>1){
	?>
	

      <div class="sortable">
        <div class="box span7">
          <div class="box-header well" data-original-title>
            <h2> Fees Payment Analysis<i class="icon-signal"></i></h2>
          </div>
          <div class="box-content">
            <div id="container"  style="height: 300px;  margin: 0 auto"></div>
          </div>
        </div>
		<div class="box span4">
          <div class="box-header well" data-original-title>
            <h2>Debit & Credit Analysis<i class="icon-signal"></i></h2>
          </div>
          <div class="box-content">
            <div id="container2"  style="height: 300px;  margin: 0 auto"></div>
          </div>
        </div>
		
		
       <!-- <div class="box span7">
          <div class="box-header well" data-original-title>
            <h2>Fiscal Year Statistics<i class="icon-signal"></i></h2>
          </div>
          <div class="box-content">
            <table class="customtable">
              <tr class="alert alert-info">
                <td><strong><a>Bank Balance</a></strong></td>
                <td align="right"><span class="yellow"><strong>100,000.00</strong></span></td>
              </tr>
             <tr class="alert alert-danger">
                <td><strong><a>Unpaid Invoices </a></strong> </td>
                <td align="right"><span class="yellow"><strong>25,000.00</strong></span></td>
              </tr>
              <tr class="alert alert-success">
                <td><strong><a>Fees Collection </a></strong> </td>
                <td align="right"><span class="yellow"><strong>150,000.00</strong></span></td>
              </tr>
              <tr class="alert alert-block">
                <td><strong><a>Expenses </a></strong> </td>
                <td align="right"><span class="yellow"><strong>25,000.00</strong></span></td>
              </tr>
            </table>
          </div>
        </div>-->
		
	<?php
	
	//$mydate = "2010-05-12 13:57:01";
	//$month = date("m",strtotime($mydate));
	
	//echo $month;
		
	?>	
		
      </div>
      <?php
	  }else{ ?>
      <div class="alert alert-error">
        <table>
          <tr>
            <td width="20%"><i class="icon32 icon-red icon-alert"></i></td>
            <td><strong>ERROR !</strong><br />
              <br />
              THERE IS NO OPEN FISCAL YEAR </td>
          </tr>
        </table>
      </div>
      <?php }
	  ?>
    </td>
  </tr>
</table>
<div style="clear: both;"></div>
</div>
</body>
</html>
